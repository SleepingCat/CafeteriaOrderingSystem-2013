// JavaScript Document

$(document).ready(function () 
{
	$('#menu_datepicker, #Start, #End').datepicker({ 
	firstDay: 1, 
	dateFormat: 'yy-mm-dd'	
	});
	
	$('#menu_datepicker, #Start, #End').mask("9999-99-99");
});
