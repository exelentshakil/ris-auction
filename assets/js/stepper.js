(function ($) {

    var navListItems = $('div.setup-panel-3 div a'),
        allWells = $('.setup-content-3'),
        allNextBtn = $('.nextBtn-3'),

        allPrevBtn = $('.prevBtn-3');
    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();

        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {

            navListItems.removeClass('btn-info').addClass('btn-pink').css('pointer-events', 'none');

            $item.addClass('btn-info');

            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    $('.ajax_update_form').on('click', '.prevBtn-3', function () {
        var curStep = $(this).closest(".setup-content-3"),
            curStepBtn = curStep.attr("id"),
            prevStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepSteps.removeAttr('disabled').trigger('click');
    });



    allPrevBtn.on('click', function () {
        var curStep = $(this).closest(".setup-content-3"),
            curStepBtn = curStep.attr("id"),
            prevStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepSteps.removeAttr('disabled').trigger('click');
    });

    $('.ajax_update_form').on('click', '.ajax-update', function (e) {


        var curStep = $(this).closest(".setup-content-3"),
            curStepBtn = curStep.attr("id"),
            nextStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            nextNavs = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().nextAll().children("a"),
            curInputs = curStep.find("input[type='button'],input[type='text'],input[type='textarea'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");

        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (!isValid) {


            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Missing required fields',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });

            nextNavs.addClass('disabled');

        };

        if (isValid) {
            var prev = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().find('i');
            var prevParent = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent();
            console.log(curStepBtn);
            prev[0].className = "fa fa-check";
            prev.addClass("checked");
            prevParent.addClass("completed");
            nextStepSteps.removeAttr('disabled').trigger('click');
            nextNavs.removeClass('disabled');
        }


    });



    allNextBtn.on('click', function (e) {




        var curStep = $(this).closest(".setup-content-3"),
            curStepBtn = curStep.attr("id"),
            nextStepSteps = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            nextNavs = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().nextAll().children("a"),
            curInputs = curStep.find("input[type='button'],input[type='text'],input[type='textarea'],input[type='url']"),
            isValid = true;



        $(".form-group").removeClass("has-error");

        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (!isValid) {


            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Missing required fields',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });

            nextNavs.addClass('disabled');

        };

        if (isValid) {
            var prev = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().find('i');
            var prevParent = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent();
            prev[0].className = "fa fa-check";
            prev.addClass("checked");
            prevParent.addClass("completed");
            nextStepSteps.removeAttr('disabled').trigger('click');
            nextNavs.removeClass('disabled');
        }


    });


    $('div.setup-panel-3 div a.btn-info').trigger('click');


    // Prevent negative input

    $('input[type=number], input#_auction_start_price, input#_auction_bid_increment, input#zip_code').on('keyup', function (e) {
        var val = $(this).val();

        var numberRegex = /^\d+$/;

        if (!numberRegex.test(val)) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter a valid number!',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
            $(this).val('');
        }
        console.log(val);




        $('.year').yearselect();

    });


})(jQuery);
