<?php
    require_once "conexao.php";

    function certificarLogin(){
        global $conexao;
        if(isset($_COOKIE["token"], $_COOKIE["idusuario"])){
            //verificando se os cookies são válidos
            $sql = "SELECT count(*) 'existe' FROM dispositivo WHERE token=:token AND fkusuario=:idusuario AND NOW()<DATE_ADD(datacriacao, INTERVAL 30 DAY)";
            $comando = $conexao->prepare($sql);
            $comando->bindParam(":token", $_COOKIE["token"]);
            $comando->bindParam(":idusuario", $_COOKIE["idusuario"]);
            $comando->execute();
            $verificar = $comando->fetch(PDO::FETCH_ASSOC);
            if($verificar["existe"] == 1){
                return 1;
            }else{
                return 0;
            }

        }else{
            return 0;
        }
    }

    $fim = time() + ((3600*24)*15);
    extract($_POST);
    $retorno = array();
    $navegador = $_SERVER["HTTP_USER_AGENT"];
    if (isset($tipo)) {
        if ($tipo == "logar" && isset($email, $senha)) {
            //logar
            $sql = "SELECT idusuario, nome, senha FROM usuario WHERE email=:email";
            $cmd = $conexao->prepare($sql);
            $cmd->bindParam(":email", $email);
            $cmd->execute();
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);
            if (isset($dados["idusuario"])){
                //Usuario encontrado com o email indicado
                if (password_verify($senha, $dados["senha"])) {
                    //Caso a verificação for verdadeira, realiza o login
                    $retorno["status"] = 1;
                    $retorno["nome"] = $dados["nome"];
                    $retorno["idusuario"] = $dados["idusuario"];

                    $token = bin2hex(random_bytes(32));
                    $sqlDispositivo = "INSERT INTO dispositivo VALUES(0,:so,NOW(),:token,:fkusuario)";
                    $cmdDispositivo = $conexao->prepare($sqlDispositivo);
                    $cmdDispositivo->bindParam(":so",$navegador);
                    $cmdDispositivo->bindParam(":token",$token);
                    $cmdDispositivo->bindParam(":fkusuario",$dados["idusuario"]);
                    $cmdDispositivo->execute();

                    setcookie("token", $token, $fim, "/Trabalho_PAM");
                    setcookie("idusuario", $dados["idusuario"], $fim, "/Trabalho_PAM");

                }else{
                    //Senha incorreta
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Senha inválida";
                }
            }else{
                //Usuario não encontrado
                $retorno["status"] = 0;
                $retorno["mensagem"] = "Usuario não encontrado";
            }
            
        } else if($tipo == "cadastrar" && isset($email, $senha, $nome)){
            //cadastrar
            $sql = "INSERT INTO usuario VALUES(0, :nome, :email, :senha)";
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $cmd = $conexao->prepare($sql);
            $cmd->bindParam(":nome", $nome);
            $cmd->bindParam(":email", $email);
            $cmd->bindParam(":senha", $senha);
            if ($cmd->execute()) {
                $retorno["status"] = 1;
                $retorno["mensagem"] = "Cadastro realizado com sucesso";
            }
        }
        else if($tipo == "deslogar"){

            if(certificarLogin()){
                $sql = "DELETE FROM dispositivo WHERE fkusuario = :fkusuario AND token=:token";
                $comando = $conexao->prepare($sql);
                $comando->bindParam(":fkusuario", $_COOKIE["idusuario"]);
                $comando->bindParam(":token", $_COOKIE["token"]);
                $comando->execute();
                setcookie("idusuario", 0, time() - 1);
                setcookie("token", 0, time() - 1);
                $retorno["status"] = 1;
            }else{
                $retorno["status"] = 0;
            }
        } else if($tipo == "deslogar_todos"){

            if(certificarLogin()){
                $sql = "DELETE FROM dispositivo WHERE fkusuario = :fkusuario";
                $comando = $conexao->prepare($sql);
                $comando->bindParam(":fkusuario", $_COOKIE["idusuario"]);
                $comando->execute();
                setcookie("idusuario", 0, time() - 1);
                setcookie("token", 0, time() - 1);
                $retorno["status"] = 1;
            }else{
                $retorno["status"] = 0;
            }
        }
        else if($tipo == "verificar_token"){
            $retorno["status"] = certificarLogin();
        }
    }else {
        $retorno["status"] = 0;
        $retorno["mensagem"] = "Requisição inválida";
    }

    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);

?>