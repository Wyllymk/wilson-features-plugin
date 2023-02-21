<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;

 class WilsonDB{
/*-------------------------------------------------------------------------*/
/*                        FETCHING DATA FROM DB                            */
/*-------------------------------------------------------------------------*/
    function register(){
        // global $wpdb;
        // $table = 'wp_admin_contact';
        // if($this->$table==true){
        //     echo "Table Exists already";
        // }else{
        //     $this->create_table_admin_contact();
        // }
        $this->pass_data_to_admin_contact();
    }

    function create_table_admin_contact(){
        global $wpdb;
        $table = 'wp_admin_contact';
        $charset_collate = $wpdb->get_charset_collate();

        $admin_contact_details = "CREATE TABLE $table(
            ID bigint unsigned NOT NULL auto_increment,
            event_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            firstname text NOT NULL,
            lastname text NOT NULL,
            email varchar(35) NOT NULL,
            password VARCHAR(20) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($admin_contact_details);
    }

    function pass_data_to_admin_contact(){
        if(isset($_POST['submitcontactadmin'])){
            $data = array(
                'firstname' => $_POST['firstname'],
                'lastname'  =>  $_POST['lastname'],
                'email'     =>  $_POST['email'],
                'password'   =>  password_hash($_POST['password'], PASSWORD_DEFAULT)

            );
            global $wpdb;
            $table = 'wp_admin_contact';
            $result = $wpdb->insert($table, $data, $format=NULL);
            
            if($result==true){
                echo '<script>alert("Admin Form Submitted Successfully");</script>' ;
            }else{
                echo '<script>alert("Admin Form Not Submitted");</script>' ;
            }
        }
    }
}