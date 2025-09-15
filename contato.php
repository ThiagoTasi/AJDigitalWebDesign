<?php
// Inicializa variáveis para mensagens de erro ou sucesso
$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
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
            background-color: #1a1a1a; /* Dark background to match the image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            color: #ffffff; /* White text for contrast */
        }
        .contact-section {
            background-color: rgba(26, 26, 26, 0.8); /* Dark semi-transparent background */
            padding: 20px;
            text-align: center;
            color: #ffffff;
        }
        .form-container {
            background-color: rgba(128, 128, 128, 0.5); /* Fume color with transparency */
            border-radius: 15px; /* Rounded corners */
            padding: 2rem;
            backdrop-filter: blur(5px); /* Slight blur effect */
        }
        .form-container input,
        .form-container textarea {
            background-color: rgba(255, 255, 255, 0.2); /* Light semi-transparent background */
            border: none;
            border-radius: 10px; /* Rounded placeholders */
            padding: 0.75rem;
            color: #ffffff;
            width: 100%;
        }
        .form-container input:focus,
        .form-container textarea:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
        }
        .form-container label {
            color: #ffffff;
        }
        .form-container button {
            background-color: #1e90ff; /* Blue button to match image */
            color: #ffffff;
            padding: 0.75rem;
            border-radius: 10px;
            border: none;
            width: 100%;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #1c86ee; /* Darker blue on hover */
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent background */
            color: #ffffff;
            text-align: center;
            padding: 1rem 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 0.5rem;
        }
        .social-links a {
            color: #ffffff;
            font-size: 1.5rem;
        }
        .social-links a:hover {
            color: #60a5fa;
        }
        .schedule-section {
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent background */
            color: #ffffff;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
            border-radius: 10px;
            width: 100%; /* Stretched to full width */
        }
        .faq-section {
            background-color: rgba(0, 0, 0, 0.7); /* Dark semi-transparent background */
            color: #ffffff;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
            border-radius: 10px;
            width: 100%; /* Stretched to full width */
        }
        .faq-question {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .faq-answer {
            margin-bottom: 1.5rem;
            text-align: left;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <div class="flex-grow flex flex-col items-center justify-center p-4">
        <div class="form-container w-full max-w-lg">
            <h1 class="text-xl font-semibold text-center text-white mb-4">Contato</h1>

            <?php if ($success): ?>
                <p class="text-green-400 text-center mb-4"><?php echo htmlspecialchars($success); ?></p>
            <?php elseif ($error): ?>
                <p class="text-red-400 text-center mb-4"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
                <div>
                    <label for="name" class="block text-white">Seu nome</label>
                    <input type="text" id="name" name="name" placeholder="Seu nome" required class="w-full p-2">
                </div>
                <div>
                    <label for="email" class="block text-white">Seu e-mail</label>
                    <input type="email" id="email" name="email" placeholder="Seu e-mail" required class="w-full p-2">
                </div>
                <div>
                    <label for="assunto" class="block text-white">Assunto</label>
                    <input type="text" id="assunto" name="assunto" placeholder="Assunto" required class="w-full p-2">
                </div>
                <div>
                    <label for="message" class="block text-white">Sua mensagem</label>
                    <textarea id="message" name="message" rows="4" placeholder="Sua mensagem" required class="w-full p-2"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Enviar</button>
            </form>

            <div class="mt-6 text-center">
                <p>&copy; <?php echo date("Y"); ?> A J Digital Web Design. Todos os direitos reservados.</p>
                <p>Telefone: (11) 94858-4777</p>
                <p>Email: contato@ajdigitalwebdesign.com</p>
            </div>
        </div>

        <div class="schedule-section mt-4">
            <h2 class="text-xl font-semibold mb-4">HORÁRIO DE ATENDIMENTO</h2>
            <p>Entendemos a importância de estar disponível para você. Nossos horários de atendimento são planejados para oferecer o melhor suporte:</p>
            <ul class="text-left mt-4 mx-auto w-3/4">
                <li>Segunda a Sexta: 9h às 18h</li>
                <li>Sábado e Domingo: Fechado</li>
                <li>Feriados: Fechado</li>
            </ul>
        </div>

        <div class="faq-section mt-4">
            <h2 class="text-xl font-semibold mb-4">PERGUNTAS FREQUENTES</h2>
            <p class="mb-6">Confira as dúvidas mais comuns sobre nossos serviços e soluções:</p>
            <div class="text-left mx-auto w-3/4">
                <div class="faq-question">Como posso solicitar um orçamento?</div>
                <div class="faq-answer">Basta preencher o formulário acima com detalhes sobre o seu projeto, e enviaremos uma análise da solicitação e orçamento em até 24 horas. Para um contato mais breve, possível para discutir suas necessidades e apresentar uma proposta personalizada.</div>
                <div class="faq-question">Qual o prazo de entrega de um site?</div>
                <div class="faq-answer">O prazo de entrega de um site varia de acordo com a complexidade, funcionalidades desejadas e quantidade de páginas. Após uma análise detalhada do seu projeto, enviaremos um cronograma específico com as etapas e prazos.</div>
                <div class="faq-question">Vocês oferecem suporte pós-lançamento?</div>
                <div class="faq-answer">Sim! Não terminamos na entrega. Oferecemos pacotes de manutenção e suporte garantido para o funcionamento perfeito, com atualizações contínuas.</div>
            </div>
        </div>
    </div>
    <footer>
        <div class="social-links">
            <a href="https://instagram.com/yourprofile" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://facebook.com/yourprofile" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/+5511948584777" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p>Rua da Ponte Rasa 0000, Jardim Ponte Rasa, São Paulo, SP</p>
        <p>&copy; 2025 AJ Digital Company. Todos os direitos reservados.</p>
    </footer>
</body>
</html>