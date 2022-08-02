<?php
    include "../conexao.php";
    include "../funcoes.php";
    
    $retorno = array();
    extract($_POST);


    if(isset($tipo)){
        if($tipo == "cadastrar"){

            $imagem = uniqid().".jpg";
            converterImagem($_FILES["imagem"], "../imagens/logos/".$imagem, 70, 300, 300);

            $sql = "INSERT INTO logo VALUES(0, :logo)";
              $comando = $conexao->prepare($sql);
            $comando->bindParam(":logo", $imagem);
            $comando->execute();
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao cadastrar o logo.";       
                          
        }
        else if($tipo == "alterar"){
            $sql = "UPDATE empresas_parceiras  SET  nome_empresa = :nome_empresa, cnpj_empresa = :cnpj_empresa, cidade_empresa = :cidade_empresa, endereco_emprego = :endereco_emprego, estado_empresa = :estado_empresa WHERE id_empresa =:id_empresa";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":id_empresa", $txtid_empresa);
            $comando->bindParam(":nome_empresa", $txtnome_empresa);
            $comando->bindParam(":cnpj_empresa", $txtcnpj_empresa);
            $comando->bindParam(":cidade_empresa", $txtcidade_empresa);
            $comando->bindParam(":endereco_emprego", $txtendereco_emprego);
            $comando->bindParam(":estado_empresa", $txtestado_empresa);
            $comando->execute();
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao alterar cadastro.";                        
    }

        else if($tipo == "listagem"){
            $sql = "SELECT * FROM logo";
            $comando = $conexao->prepare($sql);             
            $comando->bindParam(":filtro", $filtro);
            $comando->execute();
            $lista = $comando->fetchAll(PDO::FETCH_ASSOC);
            $retorno["status"] = 1;
            $retorno["lista"] = $lista;
        }
        else if($tipo == "consultar"){
            $sql = "SELECT * FROM empresas_parceiras WHERE id_empresa = :id_empresa";
            $comando = $conexao->prepare($sql);             
            $comando->bindParam(":id_empresa", $id_empresa);
            $comando->execute();
            $dados = $comando->fetch(PDO::FETCH_ASSOC);
            if(!$dados){
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Item não encontrado";
            }else{
                $retorno["status"] = 1;
                $retorno["dados"] = $dados;
            }
        }
        else if($tipo == "excluir"){

            // $sqlVerificar  = "SELECT logo FROM logo WHERE id_logo=:id_logo";
            // $comandoLogo = $conexao -> prepare($sqlVerificar);
            // $comandoLogo->bindParam(":idlogo",$id_logo);
            // $comandoLogo->execute();
            // $nomeImagem = $comandoLogo->fetch(PDO::FETCH_ASSOC)["logo"];
            // unlink("../imagens/logos/$nomeImagem");

            $sql = "DELETE FROM logo WHERE id_logo = :id_logo";
            $comando = $conexao->prepare($sql);             
            $comando->bindParam(":id_logo", $id_logo);
            $comando->execute();
            $retorno["status"] = 1;
            $retorno["mensagem"] = "Sucesso ao excluir a posição com o código $id_logo.";
        
        
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