<a href="#"
    class="btn-get-started btn dokan-btn-theme sign-up<?php echo isset( $_COOKIE['ris_auction_auth_token'] ) ? ' hide' : ' show' ?>">GET
    STARTED</a>


<div class="container-login container">
    <div class="row">
        <div class="col-md-12">
            <div class="auth-wraper">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="card">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item text-center"> <a class="nav-link active btl" id="pills-home-tab"
                                    data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Signup</a> </li>
                            <li class="nav-item text-center"> <a class="nav-link btr" id="pills-profile-tab"
                                    data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">Login</a> </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="sign-up">
                                    <form class="ajax_register" method="POST">
                                        <!-- First Step -->
                                        <div class="col-md-12">
                                            <h3 class="font-weight-bold pl-0 my-4"><strong>Please Register To Get
                                                    Started</strong>
                                            </h3>
                                            <div class="form-group md-form">
                                                <label for="username" data-error="wrong" data-success="right">Username
                                                </label>
                                                <input id="username" type="text" name="username" placeholder="username"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group md-form">
                                                <label for="email" data-error="wrong" data-success="right">Email
                                                </label>
                                                <input id="email" type="text" name="email" placeholder="email"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group md-form mt-3">
                                                <label for="password" data-error="wrong"
                                                    data-success="right">Password</label>
                                                <input id="password" type="text" name="password" placeholder="password"
                                                    class="form-control">

                                            </div>

                                            <input type="hidden" name="action" value="sign_up">
                                            <input type="submit" class="btn dokan-btn-theme sign-up" value="Sign Up" />

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab">
                                <div class="login">

                                    <form class="ajax_login" method="POST">
                                        <!-- First Step -->

                                        <div class="col-md-12">
                                            <h3 class="font-weight-bold pl-0 my-4"><strong>Please Login To Get
                                                    Started</strong>
                                            </h3>

                                            <div class="form-group md-form">
                                                <label for="email" data-error="wrong" data-success="right">Email
                                                </label>
                                                <input id="email" type="text" name="email" placeholder="email"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group md-form mt-3">
                                                <label for="password" data-error="wrong"
                                                    data-success="right">Password</label>
                                                <input id="password" type="text" name="password" placeholder="password"
                                                    class="form-control">

                                            </div>

                                            <input type="hidden" name="action" value="sign_in">
                                            <input type="submit" class="btn dokan-btn-theme sign-in" value="Sign in" />
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>





