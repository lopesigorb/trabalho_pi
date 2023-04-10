<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/pagamento.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/pagamento.controller.php");

$pag = new Pagamento();

if (isset($_POST) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $num_cartao       = addslashes(filter_input(INPUT_POST, 'num_cartao'));
    $nome       = addslashes(filter_input(INPUT_POST, 'nome'));
    $validade       = addslashes(filter_input(INPUT_POST, 'validade'));
    $cod_seg       = addslashes(filter_input(INPUT_POST, 'cod_seg'));
    $cpf       = addslashes(filter_input(INPUT_POST, 'cpf'));
    // $id_user       = addslashes(filter_input(INPUT_POST, 'id_user'));

    // var_dump($tipo);

    if (empty($num_cartao) || empty($nome) || empty($validade) || empty($cod_seg) || empty($cpf)) {
        $_SESSION['mensagem'] = "Obrigatório informar os dados do cartão!";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_pagamento.php?key=' . $id);
        die();
    }

    $pag->setId($id);
    $pag->setNum_cartao($num_cartao);
    $pag->setNome($nome);
    $pag->setValidade($validade);
    $pag->setCod_seg($cod_seg);
    $pag->setCpf($cpf);
    // $pag->setId_user($id_user);

    $controller = new PagamentoController();
    $resultado = $controller->atualizarPagamento($pag);

    // if ($resultado) {
    //     $_SESSION['mensagem'] = "Atualizado com sucesso";
    //     $_SESSION['sucesso'] = true;
    // } else {
    //     $_SESSION['mensagem'] = "Erro ao atualizar";
    //     $_SESSION['sucesso'] = false;
    // }
    // header('Location:../public/cad_pagamento.php');
    var_dump($resultado);
} else {

    $num_cartao = isset($_POST['num_cartao']) ? $_POST['num_cartao'] : null;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $validade = isset($_POST['validade']) ? $_POST['validade'] : null;
    $cod_seg = isset($_POST['cod_seg']) ? $_POST['cod_seg'] : null;
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    // $id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;

    if ($num_cartao && $nome && $validade && $cod_seg && $cpf) {

        
        $pag->setNum_cartao($num_cartao);
        $pag->setNome($nome);
        $pag->setValidade($validade);
        $pag->setCod_seg($cod_seg);
        $pag->setCpf($cpf);

        $dao = new PagamentoController();
        $resultado = $dao->criarPagamento($pag);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar os dados do cartão!";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_pagamento.php');
}
