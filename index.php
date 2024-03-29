<?php session_start(); ?>
<!DOCTYPE html>

<head>
	<title> Sistema de Faturação </title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="javascript/header.js"></script>
</head>

<body>
<div id="header">
		<div id="header-contents">
		    <div id ="title">
		    	<h2>Sistema de Faturação</h2>
		    </div>
		    <div id = "header-links">
		        <nav>
		            <ul>
		                <li><a href="index.php"> <img src="images/home-white.png" width="15" height="15" /> Home </a></li>
		                <li id="check"><a href=""> <img src="images/sheet-white.png" width="15" height="15" />  Consultar Documentos </a></li>
		                <li id="create"><a href=""> <img src="images/create-sheet.png" width="15" height="15" />  Criar Documentos </a></li>
		                <li><a href="search.php"> <img src="images/search-white.png" width="15" height="15" /> Pesquisa Avançada </a></li>
		            </ul>
		        </nav>
		    </div>
	    </div>
	    <div class="documents" id="checkDocuments">
			<ul>
			  <li><a href="checkInvoices.php"> Faturas </a></li>
			  <li><a href="checkProducts.php"> Produtos e Serviços </a></li>
			  <li><a href="checkCustomers.php"> Clientes </a></li>
			</ul>
		</div>
		<div class="documents" id="createDocuments">
			<ul>
			  <li><a href="createInvoiceForm.php"> Faturas </a></li>
			  <li><a href="createProductForm.php"> Produtos e Serviços </a></li>
			  <li><a href="createCustomerForm.php"> Clientes </a></li>
			</ul>
		</div>
	</div>
	

	<?php
	//session_start();

	if (!isset($_SESSION['username']))
	{
		echo '
		<div class="container">
			<div id ="login">		
				<FORM action="login.php" method="post">
				<p><h3>Login</h3></p><br>
				<p>Username:</p>
				<INPUT type = "string" name = "Name" maxlength = "15" />
				<p>Password:</p>
				<INPUT type = "password" name = "Password" maxlength = "30" />
				<br><br>
				<input type="submit"/>
				</FORM> <br><br>
				<p><u><h4><a href="register.html"> Registar</a></h2></u></p>
			</div>
		</div>
		';
	}	
	else
	{
		if ($_SESSION['permission'] == "reader")
			$permission = "consultar documentos";
		else if ($_SESSION['permission'] == "writer")
			$permission = "consultar e criar/editar documentos";
		else if ($_SESSION['permission'] == "admin")
			$permission = "gerir utilizadores existentes, além de poder consultar e criar/editar documentos";

		echo '<div id="conteudo">';
  		echo '<div class="texto" style="padding-top: 8%; max-width: 1080px">';
		echo $_SESSION['username'] . ', você tem permissões para ' . $permission . '.<br><br>';

		if ($_SESSION['permission'] == "admin")
		{
			echo '<a href="manageUsers.php"><button> Gerir Utilizadores </button></a><br><br>';
		}

		echo '<a href="logout.php"><button> Logout </button></a>';

		echo '</div></div>';

	}

	?>
</body>