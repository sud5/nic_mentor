<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/mentor_sessions.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Mentor Sessions');
$PAGE->set_heading('Mentor Sessions');
echo $OUTPUT->header();
echo $OUTPUT->heading("Mentor Sessions:");

$params = array();
$countfields = 'SELECT COUNT(mu.id)';
$fields = "SELECT msr.*, s.name as state, mu.id as mentorid,mu.email,mu.city, mu.firstname,mu.lastname, CONCAT(mu.firstname,' ',mu.lastname) as mentorname,ms.name as schoolname,ms.id as schoolid,ms.atl_id as schoolatlid";
$sql = " FROM `mdl_mentor_sessionrpt` msr join mdl_user mu on mu.id=msr.mentorid join mdl_school ms on msr.schoolid=ms.id left join mdl_state s on s.id=mu.aim WHERE mu.deleted=0";
//$totalmentors = $DB->count_records_sql($countfields . $sql, $params);
$availablementors = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allavailablementors = $DB->get_records_sql($fields . $sql , $params);

$renderer = $PAGE->get_renderer('local_mentor');
echo $renderer->mentor_session_filter();
echo html_writer::start_div('mentor-session-report');
echo $renderer->mentor_session_report_display($availablementors, count($allavailablementors), $page, $perpage);
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/mentorsessions', 'setup');
echo $OUTPUT->footer();


