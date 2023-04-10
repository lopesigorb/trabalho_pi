<?php
require_once(str_replace('\\', '/', dirname(__FILE__, 2)). '/config/functions.php');
require_once(str_replace('\\', '/', dirname(__FILE__, 2)) .'/classes/servico.class.php');

class ServicoDAO
{

    public function buscarTodos()
    {
        $pdo = connectDb();
        try {
            $stmt = $pdo->prepare("SELECT * FROM servicos;");
            $stmt->execute();
            $servico = new Servico();
            $retorno = array();
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $servico->setId($rs->id);
                $servico->setTipo(($rs->tipo));
                
                $retorno[] = clone $servico;
            }
            return $retorno;
        } catch (PDOException $ex) {
            echo "Erro ao buscar serviço: " . $ex->getMessage();
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

    public function removeServico($id)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare('DELETE FROM servicos WHERE id = :id');
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
            }
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo "Erro ao excluir serviço: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function inserirServico(Servico $servico)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO servicos (tipo) VALUES (:tipo)");
            $stmt->bindValue(":tipo", $servico->getTipo());
            
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            echo "Erro ao inserir servico: " . $ex->getMessage();
            $pdo->rollBack();
            die();
        }
    }

    public function atualizaServico(Servico $servico)
    {
        $pdo = connectDb();
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("UPDATE servicos SET tipo = :tipo WHERE id = :id");
            $stmt->bindValue(":tipo", $servico->getTipo());
            
            $stmt->bindValue(":id", $servico->getId());
            $stmt->execute();
            if ($stmt->rowCount()) {
                $pdo->commit();
                return TRUE;
            }
            return FALSE;
        } catch (PDOException $ex) {
            $pdo->rollBack();
            echo "Erro ao atualizar servico: " . $ex->getMessage();
            die();
        }
    }
}
