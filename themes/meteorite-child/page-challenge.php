<?php
/*
Template Name: Challenge Page
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

if ( have_rows( 'membership_sale' ) ) :
    while ( have_rows( 'membership_sale' ) ) : the_row();
        $membershipSale_start_date = get_sub_field( 'start_date' );
        $membershipSale_end_date = get_sub_field( 'end_date' );
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

$currentmealplan = array(
    array( $week1_end_date,  $week2_start_date, $week2_start_date, $week2_end_date),
    array( $week2_end_date, $week3_start_date , $week3_start_date, $week3_end_date),
    array( $week3_end_date, $week4_start_date , $week4_start_date, $week4_end_date),
    array( $week4_end_date, $week5_start_date , $week5_start_date, $week5_end_date),
    array( $week5_end_date, $week6_start_date , $week6_start_date, $week6_end_date),
);

$nextmealplandates = '';

if(!empty($currentmealplan)){
    foreach($currentmealplan as $cmp){
        $DateBeginCurrentPlan = date('Y-m-d', strtotime($cmp[0]));
        $DateEndCurrentPlan = date('Y-m-d', strtotime($cmp[1]));
        if (($currentDate > $DateBeginCurrentPlan) && ($currentDate < $DateEndCurrentPlan)){
            $nextmealplandates = ('<b>' . date('M d', strtotime($cmp[2])) . ' at 12:01 a.m. - ' . date('M d', strtotime($cmp[3])) . ' at 11:59 p.m.</b>');
            break;
        }
    }
}


if (($currentDate > (date('Y-m-d', strtotime($membershipSale_start_date)))) && ($currentDate < (date('Y-m-d', strtotime($week1_start_date))))){
    $nextmealplandates = ('<b>' . date('M d', strtotime($week1_start_date)) . ' at 12:01 a.m. - ' . date('M d', strtotime($week1_end_date)) . ' at 11:59 p.m.</b>');
}


$SaleDateBegin = date('Y-m-d', strtotime($membershipSale_start_date));
$SaleDateEnd = date('Y-m-d', strtotime($membershipSale_end_date));
if (($currentDate >= $SaleDateBegin) && ($currentDate <= $SaleDateEnd)){
    $Sale = 'yes';
}
else{
    $Sale = 'no';
}


$args = array(
    'limit' => -1,
    'category' => array($mealplanCategory),
    'orderby' => 'title',
    'order' => 'DES',
    'type'=> 'bundle',
    'status' => 'publish',
) ;
$products = wc_get_products($args);

$available = 0;
if(!empty($products)){
    $mainArray = array(
        'Challenge Individual'=>array(),
        'Challenge Friend'=>array()
    );

    foreach($products as $product){
        $ProID = $product->get_id();
        $term_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
        if (in_array("Individual Challenge", $term_list)){
            $mainArray['Individual Challenge'][]= $product;
            $available = 1;
        }
        if (in_array("Friend Challenge", $term_list)){
            $mainArray['Friend Challenge'][]= $product;
            $available = 1;
        }
    }
}

$emptymenuimg = get_stylesheet_directory_uri().'/menu-icon-for-cstom-shop.png';

?>

<div class="container-fluid challenge-blockOne-container">
    <div class="container" align="center">
        <h3 class="challenge-blockOne-heading">You've reached a Member Only Area</h3>
        <h4 class="challenge-blockOne-subheading">Want to be a part of our 6 Week Challenge Meals?</h4>
    </div>
    <div class="container challenge-blockOne-priceOuterContainer">
        <div class="row display-flex">
            <div class="col-md challenge-blockOne-priceInnerContainer">
                <div class="z-depth-2 challenge-blockOne-priceContainer featured-fix" align="center">
                    <h5 class="challenge-blockOne-pricingHeading">Individual Challenge</h5>
                    <hr class="challenge-blockOne-hrline"/>
                    <div align="left">
                        <ul class="fa-ul challenge-blockOne-ul">
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>21 Meals a Week</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Challenge Last 6 Weeks</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Price: <strong>$750</strong> One Time or <strong>$135</strong> a Week</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Challenge Start and End Date: <strong><?php echo (date('F d, Y', strtotime($week1_start_date)) . ' - ' . date('F d, Y', strtotime($week6_end_date))) ?></strong></li>
                            <li class="challenge-blockOne-li">
                                <ul class="fa-ul challenge-blockOne-ul">
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week One Menu Available: <strong><?php echo (date('M d', strtotime($week1_start_date)) . ' - ' . date('M d', strtotime($week1_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Two Menu Available: <strong><?php echo (date('M d', strtotime($week2_start_date)) . ' - ' . date('M d', strtotime($week2_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Three Menu Available: <strong><?php echo (date('M d', strtotime($week3_start_date)) . ' - ' . date('M d', strtotime($week3_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Four Menu Available: <strong><?php echo (date('M d', strtotime($week4_start_date)) . ' - ' . date('M d', strtotime($week4_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Five Menu Available: <strong><?php echo (date('M d', strtotime($week5_start_date)) . ' - ' . date('M d', strtotime($week5_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Six Menu Available: <strong><?php echo (date('M d', strtotime($week6_start_date)) . ' - ' . date('M d', strtotime($week6_end_date))) ?></strong></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php
                    if ($Sale == 'yes'){
                        if ( have_rows( 'membership_sale_links' ) ) :
                            while ( have_rows( 'membership_sale_links' ) ) : the_row();
                                $individual_onetime_membership_ = get_sub_field( 'individual_onetime_membership_' );
                                if ( $individual_onetime_membership_ ) { ?>
                                    <a href="<?php echo $individual_onetime_membership_['url']; ?>" class="btn btn-block challenge-blockOne-buttonTop" target="<?php echo $individual_onetime_membership_['target']; ?>"><?php echo $individual_onetime_membership_['title']; ?></a>
                                <?php }
                                $individual_6_week_membership_subscription = get_sub_field( 'individual_6_week_membership_subscription' );
                                if ( $individual_6_week_membership_subscription ) { ?>
                                    <a href="<?php echo $individual_6_week_membership_subscription['url']; ?>" class="btn btn-block challenge-blockOne-buttonBottom" target="<?php echo $individual_6_week_membership_subscription['target']; ?>"><?php echo $individual_6_week_membership_subscription['title']; ?></a>
                                <?php }
                            endwhile;
                        endif;
                    }else{
                        ?>
                        <p class="challenge-blockOne-message">This Memberships is not available at this time. Memberships go on sale: <strong><?php echo (date('F d, Y', strtotime($membershipSale_start_date)) . ' - ' . date('F d, Y', strtotime($membershipSale_end_date))) ?></strong></p>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-md challenge-blockOne-priceInnerContainer">
                <div class="z-depth-2 challenge-blockOne-priceContainer featured-fix" align="center">
                    <h5 class="challenge-blockOne-pricingHeading">Friend Challenge</h5>
                    <hr class="challenge-blockOne-hrline"/>
                    <p class="challenge-blockOne-priceSubheading">Bring a friend and do the challenge together</p>
                    <div align="left">
                        <ul class="fa-ul challenge-blockOne-ul">
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>42 Meals a Week</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Challenge Last 6 Weeks</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Price: <strong>$1300</strong> One Time or <strong>$235</strong> a Week</li>
                            <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-check-square"></i></span>Challenge Start and End Date: <strong><?php echo (date('F d, Y', strtotime($week1_start_date)) . ' - ' . date('F d, Y', strtotime($week6_end_date))) ?></strong></li>
                            <li class="challenge-blockOne-li">
                                <ul class="fa-ul challenge-blockOne-ul">
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week One Menu Available: <strong><?php echo (date('M d', strtotime($week1_start_date)) . ' - ' . date('M d', strtotime($week1_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Two Menu Available: <strong><?php echo (date('M d', strtotime($week2_start_date)) . ' - ' . date('M d', strtotime($week2_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Three Menu Available: <strong><?php echo (date('M d', strtotime($week3_start_date)) . ' - ' . date('M d', strtotime($week3_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Four Menu Available: <strong><?php echo (date('M d', strtotime($week4_start_date)) . ' - ' . date('M d', strtotime($week4_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Five Menu Available: <strong><?php echo (date('M d', strtotime($week5_start_date)) . ' - ' . date('M d', strtotime($week5_end_date))) ?></strong></li>
                                    <li class="challenge-blockOne-li"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span>    Week Six Menu Available: <strong><?php echo (date('M d', strtotime($week6_start_date)) . ' - ' . date('M d', strtotime($week6_end_date))) ?></strong></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php
                    if ($Sale == 'yes'){

                        if ( have_rows( 'membership_sale_links' ) ) :
                            while ( have_rows( 'membership_sale_links' ) ) : the_row();
                                $friend_onetime_membership = get_sub_field( 'friend_onetime_membership' );
                                if ( $friend_onetime_membership ) { ?>
                                    <a href="<?php echo $friend_onetime_membership['url']; ?>" class="btn btn-block challenge-blockOne-buttonTop" target="<?php echo $friend_onetime_membership['target']; ?>"><?php echo $friend_onetime_membership['title']; ?></a>
                                <?php }
                                $friend_6_week_membership_subscription = get_sub_field( 'friend_6_week_membership_subscription' );
                                if ( $friend_6_week_membership_subscription ) { ?>
                                    <a href="<?php echo $friend_6_week_membership_subscription['url']; ?>" class="btn btn-block challenge-blockOne-buttonBottom" target="<?php echo $friend_6_week_membership_subscription['target']; ?>"><?php echo $friend_6_week_membership_subscription['title']; ?></a>
                                <?php }
                            endwhile;
                        endif;
                    }else{
                        ?>
                        <p class="challenge-blockOne-message">This Memberships is not available at this time. Memberships go on sale: <strong><?php echo (date('F d, Y', strtotime($membershipSale_start_date)) . ' - ' . date('F d, Y', strtotime($membershipSale_end_date))) ?></strong></p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid challenge-blockTwo-container">
    <div class="container" align="center">
        <h3 class="challenge-blockTwo-heading">Already have a Membership?</h3>
        <a href="https://perfectlyplated.com/my-account/">
            <button class="btn btn-lg challenge-blockTwo-button">Sign-in Here</button>
        </a>
    </div>
</div>
<div class="container-fluid challenge-blockThree-container">
    <div class="container" align="center">
        <h3 class="challenge-blockThree-heading">Order Your Meals Here</h3>
        <p></p>
        <div class="row justify-content-center display-flex">
            <?php
            if($available == 1){
                foreach($mainArray as $catname=>$allproducts){
                    foreach($allproducts as $oneproduct){
                        $ProID = $oneproduct->get_id();
                        $ProName = $oneproduct->get_name();
                        ?>
                        <div class="col-md-4 " align="center">
                            <div class="challenge-blockThree-prodContainers featured-fix">
                                <a href="<?php echo get_permalink($ProID); ?>">
                                    <h6 class="challenge-blockThree-prodHeading"><?php echo $ProName; ?></h6>
                                </a>
                                <a href="<?php echo get_permalink($ProID); ?>" class="btn btn-lg challenge-blockThree-prodButtons">View Meals</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }else{
                ?>
                <div class="" align="center">
                    <p class="challenge-blockThree-bodyText">Looks like you missed our deadline for ordering.
                        <?php if ($nextmealplandates != ''){ ?>
                            The next meal plan will be available: <?php echo $nextmealplandates ?>
                            <?php
                        } ?>
                    </p>
                    <p class="challenge-blockThree-bodyText">Sign up below to get notified when our meals are ready for ordering!</p>
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <div id="mc_embed_signup" class="menu-blockThree-mc_embed_signup">
                        <form action="https://perfectlyplated.us20.list-manage.com/subscribe/post?u=2661314f53ad87d9277c83d7a&amp;id=55cb8e4b09" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="novalidate">
                            <div id="mc_embed_signup_scroll"><div class="mc-field-group">
                                    <label for="mce-EMAIL">Email Address </label>
                                    <input type="email" value="" name="EMAIL" class="required email menu-blockThree-inputFields" id="mce-EMAIL" aria-required="true">
                                </div>
                                <div id="mce-responses" class="clear"><div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    <input type="text" name="b_2661314f53ad87d9277c83d7a_55cb8e4b09" tabindex="-1" value="">
                                </div>
                                <div class="clear">
                                    <input type="submit" value="Signup!" name="subscribe" id="mc-embedded-subscribe" class="button menu-blockThree-submitButton"></div>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                    <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
get_footer();

?>
