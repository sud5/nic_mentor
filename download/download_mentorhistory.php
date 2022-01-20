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
$email = optional_param('email', '', PARAM_ALPHANUMEXT);
require_sesskey();
require_login();
global $DB;

if ($format) {
    $where = '';
    if (!empty($email)) {
        $where = " AND mu.email LIKE  '%" . $email . "%'";
    }
    // Define the headers and columns.
    $headers = array(get_string('fullname', 'local_mentor'), get_string('email'), get_string('noofschool', 'local_mentor'),
        get_string('noofsession', 'local_mentor'), get_string('mentoringhours', 'local_mentor'));

    $fields = "SELECT msr.*, s.name as state, mu.id as mentorid,mu.email,mu.city, mu.firstname,mu.lastname, CONCAT(mu.firstname,' ',mu.lastname) as mentorname,ms.name as schoolname,ms.id as schoolid,ms.atl_id as schoolatlid";
    $sql = " FROM {mentor_sessionrpt} msr join {user} mu on mu.id=msr.mentorid join {school} ms on msr.schoolid=ms.id left join {state} s on s.id=mu.aim "
            . " WHERE mu.deleted=0 $where";
    $availablementors = $DB->get_records_sql($fields . $sql, array());
    $name = "mentors_history";
    $allmentors = $availablementors;
    $filename = clean_filename($name);
    $user = new ArrayObject($allmentors);
    $iterator = $user->getIterator();

    $countrecord = 0;
     \core\dataformat::download_data($filename, $format, $headers, $iterator, function ($mentor) {
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
        return $data;
    });
    exit;
}
