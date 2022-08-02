<?php
    include "../../conexao.php";
    include "../../funcoes.php";
    
    $retorno = array();
    extract($_POST);


    if(isset($tipo)){

        if($tipo == "excluir"){

        //  $sqlVerificar  = "SELECT logo FROM logo WHERE id_logo=:id_logo";
        //  $comandoLogo = $conexao -> prepare($sqlVerificar);
        //  $comandoLogo->bindParam(":idlogo",$id_logo);
        //  $comandoLogo->execute();
        //  $nomeImagem = $comandoLogo->fetch(PDO::FETCH_ASSOC)["logo"];
        //  unlink("../imagens/logos/$nomeImagem");

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