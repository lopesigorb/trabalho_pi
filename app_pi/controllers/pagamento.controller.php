<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/PagamentoDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/pagamento.class.php");

class PagamentoController
{

    public function buscarTodos()
    {
        $dao = new PagamentoDAO();
        return $dao->buscarTodos();
    }

    // public function buscarPorId($id)
    // {
    //     $dao = new PagamentoDAO();
    //     return $dao->buscarUm($id);
    // }

    public function criarPagamento(Pagamento $pag)
    {
        $dao = new PagamentoDAO();
        return $dao->inserirPagamento($pag);
    }

    public function atualizarPagamento(Pagamento $pag) {
        $dao = new PagamentoDAO();
        return $dao->atualizaPagamento($pag);
    }

    public function excluirPagamento($id) {
        $dao = new PagamentoDAO();
        return $dao->removePagamento($id);
    }
}