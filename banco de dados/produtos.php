<?php
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $id = $_POST['id'];
    $categoria = $_POST['categoria'];
    $quantidade = $_POST['quantidade'];

    $conexao = new Conexao();
    $conexao = $conexao->getConexao();

    $sql = "INSERT INTO produtos (produto, id, categoria, quantidade) VALUES (:produto, :id, :categoria, :quantidade)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':produto', $produto);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->execute();
    
    if ($stmt->execute()) {
        header('Location: ../cadastrar.html?=status=success&message=Produto cadastrado com sucesso!');
    } else {
        header('Location: ../cadastrar.html?=status=error&message=Erro ao cadastrar produto!');
    }
}else {
    header('Location: /cadastrar.html?=status=error&message=Erro ao cadastrar produto!');
}