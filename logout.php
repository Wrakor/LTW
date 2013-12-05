<?php include 'header.php';  ?>

<div id="conteudo">
	<div class="texto">
	Logout efectuado! <br><br>
	<u><a href="index.php"> Voltar à Página Inicial</a></u></div>
</div>
<?php
	session_destroy();
?>
</body>