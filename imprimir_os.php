<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

$os_data = null; // Variável para armazenar os dados da OS

// Verifica se um ID de Ordem de Serviço foi fornecido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_os = $_GET['id'];

    // Prepara a consulta SQL para buscar a OS específica
    $sql_select_single = "SELECT * FROM ordens_servico WHERE id = ?";

    // Usa prepared statements para prevenir injeção de SQL
    if ($stmt = $conn->prepare($sql_select_single)) {
        $stmt->bind_param("i", $id_os); // "i" indica que o parâmetro é um inteiro
        $stmt->execute();
        $result_single = $stmt->get_result();

        if ($result_single->num_rows > 0) {
            $os_data = $result_single->fetch_assoc();
        } else {
            echo "<p>Ordem de Serviço não encontrada.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Erro na preparação da consulta.</p>";
    }
} else {
    echo "<p>ID da Ordem de Serviço não fornecido.</p>";
}

// Fecha a conexão com o banco de dados
$conn->close();
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
    <title>Imprimir Solicitação de Serviço - OS #<?php echo isset($os_data['id']) ? $os_data['id'] : ''; ?></title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
            margin: 20px;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            margin-bottom: 5px;
        }

        .os-details {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .os-details p {
            margin: 10px 0;
        }

        .os-details p strong {
            display: inline-block;
            width: 150px;
            /* Ajuste conforme necessário para alinhar os dois pontos */
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

        .status-aguardando-pecas {
            color: #3c2374ff;
            font-weight: bold;
        }

        .status-cancelada {
            color: #6c757d;
            font-weight: bold;
        }

        .print-button-container {
            text-align: center;
            margin-top: 30px;
        }

        .print-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* Esconde elementos não essenciais para impressão */
        @media print {
            .print-button-container {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Detalhes da Solicitação de Serviço</h1>
        <p>Documento para Impressão</p>
    </div>

    <?php if ($os_data): ?>
        <div class="os-details">
            <p><strong>ID da OS:</strong> <?php echo htmlspecialchars($os_data['id']); ?></p>
            <p><strong>Solicitante:</strong> <?php echo htmlspecialchars($os_data['cliente']); ?></p>
            <p><strong>Equipamento / Tag:</strong> <?php echo htmlspecialchars($os_data['equipamento']); ?></p>
            <p><strong>Descrição do Problema:</strong>
                <?php echo nl2br(htmlspecialchars($os_data['descricao_problema'])); ?></p>
            <p>
                <strong>Status:</strong>
                <span class="status-<?php echo strtolower(str_replace(' ', '-', $os_data['status'])); ?>">
                    <?php echo htmlspecialchars($os_data['status']); ?>
                </span>
            </p>
            <p><strong>Data de Abertura:</strong> <?php echo date('d/m/Y H:i', strtotime($os_data['data_abertura'])); ?></p>
            <p><strong>Data de Conclusão:</strong>
                <?php echo $os_data['data_conclusao'] ? date('d/m/Y H:i', strtotime($os_data['data_conclusao'])) : 'N/A'; ?>
            </p>

            <?php if (!empty($os_data['resolucao_tecnica'])): ?>
                <p><strong>Resolução Técnica:</strong> <?php echo nl2br(htmlspecialchars($os_data['resolucao_tecnica'])); ?></p>
            <?php endif; ?>
        </div>

        <div class="print-button-container">
            <button class="print-button" onclick="window.print()">Imprimir Solicitação</button>
        </div>

    <?php else: ?>
        <p>Não foi possível carregar os detalhes da Ordem de Serviço.</p>
    <?php endif; ?>

</body>

</html>