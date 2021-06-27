;(function($){

    var variantsHolder = $('#variants-holder');
    var product_gallery_frame;
    var product_featured_frame;
    var $image_gallery_ids = $('#product_image_gallery');
    var $product_images = $('#product_images_container ul.product_images');

    var Dokan_Editor = {

        /**
         * Constructor function
         */
        init: function () {

                product_type = 'simple';

                // gallery
                $('body, #dokan-product-images').on('click', 'a.add-product-images', this.gallery.addImages);
                $('body, #dokan-product-images').on('click', 'a.action-delete', this.gallery.deleteImage);
                this.gallery.sortable();

                // featured image
                $('body, .product-edit-container').on('click', 'a.dokan-feat-image-btn', this.featuredImage.addImage);
                $('body, .product-edit-container').on('click', 'a.dokan-remove-feat-image', this.featuredImage.removeImage);

                $('body, #variable_product_options').on('click', '.sale_schedule', this.saleSchedule);
                $('body, #variable_product_options').on('click', '.cancel_sale_schedule', this.cancelSchedule);
        },

            gallery: {

                addImages: function(e) {
                    e.preventDefault();

                    var self = $(this),
                        p_images = self.closest('.dokan-product-gallery').find('#product_images_container ul.product_images'),
                        images_gid = self.closest('.dokan-product-gallery').find('#product_image_gallery');

                    if (product_gallery_frame) {
                        product_gallery_frame.open();
                        return;
                    } else {
                        // Create the media frame.
                        product_gallery_frame = wp.media({
                            // Set the title of the modal.
                            title: dokan.i18n_choose_gallery,
                            button: {
                                text: dokan.i18n_choose_gallery_btn_text,
                            },
                            multiple: true
                        });

                        product_gallery_frame.on('select', function () {

                            var selection = product_gallery_frame.state().get('selection');

                            selection.map(function (attachment) {

                                attachment = attachment.toJSON();

                                if (attachment.id) {
                                    attachment_ids = [];

                                    $('<li class="image" data-attachment_id="' + attachment.id + '">\
                                        <img src="' + attachment.url + '" />\
                                        <a href="#" class="action-delete">&times;</a>\
                                    </li>').insertBefore(p_images.find('li.add-image'));

                                    $('#product_images_container ul li.image').css('cursor', 'default').each(function () {
                                        var attachment_id = jQuery(this).attr('data-attachment_id');
                                        attachment_ids.push(attachment_id);
                                    });
                                }

                            });

                            images_gid.val(attachment_ids.join(','));
                        });

                        product_gallery_frame.open();
                    }

                },

                deleteImage: function(e) {
                    e.preventDefault();

                    var self = $(this),
                        p_images = self.closest('.dokan-product-gallery').find('#product_images_container ul.product_images'),
                        images_gid = self.closest('.dokan-product-gallery').find('#product_image_gallery');

                    self.closest('li.image').remove();

                    var attachment_ids = [];

                    $('#product_images_container ul li.image').css('cursor', 'default').each(function () {
                        var attachment_id = $(this).attr('data-attachment_id');
                        attachment_ids.push(attachment_id);
                    });

                    images_gid.val(attachment_ids.join(','));

                    return false;
                },

                sortable: function() {
                    // Image ordering
                    $('body').find('#product_images_container ul.product_images').sortable({
                        items: 'li.image',
                        cursor: 'move',
                        scrollSensitivity: 40,
                        forcePlaceholderSize: true,
                        forceHelperSize: false,
                        helper: 'clone',
                        opacity: 0.65,
                        placeholder: 'dokan-sortable-placeholder',
                        start: function (event, ui) {
                            ui.item.css('background-color', '#f6f6f6');
                        },
                        stop: function (event, ui) {
                            ui.item.removeAttr('style');
                        },
                        update: function (event, ui) {
                            var attachment_ids = [];

                            $('body').find('#product_images_container ul li.image').css('cursor', 'default').each(function () {
                                var attachment_id = jQuery(this).attr('data-attachment_id');
                                attachment_ids.push(attachment_id);
                            });

                            $('body').find('#product_image_gallery').val(attachment_ids.join(','));
                        }
                    });
                }
        },
            featuredImage: {

            addImage: function(e) {
                e.preventDefault();

                var self = $(this);

                if ( product_featured_frame ) {
                    product_featured_frame.open();
                    return;
                } else {
                    product_featured_frame = wp.media({
                        // Set the title of the modal.
                        title: dokan.i18n_choose_featured_img,
                        button: {
                            text: dokan.i18n_choose_featured_img_btn_text,
                        }
                    });

                    product_featured_frame.on('select', function() {
                        var selection = product_featured_frame.state().get('selection');

                        selection.map( function( attachment ) {
                            attachment = attachment.toJSON();

                            // set the image hidden id
                            self.siblings('input.dokan-feat-image-id').val(attachment.id);

                            // set the image
                            var instruction = self.closest('.instruction-inside');
                            var wrap = instruction.siblings('.image-wrap');

                            // wrap.find('img').attr('src', attachment.sizes.thumbnail.url);
                            wrap.find('img').attr('src', attachment.url);
                            wrap.find('img').removeAttr( 'srcset' );

                            instruction.addClass('dokan-hide');
                            wrap.removeClass('dokan-hide');
                        });
                    });

                    product_featured_frame.open();
                }
            },

            removeImage: function(e) {
                e.preventDefault();

                var self = $(this);
                var wrap = self.closest('.image-wrap');
                var instruction = wrap.siblings('.instruction-inside');

                instruction.find('input.dokan-feat-image-id').val('0');
                wrap.addClass('dokan-hide');
                instruction.removeClass('dokan-hide');
            }
        },

    }



    // On DOM ready
    $(function () {
        Dokan_Editor.init();
    });


})(jQuery);


