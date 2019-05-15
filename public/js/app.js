$(function () {

    //////// viewport ////////////////////////////////////////////////////////////////////////

    var viewport = $('meta[name="viewport"]');
    var screen_width = viewport.data('screen-width');
    var initial_scale = screen.width / screen_width;
    var content = "width=device-width, initial-scale="+initial_scale+", maximum-scale=1.0, user-scalable=yes";
    $(viewport).attr('content', content);

    //////// set screen width to load right template ////////////////////////////////////////////////////////////////////////

    var width = 0;
    $.ajax({
        async: false,
        type: 'get',
        url: '/get-screen-width',
        cache: false,
        data: {'width': screen.width},
        success: function (data) {
            width = data;
            $.post( "/set-screen-width", {'width': screen.width}, function( data ) {});
        },
        error: function (data) {
        },
    });

    ///////////// debug ///////////////////////////////////

    $('.debug').html(
            'availWidth: '+ screen.availWidth
        + '<br>availHeight: '+ screen.availHeight
        + '<br>width: '+ screen.width
        + '<br>height: ' + screen.height
        +'<br>top: ' + screen.top
        +'<br>left: ' + screen.left
        +'<br>availTop: ' + screen.availTop
        +'<br>availLeft: ' + screen.availLeft
    );

    ///////////////////////////////////////////////////////

    function send_form_data_roistat_email(frm) {
        var form_data = new FormData(frm);
        $.ajax({
            type: 'post',
            url: '/send-consultation-form-roistat-email',
            mimeType: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            // data: $(frm).serialize(),
            data: form_data,
            success: function (data) {
                ym(48724754, 'reachGoal', 'BMSend');
            },
            error: function (data) {
        	    console.log('error ',data);
            },
        });
        $(frm).trigger('reset');
    };

    function send_form_data_email(frm) {
        var form_data = new FormData(frm);
        $.ajax({
            type: 'post',
            url: '/send-consultation-form-email',
            mimeType: "multipart/form-data",
            processData: false,
            contentType: false,
            cache: false,
            //data: $(frm).serialize(),
            data: form_data,
            success: function (data) {
            },
            error: function (data) {
                console.log('error ',data);
            },
        })
        $(frm).trigger('reset');
    };

    var consultation_form_1 = $('#consultation_form_1');
    consultation_form_1.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });


    var consultation_form_2 = $('#consultation_form_2');
    consultation_form_2.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });


    var consultation_form_3 = $('#consultation_form_3');
    consultation_form_3.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    var consultation_form_modal_1 = $('#consultation_form_modal_1');
    consultation_form_modal_1.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);


        $('#consultation_modal_1').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');

    });


    var consultation_form_modal_franchise = $('#consultation_form_modal_franchise');
    consultation_form_modal_franchise.submit(function (e) {
        e.preventDefault();
        send_form_data_email(this);
        $('#consultation_modal_franchise').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');

    });


    var consultation_form_direction_1 = $('#consultation_form_direction_1');
    consultation_form_direction_1.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });


    var consultation_form_direction_2 = $('#consultation_form_direction_2');
    consultation_form_direction_2.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    var consultation_form_visa_1 = $('#consultation_form_visa_1');
    consultation_form_visa_1.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    var consultation_form_visa_2 = $('#consultation_form_visa_2');
    consultation_form_visa_2.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    /////////////////////////////////////////////////////////////////

    var consultation_form_agency = $('#consultation_form_agency');
    consultation_form_agency.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    /////////////////////////////////////////////////////////////////
    
      var consultation_form_organization = $('#consultation_form_organization');
    consultation_form_organization.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    /////////////////////////////////////////////////////////////////

    var quiz_form_1 = $('#quiz_form_1');
    quiz_form_1.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
    });

    /////////////////////////////////////////////////////////////////


    var consultation_form_contacts = $('#consultation_form_contacts_1');
    consultation_form_contacts.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });

    var consultation_form_contacts = $('#consultation_form_contacts_2');
    consultation_form_contacts.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);
        $('#application_has_been_sent_successfully').modal('show');
    });


