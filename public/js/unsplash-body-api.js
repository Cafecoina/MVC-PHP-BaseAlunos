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