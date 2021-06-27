(function ($) {
    var ajax_submit = $('.ajax_update_form');

    ajax_submit.on('submit', function(e) {

        e.preventDefault();
        var address_1 = $('#address_1').val() != '' ? $('#address_1').val() + ', ' : '';
        var address_2 = $('#address_2').val() != '' ? $('#address_2').val() + ', ' : '';
        var city = $('#city').val() != '' ? $('#city').val() + ', ' : '';
        var state = $('#state').val() != '' ? $('#state').val() + ', ' : '';
        var zip_code = $('#zip_code').val() != '' ? $('#zip_code').val() : '';
        var edit_id = $('#dokan-edit-product-id');
        //var featureBtn = $(this).find("input[type=submit]:focus");


        var curStep = $(this).closest(".setup-content-3"),
            curStepBtn = curStep.attr("id"),
            nextStepStep = $('div.setup-panel-3 div a[href="#' + curStepBtn + '"]').parent().next()
            .children("a");

        var title = address_1 + address_2 + city + state + zip_code;
        var post_title = $('#post_title');
        post_title.val(title);

        var data = $(this).serialize();

        //btn.attr('disabled', true);
        //nextBtn.attr('disabled', true);

        $.ajax({
            url: RIS_Notify.ajaxurl,
            method: 'POST',
            beforeSend: function(xhr) {
                // Set nonce here
                xhr.setRequestHeader('X-WP-Nonce', RIS_Notify.nonce);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Updating records...',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            },
            // Build post data.
            // If method is "delete", data should be passed as query params.
            data: data
        }).done(function(response) {

            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your home details has been updated',
                showConfirmButton: false,
                timer: 2000
            });

            //submitNext.removeClass('btn dokan-btn-theme dokan-btn-lg ajax-update');
            //submitNext.addClass('btn dokan-btn-theme dokan-btn-lg nextBtn-3');
            //submitNext.prop('type', 'button');

            console.log(response.data.id);

            edit_id.val(response.data.id);

            //nextStepStep.trigger('click');


            //window.location.reload(true);
        }).fail(function(response) {


        }).always(function() {

        });


    });



    $('input[type="checkbox"]').click(function() {

        var showBtn = false;
        var featureTab = $('#step-4 .features-tab');
        var coolings = $('.coolings:checked').length; // 3
        var accessibility_features = $('.accessibility_features:checked').length; // 1
        var kitchen_features = $('.kitchen_features:checked').length; // 1
        var appliances = $('.appliances:checked').length; // 3
        var bathroom_features = $('.bathroom_features:checked').length; // 1
        var fencings = $('.fencings:checked').length; // 1
        var parkings = $('.parkings:checked').length; // 1
        var electrics = $('.electrics:checked').length; // 1
        var laundries = $('.laundries:checked').length; // 1
        var room_types = $('.room_types:checked').length; // 2
        var utilities = $('.utilities:checked').length; // 1
        var common_walls = $('.common_walls:checked').length; // 1
        var construction_materials = $('.construction_materials:checked').length; // 1
        var roofs = $('.roofs:checked').length; // 1
        var foundation_details = $('.foundation_details:checked').length; // 1
        var lot_features = $('.lot_features:checked').length; // 1
        var property_conditions = $('.property_conditions:checked').length; // 1
        var sewers = $('.sewers:checked').length; // 1
        var water_sources = $('.water_sources:checked').length; // 1
        var community_features = $('.community_features:checked').length; // 1


        if (coolings >= 3 && accessibility_features >= 3 && room_types >= 2 && accessibility_features >=
            1 && kitchen_features >= 1 && appliances >= 1 && bathroom_features >= 1 && fencings >= 1 &&
            parkings >= 1 && electrics >= 1 && laundries >= 1 && utilities >= 1 && common_walls >= 1 &&
            construction_materials >= 1 && roofs >= 1 && foundation_details >= 1 && lot_features >= 1 &&
            property_conditions >= 1 && sewers >= 1 && water_sources >= 1 && community_features >= 1) {

            console.log(this);
            showBtn = true;
        }

        if (showBtn) {
            featureTab.attr('disabled', false);
        } else {
            featureTab.attr('disabled', true);
        }
        console.log(showBtn);


    });



    $(function() {

        var featureTab = $('#step-4 .features-tab');

        var coolings = $('.coolings:checked').length; // 3
        var accessibility_features = $('.accessibility_features:checked').length; // 1
        var kitchen_features = $('.kitchen_features:checked').length; // 1
        var appliances = $('.appliances:checked').length; // 3
        var bathroom_features = $('.bathroom_features:checked').length; // 3
        var fencings = $('.fencings:checked').length; // 1
        var parkings = $('.parkings:checked').length; // 1
        var electrics = $('.electrics:checked').length; // 1
        var laundries = $('.laundries:checked').length; // 1
        var room_types = $('.room_types:checked').length; // 2
        var utilities = $('.utilities:checked').length; // 1
        var common_walls = $('.common_walls:checked').length; // 1
        var construction_materials = $('.construction_materials:checked').length; // 1
        var roofs = $('.roofs:checked').length; // 1
        var foundation_details = $('.foundation_details:checked').length; // 1
        var lot_features = $('.lot_features:checked').length; // 1
        var property_conditions = $('.property_conditions:checked').length; // 1
        var sewers = $('.sewers:checked').length; // 1
        var water_sources = $('.water_sources:checked').length; // 1
        var community_features = $('.community_features:checked').length; // 1


        featureTab.attr('disabled', false);
    });


    // $(function() {
    //     console.log($('.auction-datepicker').datetimepicker({
    //         dateFormat: 'mm-dd-yy'
    //     }));

    //     $('.auction-datepicker').datetimepicker({
    //         format: 'd-m-Y H:i',
    //     });

    //     $('#_auction_dates_from').datetimepicker({
    //         minDate: 0
    //     });

    //     $('#_auction_dates_from').datepicker("setDate", new Date());

    // });

    var final_price_popup = $('#final_price_popup');
    final_price_popup.on('click', function(e) {

        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Get My Price Now',
            html: '<p style="font-size: 20px;font-weight: 400;line-height: 1.2;">Use Home Value tool to determine home value, <a href="/dashboard/tools" target="_blank">Go to the tool page</a></p>',
            showConfirmButton: true,
            confirmButtonColor: '#FF6600',
            confirmButtonText: 'Get Your Value',
            timerProgressBar: false,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.open('/dashboard/tools');
            };

        });
    });

})(jQuery);

