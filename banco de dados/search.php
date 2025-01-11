<?php
header('Content-Type: application/json'); // Define o tipo de resposta como JSON
require_once 'conexao.php';

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $produtoID = intval($_POST['id']); // Aqui convertemos para int

    $conexao = new Conexao();
    $conexao = $conexao->getConexao();

    // Usando PDO e preparando a consulta
    $stmt = $conexao->prepare("SELECT id, produto, categoria, quantidade FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $produtoID, PDO::PARAM_INT); // Corrigido para o tipo correto
    $stmt->execute();

    // Checando se a consulta retornou algum produto
    if ($stmt->rowCount() > 0) {
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = [
            'status' => 'success',
            'produto' => $produto
        ];
    } else {
        $response = [
            'status' => 'not_found',
            'message' => 'Produto não encontrado'
        ];
    }
}

echo json_encode($response); // Retorna a resposta em formato JSON
?>
