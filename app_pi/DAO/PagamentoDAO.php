<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . '/classes/pagamento.class.php');

class PagamentoDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM pagamentos WHERE id;");
            $stmt->execute();
            $pag = new Pagamento();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $pag->setId($rs->id);
                $pag->setNome(($rs->nome));

                $retorno[] = clone $pag;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar cartão: " . $ex->getMessage();
            die();
        }
    }

    // public function buscarUm($id)
    // {
    //     $pdo = connectDb();
    //     try {
    //         $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = :id;");
    //         $stmt->bindValue(":id", $id);
    //         $stmt->execute();
    //         $servico = new Servico();
    //         while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
    //             $servico->setId($rs->id);
    //             $servico->setTipo(($rs->tipo));

    //         }
    //         return $servico;
    //     } catch (PDOException $ex) {
    //         echo "Erro ao buscar serviço: " . $ex->getMessage();
    //         die();
    //     }
    // }

    public function removePagamento($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM pagamentos WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir cartão: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    //INSERT INTO `pagamentos`(`id`, `num_cartao`, `nome`, `validade`, `cod_seg`, `cpf`) 
    // VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
    public function inserirPagamento(Pagamento $pag)
    {
        var_dump($pag);
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO pagamentos (num_cartao, nome, validade, cod_seg, cpf) VALUES (:num_cartao, :nome, :validade, :cod_seg, :cpf)");
            $stmt->bindValue(":num_cartao", $pag->getNum_cartao());
            $stmt->bindValue(":nome", $pag->getNome());
            $stmt->bindValue(":validade", $pag->getValidade());
            $stmt->bindValue(":cod_seg", $pag->getCod_seg());
            $stmt->bindValue(":cpf", $pag->getCpf());

            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir cartão: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaPagamento(Pagamento $pag)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE pagamentos SET num_cartao = :num_cartao, nome = :nome, validade = :validade, cod_seg = :cod_seg, cpf = :cpf WHERE id = :id");
            $stmt->bindValue(":num_cartao", $pag->getNum_cartao());
            $stmt->bindValue(":nome", $pag->getNome());
            $stmt->bindValue(":validade", $pag->getValidade());
            $stmt->bindValue(":cod_seg", $pag->getCod_seg());
            $stmt->bindValue(":cpf", $pag->getCpf());

            $stmt->bindValue(":id", $pag->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar cartão: " . $ex->getMessage();
            die();
        }
    }
}
