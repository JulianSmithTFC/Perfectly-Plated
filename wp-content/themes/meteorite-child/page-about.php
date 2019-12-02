<?php
/*
Template Name: About Page
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


    <div class="container-fluid about-blockOne-container">
        <div class="container about-blockOne-containerInner" align="center">
            <h1 class="about-blockOne-heading">
                <b>Our Perfect Plate</b>
            </h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container about-blockTwo-container">
            <div class="row display-flex">
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 about-blockTwo-containerLeft">
                    <div class="featured-fix">
                        <h2 class="about-blockTwo-heading">
                            How We Work
                        </h2>
                        <br/>
                        <p class="about-blockTwo-bodyText">
                            Perfectly Plated strives to make meal time easier and healthier. We take the time to plan, shop, chop, prep, cook and plate your meals. This means all you have to do is heat and eat. We offer homestyle, Whole 30, Keto and kid’s meals, so whether you are looking for a healthier alternative, looking to lose weight, healing your body with food, need quick meal options for a busy lifestyle or simply don’t want to cook - we’ve got you covered!
                        </p>
                        <p class="about-blockTwo-bodyText">
                            Perfectly Plated also offers catering, from small family celebrations to wedding to large corporate events. We offer everything from appetizers to main dishes and desserts, including custom cakes and desserts.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 about-blockTwo-containerRight">
                    <br/>
                    <br/>
                    <div class="featured-fix" align="right">
                        <div class="about-blockTwo-circleImage featured-fix z-depth-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container about-blockThree-container">
            <div class="row display-flex">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 about-blockThree-containerLeft">
                    <div class="featured-fix" align="left">
                        <div class="about-blockThree-circleImage featured-fix z-depth-3">
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 about-blockThree-containerRight">
                    <div class="featured-fix">
                        <h2 class="about-blockThree-heading">
                            Our Founder
                        </h2>
                        <br/>
                        <p class="about-blockThree-bodyText">
                            Perfectly Plated is owned and operated by Jessica Johnson. She has always had a passion for cooking and a career change in 2016 allowed her the opportunity to follow a different dream.
                        </p>
                        <p class="about-blockThree-bodyText">
                            Previously Jessica was a teacher and principal in Chicago for over a decade. As a teacher, she always meal prepped for herself and other teachers. When the opportunity to move presented itself, Jessica took it and moved to Shiloh. She began meal prepping for a few close family friends and the word began to spread about her business. Before she knew it she was looking for a commercial kitchen. Perfectly Plated has been at it’s Belleville location since the beginning of 2018.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid about-blockFour-container">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div align="center">
                        <h4 class="about-blockFour-headings"><b>Questions?</b> <br/>View <b>how it works</b><br/>or contact us!</h4>
                        <a href="https://perfectlyplated.com/contact-us/">
                            <button type="button" class="btn about-blockFour-button">Contact Us</button>
                        </a>
                    </div>
                </div>
                <div class="col-md">
                    <div align="center">
                        <h4 class="about-blockFour-headings"><b>Don't Miss Out!</b><br/>Receive the weekly meals by<br/>subscribing now!</h4>
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
                                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2661314f53ad87d9277c83d7a_55cb8e4b09" tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button about-blockFour-submitButton"></div>
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