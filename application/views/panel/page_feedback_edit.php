<?php

$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
echo form_open_multipart($con_link . '/save');
if (isset($error)) {
    echo form_label($error);
}
echo form_fieldset('Partner:');
echo '<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">';
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Content:');
echo '</td><td width="29%">';
$data_content = array(
    'name' => 'content',
    'id' => 'content',
    'value' => $new_item->content,
    'class' => 'form field'    
);
echo form_textarea($data_content);
echo '</td><td width="40%">';
echo form_error('content');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Customer:');
echo '</td><td width="29%">';
$data_customer_name = array(
    'name' => 'customer_name',
    'id' => 'customer_name',
    'value' => $new_item->customer_name,
    'class' => 'form field',
);
echo form_input($data_customer_name);
echo '</td><td width="40%">';
echo form_error('customer_name');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Customer designation:');
echo '</td><td>';
$data_degisnation = array(
    'name' => 'designation',
    'id' => 'designation',
    'value' => $new_item->designation,
    'class' => 'form field'
);
echo form_input($data_degisnation);
echo '</td><td width="40%">';
echo form_error('designation');
echo '</td></tr>';

echo '<tr><td></td><td>';
echo form_submit('save', 'Save');
if (isset($new_item->id)) {
    echo form_hidden('item_id', $new_item->id);
}
echo '</td></tr>';
echo '</table>';
echo form_fieldset_close();

echo form_close();
?>
