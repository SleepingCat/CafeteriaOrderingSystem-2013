<?php defined('SYSPATH') or die('No direct script access.');?>
<!DOCTYPE HTML> 
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $title;?></title>		
		<? foreach ($styles as $style => $media) echo HTML::style($style, array('media'=>$media), NULL, TRUE), "\n"?>
		<? foreach ($scripts as $script) echo HTML::script($script, NULL, NULL, TRUE), "\n"?> 
	</head>
	
	
<body>
<div class="MainArea">
<header>
	<?php echo HTML::image('media/image/Template/Logo.png', array('class' => 'Logo')); ?>	
</header>

<div class="MainPanel">
<?php echo HTML::image('media/image/Template/MainPanelUpperLeft.png', array('class' => 'UpperFlag')); ?> 
<?php echo HTML::image('media/image/Template/MainPanelUpperRight.png', array('class' => 'UpperFlag UpperFlagRight')); ?> 

<!-- Кнопки главной панели  --> 
<?php if( $guest != "Гость")    
  {?>  
<nav>
	<ul class="MainMenu">
		<?php 		    
		 echo $main_menu;    
		?>     		
	</ul>
</nav>
  <?}?>
</div>


<div class="WorkArea" id="WA">
<div class="WorkAreaImage">

<div class="LeftBlock">
	<ul class="LeftMenu">	
	<?php 
	 echo $menu;
	?>
	</ul>   
</div>

<div class="CentralBlock">
    <?php if ($message <> "") echo $message;
    echo $content; ?>
</div>
    
<div class="RightBlock">
    <?php echo $user; ?>
</div>
 
</div>
</div>


<footer>
Контактная информация
</footer>
</div>
</body>
</html>