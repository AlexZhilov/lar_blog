import swal from 'sweetalert';

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

    /* delete image */
    $('#delete-image').on('click', function () {
        swal({
            title: "Удалить изображение?",
            text: "Данное изображение будет удалено, продолжить?",
            icon: "warning",
            buttons: ["Отмена", "Удалить"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Изображение успешно удалено!", {
                        icon: "success",
                    });
                    ajaxDelete($(this));
                }
            });
    });

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