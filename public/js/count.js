$('[count]').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).attr('count-format')
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});