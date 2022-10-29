<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Listagem de Posts</title>
</head>

<body>
	<?php include 'conecta_mysql.php'; ?>
	<div style="display: flex; margin-left:79%;">
		<?php
		date_default_timezone_set('America/Sao_Paulo');
		echo date('d/m/Y \à\s H:i:s');
		?>
	</div>

	<h3 style="background-color: #C8A2C8;">Lista de Posts</h3>
	<ol>
		<?php
		$strSQL = array(); // Cria a query SQL
		$strSQL[] = "SELECT id, title, category"; // SELECT para pegar ID, Titulo, Categoria
		$strSQL[] = "FROM posts"; // Pega na tabela POSTS

		$strSQL = implode(' ', $strSQL); // Junta todas as strings do Array em uma string só

		$resultado =  mysqli_query($conexao, $strSQL); // Faz a query no banco e retorna os itens na váriavel $resultado

		// Estrutura de repetição que itera sobre os itens do banco, e para cada item
		// insere um li no html com id, titulo e categoria com o botão alterar e excluir na frente
		while (list($id, $title, $category) = mysqli_fetch_array($resultado)) {
			echo "<li>$id / $title / $category <form method='POST' action='alterarPost.php?post=$id'><input type='submit' name='botao' value='Alterar' /></form><button>Excluir</button></li>";
		}
		?>
	</ol>
</body>

</html>