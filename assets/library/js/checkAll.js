function checkAll(ref)
{
	var items = document.getElementsByName('chkFunction[]');
	var len = items.length;
	
	if(ref==1)
	{
		for ( i=0; i < len; i++ )
			items[i].checked = true;
	}
	else
	{
		for ( i=0; i < len; i++ )
			items[i].checked = false;		
	}
}

function checkAllFields(ref)
{
var chkAll = document.getElementById('checkAll');
var checks = document.getElementsByName('delAnn[]');
var removeHidden = document.getElementById('removeChecked');
var boxLength = checks.length;
var allChecked = false;
var totalChecked = 0;

if ( ref == 1 )
{
	if ( chkAll.checked == true )
	{
		for ( i=0; i < boxLength; i++ )
		checks[i].checked = true;
	}
	else
	{
		for ( i=0; i < boxLength; i++ )
			checks[i].checked = false;
	}
}
else
{
	for ( i=0; i < boxLength; i++ )
	{
		if ( checks[i].checked == true )
		{
			allChecked = true;
			continue;
		}
		else
		{
			allChecked = false;
			break;
		}
	}
	if ( allChecked == true )
		chkAll.checked = true;
	else
		chkAll.checked = false;
}
for ( j=0; j < boxLength; j++ )
{
	if ( checks[j].checked == true )
		totalChecked++;
}

removeHidden.value = totalChecked;

}