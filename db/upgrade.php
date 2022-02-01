<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

function xmldb_local_mentor_upgrade($oldversion) {
  global $CFG, $DB;

  $result = true;
  $dbman = $DB->get_manager();

   if ($oldversion < 2020121900.09) {

    $table = new xmldb_table('tech_ticket');
    $field = new xmldb_field('priority', XMLDB_TYPE_INTEGER, '20', null, XMLDB_NOTNULL, null, 1);
        
    if (!$dbman->field_exists($table, $field)) {
      $dbman->add_field($table, $field);
    }

    upgrade_plugin_savepoint(true, 2020121900.09, 'local', 'mentor');
  }

  return $result;
}
