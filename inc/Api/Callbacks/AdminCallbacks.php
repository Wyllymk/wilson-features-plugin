<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Api\Callbacks;

use \Inc\Base\Controller;

 class AdminCallbacks extends Controller{

    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/Dashboard.php");
    }
    public function cptManager(){
        return require_once("$this->plugin_path/templates/CPTmanager.php");
    }
    public function taxonomyManager(){
        return require_once("$this->plugin_path/templates/Taxonomymanager.php");
    }
    public function widgetsManager(){
        return require_once("$this->plugin_path/templates/Widgetsmanager.php");
    }
    public function wilsonOptionsGroup($input){
        return $input;
    }
    public function wilsonAdminSection(){
        echo 'This is the first Section.';
    }
    public function wilsonAdminField(){
        $value = esc_attr(get_option('wilson_example'));
        echo '<input type="text" class="regular-text name="wilson_example" value="'.$value.'" placeholder="Write something here">';
    }
 }