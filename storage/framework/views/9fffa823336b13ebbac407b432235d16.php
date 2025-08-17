<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPASTA - Sistem Pendaftaran Sidang Tugas Akhir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white py-4 px-6 fixed w-full top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">SIPASTA</div>
            <div class="hidden md:flex space-x-6">
                <a href="#beranda" class="hover:underline">Beranda</a>
                <a href="#tentang" class="hover:underline">Tentang</a>
                <a href="#alur" class="hover:underline">Alur Pendaftaran</a>
                <a href="#kontak" class="hover:underline">Kontak</a>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('login')); ?>"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow-md hover:bg-gray-300 transition">Log
                    in</a>
                    <a href="<?php echo e(route('register')); ?>"
                    class="px-4 py-2 text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="beranda" class="flex flex-col items-center justify-center text-center pt-24 pb-10 px-6">
        <div class="container mx-auto max-w-3xl mt-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">SIPASTA</h1>
            <p class="text-lg text-gray-600 mb-2">Sistem Pendaftaran Sidang Tugas Akhir</p>
            <p class="text-gray-600">
                Platform digital untuk memudahkan mahasiswa dalam pendaftaran sidang Tugas Akhir.
            </p>
        </div>
    </header>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 px-6 bg-white">
        <div class="container mx-auto max-w-3xl">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Tentang SIPASTA</h2>
            <p class="text-gray-600 mb-6 text-center">
                SIPASTA (Sistem Pendaftaran Sidang Tugas Akhir) adalah platform untuk melakukan pendaftaran sidang secara online.
                Dengan menggunakan sistem ini, mahasiswa dapat menghemat waktu dan mempermudah proses administrasi.
            </p>

            <div class="grid md:grid-cols-3 gap-6 mt-10">
                <div class="bg-gray-100 p-6 rounded">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Mudah</h3>
                    <p class="text-gray-600">Pendaftaran dapat dilakukan kapanpun dan dimanapun tanpa perlu datang ke kampus</p>
                </div>

                <div class="bg-gray-100 p-6 rounded">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Cepat</h3>
                    <p class="text-gray-600">Proses verifikasi yang cepat dan penjadwalan otomatis untuk sidang Anda</p>
                </div>

                <div class="bg-gray-100 p-6 rounded">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Terintegrasi</h3>
                    <p class="text-gray-600">Terhubung dengan sistem akademik dan perpustakaan untuk validasi persyaratan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran -->
    <section id="alur" class="py-16 px-6 bg-gray-100">
        <div class="container mx-auto max-w-3xl">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Alur Pendaftaran</h2>
            <p class="text-gray-600 mb-10 text-center">
                Ikuti langkah-langkah berikut untuk mendaftar sidang tugas akhir
            </p>

            <div class="space-y-8">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <div class="flex items-start">
                        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-4">
                            1
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Buat Akun</h3>
                            <p class="text-gray-600">Daftar menggunakan email institusi Anda (@mahasiswa.ac.id)</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <div class="flex items-start">
                        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-4">
                            2
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Lengkapi Data</h3>
                            <p class="text-gray-600">Isi informasi pribadi, akademik, dan detail tugas akhir Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <div class="flex items-start">
                        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-4">
                            3
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Upload Dokumen</h3>
                            <p class="text-gray-600">Unggah naskah tugas akhir dan dokumen persyaratan</p>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <div class="flex items-start">
                        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-4">
                            4
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Verifikasi</h3>
                            <p class="text-gray-600">Tunggu proses verifikasi oleh admin (3-5 hari kerja)</p>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="bg-white p-6 rounded shadow-sm">
                    <div class="flex items-start">
                        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0 mr-4">
                            5
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Jadwal Sidang</h3>
                            <p class="text-gray-600">Dapatkan konfirmasi jadwal dan persiapkan diri untuk sidang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Persyaratan Section -->
    <section class="py-16 px-6 bg-white">
        <div class="container mx-auto max-w-3xl">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Persyaratan Sidang</h2>

            <div class="bg-gray-100 p-6 rounded">
                <ul class="space-y-3 list-disc pl-5">
                    <li class="text-gray-700">Telah menyelesaikan semua mata kuliah wajib dan pilihan</li>
                    <li class="text-gray-700">Mendapat persetujuan dari dosen pembimbing</li>
                    <li class="text-gray-700">Laporan tugas akhir yang sudah selesai (format PDF)</li>
                    <li class="text-gray-700">Transkrip nilai terbaru</li>
                    <li class="text-gray-700">Bukti pembayaran sidang tugas akhir</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-16 px-6 bg-gray-100">
        <div class="container mx-auto max-w-3xl text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Hubungi Kami</h2>
            <p class="text-gray-600 mb-8">
                Jika Anda memiliki pertanyaan seputar pendaftaran sidang tugas akhir, silakan hubungi kami melalui:
            </p>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded shadow-sm">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Email</h3>
                    <p class="text-gray-600">sipasta@universitas.ac.id</p>
                </div>

                <div class="bg-white p-6 rounded shadow-sm">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Telepon</h3>
                    <p class="text-gray-600">(021) 1234-5678</p>
                </div>

                <div class="bg-white p-6 rounded shadow-sm">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Lokasi</h3>
                    <p class="text-gray-600">Gedung Rektorat Lt. 2, Ruang 204</p>
                </div>
            </div>

            <p class="mt-8 text-gray-600">Jam layanan: Senin-Jumat, 08.00-16.00 WIB</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-8 px-6">
        <div class="container mx-auto max-w-3xl">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="font-semibold mb-1">SIPASTA</p>
                    <p class="text-sm text-blue-100">Sistem Pendaftaran Sidang Tugas Akhir</p>
                </div>
            </div>

            <div class="border-t border-blue-500 mt-6 pt-6 text-center">
                <p class="text-sm text-blue-100">&copy; 2025 SIPASTA</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
<?php /**PATH D:\Alip\Project\Daftar-Sidang\resources\views\welcome.blade.php ENDPATH**/ ?>