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
    $params = array();
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
                $allschools[] = $tmpdata;
            }
        } else {
            $tmpdata = new stdClass();
            $tmpdata->name = $school->name;
            $tmpdata->firstname = 'NA';
            $allschools[] = $tmpdata;
        }
    }
    $name = "schools";
    $allschools = (object) $allschools;
    $filename = clean_filename($name);
    $user = new ArrayObject($allschools);
    $iterator = $user->getIterator();

    $countrecord = 0;
    download_as_dataformat($filename, $format, $headers, $iterator, function ($school) {
        global $DB;
        $data = [];
        $data[] = $school->name;
        $data[] = $school->firstname;
        return $data;
    });
    exit;
}
