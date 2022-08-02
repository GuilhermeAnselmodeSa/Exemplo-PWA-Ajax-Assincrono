<?php
    include "../../conexao.php";
    include "../../funcoes.php";
    
    $retorno = array();
    extract($_POST);


    if(isset($tipo)){
        if($tipo == "cadastrar"){

            $imagem = uniqid().".jpg";
            converterImagem($_FILES["imagem"], "../../imagens/logos/".$imagem, 70, 300, 300);

            $sql = "INSERT INTO logo VALUES(0, :logo)";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":logo", $imagem);
            $comando->execute();
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao cadastrar o logo.";       
                          
        }       else{
            $retorno["status"] = 0;     
            $retorno["mensagem"] = "Tipo de requisição inválido.";    
        }
    }else{        
        $retorno["status"] = 0;   
        $retorno["mensagem"] = "Tipo de requisição não informado.";     
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  

?>