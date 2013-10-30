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
	<div class="Personal"> <?php echo $user; ?></div>
	
	<?php echo HTML::image('media/image/MainTemplate/Logo.png', array('class' => 'Logo')); ?>  
</header>
  
<div class="WorkArea">
<div class="MainPanel">
    
<!-- Кнопки главной панели -->	
    <a href="<?php echo URL::site('/admin') ?>" class="MainPanelButton LeftButton ActiveButton">
    Администрирование
    </a><a href="<?php echo URL::site('/admin/users') ?>" class="MainPanelButton">
    Пользователи
    </a>
<!--  -->

    
</div>
<?php echo $message."<br>"; 
   echo $content; ?>
</div>
 
<footer class="Underground">Подвал</footer>

<?php echo HTML::image('media/image/MainTemplate/Background.png', array('class' => 'imgBG', 'id' => 'lowerBG')); ?>
<?php echo HTML::image('media/image/MainTemplate/BackgroundUpper.png', array('class' => 'imgBG')); ?>
</div>
</body>
</html>
	


