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
 * Admin settings configuration for promoted course section.
 *
 * @package    theme_prime
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined( 'MOODLE_INTERNAL' ) || die;

// Promoted Courses.
$temp = new admin_settingpage( 'theme_prime_promotedcourse', get_string( 'promotedcoursesheading', 'theme_prime' ) );
$temp->add( new admin_setting_heading( 'theme_prime_mycourses', get_string( 'mycoursessub', 'theme_prime' ),
format_text( get_string( 'mycoursesdesc', 'theme_prime' ), FORMAT_MARKDOWN ) ) );
// Promoted Courses Heading.
$name = 'theme_prime_promotedcoursesheading';
$heading = get_string( 'promotedcoursesheading', 'theme_prime' );
$information = '';
$setting = new admin_setting_heading( $name, $heading, $information );
$temp->add( $setting );

// Enable / Disable option for Promoted Courses.
$name = 'theme_prime/pcoursestatus';
$title = get_string( 'status', 'theme_prime' );
$description = get_string( 'statusdesc', 'theme_prime' );
$default = THEME_PRIME_YES;
$setting = new admin_setting_configcheckbox( $name, $title, $description, $default );
$temp->add( $setting );

// Enable / Disable option for my Courses.
$name = 'theme_prime/mcoursestatus';
$title = get_string( 'mcoursestatus', 'theme_prime' );
$description = get_string( 'mcoursestatusdesc', 'theme_prime' );
$default = 1;
$setting = new admin_setting_configcheckbox( $name, $title, $description, $default );
$temp->add( $setting );

// Promoted courses Block title.
$name = 'theme_prime/mromotedtitle';
$title = get_string( 'mromotedtitle', 'theme_prime' );
$description = '';
$default = get_string( 'mromotedtitledefault', 'theme_prime' );
$setting = new admin_setting_configtext( $name, $title, $description, $default );
$temp->add( $setting );

$name = 'theme_prime/titlemycourses';
$title = get_string( 'titlemycourses', 'theme_prime' );
$description = get_string( 'titlemycoursesdesc', 'theme_prime' );
$default = 'lang:titlemycoursesdefault';
$setting = new admin_setting_configtext( $name, $title, $description, $default );
$temp->add( $setting );

// Promoted courses block description.
$name = 'theme_prime/mycoursescoursedesc';
$title = get_string( 'mycoursescoursedesc', 'theme_prime' );
$description = get_string( 'mycoursescoursedesc_desc', 'theme_prime' );
$default = 'lang:mycoursescoursedesc_defaultc';
$setting = new admin_setting_configtextarea( $name, $title, $description, $default );
$temp->add( $setting );

// Promoted courses Block title.
$name = 'theme_prime/promotedtitle';
$title = get_string( 'title', 'theme_prime' );
$description = get_string( 'promotedtitledesc', 'theme_prime' );
$default = 'lang:promotedtitledefault';
$setting = new admin_setting_configtext( $name, $title, $description, $default );
$temp->add( $setting );

// Promoted courses block description.
$name = 'theme_prime/promotedcoursedesc';
$title = get_string( 'description', 'theme_prime' );
$description = get_string( 'description_desc', 'theme_prime' );
$default = 'lang:promotedcoursedesc_defaultc';
$setting = new admin_setting_configtextarea( $name, $title, $description, $default );
$temp->add( $setting );

// Exclude Courses ( multicheckbox ).
$name = 'theme_prime/excludecourse';
$title = get_string( 'excludecourse', 'theme_prime' );
$description = get_string( 'excludecoursedesc', 'theme_prime' );
$default = [];
$courses = [];
if ( $ccc = get_courses( 'all', 'c.sortorder ASC', 'c.id,c.shortname,c.visible,c.category' ) ) {
    foreach ($ccc as $cc) {
        if ( $cc->visible == '0' || $cc->id == '1' ) {
            continue;
        }
        $courses[$cc->id] = $cc->shortname;
    }
}
$setting = new admin_setting_configmulticheckbox( $name, $title, $description, $default, $courses );
$temp->add( $setting );

// Course Order.
$name = 'theme_prime/courseorder';
$title = get_string( 'courseorder', 'theme_prime' );
$description = get_string( 'courseorderdesc', 'theme_prime' );
$default = 'idasc';
$options = [
    'idasc' => get_string('courseorder_idasc', 'theme_prime' ),
    'iddesc' => get_string('courseorder_iddesc', 'theme_prime' ),
    'nameasc' => get_string('courseorder_nameasc', 'theme_prime' ),
    'namedesc' => get_string('courseorder_namedesc', 'theme_prime'),
];
$setting = new admin_setting_configselect( $name, $title, $description, $default, $options );
$temp->add( $setting );

// Promoted media.
$name = 'theme_prime/promotedmedia';
$title = get_string( 'media', 'theme_prime' );
$description = get_string( 'promotedmedia_desc', 'theme_prime' );
$default = '<img src="https://learingo.cl/prime.jpg">';
$setting = new admin_setting_configstoredfile( $name, $title, $description, 'promotedmedia', 0,
[ 'accepted_types' => 'web_image' ] );
$temp->add( $setting );


$settings->add( $temp );
