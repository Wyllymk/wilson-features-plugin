<?php
/**
 * @package           WilsonFeatures
 */

 /* 
 * Plugin Name:       Wilson Features
 * Plugin URI:        https://github.com/Wyllymk/wilson-features-plugin
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Wilson
 * Author URI:        https://wyllymk.github.io/newport/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/Wyllymk/wilson-features-plugin
 * Text Domain:       wilson-features
 * Domain Path:       /languages
 */

/*
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/*-------------------------------------------------------------------------*/
/*                        SECURITY CHECK                                   */
/*-------------------------------------------------------------------------*/
defined('ABSPATH') or die('Hey you, gerarahia!');


if(file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once dirname(__FILE__). '/vendor/autoload.php';
}

use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Pages\Admin;
/*-------------------------------------------------------------------------*/
/*                                                           */
/*-------------------------------------------------------------------------*/
if(!class_exists('Wilson')){
    class Wilson{
        public $plugin_name;

        public function __construct(){
            $this->plugin = plugin_basename(__FILE__);
        }

        public  function register(){
            //calls methods within the class
            add_action('init', array($this, 'custom_post_type'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            add_action('admin_menu', array($this, 'add_admin_pages'));
            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }
        public function activate(){
            Activate::activate();
        }

        public function deactivate(){
            Deactivate::deactivate();
        }

        public function enqueue(){
            //enqueue all scripts and styles
            wp_enqueue_style('pluginstyle.css', plugins_url('/assets/pluginstyle.css', __FILE__));
            wp_enqueue_script('pluginscript.js', plugins_url('/assets/pluginscript.js', __FILE__) );
        }

        public function settings_link($links){
            $settings_link = '<a href="admin.php?page=wilson_features">Settings</a>';
            array_push($links, $settings_link); 
            return $links;
        }
        public function add_admin_pages(){
            add_menu_page('Wilson Features', 'Wilson', 'manage_options', 'wilson_features', array('Wilson', 'admin_index'),'dashicons-store', null);
        }

        public static function admin_index(){
            require_once plugin_dir_path(__FILE__). '/templates/menu.php';
        }

        public function custom_post_type(){
            //Generate a CPT
            $label = array(
                'name'      =>  'Book'
            );
            $args = array(
                'labels'    =>  $label,
                'public'    =>  true
                
            );
            register_post_type('book', $args);
        }
    }


//Instantiating the class
    $new = new Wilson();
    $new->register();

//activation
    register_activation_hook(__FILE__, array($new, 'activate'));
    
//deactivation
    register_deactivation_hook(__FILE__, array($new, 'deactivate'));
//uninstall
}