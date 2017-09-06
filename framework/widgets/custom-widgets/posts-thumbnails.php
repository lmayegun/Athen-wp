<?php
/**
 * Description  : Class for generating recent recent post with thumbnail - widget.
 * 
 * @package     Athen
 * @subpackage  Closer - View/controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start class
class Athen_Recent_Posts_Thumb extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {

        parent::__construct(
            'athen_recent_posts_thumb',
            ATHEN_NAME_THEME . '-' . __( 'Posts With Thumbnails', 'athen_transl' ),
            array( 'description' => __( 'Shows a listing of your recent or random posts with their thumbnail for any chosen post type.', 'athen_transl' ) )
        );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget( $args, $instance ) {

        // Set vars
        $title      = ( isset( $instance['title'] ) ) ? apply_filters( 'widget_title', $instance['title'] ) : __( 'Recent Posts', 'athen_transl' );
        $number     = ( isset( $instance['number'] ) ) ? $instance['number'] : '3';
        $style      = ( isset( $instance['style'] ) ) ? $instance['style'] : 'default';
        $order      = ( isset( $instance['order'] ) ) ? $instance['order'] : '';
        $post_meta  = ( isset( $instance['date'] ) ) ? $instance['date'] : '';
        $post_type  = isset( $instance['post_type'] ) ? $instance['post_type'] : '';
        $taxonomy   = isset( $instance['taxonomy'] ) ? $instance['taxonomy'] : '';
        $terms      = isset( $instance['terms'] ) ? $instance['terms'] : '';
        $img_hover  = isset( $instance['img_hover'] ) ? $instance['img_hover'] : '';
        $img_size   = isset( $instance['img_size'] ) ? $instance['img_size'] : 'athen_custom';
        $img_height = ( !empty( $instance['img_height'] ) ) ? intval( $instance['img_height'] ) : '';
        $img_width  = ( !empty( $instance['img_width'] ) ) ? intval( $instance['img_width'] ) : '';
        $img_size   = ( $img_width || $img_height ) ? 'athen_custom' : $img_size;
        $exclude    = ( is_singular() ) ? array( get_the_ID() ) : NULL;

        // Sanitize terms
        if ( $terms ) {
            $terms = str_replace( ', ', ',', $terms );
            $terms = explode( ',', $terms );
        }

        // Before widget WP hook
        echo $args['before_widget'];

        // Display title if defined
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title']; 
        } ?>

        <ul class="athen-widget-recent-posts-thumb clr style-<?php echo $style; ?>">

            <?php
            // Query args
            $query_args = array(
                'post_type'         => $post_type,
                'posts_per_page'    => $number,
                'orderby'           => $order,
                'post__not_in'      => $exclude,
                'meta_key'          => '_thumbnail_id',
                'no_found_rows'     => true,
            );

            // Taxonomy args
            if ( ! empty( $taxonomy ) && ! empty( $terms ) ) {
                $query_args['tax_query']  = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $terms,
                    ),
                );
            }

            // Query posts
            $my_query = new WP_Query( $query_args );

            // If there are posts loop through them
            if ( $my_query->have_posts() ) :

                // Loop through posts
                while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                
                    <?php
                    // Get post thumbnail
                    $thumbnail = athen_get_post_thumbnail( array(
                        'size'      => $img_size,
                        'width'     => $img_width,
                        'height'    => $img_height,
                        'alt'       => athen_get_esc_title(),
                    ) ); ?>

                    <?php
                    // Get hover classes
                    if ( $img_hover ) {
                        $hover_classes = ' '. athen_image_hover_classes( $img_hover );
                    } else {
                        $hover_classes = '';
                    } ?>

                    <li class="clearfix athen-widget-recent-thumb-li">

                        <?php if ( $thumbnail ) : ?>
                            <a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="img-thumb<?php echo $hover_classes; ?>"><?php echo $thumbnail; ?></a>
                        <?php endif; ?>

                        <a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="post-title"><?php the_title(); ?></a>
                            
                        <?php
                        // Display date if enabled
                        if ( '1' == $post_meta ) : ?>

                            <div class="post-date">
                                <?php echo get_the_date(); ?> <span>by</span> <?php echo get_the_author(); ?>
                                <div> 
                                <?php athen_list_post_terms('category', true, true ) ?>
                                </div>
                            </div><!-- .wpex-widget-recent-posts-date -->

                        <?php endif; ?>
                        
                            
                            
                         

                    </li><!-- .wpex-widget-recent-posts-li -->

                <?php endwhile; ?>

            <?php endif; ?>

        </ul><!-- .wpex-widget-recent-posts -->

        <?php wp_reset_postdata(); ?>
        
        <?php
        // After widget WordPress hook
        echo $args['after_widget'];
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    function update( $new_instance, $old_instance ) {

        $instance               = $old_instance;
        $instance['title']      = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_type']  = ( ! empty( $new_instance['post_type'] ) ) ? $new_instance['post_type'] : '';
        $instance['taxonomy']   = ( ! empty( $new_instance['taxonomy'] ) ) ? $new_instance['taxonomy'] : '';
        $instance['terms']      = ( ! empty( $new_instance['terms'] ) ) ?  strip_tags( $new_instance['terms'] ) : '';
        $instance['number']     = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['order']      = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
        $instance['style']      = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
        $instance['img_hover']  = ( ! empty( $new_instance['img_hover'] ) ) ? $new_instance['img_hover'] : '';
        $instance['img_size']   = ( ! empty( $new_instance['img_size'] ) ) ? $new_instance['img_size'] : 'athen_custom';
        $instance['img_height'] = ( ! empty( $new_instance['img_height'] ) ) ? intval( strip_tags( $new_instance['img_height'] ) ) : '';
        $instance['img_width']  = ( ! empty( $new_instance['img_width'] ) ) ? intval( strip_tags( $new_instance['img_width'] ) ) : '';
        $instance['post_meta']  = ( ! empty( $new_instance['post_meta'] ) ) ? strip_tags( $new_instance['post_meta'] ) : '';
        return $instance;

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
       
        $instance = wp_parse_args( ( array ) $instance, array(
            'title'         => __( 'Recent Posts', 'athen_transl' ),
            'number'        => '3',
            'style'         => 'default',
            'post_type'     => 'post',
            'taxonomy'      => '',
            'terms'         => '',
            'order'         => 'DESC',
            'columns'       => '3',
            'img_size'      => 'athen_custom',
            'img_hover'     => '',
            'img_width'     => '',
            'img_height'    => '',
            'post_meta'     => '',
        ) );

        // Sanitize vars
        $title      = esc_attr( $instance['title'] );
        $post_type  = esc_attr( $instance['post_type'] );
        $taxonomy   = esc_attr( $instance['taxonomy'] );
        $terms      = esc_attr( $instance['terms'] );
        $number     = esc_attr( $instance['number'] );
        $style      = esc_attr( $instance['style'] );
        $post_meta  = esc_attr( $instance['post_meta'] );
        $img_hover  = esc_attr( $instance['img_hover'] );
        $img_size   = esc_attr( $instance['img_size'] );
        $img_width  = esc_attr( $instance['img_width'] );
        $img_height = esc_attr( $instance['img_height'] );
        $order      = esc_attr( $instance['order'] ); 
        
        ?>

        <?php /* Title */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'athen_transl' ); ?></label> 
            <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <?php /* Style */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style', 'athen_transl' ); ?></label>
            <br />
            <select class='wpex-select' name="<?php echo $this->get_field_name( 'style' ); ?>">
                <option value="default" <?php selected( $style, 'default', true ); ?>><?php _e( 'Small Image', 'athen_transl' ); ?></option>
                <option value="fullimg" <?php selected( $style, 'fullimg', true ); ?>><?php _e( 'Full Image', 'athen_transl' ); ?></option>
            </select>
        </p>
        
        <?php /* Post Type */ ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type', 'athen_transl' ); ?></label>
        <br />
        <select class='wpex-select' name="<?php echo $this->get_field_name( 'post_type' ); ?>" style="width:100%;">
            <option value="post" <?php if ( $post_type == 'post' ) { ?>selected="selected"<?php } ?>><?php _e( 'Post', 'athen_transl' ); ?></option>
            <?php
            // Get Post Types
            $args = array(
                'public'                => true,
                '_builtin'              => false,
                'exclude_from_search'   => false
            );
            $output = 'names';
            $operator = 'and';
            $get_post_types = get_post_types( $args, $output, $operator );
            foreach ( $get_post_types as $get_post_type ) : ?>
                <?php if ( $get_post_type != 'post' ) { ?>
                    <option value="<?php echo $get_post_type; ?>" <?php if ( $post_type == $get_post_type ) { ?>selected="selected"<?php } ?>><?php echo ucfirst( $get_post_type ); ?></option>
                <?php } ?>
            <?php endforeach; ?>
        </select>
        </p>

        <?php /* Taxonomy */ ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Query By Taxonomy', 'athen_transl' ); ?></label>
        <br />
        <select class='wpex-select' name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" style="width:100%;">
            <option value="post" <?php if ( ! $taxonomy ) { ?>selected="selected"<?php } ?>><?php _e( 'No', 'athen_transl' ); ?></option>
            <?php
            // Get Taxonomies
            $get_taxonomies = get_taxonomies( array(
                'public' => true,
            ), 'objects' ); ?>
            <?php foreach ( $get_taxonomies as $get_taxonomy ) : ?>
                <option value="<?php echo $get_taxonomy->name; ?>" <?php if ( $get_taxonomy->name == $taxonomy ) { ?>selected="selected"<?php } ?>><?php echo ucfirst( $get_taxonomy->labels->singular_name ); ?></option>
            <?php endforeach; ?>
        </select>
        </p>

        <?php /* Terms */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'terms' ); ?>"><?php _e( 'Terms', 'athen_transl' ); ?></label>
            <br />
            <input class="widefat" name="<?php echo $this->get_field_name( 'terms' ); ?>" type="text" value="<?php echo $terms; ?>" />
            <small><?php _e( 'Enter the term slugs to query by seperated by a "comma"', 'athen_transl' ); ?></small>
        </p>
        
        <?php /* Order */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'athen_transl' ); ?></label>
            <br />
            <select class='wpex-select' name="<?php echo $this->get_field_name( 'order' ); ?>">
                <option value="DESC" <?php selected( $order, 'DESC', true ); ?>><?php _e( 'Recent', 'athen_transl' ); ?></option>
                <option value="rand" <?php selected( $order, 'rand', true ); ?>><?php _e( 'Random', 'athen_transl' ); ?></option>
                <option value="comment_count" <?php selected( $order, 'comment_count', true ); ?>><?php _e( 'Most Comments', 'athen_transl' ); ?></option>
                <option value="modified" <?php selected( $order, 'modified', true ); ?>><?php _e( 'Last Modified', 'athen_transl' ); ?></option>
            </select>
        </p>
        
        <?php /* Number */ ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number', 'athen_transl' ); ?></label> 
            <input class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
        </p>

        <?php /* Image Hover Animation */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'img_hover' ); ?>"><?php _e( 'Image Hover', 'athen_transl' ); ?></label>
            <br />
            <select class='wpex-select' name="<?php echo $this->get_field_name( 'img_hover' ); ?>" style="width:100%;">
                <?php
                // Get image sizes
                $hovers = athen_image_hovers();
                // Loop through hovers and add options
                foreach ( $hovers as $key => $val ) { ?>
                    <option value="<?php echo $key; ?>" <?php if ( $img_hover == $key ) { ?>selected="selected"<?php } ?>><?php echo $val; ?></option>
                <?php } ?>
                
            </select>
        </p>

        <?php /* Image Size */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'img_size' ); ?>"><?php _e( 'Image Size', 'athen_transl' ); ?></label>
            <br />
            <select class='wpex-select' name="<?php echo $this->get_field_name( 'img_size' ); ?>" style="width:100%;">
            <option value="athen_custom" <?php if ( $img_size == 'athen_custom' ) { ?>selected="selected"<?php } ?>><?php _e( 'Custom', 'athen_transl' ); ?></option>
                <?php
                // Get image sizes
                $get_img_sizes = athen_get_thumbnail_sizes(); ?>

                <?php foreach ( $get_img_sizes as $key => $val ) { ?>
                    <option value="<?php echo $key; ?>" <?php if ( $img_size == $key ) { ?>selected="selected"<?php } ?>><?php echo $key; ?></option>
                <?php } ?>
                
            </select>
        </p>

        <?php /* Image Width */ ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'img_width' ); ?>"><?php _e( 'Image Crop Width', 'athen_transl' ); ?></label> 
            <input class="widefat" name="<?php echo $this->get_field_name( 'img_width' ); ?>" type="text" value="<?php echo $img_width; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'img_height' ); ?>"><?php _e( 'Image Crop Height', 'athen_transl' ); ?></label> 
            <input class="widefat" name="<?php echo $this->get_field_name( 'img_height' ); ?>" type="text" value="<?php echo $img_height; ?>" />
        </p>

        <?php /* Date */ ?>
        <p>
            <input name="<?php echo $this->get_field_name( 'post_meta' ); ?>" type="checkbox" value="1" <?php echo $checked = $post_meta ? 'checked' : ''; ?> />
            <label for="<?php echo $this->get_field_id( 'post_meta' ); ?>"><?php _e( 'Enable Post Meta', 'athen_transl' ); ?></label>
        </p>

    <?php
    }

}

// Register the custom widget
function athen_register_recent_posts_thumb_widget() {
    register_widget( 'Athen_Recent_Posts_Thumb' );
}
add_action( 'widgets_init', 'athen_register_recent_posts_thumb_widget' ); ?>