<?php

// localizando as informações 
$server = '';
$usuario = '';
$senha = '';
$banco = '';

// fazendo a conexao ao banco de dados, nesse caso usei workbench
$conn = new mysqli($server, $usuario, $senha, $banco);

//verificar conexao com banco
if ($conn->connect_error) {
    // aqui vai imprimir caso tenha algum erro na conexão
    die("Conexão falhou: " . $conn->connect_error);
}
// este comando vai enviar as informarções para banco, neste caso foi usado para forma de registrar

//Nome(usado para contato), Telefone(usado para espalhar ad restaurante somente), Senha(nesse caso usei um elemento que dono do banco nao consiga usar )
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];

// Esta linha vai Verificar se as senhas coincidem, caso nao, vai aparecer erro na page
if ($senha !== $senha2) {
    die("Erro: As senhas não coincidem. Por favor, tente novamente.");
}
//usado para nem dono e hackers possivel consiga 
$senhad = password_hash($senha, PASSWORD_DEFAULT);

//nesse vai inserir as informações para banco 
$smtp = $conn->prepare("INSERT INTO (nome, telefone, senha) VALUES (?, ?, ?)");
if (!$smtp) { // vai apresentar a conexao nao tenha feita correta correta conexao
    die("Erro na preparação da consulta: " . $conn->error);
}

$smtp->bind_param("sss", $nome, $telefone, $senhad);

if (!$smtp->execute()) {
    die("Erro na execução da consulta: " . $smtp->error);
}
$smtp->close();
$conn->close();
//essa linha vai direcionar page onde esteja encontrado inicio
header("location: ");
?>
