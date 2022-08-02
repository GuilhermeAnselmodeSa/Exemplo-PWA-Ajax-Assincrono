<?php
    include "../../conexao.php";
    $retorno = array();
    extract($_POST);
    if (isset($tipo)) {
        if($tipo == "excluir"){
            $sql = "DELETE FROM empresas_parceiras WHERE id_empresa = :id_empresa";
            $comando = $conexao->prepare($sql);             
            $comando->bindParam(":id_empresa", $id_empresa);
            $comando->execute();
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao excluir a posição com o código $id_empresa.";        
        }else {
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Tipo de requisição inválido.";
        }
    }else{        
        $retorno["status"] = 0;   
        $retorno["mensagem"] = "Tipo de requisição não informado.";     
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  

?>