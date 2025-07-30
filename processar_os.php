<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" || (isset($_GET['acao']) && $_GET['acao'] == 'excluir')) {
    $acao = $_POST['acao'] ?? $_GET['acao']; // Pega a ação do POST ou GET

    switch ($acao) {
        case 'adicionar':
            // **Verifica se os novos campos estão presentes no POST**
            if (isset($_POST['cliente']) && isset($_POST['equipamento']) && isset($_POST['descricao_problema']) && isset($_POST['setor']) && isset($_POST['prioridade'])) {
                $cliente = $conn->real_escape_string($_POST['cliente']);
                $equipamento = $conn->real_escape_string($_POST['equipamento']);
                $descricao_problema = $conn->real_escape_string($_POST['descricao_problema']);
                // **Captura os novos campos**
                $setor = $conn->real_escape_string($_POST['setor']);
                $prioridade = $conn->real_escape_string($_POST['prioridade']);

                // **Atualiza a query SQL para incluir os novos campos**
                $sql_insert = "INSERT INTO ordens_servico (cliente, setor, equipamento, prioridade, descricao_problema) VALUES ('$cliente', '$setor', '$equipamento', '$prioridade', '$descricao_problema')";

                if ($conn->query($sql_insert) === TRUE) {
                    header("Location: index.php?status=success_add");
                } else {
                    header("Location: index.php?status=error&message=" . urlencode($conn->error));
                }
            } else {
                header("Location: index.php?status=error&message=Dados_incompletos_adicionar");
            }
            break;

        case 'atualizar_status':
            if (isset($_POST['id_os']) && isset($_POST['novo_status'])) {
                $id_os = (int) $_POST['id_os'];
                $novo_status = $conn->real_escape_string($_POST['novo_status']);

                $update_sql = "UPDATE ordens_servico SET status = '$novo_status'";

                if ($novo_status == 'Concluída') {
                    $update_sql .= ", data_conclusao = NOW()";
                } else {
                    $update_sql .= ", data_conclusao = NULL"; // Limpa se mudar de concluída
                }

                $update_sql .= " WHERE id = $id_os";

                if ($conn->query($update_sql) === TRUE) {
                    header("Location: index.php?status=success_update");
                } else {
                    header("Location: index.php?status=error&message=" . urlencode($conn->error));
                }
            } else {
                header("Location: index.php?status=error&message=Dados_incompletos_status");
            }
            break;

        case 'editar':
            // **Verifica se os novos campos estão presentes no POST para a edição**
            if (isset($_POST['id_os']) && isset($_POST['cliente']) && isset($_POST['setor']) && isset($_POST['equipamento']) && isset($_POST['prioridade']) && isset($_POST['descricao_problema']) && isset($_POST['status'])) {
                $id_os = (int) $_POST['id_os'];
                $cliente = $conn->real_escape_string($_POST['cliente']);
                // **Captura os novos campos para edição**
                $setor = $conn->real_escape_string($_POST['setor']);
                $equipamento = $conn->real_escape_string($_POST['equipamento']);
                $prioridade = $conn->real_escape_string($_POST['prioridade']);
                $descricao_problema = $conn->real_escape_string($_POST['descricao_problema']);
                $status = $conn->real_escape_string($_POST['status']);

                // **Atualiza a query SQL para incluir os novos campos na edição**
                $update_sql = "UPDATE ordens_servico SET cliente = '$cliente', setor = '$setor', equipamento = '$equipamento', prioridade = '$prioridade', descricao_problema = '$descricao_problema', status = '$status'";

                // Lógica para data_conclusao ao editar
                if ($status == 'Concluída') {
                    // Verifica se já tem data de conclusão, se não tiver, adiciona NOW()
                    $check_date_sql = "SELECT data_conclusao FROM ordens_servico WHERE id = $id_os";
                    $result_date = $conn->query($check_date_sql);
                    if ($result_date && $row_date = $result_date->fetch_assoc()) {
                        if (empty($row_date['data_conclusao'])) {
                            $update_sql .= ", data_conclusao = NOW()";
                        }
                    }
                } else {
                    $update_sql .= ", data_conclusao = NULL";
                }

                $update_sql .= " WHERE id = $id_os";

                if ($conn->query($update_sql) === TRUE) {
                    header("Location: index.php?status=success_update");
                } else {
                    header("Location: index.php?status=error&message=" . urlencode($conn->error));
                }
            } else {
                header("Location: index.php?status=error&message=Dados_incompletos_editar");
            }
            break;

        case 'excluir':
            if (isset($_GET['id'])) {
                $id_os = (int) $_GET['id'];
                $sql_delete = "DELETE FROM ordens_servico WHERE id = $id_os";

                if ($conn->query($sql_delete) === TRUE) {
                    header("Location: index.php?status=success_delete");
                } else {
                    header("Location: index.php?status=error&message=" . urlencode($conn->error));
                }
            } else {
                header("Location: index.php?status=error&message=ID_nao_fornecido_excluir");
            }
            break;

        default:
            header("Location: index.php?status=error&message=Acao_invalida");
            break;
    }
} else {
    header("Location: index.php?status=error&message=Metodo_requisicao_invalido");
}

$conn->close();
?>