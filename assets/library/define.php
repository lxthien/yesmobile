<?php
	$config['date'] = '%b %d, %Y';
	$config['time'] = '%T';
	$config['datetime'] = '%A, %B %d, %Y - %T %p';
	$config['en_short_date'] = '%m/%d/%Y';
	$config['en_short_datetime'] = '%m/%d/%Y %T';
	$config['vn_short_date'] = '%d/%m/%Y';
	$config['vn_short_datetime'] = '%d/%m/%Y %T';

	$sql = "select * from configuration where isAdmin=1 order by param";
	$configuration = GetArray($sql);
	
	$sql = "select * from warning_message where isAdmin=1 order by param";
	$warning_message = GetArray($sql);

	$lang = admin_langNavigate();
	$recordset_limit = getParam($configuration, 'ADMIN_RECORDSET_LIMIT', 'value');
	$BACKGROUND_COLOR_1 = getParam($configuration, 'BACKGROUND_COLOR_1', 'value');
	$BACKGROUND_COLOR_2 = getParam($configuration, 'BACKGROUND_COLOR_2', 'value');
	
	$title = getParam($warning_message, 'ADMIN_TITLE_OF_WEBSITE', $lang . '_value');
	$copyright = getParam($warning_message, 'ADMIN_COPYRIGHT', $lang . '_value');

	$page = admin_pageNavigate();
	$smarty->assign("title", $title);
	$smarty->assign("page", $page);
	$smarty->assign("lang", $lang);
	$smarty->assign("copyright",$copyright);
?>