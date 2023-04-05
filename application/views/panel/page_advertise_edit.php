<?php

$con_link = base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2);
echo form_open_multipart($con_link . '/save');
if (isset($error)) {
    echo form_label($error);
}
echo form_fieldset('Advertise:');
echo '<table width="80%" border="0" cellspacing="0" cellpadding="5" align="left">';
    echo '<tr>';
    echo'<td align="right" valign="top" width="10%" class="field_name">';
    echo form_label('Position');
    echo '</td>';
    echo '<td>';
//    form_dr
    //echo form_dropdown('position_id', $position_names, set_value('position_id', $new_item->position_id), array('style' => 'border:1px solid #F6BA00')), '<br>';
    $data_position = array(
    		'name' => 'position',
    		'id' => 'position_id',
    		'value' => $new_item->position_id,
    		'class' => 'form field',
    		'readonly' => 'readonly'
    );
    echo form_input($data_position);
    echo '</td></tr>';
    echo '<tr><td align="right" valign="top" width="10%" class="field_name">';

echo form_label('Name:');
echo '</td><td width="29%">';
$data_company = array(
    'name' => 'company',
    'id' => 'company',
    'value' => $new_item->company,
    'class' => 'form field',
//    'onchange' => "copy2friendlyURL('#name');",
//    'onkeyup' => "if (isArrowKey(event)) return; copy2friendlyURL('#name');"
);
echo form_input($data_company);
echo '</td></tr>';

//echo '<tr>';
//echo'<td align="right" valign="top" width="10%" class="field_name">';
//echo form_label('Category');
//echo '</td>';
//echo '<td>';
////    form_dr
//echo form_dropdown('category', $Cname, set_value('category', $new_item->category_id), array('style' => 'border:1px solid #F6BA00')), '<br>';
//echo '</td></tr>';
//    echo '<tr>';
//    echo'<td align="right" valign="top" width="10%" class="field_name">';
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
////echo $new_item->logo;
//echo '<td></td></tr>';
//if (!isset($new_item->id) || strlen($new_item->id) === 0) {
//    just show upload fill in case create new 
echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Logo');
echo '</td><td>';
if (strlen($new_item->logo) > 0) {
    echo '<div class="picdoitac"><div class="opacity30"><img src="' . base_url(PARTNER_LOGO . '/ads/' . $new_item->logo) . '"></div></div>
';
}
//echo '</td><td>';
$data_upload = array('name' => 'logo',
    'id' => 'logo',
    'class' => 'form field');
echo form_upload($data_upload);
//$text=array('name'=>'content',
//            'rows'=>'5',
//            'colums'=>'10'
//        );
//echo form_textarea($text,$news['content']),'<br>';
echo '</td>';
echo '</tr>';
//}
//echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
//echo form_label('Meta Title:');
//echo '</td><td>';
//echo form_input(array('name'=>'meta_title','class'=>'form field'), $new_item->meta_title), '<br>';
//echo '</td><td>';
//echo form_error('meta_title');
//echo '</td></tr>';
//echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
//echo form_label('Description:');
//echo '</td><td>';
//echo form_textarea(array('name' => 'description', 'class' => 'form field', 'cols' => '80', 'rows' => '2'), $new_item->description), '<br>';
//echo '</td><td>';
//echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
//echo form_label('Meta description:');
//echo '</td><td>';
//echo form_textarea(array('name'=>'meta_description','class'=>'form field','cols'=>'80', 'rows' =>'2'), $new_item->meta_description), '<br>';
//echo '</td><td>';
//echo form_error('meta_description');
//echo '</td></tr>';
//echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
//echo form_label('Keywords');
//echo '</td><td>';
//echo form_input(array('name'=>'meta_keywords','class'=>'form field'), $new_item->meta_keywords), '<br>';
//echo '</td><td>';
//echo form_error('meta_keywords');
//echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Link:');
echo '</td><td>';
$data_url = array(
    'name' => 'url',
    'id' => 'url',
    'value' => $new_item->url,
    'class' => 'form field',
);
echo form_input($data_url);
echo '</td><td width="40%">';
echo form_error('url');
echo '</td></tr>';

echo '<tr><td align="right" valign="top" width="10%" class="field_name">';
echo form_label('Active');
echo '</td><td width="10%">';
$active_data = array('name' => 'active', 'id' => 'active', 'value' => 'TRUE', 'checked' => $new_item->active);
echo form_checkbox($active_data);
echo '</td>';
echo '</tr>';

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
