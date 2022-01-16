<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Popup download
 */

require(__DIR__ . '../../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/dataformatlib.php');
$format = optional_param('dataformat', '', PARAM_TEXT);
$mentorid = optional_param('reportid', '', PARAM_ALPHANUMEXT);
require_login();
global $DB;

if ($format) {
    $where = '';
    if (!empty($name)) {
        $where = " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%" . $name . "%'";
    }
    // Define the headers and columns.
    $headers = [];
    $headers[] = get_string('mentorsname', 'local_mentor');
    $headers[] = get_string('schoolname', 'local_mentor');
    $sql = "SELECT sc.id as schoolid, sc.name as schoolname,sc.atl_id, us.userid FROM {user_school} us LEFT JOIN {school} sc on sc.id=us.schoolid 
                    WHERE us.userid= :user";
    $schoollist = $DB->get_records_sql($sql, array("user" => $mentorid));
    $mentorname = $DB->get_record('user', array('id'=> $mentorid));
    $mentorname = $mentorname->firstname.' '.$mentorname->lastname;
    $allmentors = [];
    if (!empty($schoollist)) {
        foreach ($schoollist as $school) {
            $tmpdata = new stdClass();
            $tmpdata->name = $mentorname;
            $tmpdata->schoolname = $school->schoolname;
            $allmentors[] = $tmpdata;
        }
    }
    $name = $mentorname;
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
