<?php
/*
Template Name: Catering Page
*/



//Bootstrap CDN
wp_register_style( 'Bootstrap_CSS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
wp_enqueue_style('Bootstrap_CSS');

wp_register_script( 'Bootstrap_jsOne', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
    null, null, true );
wp_enqueue_script('Bootstrap_jsOne');

wp_register_script( 'Bootstrap_jsTwo', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', null,
    null, true );
wp_enqueue_script('Bootstrap_jsTwo');


//MD Bootstrap CDN
wp_register_style( 'MD_Bootstrap_CSS', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/css/mdb.min.css' );
wp_enqueue_style('MD_Bootstrap_CSS');

wp_register_script( 'MD_Bootstrap_js', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/js/mdb.min.js', null,
    null, true );
wp_enqueue_script('MD_Bootstrap_js');



get_header('custom');

?>
    <!--    <div id="primary" class="content-area col-md-12 .woocommerce ">-->
    <!--        <main id="main" class="site-main" role="main">-->
    <!--            <div class="entry-content">-->
    <!---->
    <!--            </div>-->
    <!--        </main>-->
    <!--    </div>-->


    <div class="container-fluid catering-blockOne-container">
        <div class="container catering-blockOne-containerInner" align="center">
            <h1 class="catering-blockOne-heading">
                <b>Catering</b>
            </h1>
        </div>
    </div>


    <div class="container-fluid catering-blockTwo-container">
        <div class="container catering-blockTwo-containerInner">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 catering-blockTwo-containerLeft">
                    <h5 class="catering-blockTwo-left-headings"><b>Address</b></h5>
                    <h6 class="catering-blockTwo-left-subheadings"><a href="https://goo.gl/maps/KYgEv8dF5cSArC8a6">2346 Mascoutah Avenue<br/>
                            Belleville, IL 62220</a></h6>

                    <h5 class="catering-blockTwo-left-headings"><b>Phone</b></h5>
                    <h6 class="catering-blockTwo-left-subheadings"><a href="tel:+(847)-772-6931">(847)-772-6931</a></h6>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 catering-blockTwo-containerMiddle">
                    <h3 class="catering-blockTwo-middle-heading">Catering with Perfectly Plated</h3>
                    <p class="catering-blockTwo-middle-bodyText">Having an event? Perfectly Plated would love to cater the food. All of our catering is custom, we can make just about anything for any size crowd.</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 catering-blockTwo-containerRight" align="center">
                    <a href="https://perfectlyplated.com/contact-us/">
                        <button type="button" class="btn catering-blockTwo-right-button">Contact Us</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid catering-blockThree-container">
        <div class="container" align="center">
            <div class="row display-flex">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_5597-e1560500249878.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Birthday parties</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_0086-e1560500285347.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Weddings</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_6126-e1560500404209.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Holiday parties</h3>
                    </div>
                </div>
            </div>

            <div class="row display-flex">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_5113.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Graduations</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_1831.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Family get togethers</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_5613.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Baby showers</h3>
                    </div>
                </div>
            </div>

            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_5633.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Bridal showers</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 catering-blockThree-containers" align="center">
                    <div class="featured-fix catering-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_5744.jpg') !important;">
                        <h3 class="catering-blockThree-headings">Corporate events</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="container catering-blockFour-container" align="center">
            <h3 class="catering-blockFour-heading">Lets Cater Your Next Event</h3>
            <?php
            $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            ?>
            <form id="contact-form" name="contact-form" action="<?php echo get_stylesheet_directory_uri(); ?>/mail.php?url=<?php echo $current_url ?>" method="POST">

                <div class="row">
                    <div class="col-md">
                        <br/>
                        <input type="text" id="fname" name="fname" class="form-control rounded-0 catering-blockFour-inputFields" placeholder="First Name">
                    </div>
                    <div class="col-md">
                        <br/>
                        <input type="text" id="lname" name="lname" class="form-control rounded-0 catering-blockFour-inputFields" placeholder="Last Name">
                    </div>
                </div>
                <br/>
                <input type="text" id="phone" name="phone" class="form-control rounded-0 catering-blockFour-inputFields" placeholder="Phone Number">
                <br/>
                <input type="text" id="email" name="email" class="form-control rounded-0 catering-blockFour-inputFields" placeholder="E-mail Address">
                <br/>
                <textarea class="form-control rounded-0 catering-blockFour-inputFields"  id="message" name="message" rows="8" placeholder="Message"></textarea>

            </form>
            <br/>
            <div class="text-center text-md-left">
                <a class="btn btn-lg catering-blockFour-submitButton" onclick="document.getElementById('contact-form').submit();">Submit</a>
            </div>
        </div>
    </div>


    <div class="container-fluid catering-blockFive-container">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div align="center">
                        <h4 class="catering-blockFive-headings"><b>Questions?</b> <br/>View <b>how it works</b><br/>or contact us!</h4>
                        <a href="https://perfectlyplated.com/contact-us/">
                            <button type="button" class="btn about-blockFour-button">Contact Us</button>
                        </a>
                    </div>
                </div>
                <div class="col-md">
                    <div align="center">
                        <h4 class="catering-blockFive-headings"><b>Don't Miss Out!</b><br/>Receive the weekly meals by<br/>subscribing now!</h4>
                        <!-- Begin Mailchimp Signup Form -->
                        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                        <style type="text/css">
                            #mc_embed_signup{clear:left; font:14px Helvetica,Arial,sans-serif; }
                            /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                               We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                        </style>
                        <div id="mc_embed_signup">
                            <form action="https://perfectlyplated.us20.list-manage.com/subscribe/post?u=2661314f53ad87d9277c83d7a&amp;id=55cb8e4b09" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">

                                    <div class="mc-field-group">
                                        <input type="email" value="" name="EMAIL" class="required email catering-blockFive-inputField" id="mce-EMAIL" placeholder="Email Address">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2661314f53ad87d9277c83d7a_55cb8e4b09" tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button catering-blockFive-submitButton"></div>
                                </div>
                            </form>
                        </div>
                        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                        <!--End mc_embed_signup-->
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();