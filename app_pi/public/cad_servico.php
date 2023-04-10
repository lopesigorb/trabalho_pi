<?php
require_once('./header.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/acoes/verifica_sessao.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/servico.class.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/controllers/servico.controller.php");

$servico = new Servico();

if (isset($_GET) && isset($_GET['key'])) {
    $id = filter_input(INPUT_GET, 'key');
    $controller = new ServicoController();
    // $servico = $controller->buscarPorId($id);
}

?>

<div class="container">
    <?php require_once('nav.php'); ?>
    <h1>Cadastro de Serviços </h1>

    <form method="POST" action="../acoes/salvar_servico.php">
        <div class="mb-3">
            <label for="nome" class="form-label">Tipo de Serviço</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $servico->getTipo() ?>">
            <input type="hidden" name="id" value="<?= $servico->getId(); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <!-- <div class="mb-3">
            <label for="cpfcnpj" class="form-label">CPF/CNPJ</label>
            <input type="text" class="form-control" id="cpfcnpj" name="cpfcnpj" value="">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="">
        </div> -->
        
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
