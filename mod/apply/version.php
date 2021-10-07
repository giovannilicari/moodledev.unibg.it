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
 * Apply version information
 *
 * @package    mod
 * @subpackage apply 
 * @author     Fumi Iseki
 * @license    GPL
 * @attention  modified from mod_feedback that by Andreas Grabs
 */

defined('MOODLE_INTERNAL') || die();

$plugin->requires  = 2012120300;    // Moodle 2.4
$plugin->component = 'mod_apply';   // Full name of the module (used for diagnostics)
$plugin->cron      = 0;
$plugin->maturity  = MATURITY_STABLE;

$plugin->release   = '1.3.6';       // update messages

$plugin->version   = 2019081800;    // minor change for 3.7.1
//$plugin->version = 2018101000;    // support table
//$plugin->version = 2018100300;    //
//$plugin->version = 2016062800;    // 

