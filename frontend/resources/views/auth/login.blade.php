<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #f1f5f9;
            --gray-dark: #475569;
            --border-radius: 12px;
            --border-radius-lg: 16px;
            --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 40px -4px rgba(0, 0, 0, 0.15), 0 8px 10px -4px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }

        .login-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 2;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            padding: 48px 40px;
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background: var(--gradient);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 28px;
            box-shadow: var(--shadow);
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 700;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo p {
            color: var(--gray);
            font-size: 14px;
            margin-top: 4px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
            width: 16px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background: white;
            position: relative;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .form-input.with-icon {
            padding-left: 48px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            transition: var(--transition);
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
        }

        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .custom-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .custom-checkbox.checked {
            background: var(--gradient);
            border-color: var(--primary);
        }

        .custom-checkbox.checked::after {
            content: '✓';
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--gray-dark);
            cursor: pointer;
        }

        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--gradient);
            color: white;
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .links-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
            transform: translateX(2px);
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            color: var(--gray);
            font-size: 14px;
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .register-link a:hover {
            color: var(--primary-dark);
        }

        .session-status {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 16px;
            border-radius: var(--border-radius);
            margin-bottom: 24px;
            text-align: center;
            font-weight: 500;
            box-shadow: var(--shadow);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float-particle 6s ease-in-out infinite;
        }

        @keyframes float-particle {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 32px 24px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .links-section {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
        }

        /* Loading state */
        .btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn.loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Floating Particles -->
    <div class="floating-particles" id="particles"></div>

    <div class="login-container">
        <div class="login-card">
            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h1>{{ config('app.name') }}</h1>
                <p>Connectez-vous à votre compte</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse Email
                    </label>
                    <div style="position: relative;">
                        <input id="email" 
                               class="form-input with-icon" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="votre@email.com">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    @if ($errors->has('email'))
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i>
                        Mot de passe
                    </label>
                    <div style="position: relative;">
                        <input id="password" 
                               class="form-input with-icon"
                               type="password"
                               name="password"
                               required 
                               autocomplete="current-password"
                               placeholder="Votre mot de passe">
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    @if ($errors->has('password'))
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <div class="custom-checkbox" id="rememberCheckbox"></div>
                    <input type="checkbox" name="remember" id="remember_me" style="display: none;">
                    <label for="remember_me" class="checkbox-label">Se souvenir de moi</label>
                </div>

                <div class="links-section">
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            <i class="fas fa-key"></i>
                            Mot de passe oublié ?
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary" id="loginButton">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </button>
                </div>

                <div class="register-link">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}">Créer un compte</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Créer des particules flottantes
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = 15;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Taille aléatoire
                const size = Math.random() * 6 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Position aléatoire
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Animation delay aléatoire
                particle.style.animationDelay = `${Math.random() * 5}s`;
                particle.style.animationDuration = `${Math.random() * 3 + 3}s`;
                
                container.appendChild(particle);
            }
        }

        // Gestion de la checkbox personnalisée
        const customCheckbox = document.getElementById('rememberCheckbox');
        const rememberMe = document.getElementById('remember_me');

        customCheckbox.addEventListener('click', () => {
            rememberMe.checked = !rememberMe.checked;
            customCheckbox.classList.toggle('checked', rememberMe.checked);
        });

        // Initialiser l'état de la checkbox
        customCheckbox.classList.toggle('checked', rememberMe.checked);

        // Animation de soumission du formulaire
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');

        loginForm.addEventListener('submit', () => {
            loginButton.classList.add('loading');
            loginButton.innerHTML = '<span>Connexion...</span>';
        });

        // Créer les particules au chargement
        document.addEventListener('DOMContentLoaded', createParticles);

        // Effet de focus sur les inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>