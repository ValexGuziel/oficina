<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// **Removida a lógica de busca de ordens de serviço, pois agora estará em lista_os.php**
// $sql_select = "SELECT * FROM ordens_servico ORDER BY data_abertura ASC";
// $result = $conn->query($sql_select);

?>

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
            margin: 20px;
            background-color: #3b387bff;
        }

        .container {
            max-width: 80vw;
            margin: auto;
            background: #ffffffff;
            padding: 20px;
            border-radius: 8px;

        }

        h1 {
            text-align: center;
            border-bottom: 1px solid #818080ff;
            color: #000000;
        }


        h2 {
            color: #000000;

        }

        .solicitacao-atual {
            text-align: center;
            color: #000000;
            border-bottom: 1px solid #818080ff;
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
        textarea,
        select {
            text-transform: uppercase;
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: rgba(185, 182, 221, 0.5);
            box-shadow: 3px 3px 8px rgba(10, 1, 61, 0.4);
        }

        button {
            background-color: #2e802aff;
            color: white;
            padding: 10px 15px;
            border: 1px solid #114b0eff;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            /* Sombra: offset-x, offset-y, blur-radius, color */
            margin-right: 10px;
            /* **Adicionado para espaçar os botões** */
        }

        button:hover {
            background-color: #176b16ff;

        }

        /* **Estilos para alinhar labels e inputs na mesma linha** */
        .form-row {
            display: flex;
            align-items: center;
            /* Alinha verticalmente no centro */
            gap: 20px;
            /* Espaço entre os elementos na linha */
            margin-bottom: 10px;
            /* Espaço abaixo da linha */
        }

        .form-row label {
            margin-bottom: 0;
            /* Remove a margem inferior padrão do label */
            min-width: 80px;
            /* Garante que o label tenha um tamanho mínimo */
        }

        .form-row input[type="text"],
        .form-row select {
            flex-grow: 1;
            /* Permite que o input preencha o espaço restante */
            width: auto;
            /* Anula o width fixo para permitir flex-grow */
            margin-bottom: 0;
            /* Remove a margem inferior padrão do input */
        }

        /* **Estilo para o novo botão de ver solicitações** */
        .view-solicitacoes-button {
            background-color: #007bff;
            /* Cor azul para destaque */
            color: white;
            padding: 10px 15px;
            border: 1px solid #0056b3;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            text-decoration: none;
            /* Para parecer um botão */
            display: inline-block;
            /* Para o padding funcionar */
            /* **Removido margin-top para ficar na mesma linha** */
        }

        .view-solicitacoes-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Solicitação de Serviço de Manutenção</h1>

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success_add') {
                echo '<p style="color: green;">Ordem de Serviço adicionada com sucesso!</p>';
            } elseif ($_GET['status'] == 'success_update') {
                echo '<p style="color: green;">Ordem de Serviço atualizada com sucesso!</p>';
            } elseif ($_GET['status'] == 'success_delete') {
                echo '<p style="color: red;">Ordem de Serviço excluída com sucesso!</p>';
            } elseif ($_GET['status'] == 'error') {
                echo '<p style="color: red;">Ocorreu um erro na operação.</p>';
            }
        }
        ?>

        <h2>Nova Solicitação de Serviço</h2>
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
            <textarea id="descricao_problema" name="descricao_problema" rows="4" required></textarea>

            <button type="submit" name="acao" value="adicionar">Abrir Solicitação de Serviços</button>
            <a href="lista_os.php" class="view-solicitacoes-button">Ver Solicitações Atuais</a>

        </form>

    </div>
</body>

</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>