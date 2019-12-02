<?php
/*
Template Name: Menu Page
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

$menulist = array(
    array( 'week-1',$week1_start_date, $week1_end_date ),
    array( 'week-2',$week2_start_date, $week2_end_date ),
    array( 'week-3',$week3_start_date, $week3_end_date ),
    array( 'week-4',$week4_start_date, $week4_end_date ),
    array( 'week-5',$week5_start_date, $week5_end_date ),
    array( 'week-6',$week6_start_date, $week6_end_date )
);
$currentDate = date('Y-m-d');
$menuCategory = '';
$MenuBeforeContent = '';
$MenuAfterContent = '';
if(!empty($menulist)){
    foreach($menulist as $ml){
        $DateBegin = date('Y-m-d', strtotime($ml[1]));
        $DateEnd = date('Y-m-d', strtotime($ml[2]));
        if (($currentDate >= $DateBegin) && ($currentDate <= $DateEnd)){
            $menuCategory = $ml[0];
            $MenuBeforeContent = $ml[3];
            $MenuAfterContent = $ml[4];
            break;
        }
    }
}

$args = array(
    'limit' => -1,
    'category' => array($menuCategory),
    'orderby' => 'title',
    'order' => 'ASC',
    'status' => 'publish',
) ;
$products = wc_get_products($args);

$available = 0;
$availableSunMon = 0;
$availableWed = 0;

if(!empty($products)){
    $mainArray = array(
        'Sun/Mon'=>array(
            'Breakfast'=>array(),
            'Lunch'=>array(),
            'Dinner'=>array(),
            'Kids Meals'=>array(),
            'Snack'=>array(),
            'Protein Box'=>array()
        ),
        'Wed'=>array(
            'Breakfast'=>array(),
            'Lunch'=>array(),
            'Dinner'=>array(),
            'Kids Meals'=>array(),
            'Snack'=>array(),
            'Protein Box'=>array()
        )
    );

    foreach($products as $product){

        $ProID = $product->get_id();
        $term_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
        if (in_array("Sun/Mon", $term_list)){
            if (in_array("Breakfast", $term_list)){
                $mainArray['Sun/Mon']['Breakfast'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
            if (in_array("Lunch", $term_list)){
                $mainArray['Sun/Mon']['Lunch'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
            if (in_array("Dinner", $term_list)){
                $mainArray['Sun/Mon']['Dinner'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
            if (in_array("Kids Meals", $term_list)){
                $mainArray['Sun/Mon']['Kids Meals'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
            if (in_array("Snack", $term_list)){
                $mainArray['Sun/Mon']['Snack'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
            if (in_array("Protein Box", $term_list)){
                $mainArray['Sun/Mon']['Protein Box'][]= $product;
                $available = 1;
                $availableSunMon = 1;
            }
        }
        if (in_array("Wed", $term_list)){

            if (in_array("Breakfast", $term_list)){
                $mainArray['Wed']['Breakfast'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
            if (in_array("Lunch", $term_list)){
                $mainArray['Wed']['Lunch'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
            if (in_array("Dinner", $term_list)){
                $mainArray['Wed']['Dinner'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
            if (in_array("Kids Meals", $term_list)){
                $mainArray['Wed']['Kids Meals'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
            if (in_array("Snack", $term_list)){
                $mainArray['Wed']['Snack'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
            if (in_array("Protein Box", $term_list)){
                $mainArray['Wed']['Protein Box'][]= $product;
                $available = 1;
                $availableWed = 1;
            }
        }
    }
}

$emptymenuimg = get_stylesheet_directory_uri().'/menu-icon-for-cstom-shop.png';
/***piyush code***/
?>
    <style>
        p{
            font-size: 16px !important;
        }
        table, tr, th, td{
            border: none !important;
        }
    </style>
    <div class="container-fluid">
        <div class="container menu-blockOne-container">
            <div align="center">
                <h1 class="menu-blockOne-heading">À La Carte Menu</h1>
                <hr class="menu-blockOne-hr"/>
                <br/>
                <p class="menu-blockOne-instructionsText">Select your desired meals below and checkout when done.</p>
                <p class="menu-blockOne-instructionsText">Our menu changes weekly, new menus are released each <strong>Monday at 12:01 a.m.</strong>. The deadline for ordering is each <strong>Wednesday at 11:59 p.m.</strong> Meals are then ready for pick-up or delivery the following week on Sunday, Monday, and Wednesday evenings.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container menu-blockTwo-container">
            <?php if($available == 1){ ?>
                <div class="row">
                    <br/>
                    <br/>
                    <br/>
                    <div class="col-md-6" style="padding-left:0px;padding-right:0px;">
                        <h2 class="menu-blockTwo-titles">
                            <?php echo 'Sunday & Monday'; ?>
                        </h2>
                        <hr class="menu-blockTwo-hrLines"/>
                        <table class="menu-blockTwo-table">
                            <tbody>
                            <?php

                            if($availableSunMon == 1){
                                foreach($mainArray['Sun/Mon']  as $catname=>$catpro){
                                    if(!empty($catpro)){
                                        foreach($catpro as $pro){
                                            $ProID = $pro->get_id();
                                            $ProName = $pro->get_name();
                                            $ProSdesc = $pro->get_short_description();
                                            $ProDesc = $pro->get_description();
                                            $price_html = $pro->get_price_html();
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $ProID ), 'single-post-thumbnail' );
                                            $dietterm_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
                                            $Dietcatname = array();
                                            if (in_array("Homestyle", $dietterm_list)){$Dietcatname[]= 'Homestyle';}
                                            if (in_array("Keto", $dietterm_list)){ $Dietcatname[]= 'Keto';}
                                            if (in_array("Paleo", $dietterm_list)){ $Dietcatname[]= 'Paleo';}
                                            if (in_array("Whole 30", $dietterm_list)){ $Dietcatname[]= 'Whole 30';}
                                            ?>
                                            <tr>
                                                <td style="width:30%;">
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <?php
                                                        if(!empty($image)){
                                                            ?>
                                                            <div class="menu-blockTwo-productImage z-depth-3" style="background-image: url('<?php  echo $image[0]; ?>'); ">
                                                            </div>
                                                            <!--                                                                <img src="--><?php // echo $image[0]; ?><!--" data-id="--><?php //echo $ProID; ?><!--" alt="thumbnail" class="z-depth-3"-->
                                                            <!--                                                                     style="width: 200px">-->
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="menu-blockTwo-productImage z-depth-3" style="background-image: url('<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?>'); ">
                                                            </div>
                                                            <!--                                                                <img src="--><?php //echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?><!--" class="wp-post-image" />-->
                                                            <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <h6 class="menu-blockTwo-productTitle"><?php echo $ProName; ?></h6>
                                                    </a>
                                                    <p class="menu-blockTwo-productShortDes"><?php echo strip_tags($ProSdesc); ?></p>
                                                    <p class="menu-blockTwo-productNutritionInfo"><?php echo strip_tags($ProDesc); ?></p>
                                                    <p class="menu-blockTwo-productCategory"><strong>Category : </strong><?php echo $catname; ?></p>
                                                    <?php if(!empty($Dietcatname)){ ?>
                                                        <p class="menu-blockTwo-productDietCategory"><strong>Diet : </strong><?php echo implode(', ',$Dietcatname); ?></p>
                                                    <?php } ?>
                                                    <a href="<?php echo get_permalink($ProID); ?>" class="button menu-blockTwo-productButton">view product</a>

                                                </td>
                                                <td style="width:20%;">
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <h6 class="menu-blockTwo-productPrice"><?php echo $price_html; ?></h6>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }else{
                                ?>
                                <tr>
                                    <td>
                                        <div align="center">
                                            <img src="<?php echo $emptymenuimg; ?>" />
                                            <h3>Not Availbale <br/>Menu For Sunday & Monday</h3>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 " style="padding-left:0px;padding-right:0px;">
                        <h2 class="menu-blockTwo-titles">
                            <?php echo 'Wednesday'; ?>
                        </h2>
                        <hr class="menu-blockTwo-hrLines"/>
                        <table class="menu-blockTwo-table">
                            <tbody>
                            <?php

                            if($availableWed == 1){
                                foreach($mainArray['Wed']  as $catname=>$catpro){
                                    if(!empty($catpro)){
                                        foreach($catpro as $pro){
                                            $ProID = $pro->get_id();
                                            $ProName = $pro->get_name();
                                            $ProSdesc = $pro->get_short_description();
                                            $ProDesc = $pro->get_description();
                                            $price_html = $pro->get_price_html();
                                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $ProID ), 'single-post-thumbnail' );
                                            $dietterm_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
                                            $Dietcatname = array();
                                            if (in_array("Homestyle", $dietterm_list)){$Dietcatname[]= 'Homestyle';}
                                            if (in_array("Keto", $dietterm_list)){ $Dietcatname[]= 'Keto';}
                                            if (in_array("Paleo", $dietterm_list)){ $Dietcatname[]= 'Paleo';}
                                            if (in_array("Whole 30", $dietterm_list)){ $Dietcatname[]= 'Whole 30';}
                                            ?>
                                            <tr>
                                                <td style="width:30%;">
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <?php
                                                        if(!empty($image)){
                                                            ?>
                                                            <div class="menu-blockTwo-productImage z-depth-3" style="background-image: url('<?php  echo $image[0]; ?>'); ">
                                                            </div>
                                                            <!--                                                                <img src="--><?php // echo $image[0]; ?><!--" data-id="--><?php //echo $ProID; ?><!--">-->
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <div class="menu-blockTwo-productImage z-depth-3" style="background-image: url('<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?>'); ">
                                                            </div>
                                                            <!--                                                                <img src="--><?php //echo esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ); ?><!--" class="wp-post-image" alt="thumbnail" class="img-thumbnail rounded"-->
                                                            <!--                                                                     style="width: 200px"/>-->
                                                            <?php
                                                        }
                                                        ?>

                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <h6 class="menu-blockTwo-productTitle"><?php echo $ProName; ?></h6>
                                                    </a>
                                                    <p class="menu-blockTwo-productShortDes"><?php echo strip_tags($ProSdesc); ?></p>
                                                    <p class="menu-blockTwo-productNutritionInfo"><?php echo strip_tags($ProDesc); ?></p>
                                                    <p class="menu-blockTwo-productCategory"><strong>Category : </strong><?php echo $catname; ?></p>
                                                    <?php if(!empty($Dietcatname)){ ?>
                                                        <p class="menu-blockTwo-productDietCategory"><strong>Diet : </strong><?php echo implode(', ',$Dietcatname); ?></p>
                                                    <?php } ?>
                                                    <a href="<?php echo get_permalink($ProID); ?>" class="button menu-blockTwo-productButton">view product</a>
                                                </td>
                                                <td style="width:20%;">
                                                    <a href="<?php echo get_permalink($ProID); ?>">
                                                        <h6 class="menu-blockTwo-productPrice"><?php echo $price_html; ?></h6>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                            }else{
                                ?>
                                <tr>
                                    <td>
                                        <div align="center">
                                            <img src="<?php echo $emptymenuimg; ?>" />
                                            <h3>Not Availbale <br/>Menu For Wednesday</h3>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 "><p><?php echo $MenuAfterContent; ?></p></div>
                </div>
            <?php }else{ ?>
                <div class="row justify-content-center">
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
                </div>
            <?php } ?>
        </div>

    </div><!-- #main -->

<div class="container-fluid menu-blockFour-container">
    <div class="container" align="center">
        <h3 class="menu-blockFour-heading">Ordering more then 10 meals? Click the button below to view meal plan options.</h3>
        <a href="https://perfectlyplated.com/meal-plans/">
            <button class="btn btn-large menu-blockFour-button">View Meal Plans</button>
        </a>
    </div>
</div>

<?php
get_footer();