<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - {{ config('app.name') }}</title>
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
            --border-radius-lg: 20px;
            --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            --gradient-accent: linear-gradient(135deg, var(--secondary) 0%, var(--accent) 100%);
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
                radial-gradient(circle at 10% 20%, rgba(120, 119, 198, 0.4) 0%, transparent 50%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 30% 70%, rgba(99, 102, 241, 0.2) 0%, transparent 50%);
            animation: backgroundShift 8s ease-in-out infinite;
        }

        @keyframes backgroundShift {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.05) rotate(1deg); }
        }

        .register-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 2;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            padding: 48px 40px;
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-accent);
            animation: progressBar 2s ease-in-out;
        }

        @keyframes progressBar {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(0); }
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .logo-icon:hover {
            transform: scale(1.05) rotate(5deg);
        }

        .logo h1 {
            font-size: 28px;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
        }

        .logo p {
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
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
            transition: var(--transition);
        }

        .form-input-container {
            position: relative;
            transition: var(--transition);
        }

        .form-input {
            width: 100%;
            padding: 16px 16px 16px 48px;
            border: 2px solid #e2e8f0;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
            background: white;
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
            background: #fafbff;
        }

        .form-input.valid {
            border-color: var(--secondary);
            background: #f0fdf4;
        }

        .form-input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            transition: var(--transition);
            z-index: 2;
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .input-status {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0;
            transition: var(--transition);
        }

        .form-input.valid + .input-icon + .input-status {
            opacity: 1;
            color: var(--secondary);
        }

        .form-input.error + .input-icon + .input-status {
            opacity: 1;
            color: #ef4444;
        }

        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .strength-bar {
            height: 100%;
            width: 0%;
            transition: var(--transition);
            border-radius: 2px;
        }

        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #10b981; width: 100%; }

        .strength-text {
            font-size: 12px;
            color: var(--gray);
            margin-top: 4px;
            text-align: right;
        }

        .btn {
            width: 100%;
            padding: 16px 24px;
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
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
            transform: translateY(-3px);
            box-shadow: var(--shadow-hover);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .links-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .login-link:hover {
            color: var(--primary-dark);
            transform: translateX(2px);
        }

        .terms-text {
            text-align: center;
            margin-top: 24px;
            color: var(--gray);
            font-size: 12px;
            line-height: 1.4;
        }

        .terms-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatShape 8s ease-in-out infinite;
        }

        .shape.square {
            border-radius: 20%;
        }

        @keyframes floatShape {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1); 
            }
            33% { 
                transform: translateY(-30px) rotate(120deg) scale(1.1); 
            }
            66% { 
                transform: translateY(15px) rotate(240deg) scale(0.9); 
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .register-card {
                padding: 32px 24px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .links-section {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .form-input {
                padding: 14px 14px 14px 44px;
            }
        }

        /* Loading state */
        .btn.loading {
            pointer-events: none;
            opacity: 0.9;
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

        /* Success animation */
        @keyframes successCheck {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .success-check {
            animation: successCheck 0.5s ease-out;
        }
    </style>
</head>
<body>
    <!-- Floating Shapes -->
    <div class="floating-shapes" id="shapes"></div>

    <div class="register-container">
        <div class="register-card">
            <!-- Logo -->
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Créer un compte</h1>
                <p>Rejoignez {{ config('app.name') }} dès maintenant</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">
                        <i class="fas fa-user"></i>
                        Nom complet
                    </label>
                    <div class="form-input-container">
                        <input id="name" 
                               class="form-input" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               placeholder="Votre nom complet">
                        <i class="fas fa-user input-icon"></i>
                        <i class="fas fa-check input-status"></i>
                    </div>
                    @if ($errors->has('name'))
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>
                        Adresse email
                    </label>
                    <div class="form-input-container">
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="votre@email.com">
                        <i class="fas fa-envelope input-icon"></i>
                        <i class="fas fa-check input-status"></i>
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
                    <div class="form-input-container">
                        <input id="password" 
                               class="form-input"
                               type="password"
                               name="password"
                               required 
                               autocomplete="new-password"
                               placeholder="Créez un mot de passe sécurisé">
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-check input-status"></i>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                    <div class="strength-text" id="strengthText">Faible</div>
                    @if ($errors->has('password'))
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        <i class="fas fa-lock"></i>
                        Confirmer le mot de passe
                    </label>
                    <div class="form-input-container">
                        <input id="password_confirmation" 
                               class="form-input"
                               type="password"
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirmez votre mot de passe">
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-check input-status"></i>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary" id="registerButton">
                    <i class="fas fa-user-plus"></i>
                    Créer mon compte
                </button>

                <div class="links-section">
                    <a class="login-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Déjà inscrit ? Se connecter
                    </a>
                </div>

                <div class="terms-text">
                    En créant un compte, vous acceptez nos 
                    <a href="#">Conditions d'utilisation</a> et notre 
                    <a href="#">Politique de confidentialité</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Créer des formes flottantes
        function createShapes() {
            const container = document.getElementById('shapes');
            const shapeCount = 8;
            
            for (let i = 0; i < shapeCount; i++) {
                const shape = document.createElement('div');
                shape.className = 'shape';
                
                // Taille aléatoire
                const size = Math.random() * 20 + 10;
                shape.style.width = `${size}px`;
                shape.style.height = `${size}px`;
                
                // Position aléatoire
                shape.style.left = `${Math.random() * 100}%`;
                shape.style.top = `${Math.random() * 100}%`;
                
                // Animation delay et duration aléatoires
                shape.style.animationDelay = `${Math.random() * 5}s`;
                shape.style.animationDuration = `${Math.random() * 4 + 6}s`;
                
                // Alterner entre cercles et carrés
                if (i % 2 === 0) {
                    shape.classList.add('square');
                }
                
                container.appendChild(shape);
            }
        }

        // Indicateur de force du mot de passe
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let text = 'Faible';
            let className = 'strength-weak';

            // Vérifications de force
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;

            // Déterminer la force
            switch(strength) {
                case 1:
                    text = 'Faible';
                    className = 'strength-weak';
                    break;
                case 2:
                    text = 'Moyen';
                    className = 'strength-fair';
                    break;
                case 3:
                    text = 'Bon';
                    className = 'strength-good';
                    break;
                case 4:
                    text = 'Fort';
                    className = 'strength-strong';
                    break;
            }

            // Mettre à jour l'affichage
            strengthBar.className = `strength-bar ${className}`;
            strengthText.textContent = text;
        });

        // Validation en temps réel
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.classList.add('valid');
                    this.classList.remove('error');
                } else {
                    this.classList.remove('valid');
                }
            });

            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animation de soumission
        const registerForm = document.getElementById('registerForm');
        const registerButton = document.getElementById('registerButton');

        registerForm.addEventListener('submit', function(e) {
            // Validation basique côté client
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                document.getElementById('password_confirmation').classList.add('error');
                return;
            }

            registerButton.classList.add('loading');
            registerButton.innerHTML = '<span>Création du compte...</span>';
        });

        // Vérification de la confirmation du mot de passe
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            if (this.value !== password && this.value.length > 0) {
                this.classList.add('error');
                this.classList.remove('valid');
            } else if (this.value === password && this.value.length > 0) {
                this.classList.add('valid');
                this.classList.remove('error');
            }
        });

        // Créer les formes au chargement
        document.addEventListener('DOMContentLoaded', createShapes);
    </script>
</body>
</html>