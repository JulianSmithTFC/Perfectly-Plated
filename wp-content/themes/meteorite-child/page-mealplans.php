<?php
/*
Template Name: Meal Plans Page
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

//Slick Slider
wp_register_style( 'Slick_CSS', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
wp_enqueue_style('Slick_CSS');

wp_register_style( 'Slick_Theme_CSS', 'https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.9.0/slick/slick-theme.css' );
wp_enqueue_style('Slick_Theme_CSS');

wp_register_script( 'Slick_js1', 'https://code.jquery.com/jquery-1.11.0.min.js', null,
    null, true );
wp_enqueue_script('Slick_js1');

wp_register_script( 'Slick_js2', 'https://code.jquery.com/jquery-migrate-1.2.1.min.js', null,
    null, true );
wp_enqueue_script('Slick_js2');

wp_register_script( 'Slick_js3', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', null,
    null, true );
wp_enqueue_script('Slick_js3');

get_header('custom');

?>
    <!--    <div id="primary" class="content-area col-md-12 .woocommerce ">-->
    <!--        <main id="main" class="site-main" role="main">-->
    <!--            <div class="entry-content">-->
    <!---->
    <!--            </div>-->
    <!--        </main>-->
    <!--    </div>-->
<?php



if( have_rows('week_1_menu') ):

    while( have_rows('week_1_menu') ): the_row();

        $week1_start_date = get_sub_field('start_date');
        $week1_end_date = get_sub_field('end_date');

    endwhile;
endif;

if( have_rows('week_2_menu') ):

    while( have_rows('week_2_menu') ): the_row();

        $week2_start_date = get_sub_field('start_date');
        $week2_end_date = get_sub_field('end_date');

    endwhile;
endif;

if( have_rows('week_3_menu') ):

    while( have_rows('week_3_menu') ): the_row();

        $week3_start_date = get_sub_field('start_date');
        $week3_end_date = get_sub_field('end_date');

    endwhile;
endif;

if( have_rows('week_4_menu') ):

    while( have_rows('week_4_menu') ): the_row();

        $week4_start_date = get_sub_field('start_date');
        $week4_end_date = get_sub_field('end_date');

    endwhile;
endif;

if( have_rows('week_5_menu') ):

    while( have_rows('week_5_menu') ): the_row();

        $week5_start_date = get_sub_field('start_date');
        $week5_end_date = get_sub_field('end_date');

    endwhile;
endif;

if( have_rows('week_6_menu') ):

    while( have_rows('week_6_menu') ): the_row();

        $week6_start_date = get_sub_field('start_date');
        $week6_end_date = get_sub_field('end_date');

    endwhile;
endif;


/***piyush code**
 * first parameter is slug of category
 * second is from date and third is to date.
 */
 
date_default_timezone_set('US/Central');

$mealplanlist = array(
    array( 'week-1',$week1_start_date, $week1_end_date ),
    array( 'week-2',$week2_start_date, $week2_end_date ),
    array( 'week-3',$week3_start_date, $week3_end_date ),
    array( 'week-4',$week4_start_date, $week4_end_date ),
    array( 'week-5',$week5_start_date, $week5_end_date ),
    array( 'week-6',$week6_start_date, $week6_end_date )
);

$currentDate = date('Y-m-d');
$mealplanCategory = '';
if(!empty($mealplanlist)){
    foreach($mealplanlist as $ml){
        $DateBegin = date('Y-m-d', strtotime($ml[1]));
        $DateEnd = date('Y-m-d', strtotime($ml[2]));
        if (($currentDate >= $DateBegin) && ($currentDate <= $DateEnd)){
            $mealplanCategory = $ml[0];
            break;
        }
    }
}

$args = array(
    'limit' => -1,
    'category' => array($mealplanCategory),
    'orderby' => 'title',
    'order' => 'ASC',
	'type'=> 'bundle',
    'status' => 'publish',
) ;
$products = wc_get_products($args);

