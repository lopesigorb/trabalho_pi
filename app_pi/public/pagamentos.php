<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/controllers/pagamento.controller.php');

$controller = new PagamentoController();
$pag = $controller->buscarTodos();

?>
<div class="container">
    <?php require_once('nav.php'); ?>

    <h1>Lista de cartões</h1>
    <a class="btn btn-primary" href="cad_pagamento.php">Adicionar Cartão</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <!-- <th scope="col">Descrição</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Estoque</th>
                <th scope="col">Ativo</th> -->
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($pag as $p) :
            ?>
                <tr>
                    <td><?= $p->getId(); ?></td>
                    <td><?= $p->getNome(); ?></td>
                    
                    <td>
                        <a class="btn btn-light" href="cad_pagamento.php?key=<?=$p->getId()?>">Editar</a>
                        <a class="btn btn-link" href="../acoes/excluir_cartao.php?key=<?=$p->getId()?>">Excluir</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == TRUE) {
    ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['mensagem']; ?>
        </div>
    <?php
    }
    unset($_SESSION['sucesso'], $_SESSION['mensagem']);
    ?>

</div>

<?php
require_once('./footer.php');
