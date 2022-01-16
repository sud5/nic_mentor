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
$schoolid = optional_param('reportid', '', PARAM_INT);
require_login();
global $DB;

if ($format) {
    // Define the headers and columns.
    $headers = [];
    $headers[] = get_string('schoolname', 'local_mentor');
    $headers[] = get_string('mentors', 'local_mentor');
    $mentordata = $DB->get_records_sql("SELECT mus.id,mu.id as userid,mu.firstname FROM {user_school} mus JOIN {user} mu on mu.id=mus.userid WHERE mus.schoolid=$schoolid and role='mentor'");
    $school = $DB->get_record('school', array('id'=>$schoolid));
    $schoolname = $school->name;
    $mentors = [];
    if (!empty($mentordata)) {
        foreach ($mentordata as $mentor) {
            $tmpdata = new stdClass();
            $tmpdata->name = $schoolname;
            $tmpdata->firstname = $mentor->firstname;
            $mentors[] = $tmpdata;
        }
    } else {
        $tmpdata = new stdClass();
        $tmpdata->name = $school->name;
        $tmpdata->firstname = 'NA';
        $mentors[] = $tmpdata;
    }
    $name = $schoolname;
    $mentors = (object) $mentors;
    $filename = clean_filename($name);
    $user = new ArrayObject($mentors);
    $iterator = $user->getIterator();

    $countrecord = 0;
    download_as_dataformat($filename, $format, $headers, $iterator, function ($mentor) {
        global $DB;
        $data = [];
        $data[] = $mentor->name;
        $data[] = $mentor->firstname;
        return $data;
    });
    exit;
}