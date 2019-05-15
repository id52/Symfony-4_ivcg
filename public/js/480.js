$(".menu-visa-link").click(function (e) {
    e.preventDefault();
    var region = $(this).data('region');
    $(".region-flags").hide();
    $(".region-flags[data-region='" + region + "']").fadeIn('slow');

    $("#text-flag > span").hide();
    $("#text-flag").find("span[data-region='" + region + "']").fadeIn('slow');


    $(this).closest('table').find('div').removeClass('link-flag-short-active');
    $(this).closest('table').find('div').removeClass('link-flag-long-active');
    $(this).closest('table').find('.region-info').hide();


    if ($(this).closest('div').hasClass('link-flag-short')) {
        $(this).closest('div').addClass('link-flag-short-active');
    }

    if ($(this).closest('div').hasClass('link-flag-long')) {
        $(this).closest('div').addClass('link-flag-long-active');
    }

    $(".region-info[data-region='" + region + "']").fadeIn('slow');

});

$('.menu-visa-link').first().trigger('click');