function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
      currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}
function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick=function(event){
        event.preventDefault();
        var loading = document.querySelector("#loading");
        var nome = document.querySelector("#nome").value;
        var email = document.querySelector("#email").value;
        var senha = document.querySelector("#senha").value;
        var confSenha = document.querySelector("#confSenha").value;
        var valida = validateEmail(email);
        if (nome == '') {
            document.querySelector("#nomeHelp").innerHTML = "Nome Inválido!";
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
            document.querySelector("#confSenhaHelp").innerHTML = "";
        } else if (!valida) {
            document.querySelector("#emailHelp").innerHTML = "Email Inválido!";
            document.querySelector("#nomeHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
            document.querySelector("#confSenhaHelp").innerHTML = "";
        } else if (senha=='') {
            document.querySelector("#senhaHelp").innerHTML = "Senha Inválida";
            document.querySelector("#nomeHelp").innerHTML = "";
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#confSenhaHelp").innerHTML = "";
        } else if (confSenha=='') {
            document.querySelector("#confSenhaHelp").innerHTML = "Confirmaçao de Senha Inválida";
            document.querySelector("#nomeHelp").innerHTML = "";
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
        } else if(senha!=confSenha){
            document.querySelector("#confSenhaHelp").innerHTML = "As Senhas Devem Coincidir!";
        } else {
            document.querySelector("#nomeHelp").innerHTML = "";
            document.querySelector("#emailHelp").innerHTML = "";
            document.querySelector("#senhaHelp").innerHTML = "";
            document.querySelector("#confSenhaHelp").innerHTML = "";
            var parametros2 = '?email='+email+'&nome='+nome+'&senha='+senha;
            xhttpGet('actions/acaoCad',function() {
                beforeSend(function(){
                    loading.innerHTML="Carregando";
                });
                sucess(function(){
                    var request = xhttp.responseText;
                    if (request!='error') {
                        window.open('index.php', '_self');
                    } else {
                        document.querySelector("#emailHelp").innerHTML = "Email já foi cadastrado no sistema!";
                        loading.innerHTML="";
                    }
                })
            }, parametros2);
        }
    }
}