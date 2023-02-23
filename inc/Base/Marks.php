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
        $this->create_trainees_table();
        $this->addTrainee();
        $this->deleteAddedTrainee();
        //$this->updateTrainee();
        //$this->getOneTrainee();
        //$this->getEmails();
    }
    public static function create_marks_table(){
        global $wpdb;
        $marks_table = $wpdb->prefix.'marks';

        $marks_details = "CREATE TABLE IF NOT EXISTS $marks_table(
            marks_id bigint(20) unsigned NOT NULL auto_increment,
            event_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            name text NOT NULL,
            email varchar(30) NOT NULL,
            attendance int NOT NULL,
            project int NOT NULL,
            PRIMARY KEY (marks_id)
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
            // Check if the email is already in use
            $email_exists = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE email=%s", $_POST['email']));
            if($email_exists) {
                echo "<script>alert('This email is already in use')</script>";
                return;
            }
            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Invalid email address')</script>";
                return;
            }
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

        $results = $wpdb->delete($table, array('marks_id' => $id));

        if($results==true){
            echo "<script>alert('Trainee deleted successfully')</script>";
        }else{
            echo "<script>alert('Trainee Deletion failed')</script>";
        }
        }
    }

    public static function create_trainees_table(){
        global $wpdb;
        $trainees_table = $wpdb->prefix.'trainees';
        $marks_table = $wpdb->prefix.'marks';
        $sql = "CREATE TABLE IF NOT EXISTS $trainees_table(
            trainees_id bigint(20) unsigned NOT NULL auto_increment,
            marks_id bigint(20) unsigned NOT NULL,
            event_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            name text NOT NULL,
            email varchar(30) NOT NULL,
            attendance int NOT NULL,
            project int NOT NULL,
            PRIMARY KEY (trainees_id),
            FOREIGN KEY (marks_id) REFERENCES $marks_table(marks_id) ON DELETE CASCADE
        );";

        $wpdb->query("CREATE TRIGGER IF NOT EXISTS delete_trainees
        AFTER DELETE ON $marks_table
        FOR EACH ROW
        BEGIN
            DELETE FROM $trainees_table
            WHERE marks_id = OLD.marks_id;
        END;");

        require_once (ABSPATH. 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
    }

    public function addTrainee(){
        global $wpdb;

        if (isset($_POST['add_trainee'])) {
            $id = $_POST['marks_id'];
            $table = $wpdb->prefix.'trainees';
    
            $sql = "INSERT INTO $table (marks_id, name, email, attendance, project) 
                    SELECT  marks_id, name, email, attendance, project 
                    FROM {$wpdb->prefix}marks WHERE marks_id = $id";
            $wpdb->query($sql);

        }
    }

    public function deleteAddedTrainee(){
        if(isset($_POST['deltrainee'])){
        global $wpdb;
        $table = $wpdb->prefix.'trainees';
        
        $id = $_POST['id'];

        $results = $wpdb->delete($table, array('trainees_id' => $id));

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