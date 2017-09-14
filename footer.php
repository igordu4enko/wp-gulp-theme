<?php global $webshowcase; ?>

<footer class="main-footer bg-dark" style="background: url(<?php if( !empty($webshowcase['footer_background']) ) echo $webshowcase['footer_background']['url'];?>);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <span>&copy; <?php echo date('Y'); ?> <a href="<?php if( !empty($webshowcase['footer_blog_link']) ) echo $webshowcase['footer_blog_link'];?>"><?php echo get_bloginfo('name'); ?></a></span>
                <div class="social-wrap">
                    <ul>

                        <?php $social_links = $webshowcase['blog_social_links'];
                        if ( ! empty( $social_links ) ) { ?>
                            <?php foreach ( $social_links as $key => $value ) { ?>

                                <li class="soc-icon">
                                    <a href=" <?php if ( ! empty( $value['social_link'] ) ) {echo $value['social_link'];} ?>" class="tooltips" target="_blank"
                                       title=" <?php if ( ! empty( $value['social_name'] ) ) {echo $value['social_name'];} ?>"><i
                                                class="fa <?php if ( ! empty( $value['social_icon'] ) ) {echo $value['social_icon'];} ?>"></i></a>
                                </li>

                            <?php } ?>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>

    $(document).ready(function () {
        setTimeout(function typeit() {
            $("#type-name").typeIt({
                strings: [
                    <?php $banner_phrases = $webshowcase['header_banner_phrases'];
                    if ( ! empty( $banner_phrases ) ) { ?>
                    <?php foreach ( $banner_phrases as $key => $value ) { ?>
                    "<?php if ( ! empty( $value['header_banner_phrase'] ) ) {echo $value['header_banner_phrase'];} ?>",
                    <?php } ?>
                    <?php } ?>],
                speed: 200,
                loop: true,
                loopDelay: 2000,
                autoStart: false,
                lifeLike: true,
                breakLines: false,
                deleteDelay: 1000
            });
        }, 1100);
    });

    function initMap() {
        var lviv = {lat: <?php if( !empty($webshowcase['gmap_latitude']) ) echo $webshowcase['gmap_latitude'];?>,
            lng: <?php if( !empty($webshowcase['gmap_longitude']) ) echo $webshowcase['gmap_longitude'];?>};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: <?php if( !empty($webshowcase['gmap_zoom']) ) echo $webshowcase['gmap_zoom'];?>,
            center: lviv,
            gestureHandling: "cooperative",
            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true,
            streetViewControl: true,
            styles: <?php if( !empty($webshowcase['gmap_style']) ) echo $webshowcase['gmap_style'];?>
        });
        var marker = new google.maps.Marker({
            position: lviv,
            map: map,
            icon: "<?php if( !empty($webshowcase['gmap_icon']) ) echo $webshowcase['gmap_icon']['url'];?>"
        });
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php if( !empty($webshowcase['gmap_api_key']) ) echo $webshowcase['gmap_api_key'];?>&callback=initMap">
</script>

</body>
</html>
