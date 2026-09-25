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
 * Prime course renderer.
 *
 * @package   theme_prime
 * @copyright 2026 prime (https://learingo.cl/)
 * @author    prime
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_prime\output\core;

defined('MOODLE_INTERNAL') || die();

use html_writer;
use moodle_url;
use core_course_category;

require_once($CFG->dirroot . '/course/renderer.php');

/**
 * Course renderer class.
 */
class course_renderer extends \core_course_renderer {

    /**
     * Override to always show courseimage container even when no image exists.
     *
     * @param \coursecat_helper $chelper The coursecat helper.
     * @param \stdClass|\core_course_list_element $course The course object.
     * @param string $additionalclasses Additional CSS classes.
     * @return string
     */
    protected function coursecat_coursebox(
        \coursecat_helper $chelper,
        $course,
        $additionalclasses = ''
    ) {
        $page = $this->page;

        // Customize.
        // - Front page.
        // - Course list /course/.
        if ($page->pagetype !== 'site-index' &&
            $page->pagetype !== 'course-index-category') {

            return parent::coursecat_coursebox(
                $chelper,
                $course,
                $additionalclasses
            );
        }

        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }

        if ($course instanceof \stdClass) {
            $course = new \core_course_list_element($course);
        }

        // Get the image URL.
        $imageurl = $this->get_course_image($course);

        // Get the category.
        $categoryname = '';

        $category = core_course_category::get(
            $course->category,
            IGNORE_MISSING
        );

        if ($category) {
            $categoryname = $category->name;
        }

        // Course container.
        $output = html_writer::start_tag('div', [
            'class' => trim('coursebox clearfix ' . $additionalclasses),
            'data-courseid' => $course->id,
            'data-type' => self::COURSECAT_TYPE_COURSE,
        ]);

        // Info.
        $output .= html_writer::start_tag('div', [
            'class' => 'info',
        ]);

        $output .= html_writer::tag(
            'h3',
            html_writer::link(
                new moodle_url('/course/view.php', [
                    'id' => $course->id,
                ]),
                $chelper->get_course_formatted_name($course)
            ),
            [
                'class' => 'coursename',
            ]
        );

        $output .= html_writer::div('', 'moreinfo');

        $output .= html_writer::end_tag('div');

        // Content.
        $output .= html_writer::start_tag('div', [
            'class' => 'content',
        ]);

        $output .= html_writer::start_tag('div', [
            'class' => 'd-flex',
        ]);

        // Image.
        $output .= html_writer::start_tag('div', [
            'class' => 'courseimage',
        ]);

        if ($imageurl) {
            $output .= html_writer::img(
                $imageurl,
                ''
            );
        }

        $output .= html_writer::end_tag('div');

        // Category.
        $output .= html_writer::start_tag('div', [
            'class' => 'flex-grow-1 categoria',
        ]);

        if ($categoryname) {
            $output .= html_writer::tag(
                'span',
                $categoryname,
                [
                    'class' => 'labels categoryname',
                ]
            );
        }

        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div'); // D-flex.
        $output .= html_writer::end_tag('div'); // Content.
        $output .= html_writer::end_tag('div'); // Coursebox.

        return $output;
    }

    /**
     * Get the course image URL.
     *
     * @param \core_course_list_element $course The course object.
     * @return string
     */
    protected function get_course_image($course) {
        global $CFG;

        $url = '';

        // Look for an uploaded image in the course.
        foreach ($course->get_course_overviewfiles() as $file) {
            if ($file->is_valid_image()) {
                $url = moodle_url::make_file_url(
                    "$CFG->wwwroot/pluginfile.php",
                    '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                    $file->get_filearea() . $file->get_filepath() . $file->get_filename(),
                    false
                );
                break;
            }
        }

        // If there is no image, use the default image.
        if (empty($url)) {
            $url = $CFG->wwwroot . '/theme/prime/pix/no-image.jpg';
        }

        return (string) $url;
    }
}