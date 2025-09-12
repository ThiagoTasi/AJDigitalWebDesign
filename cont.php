<?php
// Inicializa variáveis para mensagens de erro ou sucesso
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS); // Correção: FILTER_SANITIZE_STRING substituído
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS); // Correção: FILTER_SANITIZE_STRING substituído

    // Validação simples
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Por favor, preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Por favor, insira um e-mail válido.";
    } else {
        // Configurações do e-mail
        $to = "contato@ajdigitalwebdesign.com";
        $subject = "Nova mensagem de contato de $name";
        $body = "Nome: $name\nE-mail: $email\nMensagem:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\n";

        // Envia o e-mail
        if (mail($to, $subject, $body, $headers)) {
            $success = "Mensagem enviada com sucesso!";
        } else {
            $error = "Erro ao enviar a mensagem.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - A J Digital Web Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('imagens/AJ.jpg'); 
            background-size: cover; /* Faz a imagem cobrir toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-repeat: no-repeat; /* Evita repetição */
            background-attachment: fixed; /* Fundo fixo ao rolar */
            min-height: 100vh; /* Garante altura total */
        }
        .contact-section {
            background-color: #f8f8f8;
            padding: 20px;
            text-align: center;
        }
        .social-links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            margin: 10px 0;
        }
        .social-links img {
            width: 24px;
            height: 24px;
            object-fit: contain;
        }
        .whatsapp-icon {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .whatsapp-icon img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.85); /* Camada semi-transparente */
            border-radius: 0.375rem; /* Corresponde ao rounded-md */
            padding: 1.5rem; /* Corresponde ao p-6 */
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex-grow flex items-center justify-center p-4">
        <div class="form-container w-full max-w-lg">
            <h1 class="text-xl font-semibold text-center text-gray-800 mb-4">Contato</h1>

            <?php if ($success): ?>
                <p class="text-green-600 text-center mb-4"><?php echo htmlspecialchars($success); ?></p>
            <?php elseif ($error): ?>
                <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-3">
                <div>
                    <input type="text" id="name" name="name" placeholder="Seu nome" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <input type="email" id="email" name="email" placeholder="Seu e-mail" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <textarea id="message" name="message" rows="4" placeholder="Sua mensagem" required class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Enviar</button>
            </form>

            <div class="contact-section mt-6">
                <p>&copy; <?php echo date("Y"); ?> A J Digital Web Design. Todos os direitos reservados.</p>
                <p>Rua da Ponte Rasa 0000, Jardim Ponte Rasa, São Paulo, SP</p>
                <p>Telefone: (11) 94858-4777</p>
                <p>Email: contato@ajdigitalwebdesign.com</p> <!-- Correção no e-mail -->
                <div class="social-links">
                    <a href="#"><img src="imagens/facebook-icon.png" alt="Facebook"></a>
                    <a href="#"><img src="imagens/instagram-icon.png" alt="Instagram"></a>
                    <a href="#"><img src="imagens/tik-tok-icon.png" alt="Tik-tok"></a>
                </div>
                <div>
                    <p>Entre em contato agora mesmo!</p>
                    <a href="https://wa.me/+5511948584777" class="whatsapp-icon"><img src="imagens/whatsapp-icon.png" alt="WhatsApp"></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>