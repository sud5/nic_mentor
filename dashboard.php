<?php
/*
Copyright (C) 2019  IBM Corporation 
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details at 
http://www.gnu.org/licenses/gpl-3.0.html
*/

/* @package core_project
 * @CreatedBy:ATL Dev (IBM)
 * @CreatedOn:02-07-2020
 * @Description: RMOC DASHBOARD
*/

require_once('../../config.php');
require_login(null, false);
if (isguestuser()) {
    redirect($CFG->wwwroot);
}
require_once($CFG->libdir.'/filelib.php');
$userrole = get_atalrolenamebyid($USER->msn);
$id = optional_param('id', 0, PARAM_INT);    // User id; -1 if creating new school.
$PAGE->set_url('/local/mentor/dashboard.php');

//Heading
$PAGE->set_context(context_user::instance($USER->id));
$PAGE->set_pagelayout('standard');
$strmessages = "Dashboard";
$PAGE->set_title("{$SITE->shortname}: $strmessages");
$PAGE->set_heading("Dashboard");
$schoolurl = new moodle_url('/local/mentor/schools.php');
$mentorlisturl = new moodle_url('/local/mentor/index.php');
$mentors_sessions_url = new moodle_url('/local/mentor/mentor_sessions.php');
$inactive_mentors_url = new moodle_url('/local/mentor/inactive_mentors.php');

echo $OUTPUT->header();

$fields = "SELECT ms.*,mus.userid,mus.schoolid,mu.firstname,mu.lastname ";
$sql = " FROM {school} ms 
         LEFT JOIN (SELECT * from {user_school} WHERE role='incharge') mus on mus.schoolid=ms.id 
         LEFT JOIN {user} mu on mu.id=mus.userid WHERE ms.activestatus=1 and mu.deleted=0";
$allschools = $DB->get_records_sql($fields . $sql);
$allschools = count($allschools);
$sql = "SELECT u.id,ud.scormstatus, s.name as state, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed "
    . "FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join mdl_state s on s.id=u.aim left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' group by u.id order by u.id ASC";
$allavailablementors = $DB->get_records_sql($sql);
$mentor_count =count($allavailablementors);
$fields = "SELECT msr.*, s.name as state, mu.id as mentorid,mu.email,mu.city, mu.firstname,mu.lastname, CONCAT(mu.firstname,' ',mu.lastname) as mentorname,ms.name as schoolname,ms.id as schoolid,ms.atl_id as schoolatlid";
$sql = " FROM `mdl_mentor_sessionrpt` msr join mdl_user mu on mu.id=msr.mentorid join mdl_school ms on msr.schoolid=ms.id left join mdl_state s on s.id=mu.aim WHERE mu.deleted=0";
$mentor_sessions = $DB->get_records_sql($fields . $sql);
$mentor_sessions_count =count($mentor_sessions);
$duration = 90*24*60*60;
$time = time()- $duration;
$fields = "SELECT u.*,ud.scormstatus, s.name as state, count(CASE WHEN me.userid = u.id THEN 1 END) as meetingcount,count(CASE WHEN (me.meetingstatus = 1 AND me.parentid=u.id) THEN 1 END) as approved,count(CASE WHEN (me.meetingstatus=2 AND me.parentid=u.id) THEN 1 END) as rejected,count(CASE WHEN (me.meetingstatus=3 AND me.parentid=u.id) THEN 1 END) as completed ";
$sql = " FROM {user} u "
        . " left join {user_info_data} ud on ud.userid=u.id left join mdl_state s on s.id=u.aim left join (select * from {event} where eventtype='user' and parentid!=0 ) me on (u.id=me.userid or u.id=me.parentid) "
        . "WHERE msn=4 and deleted=0 and ud.data='mentor data' and u.lastaccess < $time group by u.id order by u.id ASC";
