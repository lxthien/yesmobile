<?php
$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
echo form_open_multipart($con_link . '/save');
if (isset($error)) {
    echo form_label($error);
}
echo form_fieldset('Category Product:');
echo '<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">';
/*
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Image');
echo '</td><td>';
if (strlen($new_item->image) > 0) {
    echo '<div class="picdoitac"><div class="opacity30"><img src="' . base_url(BANNER_PATH . $new_item->image) . '"></div></div>
';
}

$data_upload = array('name' => 'image',
    'id' => 'image',
    'class' => 'form field');
echo form_upload($data_upload);
echo '</td>';
echo '</tr>';
*/
echo form_hidden('id', $new_item->id);

/*
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Danh mục cha:');
echo '</td><td>';
$data_url = array(
    'name' => 'id_parent',
    'id' => 'id_parent',
    'value' => $new_item->id_parent,
    'class' => 'form field',
);
echo form_dropdown('id_parent', $options, $new_item->id_parent);
echo '</td><td width="40%">';
echo form_error('id_parent');
echo '</td></tr>';
*/
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Tên danh mục:');
echo '</td><td>';
$data_url = array(
    'name' => 'name',
    'id' => 'name',
    'value' => $new_item->name,
    'class' => 'form field',
);
echo form_input($data_url);
echo '</td><td width="40%">';
echo form_error('name');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Url:');
echo '</td><td>';
$data_url = array(
    'name' => 'link_rewrite',
    'id' => 'link_rewrite',
    'value' => $new_item->link_rewrite,
    'class' => 'form field',
);
echo form_input($data_url);
echo '</td><td width="40%">';
echo form_error('link_rewrite');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Seo Title:');
echo '</td><td>';
$data_url = array(
    'name' => 'meta_title',
    'id' => 'meta_title',
    'value' => $new_item->meta_title,
    'class' => 'form field',
);
echo form_input($data_url);
echo '</td><td width="40%">';
echo form_error('meta_title');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Seo Description:');
echo '</td><td width="29%">';
$data_title = array(
    'name'        => 'meta_description',
    'id'          => 'meta_description',
    'value'       => $new_item->meta_description,
    'rows'        => '5',
    'cols'        => '10',
    'style'       => 'width:100%',
    'class' => 'form class'
);
echo form_textarea($data_title);

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Seo Keyword:');
echo '</td><td>';
$data_url = array(
    'name' => 'meta_keywords',
    'id' => 'meta_keywords',
    'value' => $new_item->meta_keywords,
    'class' => 'form field',
);
echo form_input($data_url);
echo '</td><td width="40%">';
echo form_error('meta_keywords');
echo '</td></tr>';

echo '<tr><td></td><td>';
if (!$new_item->id) {
    echo form_submit('save', 'Save');
} else {
    echo form_submit('update', 'Update');
}
echo '</td></tr>';
echo '</table>';
echo form_fieldset_close();

echo form_close();