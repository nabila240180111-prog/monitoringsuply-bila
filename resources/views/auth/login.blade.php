<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PortBila Risk Monitor</title>
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-orange: #FF6B35;
            --primary-orange-hover: #E85A24;
            --primary-orange-light: rgba(255, 107, 53, 0.08);
            --bg-light: #F8F9FA;
            --text-dark: #1E293B;
            --border-light: #E2E8F0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #ffffff;
            border: 1px solid var(--border-light);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            box-shadow: 0 15px 50px rgba(255, 107, 53, 0.05);
            border-color: rgba(255, 107, 53, 0.2);
        }

        .logo-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--text-dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo-title span {
            color: var(--primary-orange);
        }

        .custom-input {
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 3px var(--primary-orange-light);
        }

        .btn-orange {
            background-color: var(--primary-orange);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            padding: 12px;
            transition: all 0.2s ease;
        }

        .btn-orange:hover {
            background-color: var(--primary-orange-hover);
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <div class="logo-title mb-2">
                <i class="fa-solid fa-shield-halved" style="color: var(--primary-orange);"></i>
                PORT<span>BILA</span>
            </div>
            <p class="text-secondary small">Global Supply Chain Risk Intelligence Monitor</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small border-0 rounded-3 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-muted small fw-medium">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control custom-input" placeholder="name@company.com" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <label for="password" class="form-label text-muted small fw-medium">Password</label>
                </div>
                <input type="password" name="password" id="password" class="form-control custom-input" placeholder="Masukkan password..." required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label text-secondary small pointer-event" for="remember" style="cursor: pointer;">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-orange w-100 mb-3">Masuk ke Dashboard</button>
        </form>


    </div>

</body>
</html>
