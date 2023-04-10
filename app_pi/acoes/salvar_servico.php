<?php
session_start();

require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/servico.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/servico.controller.php");

$servico = new Servico();

if (isset($_POST) && isset($_POST['id'])) {
    $id         = addslashes(filter_input(INPUT_POST, 'id'));
    $tipo       = addslashes(filter_input(INPUT_POST, 'tipo'));

    var_dump($tipo);

    if (empty($tipo)) {
        $_SESSION['mensagem'] = "Obrigatório informar o tipo de serviço!";
        $_SESSION['sucesso'] = false;
        header('Location:../public/cad_servico.php?key=' . $id);
        die();
    }


    if ($tipo) {

        $servico->setTipo($tipo);

        $dao = new ServicoController();
        $resultado = $dao->criarServico($servico);
        var_dump($resultado);
        if ($resultado) {
            $_SESSION['mensagem'] = "Criado com sucesso";
            $_SESSION['sucesso'] = true;
        } else {
            $_SESSION['mensagem'] = "Erro ao criar";
            $_SESSION['sucesso'] = false;
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório informar Nome e CPF/CNPJ";
        $_SESSION['sucesso'] = false;
    }
    header('Location:../public/cad_servico.php');

    // $servico->setId($id);
    // $servico->setTipo($tipo);


    // $controller = new ServicoController();
    // $resultado = $controller->atualizarServico($servico);

    // if ($resultado) {
    //     $_SESSION['mensagem'] = "Atualizado com sucesso";
    //     $_SESSION['sucesso'] = true;
    // } else {
    //     $_SESSION['mensagem'] = "Erro ao atualizar";
    //     $_SESSION['sucesso'] = false;
    // }
    // header('Location:../public/cad_servico.php');
}