//////////////////////////////////////////////////////////////////////

    var consultation_form_modal_2 = $('#consultation_form_modal_2');
    var consultation_form_modal_2_agree = $(consultation_form_modal_2).find('input[type="checkbox"]');
    var consultation_form_modal_2_button_submit = $(consultation_form_modal_2).find('button[type="submit"]');

    $(consultation_form_modal_2_agree).click(function () {
        var consultation_form_modal_2_checked = $(this).prop('checked');
        if (consultation_form_modal_2_checked) {
            consultation_form_modal_2_button_submit.removeAttr('disabled');
        } else {
            consultation_form_modal_2_button_submit.attr('disabled', 'disabled');
        }
    });

    consultation_form_modal_2.submit(function (e) {
        e.preventDefault();
        send_form_data_roistat_email(this);

        $('#consultation_modal_2').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');
    });

    $('.get-country-consultation').click(function () {

        var country = $(this).data('country');
        $('#consultation_modal_2').find('input[name="country"]').first().val(country);
        $('#consultation_modal_2').modal('show');
    });

    /////////////////////////////////////////////////////////////////

    var consultation_form_modal_3 = $('#consultation_form_modal_3');
    var consultation_form_modal_3_agree = $(consultation_form_modal_3).find('input[type="checkbox"]');
    var consultation_form_modal_3_button_submit = $(consultation_form_modal_3).find('button[type="submit"]');

    $(consultation_form_modal_3_agree).click(function () {
        var consultation_form_modal_3_checked = $(this).prop('checked');
        if (consultation_form_modal_3_checked) {
            consultation_form_modal_3_button_submit.removeAttr('disabled');
        } else {
            consultation_form_modal_3_button_submit.attr('disabled', 'disabled');
        }
    });

    consultation_form_modal_3.submit(function (e) {
        e.preventDefault();

        

	send_form_data_email(this);
        $('#join-attached-file').text('Файл не выбран');

        $('#consultation_modal_3').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');

        $(this).trigger('reset');
    });

    /////////////////////////////////////////////////////////////////

    var consultation_form_modal_4 = $('#consultation_form_modal_4');
    consultation_form_modal_4.submit(function (e) {
        e.preventDefault();
        send_form_data_email(this);


        $('#consultation_modal_4').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');

    });

    ///////////////////////////////////////////////////////////////

    var consultation_form_modal_5 = $('#consultation_form_modal_5');
    consultation_form_modal_5.submit(function (e) {
	e.preventDefault();
        send_form_data_roistat_email(this);
	$('#consultation_modal_5').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');
    });

    ///////////////////////////////////////////////////////////////

    var consultation_form_modal_6 = $('#consultation_form_modal_6');
    consultation_form_modal_6.submit(function (e) {
		e.preventDefault();
        send_form_data_roistat_email(this);
		$('#consultation_modal_6').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');
    });

    ///////////////////////////////////////////////////////////////

    var consultation_form_modal_7 = $('#consultation_form_modal_7');
    consultation_form_modal_7.submit(function (e) {
	e.preventDefault();
        send_form_data_roistat_email(this);
	$('#consultation_modal_7').modal('hide');
        $('#application_has_been_sent_successfully').modal('show');
    });

    ///////////////////////////////////////////////////////////////


    $('.select-city-m').click(function () {
       $('#select_city_modal').modal('show');
    });

    $('.show-phone-modal').click(function () {
        $('#phone_modal').modal('show');
    });

    //////////////////////////////////////////////////////////////////


    $('.show-menu-modal').click(function () {
        $('#menu_modal').modal('show');
        $('.prev-button-menu').css('visibility', 'hidden')
        $('.main-menu').show();
        $('.menu-regions').hide();
        $('.menu-visas').hide();
    });

    $('.show-menu-regions').click(function() {
        $('.prev-button-menu').css('visibility', 'visible')
        $('.main-menu').hide();
        $('.menu-regions').show();
        $('.menu-visas').hide();
    });


    $('.menu-region').click(function () {
        $('.prev-button-menu').css('visibility', 'visible')
        $('.menu-regions').hide();
        var region_id = $(this).data('region');
        $(".menu-visas[data-region='" + region_id + "']").show();
    });

    $('.prev-button-menu').click(function() {
        if($('.menu-regions:visible').length) {
            $('.main-menu').show();
            $('.menu-regions').hide();
            $('.menu-visas').hide();
        }

        if($('.menu-visas:visible').length) {
            $('.main-menu').hide();
            $('.menu-regions').show();
            $('.menu-visas').hide();
        }

        if($('.main-menu:visible').length) {
            $('.prev-button-menu').css('visibility', 'hidden')
        }

    });

    //////////////////////////////////////////////////////////////////

    $(".flag").hover(
        function () {
            $(this).find(".footer-hideable").show();
        }, function () {
            $(this).find(".footer-hideable").hide();
        }
    );

    $(".openable").hover(
        function () {
            $(this).find(".footer-hideable").show();
        }, function () {
            $(this).find(".footer-hideable").hide();
        }
    );

    $("#menu-visas").click(function (e) {
        e.preventDefault();
        var i = $(this).find('i').first();
        var mini_visas = $("#mini-visas");

        $(mini_visas).toggle();

        if ($(mini_visas).is(':visible')) {

            if ( $('.select-city').first().is(':visible')) {
                $('#mini-visas').css('top', '300px');
            } else {
                $('#mini-visas').css('top', '250px');
            }

            $(i).addClass('fa-angle-up');
            $(i).removeClass('fa-angle-down');

            $(this).removeClass('text-white');
            $(this).addClass('text-cyanic');

        };

        if ($(mini_visas).is(':hidden')) {
            $(i).addClass('fa-angle-down');
            $(i).removeClass('fa-angle-up');

            $(this).addClass('text-white');
            $(this).removeClass('text-cyanic');

        }
        ;
    });

    $('.get-care-consultation').click(function () {
        var commentary = $(this).data('commentary');
        $('#consultation_form_modal_1').find('input[name="commentary"]').first().val(commentary);
    });

    // ---------------------------------------------------

  //  Close window if the click was outside.
    $(document).mouseup(function (e){
        var div = $("#city-footer-hideable");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            div.hide();
        }
    });

    $(".geo-city-li").click(
        function () {
            $("#city-footer-hideable").show();
        }
    );

    $('.select-city').click(function () {
        if ($("#mini-visas").is(':visible')) {
            if ( $('.select-city').first().is(':visible')) {
                $('#mini-visas').css('top', '300px');
            } else {
                $('#mini-visas').css('top', '250px');
            }
        }
    });

    // var geo_id = getCookie('geo_id');
    var city_is_selected = getCookie('city_is_selected');
    if (city_is_selected==undefined) {
        $('.select-city').show();
    } else {
        $('.select-city').hide();
    }

    $('.select-city .no').click(function () {
        $("#city-footer-hideable").show();
        $('.select-city').hide();
    });

    $('.select-city .close').click(function () {
        $('.select-city').hide();
    });

    $('.select-city .yes').click(function () {
        $('.select-city').hide();
        var geo_id = $(this).data('geo-id');
        setCookie('geo_id', geo_id, 365);
        setCookie('city_is_selected', 1, 365);
    });

    $('.set-geo-id-cookie').click(function () {
        var geo_id = $(this).data('geo-id');
        setCookie('geo_id', geo_id, 365);
    });

