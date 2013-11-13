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
<?php echo HTML::image('media/image/Template/MainPanelUpperLeft.png', array('class' => 'UpperFlag')); ?> 
<?php echo HTML::image('media/image/Template/MainPanelUpperRight.png', array('class' => 'UpperFlag UpperFlagRight')); ?> 
<!-- Кнопки главной панели  --> 
 
<?php if( $guest != "Гость")    
  {?>    	
<nav>
	<ul class="MainMenu">
	<li class="MainPanelItem" id="MB0">
		<span class="MainPanelButton">Главное меню</span>
	    <ul class="MainPanelMenu">
	        <?php foreach ($menu as $item) : ?>
				<li><a href="<?php echo URL::site($item['name'])?>" class="NavLink">
				<?php echo ($item['name_link'])?></a></li>
			<?php endforeach; ?>
	    </ul>
	</li>
	</ul>
</nav> 
  <?}
    ?>
	
	
	<?php if( $guest == "Гость")    
  {?>    	
<nav>
	<ul class="MainMenu">
	<li class="MainPanelItem" id="MB0">
		<span class="MainPanelButton">Главное меню</span>
	    <ul class="MainPanelMenu">	        
		<li><a href="<?php echo URL::site('')?>" class="NavLink" >	 
		<?php echo 'Просмотр меню'?></a></li>			
	    </ul>
	</li>
	</ul>
</nav> 
  <?}
    ?>

</div>


<div class="WorkArea" id="WA">
<div class="WorkAreaImage">

<div class="LeftBlock">
    Дополнительные данные
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


<!-- 
<?php if( $guest == "Гость")    
  {?>    	
   <a href="<?php echo URL::site() ?>" class="MainPanelButton LeftButton"> <?php echo __('Реклама') ?>
   </a><a href="<?php echo URL::site() ?>" class="MainPanelButton"> <?php echo __('Новости') ?>
   </a><a href="<?php echo URL::site() ?>" class="MainPanelButton"> <?php echo __('Контактные данные') ?></a> 
  <?}
    ?>
-->