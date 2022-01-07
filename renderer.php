<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('MOODLE_INTERNAL') || die();

class local_mentor_renderer extends plugin_renderer_base {
    /*
     * Mentor list
     */

    public function mentor_report_display($availablementors, $totalmentors, $page, $perpage) {
        global $DB, $CFG, $OUTPUT;
//        \core\session\manager::write_close();
        $out = '';
        $out .= html_writer::tag('p', get_string('noofparticipantscount', 'local_mentor', $totalmentors), array('class' => 'text-black text-right mb-2'));
        if ($totalmentors == 0) {
            return html_writer::div(get_string('nothingtodisplay', 'local_mentor'), 'alert alert-info mt-3');
        }
//        $sql = "select c.id, c.name as cityname, s.name as statename from {city} as c left join {state} as s on c.stateid= s.id";
//        $allavailablecities = $DB->get_records_sql($sql , $params);
//        $availablecity_state = array();
//        foreach($allavailablecities as &$availablecities){
//            $availablecity_state[$availablecities->cityname] = $availablecities->statename;
//        }
        $table = new html_table();
        $table->head = array(get_string('fullname', 'local_mentor'), get_string('email'),get_string('gender','local_mentor'), get_string('city'),get_string('state'));
        $table->attributes = array('class' => 'table');
        $gender = array('m' => 'Male', 'f' => 'Female');
        foreach ($availablementors as $mentor) {
            $data = [];
            $data[] = $mentor->firstname. ' '.$mentor->lastname;
            $data[] = $mentor->email;
            $data[] = $gender[$mentor->gender];
            $data[] = $mentor->city;
            $data[] = $mentor->state;//$availablecity_state[$mentor->city];
            $table->data[] = $data;
        }
        $out .= html_writer::start_tag('div', array('class' => 'db-program-progress no-overflow p-3'));
        $out .= html_writer::table($table);
        $out .= html_writer::end_tag('div');
        $url = new moodle_url('/local/mentor/index.php', array('page' => $page));
        $out .= $OUTPUT->paging_bar($totalmentors, $page, $perpage, $url);
        $params = array();
//        $baseurl = new moodle_url('/local/mentor/download/downloadmentorlist.php', $params);            
//        $out .= html_writer::tag('div', $this->download_buttons($baseurl), array('class' => 'text-white mt-3 mb-3'));
        return $out;
    }

    /*
     * 
     */
        /*
     * Show filter for program report
     */

