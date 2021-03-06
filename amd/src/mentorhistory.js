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
                    $(document).on('keyup', '#useremail', delay(manager.text_filter, 1000));
                    $(document).on('click', '.showmentor', manager.show_mentors);
                },
                pagination: function (e) {
                    e.preventDefault();
                    var page_val = $(this).attr('href');
                    var page = getURLParameter('page', page_val);
                    if (isNaN(page)) {
                        e.preventDefault();
                    } else {
                        var promise;
                        var email = $("#useremail").val();
                        var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                        var loader = $('<img />')
                                .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                                .addClass('spinner');
                        ;
                        $('.mentor-history-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                        promise = Ajax.call([{
                                methodname: 'local_mentor_mentor_history',
                                args: {
                                    page: page,
                                    email: email

                                }
                            }]);

                        promise[0].then(function (results) {
                            $('.mentor-history-report').html(results.html);
                        }).fail(notification.exception);
                    }
                },
                text_filter: function () {
                    var promise;
                    var email = $("#useremail").val();
                    var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                    var loader = $('<img />')
                            .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                            .addClass('spinner');
                    ;
                    $('.mentor-history-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                    promise = Ajax.call([{
                            methodname: 'local_mentor_mentor_history',
                            args: {
                                page: 0,
                                email: email
                            }
                        }]);

                    promise[0].then(function (results) {
                        $('.mentor-history-report').html(results.html);
                    }).fail(notification.exception);

                },
                show_mentors: function () {
                    var title = $(this).attr('title');
                    var mentorlist = $(this).attr('mentorlist');
                    $('#basicModal').modal({show: true});
                    $("#myModalLabel").html("<h4>" + title + "</h4>");
                    var dwnload = $(this).attr('schoollink');
                    $('form').attr('action', dwnload);
                    var mid = $(this).attr('mentorid');
                    $('#reportid').val(mid);
                    $('.download-link').attr('style', 'none');
                    $('.modal-body-data').html(mentorlist);
                }
            };

            return {
                setup: manager.setup
            };
            function getURLParameter(name, page_val) {
                return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(page_val) || [null, ''])[1].replace(/\+/g, '%20')) || null;
            }
            //Function for delay the keyup event
            function delay(callback, ms) {
                var timer = 0;
                return function () {
                    var context = this, args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }
        });