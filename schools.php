<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/schools.php');
$PAGE->set_title('Schools');
$PAGE->set_heading('Schools');
echo $OUTPUT->header();
$params = array();
$countfields = 'SELECT COUNT(u.id)';
$fields = "SELECT ms.*,mus.userid,mus.schoolid,mu.firstname,mu.lastname ";
$sql = " FROM {school} ms 
         LEFT JOIN (SELECT * from {user_school} WHERE role='incharge') mus on mus.schoolid=ms.id 
         LEFT JOIN {user} mu on mu.id=mus.userid WHERE ms.activestatus=1 and mu.deleted=0";
//$totalmentors = $DB->count_records_sql($countfields . $sql, $params);
$schools = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allschools = $DB->get_records_sql($fields . $sql , $params);

$renderer = $PAGE->get_renderer('local_mentor');
//echo $renderer->mentor_list_filter();
echo html_writer::start_div('school-list-report');
echo $renderer->school_display($schools, count($allschools), $page, $perpage);
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/mentorlist', 'setup');
echo $OUTPUT->footer();