// ---------------------------------------------------

    $(".region-links").find('[data-region]').on('click', function () {
        var region = $(this).data('region');
        $(".menu-visa-link[data-region='" + region + "']").trigger('click');
        console.log(region);
    });



    // $(window).on('resize', function(){
        // var win = $(this); //this = window
        // if (win.height() >= 820) { /* ... */ }
        // if (win.width() >= 1280) { /* ... */ }
        // alert('a');
        //reinit

        // var $carousel = $('#testimonials-slider');
        // var owl = $carousel.data('owlCarousel');
        // owl.trigger('replace.owl.carousel', [{touchDrag: false, mouseDrag: false}]);

        //
        // var $carousel = $('#testimonials-slider');
        // var owl = $carousel.data('owl.carousel');
        // owl.trigger('replace.owl.carousel', [{touchDrag: false, mouseDrag: false}]);
    // });


    //lazy load for youtube
    $('.modal').on('shown.bs.modal', function() {
        var data_src = $(this).find('iframe').data('src');
        var src = $(this).find('iframe').attr('src');

        if (!src) {
            $(this).find('iframe').attr('src', data_src);
        }
    });

    //lazy load images
    var images = $('img[data-src]');
    $.each(images, function( index, image ) {
        var src = $(image).attr('src');
        var data_src = $(image).data('src');
        $(image).attr('src', data_src);
    });


    $('#document-show').click(function() {
        $(this).hide();
        $('#document-hide').show();

        $('#document-text').show();

    });

    $('#document-hide').click(function() {
        $('#document-text').hide();
        $(this).hide();
        $('#document-show').show();
    });

    // $('input[name="country"]').keyup(function() {
    //     var country = $(this).val();
    //     var regex = /^[A-zА-я]{3,}[A-zА-я-\s]*$/;
    //
    //     if (!regex.test(country)) {
    //         country = country.slice(0, -1);
    //         $(this).val(country);
    //     }
    // });
    //
    // $('input[name="name"]').keyup(function() {
    //     var name = $(this).val();
    //     var regex = /^[A-zА-я]{3,}[A-zА-я-\s]*$/;
    //
    //     if (!regex.test(name)) {
    //         name = name.slice(0, -1);
    //         $(this).val(name);
    //     }
    // });
    //
    // $('input[name="name"]').keydown(function() {
    //     var name = $(this).val();
    //     var regex = /^[A-zА-я]{3,}[A-zА-я-\s]*$/;
    //
    //     if (!regex.test(name)) {
    //         name = name.slice(0, -1);
    //         $(this).val(name);
    //     }
    // });

    $('input[name="phone"]').keyup(function() {
        var phone = $(this).val();
        var regex = /^[+]*[0-9]*$/;

        if (!regex.test(phone)) {
            phone = phone.slice(0, -1);
            $(this).val(phone);
        }
    });

    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        for (var i = 0, f; f = files[i]; i++) {

            if (f.name.length > 30) {
                var start = f.name.slice(0, 20);
                var end = f.name.slice(f.name.length-8,f.name.length)
                var filename = start + '…' + end;
            } else {
                var filename = f.name;
            }

            $('#join-attached-file').text(filename);

            if (f.size > 5000000) {
                $('#join-error-size').show();
                consultation_form_modal_3_button_submit.attr('disabled', 'disabled');
                $('#join-attached-file').val('');
            } else {
                $('#join-error-size').hide();
                consultation_form_modal_3_button_submit.removeAttr('disabled');
            }

            if (!(f.type == 'image/jpeg' || f.type == 'image/png' || f.type == 'image/gif')) {
                $('#join-error-type').show();
                consultation_form_modal_3_button_submit.attr('disabled', 'disabled');
                $('#join-attached-file').val('');
            } else {
                $('#join-error-type').hide();
                consultation_form_modal_3_button_submit.removeAttr('disabled');
            }
        }
    }

    document.getElementById('join-upload-file').addEventListener('change', handleFileSelect, false);

    ////////////////////////////////////////////////////////////////////////////////////////////

    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + ";domain=.ivcg.ru;path=/";
    }

    var cookies;
    function getCookie(name,c,C,i){
        if(cookies){ return cookies[name]; }

        c = document.cookie.split('; ');
        cookies = {};

        for(i=c.length-1; i>=0; i--){
            C = c[i].split('=');
            cookies[C[0]] = C[1];
        }

        return cookies[name];
    }


    $('#map_btn_show_more').click(function() {
        $('.map_show_more').show();
        $(this).hide();
    });


	$( "img.marker" ).click(function() {
        $("#tip_map_hover").fadeToggle( 500 );
	});

    //Close modal window if the click was outside.
    $(document).mouseup(function (e){
        var div = $(".modal");
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            div.modal('hide');
        }
    });

    $('html').click(function(event) {
        if ($(event.target).closest('.outter_close:visible, img.marker').length < 1) {
            $('html').find('.outter_close:visible').fadeToggle(500);
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////////

    var step = 0;

    $('.quiz-start').click(function(event) {
        step = 0;
        $('#quiz_form_1').trigger('reset');
        $('.quiz-next-step').prop('disabled', true);
        $(".box[data-box=1]").fadeIn(200);
        $(".quiz-intro-text").hide();
    });


    $('.quiz-confirm-accept').click(function(event) {
        $(".box").hide();
        $(".quiz-intro-text").fadeIn(200);
    });

    $('.quiz-cancel').click(function(event) {
        step = $(this).closest('.box').data('box');
        $(".box").hide();
        $(".box-confirm").fadeIn(200);
    });

    $('.quiz-confirm-cancel').click(function(event) {
        $(".box").hide();
        $(".box[data-box='" + step + "']").fadeIn(200);
    });

    $('.quiz-finish').click(function(event) {
        $(".box").hide();
        $(".quiz-intro-text").fadeIn(200);
    });


    $('.quiz-next-step').click(function(event) {
        var step = $(this).closest('.box').data('box');
        var next_step = step + 1;
        var all_steps = $('#all-quiz-steps').data('all-quiz-steps');

        $(this).closest('.box').hide();
        $(".box[data-box="+next_step+"]").fadeIn(200);
    });

    $('input[type="text"]').keyup(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);

        if($(this).val()) {
            $button.prop('disabled', false);

        } else {
            $button.prop('disabled', true);
        }
    });

    $('textarea').keyup(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);

        if($(this).val()) {
            $button.prop('disabled', false);
        } else {
            $button.prop('disabled', true);
        }
    });

    $('input[type="radio"]').click(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);
        $button.prop('disabled', false);
    });

    $('input[type="checkbox"]').click(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);

        if($("input[data-question_id='" + question_id + "']:checked").length) {
            $button.prop('disabled', false);
        } else {
            $button.prop('disabled', true);
        }
    });

    $('.quiz-cancel').click(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);
        $button.prop('disabled', false);
    });

    $('input[type="phone"]').keyup(function() {
        var question_id = $(this).data('question_id');
        var $button = $('#button-next-question_'+question_id);

        var phone = $(this).val();
        var regex = /^[+]{0,1}[0-9]*$/;

        if (!regex.test(phone)) {
            phone = phone.slice(0, -1);
            $(this).val(phone);
        }
        if($(this).val().length >= 6 ) {
            $button.prop('disabled', false);

        } else {
            $button.prop('disabled', true);
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////////

    location.hash=location.hash;

    if (width > 0) {
        $('body').css('visibility', 'visible');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////

}); //end document ready

