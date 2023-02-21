<div class="wrap">
    <h1 class="text-center fw-bold">Welcome To Wilson Features!</h1>
    <?php settings_errors();?>
    <form action="options.php" method="post">
        <?php 
            settings_fields('wilson_options_group');
            do_settings_sections('wilson_features');
            submit_button();
        ?>
    </form>
</div>

