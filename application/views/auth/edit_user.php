
<?php echo form_fieldset('Edit User'); ?>
<p>Please enter the users information below.</p>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open(current_url(),array('id'=>'users')); ?>

<p>
    <?php echo form_label('First name', 'first_name', array('class' => 'field_name')); ?>                
    <?php echo form_input($first_name); ?>
</p>

<p>
    <?php echo form_label('Last name', 'last_name', array('class' => 'field_name')) ?>                
    <?php echo form_input($last_name); ?>
</p>

<p>
    <?php echo form_label('Phone', 'phone1', array('class' => 'field_name')) ?>
    <?php echo form_input($phone1); ?>
</p>

<p>
    <?php echo form_label('Password', 'password', array('class' => 'field_name')) ?>
    <?php echo form_input($password); ?>
</p>

<p>
    <?php echo form_label('Confirm password', 'password_confirm', array('class' => 'field_name')) ?>
    <?php echo form_input($password_confirm); ?>
</p>


<?php echo form_hidden('id', $user->id); ?>
<?php echo form_hidden($csrf); ?>

<p><?php echo form_submit('submit', 'Save User'); ?></p>

<?php echo form_close(); ?>
<?php echo form_fieldset_close(); ?>
