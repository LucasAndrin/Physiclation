window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick = function(event){
        event.preventDefault();
        var idSenha='#senhaHelp';
        var idNovaSenha='#novaSenhaHelp';
        var idConfNovaSenha='#confNovaSenhaHelp';

        var senha = document.querySelector('#senha').value;
        var novaSenha = document.querySelector('#novaSenha').value;
        var confNovaSenha = document.querySelector('#confNovaSenha').value;

        if (senha=='') {
            document.querySelector(idSenha).innerHTML = "Preencha o campo!";
            document.querySelector(idNovaSenha).innerHTML = "";
            document.querySelector(idConfNovaSenha).innerHTML = "";
        } else if (novaSenha=='') {
            document.querySelector(idSenha).innerHTML = "";
            document.querySelector(idNovaSenha).innerHTML = "Preencha o campo!";
            document.querySelector(idConfNovaSenha).innerHTML = "";
        } else if (confNovaSenha=='') {
            document.querySelector(idSenha).innerHTML = "";
            document.querySelector(idNovaSenha).innerHTML = "";
            document.querySelector(idConfNovaSenha).innerHTML = "Preencha o campo!";
        } else {
            document.querySelector(idSenha).innerHTML = "";
            document.querySelector(idNovaSenha).innerHTML = "";
            document.querySelector(idConfNovaSenha).innerHTML = "";
            var dados = '?senha='+senha+'&novaSenha='+novaSenha+'&confNovaSenha='+confNovaSenha;
            xhttpGet('actions/alterarSenha',function() {
                beforeSend(function(){
                    loading.innerHTML="Carregando";
                }
            ); sucess(function(){
                    var request = xhttp.responseText;
                    if (request==1) {
                        window.open('index.php', '_self');
                    } else if (request=='confSenha') {
                        document.querySelector(idConfNovaSenha).innerHTML = "Confirmação de Senha inválida!";
                        document.querySelector(idSenha).innerHTML = '';
                        document.querySelector(idNovaSenha).innerHTML = '';
                    } else if(request=='senha') {
                        document.querySelector(idConfNovaSenha).innerHTML = "";
                        document.querySelector(idSenha).innerHTML = "Senha Inválida!";
                        document.querySelector(idNovaSenha).innerHTML = "";
                    } else if (request=='senhaNovaSenha') {
                        document.querySelector(idConfNovaSenha).innerHTML = "";
                        document.querySelector(idSenha).innerHTML = "";
                        document.querySelector(idNovaSenha).innerHTML = "Sua Senha Antiga e Nova Senha São Iguais!";
                    } else {
                        loading.innerHTML = 'erro no sistema';
                    }
                })
            }, dados);
        }
    }
}