$available = 0;
if(!empty($products)){
    $mainArray = array(
            '10 Meal Plan'=>array(),
            '15 Meal Plan'=>array(),
            '20 Meal Plan'=>array(),
            '25 Meal Plan'=>array(),
            '30 Meal Plan'=>array(),
            '35 Meal Plan'=>array(),
            '40 Meal Plan'=>array()
        );
	
	 foreach($products as $product){
		$ProID = $product->get_id();
		$term_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
         if (in_array("10 Meal Plan", $term_list)){
             $mainArray['10 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("15 Meal Plan", $term_list)){
             $mainArray['15 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("20 Meal Plan", $term_list)){
             $mainArray['20 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("25 Meal Plan", $term_list)){
             $mainArray['25 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("30 Meal Plan", $term_list)){
             $mainArray['30 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("35 Meal Plan", $term_list)){
             $mainArray['35 Meal Plan'][]= $product;
             $available = 1;
         }
         if (in_array("40 Meal Plan", $term_list)){
             $mainArray['40 Meal Plan'][]= $product;
             $available = 1;
         }
	 }
}

$emptymenuimg = get_stylesheet_directory_uri().'/menu-icon-for-cstom-shop.png';

?>
<style>
.mealplan-list{
	border: 1px solid #9ee06e;
    padding: 26px;
    margin-bottom: 20px;
}
.oz-button:hover{
	color: #eb1f8c;
	background-color: transparent;
	text-decoration: none;
	background-image: none;
	border-color: #eb1f8c;
}
.oz-button{
	background-color: #eb1f8c;
	border-color: #eb1f8c;
	border: 1px solid #eb1f8c;
	border-radius: 3px;
	color: #fff;
	display: inline-block;
	font-size: 14px;
	font-weight: bold;
	padding: 10px 15px;
	text-transform: uppercase;
}
.menunotavilable{
	text-align:center;
}
</style>
<div class="container-fluid plans-blockOne-container">
    <div class="container" align="center">
        <h1 class="plans-blockOne-heading">Our Meal Plans</h1>
        <hr class="plans-blockOne-hr"/>
        <br/>
        <p class="menu-blockOne-instructionsText">Select your desired meal plan and meals below and checkout when done.</p>
        <p class="menu-blockOne-instructionsText">Our meal plans change weekly, new meal plans are released each <strong>Monday at 12:01 a.m.</strong> The deadline for ordering is each <strong>Wednesday at 11:59 p.m.</strong>. Meals are then ready for pick-up or delivery the following week on Sunday, Monday, and Wednesday evenings.</p>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if($available == 1){
                foreach($mainArray as $catname=>$allproducts){
                    foreach($allproducts as $oneproduct){
                        $ProID = $oneproduct->get_id();
                        $ProName = $oneproduct->get_name();
                        $price_html = $oneproduct->get_price_html();
                        ?>
                        <div class="col-md-4" align="center">
                            <div class="mealplan-list">
                                <a href="<?php echo get_permalink($ProID); ?>"><h3><strong><?php echo $ProName; ?></strong></h3></a>
                                <h6><span class="price" style="color:#eb1f8c;font-size: 24px;"><strong><?php echo $price_html; ?></strong></span></h6>
                                <a href="<?php echo get_permalink($ProID); ?>" class="button oz-button">View Meals</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }else{ ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="menu-blockThree-container" align="center">
                        <h3 class="menu-blockThree-heading">oh no....</h3>
                        <p class="menu-blockThree-bodyText">Looks like you missed our deadline for ordering.</p>
                        <br/>
                        <i class="fas fa-utensils fa-7x menu-blockThree-icon"></i>
                        <br/>
                        <br/>
                        <p class="menu-blockThree-bodyText">Sign up below to get notified when our meals are ready for ordering!</p>
                        <!-- Begin Mailchimp Signup Form -->
                        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                        <div id="mc_embed_signup" class="menu-blockThree-mc_embed_signup">
                            <form action="https://perfectlyplated.us20.list-manage.com/subscribe/post?u=2661314f53ad87d9277c83d7a&amp;id=55cb8e4b09" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">

                                    <div class="mc-field-group">
                                        <label for="mce-EMAIL">Email Address </label>
                                        <input type="email" value="" name="EMAIL" class="required email menu-blockThree-inputFields" id="mce-EMAIL">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2661314f53ad87d9277c83d7a_55cb8e4b09" tabindex="-1" value=""></div>
                                    <div class="clear">
                                        <input type="submit" value="Signup!" name="subscribe" id="mc-embedded-subscribe" class="button menu-blockThree-submitButton">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                        <!--End mc_embed_signup-->
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>

<div class="container-fluid  plans-blockThree-container">
    <div class="container" align="center">
        <h3 class="plans-blockThree-heading">Ordering less then 10 meals or family meals? Click the button below to view À La Carte menu.</h3>
        <a href="https://perfectlyplated.com/menu/">
            <button class="btn btn-large plans-blockThree-button">View À La Carte Menu</button>
        </a>
    </div>
</div>

<div class="container-fluid plans-blockFour-container">
    <div class="container plans-blockFour-innerContainer" align="center">
        <h2 class="plans-blockFour-heading">Our Customers Reviews</h2>
        <div class="slider hidden-sm hidden-xs" align="center">
            <?php

            $currentID = get_the_ID();

            $args = array(
                'post_type'   => 'customer_reviews',
                'post_status' => 'publish',
                'orderby' => 'title',

            );

            $puppies = new WP_Query( $args );
            if( $puppies->have_posts() ) :

                ?>
                <?php
                while( $puppies->have_posts() ) : $puppies->the_post();

                    $name = get_the_title();
                    $content = get_field('review_content');
                    $service_used = get_field('service_used');
                    ?>
                    <div class="plans-blockFour-containers" align="left">
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <br/>
                        <br/>
                        <div class="plans-blockFour-reviewText"><?php echo $content ?></div>
                        <br/>
                        <p class="plans-blockFour-nameText">~<?php echo $name ?></p>
                    </div>
                <?php
                endwhile;
            endif;
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </div>

        <div class="slider-mobile hidden-xl hidden-lg hidden-md" align="center">
            <?php

            $currentID = get_the_ID();

            $args = array(
                'post_type'   => 'customer_reviews',
                'post_status' => 'publish',
                'orderby' => 'title',

            );

            $puppies = new WP_Query( $args );
            if( $puppies->have_posts() ) :

                ?>
                <?php
                while( $puppies->have_posts() ) : $puppies->the_post();

                    $name = get_the_title();
                    $content = get_field('review_content');
                    $service_used = get_field('service_used');
                    ?>
                    <div class="plans-blockFour-containers" align="left">
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <i class="fas fa-star plans-blockFour-icons fa-2x"></i>
                        <br/>
                        <br/>
                        <div class="plans-blockFour-reviewText"><?php echo $content ?></div>
                        <br/>
                        <p class="plans-blockFour-nameText">~<?php echo $name ?></p>
                    </div>
                <?php
                endwhile;
            endif;
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<div class="container-fluid plans-blockFive-container">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div align="center">
                    <h4 class="plans-blockFive-headings"><b>Questions?</b> <br/>View <b><a href="https://perfectlyplated.com/how-it-works">how it works</a></b><br/>or contact us!</h4>
                    <a href="https://perfectlyplated.com/contact-us">
                        <button type="button" class="btn plans-blockFive-button">Contact Us</button>
                    </a>
                </div>
            </div>
            <div class="col-md">
                <div align="center">
                    <div class="">
                            <h4 class="plans-blockFive-headings"><b>Don't Miss Out!</b><br/>Receive the weekly meals by<br/>subscribing now!</h4>
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
                                        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button plans-blockFive-submitButton"></div>
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
</div>

<?php
get_footer();

?>

<script>
    $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        mobileFirst: true,
        autoplay: true,
        autoplaySpeed: 6000,
        dots: false,
        arrows: false,
        pauseOnHover: false,
        infinite: true,
        cssEase: 'linear'
    });

    $('.slider-mobile').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        mobileFirst: true,
        autoplay: true,
        autoplaySpeed: 6000,
        dots: false,
        arrows: false,
        pauseOnHover: false,
        infinite: true,
        cssEase: 'linear'
    });


</script>