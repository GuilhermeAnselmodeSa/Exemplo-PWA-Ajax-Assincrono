<?php
    // include "../conexao.php";
    // include "func_empresa/cadastrar.php";
    // include "func_empresa/listagem.php";
    // include "func_empresa/consultar.php";


    //  $retorno = array();
    //   extract($_POST);
    // // if(isset($tipo)){
    //     if($tipo == "cadastrar"){
            
    //         $sql = "INSERT INTO empresas_parceiras VALUES(0, :nome_empresa, :cnpj_empresa, :cidade_empresa, :endereco_emprego, :estado_empresa)";
    //           $comando = $conexao->prepare($sql);
    //         $comando->bindParam(":nome_empresa", $txtnome_empresa);
    //         $comando->bindParam(":cnpj_empresa", $txtcnpj_empresa);
    //         $comando->bindParam(":cidade_empresa", $txtcidade_empresa);
    //         $comando->bindParam(":endereco_emprego", $txtendereco_emprego);
    //         $comando->bindParam(":estado_empresa", $txtestado_empresa);
    //         $comando->execute();
    //         $retorno["status"] = 1;
    //         $retorno["mensagem"] = "Sucesso ao cadastrar posição.";                        
    //     }
    //     else if($tipo == "alterar"){
    //         $sql = "UPDATE empresas_parceiras  SET  nome_empresa = :nome_empresa, cnpj_empresa = :cnpj_empresa, cidade_empresa = :cidade_empresa, endereco_emprego = :endereco_emprego, estado_empresa = :estado_empresa WHERE id_empresa =:id_empresa";
    //         $comando = $conexao->prepare($sql);
    //         $comando->bindParam(":id_empresa", $txtid_empresa);
    //         $comando->bindParam(":nome_empresa", $txtnome_empresa);
    //         $comando->bindParam(":cnpj_empresa", $txtcnpj_empresa);
    //         $comando->bindParam(":cidade_empresa", $txtcidade_empresa);
    //         $comando->bindParam(":endereco_emprego", $txtendereco_emprego);
    //         $comando->bindParam(":estado_empresa", $txtestado_empresa);
    //         $comando->execute();
    //         $retorno["status"] = 1;
    //         $retorno["mensagem"] = "Sucesso ao alterar cadastro.";                        
    // }

    //     else if($tipo == "listagem"){
    //         $sql = "SELECT * FROM empresas_parceiras WHERE nome_empresa LIKE :filtro";
    //         $comando = $conexao->prepare($sql);             
    //         $comando->bindParam(":filtro", $filtro);
    //         $comando->execute();
    //         $lista = $comando->fetchAll(PDO::FETCH_ASSOC);
    //         $retorno["status"] = 1;
    //         $retorno["lista"] = $lista;
    //     }
    //     else if($tipo == "consultar"){
    //         $sql = "SELECT * FROM empresas_parceiras WHERE id_empresa = :id_empresa";
    //         $comando = $conexao->prepare($sql);             
    //         $comando->bindParam(":id_empresa", $id_empresa);
    //         $comando->execute();
    //         $dados = $comando->fetch(PDO::FETCH_ASSOC);
    //         if(!$dados){
    //             $retorno["status"] = 0;
    //             $retorno["mensagem"] = "Item não encontrado";
    //         }else{
    //             $retorno["status"] = 1;
    //             $retorno["dados"] = $dados;
    //         }
    //     }
    //     else if($tipo == "excluir"){
    //         $sql = "DELETE FROM empresas_parceiras WHERE id_empresa = :id_empresa";
    //         $comando = $conexao->prepare($sql);             
    //         $comando->bindParam(":id_empresa", $id_empresa);
    //         $comando->execute();
    //         $retorno["status"] = 1;
    //         $retorno["mensagem"] = "Sucesso ao excluir a posição com o código $id_empresa.";
    //     }
        
    //     else{
    //         $retorno["status"] = 0;     
    //         $retorno["mensagem"] = "Tipo de requisição inválido.";    
    //     }
    // }else{        
    //     $retorno["status"] = 0;   
    //     $retorno["mensagem"] = "Tipo de requisição não informado.";     
    // }
    // echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  
?>