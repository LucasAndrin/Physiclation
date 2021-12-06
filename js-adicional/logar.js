window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick = function(event){
        event.preventDefault();
        var idEmail='#emailHelp';
        var idSenha='#senhaHelp';
        var email = document.querySelector('#email').value;
        var senha = document.querySelector('#senha').value;
        if (email=='') {
            document.querySelector(idEmail).innerHTML = "Preencha o campo!";
            document.querySelector(idSenha).innerHTML = "";
        } else if (senha=='') {
            document.querySelector(idEmail).innerHTML = "";
            document.querySelector(idSenha).innerHTML = "Preencha o campo!";
        } else {
            document.querySelector(idEmail).innerHTML = "";
            document.querySelector(idSenha).innerHTML = "";
            var dados = '?email='+email+'&senha='+senha;
            xhttpGet('actions/verificaLogin',function() {
                beforeSend(function(){
                    loading.innerHTML="Carregando";
                }
            ); sucess(function(){
                    var request = xhttp.responseText;
                    if (request==1) {
                        window.open('index.php', '_self');
                    } else if (request=='senha') {
                        document.querySelector(idEmail).innerHTML = "";
                        document.querySelector(idSenha).innerHTML = 'Senha inválida!';
                    } else {
                        document.querySelector(idSenha).innerHTML = "";
                        document.querySelector(idEmail).innerHTML = request;
                    }
                })
            }, dados);
        }
    }
}