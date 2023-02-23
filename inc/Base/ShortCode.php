<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;

 class ShortCode{
    function register(){
        add_shortcode('wilson', array($this, 'displayTable'));
        add_shortcode('wilson2', array($this, 'add_short_code'));

    }

    function displayTable($atts){
        $defaults = [
            'title' => 'This is the Table Title',
            'description' => 'Its shows columns'
        ];

        $atts = shortcode_atts(
            $defaults, $atts, 'wilson'
        );

        $html = '<div class="container">';
        $html .= '<h2>'.$atts["title"].'</h2>';
        $html .= '<h4>'.$atts["description"].'</h4>';
        $html .= '<table class="table striped-table">';

        $html .=  '<tr>';
        $html .=  '<th>Column 1</th>';
        $html .=  '<th>Column 2</th>';
        $html .=  '<th>Column 3</th>';
        $html .=  '<th>Column 4</th>';
        $html .=  '</tr>';

        $html .=  '<tr>';
        $html .=  '<td>Row 1</td>';
        $html .=  '<td>Row 1</td>';
        $html .=  '<td>Row 1</td>';
        $html .=  '<td>Row 1</td>';
        $html .=  '</tr>';

        $html .= '</table>';
        $html .= '</div>';


        return $html;
    }
    
/*-------------------------------------------------------------------------*/
/*                        SHORT CODES                                      */
/*-------------------------------------------------------------------------*/
    function add_short_code($atts){
        $attributes = shortcode_atts([
            "team_members" => "Christine, Chrispin, Wilson, Ken, Jonah",
            "number_of_trainees" => "5"
        ], $atts);
        return 'Team Members = '. $attributes ['team_members']. ' and Number of Trainees = ' . $attributes['number_of_trainees'];
    }
 }