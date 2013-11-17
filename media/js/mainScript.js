// JavaScript Document

$(document).ready(function(e)
{	
	Height_Add();
	
	$( ".LeftMenuHeader" ).click(function()
	{
		$(this).next().toggle(); 
		if ($(this).next().is(":visible"))
		{
			$(this).children("div").attr("class", "TriangleOpened");
		}
		else
		{
			$(this).children("div").attr("class", "TriangleClosed");
		}		
		return false;		
	}).next().hide();	
	
	$(".MainPanelButton").pxgradient({ 
	  step: 2, 
	  colors: ["#C1AC51","#FFFDDE","#C1AC51"],
	  dir: "y" 
	});
	
	$(".LeftMenuHeader span").pxgradient({ 
	  step: 2, 
	  colors: ["#C1AC51","#FFFDDE", "#C1AC51"],
	  dir: "y" 
	});		
	
});

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
