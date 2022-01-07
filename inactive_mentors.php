<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/mentor/inactive_mentors.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Inactive Mentors');
$PAGE->set_heading('Inactive Mentors');
echo $OUTPUT->header();
echo $OUTPUT->heading("Inactive Mentor List:");

$params = array();
$duration = 90*24*60*60;
$time = time()- $duration;
$countfields = 'SELECT COUNT(u.id)';
$fields = "SELECT u.*,ud.scormstatus, s.name as state, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
$sql = " FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join mdl_state s on s.id=u.aim left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' and u.lastaccess < $time group by u.id order by u.id ASC";
//$totalmentors = $DB->count_records_sql($countfields . $sql, $params);
$availablementors = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allavailablementors = $DB->get_records_sql($fields . $sql , $params);

$renderer = $PAGE->get_renderer('local_mentor');
echo $renderer->inactive_mentor_list_filter();
echo html_writer::start_div('inactive-mentor-user-report');
echo $renderer->inactive_mentor_report_display($availablementors, count($allavailablementors), $page, $perpage);
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/inactivementor', 'setup');
echo $OUTPUT->footer();


