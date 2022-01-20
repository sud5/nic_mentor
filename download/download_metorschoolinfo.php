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
$name = optional_param('email', '', PARAM_TEXT);
require_sesskey();
require_login();
global $DB;

if ($format) {
    $where = '';
    if (!empty($name)) {
         $where = " AND u.email  LIKE  '%".$name."%'";
    }
    // Define the headers and columns.
    $headers = [];
    $headers[] = get_string('mentorsname', 'local_mentor');
    $headers[] = get_string('schoolname', 'local_mentor');
    $fields = "SELECT u.*,ud.scormstatus, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
    $sql = " FROM {user} u "
            . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
            . "WHERE msn=4 and deleted=0 and ud.data='mentor data' $where group by u.id ORDER BY u.id ASC";
    $availablementors = $DB->get_records_sql($fields . $sql);
    $allmentors = [];
    foreach ($availablementors as $mentor) {
        $sql = "SELECT sc.id as schoolid, sc.name as schoolname,sc.atl_id, us.userid FROM {user_school} us LEFT JOIN {school} sc on sc.id=us.schoolid 
                    WHERE us.userid= :user";
            $schoollist = $DB->get_records_sql($sql, array("user"=>$mentor->id));
        
        if (!empty($schoollist)) {
            foreach ($schoollist as $school) {
                $tmpdata = new stdClass();
                $tmpdata->name =  $mentor->firstname. ' '.$mentor->lastname;
                $tmpdata->schoolname = $school->schoolname;
                $allmentors[] = $tmpdata;
            }
        } else {
            $tmpdata = new stdClass();
            $tmpdata->name =  $mentor->firstname. ' '.$mentor->lastname;;
            $tmpdata->schoolname = 'NA';
            $allmentors[] = $tmpdata;
        }
    }
    $name = "mentors_schools";
    $allmentors = (object) $allmentors;
    $filename = clean_filename($name);
    $user = new ArrayObject($allmentors);
    $iterator = $user->getIterator();

    $countrecord = 0;
    download_as_dataformat($filename, $format, $headers, $iterator, function ($mentors) {
        global $DB;
        $data = [];
        $data[] = $mentors->name;
        $data[] = $mentors->schoolname;
        return $data;
    });
    exit;
}
