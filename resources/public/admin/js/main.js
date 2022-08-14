$(function () {

    /* tooltips */
    $('[data-toggle="tooltip"]').tooltip();

    /* select2 multi */
    $(".multi-select2").select2({
        allowClear: true,
        tags: [],
        tokenSeparators: [",", " "],

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


})