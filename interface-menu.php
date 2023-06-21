<?php
session_start();
// Verifica se o usuário está autenticado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redireciona para a página de login
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagens</title>
    <!-- Inclua aqui os links para os estilos CSS do Bootstrap -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-padrao">
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="logo">
            <img src="./assets/IMG/logo-login.png" alt="Logo da Empresa">
        </div>
        <div class="card">
            <div class="card-body text-center">
                <h1 class="card-title">Upload de Imagens</h1>

                <form id="uploadForm" method="POST" action="envio.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input id="nomecompleto" type="text" class="form-control" name="field1" placeholder="Nome Completo" required>
                        <datalist id="nomesList"></datalist>
                    </div>

                    <div class="mb-3">
                        <select id="unidade1" class="form-select" name="Unidade" required>
                            <option value="ph1">Qual a unidade?</option>
                            <option value="BC-COC">COC Balneário Camboriú</option>
                            <option value="RDS-COC">COC Rio do Sul</option>
                            <option value="LG-COC">COC Lages</option>
                            <option value="BLU-COC">COC Blumenau</option>
                            <option value="ONLINE-COC">COC Online</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <select id="turma1" class="form-select" name="Turma" required>
                            <option value="ph2">Qual a turma?</option>
                            <option value="1ano">1º Ano</option>
                            <option value="2ano">2º Ano</option>
                            <option value="3ano">3º Ano</option>
                            <option value="semi">Semi Extensivo</option>
                            <option value="extensivo">Extensivo</option>
                            <option value="prep-enem">Preparatório ENEM</option>
                            <option value="acafe">Método ACAFE</option>
                            <option value="ufsc">Operação UFSC</option>
                        </select>
                    </div>



                    <div class="mb-3">
                        <input id="vestibular1" type="text" class="form-control" name="vestibular" placeholder="Vestibular que passou" required>
                        <datalist id="vestibularesList"></datalist>
                    </div>



                    <div class="mb-3">
                        <select id="anoaprovacao1" class="form-select" name="Ano" required>
                            <option value="ph3">Ano de Aprovação</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" name="descricao" placeholder="Observações"></textarea>
                    </div>

                    <!-- E assim por diante para os demais campos -->

                    <div class="mb-3">
                        <input type="file" class="form-control" name="imagem[]" accept="image/*, video/*" multiple required>
                    </div>

                    <div class="mb-3 form-check">
                        <input id="unicoaluno1" type="checkbox" class="form-check-input" name="unicoaluno1" required>
                        <label class="form-check-label" for="agreeCheckbox">Todas as imagens pertencem
                            ao mesmo aluno</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
        <div class="footer">
            <p>©2023 - Todos direitos reservados - NotaMáxima</p>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#nomecompleto").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "consulta.php",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            var results = data.nomes.slice(0, 5); // Limita a 5 resultados
                            response(results); // Lista de auto completar para o campo de nome
                        }
                    });
                },
                minLength: 2
            });

            $("#vestibular1").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "consulta.php",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            var results = data.vestibulares.slice(0, 5); // Limita a 5 resultados
                            response(results); // Lista de auto completar para o campo de vestibular
                        }
                    });
                },
                minLength: 2
            });
        });
    </script>



    <script>
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
    </script>



    <script src="./assets/js/main.js"></script>

</body>

</html>