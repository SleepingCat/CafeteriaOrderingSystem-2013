// JavaScript Document

var checkboxHeight = "25";
var radioHeight = "25";
var selectWidth = "190";

document.write('<style type="text/css">input.styled { display: none; } select.styled { position: relative; width: ' + selectWidth + 'px; opacity: 0; filter: alpha(opacity=0); z-index: 5; } .disabled { opacity: 0.5; filter: alpha(opacity=50); }</style>');

$(document).ready(function(e)
{	
	var inputs = document.getElementsByTagName("input");
	var span = Array();
	var element;
		
	for(a = 0; a < inputs.length; a++)
	{
		if((inputs[a].type == "checkbox") && inputs[a].className.indexOf("styled") > -1)
		{
			span[a] = document.createElement("span");
			span[a].className = inputs[a].type;
			
			if(inputs[a].checked == true)
			{
				if(inputs[a].type == "checkbox")
				{
					position = "0 -" + (checkboxHeight*2) + "px";
					span[a].style.backgroundPosition = position;
				}
			}
			inputs[a].parentNode.insertBefore(span[a], inputs[a]);
			$(inputs[a]).change(function(e) 
			{
               	inputs = document.getElementsByTagName("input");
				for(var b = 0; b < inputs.length; b++)
				{
					if(inputs[b].type == "checkbox" && inputs[b].checked == true && inputs[b].className.indexOf("styled") > -1)
					{
						inputs[b].previousSibling.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";
					}
					else if(inputs[b].type == "checkbox" && inputs[b].className.indexOf("styled") > -1)
					{
						inputs[b].previousSibling.style.backgroundPosition = "0 0";
					}							
				}
			});					
				
		}			
	}
	
	$(".checkbox").mousedown(function(e) 
	{
        element = this.nextSibling; 
		if(element.checked == true && element.type == "checkbox") 
		{
			this.style.backgroundPosition = "0 -" + checkboxHeight*3 + "px";
		} 		
		else if(element.checked != true && element.type == "checkbox") 
		{
			this.style.backgroundPosition = "0 -" + checkboxHeight + "px";
		} 		
    });
	
	$(".checkbox").mouseup(function(e) 
	{
        element = this.nextSibling; 
		if(element.checked == true && element.type == "checkbox") 
		{
			this.style.backgroundPosition = "0 0";
			element.checked = false;
		} 
		else 
		{
			this.style.backgroundPosition = "0 -" + checkboxHeight*2 + "px";			
			element.checked = true;
		}
    });
	
});