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
function locdau(str) {  
    str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
    str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
    str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
    str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
    str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
    str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
    str= str.replace(/đ/g,"d");  
    str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); 
    /* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
    str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
    str= str.replace(/^\-+|\-+$/g,"");  
    //cắt bỏ ký tự - ở đầu và cuối chuỗi  
    return str;  
}   
function copy2friendlyURL(name)
{
    $('#link_rewrite').val(str2url($(name).val().replace(/^[0-9]+\./, ''), 'UTF-8'));
}
function copy2friendlyURLPhone(producer, model)
{
    $('#link_rewrite').val(str2url($(producer).val().replace(/^[0-9]+\./, '') + ' ' + $(model).val().replace(/^[0-9]+\./, ''), 'UTF-8'));
}
function str2url(str,encoding,ucfirst)
{
    str = str.toUpperCase();
    str = str.toLowerCase();
    str = locdau(str);
    str = str.replace(/[\u0105\u0104\u00E0\u00E1\u00E2\u00E3\u00E4\u00E5]/g,'a');
    str = str.replace(/[\u00E7\u010D\u0107\u0106]/g,'c');
    str = str.replace(/[\u010F]/g,'d');
    str = str.replace(/[\u00E8\u00E9\u00EA\u00EB\u011B\u0119\u0118]/g,'e');
    str = str.replace(/[\u00EC\u00ED\u00EE\u00EF]/g,'i');
    str = str.replace(/[\u0142\u0141]/g,'l');
    str = str.replace(/[\u00F1\u0148]/g,'n');
    str = str.replace(/[\u00F2\u00F3\u00F4\u00F5\u00F6\u00F8\u00D3]/g,'o');
    str = str.replace(/[\u0159]/g,'r');
    str = str.replace(/[\u015B\u015A\u0161]/g,'s');
    str = str.replace(/[\u00DF]/g,'ss');
    str = str.replace(/[\u0165]/g,'t');
    str = str.replace(/[\u00F9\u00FA\u00FB\u00FC\u016F]/g,'u');
    str = str.replace(/[\u00FD\u00FF]/g,'y');
    str = str.replace(/[\u017C\u017A\u017B\u0179\u017E]/g,'z');
    str = str.replace(/[\u00E6]/g,'ae');
    str = str.replace(/[\u0153]/g,'oe');
    str = str.replace(/[\u013E\u013A]/g,'l');
    str = str.replace(/[\u0155]/g,'r');

    str = str.replace(/[^a-z0-9\s\'\:\/\[\]-]/g,'');
    str = str.replace(/[\s\'\:\/\[\]-]+/g,' ');
    str = str.replace(/[ ]/g,'-');
    str = str.replace(/[\/]/g,'-');

    if (ucfirst == 1) {
        c = str.charAt(0);
        str = c.toUpperCase()+str.slice(1);
    }

    return str;
}
function isArrowKey(k_ev)
{
    var unicode=k_ev.keyCode? k_ev.keyCode : k_ev.charCode;
    if (unicode >= 37 && unicode <= 40)
        return true;

}