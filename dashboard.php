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

$monthid = optional_param('month', 0, PARAM_INT);
$yearid = optional_param('year', 1, PARAM_INT);
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
                                    
     <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="<?php echo new moodle_url('/local/mentor/request.php')?>" class="btn btn-primary form-control"><i class="fa fa-users"></i> Mentor Request Form</a>
      </div>
      
     <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="<?php echo new moodle_url('/local/mentor/mentorinfo.php')?>" class="btn btn-primary form-control"><i class="fa fa-user"></i>Mentor Wise School List</a>
      </div> 
      
<div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-database"></i>Mentor Database</a>
      </div> 
      
    <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-database"></i>School Database</a>
      </div>
      
 </div>
                                
                                
   <br>    <br> 
      

<?php
$labels_value = array('January', 'February', 'March', 'April', 'June', 'May', 'July', 'August', 'September', 'October', 'November', 'December');
$year_select = array('Select Year');
$years = array_combine(range(date('Y'), 2018), range(date('Y'), 2018));
$years = array_merge($year_select, $years);
$months = array('Select Months', 'January', 'February', 'March', 'April', 'June', 'May', 'July', 'August', 'September', 'October', 'November', 'December');
echo $OUTPUT->single_select(new moodle_url('', array('year' => $yearid)), 'month', $months, $monthid, '', array(), array('label' => 'Select Month'));
echo $OUTPUT->single_select(new moodle_url('', array('month' => $monthid)), 'year', $years, $yearid, '', array(), array('label' => 'Select Year'));
echo reset_filter();
if (!empty($yearid) && !empty($monthid)) {
  $year = $years[$yearid];
  $result = session_hours_months($year, $monthid);
  $session_value = array($result['mentoring_sessions']);
  $hours_value = array($result['totaltime']);
  $labels_value = array($months[$monthid]);
}
elseif (!empty($yearid) && empty($monthid)) {
  $year = $years[$yearid];
  $result = session_year($year);
  for ($i = 0; $i < 12; $i++) {
    $session_value[$i] = isset($result['mentoring_sessions'][$i + 1]) ? $result['mentoring_sessions'][$i + 1] : 0;
    $hours_value[$i] = isset($result['totaltime_all'][$i + 1]) ? $result['totaltime_all'][$i + 1] : 0;
  }
}
elseif (!empty($monthid) && empty($yearid)) {
  $result = session_month($monthid);
  $session_value = array();
  $hours_value = array();
  $inc = 0;
  foreach ($years as $yearskey => $yearsvalue) {
    if ($yearskey == 0)
      continue;
    $session_value[$inc] = isset($result['mentoring_sessions'][$yearsvalue]) ? $result['mentoring_sessions'][$yearsvalue] : 0;
    $hours_value[$inc] = isset($result['totaltime_all'][$yearsvalue]) ? $result['totaltime_all'][$yearsvalue] : 0;
    $inc++;
  }
  $labels_value = range(date('Y'), 2018);
}

$CFG->chart_colorset = ['#279b9a', '#FFFF00'];
$sessions = new \core\chart_series('Total Sessions', $session_value);
$hours = new \core\chart_series('Hours', $hours_value);
$labels = $labels_value;
$chart5 = new \core\chart_bar();
$chart5->set_title('Mentoring Sessions');
$chart5->add_series($sessions);
$chart5->add_series($hours);
$chart5->set_labels($labels);
echo $OUTPUT->render($chart5);
//Prod
$nps='<div id="sg-nps" class="sg-black"><script type="text/javascript">
(function(d,e,j,h,f,c,b){d.SurveyGizmoBeacon=f;d[f]=d[f]||function(){(d[f].q=d[f].q||[]).push(arguments)};c=e.createElement(j),b=e.getElementsByTagName(j)[0];c.async=1;c.src=h;b.parentNode.insertBefore(c,b)})(window,document,"script","//d2bnxibecyz4h5.cloudfront.net/runtimejs/intercept/intercept.js","sg_beacon");
sg_beacon("init","MzI0MTk0LTIxOTI0NGIyOTdhMzQ2M2I5NDRlMGQ0OTdiM2NkNTQ1M2RlM2IwMWUxMjNlMTI3YjM4");
</script></div>';
echo $nps;
function reset_filter() {
  global $DB;
  $output = "";
  $output .= html_writer::start_div('d-inline-block');
  $output .= html_writer::start_div("row");
  $output .= html_writer::start_div("form-group col-xs-3");
  $url = new moodle_url("dashboard.php");
  $output .= html_writer::link($url, "Reset Filters", array('class' => 'btn btn-primary'));
  $output .= html_writer::end_div();
  $output .= html_writer::end_div();
  $output .= html_writer::end_div();
  echo $output;
}

function session_hours_months($year, $monthid) {
  global $DB;
//  $sql = "SELECT id, from_unixtime(dateofsession,'%m') as month FROM `mdl_mentor_sessionrpt` where "
//      . "from_unixtime(dateofsession,'%m') = $monthid AND from_unixtime(dateofsession,'%Y') = $yearid";

  $sql = "SELECT count(id) as count, SUM(totaltime) as totaltime FROM {mentor_sessionrpt} where"
      . " from_unixtime(dateofsession,'%m') = $monthid AND from_unixtime(dateofsession,'%Y') = $year";
  $sessions = $DB->get_records_sql($sql);
  $result = array('totaltime' => 0, 'mentoring_sessions' => 0);
  foreach ($sessions as &$sessions) {
    $result['totaltime'] = $sessions->totaltime;
    $result['mentoring_sessions'] = $sessions->count;
  }
  return $result;
}

function session_year($year) {
  global $DB;
  $sql = "SELECT id,count(id) as count, SUM(totaltime) as totaltime, from_unixtime(dateofsession,'%m') as month
    FROM {mentor_sessionrpt} where from_unixtime(dateofsession,'%Y') = $year group by month order by month ASC";
  $sessions = $DB->get_records_sql($sql);
  $result = array();
  $sessions_array = array();
  $totaltime_array = array();
  foreach ($sessions as &$sessions) {
    $sessions_array[(int) $sessions->month] = $sessions->count;
    $totaltime_array[(int) $sessions->month] = $sessions->totaltime;
  }


  $result['totaltime_all'] = $totaltime_array;
  $result['mentoring_sessions'] = $sessions_array;
  return $result;
}

function session_month($month) {
  global $DB;
  $sql = "SELECT count(id) as count, SUM(totaltime) as totaltime, from_unixtime(dateofsession,'%Y') as y "
      . "FROM {mentor_sessionrpt} where from_unixtime(dateofsession,'%m') = $month group by y order by y ASC";
  $sessions = $DB->get_records_sql($sql);
  $result = array();
  $sessions_array = array();
  $totaltime_array = array();
  foreach ($sessions as &$sessions) {
    $sessions_array[(int) $sessions->y] = $sessions->count;
    $totaltime_array[(int) $sessions->y] = $sessions->totaltime;
  }


  $result['totaltime_all'] = $totaltime_array;
  $result['mentoring_sessions'] = $sessions_array;
  return $result;
}

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
