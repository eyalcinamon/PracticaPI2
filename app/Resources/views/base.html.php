<!-- app/Resources/views/base.html.php -->
<!DOCTYPE html>
<html>
    <head>
    	<link href="<?php echo $view['assets']->getUrl('css/main.css') ?>" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php $view['slots']->output('title', 'Aplicacion de subastas') ?></title>
        
        <script type="text/javascript" src="<?php echo $view['assets']->getUrl('javascript/sorter/jquery-latest.js') ?>"></script> 
		<script type="text/javascript" src="<?php echo $view['assets']->getUrl('javascript/sorter/jquery.tablesorter.js') ?>"></script> 
    </head>
    <body>
    	<?php $view['slots']->output('_content') ?>
    </body>
</html>
