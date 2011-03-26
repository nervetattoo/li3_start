<!doctype html>
<!-- Based on http://html5boilerplate.com compatible -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
	<title><?php echo $this->title(); ?> &ndash; My Fantastic App</title>

    <meta name="description" content="">
    <meta name="author" content="">

	<?php echo $this->html->style(array('debug', 'lithium')); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>

    <script src="js/libs/modernizr-1.7.min.js"></script>
</head>
<body class="app">
    <div id="container">
        <header>
        </header>
        <div id="main" role="main">
            <?php echo $this->content(); ?>
        </div>
        <footer>
        </footer>
    </div> <!--! end of #container -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
    <script>window.jQuery || document.write("<script src='js/libs/jquery-1.5.1.min.js'>\x3C/script>")</script>
	<?php echo $this->scripts(); ?>

    <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
    <![endif]-->
</body>
</html>
