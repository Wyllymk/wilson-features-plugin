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

/*-------------------------------------------------------------------------*/
/*                                                           */
/*-------------------------------------------------------------------------*/
if(!class_exists('Wilson')){
    class Wilson{
        public function __construct(){

        }

        public function activate(){
            echo 'activates';
            flush_rewrite_rules();
        }

        public function deactivate(){
            flush_rewrite_rules();
        }

        public function uninstall(){

        }
    }
}

//Instantiating the class
$newWilsonInstance = new Wilson();

//activation
register_activation_hook(__FILE__, array($newWilsonInstance, 'activate'));
//deactivation
register_deactivation_hook(__FILE__, array($newWilsonInstance, 'deactivate'));
//uninstall
