<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login TaduLapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            margin: 0; padding: 0; font-family: 'Poppins', sans-serif;
            /* Background Utama Halaman */
            background: linear-gradient(135deg, #0d2b52 0%, #5a0b0b 100%);
            height: 100vh;
            display: flex; justify-content: center; align-items: center;
            overflow: hidden; /* Mencegah scrollbar */
        }

        /* --- LOGO DI POJOK KIRI ATAS --- */
        .brand-logo {
            position: absolute;
            top: 30px;
            left: 40px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
            z-index: 10;
        }
        .brand-logo img { height: 50px; } /* Sesuaikan ukuran logo */
        .brand-text h1 { margin: 0; font-size: 24px; font-weight: bold; color: #cc0000; text-shadow: 1px 1px 2px rgba(0,0,0,0.5); }
        .brand-text span { font-size: 14px; color: white; font-weight: 300; }


        /* --- CONTAINER PUTIH --- */
        .login-card {
            background: white;
            width: 450px;
            padding: 50px 40px;
            border-radius: 30px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .login-card h2 {
            margin: 0 0 30px 0;
            font-size: 32px;
            font-weight: 600;
            color: #000;
        }

        /* --- INPUT FIELD STYLE (GRADIENT GELAP) --- */
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input, 
        .input-group select {
            width: 100%;
            padding: 15px 15px 15px 50px; /* Padding kiri buat icon */
            border-radius: 12px;
            border: none;
            
            /* Gradient Background Input sesuai gambar */
            background: linear-gradient(90deg, #102a4a 0%, #750000 100%);
            
            color: white;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            outline: none;
        }

        /* Placeholder warna putih agak transparan */
        .input-group input::placeholder { color: rgba(255, 255, 255, 0.7); }
        
        /* Icon styling */
        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 18px;
            z-index: 2;
        }

        /* Panah Select Dropdown warna putih */
        .input-group select {
            appearance: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.9);
        }
        .arrow-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: white;
            font-size: 12px;
            pointer-events: none;
        }


        /* --- TOMBOL LOGIN --- */
        .btn-login {
            width: 50%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 12px;
            border: none;
            
            /* Gradient Button sedikit lebih terang */
            background: linear-gradient(90deg, #1a3c66, #990000);
            
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .btn-login:hover { transform: scale(1.05); }

        /* Alert Error */
        .alert {
            background: #ffecec;
            color: #d63031;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="brand-logo">
        <img src="{{ asset('images/untad.png') }}" alt="Logo Untad" style="height: 50px; margin-right: 5px;">
        <img src="{{ asset('images/Tadulapor.png') }}" alt="Logo Tadulapor">
        <div class="brand-text">
            <h1>TaduLapor</h1>
            <span>Tadulako Mendengar</span>
        </div>
    </div>

    <div class="login-card">
        <h2>Login Form</h2>

        @if($errors->any())
            <div class="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.auth') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="far fa-user input-icon"></i>
                <input type="text" name="name" placeholder="Username" required>
            </div>

            <div class="input-group">
                <i class="fas fa-id-card input-icon"></i>
                <input type="text" name="nim" placeholder="NIM" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group">
                <i class="fas fa-users-cog input-icon"></i>
                <select name="role_display">
                    <option value="" disabled selected>Role</option>
                    <option value="mahasiswa" style="color:black">Mahasiswa</option>
                    <option value="admin" style="color:black">Admin</option>
                </select>
                <i class="fas fa-chevron-down arrow-icon"></i>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>

</body>
</html>