<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <a href="https://www.google.ru/" class="MainPanelButton LeftButton ActiveButton">Кнопка</a>
    <a href="https://www.youtube.com/" class="MainPanelButton">Кнопка2</a>
<!--  -->
                   
</div>

<?php echo $content; ?>
</div>
 
<footer class="Underground">Подвал</footer>

<?php echo HTML::image('media/image/MainTemplate/Background.png', array('class' => 'imgBG', 'id' => 'lowerBG')); ?>
<?php echo HTML::image('media/image/MainTemplate/BackgroundUpper.png', array('class' => 'imgBG')); ?>
</div>
</body>
</html>
	


