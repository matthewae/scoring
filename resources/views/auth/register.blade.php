<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT. Mandajaya Rekayasa Konstruksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f8;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-left {
            background: linear-gradient(135deg, #004d40, #00acc1);
            padding: 60px 30px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: fixed;
            width: 41.666667%;
        }

        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .login-left > * {
            position: relative;
            z-index: 2;
        }

        .login-left img {
            max-width: 140px;
            margin-bottom: 30px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .login-right {
            margin-left: auto;
            padding: 60px 40px;
            background: #ffffff;
        }

        .form-control {
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 0 0.2rem rgba(63,81,181,0.2);
            background: #ffffff;
        }

        .form-label {
            font-weight: 600;
            color: #424242;
        }

        .btn-register {
            background: linear-gradient(45deg, #3f51b5, #1a237e);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease-in-out;
        }

        .btn-register:hover {
            background: linear-gradient(45deg, #1a237e, #3f51b5);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(63,81,181,0.3);
        }

        .btn-login {
            background-color: #e3f2fd;
            color: #0d47a1;
            border-radius: 8px;
            padding: 10px 24px;
            transition: all 0.3s ease-in-out;
        }

        .btn-login:hover {
            background-color: #bbdefb;
            color: #0d47a1;
            text-decoration: none;
        }

        .text-decoration-none {
            color: #1a237e;
            transition: 0.3s;
        }

        .text-decoration-none:hover {
            color: #0d47a1;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="login-left">
                    <div id="particles-js"></div>
                    <img src="{{ asset('images/logo fix2.png') }}" alt="Logo Kota Bandung">
                    <h3 class="mb-3 text-center">PT. MANDAJAYA REKAYASA KONSTRUKSI</h3>
                    <p class="mb-0">Sistem Scoring Project</p>
                </div>
            </div>
            <div class="col-md-7 offset-md-5">
                <div class="login-right">
                    <h4 class="mb-4 fw-bold">Daftar Akun Baru</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-register btn-lg">Daftar</button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="me-2">Sudah punya akun?</span>
                            <a class="btn btn-login" href="{{ route('login') }}">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 1000 } },
                    color: { value: '#ffffff' },
                    shape: {
                        type: 'circle',
                        stroke: { width: 0, color: '#000000' },
                        polygon: { nb_sides: 5 }
                    },
                    opacity: {
                        value: 0.3,
                        random: true,
                        anim: { enable: true, speed: 1, opacity_min: 0.1, sync: false }
                    },
                    size: {
                        value: 5,
                        random: true,
                        anim: { enable: true, speed: 2, size_min: 0.1, sync: false }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ffffff',
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 1.5,
                        direction: 'none',
                        random: true,
                        straight: false,
                        out_mode: 'out',
                        bounce: false,
                        attract: { enable: true, rotateX: 600, rotateY: 1200 }
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'bubble' },
                        onclick: { enable: true, mode: 'push' },
                        resize: true
                    },
                    modes: {
                        bubble: { distance: 200, size: 6, duration: 2, opacity: 0.4, speed: 2 },
                        push: { particles_nb: 4 }
                    }
                },
                retina_detect: true
            });
        });
    </script>
</body>
</html>
