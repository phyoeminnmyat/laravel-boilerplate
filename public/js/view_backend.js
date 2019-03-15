function load_plugins() {

    /**
     * Add the data-method="delete" forms to all delete links
     */
    addDeleteForms();

    /**
     * Disable all submit buttons once clicked
     */
    $('form').submit(function () {
        $(this).find('input[type="submit"]').attr("disabled", true);
        $(this).find('button[type="submit"]').attr("disabled", true);
        return true;
    });

    // Laravel ajax-token integration
    var _token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });

    /**
     * Bind all bootstrap tooltips & popovers
     */
    $("[data-toggle='tooltip']").tooltip();

    /**
     * Generic confirm form delete using Sweet Alert
     */
    $('body').on('submit', 'form[name=delete_item]', function (e) {
        e.preventDefault();

        var form = this,
            link = $('a[data-method="delete"]'),
            cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : "Cancel",
            confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : "Yes, delete",
            title = link.attr('data-trans-title') ? link.attr('data-trans-title') : "Are you sure you want to delete this item?";

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'warning'
        }).then(function (result) {
            result.value && form.submit();
        });
    }).on('click', 'a[name=confirm_item]', function (e) {
        /**
         * Generic 'are you sure' confirm box
         */
        e.preventDefault();

        var link = $(this),
            title = link.attr('data-trans-title') ? link.attr('data-trans-title') : "Are you sure you want to do this?",
            cancel = link.attr('data-trans-button-cancel') ? link.attr('data-trans-button-cancel') : "Cancel",
            confirm = link.attr('data-trans-button-confirm') ? link.attr('data-trans-button-confirm') : "Continue";

        swal({
            title: title,
            showCancelButton: true,
            confirmButtonText: confirm,
            cancelButtonText: cancel,
            type: 'info'
        }).then(function (result) {
            result.value && window.location.assign(link.attr('href'));
        });
    });
}

function addDeleteForms() {
    $('[data-method]').append(function () {
        if (!$(this).find('form').length > 0) return "\n" + "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" + "<input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" + "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>\n" + "</form>\n";else return "";
    }).removeAttr('href').attr('style', 'cursor:pointer;').attr('onclick', '$(this).find("form").submit();');
}

$(function () {
    load_plugins();
});