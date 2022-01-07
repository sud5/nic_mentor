/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define(['jquery', 'jqueryui', 'core/ajax', 'core/str', 'core/form-autocomplete', 'core/notification', 'core/templates', 'core/url'],
        function ($, JqUi, Ajax, str, Autocomplete, notification, Templates, URL) {
            var manager = {
                setup: function () {
                    $(document).on('click', '.page-link', manager.pagination);
                    $(document).on('keyup', '#city, #useremail', manager.text_filter);
                    $(document).on('change', '#state', manager.text_filter);
                },
                pagination: function (e) {
                    e.preventDefault();
                    var page_val = $(this).attr('href');
                    var page_val = page_val.match(/(\d+)/g);
                    var page_val = $.trim(page_val);
                    var page = parseInt(page_val);
                    if (isNaN(page)) {
                        e.preventDefault();
                    } else {
                        var promise;
//                        var programid = $("#program").attr('programid');
//                        var pfnumber = $("#pfnumber").val();
                        var email = $("#useremail").val();
                        var city = $("#city").val();
                        var state = $("#state").val();
                        var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                        var loader = $('<img />')
                                .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                                .addClass('spinner');
                        ;
                        $('.mentor-user-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                        promise = Ajax.call([{
                                methodname: 'local_mentor_get_mentor_report',
                                args: {
                                    page: page,
                                    city: city,
                                    email: email,
                                    state:state
                                    
                                }
                            }]);

                        promise[0].then(function (results) {
                            $('.mentor-user-report').html(results.html);
                        }).fail(notification.exception);
                    }
                },
                text_filter: function () {
                    var promise;
//                    var programid = $("#program").attr('programid');
//                    var pfnumber = $("#pfnumber").val();
                    var email = $("#useremail").val();
                    var city = $("#city").val();
                    var state = $("#state").val();
                    var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                    var loader = $('<img />')
                            .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                            .addClass('spinner');
                    ;
                    $('.mentor-user-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                    promise = Ajax.call([{
                            methodname: 'local_mentor_get_mentor_report',
                            args: {
                                page: 0,
                                email: email,
                                city: city,
                                state:state
//                                programid: programid,
                            }
                        }]);

                    promise[0].then(function (results) {
                        $('.mentor-user-report').html(results.html);
                    }).fail(notification.exception);

                }
            };

            return {
                setup: manager.setup
            };
        });