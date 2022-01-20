<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/mentor_history.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Mentor Database');
$PAGE->set_heading('Mentor Database');
echo $OUTPUT->header();
echo $OUTPUT->heading("Mentor History");

$params = array();
$countfields = 'SELECT COUNT(mu.id)';
$fields = "SELECT msr.*, s.name as state, mu.id as mentorid,mu.email,mu.city, mu.firstname,mu.lastname, CONCAT(mu.firstname,' ',mu.lastname) as mentorname,ms.name as schoolname,ms.id as schoolid,ms.atl_id as schoolatlid";
$sql = " FROM {mentor_sessionrpt} msr join {user} mu on mu.id=msr.mentorid join {school} ms on msr.schoolid=ms.id left join {state} s on s.id=mu.aim WHERE mu.deleted=0";
$availablementors = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allavailablementors = $DB->get_records_sql($fields . $sql , $params);

$renderer = $PAGE->get_renderer('local_mentor');
echo $renderer->mentor_history_filter();
echo html_writer::start_div('mentor-history-report');
echo $renderer->mentor_history_display($availablementors, count($allavailablementors), $page, $perpage, array());
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/mentorhistory', 'setup');
echo $OUTPUT->footer();


