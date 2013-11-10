// JavaScript Document

/*Функция проверяет высоту рабочей области и при необходимости увеличивает ее для
сохранения целостности узора внизу области*/
function Height_Add()
	{
		var h = parseInt($("#WA").css("height"), 10);
		if ((h % 60) != 0)
		{
			$("#WA").css("height", function()
			{			
				h += 60 - h % 60;
				return h;
			});
		};
	} 

$(document).ready(function(e)
{	
	Height_Add();
		
	/*$("#WA").click(function()
	{		
		document.getElementById("cb").innerHTML += "sgsgohohgo <br>";
		Height_Add();		
	});	*/
});
