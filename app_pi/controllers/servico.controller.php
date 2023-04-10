<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/DAO/ServicoDAO.php");
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "/classes/servico.class.php");

class ServicoController
{

    public function buscarTodos()
    {
        $dao = new ServicoDAO();
        return $dao->buscarTodos();
    }

    // public function buscarPorId($id)
    // {
    //     $dao = new ServicoDAO();
    //     return $dao->buscarUm($id);
    // }

    public function criarServico(Servico $servico)
    {
        $dao = new ServicoDAO();
        return $dao->inserirServico($servico);
    }

//     public function atualizarServico(Servico $servico) {
//         $dao = new ServicoDAO();
//         return $dao->atualizaServico($servico);
//     }

    public function excluirServico($id) {
        $dao = new ServicoDAO();
        return $dao->removeServico($id);
    }
// 
}