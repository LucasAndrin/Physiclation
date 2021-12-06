// desenha texto
function drawText(string, x, y, color) {
        var text = canvas.getContext('2d');
        text.clearRect(x - 2, y + 2, 12, -12); // faz o texto não ter um fundo que interfira
        text.font = '12px sans-serif';
        text.fillStyle = color;
        text.fillText(string, x, y);
}
// desenha vetores
function drawVetor(xVetor, yVetor, color, xObject, yObject, radians, degress, string) {
        var xText = (xVetor + xObject) / 2;
        var yText = (yVetor + yObject) / 2;
        var vetor = canvas.getContext('2d');
        vetor.beginPath();
        vetor.moveTo(xObject, yObject);
        vetor.lineTo(xVetor, yVetor);
        vetor.lineTo(10 * Math.cos(radians + (degress * (Math.PI / 180))) + xVetor, 10 * Math.sin(radians + (degress * (Math.PI / 180))) + yVetor);
        vetor.setLineDash([0, 0]);
        vetor.strokeStyle = color;
        vetor.stroke();
        vetor.closePath();
        drawText(string, xText, yText, color);
}
// desenha círculo com o raio que é dado pelo usuário
function drawCentralPoint() {
        var ctx = canvas.getContext('2d');
        var central = new Path2D();
        central.arc(0, 0, 3, 0, Math.PI * 2, true);
        central.fillStyle = 'green';
        ctx.fill(central);
}
// desenha círculo
function draw_circle(raio) {
        var circle = canvas.getContext('2d');
        circle.clearRect(-10000, -10000, 20000, 20000);
        circle.beginPath();
        circle.setLineDash([10, 4]);
        circle.arc(0, 0, raio, 0, (Math.PI * 2), true);
        circle.strokeStyle = 'black';
        circle.stroke();
        circle.closePath();
        drawCentralPoint();
}
// desenha objeto utilizando dados do localStorage
function draw_object_localStorage() {
        var raio2 = parseFloat(localStorage.getItem("raio"));
        var periodo2 = parseFloat(localStorage.getItem("periodo"));
        var t = parseFloat(localStorage.getItem("tempo"));
        var object = canvas.getContext('2d');
        object.beginPath();
        var w = (2 * (Math.PI)) / (periodo2); // velocidade angular
        var radians = w * t;
        var x = raio2 * Math.cos(radians); // posição x do objeto;
        var y = raio2 * Math.sin(radians); // posição y do objeto;
        object.arc(x, y, 7, 0, (Math.PI * 2), true);
        object.closePath();
        object.fillStyle = 'black';
        object.fill();
}
// função que executa animação e mudança de pause para play e vice versa
function animation(raio, periodo, aceleracao, linearV, angularV, frequencia, trajetoria) {
        // se estiver clicado no pause
        if (play.classList.value == "fas fa-pause") {
                play.classList.add("fa-play");
                play.classList.remove("fa-pause");
                if (aceleracao.checked) {
                        aceleracao = 1;
                } else {
                        aceleracao = 0;
                }
                if (linearV.checked) {
                        linearV = 1;
                } else {
                        linearV = 0;
                }
                if (angularV.checked) {
                        angularV = 1;
                } else {
                        angularV = 0;
                }
                if (frequencia.checked) {
                        frequencia = 1;
                } else {
                        frequencia = 0;
                }
                if(trajetoria.checked){
                        trajetoria = 1;
                } else {
                        trajeotira = 0;
                }
                window.open('MCU.php?id=' + idSimul + '&aceleration='+aceleracao+'&linearVelocity='+linearV+'&angularVelocity='+angularV+'&frequencia='+frequencia+'&trajetoria='+trajetoria, "_self");// mantém id da simulação no link
        } else { // se estiver clicado no play
                play.classList.add("fa-pause");
                play.classList.remove("fa-play");
                // verifica se a simulação já fora rodada
                if (localStorage.getItem("tempo") >= 0) {
                        var t = parseFloat(localStorage.getItem("tempo")); // simulação rodada anteriormente
                }
                var object = canvas.getContext('2d');
                // animação cíclica
                setInterval(function () {
                        var radius = raio.value;
                        var period = periodo.value;
                        draw_circle(radius);
                        var w = 2 * Math.PI / period; // velocidade angular º/s
                        var v = w * radius; // velocidade linear m/s
                        var a = Math.pow(v, 2) / radius; // aceleração centrípeta m/s²
                        var f = 1 / period; // frequência
                        var radians = w * t; // conversão para radianos
                        var x = radius * Math.cos(radians); // posição x do objeto
                        var y = radius * Math.sin(radians); // posição y do objeto
                        var xA = (radius - a) * Math.cos(radians); // posição x do vetor aceleracao
                        var yA = (radius - a) * Math.sin(radians); // posição y do vetor aceleracao
                        var xV = v * Math.cos(radians + (90 * (Math.PI / 180))) + x; // posição x do vetor velocidade
                        var yV = v * Math.sin(radians + (90 * (Math.PI / 180))) + y; // posição y do vetor velocidade
                        if (t >= period) {// encrementa t
                                t = 0.01;
                        } else {
                                t += 0.01;
                        }
                        // seta valores do raio, tempo e periodo no localStorage
                        localStorage.setItem('tempo', parseFloat(t));
                        localStorage.setItem('raio', parseFloat(radius));
                        localStorage.setItem('periodo', parseFloat(period));
                        // desenha objeto
                        object.beginPath();
                        object.arc(x, y, 7, 0, (Math.PI * 2), true);
                        object.fillStyle = '#26a429';
                        object.fill();
                        object.closePath();
                        // trajetorias dos vetores
                        if (trajetoria.checked) {
                                object.beginPath();
                                object.arc(x,y, v, 0, Math.PI*2, true);
                                object.stroke();
                                object.closePath();
                                object.beginPath();
                                object.arc(x,y, a, 0, Math.PI*2, true);
                                object.stroke();
                                object.closePath();
                        }
                        // drawVetor(xVetor, yVetor, color, xObject, yObject, radians, degress, string)
                        // desenha vetor aceleração centrípeta 
                        drawVetor(xA, yA, 'blue', x, y, radians, 30, 'a');
                        // desenha vetor velocidade linear
                        drawVetor(xV, yV, 'red', x, y, radians, -60, 'V');
                        var px = -200;
                        // desenha texto: drawText(string, x, y, color)
                        if (aceleracao.checked) {
                                px += 20;
                                drawText('Aceleração centrípeta ≈ ' + (Math.round(a * 100) / 100) + ' m/s²', 200, px, 'blue');
                        }
                        if (linearV.checked) {
                                px += 20;
                                drawText('Velocidade linear ≈ ' + (Math.round(v * 100) / 100) + ' m/s', 200, px, 'red');
                        }
                        if (angularV.checked) {
                                px += 20;
                                drawText('Velocidade angular ≈ ' + (Math.round(w * 100) / 100) + ' rad/s', 200, px, 'black');
                        }
                        if (frequencia.checked) {
                                px += 20;
                                drawText('Frequência ≈ ' + (Math.round(f * 100) / 100) + ' Htz', 200, px, 'black');
                        }
                }, 10); // 10 milissegundos de atraso
        }

}
window.onload = function () {
        // transladada simulação para ficar igual a um plano cartesiano
        canvas = document.getElementById('mcu'); // variável canvas é global
        var ctx = canvas.getContext('2d');
        ctx.translate(401, 213);
        // recolhe valores dos inputs
        var periodo = document.querySelector("#periodo");
        var raio = document.querySelector("#raio");
        // recolhe checkboxes
        var aceleracao = document.querySelector("#aceleration");
        var linearV = document.querySelector("#linearVelocity");
        var angularV = document.querySelector("#angularVelocity");
        var frequencia = document.querySelector("#frequency");
        var trajetoria = document.querySelector("#trajetoria");
        // btn play
        var btnPlay = document.querySelector("#btnPlay");
        var play = document.querySelector("#play");
        var restart = document.querySelector("#restart");
        play.classList.add("fas");
        play.classList.add("fa-play");
        // verifica se há raio no localStorage
        if (localStorage.getItem("raio") > 1) {
                raio.value = parseFloat(localStorage.getItem("raio"));
                document.querySelector("#raioText").innerHTML = raio.value/10;
        } else {
                localStorage.setItem('raio', parseFloat(115));
                document.querySelector("#raioText").innerHTML = 115;
                document.querySelector("#raio").value = 115;
        }
        // verifica se há periodo no localStorage
        if (localStorage.getItem("periodo") >= 1) {
                periodo.value = parseFloat(localStorage.getItem("periodo"));
                document.querySelector("#periodoText").innerHTML = periodo.value;
        } else {
                localStorage.setItem('periodo', parseFloat(5));
                document.querySelector("#periodoText").innerHTML = 5;
                document.querySelector("#periodo").value = 5;
        }
        // se houver tempo no localStorage, desenha objeto
        if (localStorage.getItem("tempo") > 0) {
                // desenha círculo
                draw_circle(raio.value);
                draw_object_localStorage();
        } else {
                localStorage.setItem('tempo', parseFloat(0));
                draw_circle(raio.value);
                draw_object_localStorage();
        }
        periodo.onchange = function (event) {
                event.preventDefault();
                document.querySelector("#periodoText").innerHTML = periodo.value;
                localStorage.setItem('periodo', parseFloat(periodo.value));
                if (play.classList.value == "fas fa-play") {
                        draw_circle(raio.value);
                        draw_object_localStorage();
                }
        }
        raio.onchange = function (event) {
                event.preventDefault();
                document.querySelector("#raioText").innerHTML = raio.value;
                localStorage.setItem('raio', parseFloat(raio.value));
                draw_circle(raio.value);
                if (play.classList.value == "fas fa-play") {
                        draw_object_localStorage();
                }
        }
        btnPlay.onclick = function (event) {
                event.preventDefault();
                animation(raio, periodo, aceleracao, linearV, angularV, frequencia, trajetoria);
        }
        restart.onclick = function (event) {
                event.preventDefault();
                localStorage.clear();
                window.open('MCU.php?id=' + idSimul, "_self");
        }
}