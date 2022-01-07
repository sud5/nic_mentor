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
$mentorlisturl = new moodle_url('/local/mentor/index.php');
echo $OUTPUT->header();
?>
<!-- Add html content Here -->

  <h2>RMOC Dashboard</h2>
                                
  <div class="row reportdetails">
                                  
            <div class="col-md-3 col-sm-3 col-xs-6">
                 <a href=<?php echo "$mentorlisturl";?>> 
            <div class="small-box bg-primary">
              <div class="inner">
                <h4>15</h4>

                <p> Mentor's</p>
              </div>
              <div class="icon">                
				<i class="fa fa-users"></i>
              </div>
             
            </div>
                                  </a>
          </div>
 
                           
           <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h4><strong>10</strong></h4>

                <p>Schools</p>
              </div>
              <div class="icon">                
				<i class="fa fa-university"></i>
              </div>
             
            </div>
          </div>
                                    
                                             
         <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h4><strong>50</strong></h4>

                <p>Sessions</p>
              </div>
              <div class="icon">                
				<i class="fa fa-comments"></i>
              </div>
             
            </div>
          </div>   
                                    
                                    
        <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h4><strong>7</strong></h4>

                <p>Events</p>
              </div>
              <div class="icon">                
				<i class="fa fa-calendar"></i>
              </div>
             
            </div>
          </div>                              
                                  
          </div>
                       
                    <br>   <br>                
      <!--button start-->                 
        
  <div class="row">
                                    
      <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-user"></i> Mentor Leader Board</a>
      </div>
      
     <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-university"></i> School Leader Board</a>
      </div> 
      
<div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-envelope"></i> Inbox</a>
      </div> 
      
    <div class="col-md-3 col-sm-6 col-xs-12">                       
<a href="#" class="btn btn-primary form-control"><i class="fa fa-calendar"></i> Add Event</a>
      </div> 
      
 </div>
                                
                                
   <br>    <br> 
      

                                
                                
<!-- slider start-->
                                
   <div id="carouselExampleIndicators" class="carousel slide events-slier" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  

       
     <div class="carousel-inner">
         <!--item start-->
    <div class="carousel-item active">
   <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12"> 
        <img src="http://localhost/atlnew/atlinnonet/rmoc/images/eventslider.jpg" class="d-block" width="100%">
        </div>
       
        <div class="col-md-6 col-sm-12 col-xs-12"> 
            <div class="events_slider_content">
       <h3>Learn Data Analysis with Online Data Analysis Courses </h3>
        <h6>05 July 2020 | 10:00 am</h6>
       <h5><strong>54</strong> going  |  Type:  <span>Webinar</span></h5>     
       </div>
            </div>
        
        
    </div>  
          </div>
          <!--item end-->
         
         
         <!--item start-->
    <div class="carousel-item">
   <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12"> 
        <img src="http://localhost/atlnew/atlinnonet/rmoc/images/eventslider.jpg" class="d-block" width="100%">
        </div>
       
        <div class="col-md-6 col-sm-12 col-xs-12"> 
            <div class="events_slider_content">
       <h3>Learn Data Analysis with Online Data Analysis Courses </h3>
        <h6>05 July 2020 | 10:00 am</h6>
       <h5><strong>54</strong> going  |  Type:  <span>Webinar</span></h5>     
       </div>
            </div>
        
        
    </div>  
          </div>
          <!--item end-->
         
         
        
       </div>
       
       
       
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                                
   <!-- slider end-->                             
  
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
