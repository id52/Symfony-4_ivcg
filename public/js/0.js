var phones = document.getElementsByClassName('phone_roistat_{{ geo.host }}');
$(phones).on('DOMSubtreeModified', function () {
    $('.phone-link').attr('href', 'tel:' + $(this).text());
});

var phones = document.getElementsByClassName('phone_2gis_{{ geo.host }}');
$(phones).on('DOMSubtreeModified', function () {
    $('.phone-link').attr('href', 'tel:' + $(this).text());
});

var phones = document.getElementsByClassName('phone_straight_{{ geo.host }}');
$(phones).on('DOMSubtreeModified', function () {
    $('.phone-link').attr('href', 'tel:' + $(this).text());
});




var owl = $('.results-slider');
owl.on('changed.owl.carousel', function (event) {
    window.setTimeout(function () {
        var height = $('.results-slider').find('.owl-item.active').height();
        $('#results').height(height + 100);
    }, 0);
});


$(".menu-visa-link").click(function (e) {
    e.preventDefault();
    var region = $(this).data('region');
    $(".region-flags").hide();
    $(".region-flags[data-region='" + region + "'][data-batch=1]").fadeIn('slow');


    $(".show-batch-tr").hide();
    $(".show-batch-tr[data-region='" + region + "']").show();
    $(".show-batch[data-region='" + region + "']").show();

    $("#text-flag").find('span[data-region]').hide();
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


$( ".show-batch" ).click(function() {
    var region = $(this).data('region');

    $('.region-flags[data-region="'+region+'"]:hidden').first().show();
    $('.region-flags[data-region="'+region+'"]:hidden').first().show();
    $('.region-flags[data-region="'+region+'"]:hidden').first().show();
    $('.region-flags[data-region="'+region+'"]:hidden').first().show();
    $('.region-flags[data-region="'+region+'"]:hidden').first().show();
    $('.region-flags[data-region="'+region+'"]:hidden').first().show();

    var amount = $('.region-flags[data-region="'+region+'"]:hidden').length;

    if (amount <= 6) {
        $(this).text('Показать оставшиеся');
    }

    if (amount == 0) {
        $(this).hide();
    }
});
