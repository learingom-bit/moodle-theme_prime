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
 * Theme Prime custom scripts.
 *
 * @module     theme_prime/scripts
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function() {

    return {
        init: function() {

            // Custom accordions.
            const accordions = document.querySelectorAll('.custom-accordion');

            accordions.forEach(function(accordion) {

                const headers = accordion.querySelectorAll('.custom-accordion-header');

                headers.forEach(function(header) {

                    header.addEventListener('click', function() {

                        const item = this.closest('.custom-accordion-item');

                        accordion.querySelectorAll('.custom-accordion-item.active')
                            .forEach(function(activeItem) {

                                if (activeItem !== item) {
                                    activeItem.classList.remove('active');
                                }
                            });

                        item.classList.toggle('active');

                    });

                });

            });

            // Responsive tabs.
            const tabContainers = document.querySelectorAll('.custom-tabs');

            tabContainers.forEach(function(container) {

                const buttons = container.querySelectorAll('.custom-tab-button');
                const contents = container.querySelectorAll('.custom-tab-content');

                buttons.forEach(function(button) {

                    button.addEventListener('click', function() {

                        const target = this.getAttribute('data-tab');

                        buttons.forEach(function(btn) {
                            btn.classList.remove('active');
                        });

                        contents.forEach(function(content) {
                            content.classList.remove('active');
                        });

                        this.classList.add('active');

                        const targetContent = container.querySelector(
                            '[data-content="' + target + '"]'
                        );

                        if (targetContent) {
                            targetContent.classList.add('active');
                        }

                    });

                });

            });

        }
    };
});