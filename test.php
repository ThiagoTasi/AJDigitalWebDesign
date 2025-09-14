<?php
// Inicializa variáveis para mensagens de erro ou sucesso
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

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
        $headers = "From: no-reply@ajdigitalwebdesign.com\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8\r\n";

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-image: url('imagens/AJ.jpg'); 
            background-color: #f0f0f0; /* Fallback color */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
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
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 0.375rem;
            padding: 1.5rem;
        }
        .header {
            background-color: #151616ff;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header nav ul {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }
        .header nav ul li a {
            color: white;
            font-weight: 500;
            font-size: 1.125rem;
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Espaço entre ícone e texto */
        }
        .header nav ul li a:hover {
            color: #60a5fa;
        }
        .header nav ul li a i {
            font-size: 1rem; /* Tamanho do ícone */
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <header class="header">
        <nav>
            <ul>
                <li><a href="#quem-somos"><i class="fas fa-user"></i> Quem somos?</a></li>
                <li><a href="#o-que-fazemos"><i class="fas fa-folder"></i> O que fazemos?</a></li>
                <li><a href="#contatos"><i class="fas fa-phone"></i> Contatos</a></li>
            </ul>
        </nav>
    </header>
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
                    <label for="name" class="block text-gray-700">Seu nome</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="email" class="block text-gray-700">Seu e-mail</label>
                    <input type="email" id="email" name="email" placeholder="Seu e-mail" required class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="message" class="block text-gray-700">Sua mensagem</label>
                    <textarea id="message" name="message" rows="4" placeholder="Sua mensagem" required class="w-full p-2 border border-gray-300 rounded-md"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Enviar</button>
            </form>

            <footer class="contact-section mt-6">
                <p>&copy; <?php echo date("Y"); ?> A J Digital Web Design. Todos os direitos reservados.</p>
                <p>Rua da Ponte Rasa 0000, Jardim Ponte Rasa, São Paulo, SP</p>
                <p>Telefone: (11) 94858-4777</p>
                <p>Email: contato@ajdigitalwebdesign.com</p>
                <div class="social-links">
                    <a href="https://facebook.com/yourprofile" aria-label="Visite nossa página no Facebook"><img src="imagens/facebook-icon.png" alt="Facebook"></a>
                    <a href="https://instagram.com/yourprofile" aria-label="Visite nossa página no Instagram"><img src="imagens/instagram-icon.png" alt="Instagram"></a>
                    <a href="https://tiktok.com/yourprofile" aria-label="Visite nossa página no TikTok"><img src="imagens/tik-tok-icon.png" alt="TikTok"></a>
                </div>
                <div>
                    <p>Entre em contato agora mesmo!</p>
                    <a href="https://wa.me/+5511948584777" class="whatsapp-icon" aria-label="Entre em contato pelo WhatsApp"><img src="imagens/whatsapp-icon.png" alt="WhatsApp"></a>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>