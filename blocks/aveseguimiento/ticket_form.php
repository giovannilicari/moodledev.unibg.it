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
 * aveseguimiento
 * 
 * @package blocks
 * @author: ALTEN
 * @date: 2017
 */

if (!defined('MOODLE_INTERNAL')) {
    //  It must be included from a Moodle page.
    die('Direct access to this script is forbidden.');
}

require_once($CFG->libdir.'/formslib.php');

class ticket_form extends moodleform {
    public function definition() {
        global $DB, $USER, $CFG, $COURSE;

        $mform =& $this->_form;

        $mform ->addElement('header', 'importreport', get_string('ticket', 'block_aveseguimiento'));
        
        $mform ->addElement('static', 'name', get_string('name', 'block_aveseguimiento'), $USER ->firstname .' '. $USER ->lastname);
        $mform ->addElement('static', 'email', get_string('email', 'block_aveseguimiento'), $USER ->email);
        $mform ->addElement('static', 'course', get_string('course', 'block_aveseguimiento'), $COURSE ->fullname);
                
        $mform ->addElement('text', 'asunto', get_string('subject', 'block_aveseguimiento'), array('size'=>'80'));
        $mform ->addElement('textarea', 'cuerpo', get_string('body', 'block_aveseguimiento'), 'wrap="virtual" rows="10" cols="80"');
        $mform ->addRule('cuerpo', null, 'required');

        $mform ->addElement('checkbox', 'aviso_legal', get_string('aviso_legal', 'block_aveseguimiento'), 
            get_string('aviso_legal2', 'block_aveseguimiento', get_config('aveseguimiento', 'aviso_legal'))
        );
        $mform ->addRule('aviso_legal', null, 'required');
        
        $mform ->addElement('static', 'nota', '', get_config('aveseguimiento', 'nuevo_ticket_pie'));
        
/*
        $mform->setType('userfile', PARAM_FILE);
        //$mform->setType('courseid', PARAM_INT);
*/
        $mform->addElement('hidden', 'courseid',  $COURSE ->id);
        $mform->addElement('hidden', 'userid', $USER ->id);

        // Buttons.
        $this->add_action_buttons(false, get_string('save', 'block_aveseguimiento'));
    }

    public function validation($data, $files) {
        $errors = parent::validation($data, $files);
        return $errors;
    }
}
