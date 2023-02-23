<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;

 class ExternalApi{
    public function register(){
        add_shortcode('users', array($this, 'getDataApi'));
    }

    public function getDataApi(){
        
        $url = 'https://jsonplaceholder.ir/users';

        $arguments = [
            'mehod' => 'GET'
        ];

        $response = wp_remote_get($url, $arguments);

        if(200 == wp_remote_retrieve_response_code($response)){

            $file_link = WP_PLUGIN_DIR.'/wilson-features/data.json';

            $message = wp_remote_retrieve_body( $response );

            $this->write_to_json($message, $file_link);

        }

        if(200 !== wp_remote_retrieve_response_code($response) || is_wp_error( $response )){
            $file_link = WP_PLUGIN_DIR.'/wilson-features/error-log.txt';

            $error_message = $response->get_error_message();

            $message = $date('d m Y g:i:a' . ' ' .$error_message);

            $this->write_to_error($error_message, $file_link);
        }
        
        // if(is_wp_error( $response )){
        //     $error_message = $response->get_error_message();
        //     return "Something went wrong: $error_message";
        // }
        // Prettify json
        // echo '<pre>';
        // print_r(wp_remote_retrieve_body($response));
        // echo '</pre>';

        //converting to object
        echo '<pre>';
        $data = (json_decode(wp_remote_retrieve_body($response)));
        var_dump($data);
        echo '</pre>';

        return;
        
        $html = '<div class="container">';
        $html .= '<table class="table table-striped table-hover">';

        $html .= '<thead>';
        $html .= '<tr class="table-dark">';
        $html .= '<th> ID</th>';
        $html .= '<th> Firstname</th>';
        $html .= '<th> Maidenname</th>';
        $html .= '<th> Age</th>';
        $html .= '<th> Gender</th>';
        $html .= '<th> Email</th>';
        $html .= '<th> Phone</th>';
        $html .= '<th> Username</th>';
        $html .= '<th> Password</th>';
        $html .= '<th> Birthdate</th>';
        $html .= '<th> Image</th>';
        $html .= '</tr>';
        $html .= '</thead>';

        foreach($data->users as $user){
        $html .= '<tr>';
        $html .= '<td>' .$user->id.'</td>';
        $html .= '<td> ' .$user->firstName.'</td>';
        $html .= '<td> ' .$user->lastName.'</td>';
        $html .= '<td> ' .$user->maidenName.'</td>';
        $html .= '<td> ' .$user->age.'</td>';
        $html .= '<td> ' .$user->gender.'</td>';
        $html .= '<td> ' .$user->email.'</td>';
        $html .= '<td> ' .$user->phone.'</td>';
        $html .= '<td> ' .$user->username.'</td>';
        $html .= '<td> ' .$user->password.'</td>';
        $html .= '<td> ' .$user->birthDate.'</td>';
        $html .= '<td><img src="'.$user->image.'" height="100" width="100"></td>';
        $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</div>';

        return $html;

    }

    function write_to_json($message, $file_link){
        if(file_exists($file_link)){
            $writing = fopen($file_link, 'w');
            fwrite($writing, $message. "\n");
        }else{
            $writing = fopen($file_link, 'w');
            fwrite($writing, $message. "\n");
        }
        fclose($writing);
    }

    function write_to_error($message, $file_link){
        if(file_exists($file_link)){
            $writing = fopen($file_link, 'a');
            fwrite($file_link, $message. "\n");
        }else{
            $writing = fopen($file_link, 'w');
            fwrite($file_link, $message. "\n");
        }
        fclose($writing);
    }
 }