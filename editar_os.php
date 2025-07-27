<?php
include 'conexao.php';

$os = null; // Inicializa a variável para a ordem de serviço

if (isset($_GET['id'])) {
    $id_os = (int)$_GET['id'];
    $sql_select_os = "SELECT * FROM ordens_servico WHERE id = $id_os";
    $result_os = $conn->query($sql_select_os);

    if ($result_os->num_rows > 0) {
        $os = $result_os->fetch_assoc();
    } else {
        echo "Ordem de Serviço não encontrada.";
        exit;
    }
} else {
    header("Location: index.php?status=error&message=ID_nao_fornecido");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ordem de Serviço</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], textarea, select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button:hover { background-color: #0056b3; }
        .cancel-btn {
            background-color: #6c757d;
        }
        .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Ordem de Serviço #<?php echo $os['id']; ?></h1>

        <form action="processar_os.php" method="POST">
            <input type="hidden" name="id_os" value="<?php echo $os['id']; ?>">
            <input type="hidden" name="acao" value="editar">

            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" value="<?php echo htmlspecialchars($os['cliente']); ?>" required>

            <label for="equipamento">Equipamento:</label>
            <input type="text" id="equipamento" name="equipamento" value="<?php echo htmlspecialchars($os['equipamento']); ?>" required>

            <label for="descricao_problema">Descrição do Problema:</label>
            <textarea id="descricao_problema" name="descricao_problema" rows="4" required><?php echo htmlspecialchars($os['descricao_problema']); ?></textarea>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Aberta" <?php echo ($os['status'] == 'Aberta') ? 'selected' : ''; ?>>Aberta</option>
                <option value="Em Andamento" <?php echo ($os['status'] == 'Em Andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                <option value="Aguardando Peças" <?php echo ($os['status'] == 'Aguardando Peças') ? 'selected' : ''; ?>>Aguardando Peças</option>
                <option value="Concluída" <?php echo ($os['status'] == 'Concluída') ? 'selected' : ''; ?>>Concluída</option>
                <option value="Cancelada" <?php echo ($os['status'] == 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
            </select>
            <br><br>

            <button type="submit">Salvar Alterações</button>
            <button type="button" class="cancel-btn" onclick="window.location.href='index.php';">Cancelar</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>