<?php
    include "../../conexao.php";
    $retorno = array();
    extract($_POST);
    if (isset($tipo)) {
        if ($tipo == "cadastrar") {
            $sql = "INSERT INTO empresas_parceiras VALUES(0, :nome_empresa, :cnpj_empresa, :cidade_empresa, :endereco_emprego, :estado_empresa)";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":nome_empresa", $txtnome_empresa);
            $comando->bindParam(":cnpj_empresa", $txtcnpj_empresa);
            $comando->bindParam(":cidade_empresa", $txtcidade_empresa);
            $comando->bindParam(":endereco_emprego", $txtendereco_emprego);
            $comando->bindParam(":estado_empresa", $txtestado_empresa);
            $comando->execute();
           
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao cadastrar posição.";
        } else {
            $retorno["status"] = 0;
            $retorno["mensagem"] = "Tipo de requisição inválido.";
        }
    }else{        
        $retorno["status"] = 0;   
        $retorno["mensagem"] = "Tipo de requisição não informado.";     
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  

?>