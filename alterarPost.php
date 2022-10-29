<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Alterar Post</title>
  <link rel="stylesheet" href="../estilo.css" />
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
  <?php include 'conecta_mysql.php'; ?>
  <?php
  //se o botão não for clicado, mostrar o form
  if (!isset($_GET['post'])) {
    //echo "Nenhum post selecionado";
  } else {
    $strSQL = array();
    $strSQL[] = "SELECT id, title, content, photo, date_created, category";
    $strSQL[] = "FROM posts";
    $strSQL[] = "WHERE id = " . $_GET['post'];

    $strSQL = implode(' ', $strSQL);

    $resultado =  mysqli_query($conexao, $strSQL);

    list($id, $title, $content, $photo, $date_created, $category) = mysqli_fetch_array($resultado);
  }
  ?>
  <div style="display: flex; margin-left:79%;">
    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo date('d/m/Y \à\s H:i:s');
    ?>
  </div>
  <form name="add" id="add" method="POST" action="alterar.php" style="display: flex; flex-direction:column; max-width: 50%; margin:auto;">

    <h2>Alterar Noticia</h2>
    <br>
    <label for="title" class="form-label">Título:</label>
    <input type="text" name="title" class="form-control" required />
    <br>
    <label for="category" class="form-label">Categoria:</label>
    <select name="category" class="form-select">
      <?php
      $strSQL = array();
      $strSQL[] =  "SELECT id, name";
      $strSQL[] = "FROM post_categories";
      $strSQL[] = "ORDER BY name";
      $strSQL[] = "LIMIT 10";
      $strSQL = implode(' ', $strSQL);

      $categories =  mysqli_query($conexao, $strSQL);

      while (list($cat_id, $cat_name) = mysqli_fetch_array($categories)) {
        if ($cat_name == $category) echo "<option value='$cat_id' selected>$cat_name</option>";
        else echo "<option value='$cat_id'>$cat_name</option>";
      }
      ?>
    </select>
    <br>
    <label for="content" class="form-label">Conteúdo:</label>
    <textarea name="content" rows="15" cols="80" class="form-control" required>
      </textarea>
    <br>
    <label for="imagem_produto" class="form-label">Imagem:</label>
    <input type="text" name="photo" value="" required width="200" class="form-control" required />

    <br>

    <input type="hidden" name="date_created" value="<?php date_default_timezone_set('America/Sao_Paulo');
                                                    echo date('Y-m-d H:i:s'); ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="botao" value="Alterar" />
    <br>
    <br>

  </form>
</body>

</html>