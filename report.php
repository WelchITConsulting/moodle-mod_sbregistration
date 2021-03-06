<?php
/*
 * Copyright (C) 2015 Welch IT Consulting
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Filename : report
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 12 Feb 2015
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/mod/sbregistration/sbregistration.class.php');
require_once($CFG->dirroot . '/mod/sbregistration/locallib.php');

$instance = optional_param('instance', false, PARAM_INT);
$action   = optional_param('action', 'all', PARAM_ALPHA);

if ($instance === false) {
    if (!empty($SESSION->instance)) {
        $instance = $SESSION->instance;
    } else {
        print_error('requiredparameter', 'sbregistration');
    }
}
$SESSION->instance = $instance;

if (!$sbregistration = $DB->get_record('sbregistration', array('id' => $instance))) {
    print_error('incorrectregistration', 'sbregistration');
}
if (!$course = $DB->get_record('course', array('id' => $sbregistration->course))) {
    print_error('coursemisconf');
}
if (!$cm = get_coursemodule_from_instance('sbregistration', $sbregistration->id, $course->id)) {
    print_error('invalidcoursemodule');
}
require_course_login($course, true, $cm);
$sbregistration = new SmartBridgeRegistration($course, $cm, 0, $sbregistration);


$context = context_module::instance($cm->id);

// Check the user has the Capabilities required to access the report
if (!has_capability('mod/sbregistration:viewsingleresponse', $context) &&
        !$sbregistration->capabilites->view) {
    print_error('nopermissions', 'moodle', $CFG->wwwroot . '/mod/sbregistration/view.php?id=' . $cm-id);
}
//$sbregistration->canviewallgroups = has_capability('moodle/site:accessallgroups', $context);
$url = new moodle_url($CFG->wwwroot . '/mod/sbregistration/report.php');
if ($instance) {
    $url->param('instance', $instance);
}
if ($action) {
    $url->param('action', $action);
} else {
    $url->param('action', 'all');
}

// Process any data submitted
if (($data = data_submitted())) {

    // Process status updates
    foreach($data->status as $key => $val) {

        // Update the database with the status changes
        $DB->set_field('sbregistration_submissions', 'status', $val, array('id' => $key));

        // Process the emails to be sent
        sbregistration_process_emails($sbregistration->id);
    }
    // Redirect to this page
    redirect($url);
}

$PAGE->set_url($url);
$PAGE->set_context($context);

$sql = 'SELECT rs.id, u.firstname, u.lastname, r.name, r.shortname, '
     . 'rn.name AS name_reassigned, rs.notes, rs.status '
     . 'FROM {user} u INNER JOIN {role_assignments} ra ON ra.userid = u.id '
     . 'INNER JOIN {context} ct ON ct.id = ra.contextid '
     . 'INNER JOIN {course} c ON c.id = ct.instanceid '
     . 'INNER JOIN {role} r ON r.id = ra.roleid '
     . 'LEFT JOIN {role_names} rn ON rn.roleid = r.id '
     . 'LEFT JOIN {sbregistration_submissions} rs ON u.id = rs.userid '
     . 'WHERE rs.sbregistration = ? '
     . 'ORDER BY rs.id ASC, r.shortname ASC, u.lastname ASC, u.firstname ASC';

if (!$respondants = $DB->get_records_sql($sql, array($sbregistration->id))) {
    $respondants = array();
}
$processedresp = array();
foreach ($respondants as $respondant) {
    $processedresp[$respondant->id] = array($respondant->firstname . ' ' . $respondant->lastname,
                                            (empty($respondant->name) ? $respondant->name_reassigned : $respondant->name),
                                            $respondant->notes,
                                            ($respondant->status < 4 ? sbregistration_get_status_dropdown('status[' . $respondant->id . ']', $respondant->status)
                                                                     : sbregistration_get_status($respondant->status)));
}
$table = new html_table();
$table->head = array(get_string('firstname') . ' / ' . get_string('lastname'),
                     get_string('role'),
                     'Notes',
                     'Status');
$table->align = array('left', 'left', 'left', 'center');

foreach($processedresp as $key => $respondant) {
    $table->data[] = $respondant;
}

$strsbregistrations = get_string('modulenameplural', 'sbregistration');
$PAGE->navbar->add($strsbregistrations);
$PAGE->set_title($course->shortname . ': ' . $strsbregistrations);
$PAGE->set_heading(format_string($course->fullname));
echo $OUTPUT->header()
   . html_writer::start_tag('h2')
   . html_writer::div($sbregistration->name, 'text_to_html')
   . html_writer::end_tag('h2')
   . html_writer::start_tag('form', array('action' => $url, 'method' => 'post'))
   . html_writer::table($table)
   . html_writer::empty_tag('input', array('type'  => 'submit',
                                           'value' => get_string('savechanges'),
                                           'class' => 'form-submit'))
   . html_writer::end_tag('form')
   . $OUTPUT->footer();
