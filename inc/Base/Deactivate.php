<?php
/**
 * @package           WilsonFeatures
 */
class Deactivate{
    public static function deactivate(){
        flush_rewrite_rules();
    }
 }