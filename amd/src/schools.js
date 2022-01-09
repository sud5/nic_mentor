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
                    $(document).on('keyup', '#schoolnames', delay(manager.text_filter, 1000));
                    $(document).on('click', '.showmentor', manager.show_mentors);
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
                        var name = $("#schoolnames").val();
                        var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                        var loader = $('<img />')
                                .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                                .addClass('spinner');
                        ;
                        $('.school-list-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                        promise = Ajax.call([{
                                methodname: 'local_school_list',
                                args: {
                                    page: page,
                                    name: name

                                }
                            }]);

                        promise[0].then(function (results) {
                            $('.school-list-report').html(results.html);
                        }).fail(notification.exception);
                    }
                },
                text_filter: function () {
                    var promise;
                    var name = $("#schoolnames").val();
                    var WAITICON = {'pix': M.util.image_url("loading", 'local_mentor'), 'component': 'moodle'};
                    var loader = $('<img />')
                            .attr('src', M.util.image_url(WAITICON.pix, WAITICON.component))
                            .addClass('spinner');
                    ;
                    $('.school-list-report').html('<div class="text-center">' + loader.get(0).outerHTML + '</div>');
                    promise = Ajax.call([{
                            methodname: 'local_school_list',
                            args: {
                                page: 0,
                                name: name
                            }
                        }]);

                    promise[0].then(function (results) {
                        $('.school-list-report').html(results.html);
                    }).fail(notification.exception);

                },
                show_mentors: function () {
                    var title = $(this).attr('title');
                    var mentorlist = $(this).attr('mentorlist');
                    $('#basicModal').modal({show: true});
                    $("#myModalLabel").html("<h4>" + title + "</h4>");
                    $('.modal-body-data').html(mentorlist);
                }
            };

            return {
                setup: manager.setup
            };
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