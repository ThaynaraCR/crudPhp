<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crudphp') or die(msqli_error($mysqli));

$id = 0;
$update = false;
$nome = '';
$autor = '';


if(isset($_POST['save'])){
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $mysqli->query("INSERT INTO livros (nome, autor) VALUES ('$nome', '$autor')") or die($msqli->error);

    $_SESSION['message']= "Livro salvo no banco de dados!";
    $_SESSION['msg_type']= "success";

    header("location: index.php");

}

if(isset($_GET['delete'])){
    $id= $_GET['delete'];
    $mysqli->query("DELETE FROM livros WHERE id=$id") or die($mysqli->error());

    $_SESSION['message']= "Livro excluido do banco de dados!";
    $_SESSION['msg_type']= "danger";

    header("location: index.php");

}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM livros WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){

        $row = $result-> fetch_array();
        $nome = $row['nome'];
        $autor = $row['autor'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];

    $mysqli->query("UPDATE livros SET nome='$nome' , autor='$autor' WHERE id=$id") or
    die($mysqli->error);

    $_SESSION['message'] = "Alteração gravada com sucesso!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}