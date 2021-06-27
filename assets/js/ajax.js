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
