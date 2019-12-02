<?php
/*
Template Name: Desserts Page
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


    <div class="container-fluid desserts-blockOne-container">
        <div class="container desserts-blockOne-containerInner" align="center">
            <h1 class="desserts-blockOne-heading">
                <b>Desserts</b>
            </h1>
        </div>
    </div>


    <div class="container-fluid desserts-blockTwo-container">
        <div class="container desserts-blockTwo-containerInner">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 desserts-blockTwo-containerLeft">
                    <h5 class="desserts-blockTwo-left-headings"><b>Address</b></h5>
                    <h6 class="desserts-blockTwo-left-subheadings"><a href="https://goo.gl/maps/KYgEv8dF5cSArC8a6">2346 Mascoutah Avenue<br/>
                            Belleville, IL 62220</a></h6>

                    <h5 class="desserts-blockTwo-left-headings"><b>Phone</b></h5>
                    <h6 class="desserts-blockTwo-left-subheadings"><a href="tel:+(847)-772-6931">(847)-772-6931</a></h6>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 desserts-blockTwo-containerMiddle">
                    <h3 class="desserts-blockTwo-middle-heading">Desserts with Perfectly Plated</h3>
                    <p class="desserts-blockTwo-middle-bodyText">Celebrating something? Perfectly Plated would love to make the dessert! We offer custom cakes, cupcakes, cookies and everything in between.
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 desserts-blockTwo-containerRight" align="center">
                    <a href="https://perfectlyplated.com/contact-us/">
                        <button type="button" class="btn desserts-blockTwo-right-button">Contact Us</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid desserts-blockThree-container">
        <div class="container" align="center">
            <div class="row display-flex">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_2188.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Birthday</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/Chocolate-Covered-Strawberries.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Anniversary</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_1580-e1560503402573.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Baby shower</h3>
                    </div>
                </div>
            </div>
            s

            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/IMG_2909.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Keto Desserts</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/Brownie-Trees.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Holiday</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 desserts-blockThree-containers" align="center">
                    <div class="featured-fix desserts-blockThree-containersInner z-depth-3 hvr-grow" style="background-image: url('https://perfectlyplated.com/wp-content/uploads/2019/06/Rainbow-Cupcakes.jpg') !important;">
                        <h3 class="desserts-blockThree-headings">Bridal shower</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="container desserts-blockFour-container" align="center">
            <h3 class="desserts-blockFour-heading">Contact Us Today!</h3>
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
                <a class="btn btn-lg desserts-blockFour-submitButton" onclick="document.getElementById('contact-form').submit();">Submit</a>
            </div>
        </div>
    </div>


    <div class="container-fluid desserts-blockFive-container">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div align="center">
                        <h4 class="desserts-blockFive-headings"><b>Questions?</b> <br/>View <b>how it works</b><br/>or contact us!</h4>
                        <a href="https://perfectlyplated.com/contact-us/">
                            <button type="button" class="btn about-blockFour-button">Contact Us</button>
                        </a>
                    </div>
                </div>
                <div class="col-md">
                    <div align="center">
                        <h4 class="desserts-blockFive-headings"><b>Don't Miss Out!</b><br/>Receive the weekly meals by<br/>subscribing now!</h4>
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
                                        <input type="email" value="" name="EMAIL" class="required email desserts-blockFive-inputField" id="mce-EMAIL" placeholder="Email Address">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2661314f53ad87d9277c83d7a_55cb8e4b09" tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button desserts-blockFive-submitButton"></div>
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