<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;
 
 class Activate{
    public static function activate(){
        //Wilson::custom_post_type();
        flush_rewrite_rules();
    }
 }