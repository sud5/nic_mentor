<?php
require_once '../../config.php';

$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 20, PARAM_INT);
global $DB;
$context = context_system::instance();
$data = new stdClass();
$data->firstname = $_POST['firstname']?$_POST['firstname']:'';
$data->lastname = $_POST['lastname'];
$data->email = $_POST['email'];
$data->alternateemail = $_POST['alternateemail'];
$data->gender = $_POST['gender'];
$data->phonenumber = $_POST['phonenumber'];
$data->dob = $_POST['dob'];
$data->idtype = $_POST['idtype'];
$data->idnumber = $_POST['idnumber'];
$data->nationality = $_POST['nationality'];
$data->state = $_POST['state'];
$data->city = $_POST['district'];
$data->address1 = $_POST['address1'];
$data->address2 = $_POST['address2'];
$data->pincode = $_POST['pincode'];
$data->linkedin = $_POST['linkedinurl'];
$data->fburl = $_POST['blogposturl'];
$data->degree = $_POST['highestdegree'];
//$data->otherdegree = $_POST['dob'];
$data->institute = $_POST['institute'];
$data->yoc = $_POST['yearofcompletion'];
$data->areaspec = $_POST['specilization'];
$data->language = $_POST['languages'];
$data->registeras = $_POST['registeringas'];
$data->aimpartneremployed = $_POST['aimpartneremployed'];//
$data->currentorgname = $_POST['currentorgname'];
$data->typeoforg = $_POST['typeoforg'];
$data->designation = $_POST['designation'];
$data->currentwork = $_POST['currentwork'];
$data->currentworkexperience = $_POST['currentworkexperience'];
$data->totalexperience = $_POST['totalexperience'];
$data->mentoringexperience = $_POST['mentoringexperience'];
$data->preferredmentoringform = $_POST['preferredmentoringform'];
$data->noofhourstowork = $_POST['noofhourstowork'];
$data->preferredatls = $_POST['preferredatls'];
$data->reasonformentorofchange = $_POST['reasonformentorofchange'];
$data->ref1name = $_POST['referee1name'];
$data->ref1email = $_POST['referee1email'];
$data->ref1contact = $_POST['referee1phone'];
$data->ref1how = $_POST['referee1connection'];
$data->referee1existingmentor = $_POST['referee1existingmentor'];
$data->ref2name = $_POST['referee2name'];
$data->ref2email = $_POST['referee2email'];
$data->ref2contact = $_POST['referee2phone'];
$data->ref2how = $_POST['referee2connection'];
$data->referee2existingmentor = $_POST['referee2existingmentor'];
$data->willingtoputeffort = @$_POST['willingtoputeffort'];
$data->guideyoungminds = @$_POST['guideyoungminds'];
$data->listentoothers = @$_POST['listentoothers'];
$data->goesoutofway = @$_POST['goesoutofway'];
$data->guidingexperiencesamebg = @$_POST['guidingexperiencesamebg'];
$data->guidingexperienceotherbg = @$_POST['guidingexperienceotherbg'];
$data->confidenttocordinate = @$_POST['confidenttocordinate'];
$data->confidenttofindsolution = @$_POST['confidenttofindsolution'];
$data->findnewwaystocommunicate = @$_POST['findnewwaystocommunicate'];
$data->comfortabletocordinate = @$_POST['comfortabletocordinate'];
$data->status = 0;
$data->timecreated = time();
$data->timemodified = time();
$statename = '';//$DB->get_field('state', 'name', array('id'=> $fromform->state));
//$data->state = '';$statename;
//$cityname = $DB->get_field('city', 'name', array('id'=>$fromform->cityid, 'stateid'=> $fromform->state));
//$data->city = $cityname;
$DB->insert_record('mentor_request', $data);
$url =new moodle_url('/local/mentor/mentor_signup.php');
redirect($url, get_string('requestmessage', 'local_mentor'));
?>