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
 * Customfield text field plugin strings
 *
 * @package   customfield_Dynamic Multi-Select
 * @copyright 2020 Sooraj Singh
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['errordefaultvaluenotinlist'] = 'The default value must be one of the options from the list above.';
$string['errornotenoughoptions'] = 'Please provide at least two options, with each on a new line.';
$string['invalidoption'] = 'Invalid option selected';
$string['menuoptions'] = 'Menu options (one per line)';
$string['defaultvalue'] = 'Default value (comma separated values)';
$string['pluginname'] = 'Dynamic Multi-Select Menu';
$string['privacy:metadata'] = 'The Dynamic Multi-Select Menu field type plugin doesn\'t store any personal data; it uses tables defined in core.';
$string['specificsettings'] = 'Dynamic Multi-Select menu field settings';

$string['queryerrorfalse'] = "Error executing the query: return value is false";
$string['queryerrorempty'] = "No results found executing the query: cannnot validate";
$string['queryerroridmissing'] = 'id column is missing in query return values';
$string['queryerrordatamissing'] = 'data column is missing in query return values';
$string['queryerrordefaultmissing'] = 'Default value does not exists among the list of allowed values';
$string['sqlquery'] = 'Sql query';
$string['sqlerror'] = 'Error executing the query';