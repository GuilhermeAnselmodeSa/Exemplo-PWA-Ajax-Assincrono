verificarLogin((retorno)=>{
    if(retorno.status == 0){
        window.open("index.html", "_top");
    }
});

function deslogar(acao){
    let dados = new FormData();
    dados.append("tipo", acao);
    Ajax("POST", URL_WEBSERVICE + "webservice.php", dados, (r)=>{
        if(r.status == 1){
            window.open("index.html", "_top");
        }
    });
}