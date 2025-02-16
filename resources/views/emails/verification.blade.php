<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificação de E-mail - Tempix Casino</title>
  <style type="text/css">
    /* Reset Básico */
    body, table, td, a {
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }
    table, td {
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }
    img {
      -ms-interpolation-mode: bicubic;
      border: 0;
      display: block;
    }
    body {
      margin: 0;
      padding: 0;
      background-color: #333; /* Cinza escuro para o fundo geral */
      font-family: Arial, sans-serif;
      color: #333;
    }
    /* Container Principal */
    .email-container {
      width: 100%;
      max-width: 600px;
      margin: auto;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    /* Cabeçalho com Gradiente */
    .email-header {
      background: linear-gradient(135deg, #0d47a1, #1976d2); /* Dois tons de azul */
      text-align: center;
      padding: 30px;
      color: #fff;
    }
    .email-header h1 {
      margin: 0;
      font-size: 32px;
      font-weight: bold;
    }
    .email-header p {
      margin-top: 8px;
      font-size: 14px;
    }
    /* Corpo do E-mail */
    .email-body {
      padding: 30px;
      background-color: #fff;
      text-align: center;
    }
    .email-body h2 {
      font-size: 24px;
      color: #0d47a1;
      margin-bottom: 20px;
    }
    .email-body p {
      font-size: 16px;
      line-height: 1.5;
      color: #555; /* Cinza escuro para textos */
      margin-bottom: 20px;
    }
    .verification-code {
      display: inline-block;
      font-size: 28px;
      font-weight: bold;
      letter-spacing: 3px;
      color: #fff;
      background: linear-gradient(135deg, #1976d2, #0d47a1);
      padding: 10px 20px;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .btn {
      display: inline-block;
      background: linear-gradient(135deg, #0d47a1, #1976d2);
      color: #fff;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 4px;
      font-weight: bold;
      margin-top: 20px;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background: linear-gradient(135deg, #1976d2, #0d47a1);
    }
    /* Rodapé */
    .email-footer {
      background-color: #2e2e2e;
      text-align: center;
      padding: 20px;
      font-size: 12px;
      color: #ccc;
    }
    .email-footer p {
      margin: 5px 0;
    }
    /* Responsividade */
    @media only screen and (max-width: 600px) {
      .email-header h1 {
        font-size: 28px;
      }
      .email-body h2 {
        font-size: 20px;
      }
      .email-body p, .btn {
        font-size: 14px;
      }
      .verification-code {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #333; padding: 30px 0;">
    <tr>
      <td align="center">
        <table role="presentation" class="email-container" width="600" cellspacing="0" cellpadding="0" border="0">
          <!-- Cabeçalho -->
          <tr>
            <td class="email-header">
              <h1>Tempix Casino</h1>
              <p>A emoção em cada aposta</p>
            </td>
          </tr>
          <!-- Corpo -->
          <tr>
            <td class="email-body">
              <h2>Verificação de E-mail</h2>
              <p>Olá, {{ $user->name }}!</p>
              <p>Para validar seu cadastro e começar sua jornada na TemPix, utilize o código abaixo:</p>
              <div class="verification-code">{{ $code }}</div>
            </td>
          </tr>

          <!-- Rodapé -->
          <tr>
            <td class="email-footer">
              <p>&copy; {{ date('Y') }} Tempix. Todos os direitos reservados.</p>
              <p>Você está recebendo este e-mail porque se cadastrou em nossa plataforma.</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html> 