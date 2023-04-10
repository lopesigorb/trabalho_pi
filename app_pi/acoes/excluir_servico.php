<?php

session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/servico.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/servico.controller.php");

$servico = new Servico();

if (isset($_GET) && isset($_GET['key'])) {
    $id         = addslashes(filter_input(INPUT_GET, 'key'));
    $controller = new ServicoController();
    $resultado = $controller->excluirServico($id);

    if ($resultado) {
        $_SESSION['mensagem'] = "Excluido com sucesso";
        $_SESSION['sucesso'] = true;
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir";
        $_SESSION['sucesso'] = false;
    }
    
    header('Location:../public/home.php');
}