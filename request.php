<?php

require_once '../../config.php';
require_once 'lib.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/request.php');
$PAGE->set_title('Mentor Request');
$PAGE->set_heading('Mentor account request');
echo $OUTPUT->header();
echo $OUTPUT->heading("Mentor Requests");
$params = array();

$availablementors = $DB->count_records("mentor_request");
$allavailablementors = $DB->get_records("mentor_request", $params, "timecreated DESC", '*', ($page * $perpage), $perpage);

$renderer = $PAGE->get_renderer('local_mentor');
echo html_writer::start_div('mentor-request-list');
echo $renderer->mentor_request_display($allavailablementors, $availablementors, $page, $perpage);
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/mentorform', 'setup');
echo $OUTPUT->footer();

