<?php
include "../../conexao.php";
include "../../funcoes.php";

$retorno = array();
extract($_POST);


if(isset($tipo)){
    if($tipo == "listagem"){
        $sql = "SELECT * FROM logo";
        $comando = $conexao->prepare($sql);             
        $comando->bindParam(":filtro", $filtro);
        $comando->execute();
        $lista = $comando->fetchAll(PDO::FETCH_ASSOC);
        $retorno["status"] = 1;
        $retorno["lista"] = $lista;
    }      
    else{
        $retorno["status"] = 0;     
        $retorno["mensagem"] = "Tipo de requisição inválido.";    
    }  
}else{        
        $retorno["status"] = 0;   
        $retorno["mensagem"] = "Tipo de requisição não informado.";     
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  

?>