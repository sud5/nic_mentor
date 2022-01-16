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
require_sesskey();
require_login();
global $DB;

if ($format) {
    // Define the headers and columns.
    $headers = [];
    $headers[] = get_string('fullname');
    $headers[] = get_string('email');
    $params = array();
    $fields = "SELECT u.*,ud.scormstatus, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
    $sql = " FROM {user} u "
            . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
            . "WHERE msn=4 and deleted=0 and ud.data='mentor data' group by u.id order by u.id ASC";
    $availablementors = $DB->get_records_sql($fields . $sql, $params);
    $name = "mentorlist";
    $filename = clean_filename($name);
    $user = new ArrayObject($availablementors);
    $iterator = $user->getIterator();

    $countrecord = 0;
    download_as_dataformat($filename, $format, $headers, $iterator, function($user) {
        global $DB;
        $data = array();
        $data[] = $user->firstname.' '.$user->lastname;
        $data[] = $user->email;
        return $data;
    });
    exit;
}
