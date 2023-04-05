<?php
function admin_logged_in()
{
	if(session_is_registered("admin_suid") || $_SESSION['admin_suid'] > 0)
	{
		Redirect_Rel("index.php");
		exit;
	}
}

function admin_checkLogin()
{
	if(!session_is_registered("admin_suid") || $_SESSION['admin_suid'] == -1)
	{
		Redirect_Rel("index.php");
		exit;
	}
}

function admin_getLoginInfo()
{
	if(session_is_registered("admin_sfullname"))
	{
		if($_SESSION['admin_sfullname'] == "") $name = $_SESSION['admin_susername'];
		else $name = $_SESSION['admin_sfullname'];
	}
	else $name="";
	return $name;
}

function admin_langNavigate()
{
	if(session_is_registered("admin_lang"))
	{
		if($_SESSION['admin_lang'] != "") $lang = $_SESSION['admin_lang'];
		else $lang = "vn";
	}
	else $lang="";
	return $lang;	
}

function admin_pageNavigate()
{
	if(session_is_registered("admin_page"))
	{
		if($_SESSION['admin_page'] != "") $page = $_SESSION['admin_page'];
		else $page = "index";
	}
	else $page="";
	return $page;	
}

function checkPermission()
{
	$trang=getPage(); $array = explode("." , $trang);
	if(strtolower(substr($array[0],-2)) == 'ae') $array[0] = substr($array[0],0, strlen($array[0])-2);
	elseif(strtolower(substr($array[0],-7))=='_action') $array[0] = substr($array[0],0, strlen($array[0])-7);
	$trang = implode('.', $array);

	$admin_id = $_SESSION['admin_suid'];
	$sql = "select * from func as a left join assignfunc as b on a.Stt=b.FuncID where a.Link='$trang' and b.UserID='$admin_id'";
	$result = GetArray($sql);
	if(count($result)==0)
	{
		Redirect_Rel("home.php");
		exit();
	}
}

function title()
{
	$trang=getPage();
	switch ($trang)
	{
		case "home.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>W</font>elcome ::";
			break;
		case "admin.php":
		case "adminae.php":
		case "admin_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>A</font>dministrators ::";
			break;
		case "func.php":
		case "funcae.php":
		case "func_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>F</font>unction List ::";
			break;
		case "assignfunc.php":
		case "assignfuncae.php":
		case "assignfunc_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>A</font>ssign Functions to User ::";
			break;
		case "config.php":
		case "config_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>C</font>onfiguration ::";
			break;
		case "warning_message.php":
		case "warning_message_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>W</font>arning Message ::";
			break;
		case "internal_page.php":
		case "internal_pageae.php":
		case "internal_page_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>I</font>nternal Page ::";
			break;
		case "news_category.php":
		case "news_categoryae.php":
		case "news_category_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>N</font>ews Category ::";
			break;
		case "topic.php":
		case "topicae.php":
		case "topic_action.php":
			$text = ":: <font style='font-weight:800; font-size:24px'>T</font>opic ::";
			break;
	}
	return $text;
}



?>