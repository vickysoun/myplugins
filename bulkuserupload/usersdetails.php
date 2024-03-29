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
 * List of all the uploaded users of local_bulkuserupload.
 *
 * @package    local_bulkuserupload
 * @author     Digvijay Singh Bisht (vickybisht524@gmail.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");
require_once($CFG->dirroot . "/local/bulkuserupload/lib.php");

// Setting page details.
$PAGE->set_url(new moodle_url("/local/bulkuserupload/usersdetails.php"));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string("alluserslist", "local_bulkuserupload"));
$PAGE->set_heading(get_string('alluserslist', 'local_bulkuserupload'));

// Check if user is logged-in and has capability to Upload CSV.
require_login();
if (!has_capability("local/bulkuserupload:uploadcsv", context_system::instance())) {
    redirect(new moodle_url(('/my/')));
}

// Get renderer of local_bulkuserupload.
$renderer = $PAGE->get_renderer('local_bulkuserupload');

// Get all records of bulkuserupload_userdetails table.
$usersdetails = get_all_users_details();

echo $OUTPUT->header();

// Button to go to Upload CSV page.
echo html_writer::link(new moodle_url('/local/bulkuserupload'), get_string('uploadcsv', 'local_bulkuserupload'),
    ['class' => 'btn btn-info mr-2']);

// Show table.
echo $renderer->all_users_details_table($usersdetails);

echo $OUTPUT->footer();
