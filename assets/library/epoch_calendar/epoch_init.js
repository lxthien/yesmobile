// JavaScript Document
//var bas_cal;
//var ms_cal;
var dp_cal1,dp_cal2;

window.onload = function()
{
//	dp_cal  = new Epoch('epoch_popup','flat',document.getElementById('popup_date'));
//	bas_cal = new Epoch('epoch_basic','flat',document.getElementById('basic_container'));
//	ms_cal  = new Epoch('epoch_multi','flat',document.getElementById('multi_container'),true);
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('popup_container1'));
	dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('popup_container2'));
};