<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Pages;
 
use \Inc\Base\Controller;

 class CPT extends Controller{

   public function register(){
    add_action('init', array($this, 'custom_post_type'));
    add_action( 'init', array($this, 'my_taxonomies_product'), 0);
    add_action( 'add_meta_boxes', array($this, 'product_price_box') );
    add_action( 'save_post', array($this, 'product_price_box_save') );
   }

   function custom_post_type(){
    $labels = array(
        'name'                  => __( 'Products', 'Post type general name', 'product_plugin' ),
        'singular_name'         => __( 'Product', 'Post type singular name', 'product_plugin' ),
        'menu_name'             => _x( 'Products', 'Admin Menu text', 'product_plugin' ),
        'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'product_plugin' ),
        'show_in_menu'    	    => __( 'edit.php?post_type=page'),
        'add_new'               => __( 'Add New', 'product_plugin' ),
        'add_new_item'          => __( 'Add New Product', 'product_plugin' ),
        'new_item'              => __( 'New Product', 'product_plugin' ),
        'edit_item'             => __( 'Edit Product', 'product_plugin' ),
        'view_item'             => __( 'View Product', 'product_plugin' ),
        'all_items'             => __( 'All Products', 'product_plugin' ),
        'search_items'          => __( 'Search Products', 'product_plugin' ),
        'parent_item_colon'     => __( 'Parent Products:', 'product_plugin' ),
        'not_found'             => __( 'No products found.', 'product_plugin' ),
        'not_found_in_trash'    => __( 'No products found in Trash.', 'product_plugin' ),
        'featured_image'        => _x( 'Product Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'product_plugin' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'product_plugin' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'product_plugin' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'product_plugin' ),
        'archives'              => _x( 'Product archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'product_plugin' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'product_plugin' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'product_plugin' ),
        'filter_items_list'     => __( 'Filter Announcement list', 'product_plugin' ),
        'filter_by_date'        => __( 'Filter by date', 'product_plugin' ),
        'items_list_navigation' => __( 'Announcements list navigation', 'product_plugin' ),
        'items_list'            => __( 'Announcements list', 'product_plugin' ),
        'item_published'        => __( 'Announcement published.', 'product_plugin' ),
        'item_published_privately' => __( 'Announcement published privately.', 'product_plugin' ),
        'item_reverted_to_draft' => __( 'Announcement reverted to draft.', 'product_plugin' ),
        'item_scheduled'        => __( 'Announcement scheduled.', 'product_plugin' ),
        'item_updated'          => __( 'Announcement updated.', 'product_plugin' ),
        'item_link'             => __( 'Announcement Link', 'product_plugin' ),
        'item_link_description' => __( 'A link to an announcement.', 'product_plugin' ),            
        'items_list'            => _x( 'Products list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'product_plugin' ),
    );
    $args = array(
        'labels'                => $labels,
        'description'           =>  'Holds our products and product specific data',
        'public'                => true,
        'menu_icon'             => 'dashicons-store',
        'has_archive'           => true,
        'public_queryable'      => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => false,
        'query_var'             => true,
        'rewrite'               => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array(
            'title',
            'editor',
            'author',
            'excerpt',
            'thumbnail',
            'comments',
            'revisions'
        ),
        'taxonomies'            => array('product', 'product_tag'),
        'menu_position'         => null,
        'exclude_from_search'   => false
    );
    register_post_type('product', $args);
    }
    function my_updated_messages( $messages ) {
        global $post, $post_ID;
        $messages['product'] = array(
          0 => '', 
          1 => sprintf( __('Product updated. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
          2 => __('Custom field updated.'),
          3 => __('Custom field deleted.'),
          4 => __('Product updated.'),
          5 => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
          6 => sprintf( __('Product published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
          7 => __('Product saved.'),
          8 => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
          9 => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
          10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
      }
      
      function my_contextual_help( $contextual_help, $screen_id, $screen ) { 
        if ( 'product' == $screen->id ) {
      
          $contextual_help = '<h2>Products</h2>
          <p>Products show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
          <p>You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
      
        } elseif ( 'edit-product' == $screen->id ) {
      
          $contextual_help = '<h2>Editing products</h2>
          <p>This page allows you to view/modify product details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';
      
        }
        return $contextual_help;
      }
    
      function my_taxonomies_product() {
        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
          'name'              => _x( 'Product Categories', 'taxonomy general name' ),
          'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
          'search_items'      => __( 'Search Product Categories' ),
          'all_items'         => __( 'All Product Categories' ),
          'parent_item'       => __( 'Parent Product Category' ),
          'parent_item_colon' => __( 'Parent Product Category:' ),
          'edit_item'         => __( 'Edit Product Category' ), 
          'update_item'       => __( 'Update Product Category' ),
          'add_new_item'      => __( 'Add New Product Category' ),
          'new_item_name'     => __( 'New Product Category' ),
          'menu_name'         => __( 'Product Categories' ),
        );
        $args = array(
          'labels'              => $labels,
          'rewrite'             => array('slug' => 'product_category'),
          'show_ui'             => true,
          'show_admin_column'   => true,
          'query_var'           => true,
          'hierarchical'        => true,
        );
        register_taxonomy( 'product_category', array('product'), $args );
    
        unset( $args );
        unset( $labels );
    
        // Add new taxonomy, NOT hierarchical (like tags)
        $labels = array(
            'name'                       => _x( 'Product Tags', 'taxonomy general name', 'product_plugin' ),
            'singular_name'              => _x( 'Product Tag', 'taxonomy singular name', 'product_plugin' ),
            'search_items'               => __( 'Search Product Tags', 'product_plugin' ),
            'popular_items'              => __( 'Popular Products Tags', 'product_plugin' ),
            'all_items'                  => __( 'All Products Tags', 'product_plugin' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Product Tag', 'product_plugin' ),
            'update_item'                => __( 'Update Product Tag', 'product_plugin' ),
            'add_new_item'               => __( 'Add New Product Tag', 'product_plugin' ),
            'new_item_name'              => __( 'New Product Tag Name', 'product_plugin' ),
            'separate_items_with_commas' => __( 'Separate product tags with commas', 'product_plugin' ),
            'add_or_remove_items'        => __( 'Add or remove product tags', 'product_plugin' ),
            'choose_from_most_used'      => __( 'Choose from the most used product tags', 'product_plugin' ),
            'not_found'                  => __( 'No product tags found.', 'product_plugin' ),
            'menu_name'                  => __( 'Product Tags', 'product_plugin' ),
        );
    
        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'product_tag' ),
        );
    
        register_taxonomy( 'product_tag', array('product'), $args );
    
      }

        /**
         * Adds the meta box container.
         */
        function product_price_box($post_type) {
            // Limit meta box to certain post types.
            $post_types = array('product');
            if(in_array($post_type, $post_types)){
            add_meta_box( 
                'product_price_box',
                __( 'Product Price', 'product_plugin' ),
                array($this, 'product_price_box_content'),
                $post_type,
                'side',
                'high'
            );
            }
        }

        /**
         * Render Meta Box content.
         */
        function product_price_box_content( $post ) {
            require_once $this->plugin_path. '/templates/form.php';
            }

        /**
         * Save the meta when the post is saved.
         */
        function product_price_box_save( $post_id ) {
        /*
        * We need to verify this came from the our screen and with proper authorization,
        * because save_post can be triggered at other times.
        */

        /*
        * If this is an autosave, our form has not been submitted,
        * so we don't want to do anything.
        */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
        

        if ( $parent_id = wp_is_post_revision( $post_id ) ) {
            $post_id = $parent_id;
        }

        /* OK, it's safe for us to save the data now. */
        $fields = [
        'published_date',
        'initial_price',
        'current_price',
        ];
        // Update the meta field.
        foreach($fields as $field){
            if(array_key_exists($field, $_POST)){
                update_post_meta( $post_id, $field, sanitize_text_field($_POST[$field]) );
            }
        }
        
        }
    /*-------------------------------------------------------------------------*/
    /*                        CUSTOM TERM FUNCTION                             */
    /*-------------------------------------------------------------------------*/

    // function init_custom_terms(){
    //     $term = self::custom_get_terms($postID, $term);
    //     return $term;
    // }

    function custom_get_terms($postID, $term){
      $terms_list = wp_get_post_terms($postID, $term);
      $output = ' ';
      $i=0;

      foreach($terms_list as $term){
          $i++;
          if($i>1){
              $output .= ', ';
          }
          $output .= '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
      }
      return $output;
    }
}