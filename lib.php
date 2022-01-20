<?php

defined('MOODLE_INTERNAL') || die();
/**
 * 
 */
define('DENY', 2);
/*
 * 
 */
define('APPROVE', 1);

function create_mentor($mentordata) {
    global $DB;
    $id = 0;
    $data = new stdClass();
    $infodata = new stdClass();
    $mentor_roleid = atal_get_roleidbyname("mentor");
    $data->auth = 'manual';
    $data->confirmed = '1';
    $data->mnethostid = '1';
    $data->username = trim($mentordata->email);
    $ran = generate_randomstring();
    $data->passraw = $ran;
    $data->password = hash_internal_user_password($ran);
    $data->idnumber = 'mentor';
    $data->firstname = trim(ucwords(strtolower($mentordata->firstname)));
    $data->lastname = trim(ucwords(strtolower($mentordata->lastname)));
    $data->email = trim($mentordata->email);
    $data->skype = '';
    $data->yahoo = $mentordata->dob;
    $data->aim = $mentordata->state;
    $data->msn = $mentor_roleid;
    $data->phone1 = '';
    $data->phone2 = '';
    $data->institution = ucwords(trim($mentordata->institute, "'"));
    $data->department = ucwords(trim($mentordata->areaspec, "'"));
    $data->address = '';
//    $city = $DB->get_field('city', 'name', array('id'=));
    $data->city = $mentordata->city;
    $data->country = 'IN';
    $data->theme = '';
    $data->timezone = '99';
    $data->icq = "newuser";
    $data->lastip = '';
    $data->secret = '';
    $data->url  = isset($mentordata->linkedin)?$mentordata->linkedin:'';
    $data->description = ucwords(trim($mentordata->summary, "'"));
    $data->timecreated = time();
    $data->timemodified = time();
    $data->lastnamephonetic  = isset($mentordata->degree)?$mentordata->degree:'';
    $data->firstnamephonetic  =  isset($mentordata->registeras)?strtolower($mentordata->registeras):'';
    $data->middlename  = isset($mentordata->yoc)?strtolower($mentordata->yoc):'';
//    $data->alternatename = $langidstr ;
    //	if($mentordata->gender=='Male')
    //	$data->gender = 'm';
    //elseif($mentordata->gender=='Trans')
    //	$data->gender = 't';
    //else
    //	$data->gender = 'f';
    $last_atl = get_LastATL_userid();
    $data->atl_userid = 'ATLM' . $last_atl;
    //Details For Mentor India & Refreence check info
    $infodata = new stdClass();
    $infodata->schoolid = isset($schoolid) ? $schoolid : null ;
    $infodata->timecommitperday = isset($mentordata->timecommit) ? $mentordata->timecommit : '';
    $infodata->possibleareaofinterven = trim($mentordata->areacont, "'");
    $mentordata->otherschool = 'null';
    if (strtolower($mentordata->otherschool) == 'null' || strtolower($mentordata->otherschool) == 'no')
        $infodata->otherschooloption = 'n';
    $infodata->whymentor = trim($mentordata->words, "'");
    $infodata->refree1_name = isset($mentordata->ref1name) ? $mentordata->ref1name : '';
    $infodata->refree1_contact = isset($mentordata->ref1contact) ? $mentordata->ref1contact : '';
    //$infodata->refree1_email  =isset($mentordata->ref1email)?substr($mentordata->ref1email, 0, -4):'';
    $infodata->refree1_email = isset($mentordata->ref1email) ? trim($mentordata->ref1email) : '';
    $infodata->refree1_know = isset($mentordata->ref1how) ? $mentordata->ref1how : '';
    $infodata->refree2_name = isset($mentordata->ref2name) ? $mentordata->ref2name : '';
    $infodata->refree2_contact = isset($mentordata->ref2contact) ? $mentordata->ref2contact : '';
    //$infodata->refree2_email  =isset($mentordata->ref2email)?substr($mentordata->ref2email, 0, -4):'';
    $infodata->refree2_email = isset($mentordata->ref2email) ? trim($mentordata->ref2email) : '';
    $infodata->refree2_know = isset($mentordata->ref2how) ? $mentordata->ref2how : '';
    $infodata->hearaboutmentor = isset($mentordata->hearabout) ? $mentordata->hearabout : '';
    if ($mentordata->company == 'na')
        $infodata->company = '';
    else
        $infodata->company = $mentordata->company;
    //$infodata->company = isset($mentordata->company)?$mentordata->company:'';
    if ($mentordata->othercompany != 0)
        $infodata->company = $mentordata->othercompany;
    $infodata->acceptterms = 1;
    if ($mentordata->fburl == 0)
        $infodata->fburl = '';
    else
        $infodata->fburl = $mentordata->fburl;
    //	echo "<pre>";print_r($data);
    //print_r($infodata);die;
    //continue;
    $uemail = trim($mentordata->email);
    if (!empty($uemail)) {
        $transaction = $DB->start_delegated_transaction();
        //echo "<pre>";
        $id = $DB->insert_record('user', $data);
        //print_r($data);
        $infodata->userid = $id;
        $infodata->data = 'mentor data';
        //print_r($infodata);								
        $userinfodataid = $DB->insert_record('user_info_data', $infodata);
        //echo $userinfodataid;				
        $usercontext = context_user::instance($id);
        if(isset($schoolid)){
        if ($schoolid != '' && $schoolid != 0) {
            $school = new stdClass();
            $school->userid = $id;
            $school->schoolid = $schoolid;
            $school->role = 'mentor';
            $text = $DB->insert_record('user_school', $school);
        }
        }
        //die;
        $transaction->allow_commit();
    }    
    return $id;
}