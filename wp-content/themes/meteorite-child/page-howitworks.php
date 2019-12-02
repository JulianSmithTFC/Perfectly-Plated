<?php
/*
Template Name: How it Works Page
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


    <div class="container-fluid how-blockOne-container">
        <div class="container how-blockOne-containerInner" align="center">
            <h1 class="how-blockOne-heading">
                <b>How It Works</b>
            </h1>
        </div>
    </div>


    <div class="container-fluid how-blockTwo-container">
        <div class="container">
            <div class="how-blockTwo-containerImage z-depth-1-half">
                <div class="row justify-content-start">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="z-depth-3 how-blockTwo-containerInner" align="left">
                            <h3 class="how-blockTwo-heading">Pick and Choose The Meals That is Right for You!</h3>
                            <p class="how-blockTwo-bodyText">Our menu changes weekly, new menus are released each Monday at 12:01 a.m. and finish on Wednesday at 11:59 p.m..  There are 10 options for breakfast (4 of which are Whole 30, 4 of which are Keto), 10 options for lunch (4 of which are Whole 30, 4 of which are Keto), and 10 options for dinner.</p>
                            <br/>
                            <a href="https://perfectlyplated.com/menu/">
                                <button type="button" class="btn how-blockTwo-button">Get Started</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid how-blockThree-container">
        <div class="container">
            <div class="how-blockThree-containerImage z-depth-1-half">
                <div class="row justify-content-end">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="z-depth-3 how-blockThree-containerInner" align="left">
                            <h3 class="how-blockThree-heading">Get Your Meals Delivered!</h3>
                            <p class="how-blockThree-bodyText">
                                <b>Delivery Dates/Times:</b>
                                <br/>Sunday 5 p.m. - 7 p.m.
                                <br/>Wednesday 5 p.m. - 7 p.m.
                                <br/><b>Pick-up Dates/Times:</b>
                                <br/>Sunday 4:30 p.m. - 7 p.m.
                                <br/>Monday 4:30 p.m. - 7 p.m.
                                <br/>Wednesday 4:30 p.m. - 7 p.m.
                            </p>
                            <br/>
                            <a href="https://perfectlyplated.com/menu/">
                                <button type="button" class="btn how-blockThree-button">Get Started</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="container how-blockFour-container">
            <div align="center">
                <h2 class="how-blockFour-heading">Mealtime Made Easy</h2>
                <p class="how-blockFour-bodyText">We take care of the planning, shopping, prepping, chopping, cooking, dishes and plating. You just heat (if required) and eat. Our meals are freshly prepared and stored in the refrigerator for up to 7 days. We prepare meals twice a week to ensure that you are receiving the freshest meals possible. Our meals are individually portioned in disposable containers, which are microwave and freezer safe, as well as BPA free.</p>
                <hr class="how-blockFour-hr"/>
            </div>
            <div class="row display-flex">
                <div class="col-md how-blockFour-containers how-blockFour-containerLeft">
                    <div class="featured-fix">
                        <img src="https://perfectlyplated.com/wp-content/uploads/2019/06/PP-Pizza-Fat-Bombs-K.jpg" alt="Food Image" class="how-blockFour-image img-fluid z-depth-3">
                    </div>
                </div>
                <div class="col-md how-blockFour-containers">
                    <div class="featured-fix">
                        <p class="how-blockFour-bodyText">We offer breakfast, lunch & dinner the following ways:</p>
                        <ul class="how-blockFour-bodyText">
                            <li>Home-style meals</li>
                            <li>Whole 30 meals – gluten, grain, dairy & refined sugar free</li>
                            <li>Keto meals -  gluten, grain & refined sugar free</li>
                            <li>Kid’s meals</li>
                            <li>Snacks – regular, Paleo, Whole 30 & Keto</li>
                        </ul>
                        <p class="how-blockFour-bodyText">We also offer family portions of our meals, which feed at least 6 and typically come in a 9x13 pan.</p>
                    </div>
                </div>
            </div>
            <div align="center">
                <a href="https://perfectlyplated.com/meal-plans/">
                    <button type="button" class="btn how-blockFour-button">View Our Plans</button>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container how-blockFive-container" align="center">
          <h2 class="how-blockFive-heading">Frequently Asked Questions</h2>
            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-1" role="button" aria-expanded="false" aria-controls="faq-1">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  How do I pay?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-1" align="left">
                            <p>You will have the option to pay online when you place your order or you can select to pay in store via cash, check or charge. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-2" role="button" aria-expanded="false" aria-controls="faq-2">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  What are the Delivery and Pickup times?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-2" align="left">
                            <p>
                                <b>Delivery Dates/Times:</b>
                                <br/>Sunday 5 p.m. - 7 p.m.
                                <br/>Wednesday 5 p.m. - 7 p.m.
                                <br/><b>Pick-up Dates/Times:</b>
                                <br/>Sunday 4:30 p.m. - 7 p.m.
                                <br/>Monday 4:30 p.m. - 7 p.m.
                                <br/>Wednesday 4:30 p.m. - 7 p.m.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-3" role="button" aria-expanded="false" aria-controls="faq-3">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  Where are you located?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-3" align="left">
                            <p>We are located at the Family Sportsplex complex - 2346 Mascoutah Ave., in Belleville. We are directly in front of you as you pull in the parking lot, look for our bright pink signs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-4" role="button" aria-expanded="false" aria-controls="faq-4">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  How do I warm up my meals?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-4" align="left">
                            <p>Meals are packaged to be reheated in the microwave (containers are BPA free and microwave safe). Cooking times and temperatures will vary. Be sure to reheat your food to the safe temperature of 135 degrees.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-5" role="button" aria-expanded="false" aria-controls="faq-5">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  Where & how much is delivery?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-5" align="left">
                            <p>We deliver within 30 miles of our location.
                                <br/>
                                <b>Zone One Cost $10:</b>
                                <br/>
                                62220, 62222, 62226, 62243, 62221
                                <br/>
                                <b>Zone Two Cost $15:</b>
                                <br/>
                                62285, 62223, 62260, 62225, 62208, 62269
                                <br/>
                                <b>Zone Three Cost $20:</b>
                                <br/>
                                62203, 62258, 62248, 62264, 62232, 62207, 62239, 62205, 62254, 62206, 62236, 62204, 62240, 62201, 62202, 62298, 62289
                                <br/>
                                <b>Zone Four Cost $25:</b>
                                <br/>
                                62255, 62234, 62257, 62266, 62071, 62282, 62265, 63111, 63104, 63118, 63101, 63166, 63156, 63197, 63164, 63150, 63182, 63169, 63158, 63178, 63160, 63199, 63179, 63188, 63171, 63177, 63163, 63157, 63195, 63180, 63102, 63155, 62059, 62294, 63167, 62060, 63103, 62090, 63106, 62062, 63116, 63125, 62278, 63151, 63107, 63129, 63109, 62281, 63108, 63110, 62256, 63123, 62293, 62040, 63113, 62034
                                <br/>
                                <b>Zone Five Cost $30:</b>
                                <br/>
                                63139, 62215, 63147, 63115, 62217, 63143, 62214, 63112, 62216, 63120, 63119, 63128, 62245, 63117, 62026, 63126, 63105, 63144, 63053, 62295, 62244, 62279, 63137, 63133, 63130, 63010, 62292, 62061, 63127, 63121, 63136, 63057, 62087, 63124, 63052, 62242, 62271
                                <br/>
                                <b>Zone Six Cost $35:</b>
                                <br/>
                                63099, 62048, 63122, 63138, 63135, 63132, 62084, 63114, 62277, 63026, 62249, 62024, 63140, 62025, 63048, 62218, 62230, 63019, 62286, 63070, 63012, 63131, 63134, 62268, 62095, 63033, 62237, 63145, 63074, 63141, 63032, 62273, 62297, 63088
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-6" role="button" aria-expanded="false" aria-controls="faq-6">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  Can I freeze my meals?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-6" align="left">
                            <p>Our meals are prepared fresh twice a week to ensure you are receiving the freshest meals possible. Our meals are meant to be stored in the refrigerator for up to seven days. Some of our meals can be frozen it completely depends on the contents of the meal.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row display-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-7" role="button" aria-expanded="false" aria-controls="faq-7">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  What comes in a meal plan?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-7" align="left">
                            <p>You essentially create your own meal plan by selecting the meals and quantities that you would like. You do not have to get a set number of breakfast, lunch or dinner, you can mix and match as you please.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="left">
                    <div class="featured-fix">
                        <a data-toggle="collapse" href="#faq-8" role="button" aria-expanded="false" aria-controls="faq-8">
                            <h6 class="how-blockFive-questions"><i class="fas fa-plus how-blockFive-icon"></i>  Is there a minimum number of meals to purchase or a subscription?</h6>
                        </a>
                        <div class="collapse how-blockFive-answeres" id="faq-8" align="left">
                            <p>No minimum order required. Order as many or as few meals as you need for the week. There is also not a subscription to use our service, so order when you need meals and skip a week or two when you are on vacation, with no problem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="container how-blockSix-container">
          <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" align="center">
                  <h4 class="how-blockSix-headings"><b>Don't Miss Out!</b><br/>Receive the weekly meals by<br/>subscribing now!</h4>
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
                              <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button how-blockSix-submitButton"></div>
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