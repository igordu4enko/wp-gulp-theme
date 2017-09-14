<?php
/*
Template Name: Main page
*/
global $webshowcase;
get_header(); ?>

<header class="main-head parallax" style="background-image: url(
<?php if( !empty($webshowcase['banner_image']) ) echo $webshowcase['banner_image']['url'];?>
    )">

    <div class="top-wrapper">
        <h1 id="type-name"></h1>
    </div>

</header>

<section id="about" class="about bg-light" style="background: url(<?php if( !empty($webshowcase['about_section_bg']) ) echo $webshowcase['about_section_bg']['url'];?>);">

    <div class="section-header" data-aos="fade-up">
        <h2><?php if( !empty($webshowcase['about_section_title']) ) echo $webshowcase['about_section_title'];?></h2>
        <div class="section-descr-wrap">
            <div class="section-descr">
	            <?php if( !empty($webshowcase['about_section_subtitle']) ) echo $webshowcase['about_section_subtitle'];?>
            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-push-4" data-aos="fade-up" data-aos-delay="300">
                    <h3><?php echo get_bloginfo('name'); ?></h3>
                    <div class="person">
                        <a data-fancybox href="<?php if( !empty($webshowcase['about_your_photo']) ) echo $webshowcase['about_your_photo']['url'];?>">
                            <img src="<?php if( !empty($webshowcase['about_your_photo']) ) echo $webshowcase['about_your_photo']['url'];?>">
                        </a>
                    </div>
                </div>

                <div class="col-sm-4 col-sm-pull-4" data-aos="fade-up" data-aos-delay="150">
                    <h3><?php if( !empty($webshowcase['about_intro_title']) ) echo $webshowcase['about_intro_title'];?></h3>
	                <?php if( !empty($webshowcase['about_intro_cont']) ) echo $webshowcase['about_intro_cont'];?>
                </div>

                <div class="col-sm-4" data-aos="fade-up" data-aos-delay="450">
                    <div class="personal-last-block">
                        <h2 class="personal-header"><?php if( !empty($webshowcase['about_resume_title']) ) echo $webshowcase['about_resume_title'];?></h2>
                        <?php if( !empty($webshowcase['about_short_resume']) ) echo $webshowcase['about_short_resume'];?>

                        <a target="_blank" href="<?php if( !empty($webshowcase['about_cv_download']) ) echo $webshowcase['about_cv_download']['url'];?>" class="ac download-btn btn-main button ripplelink">
                            <?php if( !empty($webshowcase['about_cv_button_text']) ) echo $webshowcase['about_cv_button_text'];?>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section id="resume" class="resume" style="background: url(<?php if( !empty($webshowcase['skills_section_bg']) ) echo $webshowcase['skills_section_bg']['url'];?>);">

    <div class="section-header" data-aos="fade-up">
        <h2><?php if( !empty($webshowcase['skills_section_title']) ) echo $webshowcase['skills_section_title'];?></h2>
        <div class="section-descr-wrap">
            <div class="section-descr">
	            <?php if( !empty($webshowcase['skills_section_subtitle']) ) echo $webshowcase['skills_section_subtitle'];?>
            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="container">
            <div class="row resume-container">

                <?php
                $custom_query_args = array(
                    'post_type' => 'skill-item',
                    'order' => 'DESC',
                    'orderby' => 'date',
                );
                $custom_query = new WP_Query($custom_query_args);
                if ($custom_query->have_posts()) :
                    while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

                        <div class="skill-item resume-col col-sm-6 col-xs-12">
                            <div data-aos="fade-up" data-aos-delay="100" class="skill-icon">
                                <img src="<?php echo get_field('icon'); ?>" alt="<?php the_title(); ?>">
                            </div>

                            <div data-aos="fade-up" data-aos-delay="200" class="skill-body">
                                <h3><?php the_title(); ?></h3>
                                <h4><?php echo get_field('subtitle'); ?></h4>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>

                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); endif; ?>

            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="portfolio bg-dark"
         style="background: url(<?php if( !empty($webshowcase['portfolio_section_bg']) ) echo $webshowcase['portfolio_section_bg']['url'];?>);">

    <div class="section-header" data-aos="fade-up">
        <h2><?php if( !empty($webshowcase['portfolio_section_title']) ) echo $webshowcase['portfolio_section_title'];?></h2>
        <div class="section-descr-wrap">
            <div class="section-descr">
	            <?php if( !empty($webshowcase['portfolio_section_subtitle']) ) echo $webshowcase['portfolio_section_subtitle'];?>
            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="container">
            <div class="row">

                <div class="filter-div controls">
                    <ul>
                        <li class="filter ripplelink" data-filter="all">All</li>
	                    <?php $i = 0;
                        $terms = get_terms( 'category' );
	                    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	                    foreach ( $terms as $term ) {  ?>
                        <li data-aos="fade-up" data-aos-delay="<?php echo $i += 150 ; ?>" class="btn-main filter ripplelink"
                            data-filter=".<?php echo $term->slug ; ?>"><?php echo $term->name; ?></li>
                        <?php } }; ?>

                    </ul>
                </div>

                <div id="portfolio-grid">

                    <?php
                    $custom_query_args = array(
                        'post_type' => 'portfolio-item',
                        'order' => 'DESC',
                        'orderby' => 'date'
                    );
                    $custom_query = new WP_Query($custom_query_args);
                    if ($custom_query->have_posts()) :
                        while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

                            <div class="mix col-xs-12 col-sm-6 portfolio-item
                            <?php $terms = get_the_terms( $post->ID , 'category' );
                            foreach ( $terms as $term ) {
	                            echo $term->slug . ' ';
                            } ?>">
                                <div class="portfolio-item_inner"
                                     style="background: url(<?php echo get_field('image'); ?>) center 25px no-repeat; background-size: cover;">
                                    <div class="item-header">
                                        <span></span><span></span><span></span>
                                        <h3 class="item-header_text"><?php the_title(); ?></h3>
                                    </div>
                                    <div class="item-container">
                                        <div class="tags-list">

	                                        <?php foreach((get_the_category()) as $category) { ?>
		                                        <span class="tag"><?php echo $category->cat_name; ?></span>
	                                        <?php } ; ?>

                                        </div>
                                        <a class="btn btn-main ripplelink" data-fancybox
                                           data-src="<?php echo "#" . get_field('unique_id'); ?>"
                                           href="javascript:;">show</a>
                                    </div>

                                    <div class="modal-box" id="<?php echo get_field('unique_id'); ?>">
                                        <div class="item-header">
                                            <span></span><span></span><span></span>
                                        </div>
                                        <div class="project-descr">
                                            <div class="modal-box-content">
                                                <h3 class="main_color"><?php the_title(); ?></h3>
                                                <span class="project-date">Released: <?php echo get_the_date('F Y'); ?></span>
                                                <?php the_content(); ?>
                                                <div class="modal-box_image">
                                                    <img src="<?php echo get_field('image'); ?>"
                                                         alt="<?php echo get_field('name'); ?>">
                                                </div>
                                                <a class="btn btn-main ripplelink"
                                                   href="<?php echo get_field('link'); ?>"
                                                   target="_blank"><i class="fa fa-external-link"
                                                                      aria-hidden="true"></i> view site</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacts" class="contacts" style="background: url(<?php if( !empty($webshowcase['contact_section_bg']) ) echo $webshowcase['contact_section_bg']['url'];?>);">

    <div class="section-header" data-aos="fade-up">
        <h2><?php if( !empty($webshowcase['contact_section_title']) ) echo $webshowcase['contact_section_title'];?></h2>
        <div class="section-descr-wrap">
            <div class="section-descr">
	            <?php if( !empty($webshowcase['contact_section_subtitle']) ) echo $webshowcase['contact_section_subtitle'];?>
            </div>
        </div>
    </div>

    <div class="section-content">
        <div class="container">
            <div class="row">

                <div class="col-sm-8" data-aos="fade-up" data-aos-delay="150">

                    <div id="map"></div>

                </div>

                <div class="col-sm-4" data-aos="fade-up" data-aos-delay="300">

                    <h2 class="contact-info_title"><?php echo get_bloginfo('name'); ?></h2>
                    <p class="contact-info_inner"><?php if( !empty($webshowcase['contact_section_info_subtitle']) ) echo $webshowcase['contact_section_info_subtitle']; ?></p>

                    <div class="contact-box">
                        <h3><?php if( !empty($webshowcase['contact_phones_title']) ) echo $webshowcase['contact_phones_title']; ?></h3>
                        <p>

	                        <?php $phone_numbers = $webshowcase['phone_numbers'];
	                        if ( ! empty( $phone_numbers ) ) { ?>
		                        <?php foreach ( $phone_numbers as $key => $value ) { ?>
                                    <a href="tel:<?php if ( ! empty( $value['phone_num'] ) ) {echo $value['phone_num'];} ?>">
                                        <?php if ( ! empty( $value['phone_num'] ) ) {echo $value['phone_num'];} ?></a><br>
		                        <?php } ?>
	                        <?php } ?>

                        </p>
                    </div>

                    <div class="contact-box">
                        <h3><?php if( !empty($webshowcase['contact_emails_title']) ) echo $webshowcase['contact_emails_title']; ?></h3>
                        <p>

		                    <?php $email_addresses = $webshowcase['email_addresses'];
		                    if ( ! empty( $email_addresses ) ) { ?>
			                    <?php foreach ( $email_addresses as $key => $value ) { ?>
                                    <a href="mailto:<?php if ( ! empty( $value['email_addr'] ) ) {echo $value['email_addr'];} ?>">
					                    <?php if ( ! empty( $value['email_addr'] ) ) {echo $value['email_addr'];} ?></a><br>
			                    <?php } ?>
		                    <?php } ?>

                        </p>
                    </div>

	                <?php $other_contacts = $webshowcase['other_contacts'];
	                if ( ! empty( $other_contacts ) ) { ?>
		                <?php foreach ( $other_contacts as $key => $value ) { ?>
                    <div class="contact-box">

                        <h3><?php if ( ! empty( $value['other_contact_title'] ) ) {echo $value['other_contact_title'];} ?></h3>
                        <p>
                            <span><?php if ( ! empty( $value['other_contact_content'] ) ) {echo $value['other_contact_content'];} ?></span>
                        </p>

                    </div>
		                <?php } ?>
	                <?php } ?>
                </div>

            </div>


        </div>
    </div>
</section>

<?php get_footer(); ?>



