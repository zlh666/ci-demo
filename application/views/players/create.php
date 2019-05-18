<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('players/create'); ?>

    <label for="name">Name</label>
    <input type="input" name="name" /><br />

    <label for="age">Age</label>
    <input type="input" name="age" /><br />

    <input type="submit" name="submit" value="Create player item" />

</form>