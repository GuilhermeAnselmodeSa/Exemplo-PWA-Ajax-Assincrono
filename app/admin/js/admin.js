const formLogin = document.getElementById("form-login");
const formCadastro = document.getElementById("form-cadastro");

redirecionar = function(retorno){
    if(retorno.status == 1){
        setTimeout(() => {
            window.open("cadastro.html", "_top");
        }, 1500);
    }
}

confirmCadastro = function(retorno){
    if (retorno.status == 1){
        M.toast({html: retorno.mensagem, classes:"deep-red lighten-2 top-toast"});
        formCadastro.reset();
    } else {
        M.toast({html: retorno.mensagem, classes:"deep-red lighten-2 top-toast"});
    }
}

formCadastro.addEventListener("submit", (e)=>{

    //Cancelando submit
    e.preventDefault();
    let dados = new FormData(formCadastro);
    dados.append("tipo", "cadastrar");
    Ajax("POST", URL_WEBSERVICE + "webservice.php", dados, confirmCadastro);
});

confirmLogin = function(retorno){
    if (retorno.status == 1){
        M.toast({html: retorno.nome, classes:"deep-purple lighten-2 top-toast"});
        redirecionar(retorno);
    } else {
        M.toast({html: retorno.mensagem, classes:"deep-purple lighten-2 top-toast"});
    }
}

formLogin.addEventListener("submit", (e)=>{

    e.preventDefault();
    let dados = new FormData(formLogin);
    dados.append("tipo", "logar");
    Ajax("POST", URL_WEBSERVICE + "webservice.php", dados, confirmLogin);
});

verificarLogin((retorno)=>{
    if(retorno.status == 1){
        window.open("cadastro.html", "_top");
    }
}); 
