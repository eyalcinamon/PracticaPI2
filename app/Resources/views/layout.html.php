<?php $view->extend('::base.html.php') ?>

<div id="container">
	<div id="header">
		<img alt="hammer" src="<?php echo $view['assets']->getUrl('images/logo.png') ?>">
		<h1><a href="<?php echo $view['router']->generate('homepage') ?>">Aplicación de subastas</a></h1>
		
		<div id="session">
			<?php if ($app->getUser()) { ?>
				<p> Usuario: <?php echo $app->getUser()->getNombre()?> </p>
				<a class="sessionbtn" href="<?php echo $view['router']->generate('logout') ?>">
				    Cerrar sesión
				</a>
			<?php } else { ?>
				<a class="sessionbtn" href="<?php echo $view['router']->generate('user_registration') ?>">
				    Regístrate!
				</a>
				&nbsp;|&nbsp;
				<a class="sessionbtn" href="<?php echo $view['router']->generate('login_route') ?>">
				    Iniciar sesión
				</a>
				&nbsp;|&nbsp;
				<a class="sessionbtn" href="<?php echo $view['router']->generate('login_route') ?>">
				    Admin login
				</a>
			<?php } ?>
		</div>
	</div>
	<div id="content">
        <?php $view['slots']->output('_content') ?>
     </div>
	<div id="footer">
		Copyright &copy; 2015 Patricia Marti Gran
	</div>
</div>