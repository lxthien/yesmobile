// JavaScript Document
function clearList(obj)
{
	var browser=navigator.appName;
	if(browser=="Netscape")
	{
		obj.options.length = 0;
	}
	else
	{
		for(s=obj.length-1;s >= 0;s--)
		  	obj.remove(s);
	}
}

function display_select(x,y)
{
	var Index, Text, Value
	var pTitle, cTitle, hTitle

	if(y==1)
	{
		if(x==2)
		{
			pTitle = document.frmSearch.cboCountry
			cTitle = document.frmSearch.cboProvince
			hTitle = document.frmSearch.hidden_country
		}
		else
		{
			if(x==1)
			{
				pTitle = document.frmSearch.cboProvince
				cTitle = document.frmSearch.cboDistrict
				hTitle = document.frmSearch.hidden_province
			}
			else
			{
				pTitle = document.frmSearch.cboDistrict
				cTitle = document.frmSearch.cboWard
				hTitle = document.frmSearch.hidden_district
			}
		}
	}
	else
	{
		if(x==2)
		{
			pTitle = document.formDK.cboCountry
			cTitle = document.formDK.cboProvince
			hTitle = document.formDK.hidden_country
		}
		else
		{
			if(x==1)
			{
				pTitle = document.formDK.cboProvince
				cTitle = document.formDK.cboDistrict
				hTitle = document.formDK.hidden_province
			}
			else
			{
				pTitle = document.formDK.cboDistrict
				cTitle = document.formDK.cboWard
				hTitle = document.formDK.hidden_district
			}
		}
	}
	Index = pTitle.selectedIndex
	Text = pTitle.options[Index].text
	Value = pTitle.options[Index].value

	cTitle.options.length=0;
	if(Value != "")
	{
		for(i=0 ; i<hTitle.length ; i++)
		{
			if(pTitle.options[pTitle.selectedIndex].value == hTitle.options[i].value)
			{
				var strTemp = new String(hTitle[i].text);
				vaTemp = strTemp.split("~");
				
				NewOptItem = new Option(vaTemp[1],vaTemp[0]);
				j = cTitle.length;
				cTitle.options[j] = NewOptItem;
				NewOptItem = null;
			}
		}
		cTitle.focus();
	}
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
	return false;
}

function openAE(dest)
{
	window.location.href = dest;
	return true;
}

function isEmpty(s)
{
	if(s=="") return false;
	if(s.length==0) return false;
	for(var j=0;j<s.length;j++)
		if(s.charAt(j)!=" ") return true;

	return false;
}

function isCurrency(sText)
{
	var ValidChars = "0123456789,.";
	var isCurrency=true;
	var Char;
	
	for (i = 0; i < sText.length && isCurrency == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			isCurrency = false;
		}
	}
	return isCurrency;
}

function isNumber(sText)
{
   var ValidChars = "0123456789";
   var IsNumber=true;
   var Char;

   for (i = 0; i < sText.length && IsNumber == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsNumber = false;
         }
      }
   return IsNumber;
}

function isPhone(sText)
{
	var ValidChars = "0123456789+()- ";
	var IsPhone=true;
	var Char;
	
	for (i = 0; i < sText.length && IsPhone == true; i++) 
	{ 
		Char = sText.charAt(i); 
		if (ValidChars.indexOf(Char) == -1) 
		{
			IsPhone = false;
		}
	}
	return IsPhone;
}

function isString(sText)
{
   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-+#@!$%^=.";
   var IsString=true;
   var Char;

   for (i = 0; i < sText.length && IsString == true; i++) 
      { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         {
         IsString = false;
         }
      }
   return IsString;
}

function isEmail(s)
{
	if(s=="") return true;
	if(s.indexOf(" ")>0) return false;	//email co khoang trang
	if(s.indexOf("@")==-1) return false;	//email khong co dau @
	if(s.indexOf(".")==-1) return false;	//email khong co dau '.'
	if(s.indexOf("..")!=-1) return false;	//email co 2 dau '..' lien tiep
	if(s.indexOf("@")!=s.lastIndexOf("@")) return false;	//email co 2 dau '@'
	if(s.lastIndexOf(".")==s.length-1) return false;	//email co dau '.' cuoi chuoi
	var str="0123456789abcdefghijklmnopqrstuvwxyz+-*&^$#`~=@._";	//email khong thuoc cac ky tu trong str
	for(var j=0;j<s.length;j++)
		if(str.indexOf(s.charAt(j))==-1) return false;
		
	return true;
}

function isWebsite(url)
{
     return url.match(/^www.[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function isLeapYear(nam)
{
	return ((nam % 4 == 0) && (nam % 100 != 0)) || (nam % 400 == 0);
}

function isDate(ngay,thang,nam)
{
	if(ngay=="" || thang=="" || nam=="") return false;
	var songay;
	switch (Number(thang))
	{
		case 1:
		case 3:
		case 5:
		case 7:
		case 8:
		case 10:
		case 12:
			songay=31;
			break;
		case 4:
		case 6:
		case 9:
		case 11:
			songay=30;
			break;
		case 2:
			if (isLeapYear(nam))
				songay=29;
			else
				songay=28;
			break;
	}
	if(ngay > songay) return false;
	return true;
}

function trim(str)
{
	return str.replace( /^\s*/, '').replace( /\s*$/, '' );
}

function panelSelectImage(form)
{
	var sList = window.open("library/ImageSelect.php?form="+form, "newImage", "top=100,left=100,height=410,width=570,scrollbars=no");
}

function SelectImage(form)
{
	var sList = window.open("admin/library/SelectImage.php?form="+form, "newImage", "top=100,left=100,height=410,width=570,scrollbars=no");
}

function panelSelectFile(form)
{
	var sList = window.open("library/FileSelect.php?form="+form, "newFile", "top=100,left=100,height=410,width=570,scrollbars=no");
}

function CheckUserAdmin(f)
{
	var element = document.getElementById(f);
	if (!isEmpty(element.value))
	{
		alert("Vui lòng nhập vào thông tin cần kiểm tra");
		element.focus();
		return false;
	}
	window.open("library/CheckUser.php?form="+f, "Check", "top=350,left=300,height=70,width=350,scrollbars=no");
}

function CheckAdmin(f)
{
	var browser=navigator.appName;
	if(browser=="Netscape")
	{
		var element = document.formDK.Username.value;
		if (!isEmpty(element))
		{
			alert("Please input data to check.");
			document.formDK.Username.focus();
			return false;
		}
	}
	else
	{
		var element = document.getElementById(f);
		if (!isEmpty(element.value))
		{
			alert("Please input data to check");
			element.focus();
			return false;
		}
	}
	window.open("CheckUser.php?form="+f, "Check", "top=350,left=300,height=70,width=350,scrollbars=no");
}

function openAdvertise(f)
{
	window.open(f, "Advertise");
}