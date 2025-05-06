import swal from 'sweetalert';

(function ($) {
    'use strict';

    const admin = {
        deleteUserImage: function () {
            $('#delete-image').on('click', function () {
                swal({
                    title: "Удалить изображение?",
                    text: "Данное изображение будет удалено, продолжить?",
                    icon: "warning",
                    buttons: ["Отмена", "Удалить"],
                    dangerMode: true,
                })
                    .then((response) => {
                        if (response) {
                            swal("Изображение успешно удалено!", {
                                icon: "success",
                            });
                            ajaxDelete($(this));
                        }
                    });
            });

        },

        authUserBtn: function () {
            $('.auth-user').on('click', function (e) {
                e.preventDefault();
                swal({
                    title: "Авторизация",
                    text: "Авторизуемся за данного пользователя?",
                    icon: "warning",
                    buttons: ["Отмена", "Авторизация"],
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Вы авторизовались!", {
                                icon: "success",
                            });
                            ajax($(this));
                        }
                    });
            });
        },

        minimizeSidebar: function () {
            const $body = $('body.sidebar-mini');
            const $btn = $body.find('.main-header .navbar-nav .nav-item .nav-link[data-widget="pushmenu"]');

            if (localStorage.getItem('sidebarCollapsed') === 'false') {
                $body.addClass('sidebar-collapse');
            }
            $btn.on('click', function () {
                localStorage.setItem('sidebarCollapsed', $body.hasClass('sidebar-collapse'));
            });

        },

        /* filter panel */
        filterPanel: function () {
            const panel = $('#filterCollapse');
            if (localStorage.getItem('filterCollapsed') === 'true') {
                panel.collapse('hide');
            }

            panel.on('hide.bs.collapse', function () {
                localStorage.setItem('filterCollapsed', 'true');
            });
            panel.on('show.bs.collapse', function () {
                localStorage.setItem('filterCollapsed', 'false');
            });
        },

        init: function () {
            admin.deleteUserImage();
            admin.authUserBtn();
            admin.filterPanel();
            admin.minimizeSidebar();
        }
    };

    admin.init();

})(jQuery);


$(function () {

    /* tooltips */
    $('[data-toggle="tooltip"]').tooltip();

    /* select2 multi */
    $(".multi-select2").select2({
        allowClear: true,
        tags: [],
        tokenSeparators: [",", " "],
    });

    /* select2 multi only choose*/
    $(".multi-select2-only-choose").select2({
        allowClear: true,
        maximumSelectionLength: 2
    });

    /* select2 one select */
    $(".one-select2").select2();

    /* select2 one select tags*/
    $(".one-select2.tags").select2({
        tags: true,
        tokenSeparators: [",", " "],
    });

    /* Bootstrap Switch checkbox*/
    $(".switch-checkbox").bootstrapSwitch();

    /* summernote text-editor*/
    $('.summernote').summernote({
        height: 300,
        minHeight: 200,
        maxHeight: 800,
        placeholder: 'Введите текст',
    });
    /* input file */
    bsCustomFileInput.init();

    // Автоматическая отправка формы при изменении количества элементов на странице
    $('select[name="per_page"]').change(function () {
        $(this).closest('form').submit();
    });

    // Инициализация DateRangePicker для фильтра дат
    $('input[name="filter[created_between]"]').datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '2020:' + (new Date()).getFullYear(),
        maxDate: new Date(),
        dateFormat: 'yy-mm-dd',
        onSelect: function (dateText, inst) {
            $(this).trigger('change');
        }

    });

})


/**
 * Flash-уведомление
 * @param msg
 * @param title
 */
function flash(msg, title = 'Уведомление', className = '') {
    $(document).Toasts('create', {
        title: title,
        body: msg,
        class: 'm-5 ' + className,
        position: 'bottomRight',
        autohide: true,
        delay: 5000,
    });
}


function ajaxDelete($this, parentElement = '.image-wrap') {
    $.ajax({
        type: 'post',
        url: $this.data('url'),
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {id: $this.data('id')},
        success: function (data) {
            $this.parents(parentElement).fadeOut(300);
            setTimeout(function () {
                $this.parents(parentElement).remove();
                flash('Изображение успешно удалено');
                console.log(data);
            }, 300);
        },
        error: function () {
            alert('Не удалось удалить');
        }
    });
}

function ajax($this, flash_msg = 'Успешно выполнено') {
    $.ajax({
        type: 'post',
        url: $this.data('url'),
        data: {id: $this.data('id')},
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            flash(flash_msg)
        },
        error: function () {
            alert('Ошибка!');
        }
    });
}