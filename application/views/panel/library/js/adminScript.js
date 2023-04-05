// JavaScript Document
function openAE(dest)
{
	window.location.href = dest;
	return true;
}

function checkASSIGNFUNC()
{
	var checks = document.getElementsByName('chkFunction[]');
	var boxLength = checks.length;
	var Checked = false;

	for ( i=0; i < boxLength; i++ )
	{
		if ( checks[i].checked == true )
		{
			Checked = true;
			break;
		}
		else continue;
	}
	if ( Checked == true )
	{
		combineCheck('chkFunction[]','txtFuncOrder[]', '_');
		document.formDK.submit();
	}
	else
		alert("Please select at least one function to add");
	return false;
}

function combineCheck(obj1, obj2, sep)
{
	var obj1 = document.getElementsByName(obj1);
	var obj2 = document.getElementsByName(obj2);
	var boxLength = obj1.length;
	for ( i=0; i < boxLength; i++ )
	{
		if ( obj1[i].checked == true )
		{
			obj1[i].value = obj1[i].value + sep + obj2[i].value;
		}
	}
}

function combineValue(obj1, obj2, sep, result)
{
	var obj1 = document.getElementsByName(obj1);
	var obj2 = document.getElementsByName(obj2);
	var res = document.getElementsByName(result);
	var boxLength = obj1.length;
	for ( i=0; i < boxLength; i++ )
	{
		res[i].value = obj1[i].value + sep + obj2[i].value;
	}
}

function checkConfig()
{
	var checks = document.getElementsByName('txtValue[]');
	var boxLength = checks.length;
	for ( i=0; i < boxLength; i++ )
	{
		if(!isEmpty(checks[i].value))
		{
			alert("Invalid value. Please set value of param.");
			checks[i].focus();
			return false;
		}
	}
	combineValue('txtParam[]','txtValue[]','@','hidValue[]');
	document.formDK.submit();
}

function checkWarningMessage()
{
	var vn = document.getElementsByName('vnValue[]');
	var en = document.getElementsByName('enValue[]');
	var boxLength = vn.length;
	for ( i=0; i < boxLength; i++ )
	{
		if(!isEmpty(vn[i].value))
		{
			alert("Invalid value. Please set value of param.");
			vn[i].focus();
			return false;
		}
		if(!isEmpty(en[i].value))
		{
			alert("Invalid value. Please set value of param.");
			en[i].focus();
			return false;
		}
	}
	document.formDK.submit();
}

function Confirmation(x)
{
	var f = document.getElementById('removeChecked');
	if(f.value>0)
	{
		var conf=confirm(x);
		if(conf)
			document.frmList.submit();
		else
			return false;
	}
	else alert("Please select at least one record to delete");
	return false;
}

function checkLoginIndex()
{
	if(!isEmpty(document.formDK.Username.value))
	{
		alert("Invalid Username. Please enter Username.");
		document.formDK.Username.focus();
		return false;
	}
	if(!isEmpty(document.formDK.Password.value))
	{
		alert("Invalid Password. Please enter your Password.");
		document.formDK.Password.focus();
		return false;
	}
	document.formDK.submit();	
}

function checkInternalPage()
{
	if(!isEmpty(document.formDK.PageCode.value))
	{
		alert("Invalid PageCode. Please enter PageCode for this page.");
		document.formDK.PageCode.focus();
		return false;
	}
	document.formDK.submit();	
}

function checkMenuType()
{
	if(!isEmpty(document.formDK.vnTypeName.value))
	{
		alert("Invalid Vietnamese Title. Please enter Vietnamese Title of Menu type.");
		document.formDK.vnTypeName.focus();
		return false;
	}
	if(!isEmpty(document.formDK.enTypeName.value))
	{
		alert("Invalid English Title. Please enter English Title of Menu type.");
		document.formDK.enTypeName.focus();
		return false;
	}
	document.formDK.submit();	
}

