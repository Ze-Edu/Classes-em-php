<?php 
class sql extends PDO{
    private $cn;
    public function __construct(){
        $this->cn = new PDO("mysql:host=127.0.0.1;dbname=controledb","root","");
    }
    // Método que atribui parametros para uma query sql
    public function setParams($command, $parameters = array()){
        foreach($parameters as $key => $value){
            $this->setParam($command, $key, $value);
        }
    }

    // Método para tratar o parametro
    public function setParam($cmd, $key, $value){
        $cmd->bindParam($key, $value); // 
    }

    public function querySql($commandSql, $params = array()){
        $cmd = $this->cn->prepare($commandSql);
        $this->setParams($cmd, $params);
        $cmd->execute();
        return $cmd;
    }
    public function select($commandSql, $params = array()){
        $cmd = $this->querySql($commandSql, $params);
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>