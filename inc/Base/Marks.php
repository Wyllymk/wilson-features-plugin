<?php
/**
 * @package           WilsonFeatures
 */

 namespace Inc\Base;

 class Marks{
    public function register(){
        $this->create_marks_table();
        $this->enterMarksDB();
        $this->deleteTrainee();
        //$this->updateTrainee();
        //$this->getOneTrainee();
        //$this->getEmails();
    }
    public static function create_marks_table(){
        global $wpdb;
        $table = $wpdb->prefix.'marks';

        $marks_details = "CREATE TABLE IF NOT EXISTS $table(
            ID bigint unsigned NOT NULL auto_increment,
            event_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            name text NOT NULL,
            email varchar(30) NOT NULL,
            attendance int NOT NULL,
            project int NOT NULL,
            PRIMARY KEY (ID)
        );";

        require_once (ABSPATH. 'wp-admin/includes/upgrade.php');

        dbDelta($marks_details);
    }

    public static function enterMarksDB(){
        if(isset($_POST['submitmarks'])){
            $marks = array(
                'name'      =>  $_POST['name'],
                'email'     =>  $_POST['email'],
                'attendance' =>  $_POST['attendance'],
                'project'   =>  $_POST['project']
            );
            global $wpdb;
            $table = $wpdb->prefix.'marks';
            $type = array(
                '%s',
                '%s',
                '%d',
                '%d'
            );
            $results = $wpdb->insert($table, $marks, $type);

            if($results==true){
                echo "<script>alert('Marks were submitted successfully')</script>";
            }else{
                echo "<script>alert('Marks submission failed')</script>";
            }
        }
    }

    public function deleteTrainee(){
        if(isset($_POST['delbtn'])){
        global $wpdb;
        $table = $wpdb->prefix.'marks';
        
        $id = $_POST['id'];

        $results = $wpdb->delete($table, array('ID' => $id));

        if($results==true){
            echo "<script>alert('Trainee deleted successfully')</script>";
        }else{
            echo "<script>alert('Trainee Deletion failed')</script>";
        }
        }
    }

    function updateTrainee(){
        global $wpdb;
        $table = $wpdb->prefix.'marks';
        $data = array(
            'name' => 'Kim'
        );
        $condition = array(
            'email' => 'kimnjogu@gmail.com'
        );
        $results = $wpdb->update($table, $data, $condition);
        if($results==true){
            echo "<script>alert('Trainee info updated successfully')</script>";
        }else{
            echo "<script>alert('Trainee update failed')</script>";
        }
    }

    function getOneTrainee(){
        global $wpdb;
        $table = $wpdb->prefix.'marks';
       
        $results = $wpdb->get_row("SELECT * FROM $table WHERE email='kimnjogu@gmail.com'");

        print_r($results);
        if($results==true){
            echo "<script>alert(' One Trainee successfully')</script>";
        }else{
            echo "<script>alert('Trainee fetch failed')</script>";
        }
    }

    function getEmails(){
        global $wpdb;
        $table = $wpdb->prefix.'marks';
       
        $results = $wpdb->get_col("SELECT email FROM $table");

        print_r($results);

        if($results==true){
            echo "<script>alert(' Emails fetched successfully')</script>";
        }else{
            echo "<script>alert('Emails fetching failed')</script>";
        }
    }
 }