<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require(__DIR__ . '../../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/dataformatlib.php');
$format = optional_param('dataformat', '', PARAM_TEXT);
$sesskey = optional_param('sesskey', '', PARAM_ALPHANUMEXT);
$name = optional_param('name', '', PARAM_TEXT);
require_sesskey();
require_login();
global $DB;

if ($format) {
    $where = '';
    if(!empty($name)){
        $where = " AND ms.name LIKE '%".$name."%'";
    }
    // Define the headers and columns.
    $headers = [];
    $headers[] = get_string('schoolname', 'local_mentor');
    $headers[] = get_string('mentors', 'local_mentor');
    $headers[] = get_string('number_of_students', 'local_mentor');
    $headers[] = get_string('mentoring_sessions', 'local_mentor');
    $params = array();
    $mentor_student_time = $DB->get_records_sql("SELECT schoolid,count(id) as total_session ,SUM(totalstudents) as totalstudents FROM {mentor_sessionrpt} group by schoolid");
    $mentor_student_array = array();
    $mentor_session_array = array();
    foreach ($mentor_student_time as &$mentor_student_time) {
      $mentor_student_array[$mentor_student_time->schoolid] = $mentor_student_time->totalstudents;
      $mentor_session_array[$mentor_student_time->schoolid] = $mentor_student_time->total_session;
    }
    $countfields = 'SELECT COUNT(u.id)';
    $fields = "SELECT ms.*,mus.userid,mus.schoolid,mu.firstname,mu.lastname ";
    $sql = " FROM {school} ms 
         LEFT JOIN (SELECT * from {user_school} WHERE role='incharge') mus on mus.schoolid=ms.id 
         LEFT JOIN {user} mu on mu.id=mus.userid WHERE ms.activestatus=1 and mu.deleted=0 $where";
    $schools = $DB->get_records_sql($fields . $sql, $params);

    $allschools = [];
    foreach ($schools as $school) {
        $mentordata = $DB->get_records_sql("SELECT mus.id,mu.id as userid,mu.firstname FROM {user_school} mus JOIN {user} mu on mu.id=mus.userid WHERE mus.schoolid=$school->id and role='mentor'");
        if (!empty($mentordata)) {
            foreach ($mentordata as $mentor) {
                $tmpdata = new stdClass();
                $tmpdata->name = $school->name;
                $tmpdata->firstname = $mentor->firstname;
                $tmpdata->number_of_students = array_key_exists($school->id,$mentor_student_array) ?$mentor_student_array[$school->id] :0;
                $tmpdata->number_of_sessions = array_key_exists($school->id,$mentor_session_array) ?$mentor_session_array[$school->id] :0;
                $allschools[] = $tmpdata;
            }
        } else {
            $tmpdata = new stdClass();
            $tmpdata->name = $school->name;
            $tmpdata->firstname = 'NA';
            $tmpdata->number_of_students = 0;
            $tmpdata->number_of_sessions = 0;
            $allschools[] = $tmpdata;
        }
    }
    $name = "schools-database";
    $allschools = (object) $allschools;
    $filename = clean_filename($name);
    $user = new ArrayObject($allschools);
    $iterator = $user->getIterator();

    $countrecord = 0;
    \core\dataformat::download_data($filename, $format, $headers, $iterator, function ($school) {
        global $DB;
        $data = [];
        $data[] = $school->name;
        $data[] = $school->firstname;
        $data[] = $school->number_of_students;
        $data[] = $school->number_of_sessions;
        return $data;
    });
    exit;
}
