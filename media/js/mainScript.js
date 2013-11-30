// JavaScript Document

var LeftMenuHeaders;
var jsonHeaders;

$(window).before(function() 
{
	$(".MainPanelButton, .LeftMenuHeader span, .UserHeaderArea").pxgradient({ 
		step: 2, 
		colors: ["#C1AC51","#FFFDDE", "#C1AC51"],
		dir: "y" 
	});		
});

$( document ).tooltip({
	content: function() {
        var element = $(this);
        return element.attr("title");
    }
});	

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
	});
	
	//$( "#dialog-message" ).dialog();
	
	LeftMenuHeaders = JSON.parse($.cookie("MenuHeaders"));
	$.cookie("MenuHeaders", null, {path: '/'});
	$( ".LeftMenuHeader" ).each(function(i)
	{		
		if (LeftMenuHeaders[i] == true)
		{
			$(this).next().show();
			$(this).children("div").attr("class", "TriangleOpened");
		}
		else
		{
			$(this).next().hide();
			$(this).children("div").attr("class", "TriangleClosed");
		}
	});	
});

$(window).bind('beforeunload', function()
{	
	LeftMenuHeaders = new Array();
	$( ".LeftMenuHeader" ).each(function(i)
	{
    	LeftMenuHeaders[i] = $(this).next().is(":visible");								
	});		
	jsonHeaders = JSON.stringify(LeftMenuHeaders);
	$.cookie("MenuHeaders", jsonHeaders, {path: '/'});
});


/*Функция проверяет высоту рабочей области и при необходимости увеличивает ее для
сохранения целостности узора внизу области*/
function Height_Add()
	{
		var h = $("#WA").height();
		//alert(h);						
		if ((h % 60) != 0)
		{
			$("#WA").css("height", function()
			{				
				h += 60 - h % 60;				
				return h;
			});
		};		
	}
	