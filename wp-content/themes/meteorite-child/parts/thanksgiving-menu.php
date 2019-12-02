<div class="modal fade" id="thanksgivingModal" tabindex="-1" role="dialog" aria-labelledby="thanksgivingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg popup-thanksgiving-container" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title popup-thanksgiving-heading" id="thanksgivingModalLabel"><?php the_field( 'heading', 'option' ); ?></h5>
                <button type="button" class="close popup-thanksgiving-topclose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php $image_one = get_field( 'image_one', 'option' ); ?>
                    <?php if ( $image_one ) { ?>
                        <img src="<?php echo $image_one['url']; ?>" alt="<?php echo $image_one['alt']; ?>" />
                    <?php } ?>

                    <?php $image_two = get_field( 'image_two', 'option' ); ?>
                    <?php if ( $image_two ) { ?>
                        <img src="<?php echo $image_two['url']; ?>" alt="<?php echo $image_two['alt']; ?>" />
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn popup-thanksgiving-closebtn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        if( $('#menu-item-5097').length ){
            if ( $('#menu-item-5097').attr('data-toggle') != 'modal' ) {
                $("#menu-item-5097").attr("data-toggle", "modal");
            }
            if ( $('#menu-item-5097').attr('data-target') != '#thanksgivingModal' ) {
                $("#menu-item-5097").attr("data-target", "#thanksgivingModal");
            }
        }
    });
</script>