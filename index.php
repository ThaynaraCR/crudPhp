<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>Class Crud</title>
</head>
<body>

<div class="p-3 mb-2 bg-secondary">

<div class="col-md-3 offset-md-5">
<h1>Meus Livros</h1> </div>

<?php require_once 'processa.php'; ?>

<?php

    if (isset($_SESSION['message'])): 

?>

<div class=" alert alert-<?=$_SESSION['msg_type']?> ">

        <?php
             echo $_SESSION['message'];
             unset($_SESSION['message']);

        ?>

</div>
     <?php endif ?>

<?php
   $mysqli = new mysqli('localhost', 'root', '', 'crudphp') or die(mysqli_error($mysqli));
   $result = $mysqli->query("SELECT * FROM livros") or die($mysqli->error);

?>
<div class="container">
<table class="table table-bordered table table-sm">
  <thead>
      <th class="bg-primary">Nome do Livro</th>
      <th class="bg-primary">Autor</th>
      <th class="bg-primary">Açoes</th>
  </thead>
<?php

   while ($row = $result->fetch_assoc()): ?>



  <tr class="table-info">
      <td><?php echo $row['nome']; ?></td>
      <td><?php echo $row['autor']; ?></td>
      <td>
      <a href= "index.php?edit=<?php echo $row ['id']; ?>">Editar</a>
      <a href= "processa.php?delete=<?php echo $row ['id']; ?>">Excluir</a>
      </td>
  </tr>
<?php endwhile; ?>

</table>

</div>

<?php

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '<pre>';
}

?>
<div class="col-md-3 offset-md-5">
    <form method="POST" action="processa.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Nome do Livro:</label>
        <input type="text" name="nome" value="<?php echo $nome; ?>"   placeholder="digite o nome do livro"><br><br>
        <label>Autor do Livro:</label>
        <input type="text" name="autor"  value="<?php echo $autor; ?>"  placeholder="digite o nome  do author"><br><br>
             
             <div class="col-md-3 offset-md-3">
               <?php  
                   if($update==true):

               ?>
                    <button type="submit" name="update">Atualizar</button>
                   <?php else: ?>
                    <button type="submit" name="save">Salvar</button>
               
                   <?php endif; ?>
              </div>   
    </form>
    </div>
    
</body>
</div>

</html>
