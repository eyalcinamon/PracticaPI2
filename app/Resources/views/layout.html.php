<?php $view->extend('::base.html.php') ?>

<div id="container">
	<div id="header">
		<h1>Aplicación de subastas</h1>
	</div>
	<div id="content">
        <?php $view['slots']->output('_content') ?>
     </div>
	<div id="footer">
		Copyright &copy; 2015 Patricia Marti Gran.
	</div>
</div>