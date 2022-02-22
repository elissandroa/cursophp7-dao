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
			
			$this->setData($results[0]);
		}

	}


	public static function getList(){
		
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuario ORDER BY nome");
	}

	public static function search($nome){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuario WHERE nome LIKE :SEARCH ORDER BY nome", array(
				":SEARCH"=>"%".$nome."%"
			));
	}

	public function login($nome, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuario WHERE nome = :NOME AND senha = :SENHA", array(
			":NOME"=>$nome,
			":SENHA"=>$senha
		));

		if(isset($results[0])){
			
			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou senha inválidos");
			
		} 
	}

	public function setData($data){

			$this->setId_user($data['id_user']);
			$this->setNome($data['nome']);
			$this->setSenha($data['senha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuario_insert(:NOME, :SENHA)", array(
			':NOME'=>$this->getNome(),
			':SENHA'=>$this->getSenha()
		));

		if(count($results) > 0){

			$this->setData($results[0]);
		}

	}

	public function update($nome, $senha){

		$this->setNome($nome);
		$this->setSenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuario SET nome = :NOME, senha = :SENHA WHERE id_user = :ID", array(

			":NOME"=>$this->getNome(),
			":SENHA"=>$this->getSenha(),
			":ID"=>$this->getId_user()
		));
	}

	public function __construct($nome = "", $senha = ""){
		$this->setNome($nome);
		$this->setSenha($senha);
	}


	public function __toString(){
		return json_encode(array(
			"id_user"=>$this->getId_user(),
			"nome"=>$this->getNome(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}
}
?>