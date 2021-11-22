/* Write here your custom javascript codes */
jQuery(document).ready(function () {
    $(".autolink").each(function () {
        $(this).html($(this).html().replace(/((http|https):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank" rel="noopener">$1</a> '));
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.ets2mp-modal').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
});
