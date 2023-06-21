$(document).ready(function () {
    // Função para atualizar as opções do segundo select
    function atualizarOpcoes() {
        var primeiroSelect = $('#unidade1');
        var segundoSelect = $('#turma1');

        // Limpar as opções do segundo select
        segundoSelect.empty();

        // Obter a opção selecionada do primeiro select
        var opcaoSelecionada = primeiroSelect.val();

        // Adicionar as opções correspondentes ao segundo select
        if (opcaoSelecionada === 'ph1') {
            segundoSelect.append($('<option>', {
                value: 'ph2',
                text: 'Qual a Turma?'
            }));
        } else if (opcaoSelecionada === 'BC-COC' || opcaoSelecionada === 'RDS-COC' || opcaoSelecionada === 'LG-COC' || opcaoSelecionada === 'BLU-COC') {
            // COC Online selecionado, ocultar as opções do 1º, 2º e 3º ano
            segundoSelect.append($('<option>', {
                value: 'ph2',
                text: 'Qual a Turma?'
            }));
            segundoSelect.append($('<option>', {
                value: '1ano',
                text: '1º Ano'
            }));
            segundoSelect.append($('<option>', {
                value: '2ano',
                text: '2º Ano'
            }));
            segundoSelect.append($('<option>', {
                value: '3ano',
                text: '3º Ano'
            }));
            segundoSelect.append($('<option>', {
                value: 'semi',
                text: 'Semi Extensivo'
            }));
            segundoSelect.append($('<option>', {
                value: 'extensivo',
                text: 'Extensivo'
            }));
            segundoSelect.append($('<option>', {
                value: 'prep-enem',
                text: 'Preparatório ENEM'
            }));
            segundoSelect.append($('<option>', {
                value: 'acafe',
                text: 'Método ACAFE'
            }));
            segundoSelect.append($('<option>', {
                value: 'ufsc',
                text: 'Operação UFSC'
            }));
        } else if (opcaoSelecionada === 'ONLINE-COC') {
            // COC Online selecionado, ocultar as opções do 1º, 2º e 3º ano
            segundoSelect.append($('<option>', {
                value: 'ph2',
                text: 'Qual a Turma?'
            }));
            segundoSelect.append($('<option>', {
                value: 'semi',
                text: 'Semi Extensivo'
            }));
            segundoSelect.append($('<option>', {
                value: 'extensivo',
                text: 'Extensivo'
            }));
            segundoSelect.append($('<option>', {
                value: 'prep-enem',
                text: 'Preparatório ENEM'
            }));
            segundoSelect.append($('<option>', {
                value: 'acafe',
                text: 'Método ACAFE'
            }));
            segundoSelect.append($('<option>', {
                value: 'ufsc',
                text: 'Operação UFSC'
            }));
        }
    }

    // Evento de mudança no primeiro select
    $('#unidade1').change(atualizarOpcoes);
});




$(document).ready(function () {
    $(document).ready(function () {
        $("#nomecompleto").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "consulta.php",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        var results = data.nomes.slice(0, 5); // Limita a 5 resultados
                        response(results); // Lista de auto completar para o campo de nome
                    }
                });
            },
            minLength: 2
        });

        $("#vestibular1").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "consulta.php",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        var results = data.vestibulares.slice(0, 5); // Limita a 5 resultados
                        response(results); // Lista de auto completar para o campo de vestibular
                    }
                });
            },
            minLength: 2
        });
    });
})




$(document).ready(function () {
    function carregarImagemDeFundo() {
        const accessKey = 'r0WCPhhzSpWTykWO0KYIcqhFBIraTFah3yNQUfybERY';
        const theme = 'nature'; // Substitua com o tema desejado

        // Parâmetros da busca
        const params = new URLSearchParams({
            client_id: accessKey,
            orientation: 'landscape',
            query: theme,
            count: 1
        });

        // Faz uma chamada à API do Unsplash para buscar uma imagem aleatória
        fetch(`https://api.unsplash.com/photos/random?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                // Obtém a URL da imagem aleatória
                const imageUrl = data[0]?.urls?.regular;

                // Define a imagem como background do body usando CSS
                document.body.style.backgroundImage = `url(${imageUrl})`;
            })
            .catch(error => {
                console.log(error);
                // Define a imagem padrão como background do body caso ocorra um erro
                document.body.style.backgroundImage = 'url(https://images.unsplash.com/photo-1682687220566-5599dbbebf11?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1075&q=80)';
            });
    }

    // Chama a função para carregar a imagem de fundo quando a página é carregada
    carregarImagemDeFundo();
});







