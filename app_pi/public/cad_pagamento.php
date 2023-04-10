<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/pagamento.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/pagamento.controller.php");

$pag = new Pagamento();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new PagamentoController();
    // $pag = $controller->buscarPorId($id);
}

?>

<div class="container">
    <?php require_once('nav.php'); ?>
    <h1>Cadastro de cartão </h1>

    <form method="POST" action="../acoes/salvar_cartao.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome no cartão</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $pag->getNome() ?>">
            <input type="hidden" name="id" value="<?= $pag->getId(); ?>">
        </div>
        <div class="mb-3">
            <label for="num_cartao" class="form-label">Número do cartão</label>
            <input type="number" class="form-control" id="num_cartao" name="num_cartao" value="<?= $pag->getNum_cartao() ?>">
        </div>
        <div class="mb-3">
            <label for="validade" class="form-label">Validade</label>
            <input type="text" class="form-control" id="validade" name="validade" value="<?= $pag->getValidade() ?>">
        </div>
        <div class="mb-3">
            <label for="cod_seg" class="form-label">CVV</label>
            <input type="number" class="form-control" id="cod_seg" name="cod_seg" value="<?= $pag->getCod_seg() ?>">
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="number" class="form-control" id="cpf" name="cpf" value="<?= $pag->getCpf() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

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
