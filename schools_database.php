<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/schools.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Schools');

$params = array();
$countfields = 'SELECT COUNT(u.id)';
$fields = "SELECT ms.*,mus.userid,mus.schoolid,mu.firstname,mu.lastname ";
$sql = " FROM {school} ms 
         LEFT JOIN (SELECT * from {user_school} WHERE role='incharge') mus on mus.schoolid=ms.id 
         LEFT JOIN {user} mu on mu.id=mus.userid WHERE ms.activestatus=1 and mu.deleted=0";
$schools = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allschools = $DB->get_records_sql($fields . $sql , $params);

echo $OUTPUT->header();
echo $OUTPUT->heading('School-Database');
$renderer = $PAGE->get_renderer('local_mentor');
echo $renderer->school_database_filter();
echo html_writer::start_div('school-database-report');
echo $renderer->school_database($schools, count($allschools), $page, $perpage, $params);
echo html_writer::end_div();
echo $renderer->custom_modal();
$PAGE->requires->js_call_amd('local_mentor/schoolsdatabase', 'setup');
echo $OUTPUT->footer();
