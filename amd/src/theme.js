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
 * Theme Prime AMD module.
 *
 * @module     theme_prime/theme
 * @copyright  2026 prime (https://learingo.cl/)
 * @author     prime
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'theme_prime/wow'], function($, WOW) {

    var Themeprime = function() {
        this.initialize();
    };

    Themeprime.prototype.initialize = function() {

        if (typeof WOW !== 'undefined') {
            new WOW({
                offset: 100,
                mobile: true,
                live: true
            }).init();
        }

        var img = $("nav#header").find('.avatar').find('img[src$="/u/f2"]');
        var src = img.attr('src');
        img.attr('src', src + "_white");

        if ($("#header .navbar-nav button").attr('aria-expanded') === "true") {
            $("#header .navbar-nav").find('button').addClass('is-active');
        }

        $("#header .navbar-nav button").click(function() {
            var This = $(this);
            setTimeout(function() {
                if (This.attr('aria-expanded') === "true") {
                    $("#header .navbar-nav").find('button').addClass('is-active');
                } else {
                    $("#header .navbar-nav").find('button').removeClass('is-active');
                }
            }, 200);
        });

        var foothtml = $('footer#page-footer').text();
        if ($.trim(foothtml).length == 0) {
            $('footer#page-footer').addClass('empty-footer');
        }

        var addhtml = $('.address-head').text();
        if ($.trim(addhtml).length == 0) {
            $('.address-head').addClass('empty-address');
        }

        var $val = $("#id_s_theme_prime_pagesize").val();
        if ($val == 'container' || $val == 'default') {
            $("#admin-pagesizecustomval").find('input[type=text]').attr('disabled', 'disabled');
        }

        $("#id_s_theme_prime_pagesize").on('change', function() {
            var $this = $(this);
            var val = $this.val();
            if (val == 'container' || val == 'default') {
                $("#admin-pagesizecustomval").find('input[type=text]').attr('disabled', 'disabled');
            } else {
                $("#admin-pagesizecustomval").find('input[type=text]').removeAttr('disabled');
            }
        });

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 150) {
                $('#backToTop').fadeIn('slow');
                $('#custom_save').fadeIn('slow');
            } else {
                $('#backToTop').fadeOut('slow');
            }
            if ($(this).scrollTop() >= $(window).height) {
                $('#backToTop').fadeOut('slow');
            }
        });

        $('#backToTop').click(function() {
            $("html, body").animate({scrollTop: 0}, 'slow');
            return false;
        });

        if ($('body').hasClass('pagelayout-frontpage')) {
            var contentselector = $('#page-wrapper #page #page-content .course-content #coursecontentcollapse1').find('ul');
            if (contentselector.hasClass('d-block')) {
                $('body').addClass('course-content-element');
            } else {
                $('body').removeClass('course-content-element');
            }
        }

        const drawerClass = () => {
            var drawer = document.querySelector('#page');
            if (drawer.classList.contains('show-drawer-right')) {
                $('.header-main').addClass('show-drawer-right');
            } else {
                $('.header-main').removeClass('show-drawer-right');
            }
        };

        $('#page .drawer-right-toggle [data-toggler="drawers"], .drawer.drawer-right [data-toggler="drawers"]').click(function() {
            setTimeout(drawerClass, 100);
        });

        drawerClass();

    };

    return {
        init: function() {
            new Themeprime();
        }
    };

});