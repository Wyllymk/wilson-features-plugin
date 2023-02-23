<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;

 class ShortCode{
    function register(){
        add_shortcode('wilson', array($this, 'displayTable'));
    }

    function displayTable($atts){
        $defaults = [
            'Title' => 'This is the Table Title',
            'Description' => 'Its shows columns'
        ];

        $atts = shortcode_atts(
            $defaults, $atts, 'wilson'
        );
        
        $html = '';
        $html .= '<h2>'.$atts["Title"].'</h2>';
        $html .= '<h4>'.$atts["Description"].'</h4>';
        $html .= '<table>';
        $html .=  '<tr>';
        $html .=  '<th>Column 1</th>';
        $html .=  '<th>Column 2</th>';
        $html .=  '<th>Column 3</th>';
        $html .=  '<th>Column 4</th>';
        $html .=  '</tr>';
        $html .= '</table>';

        return $html;
    }
    
/*-------------------------------------------------------------------------*/
/*                        SHORT CODES                                      */
/*-------------------------------------------------------------------------*/
    function add_short_code($atts){
        $attributes = shortcode_atts([
            "TeamMembers" => "Christine, Chrispin, Wilson, Ken, Jonah",
            "Number_of_trainees" => "5"
        ], $atts);
        return 'Team Members = '. $attributes ['TeamMembers']. ' and Number of Trainees = ' . $attributes['Number_of_trainees'];
    }
 }