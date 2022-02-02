<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
require_login();
$context = context_system::instance();
//print_object($_POST);die();
$data = new stdClass();
$data->firstname = $_POST['firstname'];
$data->lastname = $_POST['lastname'];
$data->email = $_POST['email'];
$data->gender = $_POST['gender'];
$data->dob = $_POST['dob'];
$statename = '';//$DB->get_field('state', 'name', array('id'=> $fromform->state));
$data->state = '';$statename;
$cityname = $DB->get_field('city', 'name', array('id'=>$fromform->cityid, 'stateid'=> $fromform->state));
$data->city = $cityname;
$data->linkedin = $_POST['linkedinurl'];
$data->fburl = $_POST['blogposturl'];
$data->status = 0;
$data->timemodified = time();
$data->timecreated = time();
$DB->insert_record('mentor_request', $data);
$url =new moodle_url('/local/mentor/mentor_signup.php');
redirect($url, get_string('requestmessage', 'local_mentor'));
?>