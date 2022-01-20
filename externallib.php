<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * External local_learningpointsystem API
 *
 * @package    local_learningpointsystem
 * @since      Moodle 3.5
 * @copyright  2018 Sumit Negi
 */
defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/externallib.php");
require_once("$CFG->dirroot/user/externallib.php");

class local_mentor_external extends external_api {
    /*
     * 
     */

    public static function get_mentor_report_parameters() {
        return new external_function_parameters(
                array(
                   'page' => new external_value(PARAM_INT, 'page'),
                   'email' => new external_value(PARAM_RAW, 'email'),
                   'city' => new external_value(PARAM_RAW, 'city'),
                   'state' => new external_value(PARAM_RAW, 'state'),
                )
        );
    }

    public static function get_mentor_report($page, $email, $city, $state) {
        global $DB, $CFG, $PAGE;
        $params = self::validate_parameters(self::get_mentor_report_parameters(), array('page' => $page, 'email' => $email, 'city' => $city, 'state' =>  $state));
        $context = context_system::instance();
        $PAGE->set_context($context);
        $where = '';
//        if(!empty($params['pfnumber'])){
//            $pfnumber = $params['pfnumber'];
//            $where .= " AND u.idnumber LIKE '%".$pfnumber."%'";
//        }
        if(!empty($params['email'])){
            $fullname = $params['email'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND u.email LIKE  '%".$email."%'";
        }
         if(!empty($params['city'])){
            $city = $params['city'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND u.city LIKE  '%".$city."%'";
        }
        if(!empty($params['state'])){
            $state = $params['state'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND s.id = $state";
        }
        $perpage= 20;
        $mentorparams = array();
        $countfields = 'SELECT COUNT(u.id)';
        $fields = "SELECT u.*,ud.scormstatus, s.name as state, CONCAT(u.firstname, ' ', u.lastname) as fullname, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
        $sql = " FROM {user} u "
                . " left join {user_info_data} ud on ud.userid=u.id left join mdl_state s on s.id=u.aim left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
                . "WHERE msn=4 and deleted=0 and ud.data='mentor data'". $where." group by u.id order by u.id ASC";
//        $totalmentors = $DB->count_records_sql($countfields . $sql, $mentorparams);
//       echo $fields . $sql;die;
                
        $availablementors = $DB->get_records_sql($fields . $sql, $mentorparams, ($page * $perpage), $perpage);
        $totalavailablementors = $DB->get_records_sql($fields . $sql, $mentorparams);
       
        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->mentor_report_display($availablementors, count($totalavailablementors), $page, $perpage);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_mentor_report_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }
    
    
public static function get_inactive_mentor_parameters() {
        return new external_function_parameters(
                array(
                   'page' => new external_value(PARAM_INT, 'page'),
                   'email' => new external_value(PARAM_RAW, 'email'),
                   'city' => new external_value(PARAM_RAW, 'city'),
                   'state' => new external_value(PARAM_RAW, 'state'),
                )
        );
    }

    public static function get_inactive_mentor($page, $email, $city, $state) {
        global $DB, $CFG, $PAGE;
        $params = self::validate_parameters(self::get_inactive_mentor_parameters(), array('page' => $page, 'email' => $email, 'city' => $city, 'state' =>  $state));
        $context = context_system::instance();
        $PAGE->set_context($context);
        $where = '';
//        if(!empty($params['pfnumber'])){
//            $pfnumber = $params['pfnumber'];
//            $where .= " AND u.idnumber LIKE '%".$pfnumber."%'";
//        }
        if(!empty($params['email'])){
            $email = $params['email'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND u.email LIKE  '%".$email."%'";
        }
         if(!empty($params['city'])){
            $city = $params['city'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND u.city LIKE  '%".$city."%'";
        }
        if(!empty($params['state'])){
            $state = $params['state'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND s.id = $state";
        }
        $perpage= 20;
        $duration = 90*24*60*60;
        $time = time()- $duration;
        $mentorparams = array();
        $countfields = 'SELECT COUNT(u.id)';
        $fields = "SELECT u.*,ud.scormstatus, s.name as state, CONCAT(u.firstname, ' ', u.lastname) as fullname, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
        $sql = " FROM {user} u "
                . " left join {user_info_data} ud on ud.userid=u.id left join mdl_state s on s.id=u.aim left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
                . "WHERE msn=4 and deleted=0 and ud.data='mentor data' and u.lastaccess < $time". $where." group by u.id order by u.id ASC";
//        $totalmentors = $DB->count_records_sql($countfields . $sql, $mentorparams);
//       echo $fields . $sql;die;
                
        $availablementors = $DB->get_records_sql($fields . $sql, $mentorparams, ($page * $perpage), $perpage);
        $totalavailablementors = $DB->get_records_sql($fields . $sql, $mentorparams);
       
        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->inactive_mentor_report_display($availablementors, count($totalavailablementors), $page, $perpage);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_inactive_mentor_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }

    public static function get_mentor_sessions_parameters() {
        return new external_function_parameters(
                array(
                   'page' => new external_value(PARAM_INT, 'page'),
                   'email' => new external_value(PARAM_RAW, 'email'),
                   'city' => new external_value(PARAM_RAW, 'city'),
                   'state' => new external_value(PARAM_RAW, 'state'),

                )
        );
    }

    public static function get_mentor_sessions($page, $email, $city, $state) {
        global $DB, $CFG, $PAGE;
        $params = self::validate_parameters(self::get_mentor_sessions_parameters(), array('page' => $page, 'email' => $email, 'city' => $city, 'state' =>  $state));
        $context = context_system::instance();
        $PAGE->set_context($context);
        $where = '';
//        if(!empty($params['pfnumber'])){
//            $pfnumber = $params['pfnumber'];
//            $where .= " AND u.idnumber LIKE '%".$pfnumber."%'";
//        }
        if(!empty($params['email'])){
            $email = $params['email'];
//            $where .= " AND CONCAT(u.firstname,' ',u.lastname)  LIKE  '%".$fullname."%'";
            $where .= " AND mu.email LIKE  '%".$email."%'";
        }
        if(!empty($params['city'])){
            $city = $params['city'];
            $where .= " AND mu.city LIKE  '%".$city."%'";
        }
        if(!empty($params['state'])){
            $state = $params['state'];
            $where .= " AND s.id = $state";
        }
        $perpage= 20;
        $mentorparams = array();
        $countfields = 'SELECT COUNT(u.id)';
        $fields = "SELECT msr.*, s.name as state, mu.id as mentorid,mu.email,mu.city, mu.firstname,mu.lastname, CONCAT(mu.firstname,' ',mu.lastname) as mentorname,ms.name as schoolname,ms.id as schoolid,ms.atl_id as schoolatlid";
        $sql = " FROM `mdl_mentor_sessionrpt` msr join mdl_user mu on mu.id=msr.mentorid join mdl_school ms on msr.schoolid=ms.id left join mdl_state s on s.id=mu.aim WHERE mu.deleted=0 $where";
//        $totalmentors = $DB->count_records_sql($countfields . $sql, $mentorparams);
//       echo $fields . $sql;die;
                
        $availablementors = $DB->get_records_sql($fields . $sql, $mentorparams, ($page * $perpage), $perpage);
        $totalavailablementors = $DB->get_records_sql($fields . $sql, $mentorparams);
       
        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->mentor_session_report_display($availablementors, count($totalavailablementors), $page, $perpage);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_mentor_sessions_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }
    
     /*
     * State or city filter
     */

    public static function school_list_parameters() {
        return new external_function_parameters(
                array(
                    'page' => new external_value(PARAM_INT, 'page'),
                    'name' => new external_value(PARAM_RAW, 'name')
                )
        );
    }

    /*
     * Function To display select data
     */

    public static function school_list($page, $name) {
        global $DB, $PAGE;
        $params = self::validate_parameters(self::school_list_parameters(), array('page' => $page, 'name' => $name));
        $out = '';
        $context = \context_system::instance();
        $PAGE->set_context($context);
        $perpage = 20;
        $attrparams = array();
        
        $where = '';
        if(!empty($params['name'])){
            $where = " AND ms.name LIKE '%".$params['name']."%'";
            $attrparams['name'] = $params['name'];
        }
        $fields = "SELECT ms.*,mus.userid,mus.schoolid,mu.firstname,mu.lastname ";
        $sql = " FROM {school} ms 
                 LEFT JOIN (SELECT * from {user_school} WHERE role='incharge') mus on mus.schoolid=ms.id 
                 LEFT JOIN {user} mu on mu.id=mus.userid WHERE ms.activestatus=1 and mu.deleted=0 $where";
        $schools = $DB->get_records_sql($fields . $sql , array(), ($page * $perpage), $perpage);
        $allschools = $DB->get_records_sql($fields . $sql , array());

        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->school_display($schools, count($allschools), $page, $perpage, $attrparams);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function school_list_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }
    
     /*
     * Mentor with schools list
     */

    public static function mentor_school_list_parameters() {
        return new external_function_parameters(
                array(
                    'page' => new external_value(PARAM_INT, 'page'),
                    'email' => new external_value(PARAM_RAW, 'email')
                )
        );
    }

    /*
     * Function To display select data
     */

    public static function mentor_school_list($page, $email) {
        global $DB, $PAGE;
        $params = self::validate_parameters(self::mentor_school_list_parameters(), array('page' => $page, 'email' => $email));
        $out = '';
        $context = \context_system::instance();
        $PAGE->set_context($context);
        $perpage = 20;
        $attrparams = array();
        
        $where = '';
        if(!empty($params['email'])){
            $where = " AND u.email LIKE '%".$params['email']."%'";
            $attrparams['email'] = $params['email'];
        }
        $fields = "SELECT u.*, ud.scormstatus,u.id as mentorid, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
        $sql = " FROM {user} u "
                . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
                . " WHERE msn=4 and deleted=0 and ud.data='mentor data' $where GROUP BY u.id ORDER BY u.id ASC";
        $availablementors = $DB->get_records_sql($fields . $sql , array(), ($page * $perpage), $perpage);
        $allavailablementors = $DB->get_records_sql($fields . $sql , array());

        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->mentor_schools_display($availablementors, count($allavailablementors), $page, $perpage, $attrparams);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function mentor_school_list_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }
     /*
     * Mentor with schools list
     */

    public static function mentor_history_parameters() {
        return new external_function_parameters(
                array(
                    'page' => new external_value(PARAM_INT, 'page'),
                    'email' => new external_value(PARAM_RAW, 'email')
                )
        );
    }

    /*
     * Function To display select data
     */

    public static function mentor_history($page, $email) {
        global $DB, $PAGE;
        $params = self::validate_parameters(self::mentor_history_parameters(), array('page' => $page, 'email' => $email));
        $out = '';
        $context = \context_system::instance();
        $PAGE->set_context($context);
        $perpage = 20;
        $attrparams = array();
        
        $where = '';
        if(!empty($params['email'])){
            $where = " AND u.email LIKE '%".$params['email']."%'";
            $attrparams['email'] = $params['email'];
        }
        $fields = "SELECT u.*,ud.scormstatus, u.id as mentorid, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
        $sql = " FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' $where group by u.id order by u.id ASC";
        $availablementors = $DB->get_records_sql($fields . $sql , array(), ($page * $perpage), $perpage);
        $allavailablementors = $DB->get_records_sql($fields . $sql , array());
        $renderer = $PAGE->get_renderer('local_mentor');
        $out = "";
        $out .= $renderer->mentor_history_display($availablementors, count($allavailablementors), $page, $perpage, $attrparams);
        $html = array();
        $html['html'] = $out;
        return $html;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function mentor_history_returns() {
        return $data = new external_single_structure([
            'html' => new external_value(PARAM_RAW, 'html')
        ]);
    }
}
