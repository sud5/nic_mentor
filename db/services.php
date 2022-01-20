<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$functions = array(
    'local_mentor_get_mentor_report' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'get_mentor_report',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users to enrol',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    ),
   'local_mentor_get_inactive_mentor' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'get_inactive_mentor',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users which are inactive',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    ),
     'local_mentor_session_report' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'get_mentor_sessions',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users which are inactive',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    ),
      'local_school_list' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'school_list',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users to enrol',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    ),
    'local_mentor_school_list' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'mentor_school_list',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users to enrol',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    ),
    'local_mentor_mentor_history' => array(
        'classname' => 'local_mentor_external',
        'methodname' => 'mentor_history',
        'classpath' => 'local/mentor/externallib.php',
        'description' => 'Get the list of potential users to enrol',
        'ajax' => true,
        'type' => 'read',
        'capabilities' => 'local/mentor:approve_request',
    )
   
);
