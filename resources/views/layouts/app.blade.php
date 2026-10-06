<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Islami - Al-Qur\'an, Doa & Jadwal Shalat')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        arabic: ['"Amiri"', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .font-arabic {
            font-family: 'Amiri', serif;
            line-height: 2.2;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800 antialiased font-sans">

    <!-- Simple, Clean Navbar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 font-bold text-slate-900 text-lg hover:text-brand-700 transition-colors">
                    <span class="w-8 h-8 rounded-lg bg-brand-700 text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-moon"></i>
                    </span>
                    <span>Nurul Iman</span>
                </a>

                <!-- Nav links -->
                <nav class="hidden sm:flex items-center gap-1 text-sm font-medium text-slate-600">
                    <a href="{{ url('/') }}" 
                       class="px-3 py-1.5 rounded-lg transition-colors {{ request()->is('/') ? 'text-brand-800 font-semibold bg-brand-50' : 'hover:text-slate-900 hover:bg-slate-100' }}">
                        Beranda
                    </a>
                    <a href="{{ route('quran.index') }}" 
                       class="px-3 py-1.5 rounded-lg transition-colors {{ request()->is('quran*') || request()->is('detailquran*') ? 'text-brand-800 font-semibold bg-brand-50' : 'hover:text-slate-900 hover:bg-slate-100' }}">
                        Al-Qur'an
                    </a>
                    <a href="{{ route('doa.index') }}" 
                       class="px-3 py-1.5 rounded-lg transition-colors {{ request()->is('doa*') ? 'text-brand-800 font-semibold bg-brand-50' : 'hover:text-slate-900 hover:bg-slate-100' }}">
                        Doa Harian
                    </a>
                    <a href="{{ route('jadwal.index') }}" 
                       class="px-3 py-1.5 rounded-lg transition-colors {{ request()->is('jadwal*') ? 'text-brand-800 font-semibold bg-brand-50' : 'hover:text-slate-900 hover:bg-slate-100' }}">
                        Jadwal Shalat
                    </a>
                </nav>

                <!-- Mobile menu toggle -->
                <div class="sm:hidden">
                    <button type="button" id="mobile-toggle" class="p-2 text-slate-600 hover:text-slate-900">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile dropdown -->
        <div id="mobile-menu" class="hidden sm:hidden border-t border-slate-100 bg-white px-4 py-2 space-y-1">
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->is('/') ? 'bg-brand-50 text-brand-800 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">Beranda</a>
            <a href="{{ route('quran.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->is('quran*') || request()->is('detailquran*') ? 'bg-brand-50 text-brand-800 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">Al-Qur'an</a>
            <a href="{{ route('doa.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->is('doa*') ? 'bg-brand-50 text-brand-800 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">Doa Harian</a>
            <a href="{{ route('jadwal.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->is('jadwal*') ? 'bg-brand-50 text-brand-800 font-semibold' : 'text-slate-700 hover:bg-slate-50' }}">Jadwal Shalat</a>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Simple Clean Footer -->
    <footer class="bg-white border-t border-slate-200 mt-16 py-8 text-center text-xs text-slate-500">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>&copy; {{ date('Y') }} Nurul Iman • Portal Islami Sederhana</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('quran.index') }}" class="hover:text-slate-800">Al-Qur'an</a>
                <a href="{{ route('doa.index') }}" class="hover:text-slate-800">Doa Harian</a>
                <a href="{{ route('jadwal.index') }}" class="hover:text-slate-800">Jadwal Shalat</a>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 z-50 transform translate-y-16 opacity-0 pointer-events-none transition-all duration-200 bg-slate-900 text-white text-xs px-4 py-2.5 rounded-lg shadow-lg flex items-center gap-2">
        <i class="fa-solid fa-check text-emerald-400"></i>
        <span id="toast-text">Teks berhasil disalin</span>
    </div>

    <script>
        // Mobile menu toggle
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', () => menu.classList.toggle('hidden'));
        }

        // Copy Text Function
        window.copyText = function(text, label = 'Teks') {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => showToast(`${label} disalin`));
            } else {
                const ta = document.createElement('textarea');
                ta.value = text;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                showToast(`${label} disalin`);
            }
        };

        window.showToast = function(msg) {
            const toast = document.getElementById('toast');
            const toastText = document.getElementById('toast-text');
            if (!toast) return;
            toastText.innerText = msg;
            toast.classList.remove('translate-y-16', 'opacity-0', 'pointer-events-none');
            setTimeout(() => {
                toast.classList.add('translate-y-16', 'opacity-0', 'pointer-events-none');
            }, 2500);
        };
    </script>
    @stack('scripts')
</body>
</html>
