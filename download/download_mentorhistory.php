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
$email = optional_param('email', '', PARAM_TEXT);
require_sesskey();
require_login();
global $DB;

if ($format) {
    $where = '';
    if (!empty($email)) {
        $where = " AND u.email LIKE  '%" . $email . "%'";
    }
    // Define the headers and columns.
    $headers = array(get_string('fullname', 'local_mentor'), get_string('email'), get_string('noofschool', 'local_mentor'),
        get_string('noofsession', 'local_mentor'), get_string('mentoringhours', 'local_mentor'));

    $fields = "SELECT u.*,ud.scormstatus, u.id as mentorid, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
    $sql = " FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' $where group by u.id order by u.id ASC";
    $availablementors = $DB->get_records_sql($fields . $sql, array());
    $name = "mentors_database";
    $allmentors = $availablementors;
    $filename = clean_filename($name);
    $user = new ArrayObject($allmentors);
    $iterator = $user->getIterator();

    $countrecord = 0;
     download_as_dataformat($filename, $format, $headers, $iterator, function ($mentor) {
        global $DB;
        $data = [];
        $sql = "SELECT count(totaltime) as noofsession, count(DISTINCT(schoolid)) as noofschool, SUM(totaltime) as mentoringhours "
                . "  FROM {mentor_sessionrpt} WHERE mentorid = :userid";
        $schoolinfo = $DB->get_record_sql($sql, array("userid" => $mentor->mentorid));
        $data[] = $mentor->firstname . ' ' . $mentor->lastname;
        $data[] = $mentor->email;
        $sql = "SELECT sc.id as schoolid, sc.name as schoolname,sc.atl_id, us.userid FROM {user_school} us LEFT JOIN {school} sc on sc.id=us.schoolid 
                    WHERE us.userid= :user";
        $schoollist = $DB->get_records_sql($sql, array("user" => $mentor->mentorid));
        $data[] = count($schoollist);
        $data[] = $schoolinfo->noofsession;
        $data[] = $schoolinfo->mentoringhours ? $schoolinfo->mentoringhours : 0;
        $data[] = ($mentor->lastaccess == 0)?get_string('never','local_mentor'):date('d-M-Y H:i:s',$mentor->lastaccess);
        return $data;
    });
    exit;
}
