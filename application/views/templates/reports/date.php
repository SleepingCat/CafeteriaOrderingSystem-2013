<script type="text/javascript">
    $(document).ready(function () {
        $('#Start').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
        $('#End').datepicker({ firstDay: 1, dateFormat: 'yy-mm-dd' });
    });
</script>

<form class = "Reports "action="" method="post">	

<p align="center"><?php  echo $Rep.":"?></p>
<table border=1px cellspacing="0" >
<td align="center" width="250" height="250">
Выберите начало периода:	
<div class="Start"> <input type="text" name="Start" id="Start"> </div>

Выберите конец периода:	
<div class="End">   <input type="text" name="End" id="End"> </div>

<div class="Subm">  <input type="submit" name="subm" id="subm" value="OK"> </div>

<p align="center"><?php  echo $error ?></p>
</td>	
</table>	
					
				
</form>