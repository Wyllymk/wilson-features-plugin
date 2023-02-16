<style scoped>
    .hcf_box{
        display: grid;
        grid-template-columns: max-content 1fr;
        grid-row-gap: 5px;
        grid-column-gap: 5px;
    }
    .hcf_field{
        display: contents;
    }
    input[type="date"], input[type="number"]{
        width:90%;
    }
</style>
<div class="hcf_box">
    <p class="meta-options hcf_field">
        <label for="published_date">Published Date:</label>
        <input id="published_date" type="date" name="published_date" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'published_date', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="initial_price">Initial Price:</label>
        <input id="initial_price" type="number" name="initial_price" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'initial_price', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="current_price">Current Price:</label>
        <input id="current_price" type="number" name="current_price" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'current_price', true ) ); ?>">
    </p>
</div>