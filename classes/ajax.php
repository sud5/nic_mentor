<?php

require_once '../../../config.php';
require_once '../lib.php';

$action = required_param('action', PARAM_TEXT);
$context = context_system::instance();
$PAGE->set_context($context);
global $DB;

switch ($action) {
    case 'city':
        $stateid = required_param('state', PARAM_INT);
        $cities = $DB->get_records_menu('city', array('stateid' => $stateid));
        $out = '';
        if (!empty($cities)) {
            foreach ($cities as $id => $value) {
                $out .= html_writer::tag('option', $value, array('value' => $id));
            }
        }

        $html = array();
        $html['html'] = $out;
        echo $out;
        break;
    case "approve":
        $mentorid = required_param('mentor', PARAM_INT);
        $status = required_param('status', PARAM_TEXT);
        $mentor = $DB->get_record('mentor_request', array('id' => $mentorid));
        if (strtolower($status) == "deny") {
            $mentor->status = DENY;
            $DB->update_record('mentor_request', $mentor);
            echo "Deny";
        } else if (strtolower($status) == "allow") {
             $id  = create_mentor($mentor);
             if($id){
                 $mentor->status = APPROVE;
                 $DB->update_record('mentor_request', $mentor);
             }
        }

        break;
    case "pagination":
      
        $page = required_param('page', PARAM_INT);
        $perpage = optional_param('perpage', 20, PARAM_INT);
        $params = array();

        $availablementors = $DB->count_records("mentor_request");
        $allavailablementors = $DB->get_records("mentor_request", $params, "timecreated DESC", '*', ($page * $perpage), $perpage);

        $renderer = $PAGE->get_renderer('local_mentor');
        echo $renderer->mentor_request_display($allavailablementors, $availablementors, $page, $perpage);

        break;
    default:
}