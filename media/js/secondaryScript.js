// JavaScript Document

$(document).ready(function () 
{
	$('#menu_datepicker, #Start, #End').datepicker({ 
	firstDay: 1, 
	dateFormat: 'yy-mm-dd'	
	});
	
	$('#menu_datepicker, #Start, #End').mask("9999-99-99");
	
	$('#menu_create_datepicker').datepicker({ 
		firstDay: 1, 
		dateFormat: "yy-mm-dd"	
		});
	
	$('#menu_create_datepicker').mask("9999-99-99");
	
	/*$('#menu_create_datepicker').datepicker({ 
		firstDay: 1, 
		dateFormat: "dd.mm.yy"	
		});
		
	$('#menu_create_datepicker').mask("99.99.9999");*/
	
	$("#ui-datepicker-div").hide();
	
	$('th:first').click();
	
	//$('.CustSelect').customSelect();
	//$('.CustNumber').spinner();
});

function sort(el)
{	
	   var col_sort = el.innerHTML; 
	   var tr = el.parentNode;
	   var table = tr.parentNode;    
	   var th;
	   var col_sort_num;
	   //var arrow;
	   
		for (var i=0; (th = tr.getElementsByTagName("th").item(i)); i++)
		{
		   	if (th.innerHTML == col_sort) 
		   	{
		        col_sort_num = i; 
		        if (th.prevsort == "y")
		        {
		            //arrow = td.firstChild;
		            el.up = Number(!el.up);
		        }
		        else
		        {
		            th.prevsort = "y";
		            //arrow = td.insertBefore(document.createElement("span"),td.firstChild);
		            el.up = 0;
		        }
		        //arrow.innerHTML = el.up?"↑ ":"↓ ";
		    }
		   	else
		   	{
		        if (th.prevsort == "y")
		        {
		            th.prevsort = "n";
		            //if (td.firstChild) td.removeChild(td.firstChild);
		        }
		    }
	    }
		 
		var a = new Array();		
		 
	    for(i=1; i < table.rows.length; i++) 
	    {
		 	a[i-1] = new Array();
		 	a[i-1][0]=table.rows[i].getElementsByTagName("td").item(col_sort_num).innerHTML;
			a[i-1][1]=table.rows[i];			
		}		 
		
	    a.sort();
		
		if(el.up) a.reverse();	 
		 
		for(i=0; i < a.length; i++)
		table.appendChild(a[i][1]);
}