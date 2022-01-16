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
$yearid = optional_param('year', 1, PARAM_INT);

$PAGE->set_context($context);
$PAGE->set_url('/lib/tests/other/chartjstestpage.php');
//$PAGE->set_heading('Chart.js library test');
$PAGE->set_pagelayout('standard');
echo $OUTPUT->header();
$labels_value = array('January', 'February', 'March', 'April', 'June', 'May', 'July', 'August', 'September', 'October', 'November', 'December');

//$labels = ['Jan', 'Feb', 'March', 'April', 'June', 'May', 'July', 'August', 'September', 'October', 'November', 'Dec'];
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
