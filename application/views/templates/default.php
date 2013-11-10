<?php defined('SYSPATH') or die('No direct script access.');?>

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
<?php echo HTML::image('media/image/Template/MainPanelUpper.png', array('class' => 'UpperFlag')); ?> 
<!-- Кнопки главной панели 
<?php if( $guest == "Гость")    
  {?>    	
   <a href="<?php echo URL::site() ?>" class="MainPanelButton LeftButton"> <?php echo __('Реклама') ?>
   </a><a href="<?php echo URL::site() ?>" class="MainPanelButton"> <?php echo __('Новости') ?>
   </a><a href="<?php echo URL::site() ?>" class="MainPanelButton"> <?php echo __('Контактные данные') ?></a> 
  <?}
    ?>
    
<?php $ind = 0;
 foreach ($menu as $item) : 
 $ind += 1;?><a href="<?php echo URL::site($item['name'])?>" class="MainPanelButton
  	<?php if($ind == 1)
  		echo ' LeftButton';
  	if($item['name'] == $_SERVER['REQUEST_URI'])
		echo ' ActiveButton';?>
	"><?php echo ($item['name_link'])?></a><?php endforeach; ?>    
  -->
</div>


<div class="WorkArea" id="WA">
<div class="WorkAreaImage">

<div class="LeftBlock">
    Дополнительные данные
</div>
    
<div class="CentralBlock">
    <?php echo $content; ?>
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