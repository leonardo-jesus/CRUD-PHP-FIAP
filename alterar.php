<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Alterar Post</title>
  <link rel="stylesheet" href="../estilo.css" />
</head>

<body>
  <?php include 'conecta_mysql.php'; ?>

  <?php

  $title =          $_REQUEST['title'];
  $content =        $_REQUEST['content'];
  $photo =          $_REQUEST['photo'];
  $date_created =   $_REQUEST['date_created'];
  $category =       $_REQUEST['category'];
  $id =       $_REQUEST['id'];

  $strSQL = array();
  $strSQL[] = "UPDATE posts";
  $strSQL[] = "SET title = '$title', content = '$content', photo = '$photo', date_created = '$date_created', category = $category";
  $strSQL[] = "WHERE id = $id";
  $strSQL = implode(' ', $strSQL);

  $resultado =  mysqli_query($conexao, $strSQL);

  if ($resultado == 1) echo "<h1>Post '$title' alterado com sucesso!</h1>";
  else echo "<h1>Houve um erro ao executar consulta.</h1><p>String SQL: '$strSQL'</p><p>Retorno: '$resultado'</p>";
  ?>
</body>

</html>