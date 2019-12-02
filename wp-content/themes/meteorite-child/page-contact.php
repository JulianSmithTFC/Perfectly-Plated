<?php
/*
Template Name: Contact Page
*/


get_header('custom');

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



?>
<!--    <div id="primary" class="content-area col-md-12 .woocommerce ">-->
<!--        <main id="main" class="site-main" role="main">-->
<!--            <div class="entry-content">-->
<!---->
<!--            </div>-->
<!--        </main>-->
<!--    </div>-->


<div class="container-fluid">
    <div class="container" align="center">
        <div class="contact-container" align="left">
            <div align="center">
                <h1 class="contact-heading">Contact Us</h1>
                <br/>
                <h4 class="contact-subheading">Please use form below or give us a call!</h4>
                <br/>
                <br/>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact-containerLeft">
                    <div class="container-fluid">
                        <div class="row justify-content-end">
                            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 z-depth-3 contact-left-containers">
                                <h3 class="contact-left-headings"><b>Phone</b></h3>
                                <br/>
                                <a href="tel:+(847)-772-6931"><h4 class="contact-left-subheadings">(847)-772-6931</h4></a>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div  class="col-lg-11 col-md-11 col-sm-12 col-xs-12 z-depth-3 contact-left-containers">
                                <h3 class="contact-left-headings"><b>Office Hours</b></h3>
                                <br/>
                                <h4 class="contact-left-subheadings">Monday: By Appointment<br/>
                                    Tuesday: 9am - 3pm<br/>
                                    Wednesday: 9am - 3pm<br/>
                                    Thursday: By Appointment<br/>
                                    Friday: 9am - 3pm<br/>
                                    Saturday: 9am - 3pm<br/>
                                    Sunday: By Appointment</h4>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 z-depth-3 contact-left-containers">
                                <h3 class="contact-left-headings"><b>Address</b></h3>
                                <br/>
                                <a href="https://goo.gl/maps/KYgEv8dF5cSArC8a6"><h4 class="contact-left-subheadings">2346 Mascoutah Avenue<br/>
                                        Belleville, IL 62220</h4></a>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 z-depth-3 contact-left-containers">
                                <h3 class="contact-left-headings"><b>Social Media</b></h3>
                                <br/>
                                <div class="contact-left-subheadings" align="center">
                                    <h4><a href="https://www.facebook.com/Perfectly-Plated-371790976626864/"><i class="fab fa-facebook-square fa-2x contact-left-icons"></i></a>  <a href="https://www.instagram.com/perfectlyplated18/"><i class="fab fa-instagram fa-2x contact-left-icons"></i></a></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 contact-containerRight">
                    <div class="contact-containerRight-inner z-depth-3">
                        <?php
                        $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        ?>
                        <form id="contact-form" name="contact-form" action="<?php echo get_stylesheet_directory_uri(); ?>/mail.php?url=<?php echo $current_url ?>" method="POST">

                            <div class="row">
                                <div class="col-md">
                                    <label class="contact-right-lables" for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control contact-right-inputs" placeholder="First name">
                                </div>
                                <div class="col-md">
                                    <label class="contact-right-lables" for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="form-control contact-right-inputs" placeholder="Last name">
                                </div>
                            </div>
                            <br/>
                            <label class="contact-right-lables" for="phone">Phone</label>
                            <input type="email" id="phone" name="phone" class="form-control mb-4 contact-right-inputs" placeholder="Phone Number">
                            <label class="contact-right-lables" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control mb-4 contact-right-inputs" placeholder="E-mail">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input contact-right-inputs" id="mealplanchk" name="mealplanchk">
                                <label class="custom-control-label contact-right-lables-green" for="mealplanchk">Meal Plans</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input contact-right-inputs" id="challengchk" name="challengchk">
                                <label class="custom-control-label contact-right-lables-green" for="challengchk">Challenges</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input contact-right-inputs" id="cateringchk" name="cateringchk">
                                <label class="custom-control-label contact-right-lables-green" for="cateringchk">Catering</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input contact-right-inputs" id="dessertschk" name="dessertschk">
                                <label class="custom-control-label contact-right-lables-green" for="dessertschk">Desserts</label>
                            </div>
                            <br/>

                            <label class="contact-right-lables" for="message">Message</label>
                            <textarea class="form-control rounded-0 contact-right-inputs"  id="message" name="message" rows="8" placeholder="Message"></textarea>

                        </form>
                        <br/>
                        <div class="text-center text-md-left">
                            <a class="btn btn-lg btn-block contact-right-button" onclick="document.getElementById('contact-form').submit();">Send</a>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
</div>

<?php
get_footer();