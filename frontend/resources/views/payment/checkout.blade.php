<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Sécurisé - {{ $book->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            --border-radius: 12px;
            --border-radius-lg: 20px;
            --shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        /* Navigation moderne */
        nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .logo {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Carte principale */
        .payment-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
        }

        .payment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }

        /* Section livre */
        .book-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }

        .book-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .book-image {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        }

        .book-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: var(--transition);
        }

        .book-image:hover::before {
            left: 100%;
        }

        /* Formulaire */
        .form-section {
            background: white;
        }

        .form-group {
            margin-bottom: 24px;
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
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Cartes de crédit */
        .card-icons {
            display: flex;
            gap: 12px;
            margin-top: 8px;
        }

        .card-icon {
            width: 40px;
            height: 24px;
            background: #f3f4f6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            transition: var(--transition);
        }

        .card-icon.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Bouton de paiement */
        .pay-button {
            width: 100%;
            padding: 18px 24px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .pay-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: var(--transition);
        }

        .pay-button:hover::before {
            left: 100%;
        }

        .pay-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .pay-button:active {
            transform: translateY(0);
        }

        /* Sécurité */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 16px;
            color: #6b7280;
            font-size: 14px;
        }

        .security-badge i {
            color: var(--secondary);
        }

        /* Prix */
        .price-tag {
            background: var(--gradient);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 20px;
            display: inline-block;
            margin-top: 12px;
            box-shadow: var(--shadow);
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .payment-card {
                margin: 20px;
            }
            
            .book-section, .form-section {
                padding: 24px;
            }
        }

        /* Loader */
        .loader {
            width: 20px;
            height: 20px;
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
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-book-open text-2xl mr-3 logo"></i>
                    <h1 class="text-xl font-bold logo">{{ config('app.name') }}</h1>
                </div>
                <a href="{{ route('books.show', $book) }}" class="bg-white/90 hover:bg-white text-gray-700 px-4 py-2 rounded-xl transition duration-200 font-medium shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i>Retour au livre
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="max-w-6xl mx-auto py-8 px-4 pt-24">
        <div class="payment-card animate-fade-in-up">
            <div class="md:flex">
                <!-- Section Livre -->
                <div class="md:w-2/5 book-section p-8">
                    <div class="relative z-10">
                        <div class="text-center mb-8">
                            <div class="book-image h-64 mx-auto mb-6">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" 
                                         alt="{{ $book->title }}" 
                                         class="h-full w-full object-cover">
                                @else
                                    <div class="h-full flex items-center justify-center">
                                        <i class="fas fa-book text-gray-400 text-6xl"></i>
                                    </div>
                                @endif
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $book->title }}</h2>
                            <p class="text-gray-600 mb-4">par {{ $book->author }}</p>
                            <div class="price-tag">
                                {{ number_format($book->price, 2) }} €
                            </div>
                        </div>

                        <div class="bg-white/80 rounded-xl p-6 border border-white">
                            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-shield-alt text-green-500"></i>
                                Achat sécurisé
                            </h3>
                            <ul class="space-y-3 text-sm text-gray-600">
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-check text-green-500"></i>
                                    Paiement 100% sécurisé SSL
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-check text-green-500"></i>
                                    Accès immédiat après paiement
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-check text-green-500"></i>
                                    Support 7j/7
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de paiement -->
                <div class="md:w-3/5 form-section p-8">
                    <div class="max-w-md mx-auto">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">Paiement Sécurisé</h3>
                        <p class="text-gray-600 mb-8">Finalisez votre achat en toute sécurité</p>
                        
                        <form action="{{ route('payment.process', $book) }}" method="POST" id="paymentForm">
                            @csrf
                            
                            <!-- Informations personnelles -->
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-user text-blue-500"></i>
                                    Informations personnelles
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">
                                            <i class="fas fa-user"></i>
                                            Prénom
                                        </label>
                                        <input type="text" name="first_name" required 
                                               class="form-input" placeholder="Votre prénom">
                                    </div>
                                    <div>
                                        <label class="form-label">
                                            <i class="fas fa-user"></i>
                                            Nom
                                        </label>
                                        <input type="text" name="last_name" required 
                                               class="form-input" placeholder="Votre nom">
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de paiement -->
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-credit-card text-purple-500"></i>
                                    Carte de paiement
                                </h4>
                                
                                <div class="mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-credit-card"></i>
                                        Numéro de carte
                                    </label>
                                    <input type="text" id="card_number" 
                                           placeholder="1234 5678 9012 3456" required 
                                           class="form-input" maxlength="19">
                                    <div class="card-icons">
                                        <div class="card-icon active">
                                            <i class="fab fa-cc-visa"></i>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fab fa-cc-mastercard"></i>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fab fa-cc-amex"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">
                                            <i class="fas fa-calendar"></i>
                                            Expiration
                                        </label>
                                        <input type="text" id="expiry_date" 
                                               placeholder="MM/AA" required 
                                               class="form-input" maxlength="5">
                                    </div>
                                    <div>
                                        <label class="form-label">
                                            <i class="fas fa-lock"></i>
                                            CVV
                                        </label>
                                        <input type="text" id="cvv" 
                                               placeholder="123" required 
                                               class="form-input" maxlength="3">
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton de paiement -->
                            <button type="submit" class="pay-button" id="payButton">
                                <i class="fas fa-lock"></i>
                                Payer {{ number_format($book->price, 2) }} €
                            </button>

                            <div class="security-badge">
                                <i class="fas fa-shield-alt"></i>
                                Transaction sécurisée SSL 256-bit
                            </div>

                            <!-- Annuler -->
                            <a href="{{ route('books.show', $book) }}" 
                               class="block text-center text-gray-500 hover:text-gray-700 mt-6 transition duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Annuler et retourner au livre
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Formatage du numéro de carte
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ').substr(0, 19) || '';
            e.target.value = formattedValue;
        });

        // Formatage de la date d'expiration
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\//g, '').replace(/[^0-9]/gi, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value.substring(0, 5);
        });

        // Restriction CVV aux chiffres uniquement
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/gi, '');
        });

        // Animation du bouton de paiement
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const button = document.getElementById('payButton');
            button.disabled = true;
            button.innerHTML = '<div class="loader"></div> Traitement en cours...';
            
            // Simulation de traitement
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check"></i> Paiement réussi !';
                button.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            }, 2000);
        });

        // Changement d'icône de carte
        document.querySelectorAll('.card-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                document.querySelectorAll('.card-icon').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Effet de focus sur les inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });
    </script>
</body>
</html>