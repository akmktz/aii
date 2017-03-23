$(document).ready(function ($) {

    // Alias generator init
    $('.js-alias-generate-btn').aliasGenerator({
        'from' : '.js-alias-generate-source',
        'to' : '.js-alias-generate-alias'
    });

    // Status change
    $('.js-status-switch').click(function () {
        var $this = $(this),
            $conf = $('.js-status-config'),
            $span = $this.find('span');
        if (!$conf.length || !$span.length) {
            return false;
        }
        var status = $this.data('status'),
            id = $this.data('id'),
            table = $conf.data('table-name'),
            classOn = $conf.data('class-on'),
            classOff = $conf.data('class-off');

        $span.hide();

        $.ajax({
            url: '/admin/set_status',
            method: 'POST',
            async: true,
            data: {
                id: id,
                table: table,
                status: (status > 0 ? 0 : 1)
            },
            success: function(result) {
                if (!result.success) {
                    return;
                }

                if (status > 0) {
                    $this.data('status', 0);
                    $span.removeClass(classOn);
                    $span.addClass(classOff);
                } else {
                    $this.data('status', 1);
                    $span.removeClass(classOff);
                    $span.addClass(classOn);
                }
                $span.show();
            },
            error: function() {
                $span.show()
            }
        });

        return false;
    });
});