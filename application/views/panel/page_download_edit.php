<?php

$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//echo '<pre>';
//print_r($news);
//echo '</pre>';
$config_mini = array();
$config_mini['toolbar'] = array(
    array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'Link', 'Unlink', 'Anchor', 'Image')
);
$config_mini = array(
    array('Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList'));
//---- Hoặc tùy biến kích thước
$this->ckeditor->config['width'] = '900px';
$this->ckeditor->config['height'] = '300px';

/* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
$config_mini['filebrowserBrowseUrl'] = base_url() . "ckeditor/ckfinder/browse.php";
$config_mini['filebrowserImageBrowseUrl'] = base_url() . "ckeditor/ckfinder/browse.php?type=images";
$config_mini['filebrowserUploadUrl'] = base_url() . "ckeditor/ckfinder/upload.php?type=files";
$config_mini['filebrowserImageUploadUrl'] = base_url() . "ckeditor/ckfinder/upload.php?type=images";



echo form_open_multipart(base_url().$this->uri->segment(1) . '/' . $this->uri->segment(2) . '/save');
if (isset($error)) {
    echo form_label($error);
}
echo form_fieldset('Download:');
echo '<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">';
echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Name:');
echo '</td><td width="29%">';
$data_name = array(
    'name' => 'name',
    'id' => 'name',
    'value' => $new_item->name,
    'class' => 'form field',    
    'onkeyup' => "if (isArrowKey(event)) return; copy2friendlyURL('#name');",
    'onchange' => "copy2friendlyURL('#name');"
);
echo form_input($data_name);
echo '</td></tr>';

echo '<tr>';
echo'<td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Category');
echo '</td>';
echo '<td>';
//    form_dr
echo form_dropdown('category', $Cname, set_value('category', $new_item->category_id)), '<br>';
echo '</td></tr>';

echo '<tr>';
echo'<td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Icon');
echo '</td>';
echo '<td>';
//    form_dr
echo form_dropdown('icon', $icons, set_value('icon', $new_item->icon)), '<br>';
echo '</td></tr>';


//    echo '<tr>';
//    echo'<td align="right" valign="top" width="15%" class="field_name">';
//    echo form_label('Icon');
//    echo '</td>';
//    echo '<td>';
//    
//    $data_news_icon = array(
//        'name' => 'news_icon',
//        'id' => 'news_icon',
//        'value' => $new_item->news_icon,
//        'class' => 'form field',
//    );
//    echo form_input($data_news_icon);
//    echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Active');
echo '</td><td width="10%">';
$active_data = array('name' => 'active', 'id' => 'active', 'value' => 'TRUE', 'checked' => $new_item->active);
echo form_checkbox($active_data);
echo '</td>';
echo '<td></td></tr>';

echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Show on homepage');
echo '</td><td width="10%">';
$display_home_page_data = array('name' => 'display_home_page', 'id' => 'display_home_page', 'value' => 'TRUE', 'checked' => $new_item->display_home_page);
echo form_checkbox($display_home_page_data);
echo '</td>';
echo '<td></td></tr>';



echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Meta Title:');
echo '</td><td>';
echo form_input(array('name'=>'meta_title','class'=>'form field'), $new_item->meta_title), '<br>';
echo '</td><td>';
echo form_error('meta_title');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Description:');
echo '</td><td>';
//echo form_textarea(array('name' => 'description', 'class' => 'form field', 'cols' => '80', 'rows' => '2'), $new_item->description), '<br>';
echo $this->ckeditor->editor('description', $new_item->description, $config_mini);
echo '</td><td>';

echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Meta description:');
echo '</td><td>';
echo form_textarea(array('name'=>'meta_description','class'=>'form field','cols'=>'80', 'rows' =>'2'), $new_item->meta_description), '<br>';
echo '</td><td>';
echo form_error('meta_description');
echo '</td></tr>';
echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Keywords');
echo '</td><td>';
echo form_input(array('name'=>'meta_keywords','class'=>'form field'), $new_item->meta_keywords), '<br>';
echo '</td><td>';
echo form_error('meta_keywords');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="15%" class="field_name">';
echo form_label('Link Rewrite:');
echo '</td><td>';
$data_link_rewrite = array(
    'name' => 'link_rewrite',
    'id' => 'link_rewrite',
    'value' => $new_item->link_rewrite,
    'class' => 'form field',
);
echo form_input($data_link_rewrite);
echo '</td><td width="40%">';
echo form_error('link_rewrite');
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
