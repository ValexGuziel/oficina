<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Solicitação de Serviços de Manutenção</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
            font-size: 18px;
            background-color: #3b387bff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            margin: 0;
            box-sizing: border-box;
        }

        .main-content {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .header-wrapper {
            display: flex;
            background: #fff;
            align-items: center;
            justify-content: space-around;
            width: 100%;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #000;
            border-radius: 8px;
        }

        .header-image {
            width: 100px;
            height: auto;
        }

        .container {
            width: 100%;
            background: #fff;
            padding: 50px;
            border-radius: 8px;
            border: 1px solid #000;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            background: #fff;
            align-items: center;
            justify-content: start;
            width: 100%;
            margin-top: 5px;

        }

        h1 {
            text-align: center;
            color: rgba(0, 0, 0, 1);
            text-shadow:
                -1px -1px 0 rgba(255, 166, 1, 1),
                1px -1px 0 rgba(255, 166, 1, 1),
                -1px 1px 0 rgba(255, 166, 1, 1),
                1px 1px 0 rgba(255, 166, 1, 1);
            margin: 0 20px;
            /* Adiciona margem horizontal para espaçamento */
        }


        h2 {
            color: #000000ff;

        }

        .solicitacao-atual {
            text-align: center;
            color: #000000;
            border-bottom: 1px solid #cfccccff;
        }

        form {
            margin-bottom: 2px;
            margin-top: 2px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            text-transform: uppercase;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 3px 3px 8px rgba(10, 1, 61, 0.4);
            box-sizing: border-box;
        }

        textarea {
            text-transform: uppercase;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 3px 3px 8px rgba(10, 1, 61, 0.4);
            box-sizing: border-box;
        }

        button,
        .view-solicitacoes-button {
            background-color: #2e802aff;
            color: white;
            font-size: 14px;
            padding: 10px 15px;
            border: 1px solid #114b0eff;
            border-radius: 30px;
            font-size: 14px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            margin-right: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        button:hover,
        .view-solicitacoes-button:hover {
            background-color: #176b16ff;
        }

        .form-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .form-row label {
            margin-bottom: 0;
            min-width: 80px;
        }

        .form-row input[type="text"],
        .form-row select {
            flex: 1 1 200px;
            width: auto;
            margin-bottom: 0;
        }

        .view-solicitacoes-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: 1px solid #0056b3;
            border-radius: 30px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            text-decoration: none;
            display: inline-block;
        }

        .view-solicitacoes-button:hover {
            background-color: #0056b3;
        }



        /* --- Media Queries --- */

        @media (max-width: 768px) {

            /* Estilos para o container principal */
            .container {
                padding: 20px;
            }

            /* Estilos para o cabeçalho em telas menores */
            .header-wrapper {
                flex-direction: column;
                align-items: center;
            }

            /* Espaçamento para as imagens no modo coluna */
            .header-image {
                margin-bottom: 10px;
            }

            /* Aumenta o tamanho da fonte do h1 para leitura em telas pequenas */
            h1 {
                font-size: 24px;
                margin: 10px 0;
            }

            /* Faz os campos do formulário se empilharem */
            .form-row {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            /* Estica os botões para ocupar a largura total */
            button,
            .view-solicitacoes-button {
                width: 100%;
                margin-bottom: 10px;
            }


        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #000000ff;
            /* Cor de fundo do rodapé */
            color: white;
            font-size: 14px;
            /* Cor do texto */
            text-align: center;
            padding: 10px 0;
            box-sizing: border-box;
            /* Garante que o padding não aumente a largura */
        }

        /* Outros estilos para garantir que o conteúdo não fique escondido */
        body {
            padding-bottom: 50px;
            /* Adicione um padding na parte inferior do body para evitar que o conteúdo seja coberto pelo rodapé */
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="header-wrapper">
            <img src="logo_mastig.png" alt="Logo Mastig" class="header-image">
            <h1>Solicitação de Serviços de Manutenção</h1>
            <img src="chave.jpg" alt="Logo Manutenção" class="header-image">
        </div>
        <div class="container">
            <form action="processar_os.php" method="POST">
                <div class="form-row">
                    <label for="cliente">Solicitante:</label>
                    <input type="text" id="cliente" name="cliente" required>

                    <label for="setor">Setor:</label>
                    <input type="text" id="setor" name="setor" required>
                </div>

                <div class="form-row">
                    <label for="equipamento">Equipamento / Tag:</label>
                    <input type="text" id="equipamento" name="equipamento" required>

                    <label for="prioridade">Prioridade:</label>
                    <select id="prioridade" name="prioridade" required>
                        <option value="BAIXA">BAIXA</option>
                        <option value="MÉDIA">MÉDIA</option>
                        <option value="ALTA">ALTA</option>
                        <option value="URGENTE">URGENTE</option>
                    </select>
                </div>

                <label for="descricao_problema">Descrição do Problema:</label>
                <textarea id="descricao_problema" name="descricao_problema" rows="2" required></textarea>

                <div class="buttons"><button type="submit" name="acao" value="adicionar">Abrir Solicitação</button>
                    <a href="lista_os.php" class="view-solicitacoes-button">Ver Solicitações</a>
                </div>
            </form>

            <p style="color: green; display: none;" class="flash-message success">Ordem de Serviço adicionada com
                sucesso!</p>
            <p style="color: red; display: none;" class="flash-message error">Ocorreu um erro na operação.</p>
        </div>
    </div>

    <script>
        const flashMessages = document.querySelectorAll('.flash-message');

        if (flashMessages.length > 0) {
            flashMessages.forEach(function (message) {
                setTimeout(function () {
                    message.remove();
                }, 5000);
            });
        }
    </script>
    <footer>
        <p>&copy; 2025 Mastig. Todos os direitos reservados.</p>
    </footer>

</body>

</html>