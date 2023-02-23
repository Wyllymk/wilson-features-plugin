<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Pages;

 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 
 class Admin{

   public $settings;

   public $callbacks;

   public $pages = array();

   public $subpages = array();

   public function register(){
      $this->settings = new SettingsApi();

      $this->callbacks = new AdminCallbacks();

      $this->setPages();

      $this->setSubPages();

      $this->createSettings();

      $this->createSections();

      $this->createFields();

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
         'callback'     =>   array($this->callbacks, 'cptManager'),
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Taxonomies',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_taxonomies',
         'callback'     =>   array($this->callbacks, 'taxonomyManager'),
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Widgets',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_widgets',
         'callback'     =>   array($this->callbacks, 'widgetsManager'),
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Marks Entry',
         'menu_title'   =>   'Marks Entry',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_marks',
         'callback'     =>   array($this->callbacks, 'marksEntry'),
      ],
      [
         'parent_slug'  =>   'wilson_features',
         'page_title'   =>   'Marks View',
         'menu_title'   =>   'Marks View',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'wilson_view',
         'callback'     =>   array($this->callbacks, 'marksView'),
      ]

   );

  }

  public function createSettings(){
   $params = array(
      array(
         'option_group'    =>    'wilson_options_group',
         'option_name'     =>    'first_name',
         'callback'        =>    array($this->callbacks, 'wilsonOptionsGroup')
      ),
      array(
         'option_group'    =>    'wilson_options_group',
         'option_name'     =>    'last_name',
         'callback'        =>    array($this->callbacks, 'wilsonOptionsGroup')
      )
   );
   $this->settings->setSettings($params);
  }

  public function createSections(){
   $params = array(
      array(
         'id'           =>    'wilson_admin_index',
         'title'        =>    'Settings',
         'callback'     =>    [$this->callbacks, 'wilsonAdminSection'],
         'page'         =>    'wilson_features'
      )
   );
   $this->settings->setSections($params);
  }

  public function createFields(){
   $params = array(
      array(
         'id'           =>    'first_name', //get from create settings option_name
         'title'        =>    'First Name',
         'callback'     =>    [$this->callbacks, 'wilsonFirstName'],
         'page'         =>    'wilson_features',
         'section'      =>    'wilson_admin_index', //section id from create section id
         'args'         =>    [
            'label_for'    =>    'wilson_example',
            'class'        =>    'example_class'
         ]
         ),
         array(
            'id'           =>    'last_name', //get from create settings option_name
            'title'        =>    'Last Name',
            'callback'     =>    [$this->callbacks, 'wilsonLastName'],
            'page'         =>    'wilson_features',
            'section'      =>    'wilson_admin_index', //section id from create section id
            'args'         =>    [
               'label_for'    =>    'wilson_example',
               'class'        =>    'example_class'
            ]
         )
   );
   $this->settings->setFields($params);
  }

}