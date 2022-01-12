/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define(['jquery', 'jqueryui', 'core/ajax', 'core/str', 'core/form-autocomplete', 'core/notification', 'core/templates', 'core/url'],
        function ($, JqUi, Ajax, str, Autocomplete, notification, Templates, URL) {
            var manager = {
                setup: function () {
                    $(document).on('change', '#id_state', manager.state_dropdown);
                    $(document).on('change', '#id_city', manager.city_dropdown);
                    $(document).on('click', '.approve_button, .deny_button', manager.approve_request);
                    $(document).on('click', '.page-link', manager.pagination);
                },
                state_dropdown: function () {
                    var state = $("#id_state").val();
                    $.ajax({
                        type: 'POST',
                        data: {state: state,
                            action: "city"},
                        url: 'classes/ajax.php',
                        success: function (results) {
                            $('#id_city').html(results);
                            var city = $('#id_city').val();
                            $('#cityid').val(city);
                        }
                    });

                },
                city_dropdown: function () {
                    var city = $('#id_city').val();
                    $('#cityid').val(city);
                },
                approve_request: function () {

                    var mentorid = $(this).attr('id');
                    var status = $(this).attr('status');
                    var WAITICON = {'pix': M.util.image_url("i/loading_small", 'core'), 'component': 'moodle'};
                    var loader = $('<img />')
                            .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                            .addClass('spinner');
                    ;

                    $(" .data-procession" + mentorid).html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                    $.ajax({
                        type: 'POST',
                        data: {mentor: mentorid,
                            action: "approve",
                            status: status},
                        url: 'classes/ajax.php',
                        success: function (results) {
                            $(" .data-procession" + mentorid).html(results);
                        }
                    });
                },
                pagination: function (e) {
                    e.preventDefault();
                    var page_val = $(this).attr('href');
                    var page = getURLParameter('page', page_val);
                    if (isNaN(page)) {
                        e.preventDefault();
                    } else {
                        var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                        var loader = $('<img />')
                                .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                                .addClass('spinner');
                        ;
                        $('.mentor-request-list').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                        $.ajax({
                            type: 'POST',
                            data: {page: page,
                                action: "pagination",
                            },
                            url: 'classes/ajax.php',
                            success: function (results) {
                                $('.mentor-request-list').html(results);
                            }
                        });
                    }
                },

            };
            function getURLParameter(name, page_val) {
                return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(page_val) || [null, ''])[1].replace(/\+/g, '%20')) || null;
            }
            return {
                setup: manager.setup
            };
        });