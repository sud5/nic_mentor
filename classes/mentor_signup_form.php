<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class mentor_signup_form extends moodleform {

    //Add elements to form
    public function definition() {
        global $CFG, $DB;

        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('text', 'firstname', get_string('firstname')); // Add elements to your form
        $mform->setType('firstname', PARAM_TEXT);
        $mform->addRule('firstname', null, 'required', null, 'client');
        $mform->addRule('firstname', null, 'required', null, 'server');
        $mform->addElement('text', 'lastname', get_string('lastname')); // Add elements to your form
        $mform->setType('lastname', PARAM_TEXT);
        $mform->addRule('lastname', null, 'required', null, 'client');
        $mform->addRule('lastname', null, 'required', null, 'server');
        $mform->addElement('text', 'email', get_string('email')); // Add elements to your form
        $mform->setType('email', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('email', null, 'required', null, 'client');
        $mform->addRule('email', null, 'required', null, 'server');
//        $mform->setDefault('email', 'Please enter email');        //Default value
        
        $gender = array('M' => "Male", 'F' => "Female");
        $mform->addElement('select', 'gender', get_string('gender', 'local_mentor'), $gender); // Add elements to your form
        $mform->addRule('gender', null, 'required', null, 'client');
        $mform->addElement('date_selector', 'dob', get_string('dob', 'local_mentor')); // Add elements to your form
        $mform->addRule('dob', null, 'required', null, 'client');
        $select = array('0' => "Select state");
        $state = $DB->get_records_menu('state', array());
        $state = array_merge($select, $state);
        $mform->addElement('select', 'state', get_string('state', 'local_mentor'), $state);
        $mform->addRule('state', null, 'required', null, 'client');
        if(isset($_POST['state'])){
             $mform->setDefault('state', $_POST['state']);
        }
        $cities = array('0' => "Select city");
        if(isset($_POST['city'])){
            $cities = $DB->get_records_menu('city', array('stateid' => $_POST['state']));
        }
//        $cities = array_merge($select, $cities);
        $mform->addElement('select', 'city', get_string('city', 'local_mentor'), $cities);
        $mform->addRule('city', null, 'required', null, 'client');
        if(isset($_POST['city'])){
             $mform->setDefault('cityid', $_POST['city']);
        }
        
        $mform->addElement('text', 'linkedin', get_string('linkedin', 'local_mentor')); // Add elements to your form
        $mform->setType('linkedin', PARAM_TEXT);
        $mform->addElement('text', 'fburl', get_string('fburl', 'local_mentor')); // Add elements to your form
        $mform->setType('fburl', PARAM_TEXT);
//        $mform->addElement('hidden', 'stateid', 0, array('id'=>"stateid"));
//        $mform->setType('stateid', PARAM_INT);
        
        $mform->addElement('hidden', 'cityid', 0, array('id' => "cityid"));
        $mform->setType('cityid', PARAM_INT);
        $this->add_action_buttons(true, get_string('submit'));
//        $mform->setType('email', PARAM_TEXT);
//        $this->set_data($data);
        $mform->disable_form_change_checker();
    }

    //Custom validation should be added here
    function validation($data, $files) {
        global $DB;
//        print_object($data);die;
        $errors = array();
        $select = $DB->sql_equal('email', ':email', false);
        $params = array(
            'email' => $data['email']
        );
        if (!validate_email($data['email'])) {
            $errors['email'] = get_string('invalidemail');
        } else if ($DB->get_record('mentor_request', array('email' => $data['email'], 'status' => 0))) {
            $errors['email'] = get_string('alreadyrequested', 'local_mentor');
        } else if ($DB->record_exists_select('user', $select, $params)) {
            $errors['email'] = get_string('emailexists');
        }
        if($data['state'] == 0){
            $errors['state'] = get_string('missingstate', 'local_mentor');
        }
        if(!isset($_POST['city']) || $_POST['city'] ==0 || $data['city'] == 0){
            $errors['city'] = get_string('missingcity', 'local_mentor');
        }
        $lasttwntyfour = time() - 86400;
        if($data['dob']>= $lasttwntyfour){
             $errors['dob'] = get_string('errordob', 'local_mentor');
        }
        return $errors;
    }
    
     public function definition_after_data() {
//          print_object($data);die;
      }

}
