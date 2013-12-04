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



$(document).ready(function(e)
{		
	Height_Add();
	
	$( ".ProfileTextBox" ).tooltip({
		content: function() {
	        var element = $(this);
			return element.attr("title");			
	    },
    	tooltipClass: "FailTooltip"
	});	
	
	if ($('#dialog-message').length)
	{
		$("#dialog-message").modal({
			overlayId: "dialog-overlay",		
			overlayClose: true,
			closeClass: "DialogCloser",
			onOpen: function (dialog)
			{
				dialog.overlay.fadeIn(300);
				dialog.container.fadeIn(300);
				dialog.data.fadeIn(300);
			},
			onClose: function (dialog) 
			{
				dialog.overlay.fadeOut(300);
				dialog.container.fadeOut(300);
				dialog.data.fadeOut(300);
			}
		});
		
		setTimeout(function(){$.modal.close();}, 3000);
	};		
	
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
	