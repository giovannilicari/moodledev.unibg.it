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

/**
 * 
 * 
 * @package aveseguimiento
 * @author: ALTEN
 * @date: 2017
 */

require_once("../../config.php");

$courseid = optional_param('courseid', SITEID, PARAM_INT);
if (! $course = $DB->get_record("course", array('id' => $courseid)) ) {
    print_error("No such course id");
}

if ($course->id == SITEID) {
    require_login();
    $context = \context_system::instance();
} else {
    require_login($course->id);
    $context = \context_course::instance($course->id);
}

$PAGE ->set_url('/blocks/aveseguimiento/ticket_save.php', array('courseid' => $course->id));
$PAGE ->set_context($context);
$PAGE ->set_pagelayout('incourse');

$title = 'Gestión de consultas e incidencias';
$PAGE ->navbar->add(get_string('ticket', 'block_aveseguimiento'));
$PAGE ->set_title($title);
$PAGE ->set_heading($title);
$PAGE ->set_cacheable(true);

echo $OUTPUT->header();
//echo $OUTPUT->heading('<div class="addbutton"><a class="linkbutton" href="'.$CFG->wwwroot.'/blocks/configurable_reports/editreport.php?courseid='.$course->id.'">'.(get_string('addreport', 'block_configurable_reports')).'</a></div>');


echo get_string('respuesta', 'block_aveseguimiento');

echo $OUTPUT->footer();
