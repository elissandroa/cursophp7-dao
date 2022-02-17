<?php

class Usuario {

	private $id_user;
	private $nome;
	private $senha;
	private $dtcadastro;

	public function getId_user() {
		return $this->id_user;
	}

	public function setId_user($value) {
		$this->id_user = $value;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($value) {
		$this->nome = $value;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($value) {
		$this->senha = $value;
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function setDtcadastro($value) {
		$this->dtcadastro = $value;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE id_user = :ID", array(
			":ID"=>$id
		));

		if(isset($results[0])){
			$row = $results[0];

			$this->setId_user($row['id_user']);
			$this->setNome($row['nome']);
			$this->setSenha($row['senha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));
		}

	}

	public function __toString(){
		return json_encode(array(
			"id_user"=>$this->getId_user(),
			"nome"=>$this->getNome(),
			"senha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}
?>