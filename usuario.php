<?php
class Usuario{
    //atributos
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $senha_original;
    private $nivel;
    private $ativo;
    private $avatar;
    // declaração de métodos de acesso (Getters an setters)
    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function getSenhaOriginal()
    {
        return $this->senha_original;
    }
    public function getNivel()
    {
        return $this->nivel;
    }
    public function getAtivo()
    {
        return $this->ativo;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }

  
    public function setId($value)
    {
        $this->id = $value;
    }
    public function setNome($value)
    {
        $this->nome = $value;
    }
    public function setUsuario($value)
    {
        $this->usuario = $value;
    }
    public function setSenha($value)
    {
        $this->senha = $value;
    }
    public function setSenhaOriginal($value)
    {
        $this->senha_original = $value;
    }
    public function setNivel($value)
    {
        $this->nivel = $value;
    }
    public function setAtivo($value)
    {
        $this->ativo = $value;
    }
    public function setAvatar($value)
    {
        $this->avatar = $value;
    }

    public function loadById($_id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM usuarios WHERE id = :id", array(':id'=>$_id));
        if(count($results)>0){
            $this->setData($results[0]);
        }
    }
    public function setData($dados){
        $this->setId($dados['id']);
        $this->setNome($dados['nome']);
        $this->setUsuario($dados['usuario']);
        $this->setSenha($dados['senha']);
        $this->setSenhaOriginal($dados['senha_original']);
        $this->setNivel($dados['nivel']);
        $this->setAtivo($dados['ativo']);
        $this->setAvatar($dados['avatar']);
    }

    public static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios ORDER BY nome");
    }
    public static function search($_nome){
        $sql = new Sql();
        return $sql->select("SELECT * FROM usuarios WHERE nome LOKE :nome",
            array(":nome"=>"%".$_nome."%"));
    }
    public function efetuarLogin($_usuario, $_senha){
        $sql = new Sql();
        $senhaCrip = md5($_senha);
        $res = $sql->select("SELECT * FROM usuarios WHERE usuario = :usuario and senha= :senha", 
        array(":usuario"=>$_usuario,":senha"=>$senhaCrip));
        if(count($res)>0){
            $this->setData($res[0]);
        }
    }
    public function insert(){
        $sql = new Sql();
        $res = $sql->select("CALL sp_user_insert(:nome, :usuario, :senha, :nivel, :avatar)",
    array(
        ":nome"=>$this->getNome(),
        ":usuario"=>$this->getNome(),
        ":senha"=>md5($this->getSenha()),
        ":nivel"=>$this->getNivel(),
        ":avatar"=>$this->getAvatar()
    ));
    if(count($res)>0){
        $this->setData($res[0]);
    }
    }
    public function update($_id){}
    public function delete(){}
    public function __construct(){

    }
}

?>