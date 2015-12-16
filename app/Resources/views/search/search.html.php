<!-- app/Resources/views/search/search.html.php -->
<?php $view->extend('::layout.html.php') ?>

<h2>Buscador avanzado</h2>

<?php foreach ($view['session']->getFlash('notice') as $message): ?>
	<?php echo "<div class='flash-error'>$message</div>" ?>
<?php endforeach ?>

<br>
<?php echo $view['form']->start($form) ?>
	<div class="pure-control-group">
    <?php echo $view['form']->row($form['descripcion']) ?>
    </div>
    <div class="pure-control-group">
    <?php echo $view['form']->row($form['aval_sn']) ?>
    <?php echo $view['form']->row($form['pagoaplazos_sn']) ?>
    </div>
    
    <div class="pure-control-group">
    <?php echo $view['form']->row($form['idtipo']) ?>
    </div>
    <div class="pure-controls">
    <table border="0">
    <tr>
    	<td><?php echo $view['form']->row($form['search']) ?></td>
    	<td><?php echo $view['form']->row($form['searchAll']) ?></td>
    </tr>
    </table>
    </div>
<?php echo $view['form']->end($form) ?>

<br>
<a href="<?php echo $view['router']->generate('homepage') ?>">
    Inicio
</a>
