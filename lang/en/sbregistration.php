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
 * Filename : regiatration
 * Author   : John Welch <jwelch@welchitconsulting.co.uk>
 * Created  : 24 Jan 2015
 */

$string['acceptemail']                          = 'Accepted email body';
$string['acceptemail_default']                  = '<p>Dear ###NAME###,</p>'
                                                . '<p>Congratulations, you have been awarded a place at the ###EVENT### on ###DATE### at ###TIME###. Please arrive at the ###LOCATION### in plenty of time to allow us to get started on time.</p>';
$string['acceptemail_help']                     = '<p>This provides the main body of the email sent to all suuccesful applicants.</p>'
                                                . '<p>You can add the following codes into the above field which will be replaced with the relevant event data:</p>'
                                                . '<table><thead><tr><th>Code</th><th>Replaced with:</th></tr></thead><tbody>'
                                                . '<tr><th>##NAME###</th><td>The firstname of the site member</td></tr>'
                                                . '<tr><th>###EVENT###</th><td>The events name</td></tr>'
                                                . '<tr><th>>###DATE###</th><td>The events start date</td></tr>'
                                                . '<tr><th>###TIME###</th><td>The events start time</td></tr>'
                                                . '<tr><th>###LOCATION###</th><td>The events location</td></tr></tbody></table>';
$string['acceptsubject']                        = 'Accepted email subject';
$string['acceptsubject_default']                = 'Congratulations, you have been accepted on to the workshop';
$string['acceptsubject_help']                   = 'This is the subject line for the email sent to all the applicants who have been offered a place at your event.';
$string['closedate']                            = 'Available until';
$string['closedate_help']                       = 'The date and time when the registration period closes.';
$string['description']                          = 'Event description';
$string['description_help']                     = 'Please provide as much information as possible about your event in the event description field as we use this details when creating the calendar event.';
$string['editpupils']                           = 'Edit pupils';
$string['emailconfirmations']                   = 'Email confirmation settings';
$string['endtime']                              = 'Event end';
$string['eventcloses']                          = 'Event end';
$string['eventnotactive']                       = 'Event closed';
$string['eventopens']                           = 'Event start';
$string['eventtypes']                           = 'Event type';
$string['incorrectcourseid']                    = 'Invalid course ID';
$string['location']                             = 'Event location';
$string['location_help']                        = 'The location where your event is being held.';
$string['modulename']                           = 'Event registration';
$string['modulename_help']                      = 'The registration module allows you to enter an event with the ability for course members to register an interest in attending.';
$string['modulenameplural']                     = 'Event registrations';
$string['name']                                 = 'Event name';
$string['notes']                                = 'Other notes';
$string['numberofplaces']                       = 'Available places';
$string['numberofplaces_help']                  = 'This is used to define how many places are available at this event.';
$string['opendate']                             = 'Available from';
$string['opendate_help']                        = 'The date and time when the registration period opens.';
$string['period']                               = 'Registration period';
$string['pluginadministration']                 = 'Registration administration';
$string['pluginname']                           = 'SmartsBridge Registration';
$string['preview']                              = 'Preview registration';
$string['printblank']                           = 'Print blank registration';
$string['printresponses']                       = 'Print responses';
$string['registrationclosed']                   = 'The registration period is now closed';
$string['registrationcloses']                   = 'Registration closes:';
$string['registrationnotopen']                  = 'The registration period has not started yet';
$string['registrationopen']                     = 'Registration for:';
$string['registrationopens']                    = 'Registration opens:';
$string['sbregistration:addinstance']           = 'Add registration events';
$string['sbregistration:deleteresponses']       = 'Delete responses';
$string['sbregistration:downloadresponses']     = 'Download reponses';
$string['sbregistration:manage']                = 'Manage registrations';
$string['sbregistration:submit']                = 'Submit registration';
$string['sbregistration:view']                  = 'View registration';
$string['sbregistration:viewsingleresponse']    = 'View single response';
$string['rejectemail']                          = 'Rejected email body';
$string['rejectemail_default']                  = 'Unfortunately, as places for this training are limited we have been unable to allocate a place for you on this event.';
$string['rejectemail_help']                     = 'This is the body of the email sent to those who have not been allocated a space at the event.';
$string['rejectsubject']                        = 'Rejected email subject';
$string['rejectsubject_default']                = 'Sorry, you have not been successful';
$string['rejectsubject_help']                   = 'This is the subject line for the email sent to those who have not been allocated a space at the event.';
$string['starttime']                            = 'Event start';
$string['submitbutton']                         = 'Register for event';
$string['submitted']                            = 'Thankyou for your interest, you will be notified via SmartBridge if you have been allocated a place.';
$string['viewallresponses']                     = 'View all responses';
$string['viewresponses']                        = 'View responses';
$string['viewstatistics']                       = 'View statistics';
$string['yesnofield']                           = 'Check this box if you would like to attend this event';
