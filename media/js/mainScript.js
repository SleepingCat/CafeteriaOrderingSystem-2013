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
	$(".MainPanelMenu").menu();	
	$(".MainPanelMenu").hide();	
	
	$(".MainPanelButton").mouseenter(function(e) 
	{	
		$(".MainPanelMenu").stop(false, true);
		$(this).parent(".MainPanelItem").mouseenter();
    });	
	
	$(".MainPanelItem").mouseenter(function(e)
	{		
		var idd = $(this).attr("id");		
		runEffect(idd);
		return false;
	});
	
	$(".MainPanelItem").mouseleave(function(e)
	{		
		$(".MainPanelMenu").stop(false, true);				
		var idd = $(this).attr("id");				
		callback(idd);						
		return false;	
	});
	
	$(".NavLink").click(function(e) 
	{
        $(".MainPanelMenu").hide();
    });	
	
});

// Запуск эффекта появления
function runEffect(id) 
{
  // get effect type from
  var selectedEffect = "slide";
 
  // most effect types need no options passed by default
  var options = {direction: "up"};
  // some effects have required parameters
  if ( selectedEffect === "scale" ) {
    options = { percent: 100 };
  } else if ( selectedEffect === "size" ) {
    options = { to: { width: 280, height: 185 } };
  }

  // run the effect
	$("#"+id).children(".MainPanelMenu").show( selectedEffect, options, 500);	
};	 

// Запуск эффекта исчезновения
function callback(id)
{
  // get effect type from
  var selectedEffect = "slide";
 
  // most effect types need no options passed by default
  var options = {direction: "up"};
  // some effects have required parameters
  if ( selectedEffect === "scale" ) {
    options = { percent: 100 };
  } else if ( selectedEffect === "size" ) {
    options = { to: { width: 280, height: 185 } };
  }
 
  // run the effect
  $("#"+id).children( ".MainPanelMenu").hide( selectedEffect, options, 500 );  
};