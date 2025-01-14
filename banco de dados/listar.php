<?php
header('Content-Type: application/json');
require_once 'conexao.php';
$response = [];

try{
    $conexao = new Conexao();
    $conexao = $conexao->getConexao();

    $sql = "SELECT id, produto, categoria, SUM(quantidade) as quantidade_total FROM produtos 
    GROUP BY id, produto, categoria
    ORDER BY id ASC";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($produtos) {
        usort($produtos, function($a, $b) {
            return $a['id'] <=> $b['id'];
        });

        $response = [
            'status' => 'success',
            'produtos' => $produtos
        ];
    } else {
        $response = [
            'status' => 'not_found',
            'message' => 'Nenhum produto encontrado'
        ];
    }
}catch(PDOException $e){
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);
?>