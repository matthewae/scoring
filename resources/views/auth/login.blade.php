<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pemerintah Kota Bandung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #fff;
        }
        .login-container {
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
            margin: 0;
        }
        .login-left {
            background: linear-gradient(45deg, #ff6b6b, #ff8787);
            padding: 60px 30px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-left img {
            max-width: 120px;
            margin-bottom: 20px;
        }
        .login-right {
            padding: 60px 40px;
            background: white;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #eee;
            border-radius: 0;
            padding: 0.75rem 0;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: none;
        }
        .form-label {
            color: #666;
            font-weight: 500;
        }
        .btn-primary {
            background: linear-gradient(45deg, #ff6b6b, #ff8787);
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #ff8787, #ff6b6b);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
        }
        .text-decoration-none {
            color: #ff6b6b;
        }
        .text-decoration-none:hover {
            color: #ff8787;
        }
        .form-check-input:checked {
            background-color: #ff6b6b;
            border-color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="login-left">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Coat_of_arms_of_Bandung.svg" alt="Logo Kota Bandung">
                    <h3 class="mb-3">Pemerintah Kota Bandung</h3>
                    <p class="mb-0">Sistem Informasi Manajemen</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="login-right">
                    <h4 class="mb-4">Login to Your Account</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ingat Saya
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Masuk
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small class="text-muted">&copy; {{ date('Y') }} Pemerintah Kota Bandung. All rights reserved.</small>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
