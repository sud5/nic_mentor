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
echo $OUTPUT->heading("Mentor Database");

$params = array();
$fields = "SELECT u.*,ud.scormstatus, u.id as mentorid, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
$sql = " FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' group by u.id order by u.id ASC";
$availablementors = $DB->get_records_sql($fields . $sql , $params, ($page * $perpage), $perpage);
$allavailablementors = $DB->get_records_sql($fields . $sql , $params);

$renderer = $PAGE->get_renderer('local_mentor');
echo $renderer->mentor_history_filter();
echo html_writer::start_div('mentor-history-report');
echo $renderer->mentor_history_display($availablementors, count($allavailablementors), $page, $perpage, array());
echo html_writer::end_div();
$PAGE->requires->js_call_amd('local_mentor/mentorhistory', 'setup');
echo $OUTPUT->footer();