    function mentor_list_filter() {
      global $DB;
        $output = "";
        $output .= html_writer::start_div('form-inline form-group');
        $output .= html_writer::start_div("row");
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('email', "useremail", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "Email", 'id' => "useremail"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $states = array('Delhi','Goa');
        $sql = "select s.id, s.name as statename from {state} as s";
        $allavailablestates = $DB->get_records_sql($sql);
        $states = array();
        foreach($allavailablestates as &$allavailablestates){
            $states[$allavailablestates->id] = $allavailablestates->statename;
        }
        $output .= html_writer::select($states,'select',null,'Select State',array('id' => "state"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('city', "city", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "City", 'id' => "city"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $url = new moodle_url("index.php");
        $output .= html_writer::link($url,"Reset Filters",array('class' => 'btn btn-secondary'));
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        echo $output;
    }
    

       public function inactive_mentor_report_display($availablementors, $totalmentors, $page, $perpage) {
        global $DB, $CFG, $OUTPUT;
//        \core\session\manager::write_close();
        $out = '';
        $out .= html_writer::tag('p', get_string('noofparticipantscount', 'local_mentor', $totalmentors), array('class' => 'text-black text-right mb-2'));
        if ($totalmentors == 0) {
            return html_writer::div(get_string('nothingtodisplay', 'local_mentor'), 'alert alert-info mt-3');
        }
//        $sql = "select c.id, c.name as cityname, s.name as statename from {city} as c left join {state} as s on c.stateid= s.id";
//        $allavailablecities = $DB->get_records_sql($sql , $params);
//        $availablecity_state = array();
//        foreach($allavailablecities as &$availablecities){
//            $availablecity_state[$availablecities->cityname] = $availablecities->statename;
//        }
        $table = new html_table();
        $table->head = array(get_string('fullname', 'local_mentor'), get_string('email'),get_string('last_active','local_mentor'),get_string('city'),get_string('state'));
        $table->attributes = array('class' => 'table');
        $gender = array('m' => 'Male', 'f' => 'Female');
        foreach ($availablementors as $mentor) {
            $data = [];
            $data[] = $mentor->firstname. ' '.$mentor->lastname;
            $data[] = $mentor->email;
            $data[] = ($mentor->lastaccess == 0)?get_string('never','local_mentor'):date('d-M-Y H:i:s',$mentor->lastaccess);
            $data[] = $mentor->city;
            $data[] = $mentor->state;//$availablecity_state[$mentor->city];
            $table->data[] = $data;
        }
        $out .= html_writer::start_tag('div', array('class' => 'db-program-progress no-overflow p-3'));
        $out .= html_writer::table($table);
        $out .= html_writer::end_tag('div');
        $url = new moodle_url('/local/mentor/index.php', array('page' => $page));
        $out .= $OUTPUT->paging_bar($totalmentors, $page, $perpage, $url);
        $params = array();
//        $baseurl = new moodle_url('/local/mentor/download/downloadmentorlist.php', $params);            
//        $out .= html_writer::tag('div', $this->download_buttons($baseurl), array('class' => 'text-white mt-3 mb-3'));
        return $out;
    }

    /*
     * 
     */
        /*
     * Show filter for program report
     */

    function inactive_mentor_list_filter() {
      global $DB;
        $output = "";
        $output .= html_writer::start_div('form-inline form-group');
        $output .= html_writer::start_div("row");
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('email', "useremail", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "Email", 'id' => "useremail"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $states = array('Delhi','Goa');
        $sql = "select s.id, s.name as statename from {state} as s";
        $allavailablestates = $DB->get_records_sql($sql);
        $states = array();
        foreach($allavailablestates as &$allavailablestates){
            $states[$allavailablestates->id] = $allavailablestates->statename;
        }
        $output .= html_writer::select($states,'select',null,'Select State',array('id' => "state"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('city', "city", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "City", 'id' => "city"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $url = new moodle_url("inactive_mentors.php");
        $output .= html_writer::link($url,"Reset Filters",array('class' => 'btn btn-secondary'));
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        echo $output;
                $url = "Sdfs/sfs";
        $output .= html_writer::link($url,"Reset Filters",array('class' => 'btn btn-secondary'));
    }
    
public function mentor_session_report_display($availablementors, $totalmentors, $page, $perpage) {
        global $DB, $CFG, $OUTPUT;
        $out = '';
        $out .= html_writer::tag('p', get_string('noofparticipantscount', 'local_mentor', $totalmentors), array('class' => 'text-black text-right mb-2'));
        if ($totalmentors == 0) {
            return html_writer::div(get_string('nothingtodisplay', 'local_mentor'), 'alert alert-info mt-3');
        }
        $table = new html_table();
        $table->head = array(get_string('fullname', 'local_mentor'), get_string('email'),get_string('city'),get_string('state'));
        $table->attributes = array('class' => 'table');
        $gender = array('m' => 'Male', 'f' => 'Female');
        foreach ($availablementors as $mentor) {
            $data = [];
            $data[] = $mentor->firstname. ' '.$mentor->lastname;
            $data[] = $mentor->email;
            $data[] = $mentor->city;
            $data[] = $mentor->state;//$availablecity_state[$mentor->city];
            $table->data[] = $data;
        }
        $out .= html_writer::start_tag('div', array('class' => 'db-program-progress no-overflow p-3'));
        $out .= html_writer::table($table);
        $out .= html_writer::end_tag('div');
        $url = new moodle_url('/local/mentor/index.php', array('page' => $page));
        $out .= $OUTPUT->paging_bar($totalmentors, $page, $perpage, $url);
        $params = array();
//        $baseurl = new moodle_url('/local/mentor/download/downloadmentorlist.php', $params);            
//        $out .= html_writer::tag('div', $this->download_buttons($baseurl), array('class' => 'text-white mt-3 mb-3'));
        return $out;
    }

    /*
     * 
     */
        /*
     * Show filter for program report
     */

    function mentor_session_filter() {
      global $DB;
        $output = "";
        $output .= html_writer::start_div('form-inline form-group');
        $output .= html_writer::start_div("row");
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('email', "useremail", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "Email", 'id' => "useremail"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $states = array('Delhi','Goa');
        $sql = "select s.id, s.name as statename from {state} as s";
        $allavailablestates = $DB->get_records_sql($sql);
        $states = array();
        foreach($allavailablestates as &$allavailablestates){
            $states[$allavailablestates->id] = $allavailablestates->statename;
        }
        $output .= html_writer::select($states,'select',null,'Select State',array('id' => "state"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $output .= html_writer::label('city', "city", true, array('class' => "sr-only"));
        $output .= html_writer::tag('input', '', array("type" => "search", "class" => "form-control", "placeholder" => "City", 'id' => "city"));
        $output .= html_writer::end_div();
        $output .= html_writer::start_div("form-group col-xs-6");
        $url = new moodle_url("inactive_mentors.php");
        $output .= html_writer::link($url,"Reset Filters",array('class' => 'btn btn-secondary'));
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        echo $output;
                $url = "Sdfs/sfs";
        $output .= html_writer::link($url,"Reset Filters",array('class' => 'btn btn-secondary'));
    }
    
        public function download_buttons($baseurl) {
        return $this->download_dataformat_selector(get_string('downloadas', 'table'), $baseurl->out_omit_querystring(), 'dataformat', $baseurl->params());
    }
}
