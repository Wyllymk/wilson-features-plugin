<h2 class="text-center text-primary"><u>Marks Entry</u> </h2>
<div class="card shadow">
    <form action="" method="post">
        <div class="form-group">
            <label for="">Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Input name">
        </div>
        <div class="form-group">
            <label for="">Email:</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Input email">
        </div>
        <div class="form-group">
            <label for="">Attendance:</label>
            <input type="number" name="attendance" id="attendance" class="form-control" placeholder="Input attendance">
        </div>
        <div class="form-group">
            <label for="">Project:</label>
            <input type="number" name="project" id="project" class="form-control" placeholder="Marks out of 10">
        </div>
        <div class="row justify-content-center">
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <input type="submit" name="submitmarks" value="Submit" class="btn btn-primary px-5 mt-2">
                </div>

        </div>
    </form>
</div>

<h2 class="text-center text-warning mt-3"><u>View Marks</u></h2>
<?php
global $wpdb;
$table = $wpdb->prefix.'marks';
$trainees = $wpdb->get_results("SELECT * FROM $table");
?>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date Created</th>
                <th>Name</th>
                <th>Email</th>
                <th>Attendance Marks</th>
                <th>Project Marks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($trainees as $trainee){?>
                <tr>
                    <td><?php echo $trainee->event_date;?></td>
                    <td><?php echo $trainee->name;?></td>
                    <td><?php echo $trainee->email;?></td>
                    <td><?php echo $trainee->attendance;?></td>
                    <td><?php echo $trainee->project;?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $trainee->ID; ?>">
                            <input type="submit" name="delbtn" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
