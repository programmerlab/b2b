var App = {

    callFunction: function (name, arguments) {

        var fn = window[name];

        if (typeof fn !== 'function')
            return;

        fn.apply(window, arguments);
    },

    local: {
        currency: function (id) {
            if (!id) {
                return Data.local.currency;
            }

            return Data.local.currencies[id]
        }
    },

    click: function (id) {
        $(id).click();
    },

    trigger: function (id) {
        $(id).click();
    },

    redirect: function (url, message) {

        App.dimmer.page(message);

        setTimeout(function () {
            window.location = url;
        }, 1000);
    },

    reload: function () {
        location.reload();
    },

    load: function (id, url) {

        App.dimmer.page();

        $.each($('.close'), function (key, item) {
            $(item).click();
        });

        $(id).load(url, function (response, status, xhr) {
            App.dimmer.remove();
            App.run();
            if (status == "error") {
                App.message('error', Data.lang.error.reload);
                status = false;
                return false;
            }
        });
    },

    remove: function (id, call) {
        $(id).fadeOut('slow', function () {
            $(id).remove();
            App.tool.call(call);
        });
    },

    dimmer: {

        message: null,

        createLoading: function (message) {

            if (!message) {
                message = Data.lang.reload;
            }

            App.dimmer.message = '<div id="dimmer" class="ui active inverted dimmer"><div class="ui large text loader">' + message + '</div></div>';

            return App.dimmer.message;
        },

        page: function (message) {
            $('#pageDimmer').empty().append(App.dimmer.createLoading(message));
        },

        remove: function () {
            $('#dimmer').remove();
        }
    },

    message: function (status, text, title) {

        toastr.clear();

        toastr.options = {
            "closeButton"    : true,
            "debug"          : false,
            "progressBar"    : true,
            "positionClass"  : "toast-top-right",
            "timeOut"        : "10000",
            "extendedTimeOut": "1000",
            "showEasing"     : "swing",
            "hideEasing"     : "linear",
            "showMethod"     : "fadeIn",
            "hideMethod"     : "fadeOut"
        };

        if (status == 'error') {
            toastr.error(text, title);
        } else if (status == 'success') {
            toastr.success(text, title);
        } else if (status == 'info') {
            toastr.info(text, title);
        } else {
            toastr.warning(text, title);
        }

        return true;
    },

    form: {

        disableButton: function () {
            $('.button.save').addClass('disabled');
        },

        activeButton: function () {
            $('.button.save').removeClass('disabled');
        },

        submit: function (formId) {
            $(formId + ' .submit').click();
        },

        fake: function (action, html) {
            var form = $('#fakeForm');
            form.attr('data-action', '');

            form.find('.data').html(html);
            form.attr('data-action', action);

            App.form.action = form.attr('data-action');
            return App.form.send('#fakeForm', action);
        },

        copy: function (action, id) {
            App.form.send(id, action);
        },

        validate: function (formId, fields) {
            $(formId).form({
                fields   : fields,
                inline   : true,
                on       : 'blur',
                onSuccess: function () {
                    App.form.send(formId);
                    return false;
                },
                onFailure: function () {
                    App.form.activeButton();
                    return false;
                }
            });
        },

        send: function (formId, action) {

            form = $(formId);

            App.form.disabled(form);

            if (!action) {
                action = form.data('action');
            }

            App.editor.form();

            form.ajaxSubmit({
                url     : action,
                type    : 'post',
                dataType: 'json',
                success : App.form.response.success,
                error   : App.form.response.error,
                data    : $(form.data('forms')).serializeArray()
            });
        },

        disabled: function (form) {
            App.form.disableButton();
            form.addClass('loading');
        },

        active: function (form) {
            App.dimmer.remove();
            App.form.activeButton();
            form.removeClass('loading');
        },

        response: {

            data: null,

            success: function (response, jqForm, options, form) {

                App.form.response.data = response;

                App.form.active(form);

                if (response.remove) {
                    $.each(response.remove, function (index, el) {
                        App.remove(el);
                    });
                }

                if (response.trigger) {
                    $.each(response.trigger, function (index, el) {
                        App.trigger(el);
                    });
                }

                if (response.redirect) {
                    return App.redirect(response.redirect.url, response.redirect.message);
                }

                App.message('success', response.success);

                return true;
            },

            error: function (response, jqForm, options, form) {

                App.form.response.data = response;

                App.form.active(form);

                if (response.trigger) {
                    $.each(response.trigger, function (index, el) {
                        App.trigger(el);
                    });
                }

                if (response.redirect) {
                    return App.redirect(response.redirect.url, response.redirect.message);
                }

                if (response.status == 400) {
                    var json = App.tool.textToJson(response.responseText);

                    return App.message('error', json.error);
                }

                if (response.status == 401) {

                    var json = App.tool.textToJson(response.responseText);

                    return App.message('error', json.message, json.title);
                }

                if (response.status == 422) {

                    var responseJson = App.tool.textToJson(response.responseText);

                    $.each(responseJson, function (index, el) {
                        App.message('error', el);
                    });

                    return false;
                }

                if (response.status == 404) {
                    return App.message('error', Data.lang.error.notFound);
                }

                if (response.status == 500 || response.status == 502) {
                    return App.message('error', Data.lang.error.default);
                }

                App.message('error', response.error);

                return false;
            }
        }
    },

    modal: {

        open: function (id, setting) {
            $(id)
                .modal('refresh')
                .modal(setting)
                .modal('show')
                .modal('refresh')
            ;
        },

        close: function (id, setting) {
            $(id)
                .modal('hide');
        },

        delete: function () {

            $('.multiple.destroy').click(function () {
                var item = $(this);
                App.modal.open('#modalApprove', {
                    allowMultiple: true,
                    closable     : false,
                    onApprove    : function () {

                        var current = Data.route.current.as;

                        if (item.data('dataid')) {
                            current = item.data('dataid');
                        }

                        App.dimmer.page(Data.lang.wait);
                        App.form.fake(item.data('action'), $('#data-' + current).html());

                        return true;
                    }
                });
            });

            $('.modal.delete').click(function () {
                var data = $(this).parent().parent().parent().next();
                var item = $(this);

                App.modal.open('#modalApprove', {
                    closable     : false,
                    allowMultiple: true,
                    onApprove    : function () {
                        App.dimmer.page(Data.lang.wait);
                        App.form.fake(item.data('action'), data.html());

                        return true;
                    }
                });
            });

            $('.modalDelete').click(function () {
                var data = $(this).parent().parent().parent().parent().next();
                var item = $(this);

                App.modal.open('#modalApprove', {
                    closable     : false,
                    allowMultiple: true,
                    onApprove    : function () {
                        App.dimmer.page(Data.lang.wait);
                        App.form.fake(item.data('action'), data.html());

                        return true;
                    }
                });
            });
        },

        filemanagerSettting: {},

        filemanager: function (id, type) {

            if (!type) {
                type = 'one';
            }

            App.modal.filemanagerSettting.type = type;
            App.modal.filemanagerSettting.id   = id;

            $('#modalFileManager').find('.content').html('<iframe src="' + Data.link.filemanager + '" frameborder="0" style="border:0px; background:transparent; overflow-y: hidden; min-height: 500px; margin-bottom: -2px; width: 100%"></iframe>');
            App.modal.open('#modalFileManager', {
                allowMultiple: true
            });
        },

        run: function () {
            App.modal.delete();
        }
    },

    tool: {
        textToJson: function (string) {
            return JSON.parse(string);
        },

        lang: {

            first: function () {

                $('.field.lang').each(function (index, el) {
                    $(el).find('.tab').removeClass('active');
                });

                $('.field.lang').each(function (index, el) {
                    var item = $(el).find('.menu .active').first();
                    $("div[data-tab='" + item.data('tab') + "']").trigger('click');
                });
            },

            click: function () {
                $('.field.lang .menu .item').on('click', function () {
                    $('.field.lang .dropdown').removeClass('active');

                    $('.field.lang .menu.transition')
                        .removeClass('visible')
                        .removeAttr('style')
                        .removeClass('transition')
                });
            },

            run: function () {
                App.tool.lang.first();
                App.tool.lang.click();
            }
        },

        image: {
            remove: function (id) {
                $(id).find('img').attr('src', Data.theme.noimage);
                $(id).find('input').val('');
            }
        },

        row: {
            append: function (action, id, message, data) {

                App.dimmer.page(message);

                $.get(action, data, function (response) {
                    $(id).append(response);
                    App.dimmer.remove();
                    App.run();
                });
            },

            change: function (action, id, message, formData, call) {

                App.dimmer.page(message);

                var responseData = null;

                $.get(action, formData, function (response) {

                    $(id).after(response);

                    App.dimmer.remove();

                    App.run();

                    $(id).remove();

                    responseData = response;

                    App.tool.call(call);
                });

                return responseData;
            },

            remove: function (id, call) {
                $('#onApproveModal').modal({
                    closable     : false,
                    allowMultiple: true,
                    onDeny       : function () {
                        return true;
                    },
                    onApprove    : function () {
                        App.remove(id, call);
                        return true;
                    }
                }).modal('show');
            }
        },

        currency: {

            setFormat: function () {
                $('.currency.format.set').each(function (i, el) {

                    var item = $(el);

                    item.html(
                        App.tool.currency.format(
                            item.data('price')
                        )
                    );

                });
            },

            format: function (money, currencyId) {

                var currency = App.local.currency(currencyId);

                return accounting.formatMoney(money, {
                    symbol   : currency.symbol,
                    format   : currency.format,
                    precision: currency.step,
                    decimal  : currency.decimal,
                    thousand : currency.thousand
                });
            },

            run: function () {
                App.tool.currency.setFormat();
            }
        },

        date: {
            timepicker: function (item) {
                return App.tool.date.picker(item, 'H:i');
            },

            datepicker: function (item) {
                return App.tool.date.picker(item, 'Y-m-d');
            },

            datetimepicker: function (item) {
                return $(item).datetimepicker({
                    lang       : 'tr',
                    timepicker : true,
                    format     : 'Y-m-d H:i',
                    scrollMonth: false
                });
            },

            picker: function (item, setting) {
                return $(item).datetimepicker({
                    lang       : 'tr',
                    timepicker : false,
                    format     : setting,
                    scrollMonth: false
                });
            }
        },

        call: function (data) {
            $.each(data, function (key, el) {
                App.callFunction(el);
            });
        },

        upButton: function () {
            $('.upButton').click(function (event) {
                event.preventDefault();
                $('body,html').animate({
                    scrollTop: 0
                }, "slow");
            });

            jQuery(window).scroll(function ($) {
                "use strict";
                var scroll = jQuery(window).scrollTop();
                if (scroll >= 100) {
                    if (!Modernizr.mq('only all and (max-width: 1025px)')) {
                        jQuery('.upButton').addClass('show');
                    }
                } else {
                    jQuery('.upButton').removeClass('show');
                }
            });
        },

        run: function () {
            App.tool.lang.run();
            App.tool.currency.run();
            App.tool.upButton();
        }
    },

    component: {
        semanticui: {
            dropdown: function () {
                $('.dropdown').dropdown({
                    transition: 'drop'
                });

                $('.tag.dropdown').dropdown({
                    transition    : 'drop',
                    allowAdditions: true
                });
            },

            tab: function () {
                $('.tabs .menu .item').tab();
                $('.field.lang .dropdown .menu .item').tab();
                $('.tabular .item').tab();
            },

            dimmer: function () {
                $('.special.card .image').dimmer({

                    on: 'hover'
                });
            },

            accordion: function () {
                $('.ui.accordion.global').accordion();
            },

            checkbox: function () {
                $('.ui.checkbox').checkbox();

                $('.ui.checkbox.all.select').checkbox({
                    onChecked  : function () {
                        $($(this).data('class')).checkbox('set checked');
                    },
                    onUnchecked: function () {
                        $($(this).data('class')).checkbox('set unchecked');
                    }
                });
            },

            tableSort: function () {
                $('.table.sortable').tablesort();
            },

            toggle: {

                table: function (currentId) {

                    $('.tableToggle')
                        .checkbox({
                            onChange: function () {

                                var current = Data.route.current.as;

                                if (currentId) {
                                    current = currentId;
                                }

                                var text = '';

                                $.each($('#table-' + current + ' .tableToggle.checked'), function (i, el) {
                                    text += ',' + $(el).find('input').val();
                                });

                                $('#data-' + current + ' input').first().val(text.substring(1));
                            }
                        })
                        .checkbox('attach events', '.tableToggleSelect')
                    ;
                },

                tableToggleSet: function (id, current) {
                    $(id + '.tableToggle')
                        .checkbox({
                            onChange: function () {

                                var text = '';
                                $.each($('#table-' + current + ' .tableToggle.checked'), function (i, el) {
                                    text += ',' + $(el).find('input').val();
                                });
                                $('#data-' + current + ' input').first().val(text.substring(1));
                            }
                        })
                        .checkbox('attach events', id + '.tableToggleSelect')
                    ;
                },

                button: function () {

                    $('.ui.toggle.button')
                        .state({
                            text        : {
                                inactive  : '<i class="hide icon"></i>',
                                active    : '<i class="unhide icon"></i>',
                                activate  : '<i class="unhide icon"></i>',
                                deactivate: '<i class="hide icon"></i>',
                            },
                            onActivate  : function () {
                                var item = $(this).data();
                                App.form.fake(item.actionactive, '<input type="hidden" name="id" value="' + item.id + '">');
                            },
                            onDeactivate: function () {
                                var item = $(this).data();
                                App.form.fake(item.actionpassive, '<input type="hidden" name="id" value="' + item.id + '">');
                            }
                        });
                }
            },

            popup: function () {
                $('.pop').popup();
            },

            progress: function () {
                $('.ui.progress').progress();
            },

            form: function (formId, fields) {
                $(formId).form({
                    fields: fields,
                    on    : 'blur'
                });
            },

            run: function () {
                App.component.semanticui.dropdown();
                App.component.semanticui.tab();
                App.component.semanticui.dimmer();
                App.component.semanticui.accordion();
                App.component.semanticui.checkbox();
                App.component.semanticui.tableSort();
                App.component.semanticui.toggle.table();
                App.component.semanticui.toggle.button();
                App.component.semanticui.popup();
                App.component.semanticui.progress();
            }
        },

        colorpick: function () {
            if (!$.minicolors) {
                return false;
            }

            $("input[name='text_color'], input[name='bg_color'], .color.picker").minicolors({
                control : "brightness",
                theme   : "semanticui",
                format  : 'rgb',
                opacity : true,
                swatches: [
                    'rgba(219, 40, 40, 1)',
                    'rgba(251, 189, 8, 1)',
                    'rgba(33, 186, 69, 1)',
                    'rgba(33, 133, 208, 1)',
                    'rgba(100, 53, 201, 1)',
                    'rgba(224, 57, 151, 1)',
                    'rgba(151, 91, 51, 1)'
                ]
            });
        },

        run: function () {
            App.component.semanticui.run();
            App.component.colorpick();
        }
    },

    editor: {
        tinymce: function (el) {

            if (!el) {
                el = '.editor';
            }

            tinymce.init({
                selector               : el,
                theme                  : "modern",
                language               : Data.local.lang.iso_code,
                plugins                : "colorpicker link image paste pagebreak table contextmenu table code media autoresize textcolor anchor",
                browser_spellcheck     : true,
                toolbar1               : "code,|,bold,italic,underline,strikethrough,|,alignleft,aligncenter,alignright,alignjustify,|,formatselect,blockquote,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,media,image",
                toolbar2               : "",
                menu                   : {},
                statusbar              : false,
                relative_urls          : false,
                convert_urls           : false,
                entity_encoding        : "raw",
                extended_valid_elements: "em[class|name|id]",
                valid_children         : "+body[style], +style[type]",
                verify_html            : false,
                height                 : 500,
                force_br_newlines      : false,
                force_p_newlines       : false,
                forced_root_block      : '',
                file_browser_callback  : App.editor.browser
            });
        },

        form: function () {
            if (typeof tinyMCE != 'undefined') {
                tinyMCE.triggerSave();
            }
        },

        browser: function (field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file     : Data.link.filemanager,
                title    : 'Dosya YÃ¶neticisi',
                width    : 1024,
                height   : 500,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
        },

        mirror: function (id) {
            var textarea = document.getElementById(id);
            var id       = $('#' + id);
            var mode     = id.data('mode');
            if (!mode) {
                mode = "text/html";
            }

            var editor = CodeMirror.fromTextArea(textarea, {
                mode          : mode,
                content       : textarea.value,
                lineNumbers   : true,
                lineWrapping  : true,
                electricChars : false,
                theme         : "eclipse",
                matchBrackets : true,
                indentUnit    : 4,
                indentWithTabs: true
            });

            editor.on("blur", function () {
                id.val(editor.getValue());
            });
        },
    },

    fill: {

        row: {
            brand: function (row) {
                return '<div class="item" data-value="' + row.id + '" data-title="' + row.name + '">' + row.name + '</div>';
            },

            zone: function (row) {
                return '<div class="item" data-value="' + row.id + '" data-title="' + row.text.title + '">' + row.text.title + '</div>';
            }
        },

        run: function () {
            if (!$('div').hasClass('field fill')) {
                return false;
            }

            $('.field.fill').each(function (key, val) {

                var base = $(val);

                base.find('.ui.dropdown.search').dropdown({
                    onChange: function (value, text, item) {

                        var fill   = $(base.data('fill'));
                        var childs = base.data('child').split(",");

                        $.each(childs, function (keyChild, valChild) {
                            $(valChild).find('.ui.dropdown').dropdown('clear');
                            $(valChild).find('.ui.dropdown .menu').empty();
                        })

                        App.dimmer.page();

                        $.getJSON(base.data('uri'), {parent: value}, function (rows) {
                            $.each(rows, function (keyRow, row) {
                                fill.find('.ui.dropdown .menu').append(window["App"]["fill"]["row"][base.data('type')](row));
                            });

                            App.dimmer.remove();
                        });
                    }
                });
            });
        }
    },

    search: {

        content: function (row) {
            App.search.setFields('content', row);
        },

        user: function (row) {
            App.search.setFields('user', row);
        },

        brand: function (row) {
            App.search.setFields('brand', row);
        },

        setFields: function (field, row) {
            $.each(row, function (key, val) {
                $('.' + field + '.' + key).val(val);
            });
        },

        start: function (search) {

            var data      = search.data();
            var propertis = {
                apiSettings   : {url: data.url},
                cache         : false,
                searchFields  : ['title'],
                searchFullText: false,
                minCharacters : 1,
                onSelect      : function (row, response) {
                    window["App"]["search"][data.call](row);
                }
            };

            if (data.type) {
                propertis.type = data.type;
            } else {
                delete propertis.type;
            }

            return search.search(propertis);
        },

        run: function (set) {

            if (!$('div').hasClass('ui search')) {
                return false;
            }

            $('.ui.search').each(function (key, val) {
                App.search.start($(this));
            });
        }
    },

    misc: {
        licence: function () {

            $('#license').html(App.dimmer.createLoading(Data.lang.info.license));

            $.getJSON(Data.link.license, {
                format  : 'json',
                client  : Data.client,
                product : Data.product,
                customer: Data.customer,
            }, function (response) {
                $('#license').html(response.layout);
            }).fail(function () {
                App.dimmer.remove();
                App.message('warning', Data.lang.error.license);
            });
        }
    },

    run: function () {
        App.component.run();
        App.modal.run();
        App.tool.run();
        App.fill.run();
        App.search.run();
    }

}

$(document).ready(function () {
    $.fn.form.settings.prompt = Data.lang.prompt;

    App.run();
});

var earth = angular.module("Earth", []);