$inactivementors = $DB->get_records_sql($fields . $sql);
$inactivementors =count($inactivementors);
?>
                                
  <div class="row reportdetails">
                                  
            <div class="col-md-3 col-sm-3 col-xs-6">
                 <a href=<?php echo "$mentorlisturl";?>> 
            <div class="small-box bg-primary">
              <div class="inner">
                <h4><?php echo "$mentor_count";?></h4>

                <p> Mentors</p>
              </div>
              <div class="icon">                
				<i class="fa fa-users"></i>
              </div>
             
            </div>
                                  </a>
          </div>
 
                           
           <div class="col-md-3 col-sm-3 col-xs-6">
               <a href=<?php echo "$schoolurl";?>> 
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?php echo "$allschools";?></h4>

                <p>Mentors/School</p>
              </div>
              <div class="icon">                
				<i class="fa fa-university"></i>
              </div>
             
            </div>
          </div>
                                    
                                             
         <div class="col-md-3 col-sm-3 col-xs-6">
             <a href=<?php echo "$mentors_sessions_url";?>> 
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><?php echo "$mentor_sessions_count";?></h4>

                <p>Mentors Sessions</p>
              </div>
              <div class="icon">                
				<i class="fa fa-comments"></i>
              </div>
             
            </div>
          </div>   
                                    
                                    
        <div class="col-md-3 col-sm-3 col-xs-6">
            <a href=<?php echo "$inactive_mentors_url";?>> 
            <div class="small-box bg-success">
              <div class="inner">
                <h4><?php echo "$inactivementors";?></h4>

                <p>Inactive Mentors</p>
              </div>
              <div class="icon">                
				<i class="fa fa-user-times"></i>
              </div>
             
            </div>
          </div>                              
                                  
          </div>
                       
                    <br>   <br>                
      <!--button start-->                 
        
  <div class="row">
                                    
     <!-- <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-university"></i> School Wise Mentor List</a>
      </div>
      
     <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-user"></i>Mentor Wise School List</a>
      </div> 
      
<div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-database"></i>Mentor Database</a>
      </div> 
      
    <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-database"></i>School Database</a>
      </div> -->
      
 </div>
                                
                                
   <br>    <br> 
      

<?php

//Prod
$nps='<div id="sg-nps" class="sg-black"><script type="text/javascript">
(function(d,e,j,h,f,c,b){d.SurveyGizmoBeacon=f;d[f]=d[f]||function(){(d[f].q=d[f].q||[]).push(arguments)};c=e.createElement(j),b=e.getElementsByTagName(j)[0];c.async=1;c.src=h;b.parentNode.insertBefore(c,b)})(window,document,"script","//d2bnxibecyz4h5.cloudfront.net/runtimejs/intercept/intercept.js","sg_beacon");
sg_beacon("init","MzI0MTk0LTIxOTI0NGIyOTdhMzQ2M2I5NDRlMGQ0OTdiM2NkNTQ1M2RlM2IwMWUxMjNlMTI3YjM4");
</script></div>';
echo $nps;
echo $OUTPUT->footer();
?>
<script type="text/javascript">

// Global SG configuration
window.SurveyGizmoBeacon = 'sg_beacon';
window.sg_beacon = window.sg_beacon || function() {
 (window.sg_beacon.q = window.sg_beacon.q || []).push(arguments);
};
 
// Insert intercept script into DOM
const npsScript = document.createElement('script');
const firstScript = document.getElementsByTagName('script')[0];
npsScript.async = 1;
npsScript.src = '//d2bnxibecyz4h5.cloudfront.net/runtimejs/intercept/intercept.js';
firstScript.parentNode.insertBefore(npsScript, firstScript);

// NPS options
//QA
//window.sg_beacon('init', 'MzI0MTk0LTg5YmNhNjcyZDQ2NTRmMGFiMDVjODJiMmFjOTEyOTg4M2I4NDZlMWVjMjgyYjQyMzRl');   
//Prod
window.sg_beacon('init', 'MzI0MTk0LTIxOTI0NGIyOTdhMzQ2M2I5NDRlMGQ0OTdiM2NkNTQ1M2RlM2IwMWUxMjNlMTI3YjM4');
// required
window.sg_beacon('data', 'siteName', 'ATL Innonet Platform');  // required
window.sg_beacon('data', 'pageUrl', window.location.href);  // required
window.sg_beacon('data', 'version', 'v2');   // required
window.sg_beacon('data', 'sglocale', 'en');   // optional. By default NPS widget will use language from browser's settings (if the language is not supported by the widget - English will be used). You can override the behavior if you provide locale code here (ex.: zh-cn, zh-tw, nl, en, fr-ca, ja ).
</script>
<script type="text/javascript">
require(['jquery'], function($) {

	
});
</script>
