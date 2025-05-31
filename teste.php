<?php


$nome = $_POST['nome'];
$marca = $_POST['marca'];
$ano = $_POST['ano'];
$quilometragem = $_POST['quilometragem'];

if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    $imgNome = basename($_FILES['imagem']['name']);
    $imgPath = 'uploads/' . $imgNome;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imgPath)) {
        $stmt = $conn->prepare("INSERT INTO veiculos (nome, marca, ano, quilometragem, imagem) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $nome, $marca, $ano, $quilometragem, $imgPath);

        if ($stmt->execute()) {
            echo "Veículo cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Erro ao mover imagem.";
    }
} else {
    echo "Imagem inválida.";
}

$conn->close();
?>