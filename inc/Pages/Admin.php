<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Pages;

 use \Inc\Base\Controller;
 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 
 class Admin extends Controller{

   public $settings;

   public $callbacks;

   public $pages = array();

   public $subpages = array();

   public function register(){
      $this->settings = new SettingsApi();

      $this->callbacks = new AdminCallbacks();

      $this->setPages();

      $this->setSubPages();

      $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
   }

  public function setPages(){

   $this->pages = array(
      [
      'page_title'   =>    'Wilson Dashboard',
      'menu_title'   =>    'Wilson Features',
      'capability'   =>    'manage_options',
      'menu_slug'    =>    'wilson_features',
      'callback'     =>    array( $this->callbacks, 'adminDashboard' ),
      'icon_url'     =>    'dashicons-admin-site-alt',
      'position'     =>    110
      ]

   );

  }
  public function setSubPages(){

   $this->subpages = array(
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'CPT',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_cpt',
         'callback'     =>   function(){echo '<h1>CPT Manager</h1>';},
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Taxonomies',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_taxonomies',
         'callback'     =>   function(){echo '<h1>Taxonomies Manager</h1>';},
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Widgets',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_widgets',
         'callback'     =>   function(){echo '<h1>Widgets Manager</h1>';},
      ]

   );

  }
}