<div class="add_new_listing<?php echo isset( $_COOKIE['ris_auction_auth_token'] ) ? ' show' : ' hide' ?>">
    <div class="container">
        <p>Wecome <span class="ris-user">
                <b><?php echo isset( $_COOKIE['ris_auction_auth_username'] ) ? $_COOKIE['ris_auction_auth_username'] : '' ?></b>
            </span>
        <form action="" class="ris-logout" method="POST">
            <input type="hidden" name="action" value="ris_logout">
            <input type="submit" value="Log Out" class="btn btn-primary">
        </form>

        </p>
        <!-- Grid row -->
        <div class="row d-flex step-card">
            <!-- Grid column -->
            <div class="col-md-4 pl-5 pb-5 step-nav">
                <!-- Stepper -->
                <div class="steps-form-3">
                    <div class="steps-row-3 setup-panel-3 d-flex justify-content-between">
                        <div class="steps-step-3">
                            <a href="#step-1" type="button" class="btn btn-info btn-circle-3 waves-effect ml-0"
                                data-toggle="tooltip" data-placement="top" title="Location"><i class="fa fa-street-view"
                                    aria-hidden="true"></i>Location</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-2" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-home"
                                    aria-hidden="true"></i>Details</a>

                        </div>
                        <div class="steps-step-3">
                            <a href="#step-3" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Contact"><i class="fa fa-id-card"
                                    aria-hidden="true"></i>Contact</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-4" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Utilities & Features"><i
                                    class="fa fa-th" aria-hidden="true"></i>Utilities & Features</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-5" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Photos"><i class="fa fa-picture-o"
                                    aria-hidden="true"></i>Photos</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-6" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Video"><i class="fa fa-file-video-o"
                                    aria-hidden="true"></i>Video</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-7" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Description"><i
                                    class="fa fa-map-signs" aria-hidden="true"></i>Description</a>
                        </div>
                        <div class="steps-step-3">
                            <a href="#step-8" type="button" class="btn btn-pink btn-circle-3 waves-effect"
                                data-toggle="tooltip" data-placement="top" title="Asking Price"><i
                                    class="fas fa-file-invoice-dollar" aria-hidden="true"></i>Asking Price</a>
                        </div>
                        <div class="steps-step-3 no-height">
                            <a href="#step-9" type="button" class="btn btn-pink btn-circle-3 waves-effect p-3"
                                data-toggle="tooltip" data-placement="top" title="Post Your Listing"><i
                                    class="fa fa-laptop" aria-hidden="true"></i>Post Your Listing</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-8">
                <form class="dokan-form-container ajax_update_form" id="dokan-add-new-product-form" method="POST">
                    <!-- First Step -->
                    <div class="row setup-content-3" id="step-1">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>What's the Address of the Home for
                                    Sale?</strong>
                            </h3>
                            <div class="form-group md-form">
                                <label for="address_1" data-error="wrong" data-success="right">Address Line 1
                                </label>
                                <input id="address_1" type="text" name="address[address_1]" placeholder="Address Line 1"
                                    class="form-control">
                            </div>
                            <div class="form-group md-form">
                                <label for="address_2" data-error="wrong" data-success="right">Address Line 2
                                </label>
                                <input id="address_2" type="text" name="address[address_2]"
                                    placeholder="Apartment, Unit Number, Etc" class="form-control">
                            </div>
                            <div class="form-group md-form mt-3">
                                <label for="city" data-error="wrong" data-success="right">City</label>
                                <input id="city" type="text" name="address[city]" placeholder="City"
                                    class="form-control">

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group md-form mt-3">
                                        <label for="state" data-error="wrong" data-success="right">State</label>
                                        <select id="state" name="address[state]" class="form-control">

                                            <?php

                                            foreach ( $states as $key => $state ) {?>

                                            <option value="<?php echo $state; ?>"><?php echo $state; ?></option>

                                            <?php }

                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group md-form mt-3">
                                        <label for="zip_code" data-error="wrong" data-success="right">Zip Code</label>
                                        <input id="zip_code" type="text" name="address[zip_code]" placeholder="Zip Code"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="submit-first-btn"
                                class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                            <!-- <input type="submit" class="btn dokan-btn-theme dokan-btn-lg"
                        value="<?php //esc_attr_e( 'Next', 'dokan' );?>" /> -->
                        </div>
                    </div>


                    <!-- Second Step -->
                    <div class="row setup-content-3" id="step-2">
                        <div class="col-md-12">

                            <h3 class="font-weight-bold pl-0 my-4"><strong>Provide Some Important Home Details</strong>
                            </h3>

                            <div class="form-group md-form">
                                <input id="post_title" type="hidden" name="post_title" placeholder="Property Title"
                                    class="form-control" placeholder="" value="">
                            </div>


                            <div class="form-group md-form">
                            </div>
                            <div class="form-group md-form">
                                <label for="property_type" data-error="wrong" data-success="right">Property Type</label>
                                <select id="property_type" name="home_details[property_type]" class="form-control">
                                    <option value="Condo">Condo</option>
                                    <option value="Single Family">Single Family</option>
                                    <option value="Townhome">Townhome</option>
                                    <option value="Mobile Home">Other</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="home_size" data-error="wrong" data-success="right">Home Size
                                            (SqFt)</label>
                                        <input step="any" id="home_size" type="number" name="home_details[home_size]"
                                            placeholder="SqFt" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <select id="lot_unit" type="checkmark" name="home_details[lot_unit]">
                                            <option value="sqft">SqFt</option>
                                            <option value="acres">Acres</option>
                                        </select>
                                        <label id="lot_label" for="lot_size" data-error="wrong" data-success="right">Lot
                                            Size
                                        </label>
                                        <input step="any" id="lot_size" type="number" name="home_details[lot_size]"
                                            placeholder="SqFt" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="year_built" data-error="wrong" data-success="right">Year
                                            Built</label>
                                        <input id="year_built" type="text" name="home_details[year_built]"
                                            placeholder="Year Built" class="year form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bedrooms" data-error="wrong" data-success="right">Bedrooms</label>
                                        <input step="any" id="bedrooms" type="number" name="home_details[bedrooms]"
                                            placeholder="Bedrooms" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="bathrooms" data-error="wrong" data-success="right">Bathrooms</label>
                                        <input step="any" id="bathrooms" type="number" name="home_details[bathrooms]"
                                            placeholder="Bathrooms" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group md-form mt-3">
                                        <label for="half_bathrooms" data-error="wrong" data-success="right">Half
                                            Bathrooms</label>
                                        <input step="any" id="half_bathrooms" type="number"
                                            name="home_details[half_bathrooms]" placeholder="Half Bathrooms"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>




                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                        </div>
                    </div>


                    <!-- Third Step -->
                    <div class="row setup-content-3" id="step-3">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Connect with Buyers</strong></h3>

                            <div class="form-group md-form">
                                <label for="name" data-error="wrong" data-success="right">Contact Name</label>
                                <input id="name" type="text" name="contact[name]" placeholder="Contact Name"
                                    class="form-control">
                            </div>
                            <div class="form-group md-form">
                                <label for="email" data-error="wrong" data-success="right">Contact Email</label>
                                <input id="email" type="text" name="contact[email]" placeholder="Contact Email"
                                    class="form-control">
                            </div>
                            <div class="form-group md-form">
                                <label for="number" data-error="wrong" data-success="right">Contact Number</label>
                                <input id="number" type="phone" name="contact[number]" placeholder="(800) 555-5555"
                                    class="form-control">
                            </div>

                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                        </div>
                    </div>


                    <!-- Fourth Step -->
                    <div class="row setup-content-3" id="step-4">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Promote Your Home Features</strong></h3>
                            <div class="row">
                                <div class="font-display features-heading">Interior Features</div>

                            </div>
                            <div class="row">
                                <div class="font-display">Interior Features</div>

                                <?php

                                foreach ( $this->interior_features as $key => $interior_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[interior_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $interior_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[interior_features][<?php echo $key; ?>]"
                                            name="home_features[interior_features][<?php echo $key; ?>]"
                                            value="<?php echo $interior_feature; ?>"
                                            class="interior_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>

                            </div>

                            <div class="row">

                                <div class="font-display">Basements</div>

                                <?php

                                foreach ( $this->basements as $key => $basement ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[basements][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $basement; ?></label>

                                        <input type="checkbox" id="home_features[basements][<?php echo $key; ?>]"
                                            name="home_features[basements][<?php echo $key; ?>]"
                                            value="<?php echo $basement; ?>"
                                            class="basements form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Fireplaces</div>

                                <?php

                                foreach ( $this->fireplaces as $key => $fireplace ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[fireplaces][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $fireplace; ?></label>

                                        <input type="checkbox" id="home_features[fireplaces][<?php echo $key; ?>]"
                                            name="home_features[fireplaces][<?php echo $key; ?>]"
                                            value="<?php echo $fireplace; ?>"
                                            class="fireplaces form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Coolings <span>(1 or more boxes required to be checked)</span>
                                </div>

                                <?php

                                foreach ( $this->coolings as $key => $cooling ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[coolings][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $cooling; ?></label>

                                        <input type="checkbox" id="home_features[coolings][<?php echo $key; ?>]"
                                            name="home_features[coolings][<?php echo $key; ?>]"
                                            value="<?php echo $cooling; ?>" class="coolings form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Heatings</div>

                                <?php

                                foreach ( $this->heatings as $key => $heating ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[heatings][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $heating; ?></label>

                                        <input type="checkbox" id="home_features[heatings][<?php echo $key; ?>]"
                                            name="home_features[heatings][<?php echo $key; ?>]"
                                            value="<?php echo $heating; ?>" class="heatings form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Accessibility Features (*require at
                                    least 1 box checked)</div>

                                <?php

                                foreach ( $this->accessibility_features as $key => $accessibility_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[accessibility_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $accessibility_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[accessibility_features][<?php echo $key; ?>]"
                                            name="home_features[accessibility_features][<?php echo $key; ?>]"
                                            value="<?php echo $accessibility_feature; ?>"
                                            class="accessibility_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Kitchen Features (*require at least 1 box
                                    checked)</div>
                                <?php

                                foreach ( $this->kitchen_features as $key => $kitchen_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[kitchen_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $kitchen_feature; ?></label>

                                        <input type="checkbox" id="home_features[kitchen_features][<?php echo $key; ?>]"
                                            name="home_features[kitchen_features][<?php echo $key; ?>]"
                                            value="<?php echo $kitchen_feature; ?>"
                                            class="kitchen_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Floorings</div>

                                <?php

                                foreach ( $this->floorings as $key => $flooring ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[floorings][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $flooring; ?></label>

                                        <input type="checkbox" id="home_features[floorings][<?php echo $key; ?>]"
                                            name="home_features[floorings][<?php echo $key; ?>]"
                                            value="<?php echo $flooring; ?>"
                                            class="floorings form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Appliances <span>(3 or more boxes required to be
                                        checked)</span>
                                </div>

                                <?php

                                foreach ( $this->appliances as $key => $appliance ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[appliances][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $appliance; ?></label>

                                        <input type="checkbox" id="home_features[appliances][<?php echo $key; ?>]"
                                            name="home_features[appliances][<?php echo $key; ?>]"
                                            value="<?php echo $appliance; ?>"
                                            class="appliances form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Bathroom Features (*require at least 1 box
                                    checked)</div>
                                <?php

                                foreach ( $this->bathroom_features as $key => $bathroom_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[bathroom_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $bathroom_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[bathroom_features][<?php echo $key; ?>]"
                                            name="home_features[bathroom_features][<?php echo $key; ?>]"
                                            value="<?php echo $bathroom_feature; ?>"
                                            class="bathroom_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Eating Areas</div>

                                <?php

                                foreach ( $this->eating_areas as $key => $eating_area ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[eating_areas][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $eating_area; ?></label>

                                        <input type="checkbox" id="home_features[eating_areas][<?php echo $key; ?>]"
                                            name="home_features[eating_areas][<?php echo $key; ?>]"
                                            value="<?php echo $eating_area; ?>"
                                            class="eating_areas form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Electrics <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>

                                <?php

                                foreach ( $this->electrics as $key => $electric ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[electrics][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $electric; ?></label>

                                        <input type="checkbox" id="home_features[electrics][<?php echo $key; ?>]"
                                            name="home_features[electrics][<?php echo $key; ?>]"
                                            value="<?php echo $electric; ?>"
                                            class="electrics form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Laundries <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>

                                <?php

                                foreach ( $this->laundries as $key => $laundry ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[laundries][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $laundry; ?></label>

                                        <input type="checkbox" id="home_features[laundries][<?php echo $key; ?>]"
                                            name="home_features[laundries][<?php echo $key; ?>]"
                                            value="<?php echo $laundry; ?>" class="laundries form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>


                            <div class="row">

                                <div class="font-display">Room Types <span>(2 or more boxes required to be
                                        checked)</span>
                                </div>
                                <?php

                                foreach ( $this->room_types as $key => $room_type ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[room_types][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $room_type; ?></label>

                                        <input type="checkbox" id="home_features[room_types][<?php echo $key; ?>]"
                                            name="home_features[room_types][<?php echo $key; ?>]"
                                            value="<?php echo $room_type; ?>"
                                            class="room_types form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>

                            <div class="row">

                                <div class="font-display">Utilities <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>
                                <?php

                                foreach ( $this->utilities as $key => $utility ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[utilities][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $utility; ?></label>

                                        <input type="checkbox" id="home_features[utilities][<?php echo $key; ?>]"
                                            name="home_features[utilities][<?php echo $key; ?>]"
                                            value="<?php echo $utility; ?>" class="utilities form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>

                            </div>

                            <div class="row">
                                <div class="font-display features-heading">Exterior Features</div>
                            </div>

                            <div class="row">
                                <div class="font-display">Pool Features</div>
                                <?php

                                foreach ( $this->pool_features as $key => $pool_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[pool_features][<?php echo $key; ?>]"
                                            data-error="wrong" data-success="right"><?php echo $pool_feature; ?></label>

                                        <input type="checkbox" id="home_features[pool_features][<?php echo $key; ?>]"
                                            name="home_features[pool_features][<?php echo $key; ?>]"
                                            value="<?php echo $pool_feature; ?>"
                                            class="pool_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Views</div>
                                <?php

                                foreach ( $this->views as $key => $view ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[views][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $view; ?></label>

                                        <input type="checkbox" id="home_features[views][<?php echo $key; ?>]"
                                            name="home_features[views][<?php echo $key; ?>]"
                                            value="<?php echo $view; ?>" class="views form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Door Features</div>
                                <?php

                                foreach ( $this->door_features as $key => $door_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[door_features][<?php echo $key; ?>]"
                                            data-error="wrong" data-success="right"><?php echo $door_feature; ?></label>

                                        <input type="checkbox" id="home_features[door_features][<?php echo $key; ?>]"
                                            name="home_features[door_features][<?php echo $key; ?>]"
                                            value="<?php echo $door_feature; ?>"
                                            class="door_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Fencings <span>(1 or more boxes required to be checked)</span>
                                </div>
                                <?php

                                foreach ( $this->fencings as $key => $fencing ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[fencings][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $fencing; ?></label>

                                        <input type="checkbox" id="home_features[fencings][<?php echo $key; ?>]"
                                            name="home_features[fencings][<?php echo $key; ?>]"
                                            value="<?php echo $fencing; ?>" class="fencings form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Security Features</div>
                                <?php

                                foreach ( $this->security_features as $key => $security_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[security_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $security_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[security_features][<?php echo $key; ?>]"
                                            name="home_features[security_features][<?php echo $key; ?>]"
                                            value="<?php echo $security_feature; ?>"
                                            class="security_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Parkings <span>(1 or more boxes required to be checked)</span>
                                </div>
                                <?php

                                foreach ( $this->parkings as $key => $parking ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[parkings][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $parking; ?></label>

                                        <input type="checkbox" id="home_features[parkings][<?php echo $key; ?>]"
                                            name="home_features[parkings][<?php echo $key; ?>]"
                                            value="<?php echo $parking; ?>" class="parkings form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Spa Features</div>
                                <?php

                                foreach ( $this->spa_features as $key => $spa_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[spa_features][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $spa_feature; ?></label>

                                        <input type="checkbox" id="home_features[spa_features][<?php echo $key; ?>]"
                                            name="home_features[spa_features][<?php echo $key; ?>]"
                                            value="<?php echo $spa_feature; ?>"
                                            class="spa_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Common Walls <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>
                                <?php

                                foreach ( $this->common_walls as $key => $common_wall ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[common_walls][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $common_wall; ?></label>

                                        <input type="checkbox" id="home_features[common_walls][<?php echo $key; ?>]"
                                            name="home_features[common_walls][<?php echo $key; ?>]"
                                            value="<?php echo $common_wall; ?>"
                                            class="common_walls form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Construction Materials</div>
                                <?php

                                foreach ( $this->construction_materials as $key => $construction_material ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[construction_materials][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $construction_material; ?></label>

                                        <input type="checkbox"
                                            id="home_features[construction_materials][<?php echo $key; ?>]"
                                            name="home_features[construction_materials][<?php echo $key; ?>]"
                                            value="<?php echo $construction_material; ?>"
                                            class="construction_materials form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Roofs <span>(1 or more boxes required to be checked)</span>
                                </div>
                                <?php

                                foreach ( $this->roofs as $key => $roof ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[roofs][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $roof; ?></label>

                                        <input type="checkbox" id="home_features[roofs][<?php echo $key; ?>]"
                                            name="home_features[roofs][<?php echo $key; ?>]"
                                            value="<?php echo $roof; ?>" class="roofs form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Foundation Details (*require at least 1
                                    box checked)</div>
                                <?php

                                foreach ( $this->foundation_details as $key => $foundation_detail ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[foundation_details][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $foundation_detail; ?></label>

                                        <input type="checkbox"
                                            id="home_features[foundation_details][<?php echo $key; ?>]"
                                            name="home_features[foundation_details][<?php echo $key; ?>]"
                                            value="<?php echo $foundation_detail; ?>"
                                            class="foundation_details form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Waterfront Features</div>
                                <?php

                                foreach ( $this->waterfront_features as $key => $waterfront_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[waterfront_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $waterfront_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[waterfront_features][<?php echo $key; ?>]"
                                            name="home_features[waterfront_features][<?php echo $key; ?>]"
                                            value="<?php echo $waterfront_feature; ?>"
                                            class="waterfront_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Patio and Porch Features</div>
                                <?php

                                foreach ( $this->patio_and_porch_features as $key => $patio_and_porch_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $patio_and_porch_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                            name="home_features[patio_and_porch_features][<?php echo $key; ?>]"
                                            value="<?php echo $patio_and_porch_feature; ?>"
                                            class="patio_and_porch_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Lot Features <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>
                                <?php

                                foreach ( $this->lot_features as $key => $lot_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[lot_features][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $lot_feature; ?></label>

                                        <input type="checkbox" id="home_features[lot_features][<?php echo $key; ?>]"
                                            name="home_features[lot_features][<?php echo $key; ?>]"
                                            value="<?php echo $lot_feature; ?>"
                                            class="lot_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Property Conditions (*require at least 1
                                    box checked)</div>
                                <?php

                                foreach ( $this->property_conditions as $key => $property_condition ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[property_conditions][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $property_condition; ?></label>

                                        <input type="checkbox"
                                            id="home_features[property_conditions][<?php echo $key; ?>]"
                                            name="home_features[property_conditions][<?php echo $key; ?>]"
                                            value="<?php echo $property_condition; ?>"
                                            class="property_conditions form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Sewers <span>(1 or more boxes required to be checked)</span>
                                </div>
                                <?php

                                foreach ( $this->sewers as $key => $sewer ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[sewers][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $sewer; ?></label>

                                        <input type="checkbox" id="home_features[sewers][<?php echo $key; ?>]"
                                            name="home_features[sewers][<?php echo $key; ?>]"
                                            value="<?php echo $sewer; ?>" class="sewers form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Water Sources <span>(1 or more boxes required to be
                                        checked)</span>
                                </div>
                                <?php

                                foreach ( $this->water_sources as $key => $water_source ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[water_sources][<?php echo $key; ?>]"
                                            data-error="wrong" data-success="right"><?php echo $water_source; ?></label>

                                        <input type="checkbox" id="home_features[water_sources][<?php echo $key; ?>]"
                                            name="home_features[water_sources][<?php echo $key; ?>]"
                                            value="<?php echo $water_source; ?>"
                                            class="water_sources form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Architectural Styles</div>
                                <?php

                                foreach ( $this->architectural_styles as $key => $architectural_style ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[architectural_styles][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $architectural_style; ?></label>

                                        <input type="checkbox"
                                            id="home_features[architectural_styles][<?php echo $key; ?>]"
                                            name="home_features[architectural_styles][<?php echo $key; ?>]"
                                            value="<?php echo $architectural_style; ?>"
                                            class="architectural_styles form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Community Features (*require at least 1
                                    box checked)</div>
                                <?php

                                foreach ( $this->community_features as $key => $community_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[community_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $community_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[community_features][<?php echo $key; ?>]"
                                            name="home_features[community_features][<?php echo $key; ?>]"
                                            value="<?php echo $community_feature; ?>"
                                            class="community_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Road Frontage Types</div>
                                <?php

                                foreach ( $this->road_frontage_types as $key => $road_frontage_type ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[road_frontage_types][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $road_frontage_type; ?></label>

                                        <input type="checkbox"
                                            id="home_features[road_frontage_types][<?php echo $key; ?>]"
                                            name="home_features[road_frontage_types][<?php echo $key; ?>]"
                                            value="<?php echo $road_frontage_type; ?>"
                                            class="road_frontage_types form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Road Surface Types</div>
                                <?php

                                foreach ( $this->road_surface_types as $key => $road_surface_type ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[road_surface_types][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $road_surface_type; ?></label>

                                        <input type="checkbox"
                                            id="home_features[road_surface_types][<?php echo $key; ?>]"
                                            name="home_features[road_surface_types][<?php echo $key; ?>]"
                                            value="<?php echo $road_surface_type; ?>"
                                            class="road_surface_type form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Disclosures</div>
                                <?php

                                foreach ( $this->disclosures as $key => $disclosure ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[disclosures][<?php echo $key; ?>]" data-error="wrong"
                                            data-success="right"><?php echo $disclosure; ?></label>

                                        <input type="checkbox" id="home_features[disclosures][<?php echo $key; ?>]"
                                            name="home_features[disclosures][<?php echo $key; ?>]"
                                            value="<?php echo $disclosure; ?>"
                                            class="disclosures form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Exterior Features</div>
                                <?php

                                foreach ( $this->exterior_features as $key => $exterior_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[exterior_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $exterior_feature; ?></label>

                                        <input type="checkbox"
                                            id="home_features[exterior_features][<?php echo $key; ?>]"
                                            name="home_features[exterior_features][<?php echo $key; ?>]"
                                            value="<?php echo $exterior_feature; ?>"
                                            class="exterior_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Other Structures</div>
                                <?php

                                foreach ( $this->other_structures as $key => $other_structure ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[other_structures][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $other_structure; ?></label>

                                        <input type="checkbox" id="home_features[other_structures][<?php echo $key; ?>]"
                                            name="home_features[other_structures][<?php echo $key; ?>]"
                                            value="<?php echo $other_structure; ?>"
                                            class="other_structures form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>
                            <div class="row">
                                <div class="font-display">Window Features</div>
                                <?php

                                foreach ( $this->window_features as $key => $window_feature ) {?>
                                <div class="col-md-4">
                                    <div class="form-check md-form mt-3">
                                        <label for="home_features[window_features][<?php echo $key; ?>]"
                                            data-error="wrong"
                                            data-success="right"><?php echo $window_feature; ?></label>

                                        <input type="checkbox" id="home_features[window_features][<?php echo $key; ?>]"
                                            name="home_features[window_features][<?php echo $key; ?>]"
                                            value="<?php echo $window_feature; ?>"
                                            class="window_features form-check-input validate">

                                    </div>
                                </div>

                                <?php }

                                ?>
                            </div>



                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update features-tab"
                                value="Next" />

                        </div>
                    </div>
                    <!-- Fifth Step Images Upload -->
                    <div class="row setup-content-3" id="step-5">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Upload Your Home Photos</strong></h3>
                            <div class="product-edit-container dokan-clearfix">
                                <div class="half featured-image">

                                    <div class="featured-image">
                                        <div class="dokan-feat-image-upload">

                                            <div class="instruction-inside">
                                                <input type="hidden" name="feat_image_id" class="dokan-feat-image-id"
                                                    value="0">
                                                <i class="fa fa-cloud-upload"></i>
                                                <a href="#"
                                                    class="dokan-feat-image-btn dokan-btn"><?php _e( 'Upload Product Image', 'dokan' );?></a>
                                            </div>

                                            <div class="image-wrap dokan-hide">
                                                <a class="close dokan-remove-feat-image">&times;</a>
                                                <img src="" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dokan-product-gallery">
                                        <div class="dokan-side-body" id="dokan-product-images">
                                            <div id="product_images_container">
                                                <ul class="product_images dokan-clearfix">
                                                    <li class="add-image add-product-images tips"
                                                        data-title="<?php _e( 'Add gallery image', 'dokan' );?>">
                                                        <a href="#" class="add-product-images"><i class="fa fa-plus"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
                                                <input type="hidden" id="product_image_gallery"
                                                    name="product_image_gallery" value="">
                                            </div>
                                        </div>
                                    </div> <!-- .product-gallery -->
                                </div>
                                <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button"
                                    value="Previous" />
                                <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update"
                                    value="Next" />
                            </div>
                        </div>
                    </div>

                    <!-- Sixth Step Video Tour-->
                    <div class="row setup-content-3" id="step-6">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Add a Video Tour</strong></h3>
                            <div class="form-group md-form">
                                <label for="video" data-error="wrong" data-success="right">Include a Video of Your
                                    Listing</label>
                                <input id="video" type="text" name="video"
                                    placeholder="https://www.youtube.com/watch?v=ffMfvsejBoo" class="form-control">
                            </div>

                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                        </div>
                    </div>
                    <div class="row setup-content-3" id="step-7">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Description</strong></h3>
                            <div class="dokan-form-group dokan-auction-post-excerpt">
                                <textarea name="post_excerpt" id="post-excerpt" rows="5" class="dokan-form-control"
                                    placeholder="<?php esc_attr_e( 'Short description about the listing...', 'dokan' );?>"></textarea>
                            </div>
                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                        </div>
                    </div>
                    <div class="row setup-content-3" id="step-8">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold pl-0 my-4"><strong>Asking Price</strong></h3>

                            <div class="form-group">
                                <label for="_regular_price" data-error="wrong"
                                    data-success="right"><?php _e( 'Final Offer', 'dokan' );?></label>
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">
                                        <span class="dokan-input-group-addon">$</span>
                                        <input id="_regular_price" type="number" name="_regular_price"
                                            placeholder="$404,999" value="1000000"
                                            class="wc_input_price form-control validate">
                                    </div>
                                </div>
                                <div id="final_price_popup">Help me to determine price <i
                                        class="fas fa-info-circle"></i>
                                </div>
                            </div>

                            <div class="half dokan-auction-start-price">
                                <label class="dokan-control-label"
                                    for="_auction_start_price"><?php _e( 'Start Price', 'dokan' );?></label>
                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">
                                        <span class="dokan-input-group-addon">$</span>
                                        <input class="wc_input_price dokan-form-control form-control validate"
                                            name="_auction_start_price" id="_auction_start_price" type="text"
                                            placeholder="" value="" style="width: 97%;">
                                    </div>
                                </div>
                            </div>

                            <div class="dokan-auction-bid-increment">

                                <div class="dokan-form-group">
                                    <div class="dokan-input-group">

                                        <input class="wc_input_price dokan-form-control form-control validate"
                                            name="_auction_bid_increment" id="_auction_bid_increment" type="hidden"
                                            placeholder="" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="half dokan-auction-dates-from">
                                <label class="dokan-control-label"
                                    for="_auction_dates_from"><?php _e( 'Auction Start date', 'dokan' );?></label>
                                <div class="dokan-form-group">
                                    <input class="dokan-form-control auction-datepicker" name="_auction_dates_from"
                                        id="_auction_dates_from" type="text" value="" style="width: 97%;" readonly>

                                </div>
                            </div>

                            <div class="half dokan-auction-dates-to">
                                <label class="dokan-control-label"
                                    for="_auction_dates_to"><?php _e( 'Auction End date', 'dokan' );?></label>
                                <div class="dokan-form-group">
                                    <input class="dokan-form-control auction-datepicker" name="_auction_dates_to"
                                        id="_auction_dates_to" type="text" value="" readonly>
                                </div>
                            </div>
                            <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button" value="Previous" />
                            <input type="submit" class="btn dokan-btn-theme dokan-btn-lg ajax-update" value="Next" />
                        </div>
                    </div>

                    <!-- Final Step -->
                    <div class="row setup-content-3" id="step-9">
                        <div class="col-md-12">

                            <h3 class="font-weight-bold pl-0 my-4"><strong>Finish</strong></h3>
                            <h4 class="font-weight-bold my-4">Listing completed!</h4>



                            <div class="dokan-form-group">
                                <input class="btn dokan-btn-theme dokan-btn-lg prevBtn-3" type="button"
                                    value="Previous" />
                                <input type="hidden" name="product-type" value="auction">

                                <?php wp_nonce_field( 'dokan_add_new_auction_product', 'dokan_add_new_auction_product_nonce' );?>
                                <input type="hidden" name="dokan_product_id" id="dokan-edit-product-id" value="" />
                                <input type="hidden" name="product-type" value="auction">
                                <input type="hidden" name="action" value="update_product_meta">
                                <input type="hidden" name="token"
                                    value="<?php echo isset( $_COOKIE['ris_auction_auth_token'] ) ? $_COOKIE['ris_auction_auth_token'] : ''; ?>">


                                <input type="submit" name="add_auction_product"
                                    class="submit-btn btn dokan-btn-theme dokan-btn-lg"
                                    value="<?php esc_attr_e( 'Add auction', 'dokan' );?>" />
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- Grid row -->
        </div>
    </div>
</div>