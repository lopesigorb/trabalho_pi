<?php

class Pagamento {
    private $id;
    private $num_cartao;
    private $nome;
    private $validade;
    private $cod_seg;
    private $cpf;
    private $id_user;

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setNum_cartao($num_cartao) {
        $this->num_cartao = $num_cartao;
    }

    public function getNum_cartao() {
        return $this->num_cartao;
    }   
    
    
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    

    public function setValidade($validade) {
        $this->validade = $validade;
    }

    public function getValidade() {
        return $this->validade;
    }

    public function setCod_seg($cod_seg) {
        $this->cod_seg = $cod_seg;
    }

    public function getCod_seg() {
        return $this->cod_seg;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setId_user($id_user) {
        $this->id = $id_user;
    }

    public function getId_user() {
        return $this->id_user;
    }
}