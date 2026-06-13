<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4ff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .hero-section {
            background: white;
            padding: 4rem 3rem;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.08);
            max-width: 800px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .hero-title {
            color: #1e293b;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            color: #64748b;
            font-size: 1.15rem;
            line-height: 1.6;
        }

        .btn-pastel {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .btn-pastel:hover {
            background-color: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }

        .btn-outline-pastel {
            background-color: transparent;
            color: #3b82f6;
            border: 2px solid #bfdbfe;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-outline-pastel:hover {
            background-color: #f0f4ff;
            border-color: #3b82f6;
            color: #2563eb;
            transform: translateY(-2px);
        }

        .link-pastel {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-pastel:hover {
            color: #3b82f6;
        }

        .badge-pastel {
            background-color: #e0e7ff;
            color: #4f46e5;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="hero-section mx-auto">
                    <h1 class="display-4 fw-bold hero-title mb-3">Jejak Karya</h1>
                    <p class="hero-subtitle mb-5 mx-auto" style="max-width: 600px;">
                        Platform pelaporan progres karya lomba untuk mahasiswa. Upload karya, pantau status, dan arsip sertifikat dengan mudah.                     
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-pastel btn-lg px-5">Buka Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-pastel btn-lg px-5">Login Akun</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-outline-pastel btn-lg px-5">Daftar Baru</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    
                    <div class="mt-5 pt-3 border-top border-light">
                        <a href="{{ route('faq') }}" class="link-pastel fw-medium">Lihat Pusat Bantuan (FAQ) &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>