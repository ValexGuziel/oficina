<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// --- Lógica para buscar ordens de serviço existentes ---
$sql_select = "SELECT * FROM ordens_servico ORDER BY data_abertura ASC";
$result = $conn->query($sql_select);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de Serviços de Manutenção</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #3b387bff;
        }

        .container {
            max-width: 100vw;
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
            /* Exemplo de borda sólida de 2px na cor mais escura */
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
            /* Sombra: offset-x, offset-y, blur-radius, color */


        }

        button:hover {
            background-color: #176b16ff;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #b9b9b9ff;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #acb1d2ff;
        }

        tbody td {
            /* Este seletor garante que você está estilizando apenas as <td> do <tbody> */

            font-size: 12px;
            /* Tamanho da fonte para o texto em todas as células do corpo */
            vertical-align: middle;
            /* Alinha o conteúdo ao centro verticalmente dentro da célula */
            padding: 3px 5px;
            /* Ajusta o padding para melhor visualização com a altura fixa */
            text-transform: uppercase;
        }

        .status-aberta {
            color: #dc3545;
            font-weight: bold;

        }

        .status-em-andamento {
            color: #deac15ff;
            font-weight: bold;
        }

        .status-concluída {
            color: #40b82bff;
            font-weight: bold;
        }

        .status-aguardando-peças {
            color: #3c2374ff;
            font-weight: bold;
        }

        /* Corrigido o seletor */

        .status-cancelada {
            color: #6c757d;
            font-weight: bold;
        }

        .acoes select[name="novo_status"] {
            font-size: 11px;
            /* Ou qualquer outro valor menor, como 10px, 0.8em, etc. */
            padding: 3px 5px;
            /* Ajuste o padding se necessário para um visual melhor */

        }

        .acoes a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }

        .acoes a:hover {
            text-decoration: underline;
        }

        .acoes .delete-btn {
            color: #dc3545;
        }

        .acoes .delete-btn:hover {
            color: #c82333;
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
            <label for="cliente">Solicitante:</label>
            <input type="text" id="cliente" name="cliente" required>

            <label for="equipamento">Equipamento / Tag:</label>
            <input type="text" id="equipamento" name="equipamento" required>

            <label for="descricao_problema">Descrição do Problema:</label>
            <textarea id="descricao_problema" name="descricao_problema" rows="4" required></textarea>

            <button type="submit" name="acao" value="adicionar">Abrir Solicitação de Serviços</button>

        </form>

        <h2 class="solicitacao-atual">Solicitação de Serviço Atual</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Solicitante</th>
                        <th>Equipamento</th>
                        <th>Problema</th>
                        <th>Status</th>
                        <th>Abertura</th>
                        <th>Conclusão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                            <td><?php echo htmlspecialchars($row['equipamento']); ?></td>
                            <td><?php echo htmlspecialchars($row['descricao_problema']); ?></td>
                            <td class="status-<?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                                <?php echo $row['status']; ?>
                            </td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['data_abertura'])); ?></td>
                            <td>
                                <?php echo $row['data_conclusao'] ? date('d/m/Y H:i', strtotime($row['data_conclusao'])) : 'N/A'; ?>
                            </td>
                            <td class="acoes">
                                <form action="processar_os.php" method="POST" style="display:inline-block; margin-right: 5px;">
                                    <input type="hidden" name="id_os" value="<?php echo $row['id']; ?>">
                                    <select name="novo_status" onchange="this.form.submit()">
                                        <option value=""></option>
                                        <option value="Aberta" <?php echo ($row['status'] == 'Aberta') ? 'selected' : ''; ?>>
                                            Aberta</option>
                                        <option value="Em Andamento" <?php echo ($row['status'] == 'Em Andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                                        <option value="Aguardando Peças" <?php echo ($row['status'] == 'Aguardando Peças') ? 'selected' : ''; ?>>Aguardando Peças</option>
                                        <option value="Concluída" <?php echo ($row['status'] == 'Concluída') ? 'selected' : ''; ?>>Concluída</option>
                                        <option value="Cancelada" <?php echo ($row['status'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                                    </select>
                                    <input type="hidden" name="acao" value="atualizar_status">
                                </form>
                                <a href="editar_os.php?id=<?php echo $row['id']; ?>">Editar</a>
                                <a href="processar_os.php?acao=excluir&id=<?php echo $row['id']; ?>" class="delete-btn"
                                    onclick="return confirm('Tem certeza que deseja excluir esta Ordem de Serviço?');">Excluir</a>
                                <a href="imprimir_os.php?id=<?php echo $row['id']; ?>" target="_blank">Imprimir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma solicitação de serviço registrada ainda.</p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>