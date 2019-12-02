<?php
/*
Template Name: Home Page
*/


get_header('custom');

//Bootstrap CDN
wp_register_style( 'Bootstrap_CSS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );
wp_enqueue_style('Bootstrap_CSS');

wp_register_style( 'MD_Bootstrap_CSS', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/css/mdb.min.css' );
wp_enqueue_style('MD_Bootstrap_CSS');

if ( ! is_admin() ){
    wp_register_script( 'Bootstrap_jQuery', 'https://code.jquery.com/jquery-3.4.1.min.js', null, null, true );
    wp_enqueue_script('Bootstrap_jQuery');
}

wp_register_script( 'Bootstrap_jsOne', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
    null, null, true );
wp_enqueue_script('Bootstrap_jsOne');

wp_register_script( 'Bootstrap_jsTwo', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', null,
    null, true );
wp_enqueue_script('Bootstrap_jsTwo');


//MD Bootstrap CDN
wp_register_script( 'MD_Bootstrap_js', 'https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/js/mdb.min.js', null,
    null, true );
wp_enqueue_script('MD_Bootstrap_js');

?>
<!--    <div id="primary" class="content-area col-md-12 .woocommerce ">-->
<!--        <main id="main" class="site-main" role="main">-->
<!--            <div class="entry-content">-->
<!---->
<!--            </div>-->
<!--        </main>-->
<!--    </div>-->

<div class="container-fluid home-blockOne-container">
    <div class="container">
        <div class="row">
            <div class="col-md home-blockOne-containerLeft">
                <h1 class="home-blockOne-headingLeft">Welcome to Perfectly Plated</h1>
                <br/>
                <p class="home-blockOne-bodyText">
                    Perfectly Plated is a meal prep and catering company located in Belleville, Illinois. We offer individually portioned and fully cooked meals prepared to the specific guidelines of Whole 30 and Keto.
                </p>
                <br/>
                <p class="home-blockOne-bodyText">
                    Let us help take some of the stress out of your next event, whether is a celebration, corporate event or a family gathering, our custom catering will make everyone full and happy. We can also help make any celebration even more special with a custom dessert from cakes to cupcakes and everything in between.
                </p>
                <br/>
                <a href="https://perfectlyplated.com/meal-plans/">
                    <button type="button" class="btn home-blockOne-btnLeft">View our Meal Plans</button>
                </a>
            </div>
            <div class="col-md home-blockOne-containerRight" align="center">
                <div class="home-blockOne-containerRightInner z-depth-3" align="center">
                    <h3 class="home-blockOne-headingRight">How it Works</h3>
                    <i class="fas fa-minus fa-2x fa-rotate-90 home-blockOne-iconsBefore"></i>
                    <br/>
                    <br/>
                    <i class="fas fa-laptop fa-3x home-blockOne-icons"></i>
                    <h4 class="home-blockOne-subheaddings">Order Online</h4>
                    <i class="fas fa-minus fa-2x fa-rotate-90 home-blockOne-iconsBefore"></i>
                    <br/>
                    <br/>
                    <i class="fas fa-shopping-bag fa-3x home-blockOne-icons"></i>
                    <h4 class="home-blockOne-subheaddings">Receive Meals</h4>
                    <i class="fas fa-minus fa-2x fa-rotate-90 home-blockOne-iconsBefore"></i>
                    <br/>
                    <br/>
                    <i class="fas fa-smile fa-3x home-blockOne-icons"></i>
                    <h4 class="home-blockOne-subheaddings">Heat-up, eat, enjoy</h4>
                    <a href="https://perfectlyplated.com/meal-plans/">
                        <button type="button" class="btn home-blockOne-btnRight">View our Meal Plans</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
</div>

<div class="container-fluid home-blockTwoThree-container">
    <div class="container home-blockTwo-container">
        <div class="row display-flex">
            <div class="col-md home-blockTwo-containers">
                <div class="home-blockTwo-containerLeftInner featured-fix z-depth-3">
                    <div class="featured-fix home-blockTwo-boarderInner" align="center">
                        <a href="https://perfectlyplated.com/about-us/">
                            <button type="button" class="btn home-blockTwo-buttons">About Us</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md home-blockTwo-containers" align="center">
                <div class="home-blockTwo-containerMiddelInner featured-fix z-depth-3">
                    <div class="featured-fix home-blockTwo-boarderInner" align="center">
                        <a href="https://perfectlyplated.com/how-it-works/">
                            <button type="button" class="btn home-blockTwo-buttons">How it Works</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md home-blockTwo-containers" align="center">
                <div class="home-blockTwo-containerRightInner featured-fix z-depth-3">
                    <div class="featured-fix home-blockTwo-boarderInner" align="center">
                        <a href="https://perfectlyplated.com/contact-us/">
                            <button type="button" class="btn home-blockTwo-buttons">Contact Us</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <div class="container home-blockThree-container">
        <div class="row display-flex">
            <div class="col-md home-blockThree-containerLeft">
                <div class="featured-fix">

                </div>
            </div>
            <div class="col-md home-blockThree-containerRight">
                <div class="featured-fix">
                    <hr class="home-blockThree-hr"/>
                    <h2 class="home-blockThree-heading">Sign up for our meal prepping classes.</h2>
                    <hr class="home-blockThree-hr"/>
                    <br/>
                    <p class="home-blockThree-subheading">
                        Perfectly Plated hosts freezer meal classes twice a month from August through April. In each class you will prepare 10 family size meals (4 servings each) in about two hours. These meals will be ready to be placed in the freezer at home and prepared in the crockpot (or oven, depending on meal).
                    </p>
                    <p class="home-blockThree-subheading">
                        Can’t make the class, no problem, we will make the meals for you to pick up at a later date.
                    </p>
                    <br/>

                    <a id="classbtnlink" href="https://docs.google.com/forms/d/1yoRXy9hMxNR55diZr26eWrRh4ZZHel_v3VEfOAa-GTs/viewform?edit_requested=true" onclick="test()">
                        <button type="button" class="btn home-blockThree-button">Join Our Class</button>
                    </a>

                    <br/>

                    <a id="classbtnlink" href="https://docs.google.com/forms/d/1Kmuwa3AWFLPN34l915-0L-QQtVwiW12K0d1omSr-70w/viewform?edit_requested=true" onclick="test()">
                        <button type="button" class="btn home-blockThree-button">Order Freezer Meals</button>
                    </a>

                    <script>
                        function test(){
                            if($("#classbtnlink").attr("href") == ""){
                                alert( "No classes available please check back in November" );
                            }
                        }
                        //$( "#classbtnlink" ).click(function() {
                        //    if($("#classbtnlink").attr("href") == ""){
                        //       alert( "Handler for .click() called." );
                        //    }
                        //});
                    </script>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <br/>
</div>

<div class="container-fluid home-blockFour-container">
    <div class="container">
        <div class="row">
            <div class="col-md home-blockFour-containerLeft" align="right">
                <h3 class="home-blockFour-heading">Sign up for our newsletter:</h3>
                <h4 class="home-blockFour-subheading">Recieve our weekly meals, deals and more when you sign up!</h4>
            </div>
            <div class="col-md home-blockFour-containerRight">
                <!-- Begin Mailchimp Signup Form -->
                <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                <style type="text/css">
                    #mc_embed_signup{background: none; clear:left; font:14px Helvetica,Arial,sans-serif; }
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
                            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button home-blockFour-submitButton"></div>
                        </div>
                    </form>
                </div>
                <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                <!--End mc_embed_signup-->
            </div>
        </div>
    </div>
</div>

<?php
get_footer();