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
 * Class field
 *
 * @package   customfield_dynamicmultiselect
 * @copyright 2020 Sooraj Singh 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace customfield_dynamicmultiselect;

defined('MOODLE_INTERNAL') || die;

/**
 * Class field
 *
 * @package customfield_dynamicmultiselect
 * @copyright 2020 Sooraj Singh
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class field_controller extends \core_customfield\field_controller {
    /**
     * Customfield type
     */
    const TYPE = 'dynamicmultiselect';

    /**
     * Add fields for editing a dynamicmultiselect field.
     *
     * @param \MoodleQuickForm $mform
     */
    public function config_form_definition(\MoodleQuickForm $mform) {
        $mform->addElement('header', 'header_specificsettings', get_string('specificsettings', 'customfield_dynamicmultiselect'));
        $mform->setExpanded('header_specificsettings', true);

        $mform->addElement('textarea', 'configdata[dynamicmultiselectsql]', get_string('sqlquery', 'customfield_dynamicmultiselect') ,array('rows' => 7, 'cols' => 52));
        $mform->setType('configdata[dynamicmultiselectsql]', PARAM_RAW);

        $mform->addElement('text', 'configdata[defaultvalue]', get_string('defaultvalue', 'core_customfield'), 'size="50"');
        $mform->setType('configdata[defaultvalue]', PARAM_RAW);
    }

    /**
     * Returns the options available as an array.
     *
     * @param \core_customfield\field_controller $field
     * @return array
     */
    public static function get_options_array(\core_customfield\field_controller $field) : array {
		global $DB;
        if ($field->get_configdata_property('dynamicmultiselectsql')) {
			$resultset = $DB->get_records_sql($field->get_configdata_property('dynamicmultiselectsql'));
			$options = array();
			foreach ($resultset as $key => $option) {
                $options[format_string($key)] = format_string($option->data);// Multilang formatting.
            }
        } else {
            $options = array();
        }
        return  $options;
    }

    /**
     * Validate the data from the config form.
     * Sub classes must reimplement it.
     *
     * @param array $data from the add/edit profile field form
     * @param array $files
     * @return array associative array of error messages
     */
    public function config_form_validation(array $data, $files = array()) : array {
		global $DB;
		$err = array();

        
        
        global $DB;
        try {
            $sql = $data['configdata']['dynamicmultiselectsql'];
            if(!isset($sql) || $sql==''){
                $err['configdata[dynamicmultiselectsql]'] = get_string('err_required', 'form');
            }else{
                $resultset = $DB->get_records_sql($sql);
                if (!$resultset) {
                    $err['configdata[dynamicmultiselectsql]'] = get_string('queryerrorfalse', 'customfield_dynamicmultiselect');
                } else {
                    if (count($resultset) == 0) {
                        $err['configdata[dynamicmultiselectsql]'] = get_string('queryerrorempty', 'customfield_dynamicmultiselect');
                    } else {
                        $firstval = reset($resultset);
                        if (!object_property_exists($firstval, 'id')) {
                            $err['configdata[dynamicmultiselectsql]'] = get_string('queryerroridmissing', 'customfield_dynamicmultiselect');
                        } else {
                            if (!object_property_exists($firstval, 'data')) {
                                $err['configdata[dynamicmultiselectsql]'] = get_string('queryerrordatamissing', 'customfield_dynamicmultiselect');
                            } else if (!empty($data['configdata']['defaultvalue']) && !isset($resultset[$data['configdata']['defaultvalue']])) {
                                // Def missing.
                                $err['configdata[defaultvalue]'] = get_string('queryerrordefaultmissing', 'customfield_dynamicmultiselect');
                            }
                        }
                    }
                }
            }
            
        } catch (\Exception $e) {
            $err['configdata[dynamicmultiselectsql]'] = get_string('sqlerror', 'customfield_dynamicmultiselect') . ': ' .$e->getMessage();
        }
        return $err;
    }
}
