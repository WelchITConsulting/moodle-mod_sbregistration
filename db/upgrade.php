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
 * Filename : upgrade
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 24 Jan 2015
 */

function xmldb_registration_upgrade($oldversion = 0)
{
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2015020600) {

        // Process the database schema updates for the registration table
        $table = new xmldb_table('registration');

        // Rename the eventdate field
        $field = new xmldb_field('eventdate', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, 'location');
        $dbman->rename_field($table, $field, 'starttime');

        // Add the events end time field
        $field = new xmldb_field('acceptsubject', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'closedate');
        $dbman->add_field($table, $field);

        // Add the events end time field
        $field = new xmldb_field('acceptemail', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null, 'acceptsubject');
        $dbman->add_field($table, $field);

        // Add the events end time field
        $field = new xmldb_field('rejectsubject', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'acceptemail');
        $dbman->add_field($table, $field);

        // Add the events end time field
        $field = new xmldb_field('rejectemail', XMLDB_TYPE_TEXT, 'small', null, XMLDB_NOTNULL, null, null, 'rejectsubject');
        $dbman->add_field($table, $field);

        // Process the database schema updates for the registration_submissions table
        $table = new xmldb_table('registration_submissions');

        // Add the notes fields
        $field = new xmldb_field('notes', XMLDB_TYPE_TEXT, 'small', null, null, null, null, 'userid');
        $dbman->add_field($table, $field);

        // Add the status fields
        $field = new xmldb_field('status', XMLDB_TYPE_CHAR, '1', null, null, null, null, 'notes');
        $dbman->add_field($table, $field);

        // Remove the mailed field
        $field = new xmldb_field('mailed', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, null, 'status');
        $dbman->drop_field($table, $field);

        // Registration savepoint reached
        upgrade_mod_savepoint(true, 2015020600, 'registration');
    }

    if ($oldversion < 2015020800) {

        // Process the database schema updates for the registration table
        $table = new xmldb_table('registration');

        // Remove the event type field
        $field = new xmldb_field('eventtype', XMLDB_TYPE_INTEGER, '10', XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, 'introformat');
        $dbman->drop_field($table, $field);

        // Remove the event type table
        $table = new xmldb_table('registration_event_types');
        $dbman->drop_table($table);

        // Registration savepoint reached
        upgrade_mod_savepoint(true, 2015020800, 'registration');
    }

    if ($oldversion < 2015050201) {

        // Process the database schema updates for the registration table
        $table = new xmldb_table('registration');

        // Add the accept email body format field
        $field = new xmldb_field('acceptemailformat', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1', 'acceptemail');
        $dbman->add_field($table, $field);

        // Add the reject email body format field
        $field = new xmldb_field('rejectemailformat', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '1', 'rejectemail');
        $dbman->add_field($table, $field);

        // Registration savepoint reached
        upgrade_mod_savepoint(true, '2015050200', 'registration');
    }

    return true;
}
