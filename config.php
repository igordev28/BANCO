<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" name="form_login">
    Digite seu login : <input type="text" name="login" required />
    Digite sua senha : <input type="password" name="senha" required />
    Digite seu e-mail : <input type="email" name="email" required />
    Digite seu nome : <input type="text" name="nome" required />
    
    <input type="submit" value="Enviar" />
</form>

<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=teste", "root", "cimatec");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $nome = $_POST['nome'];

        // Verifica se o login já existe
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nome = :nome OR email = :email");
        $stmt->execute(['nome' => $nome, 'email' => $email]);
        $user = $stmt->fetch();

        if ($user) {
            echo ("<h1 class='center'>LOGIN OU E-MAIL JÁ CADASTRADOS</h1>");
        } else {
            // Inserindo o novo usuário no banco de dados
            $stmt = $pdo->prepare("INSERT INTO usuario (nome, senha, email) VALUES (:nome, :senha, :email)");
            $stmt->execute([
                'nome' => $nome,
                'senha' => ($senha),
                'email' => $email
            ]);

            echo ("<h1 class='center'>CADASTRO REALIZADO COM SUCESSO</h1>");
        }
    }
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>

</body>
</html>
