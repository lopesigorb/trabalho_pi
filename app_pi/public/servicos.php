<?php

require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/controllers/servico.controller.php');

$controller = new ServicoController();
$servico = $controller->buscarTodos();

?>
<div class="container">
    <?php require_once('nav.php'); ?>

    <h1>Lista de Serviços</h1>
    <a class="btn btn-primary" href="cad_servico.php">Novo Serviço</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Serviço</th>
                <th scope="col">Profissional</th>
                
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($servico as $s) :
            ?>
                <tr>
                    <td><?= $s->getId(); ?></td>
                    <td><?= $s->getTipo(); ?></td>
                    
                    <td>
                        <a class="btn btn-light" href="cad_servico.php?key=<?=$s->getId()?>">Editar</a>
                        <a class="btn btn-link" href="../acoes/excluir_servico.php?key=<?=$s->getId()?>">Excluir</a>
                    </td>
                    <td>
                        <a class="btn btn-light" href="cad_servico.php?key=<?=$s->getId()?>">Editar</a>
                        <a class="btn btn-link" href="../acoes/excluir_servico.php?key=<?=$s->getId()?>">Excluir</a>
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
