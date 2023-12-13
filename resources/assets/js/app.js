$(document).ready(function () {
    $('.home-carousel').owlCarousel({
        loop: true,
        nav: false,
        items: 1,
        dots: true,
        autoplay: true,
        autoplayTimeout: 8000,
        autoHeight: true
    });
    $('.testimonials-carousel').owlCarousel({
        loop: true,
        nav: true,
        items: 1,
        dots: false,
        margin: 20,
        responsive: {
            0: {
                items: 1,
                nav: true,
            },
            768: {
                items: 1,
                nav: true,
            }
        }
    });
    //orangeSectionResizer();
});

$(function () {
    $('body').on('click', '.js-job-list-see-more', function (e) {
        e.preventDefault();
        const that = $(this);
        const itemWr = that.closest('.js-job-list-item');
        if (that.hasClass('active')) {
            that.text('See more');
        } else {
            that.text('See less');
        }
        that.toggleClass('active');
        itemWr.find('.js-job-list-apply').toggleClass('active');
        itemWr.find('.js-job-list-desc').toggleClass('active');
    });

    $('body').on('click', '.btn-down', function (e) {
        e.preventDefault();
        var $section = $('.orange-section, .section1');
        $('html, body').animate({scrollTop: $section.offset().top + $section.height()}, 'slow');
    });

    if ($(window).width() < 1031) {
        $('.main-header .header-nav').addClass('hide');
    } else {
        $('main-header .header-nav').removeClass('hide');
    }

    $('.btn-nav').click(function () {
        if ($(' .hide ul').is(':hidden')) {
            $(' .hide ul').slideDown()
        } else {
            $(' .hide ul').slideUp()
        }
    });

    //orangeSectionResizer();


    $('body').on('click', '.js-open-applay-modal', function (e) {
        e.preventDefault();
        var that = $(this);

        $.ajax({
            url: '/job/apply-modal/' + that.data('id'),
        }).done(function (response) {
            $('body').append(response);
            grecaptcha.render('recaptcha-element');
        });
    });

    $(document).on('submit', '#js-apply-job-form', function (e) {
        e.preventDefault();

        window.lintrk('track', { conversion_id: 10644425 });

        let data = new FormData($(this)[0]);

        $.ajax({
            contentType: false,
            url: '/apply-job/' + $(this).data('id'),
            data: data,
            processData: false,
            type: 'POST',
        }).done(response => {
            $('.js-applay-modal-wr ').replaceWith($(response));
            grecaptcha.render('recaptcha-element');
        });
    });

    $('body').on('click', function (e) {
        if ($(e.target).hasClass('js-applay-modal-wr')) {
            $(e.target).remove();
        }
    });

    $('body').on('click', '.js-applay-modal-close', function (e) {
        e.preventDefault();
        var that = $(this);
        var redirect = that.data('page-redirect') || null;

        if (redirect !== null) {
            if (redirect === 'jobs-page') {
                window.location = '/job';
            }
        }

        that.closest('.js-applay-modal-wr').remove();
    });

    // highlight drag area
    $('body').on('dragenter focus click', '.js-file-input', function () {
        $('.js-file-drop-area').addClass('is-active');
    });

    // back to normal state
    $('body').on('dragleave blur drop', '.js-file-input', function () {
        $('.js-file-drop-area').removeClass('is-active');
    });

    // change inner text
    $('body').on('click', '.js-file-drop-area-clean', function (e) {
        e.preventDefault();
        $('.js-file-msg').text('Drag and drop resume files here or');
        $('.js-file-input').val('');
    });

    $('body').on('change', '.js-file-input', function () {
        var filesCount = $(this)[0].files.length;
        var $textContainer = $(this).closest('.js-file-drop-area').find('.js-file-msg');
        var type = $(this)[0].files[0].type.split('/');

        if (type[1] !== 'pdf') {
            $('.js-file-drop-area-error').html('<div class="alert alert-danger">Invalid file format, must be: .doc, .pdf, .txt formats only.<div>');
            return false;
        } else {
            $('.js-file-drop-area-error').html('');
        }

        if (filesCount === 1) {
            // if single file is selected, show file name
            var fileName = $(this).val().split('\\').pop();
            $textContainer.html(fileName + '<span class="js-file-drop-area-clean file-drop-area__clean">X</span>');
        } else {
            // otherwise show number of files
            $textContainer.text(filesCount + ' files selected');
        }
    });

    $('.js-dismiss-head-message').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.main-info-line').remove();
    });


    $('body').on('click', '.js-open-question-form', function (e) {
        e.preventDefault();
        var that = $(this);

        $.ajax({
            url: '/loan-modal/' + that.data('id'),
        }).done(function (response) {
            $('body').append(response);
            grecaptcha.render('recaptcha-element');
        });
    });

    $(document).on('submit', '#js-question-form', function (e) {
        e.preventDefault();

        window.lintrk('track', { conversion_id: 10644425 });

        let data = new FormData(this);

        $.ajax({
            contentType: false,
            url: '/loan-modal/mail/' + $(this).data('id'),
            data: data,
            processData: false,
            type: 'POST',
        }).done(response => {
            $('.js-open-modal-wr').replaceWith($(response));
            if ($('#recaptcha-element').length) {
                grecaptcha.render('recaptcha-element');
            }
            setTimeout(function() {
                $(".js-open-modal-wr").hide();
            }, 5000);
        });

    });

    $('body').on('click', '.js-open-modal-close', function (e) {
        e.preventDefault();
        var that = $(this);

        that.closest('.js-open-modal-wr').remove();
    });
});

$(window).resize(function () {
    if ($(window).width() < 1031) {
        $('.main-header .header-nav').addClass('hide');
    } else {
        $('.main-header .header-nav').removeClass('hide');
    }

    //orangeSectionResizer();
});

function orangeSectionResizer() {
    var orangeSection = $('.orange-section');
    if (!orangeSection.hasClass('height-auto')) {
        var height = $(window).height() - $('header').height() - 20;
        $('.img-bg').css('height', height);
        orangeSection.css({height: 'auto', minHeight: height});
        orangeSection.find('>div').css({height: 'auto', minHeight: height});
    }
}

function empty(mixed_var) {

    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }

    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            // TODO: should we check for own properties only?
            //if (mixed_var.hasOwnProperty(key)) {
            return false;
            //}
        }
        return true;
    }

    return false;
}
