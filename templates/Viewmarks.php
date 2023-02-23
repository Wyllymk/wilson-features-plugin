
<h2 class="text-center text-warning mt-3"><u>View Added Trainees</u></h2>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date Created</th>
                <th>Name</th>
                <th>Email</th>
                <th>Attendance Marks</th>
                <th>Project Marks</th>
            </tr>
        </thead>
        <tbody>
        <?php
            global $wpdb;
            $table = $wpdb->prefix.'trainees';
            $trainees = $wpdb->get_results("SELECT * FROM $table");
            foreach($trainees as $trainee){
           ?>
                <tr>
                    <td><?php echo $trainee->event_date;?></td>
                    <td><?php echo $trainee->name;?></td>
                    <td><?php echo $trainee->email;?></td>
                    <td><?php echo $trainee->attendance;?></td>
                    <td><?php echo $trainee->project;?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $trainee->trainees_id; ?>">
                            <input type="submit" name="deltrainee" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>
</div>
