<?php
include "../verificar-autenticacao.php";

try {


    //Verificar se o arquivo foi enviado
    if ($_FILES["productImage"]["name"] != "") {
        //pegar a extensão do arquivo
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        //gerar um novo nome para o arquivo
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // VERIFICAR SE O DIRETORIO EXISTE
        $diretorio = "imagens";
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755); // 0755 é um dos niveis de permissão FTP
        }

        //mover o arquivo para a pasta de imagens
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "$diretorio/$novo_nome");
        //adicionar o nome do arquivo no POST
        $_POST["productImage"] = $novo_nome;

        //se ja existir uma imagem, deletar a imagem
        if ($_POST["currentImage"] != "") {
            //unlink = deletar arquivos
            unlink("imagens/" . $_POST["currentImage"]);
        }
    } else {
        //se não foi enviado arquivo, verificar se é uma edição
        $_POST["productImage"] = $_POST["currentImage"];
    }

    $msg = '';

    if (isset($_POST['productId']) && is_numeric($_POST['productId'])) {
        $id = $_POST['productId'];
        $categoria_id = $_POST['categoria_id'] ?? null;
        $marca_id = $_POST['marca_id'] ?? null;
        $nome = $_POST['productName'] ?? null;
        $descricao = $_POST['descricao'] ?? null;
        $preco = $_POST['preco'] ?? null;
        $desconto = $_POST['desconto'] ?? null;
        $estoque = $_POST['estoque'] ?? null;
        $image_url = $_POST['image_url'] ?? null;

        $sql = "INSERT INTO produto (produto_id,categoria_id, marca_id, nome, descricao, preco, desconto, estoque, image_url) VALUES
                (:id, :categoria_id, :marca_id, :nome, :descricao, :preco, :desconto, :estoque, :image_url)
               ";


        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':marca_id', $marca_id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':desconto', $desconto);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Cliente cadastrado com sucesso!'
        );
    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Nenhum dado foi enviado!');
    }
} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
