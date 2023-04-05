<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
//print_r($news);
//echo '</pre>';

//$config_mini = array();

//$config_mini['toolbar'] = array(
//    array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Link', 'Unlink', 'Anchor', 'Image')
//);
//$config_mini = array(
//    array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList'));
//---- Hoặc tùy biến kích thước
//$this->ckeditor->config['width'] = '730px';
//$this->ckeditor->config['height'] = '300px';

/* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
//$config_mini['filebrowserBrowseUrl'] = base_url() . "ckeditor/ckfinder/browse.php";
//$config_mini['filebrowserImageBrowseUrl'] = base_url() . "ckeditor/ckfinder/browse.php?type=images";
//$config_mini['filebrowserUploadUrl'] = base_url() . "ckeditor/ckfinder/upload.php?type=files";
//$config_mini['filebrowserImageUploadUrl'] = base_url() . "ckeditor/ckfinder/upload.php?type=images";



echo form_open('panel/contact/save');

echo form_fieldset('Contact');
echo '<table width="45%" border="0" cellspacing="0" cellpadding="5" align="left">';
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';

echo '</td><td>';
echo form_error('content');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="20%" class="field_name">';
echo form_label('Name: * ');
echo '</td><td>';
echo form_input(array('name' => 'name', 'class' => 'form field'), $contact->name), '<br>';
echo '</td><td>';
echo form_error('name');
echo '</td></tr>';

//echo '<tr><td align="right" valign="top" width="20%" class="field_name">';
//echo form_label('Position: * ');
//echo '</td><td>';
//echo form_input(array('name' => 'position','id' => 'position', 'class' => 'form field'), $contact->position), '<br>';
//echo '</td><td>';
//echo form_error('position');
//echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="20%" class="field_name">';
echo form_label('Yahoo: * ');
echo '</td><td>';
echo form_input(array('name' => 'yahoo','id'=>'yahoo', 'class' => 'form field'), $contact->yahoo), '<br>';
echo '</td><td>';
echo form_error('yahoo');
echo '</td></tr>';

//echo '<tr><td align="right" valign="top" width="20%" class="field_name">';
//echo form_label('Skype: * ');
//echo '</td><td>';
//echo form_input(array('name' => 'skype','id'=>'skype', 'class' => 'form field'), $contact->skype), '<br>';
//echo '</td><td>';
//echo form_error('skype');
//echo '</td></tr>';

//echo '<tr><td align="right" valign="top" width="20%" class="field_name">';
//echo form_label('Phone: * ');
//echo '</td><td>';
//echo form_input(array('name' => 'phone','id'=>'phone', 'class' => 'form field'), $contact->phone), '<br>';
//echo '</td><td>';
//echo form_error('phone');
//echo '</td></tr>';
echo '<tr><td></td><td>';
echo form_submit('save', 'Save');
echo '</td></tr>';
if (isset($contact->id_contact)) {
    echo form_hidden('id_contact', $contact->id_contact);
}
echo '</td></tr>';
echo '</table>';
echo form_fieldset_close();

echo form_close();
?>
