<?php
/**
 * WIDGET: Related Posts
 */

if( ! class_exists( 'NG_Related_Posts' ) ) {

    class NG_Related_Posts extends WP_Widget {

        /**
         * Sets up the widgets name etc
        */
        public function __construct() {
            $widget_ops = array(
                'classname' => 'ng_related_posts',
                'description' => __( 'Related Posts - (sdi)' ),
            );
            parent::__construct( 'ng_related_posts', __( 'Related Posts - (sdi)' ), $widget_ops );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {
            // outputs the content of the widget
            if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
            }

            // widget ID with prefix for use in ACF API functions
            $widget_id = 'widget_' . $args['widget_id'];
            $title = __get_field( 'title', $widget_id ) ? __get_field( 'title', $widget_id ) : '';
            $posts_number = __get_field( 'posts_number', $widget_id ) ? (int) __get_field( 'posts_number', $widget_id ) : 3;

            echo $args['before_widget'];

            if ( $title ) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }

            $_posts = ng_get_posts( [
                'numberposts' => $posts_number
            ] );
            if( count( $_posts ) > 0  ) {
                echo '<ul class="post-list">';
                foreach( $_posts as $index => $p ) {
                ?>
                <li class="post-item">
                    <a href="<?= get_the_permalink( $p->ID ) ?>" class="post-thumb">
                        <?= get_the_post_thumbnail( $p->ID, 'medium' ) ?>
                    </a>
                    <div class="post-entry">
                        <div class="post-meta">
                            <div class="post-date"><?= get_the_date( '', $p->ID ) ?></div>
                            <a href="<?= get_the_permalink( $p->ID ) ?>" class="readmore">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <path d="M511.189,259.954c1.649-3.989,0.731-8.579-2.325-11.627l-192-192 c-4.237-4.093-10.99-3.975-15.083,0.262c-3.992,4.134-3.992,10.687,0,14.82l173.803,173.803H10.667 C4.776,245.213,0,249.989,0,255.88c0,5.891,4.776,10.667,10.667,10.667h464.917L301.803,440.328 c-4.237,4.093-4.355,10.845-0.262,15.083c4.093,4.237,10.845,4.354,15.083,0.262c0.089-0.086,0.176-0.173,0.262-0.262l192-192 C509.872,262.42,510.655,261.246,511.189,259.954z"/> <path d="M309.333,458.546c-5.891,0.011-10.675-4.757-10.686-10.648c-0.005-2.84,1.123-5.565,3.134-7.571L486.251,255.88 L301.781,71.432c-4.093-4.237-3.975-10.99,0.262-15.083c4.134-3.992,10.687-3.992,14.82,0l192,192 c4.164,4.165,4.164,10.917,0,15.083l-192,192C314.865,457.426,312.157,458.546,309.333,458.546z"/> <path d="M501.333,266.546H10.667C4.776,266.546,0,261.771,0,255.88c0-5.891,4.776-10.667,10.667-10.667h490.667 c5.891,0,10.667,4.776,10.667,10.667C512,261.771,507.224,266.546,501.333,266.546z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                            </a>
                        </div>
                        <h4 class="post-title"><a href="<?= get_the_permalink( $p->ID ) ?>"><?= $p->post_title ?></a></h4>
                    </div>
                </li>
                <?php
                }
                echo '</ul>';
            }
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance ) {
            // outputs the options form on admin
        }

        /**
         * Processing widget options on save
         *
         * @param array $new_instance The new options
         * @param array $old_instance The previous options
         *
         * @return array
         */
        public function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
        }

    }
}

/**
 * Register our CTA Widget
 */
add_action( 'widgets_init', function() {
    register_widget( 'NG_Related_Posts' );
} );

/**
 * ACF Options
 */
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5f238c385bbba',
        'title' => 'Widget: Related Posts Settings',
        'fields' => array(
            array(
                'key' => 'field_5f238c5b8cdc0',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Other News',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5f238c848cdc1',
                'label' => 'Posts Number',
                'name' => 'posts_number',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 3,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'widget',
                    'operator' => '==',
                    'value' => 'ng_related_posts',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;
