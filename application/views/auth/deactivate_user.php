<?php 
$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
?>

<h1>Deactivate User</h1>
<p>Are you sure you want to deactivate the user '<?php echo $user->username; ?>'</p>
	
<?php echo form_open($con_link."/deactivate/".$user->id);?>

  <p>
  	<label for="confirm">Yes:</label>
    <input type="radio" name="confirm" value="yes" checked="checked" />
  	<label for="confirm">No:</label>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p><?php echo form_submit('submit', 'Submit');?></p>

<?php echo form_close();?>