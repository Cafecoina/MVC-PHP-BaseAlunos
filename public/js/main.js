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