function checkMenuItem()
{
	if(!isEmpty(document.formDK.vnTitle.value))
	{
		alert("Invalid Vietnamese Title. Please enter Vietnamese Title of Menu item.");
		document.formDK.vnTitle.focus();
		return false;
	}
	if(!isEmpty(document.formDK.enTitle.value))
	{
		alert("Invalid English Title. Please enter English Title of Menu item.");
		document.formDK.enTitle.focus();
		return false;
	}
	document.formDK.submit();	
}
function checkMenuCategory()
{
	if(!isEmpty(document.formDK.vnTitle.value))
	{
		alert("Invalid Vietnamese Title. Please enter Vietnamese Title of Menu category.");
		document.formDK.vnTitle.focus();
		return false;
	}
	if(!isEmpty(document.formDK.enTitle.value))
	{
		alert("Invalid English Title. Please enter English Title of Menu category.");
		document.formDK.enTitle.focus();
		return false;
	}
	document.formDK.submit();	
}
function checkNewsCategory()
{
	if(!isEmpty(document.formDK.vnTitle.value))
	{
		alert("Invalid Vietnamese Title. Please enter Vietnamese Title of News Category.");
		document.formDK.vnTitle.focus();
		return false;
	}
	if(!isEmpty(document.formDK.enTitle.value))
	{
		alert("Invalid English Title. Please enter English Title of News Category.");
		document.formDK.enTitle.focus();
		return false;
	}
	
	document.formDK.submit();	
}

function checkTopic()
{
	if(!isEmpty(document.formDK.vnTitle.value))
	{
		alert("Invalid Vietnamese Title. Please enter Vietnamese Title of News Category.");
		document.formDK.vnTitle.focus();
		return false;
	}
	if(!isEmpty(document.formDK.enTitle.value))
	{
		alert("Invalid English Title. Please enter English Title of News Category.");
		document.formDK.enTitle.focus();
		return false;
	}
	document.formDK.submit();	
}

function checkChangePSW()
{
	if(!isEmpty(document.formDK.CurrentPSW.value))
	{
		alert("Invalid password. Please enter current password.");
		document.formDK.CurrentPSW.focus();
		return false;
	}

	if(!isEmpty(document.formDK.Password.value) || !isEmpty(document.formDK.Retype.value))
	{
		alert("Invalid password. Please retype your new password.");
		document.formDK.Password.focus();
		return false;
	}

	if(isEmpty(document.formDK.Password.value))
	{
		if(document.formDK.Password.value != document.formDK.Retype.value)
		{
			alert("Invalid password. Please retype your password");
			document.formDK.Retype.focus();
			return false;
		}
	}
	document.formDK.submit();
}

function checkAdmin()
{
	if(!isEmpty(document.formDK.Username.value))
	{
		alert("Invalid Username. Please enter Username.");
		document.formDK.Username.focus();
		return false;
	}

	if(isEmpty(document.formDK.Password.value))
	{
		if(document.formDK.Password.value != document.formDK.Retype.value)
		{
			alert("Invalid password. Please retype your password");
			document.formDK.Retype.focus();
			return false;
		}
	}

	if(!isEmpty(document.formDK.Fullname.value))
	{
		alert("Invalid Fullname. Please enter your Fullname.");
		document.formDK.Fullname.focus();
		return false;
	}

	if(isEmpty(document.formDK.Email.value))
	{
		if(!isEmail(document.formDK.Email.value))
		{
			alert("Invalid Email. Please retype your Email.");
			document.formDK.Email.focus();
			return false;
		}
	}
	document.formDK.submit();
}

function checkFunc()
{
	if(!isEmpty(document.formDK.PageName.value))
	{
		alert("Invalid function. Please enter the name of function.");
		document.formDK.PageName.focus();
		return false;
	}
	if(!isEmpty(document.formDK.Link.value))
	{
		alert("Invalid link. Please enter the link of function.");
		document.formDK.Link.focus();
		return false;
	}
	document.formDK.submit();
}