<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Pages;

 use \Inc\Base\Controller;
 
 class Admin extends Controller{

   public function register(){
      add_action('admin_menu', array($this, 'add_admin_pages'));

   }
   public function add_admin_pages(){
      add_menu_page('Wilson Features', 'Wilson', 'manage_options', 'wilson_features', array($this, 'admin_index'),'dashicons-store', null);
   }

   public function admin_index(){
      require_once $this->plugin_path . 'templates/menu.php';
   }
 }