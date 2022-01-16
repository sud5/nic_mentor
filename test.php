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

//require_login();
$context = context_system::instance();
//require_capability('moodle/site:config', $context);

$monthid = optional_param('month', 0, PARAM_INT);
$yearid = optional_param('year', 0, PARAM_INT);

$PAGE->set_context($context);
$PAGE->set_url('/lib/tests/other/chartjstestpage.php');
$PAGE->set_heading('Chart.js library test');
$PAGE->set_pagelayout('standard');
echo $OUTPUT->header();
  $session_value = array(109, 118, 6);
  $hours_vlaue = array(46, 11, 54);
  $labels_value = array(2021,2312,2019);
$sessions = new \core\chart_series('Total Sessions', $session_value);
$hours = new \core\chart_series('Hours', $hours_vlaue);
$labels =  $labels_value;
$CFG->chart_colorset = ['#279b9a','#FFFF00'];
$chart5 = new \core\chart_bar();
$chart5->set_title('Mentoring Sessions');
$chart5->add_series($sessions);
$chart5->add_series($hours);
$chart5->set_labels($labels);
echo $OUTPUT->render($chart5);

function reset_filter() {
  global $DB;
  $output = "";
  $output .= html_writer::start_div('d-inline-block');
  $output .= html_writer::start_div("row");
  $output .= html_writer::start_div("form-group col-xs-3");
  $url = new moodle_url("chart.php");
  $output .= html_writer::link($url, "Reset Filters", array('class' => 'btn btn-primary'));
  $output .= html_writer::end_div();
  $output .= html_writer::end_div();
  $output .= html_writer::end_div();
  echo $output;
}

echo $OUTPUT->footer();
