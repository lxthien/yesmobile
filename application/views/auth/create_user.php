<?php $con_link = base_url() . $this->uri->segment(1); ?>
<h1>Create User</h1>
<?php echo form_fieldset('Create user'); ?>
<p>Please enter the users information below.</p>

<div id="infoMessage"><?php echo $message; ?></div>

<?php echo form_open($con_link . "/create-user", array('id' => 'users')); ?>

    
<p>
    <?php // echo form_error('first_name'); ?>
    <?php echo form_label('First name', 'first_name', array('class' => 'field_name')); ?>                
    <?php echo form_input($first_name); ?>          
</p>

<p>
    <?php // echo form_error('last_name'); ?>
    <?php echo form_label('Last name', 'last_name', array('class' => 'field_name')) ?>                
    <?php echo form_input($last_name); ?>
</p>     

<p>
    <?php // echo form_error('last_name'); ?>
    <?php echo form_label('Username', 'user_name', array('class' => 'field_name')) ?>                
    <?php echo form_input($user_name); ?>
</p>     

<p>
    <?php // echo form_error('email'); ?>
    <?php echo form_label('Email', 'email', array('class' => 'field_name')) ?>                
    <?php echo form_input($email); ?>
</p>

<p>            
    <?php // echo form_error('phone1'); ?>
    <?php echo form_label('Phone', 'phone1', array('class' => 'field_name')) ?>
      <!--<?php // echo form_input($phone1); ?>-<?php // echo form_input($phone2); ?>-<?php // echo form_input($phone3); ?>-->
    <?php echo form_input($phone1); ?>
</p>

<p>            
    <?php // echo form_error('password'); ?>
    <?php echo form_label('Password', 'password', array('class' => 'field_name')) ?>
    <?php echo form_input($password); ?>
</p>

<p>            
    <?php // echo form_error('password_confirm'); ?>
    <?php echo form_label('Confirm password', 'password_confirm', array('class' => 'field_name')) ?>
    <?php echo form_input($password_confirm); ?>
</p>


<p><?php echo form_submit('submit', 'Create User'); ?></p>

<?php echo form_close(); ?>
<?php echo form_fieldset_close(); ?>