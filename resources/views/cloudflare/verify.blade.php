<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificação de Segurança</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
            position: relative;
            padding: 0.5rem;
        }

        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.3) 100%);
            pointer-events: none;
        }

        .container {
            text-align: center;
            padding: 1.5rem;
            background: rgba(42, 42, 42, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transform-origin: center;
            animation: modalEntry 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            width: calc(100% - 2rem);
            max-width: 380px;
            margin: 0.5rem;
        }

        .logo-container {
            margin-bottom: 1rem;
            position: relative;
            height: 50px;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            position: relative;
            transform-style: preserve-3d;
        }

        .letter {
            display: inline-block;
            opacity: 0;
            background: linear-gradient(45deg, #2196F3, #1976D2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transform-origin: center;
            animation: letterReveal 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-play-state: paused;
        }

        @keyframes modalEntry {
            0% {
                opacity: 0;
                transform: scale(0.8) translateY(30px) rotate3d(1, 0, 0, 45deg);
            }
            50% {
                transform: scale(1.05) translateY(-10px) rotate3d(1, 0, 0, 0deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0) rotate3d(1, 0, 0, 0deg);
            }
        }

        @keyframes letterReveal {
            0% {
                opacity: 0;
                transform: rotateX(-90deg) translateY(20px) scale(0.8);
                filter: blur(10px);
            }
            60% {
                opacity: 0.8;
                transform: rotateX(20deg) translateY(-5px) scale(1.1);
                filter: blur(2px);
            }
            100% {
                opacity: 1;
                transform: rotateX(0deg) translateY(0) scale(1);
                filter: blur(0);
            }
        }

        .success-message {
            color: #2196F3;
            padding: 6px;
            border-radius: 8px;
            background: rgba(33, 150, 243, 0.1);
            border: 1px solid rgba(33, 150, 243, 0.2);
            margin-bottom: 0.6rem;
            animation: pulse 2s infinite;
            font-size: 0.85rem;
        }

        .error {
            color: #ff4444;
            margin-top: 1rem;
            padding: 6px;
            border-radius: 8px;
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid rgba(255, 68, 68, 0.2);
            animation: shake 0.5s ease-in-out;
            font-size: 0.85rem;
        }

        .cf-turnstile {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            transform: scale(0.9);
            transform-origin: center;
        }

        .title {
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
            opacity: 0;
            transform: translateY(20px);
            animation: elementFadeIn 0.6s ease forwards;
            animation-delay: 1.2s;
        }

        @keyframes elementFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efeito de partículas flutuantes */
        .floating-particle {
            position: absolute;
            pointer-events: none;
            background: radial-gradient(circle, rgba(33, 150, 243, 0.2), transparent);
            border-radius: 50%;
            animation: floatParticle var(--duration) ease-in-out infinite;
            opacity: 0;
        }

        @keyframes floatParticle {
            0% {
                transform: translate(0, 0) scale(0);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(1);
                opacity: 0;
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Efeito de partículas no fundo */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0); }
            100% { transform: translateY(-100vh) translateX(100vw); }
        }

        /* Media Queries para diferentes tamanhos de tela */
        @media (max-width: 480px) {
            .container {
                padding: 1.2rem;
                margin: 0.5rem;
                max-width: 340px;
            }

            .logo {
                font-size: 1.8rem;
            }

            .title {
                font-size: 1rem;
            }

            .logo-container {
                height: 45px;
            }

            .cf-turnstile {
                transform: scale(0.85);
            }
        }

        @media (max-width: 360px) {
            body {
                padding: 0.3rem;
            }

            .container {
                padding: 1rem;
                margin: 0.3rem;
                max-width: 320px;
            }

            .logo {
                font-size: 1.6rem;
            }

            .title {
                font-size: 0.9rem;
            }

            .logo-container {
                height: 40px;
            }

            .cf-turnstile {
                transform: scale(0.8);
            }
        }
    </style>
</head>
<body>
    <div class="particles">
        <!-- Partículas serão adicionadas via JavaScript -->
    </div>

    <div class="container">
        <div class="logo-container">
            <div class="logo"></div>
        </div>
        
        @if(session()->has('turnstile_verified'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i> Verificado com sucesso!
            </div>
        @endif
        
        @if(session('error'))
            <div class="error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <h1 class="title">Verificação de Segurança</h1>
        <form id="verify-form" action="{{ route('cloudflare.verify.post') }}" method="POST">
            @csrf
            <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-callback="onVerify"></div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logo = document.querySelector('.logo');
            const text = 'TemPix';
            let animationComplete = false;
            
            // Criar letras individuais
            text.split('').forEach((letter, index) => {
                const span = document.createElement('span');
                span.textContent = letter;
                span.className = 'letter';
                span.style.animationDelay = `${0.8 + (index * 0.1)}s`;
                logo.appendChild(span);
            });

            const letters = document.querySelectorAll('.letter');
            
            // Iniciar animações
            letters.forEach(letter => {
                letter.style.animationPlayState = 'running';
            });

            // Criar partículas flutuantes
            function createFloatingParticles() {
                const container = document.querySelector('.container');
                
                setInterval(() => {
                    const particle = document.createElement('div');
                    particle.className = 'floating-particle';
                    
                    const size = Math.random() * 30 + 10;
                    const startX = Math.random() * 100;
                    const startY = Math.random() * 100;
                    const tx = (Math.random() - 0.5) * 200;
                    const ty = (Math.random() - 0.5) * 200;
                    const duration = 2 + Math.random() * 2;
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${startX}%`;
                    particle.style.top = `${startY}%`;
                    particle.style.setProperty('--tx', `${tx}px`);
                    particle.style.setProperty('--ty', `${ty}px`);
                    particle.style.setProperty('--duration', `${duration}s`);
                    
                    container.appendChild(particle);
                    
                    setTimeout(() => particle.remove(), duration * 1000);
                }, 200);
            }

            // Iniciar partículas após a animação do modal
            setTimeout(createFloatingParticles, 800);

            // Marcar como completo após todas as animações
            setTimeout(() => {
                animationComplete = true;
            }, 2000);

            // Função de verificação
            window.onVerify = function(token) {
                const checkAnimation = setInterval(() => {
                    if (animationComplete) {
                        clearInterval(checkAnimation);
                        document.getElementById('verify-form').submit();
                    }
                }, 100);
            };
        });

        function createSparkles() {
            const logo = document.querySelector('.logo');
            
            setInterval(() => {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                
                sparkle.style.left = Math.random() * 100 + '%';
                sparkle.style.top = Math.random() * 100 + '%';
                sparkle.style.setProperty('--tx', `${(Math.random() - 0.5) * 100}px`);
                sparkle.style.setProperty('--ty', `${(Math.random() - 0.5) * 100}px`);
                
                logo.appendChild(sparkle);
                
                setTimeout(() => sparkle.remove(), 1000);
            }, 50);
        }

        window.addEventListener('load', () => {
            createParticles();
        });
    </script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>
</html> 