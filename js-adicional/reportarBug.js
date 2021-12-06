window.onload = function(){
    var btn = document.querySelector("#submit");
    btn.onclick = function(event){
        event.preventDefault();
        var descriptHelp='#descriptHelp';
        var descript = document.querySelector('#descript').value;
        if (descript=='') {
            document.querySelector(descriptHelp).innerHTML = "Preencha o campo!";
        } else {
            document.querySelector(descriptHelp).innerHTML = "";

            var url = new URL(location.href);
            var id = url.searchParams.get("id");
            
            var dados = '?descript='+descript+'&id='+id;
            xhttpGet('actions/reportarBug',function() {
                beforeSend(function(){
                    loading.innerHTML="Carregando";
                }
            ); sucess(function(){
                    var request = xhttp.responseText;
                    console.log(id);
                    if (request==1) {
                        window.open('simulation/MCU.php?id='+id, '_self');
                    } else {
                        loading.innerHTML = 'erro no sistema';
                    }
                })
            }, dados);
        }
    }
}