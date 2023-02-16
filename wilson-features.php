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


/* A security check to make sure that the file is not being accessed directly. */
defined('ABSPATH') or die('Hey you, gerarahia!');


/* Checking if the file exists and if it does, it will require it. */
if(file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once dirname(__FILE__). '/vendor/autoload.php';
}

function activate_externally(){
    Inc\Base\Activate::activate();
}

function deactivate_externally(){
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_externally');
register_deactivation_hook(__FILE__, 'deactivate_externally');

/* Checking if the class exists and if it does, it will register the services. */
if(class_exists('Inc\\Init')){
    Inc\Init::register_services();
}