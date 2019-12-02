<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Meteorite
 */
?>

</div><!-- .row -->
</div><!-- .container -->
</div><!-- #content -->

<?php do_action( 'meteorite_before_footer' );

?>

<div class="footer-area">

    <?php meteorite_footer_sidebar(); ?>

    <a class="scroll-to-top" href="#"><span class="upbutton"><i class="fa fa-angle-up"></i></span></a>

    <footer id="colophon" class="site-footer footer" role="contentinfo">
        <div class="container" align="center">

            <img src="https://perfectlyplated.com/wp-content/uploads/2019/03/Capture.png" class="footer-logo">

<!--            <ul class="nav justify-content-center">-->
<!--                <li class="nav-item footer-nav">-->
<!--                    <a class="nav-link footer-nav" href="https://perfectlyplated.com/">Home</a>-->
<!--                </li>-->
<!--                <li class="nav-item footer-nav">-->
<!--                    <a class="nav-link footer-nav" href="https://perfectlyplated.com/meal-plans/">Meal Plans</a>-->
<!--                </li>-->
<!--                <li class="nav-item footer-nav">-->
<!--                    <a class="nav-link footer-nav" href="https://perfectlyplated.com/my-account/">My Account</a>-->
<!--                </li>-->
<!--                <li class="nav-item footer-nav">-->
<!--                    <a class="nav-link footer-nav" href="https://perfectlyplated.com/cart/">Cart</a>-->
<!--                </li>-->
<!--            </ul>-->

            <p class="footer-credit"><i class="far fa-copyright"></i> <?php echo date("Y") ?> Perfectly Plated</p>

        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- .footer-area -->

<?php do_action( 'meteorite_after_footer' ); ?>

</div><!-- #page -->

<?php

wp_footer();

include get_stylesheet_directory() . '/parts/thanksgiving-menu.php';

?>

</body>
</html>
