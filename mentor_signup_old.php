<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../../config.php';
require_once('classes/mentor_signup_form.php');

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/mentor_signup.php');
$PAGE->set_title('Mentor');
$PAGE->set_heading('Mentor');

//Instantiate simplehtml_form 
$mform = new \mentor_signup_form();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
} else if ($fromform = $mform->get_data()) {
//    print_object($fromform);die;
    global $DB;
    $data = new stdClass();
    $data->firstname = $fromform->firstname;
    $data->lastname = $fromform->lastname;
    $data->email = $fromform->email;
    $data->gender = $fromform->gender;
    $data->dob = $fromform->dob;
    $statename = $DB->get_field('state', 'name', array('id'=> $fromform->state));
    $data->state = $statename;
    $cityname = $DB->get_field('city', 'name', array('id'=>$fromform->cityid, 'stateid'=> $fromform->state));
    $data->city = $cityname;
    $data->linkedin = $fromform->linkedin;
    $data->fburl = $fromform->fburl;
    $data->status = 0;
    $data->timemodified = time();
    $data->timecreated = time();
    $DB->insert_record('mentor_request', $data);
    $url =new moodle_url('/local/mentor/mentor_signup.php');
    redirect($url, get_string('requestmessage', 'local_mentor'));
    //In this case you process validated data. $mform->get_data() returns data posted in form.
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.
    //Set default data (if any)
//    print_object($mform);die;
//  $mform->set_data($toform);
    //displays the form
}
echo $OUTPUT->header();
$mform->display();
$PAGE->requires->js_call_amd('local_mentor/mentorform', 'setup');
echo $OUTPUT->footer();
