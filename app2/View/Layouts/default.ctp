<?php
$cakeDescription = __d('boxngo', 'BOX\'NGO');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?> - 
		<?php echo nl2br(h($title_for_layout)); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('foundation.min');
		echo $this->Html->css('typicons');
		echo $this->Html->css('font-awesome.min');
		echo $this->Html->css('app');
		
		echo $this->fetch('facebookMeta');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
	<meta property="og:site_name" content="BOX&#039;NGO" />
	<meta property="og:image" content="http://theboxngo.com/boxngologolarge.png" />
	<?php echo $this->Html->script(array('http://code.jquery.com/jquery-latest.min.js', 'http://code.jquery.com/ui/1.10.0/jquery-ui.js')); ?>
	
	<?php
		echo $this->fetch('script');
	?>
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<?php echo $this->element('includes/facebookscript'); ?>
	<div class="boxngo_wrapper">
		<?php echo $this->Form->create('Search', array('action' => 'index', 'type' => 'GET', 'inputDefaults' => array('div'=>false,'label'=>false),'class' => 'custom')); ?>
		<?php echo $this->element('layout'.DS.'header'); ?>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<?php
			echo $this->element('sql_dump');
		?>
		<div class="push"></div>
	</div>
	<footer>
		<div class="wrapper">
			<a class="support" href="/info/support">Support</a>
			<a href="/">Home</a>
			<!-- <a href="#">Blog</a> -->
			<a href="/info/about">About</a>
			<a href="/info/privacy">Privacy Policy</a>
			<!-- <a href="/info/faq">FAQ</a> -->
			
		</div>
	</footer>
	<?php 
		echo $this->Html->script('foundation.min');
		echo $this->Html->script('app');
		echo $this->Html->script('main');
		echo $this->fetch('scriptBottom');
	?>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2509553-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>

</html>