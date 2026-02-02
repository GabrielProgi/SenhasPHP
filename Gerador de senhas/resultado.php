<?php
require_once 'PasswordGenerator.php';


$length = filter_input(INPUT_POST, 'length', FILTER_VALIDATE_INT) ?: 12;
$useLetters = isset($_POST['letters']);
$useNumbers = isset($_POST['numbers']);
$useSymbols = isset($_POST['symbols']);

$generator = new PasswordGenerator($length, $useLetters, $useNumbers, $useSymbols);
$password = $generator->generate();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Senha Gerada</title>
</head>
<body>
    <header>
        <h1>🎉 Sua Nova Senha</h1>
    </header>
    
    <section class="container result">
        <div class="password-box">
            <p class="password-text" id="passText"><?php echo htmlspecialchars($password); ?></p>
            <button onclick="copyPassword()" class="btn-copy" id="btnCopy">📋 Copiar Senha</button>
        </div>
        
        <div class="info">
            <p><strong><?php echo $length; ?></strong> caracteres seguros gerados.</p>
        </div>
        
        <div class="actions">
            <a href="index.html" class="btn-link">← Gerar outra senha</a>
        </div>
    </section>
    
    <script>
        function copyPassword() {
            const text = document.getElementById('passText').textContent;
            const btn = document.getElementById('btnCopy');
            
            
            navigator.clipboard.writeText(text).then(() => {
                
                
                const originalText = btn.textContent;
                btn.textContent = "✅ Copiado!";
                btn.classList.add('copied'); 
                
                
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.classList.remove('copied');
                }, 2000);
                
            }).catch(err => {
                console.error('Erro ao copiar', err);
                alert("Erro ao copiar. Tente selecionar manualmente.");
            });
        }
    </script>
</body>
</html>