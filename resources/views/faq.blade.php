<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan & FAQ - Jejak Karya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
        }
        /* Custom UI untuk Accordion biar lebih rapi */
        .accordion-button:not(.collapsed) {
            background-color: #e2e8f0;
            color: #0f172a;
            font-weight: 600;
        }
        .accordion-button:focus { 
            box-shadow: none; 
            border-color: rgba(0,0,0,.125); 
        }
        .accordion-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 8px !important;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

    <!-- Navbar Sederhana -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Jejak Karya</a>
            <a class="btn btn-light btn-sm fw-medium" href="{{ url()->previous() }}">Kembali</a>
        </div>
    </nav>

    <!-- Konten Utama FAQ -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark">Pusat Bantuan (FAQ)</h2>
                    <p class="text-muted">Jawaban untuk pertanyaan yang sering diajukan seputar penggunaan portal.</p>
                </div>

                <!-- Accordion UI Start -->
                <div class="accordion" id="faqAccordion">
                    
                    <!-- Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Kenapa lomba yang aku ikuti nggak ada di pilihan dropdown?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary lh-lg">
                                Admin kampus hanya memasukkan daftar lomba rekomendasi yang difasilitasi oleh fakultas agar pendataan tetap rapi. Kalau lombamu belum ada di daftar, silakan hubungi Admin Kemahasiswaan/TU agar daftarnya segera ditambahkan.
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                File apa aja yang wajib di-upload ke sistem?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary lh-lg">
                                Di tahap awal (Persiapan), kamu cuma butuh upload draft Proposal berupa PDF. Nanti kalau kamu menang atau lombanya sudah selesai, silakan edit statusmu dan upload bukti Sertifikat untuk kebutuhan verifikasi kampus.
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Kok status karyaku tiba-tiba jadi "Ditolak / Revisi"?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary lh-lg">
                                Ini berarti Admin menemukan ketidaksesuaian pada file yang kamu upload. Bisa jadi sertifikatnya buram, file rusak, atau salah mengklaim nama lomba. Pastikan file yang dikirim bisa dibaca jelas, lalu update kembali progresmu.
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Accordion UI End -->

                <div class="text-center mt-5">
                    <p class="text-muted small">Sistem error atau butuh bantuan lain? <br> Silakan datang langsung ke Ruang Tata Usaha Departemen.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (Wajib agar Accordion bisa di-klik) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>