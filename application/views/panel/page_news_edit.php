<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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
//$config_mini['filebrowserImageUploadUrl'] = base_url() . "ckeditor/ckfinder/upload.php?type=images";
$config_mini['forcePasteAsPlainText'] = "true";

$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
echo form_open($con_link.'/save');

echo form_fieldset('Edit news:');
echo '<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">';
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Title:');
echo '</td><td width="29%">';
$data_title = array(
    'name' => 'title',
    'id' => 'title',
    'value' => $news->title,
    'class' => 'form field',
    'onchange' => "copy2friendlyURL('#title');",
    'onkeyup' => "if (isArrowKey(event)) return; copy2friendlyURL('#title');"
);
echo form_input($data_title);
echo '</td></tr>';

if ((isset($news->id_news) && (trim($news->id_news) !== COMPANY_INSTRODUCE_NEWS_ID) 
					&& trim($news->id_news) !== SERVICES
					&& trim($news->id_news) !== EPKINH
					&& trim($news->id_news) !== WARRANTY
					&& trim($news->id_news) !== SITE_MAP) || !isset($news->id_news)) {
    echo '<tr>';
    echo'<td align="right" valign="top" width="10%" class="field_name">';
    echo form_label('Category');
    echo '</td>';
    echo '<td>';
    echo form_dropdown('category', $Cname, set_value('category', $news->id_news_category)). '<br>';
    echo '</td></tr>';

    echo '<tr>';
    echo'<td align="right" valign="top" width="10%" class="field_name">';
    echo form_label('Icon');
    echo '</td>';
    echo '<td>';
    $data_news_icon = array(
        'name' => 'news_icon',
        'id' => 'news_icon',
        'value' => $news->news_icon,
        'class' => 'form field',
    );
    echo form_input($data_news_icon);
    echo '</td></tr>';

    echo '<tr>';
    echo'<td align="right" valign="top" width="10%" class="field_name">';
    echo form_label('Nguồn');
    echo '</td>';
    echo '<td>';
    $data_news_source = array(
        'name' => 'source',
        'id' => 'source',
        'value' => $news->source,
        'class' => 'form field',
    );
    echo form_input($data_news_source);
    echo '</td></tr>';
}

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Active');
echo '</td><td width="10%">';
$active_data = array('name' => 'active', 'id' => 'active', 'value' => 'TRUE', 'checked' => $news->active);
echo form_checkbox($active_data);
echo '</td>';
if ((isset($news->id_news) && (trim($news->id_news) !== COMPANY_INSTRODUCE_NEWS_ID) 
		&& trim($news->id_news) !== SERVICES
		&& trim($news->id_news) !== EPKINH
		&& trim($news->id_news) !== WARRANTY
		&& trim($news->id_news) !== SITE_MAP) || !isset($news->id_news)) {
    echo '<td align="left" valign="top" width="10%" class="field_name">';
    echo form_label('Focus');
    
    $focus_data = array('name' => 'focus', 'id' => 'focus', 'value' => 'TRUE');    
    if ($news->focusable === '1'){
        $focus_data['checked'] = 'checked';
    }
    echo form_checkbox($focus_data);
    echo '</td><td></td>';
}
echo '</tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Content');
echo '</td><td colspan ="3">';
echo $this->ckeditor->editor('content', $news->content, $config_mini);
echo '</td><td>';
echo form_error('content');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Meta Title:');
echo '</td><td>';
echo form_input(array('name' => 'meta_title', 'class' => 'form field'), $news->meta_title), '<br>';
echo '</td><td>';
echo form_error('meta_title');
echo '</td></tr>';
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Description:');
echo '</td><td>';
echo form_textarea(array('name' => 'meta_description', 'class' => 'form field', 'cols' => '80', 'rows' => '2'), $news->meta_description), '<br>';
echo '</td><td>';
echo form_error('meta_description');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Keywords');
echo '</td><td>';
echo form_input(array('name' => 'meta_keywords', 'class' => 'form field'), $news->meta_keywords), '<br>';
echo '</td><td>';
echo form_error('meta_keywords');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
if ((isset($news->id_news) && (trim($news->id_news) !== COMPANY_INSTRODUCE_NEWS_ID)
		&& trim($news->id_news) !== SERVICES
		&& trim($news->id_news) !== WARRANTY
		&& trim($news->id_news) !== SITE_MAP) || !isset($news->id_news)) {
    echo form_label('Link Rewrite:');
    echo '</td><td>';
    $data_link_rewrite = array(
        'name' => 'link_rewrite',
        'id' => 'link_rewrite',
        'value' => $news->link_rewrite,
        'class' => 'form field',
    );
    echo form_input($data_link_rewrite);
    echo '</td><td width="40%">';
    echo form_error('link_rewrite');
    echo '</td></tr>';
}
echo '<tr><td></td><td>';
echo form_submit('save', 'Save');
if (isset($news->id_news)) {
    echo form_hidden('news_id', $news->id_news);
}
echo '</td></tr>';
echo '</table>';
echo form_fieldset_close();

echo form_close();

?>