<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Api\Callbacks;

use \Inc\Base\Controller;

 class AdminCallbacks extends Controller{

    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/menu.php");
    }
 }