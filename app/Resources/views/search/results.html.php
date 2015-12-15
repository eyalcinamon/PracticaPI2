<!-- app/Resources/views/default/results.html.php -->
<?php $view->extend('::layout.html.php') ?>


<table id="search_results">
	<thead>
		<tr>
			<th>Descripción</th>
			<th>Tipo</th>
			<th>Pago aplazado (S/N)</th>
			<th>Pujar</th>
			<th>Cantidad en euros</th>
			<th>Aval</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($objetos as $producto): ?>
	      <tr>
	        <td><?php echo $producto->getDescripcion() ?></td>
	        <td><?php echo $producto->getIdTipo()->getNombre() ?></td>
	        <td><?php echo $producto->getPagoaplazosSn() ?></td>
	        <td><?php
	        		if ($producto->getDisponibleSn() == 'S' || $producto->getDisponibleSn() == 's'): ?>
	        			<input type="checkbox" id="disponible" name="_disponible" />
	        		<?php else:
	        			echo "-- no abierto --";
	        		endif;
	        	?>
	        </td>
	        <td><input type="number" id="cantidad" name="_cantidad" /></td>
	        <td>
	        	<?php
	        		if ($producto->getAvalSn() == 'S' || $producto->getAvalSn() == 's'): ?>
	        		<input type="file" id="aval" name="_aval" />
	        	<?php 
	        		else:
	        			echo "-- no necesita --";
	        		endif;
	        	?>
	        </td>
	      </tr>
	    <?php endforeach; ?>
    </tbody>
</table>