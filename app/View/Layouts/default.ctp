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
			//echo $this->element('sql_dump');
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
<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('2827-622-10-8378');/*]]>*/</script><noscript><a href="https://www.olark.com/site/2827-622-10-8378/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->
</body>

</html>
