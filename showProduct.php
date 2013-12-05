<?php 
	include 'header.php';
 	echo '<div id="conteudo">';
 	echo '<div class="texto">';
 	
	$db = new PDO('sqlite:database/documents.db');
 	$stmt = $db->prepare('SELECT * FROM Product WHERE ProductCode = ?');
   	$stmt->execute(array($_GET['ProductCode']));
   	$row = $stmt->fetch();

   	if (!$row)
   		echo 'Não foram encontrados produtos com código ' . $_GET['ProductCode'] . '!';
   	else
   	{
		echo '<div class="btab"><table border="1"><tr><td>' . '<b>Código:</b></td><td>' . $row['ProductCode'] . '</td></tr>'; 

	    echo ' <tr><td>' . '<b>Descrição: </b></td><td>' . $row['ProductDescription'] . '</td></tr>';  
	    echo '<tr><td><b>Preço Unitário: </b></td><td>' . $row['UnitPrice'] . '</tr></td>'; 
	    echo '<tr><td><b>Unidade de medida: </b></td><td>' . $row['UnitOfMeasure'] . '</tr></td></table></div>';  
	}	
?>
</div>
</div>
</body>
