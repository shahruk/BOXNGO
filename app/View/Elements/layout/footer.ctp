<footer>
	<div class="row wrapper">
		<div class="col-xs-4 col-md-4">
			<a id="footer_logo" href="/"><img src="/logo.png" /></a>
			<a href="https://facebook.com/theboxngo"><img class="social" src="/img/facebook.png" />
		</div>
		<div class="col-xs-4 col-md-4">
			<a href="/blog/">Blog</a>
			<a href="/info/about">Meet the Founders</a>
			<a href="/info/fees">Fees</a>
			<a class="support" href="/info/support">FAQ / Support</a>			
			<a href="/info/privacy">Privacy Policy</a>
		</div>
		<div class="col-xs-4 col-md-4">
			<?php for($i = 0; $i < count($layoutCategories); $i++){ ?>
				<a href="/browse/<?php echo $layoutCategories[$i]['Category']['short_name']; ?>"><?php echo $layoutCategories[$i]['Category']['display_name']; ?></a>
			<?php } ?>
		</div>
	</div>
</footer>
