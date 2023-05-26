    let c1 = 0;
    let quizId = 0;
    let res = [];
    let header = document.querySelector(".pre-teste");
    let aulaId = header.getAttribute('data-id-aula');
    let forOpenQuiz = document.querySelector("#forOpenQuiz");
    var player = videojs('video', {
        playbackRates: [0.5, 1, 1.5, 2]
      });
    updateInfo();
    numeroTentativas();


    function hiddenLeft(element) {
        let nomeAula = element.querySelector('.nome-aula')
        let aula = element.querySelector('.aula');
        var isActive = !document.querySelector('.aula').classList.contains('d-none');
        if (isActive) {
            nomeAula.classList.add('w-100');
            aula.classList.add('d-none');
        } else {
            nomeAula.classList.remove('w-100');
            aula.classList.remove('d-none');
        }

    }



    function sendRequestAssistirAula() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=assistir-aula');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.response);
                let success = response['success'];
                if(success) {
                    updateInfo();
                }
            }
        };

        xhr.send();
    }


    function setWatchedVideo() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=concluir-aula');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.response);
                let success = response['success'];
                if(success) {
                }
            }
        };

        xhr.send();
    }
    
    function bloquearQuiz() {
        let quiz = document.querySelector(".quiz-status-header");
        quiz.innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
                        </div>
                    </div>`;
    }

    function bloquearAula() {
        let aula = document.querySelector("#toCollapseAula");
        let status = document.querySelector(".aula-status-header");
        aula.removeAttribute('data-toggle');
        
        status.innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
                        </div>
                    </div>`;
    }

    function liberarAula() {
        let aula = document.querySelector("#toCollapseAula");
        aula.setAttribute('data-toggle', 'collapse');
        
        let status = document.querySelector(".aula-status-header");
        status.innerHTML = '';
    }

    function liberarMaterialApoio() {
        let materialApoio = document.querySelector("#toCollapseMaterialApoio");
        let status = document.querySelector(".status-material-apoio-header");
        materialApoio.setAttribute('data-toggle', 'collapse');

        status.innerHTML = '';
    }

    function hasWatchedVideo() {
        return new Promise((resolve, reject) => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=info-situacao-aula');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response);
                    let success = response['success'];
                    let aula = response['aula'];
                    if(aula) {
                        resolve(true);
                    } else {
                        reject(false);
                    }
                }
            };

            xhr.send();
        });
    }


    function hasPreTeste() {
        return new Promise((resolve, reject) => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=info-situacao-pre-teste');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response);
                    let success = response['success'];
                    let preTeste = response['pre_teste'];
                    if(preTeste) {
                        resolve(true);
                    } else {
                        reject(false);
                    }
                }
            };

            xhr.send();
        });
    }


    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('check')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        });
    }


    function proximoPreTeste(btn) {


        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + quizId + "&resposta=" + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
            };

            xhr.send();
        }
    }


    function guardarResposta(id, valor) {
        localStorage.setItem(id, valor);
    }


    function limparTodasRespostas() {
        localStorage.clear();
    }

    function proximoQuiz(btn) {
        let marcado = document.querySelector("[name='check']:checked");
        guardarResposta(quizId, marcado.value);

        if(marcado) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                console.log(xhr.responseText);
                insertQuiz(aulaId);
            }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + res[0]['id_vid_aula'] + "&resposta=" + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                c1 += 1;
                insertQuiz(aulaId);
            }
            };

            xhr.send();
        }
    }

    function ultimoProximoQuiz() {
        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {

            }
            };

            xhr.send();
        }
    }


    function voltarPreTeste() {
        c1 -= 1;


        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-pre-teste');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                insertPreTeste(aulaId);
            }
        };

        xhr.send();
    }


    function finalizarPreTeste(event) {
        aulaId = res[c1]['id_vid_aula'];
        let marcado = document.querySelector("[name='check']:checked");
        if(marcado) {
                let xhr = new XMLHttpRequest();
                xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&id_quiz=' + quizId + "&resposta=" + marcado.value + "&acao=verificar-quiz-pre-teste");
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(this.response);
                }
            };

            xhr.send();
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_quiz=' + quizId + "&resposta=" + "&acao=verificar-quiz-pre-teste");
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                updateInfo();
            }
            };

            xhr.send();
        }
        

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + res[0]['id_vid_aula'] + '&acao=finalizar-pre-teste');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                let collapsePreTeste = document.getElementById('collapsePreTeste');
                
                document.querySelector('[data-target="#collapsePreTeste"]').removeAttribute('data-toggle');
                collapsePreTeste.classList.remove('show');
            }
        };

        xhr.send();

    }

    function vQuizEstaAberto() {
        let quiz = document.querySelector('#collapseQuiz');
        return quiz.classList.contains('show');
    }

    function numeroTentativas() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + "&acao=numero-tentativas");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                let numeroTentativas = response.num_tentativas;
                let numeroTentativasElement = document.querySelector('.numero-tentativas');
                numeroTentativasElement.innerHTML = numeroTentativas;
            }
        };

        xhr.send();
    }

    function updateInfo() {
        watchVideo();
        let quizEstaAberto = vQuizEstaAberto();
        if(quizEstaAberto) {
            bloquearMaterialApoio();
        }

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + "&acao=info-situacao-aula");
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                let preTeste = response.pre_teste;
                let quiz = response.quiz;
                let aula = response.aula;
                let collapsePreTeste = document.getElementById('collapsePreTeste');
                let toCollapaseAula = document.getElementById('toCollapseAula');
                let paused = player.paused()

                if(preTeste) {
                    let header = document.querySelector('.pre-teste-status-header');
                    header.innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>`;

                    document.querySelector('[data-target="#collapsePreTeste"]').removeAttribute('data-toggle');
                    collapsePreTeste.classList.remove('show');

                    if(!aula) {
                        bloquearQuiz();
                    }

                    if(!quizEstaAberto) {
                        liberarAula();
                        liberarMaterialApoio();
                    }
                }

                if(aula) {
                    if(!quizEstaAberto) {
                        liberarAula();
                        liberarMaterialApoio();
                    }

                    document.querySelector('.aula-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>
                    `;

                }

                if(quiz) {
                    forOpenQuiz.removeAttribute('data-target');
                    document.querySelector('.quiz-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div>
                    `;
                }


                if(preTeste && aula && !quiz && !quizEstaAberto) {
                    liberarQuiz();
                }

                if(!preTeste && !quiz && !quizEstaAberto) {
                    bloquearAula();
                    bloquearMaterialApoio();
                }

                if(!preTeste && !quiz && quizEstaAberto) {
                    bloquearAula();
                    bloquearMaterialApoio();
                }

                if(!preTeste && !aula && !quiz && !quizEstaAberto) {
                    bloquearQuiz();
                    bloquearAula();
                    bloquearMaterialApoio();
                }


                let quizFixacao = response.quiz;
            }
        };


        xhr.send();
    }

    function bloquearMaterialApoio() {
        document.querySelector('.status-material-apoio-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/icons8-lock-48.png" alt="" srcset="">
                        </div>
                    </div>`;
        
        let materialApoio = document.querySelector('#toCollapseMaterialApoio');
        let box = document.querySelector('#collapseMaterialApoio');
        box.classList.remove('show');
        materialApoio.removeAttribute('data-toggle');
    }

    document.querySelector('#toCollapseAula').addEventListener('click', () => {
        updateInfo();
    });

    document.querySelector('#toCollapseMaterialApoio').addEventListener('click', () => {
        updateInfo();
    });

    function naoAbrirAula() {
        let collapseAula = document.querySelector('#toCollapseAula');
        collapseAula.classList.remove('show');
        collapseAula.removeAttribute('data-toggle');
    }

    function abrirAula() {
        let collapseAula = document.querySelector('#toCollapseAula');
        collapseAula.setAttribute('data-toggle', 'collapse');
    }

    function naoAbrirQuiz() {
        let collapseQuiz = document.querySelector('#collapseQuiz');
        collapseQuiz.classList.remove('show');
        collapseQuiz.removeAttribute('data-toggle');
    }

    function abrirQuiz() {
        forOpenQuiz.setAttribute('data-target', '#collapseQuiz');
        forOpenQuiz.setAttribute('data-toggle', 'collapse');
    }

    function liberarQuiz() {
        forOpenQuiz.setAttribute('data-target', '#collapseQuiz');
        forOpenQuiz.setAttribute('data-toggle', 'collapse');

        let status = document.querySelector('.quiz-status-header');
        status.innerHTML = '';

    }

    function aulaEstaAberta() {
        let aula = document.querySelector('#toCollapseAula');
        return aula.classList.contains('show');
    }


    function wasWatchingVideo() {
        let video = document.querySelector('video');
        let time = video.currentTime;

    }


    forOpenQuiz.addEventListener('click', (event) => {
        updateInfo();
        // verificar se o video foi assistido
        hasWatchedVideo().catch(res => {
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            }).fire({
                icon: 'error',
                title: 'Você precisa assistir o vídeo para continuar!'
            });
        });
                            
        watchVideo();
    });

    function watchVideo() {
        hasWatchedVideo().then((res) => {
            document.querySelector('.collapseAula').classList.remove('show');
            document.getElementById('toCollapseAula').removeAttribute('data-toggle');
            // document.querySelector('[data-target="#collapseQuiz"]').setAttribute('data-toggle', 'collapse');

            let headerToCollapseAula = document.querySelector('.aula-status-header');
            headerToCollapseAula.innerHTML = `
            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
            `;
        });
    }



    document.querySelector('.btn-voltar-pre-teste').addEventListener('click', (event) => {
        if(c1 === 0) {
            throw new Error("Não pode voltar!");
        }

        let el = document.querySelector('.btn-proximo-pre-teste');
        if(c1 !== res.length - 2) {
            el.classList.remove('disabled');
        }
        voltarPreTeste()
    
    }); 


    document.querySelector('.btn-voltar-quiz').addEventListener('click', (event) => {
        if(c1 === 0) {
            throw new Error("Não pode voltar!");
        }
        
        c1--;
        insertQuiz(aulaId)

        if(!isLast()) {
            document.querySelector('.btn-proximo-quiz').classList.remove('disabled');
        }
    
    }); 


    document.querySelector('.btn-finalizar-pre-teste').addEventListener('click', (event) => {
        finalizarPreTeste(event);
        updateInfo();
    });

    document.querySelector('.btn-proximo-pre-teste').addEventListener('click', (event) => {

        if(c1 === res.length - 1) {
            throw new Error("Não pode ir!");
        }

        proximoPreTeste(event);

        let el = event.target;
        if(c1 === res.length - 2) {
            el.classList.add('disabled');
        }
    });

    document.querySelector('.btn-proximo-quiz').addEventListener('click', (event) => {
        if(c1 === res.length - 1) {
            throw new Error("Não pode ir!");
        }

        proximoQuiz(event.target)

        let el = event.target;
        if(c1 === res.length - 2) {
            el.classList.add('disabled');
        }

    });

    document.querySelector('.btn-finalizar-quiz').addEventListener('click', (event) => {
        ultimoProximoQuiz();
        finalizarQuiz(event);
        numeroTentativas();
    });

    let novaTentativa = () => {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=nova-tentativa-quiz&quiz_id=' + aulaId);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                
                    let response = JSON.parse(this.response);
                    let success = response['success'];
                    if(success) {
                        c1 = 0;
                        updateInfo();
                    }
                }
            };

            xhr.send();
        }

    function mensagemTentarDnv(text) {

        return Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: text,
            footer: '<a href>Why do I have this issue?</a>'
        });
    }



    function isLast() {
        if(c1 === res.length - 1) {
            return true;
        }
        return false;
    }

    function finalizarQuiz(event) {
        let el = event.target;
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=finalizar-quiz&quiz_id=' + quizId);
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response);
            let success = response['success'];
            let aprovado = response['aprovado'];
            let message = response['text'];
            if(success) {
                document.querySelector('.quiz-status-header').innerHTML = `
                    <div class="mr-auto bg-white ml-n3">
                        <div class="max" style="max-width: 42px;">
                            <img src="/assets/images/check-mark-7-48.png" alt="" srcset="">
                        </div>
                    </div`;

                closeFinalizarQuiz();

                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire({
                    icon: 'success',
                    title: 'Quiz finalizado com sucesso!'
                });
            } else {

                mensagemTentarDnv(message).then((result) => {
                    if(result.isConfirmed) {
                        c1 = 0;
                        insertQuiz(aulaId);
                        limparTodasRespostas();
                        document.querySelector('.btn-proximo-quiz').classList.remove('disabled'); // liberar o botão de proximo novamente
                    }
                });
            }
        
        };
        };

        updateInfo();
        xhr.send();
    }

    function closeFinalizarQuiz() {
        let collapseQuiz = document.getElementById('collapseQuiz');
        collapseQuiz.classList.remove('show');
        document.querySelector('[data-target="#collapseQuiz"]').removeAttribute('data-toggle');
        updateInfo();
    }


    function inputNotaAula() {

        let request = (nota, comentario) => {
            
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=input-nota&nota=' + nota + "&comentario=" + comentario);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(this.response);
                    let success = response.success;        
                };
            };

            xhr.send();
        }

        Swal.fire({
            title: 'De 0 a 10 o quanto você recomendaria esta aula.',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            html: '<input placeholder="Nota" type="number" max="10" id="swal-input1" class="swal2-input">' + '<input placeholder="Comentário" id="swal-input2" class="swal2-input">',

            preConfirm: function() {
                let nota = document.getElementById('swal-input1').value;
                let comentario = document.getElementById('swal-input2').value;
                request(nota, comentario);

                return new Promise(function(resolve, reject) {
                    resolve({
                        nota: document.getElementById('swal-input1').value,
                        comentario: document.getElementById('swal-input2').value,
                    });
                });
            },
            showCancelButton: true,
        }).then((result) => {
            if (result.value.nota <= 10) {
                updateInfo();

                Swal.fire({
                    title: 'Nota inserida com sucesso!',
                });
            } else if(result.value.nota > 10) {
                Swal.fire({
                    title: 'Nota inválida!<br>Digite novamente.',
                }).then((result) => {
                    inputNotaAula();
                });
                
            }
        })
    }


    function insertPreTeste(aulaId) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-pre-teste');
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response)[0];
            res = response['result'];
            let success = response['success'];
            let titulo = document.querySelector('.titulo-quiz-pre-teste');
            titulo.innerHTML = '';
            if(success) {
                document.querySelector('.questoes-pre-teste').innerHTML = '';      

                let key = res[c1];
                let id = key['id_pre_teste'];
                quizId = id;

                let alternativaA = key['alternativa_a'];
                let alternativaB = key['alternativa_b'];
                let alternativaC = key['alternativa_c'];
                let alternativaD = key['alternativa_d'];
                let alternativaE = key['alternativa_e'];
                let usuarioResposta = key['usuario_resposta'];


                let pergunta = key['pergunta'];
                titulo.innerHTML = pergunta;
                
                let a = '<div data-questao-id="'+ id +'" class="mt-3 form-check"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"> <div> <input type="checkbox" class="pre-teste" onclick="onlyOne(this)" name="check" value="A" style="width: 50px; height: 30px;"> </div> <span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaA +'</span> </span></div>';
                document.querySelector('.questoes-pre-teste').innerHTML += a;
                if(alternativaB) {
                    let b = '<div data-questao-id="'+ id +'" class="form-check"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div> <input type="checkbox" class="pre-teste" onclick="onlyOne(this)" name="check" value="B" style="width: 50px; height: 30px;"> </div> <span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaB +'</span> </span></div>';
                    document.querySelector('.questoes-pre-teste').innerHTML += b;
                }
                if(alternativaC) {
                    let c = '<div data-questao-id="'+ id +'" class="form-check"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div><input type="checkbox" onclick="onlyOne(this)" class="pre-teste" name="check" value="C" style="width: 50px; height: 30px;"></div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaC +'</span> </span></div>';
                    document.querySelector('.questoes-pre-teste').innerHTML += c;
                }


                if(alternativaD) {
                    let d = '<div data-questao-id="'+ id +'" class="form-check"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div><input type="checkbox" onclick="onlyOne(this)" class="pre-teste" name="check" value="D" style="width: 50px; height: 30px;"></div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                    document.querySelector('.questoes-pre-teste').innerHTML += d;
                }


                if(alternativaE) {
                        let e = '<div data-questao-id="'+ id +'" class="form-check"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div><input type="checkbox" class="pre-teste" onclick="onlyOne(this)" name="check" value="E" style="width: 50px; height: 30px;"></div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaE +'</span> </span></div>';
                        document.querySelector('.questoes-pre-teste').innerHTML += e;
                }
                
                let inPage = document.querySelector('input[value="'+usuarioResposta+'"]');
                inPage.checked = true;
            }
            }
        };
        xhr.send();
    }


    function insertQuiz(aulaId) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'v2.php?id_aula=' + aulaId + '&acao=get-quiz');
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(this.response)[0];
            res = response['result'];
            let resLast = res.length - 1;
            let success = response['success'];
            let questoes = '';
            let titulo = document.querySelector('.titulo-quiz-quiz');
            titulo.innerHTML = '';
            if(success) {
                document.querySelector('.questoes-quiz').innerHTML = '';      
                let key = res[c1];
                let id = key['id_quiz'];

                let alternativaA = key['alternativa_a'];
                let alternativaB = key['alternativa_b'];
                let alternativaC = key['alternativa_c'];
                let alternativaD = key['alternativa_d'];
                let alternativaE = key['alternativa_e'];

                let pergunta = key['pergunta'];
                titulo.innerHTML = pergunta;
                
                let a = '<div data-questao-id="'+ id +'" class="mt-3"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div> <input class="quiz" type="checkbox" onclick="onlyOne(this)" name="check" value="A" style="width: 50px; height: 30px;"> </div> <span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaA +'</span> </span></div>';
                document.querySelector('.questoes-quiz').innerHTML += a;
                
                if(alternativaB) {
                    let b = '<div data-questao-id="'+ id +'"><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div> <input class="quiz" type="checkbox" onclick="onlyOne(this)" name="check" value="B" style="width: 50px; height: 30px;">  </div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaB +'</span> </span></div>';
                    document.querySelector('.questoes-quiz').innerHTML += b;
                }

                if(alternativaC) {
                    let c = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"> <div> <input class="quiz" type="checkbox" onclick="onlyOne(this)" name="check" value="C" style="width: 50px; height: 30px;"> </div> <span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaC +'</span> </span></div>';
                    document.querySelector('.questoes-quiz').innerHTML += c;
                }


                if(alternativaD) {
                    let d = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div> <input class="quiz" type="checkbox" onclick="onlyOne(this)" name="check" value="D" style="width: 50px; height: 30px;"> </div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaD +'</span> </span></div>';
                    document.querySelector('.questoes-quiz').innerHTML += d;
                }

                if(alternativaE) {
                    let e = '<div data-questao-id="'+ id +'" class=""><div class="d-flex flex-row texto-modulo-accordion ml-2 p-2" style="color: #88E450; font-size: 2vh;"><div> <input type="checkbox" class="quiz" onclick="onlyOne(this)" name="check" value="E" style="width: 50px; height: 30px;"> </div><span class="titulo-quiz mt-1"> <span class="titulo-quiz">'+ alternativaE +'</span> </span></div>';
                    document.querySelector('.questoes-quiz').innerHTML += e;
                }
                
                quizId = id;
                let salvo = localStorage.getItem(quizId);
                if(salvo) {
                    let inPage = document.querySelector('input[value="'+ localStorage.getItem(quizId) +'"]');
                    console.log(inPage);
                    inPage.checked = true;
                }

            }
            }
        };

        xhr.send();
    }

    function materialApoioEstaAberto() {
        let materialApoio = document.querySelector('#collapseMaterialApoio');
        let materialApoioAberto = materialApoio.classList.contains('show');
        if(materialApoioAberto) {
            return true;
        } else {
            return false;
        }
    }

    document.querySelector(".quiz-fixacao-header").addEventListener('click', () => {
        let materialApoio = materialApoioEstaAberto();
        if(materialApoio) {
            document.querySelector('#collapseMaterialApoio').classList.remove('show');
        }
        updateInfo();
        insertQuiz(aulaId);
    });

    
    header.addEventListener('click', () => {
        insertPreTeste(aulaId);
    });


    function redirect(id) {
        location.href = "home.php?acao=treinamento-video&id_vid=" + id;
    }

    
    let handleWatchedVideo = false;
    player.on('timeupdate', function() {
        var duration = player.duration();
        var currentTime = player.currentTime();
        var threshold = duration * 1; // verificar se o usuário assistiu a 100% do vídeo

        if (currentTime >= threshold && handleWatchedVideo != true) {
            handleWatchedVideo = true;
            hasWatchedVideo().catch(function(watched) {
                inputNotaAula();
            })
            player.pause();
            setWatchedVideo();
        }

    });

