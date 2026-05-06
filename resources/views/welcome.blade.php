<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRENA - Gestión Fitness Profesional</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            indigo: {
                                500: '#6366f1',
                                600: '#4f46e5',
                                700: '#4338ca',
                            }
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        /* Gradiente integrado directamente sobre la imagen para asegurar legibilidad */
        .hero-bg {
            background-image: linear-gradient(to bottom, rgba(17, 24, 39, 0.7), rgba(3, 7, 18, 0.95)), url('{{ asset("images/hero_aesthetic.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="antialiased bg-gray-950 text-gray-100 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Header (Estilo Glassmorphism Oscuro) -->
    <header
        class="fixed top-0 w-full z-50 bg-gray-950/80 backdrop-blur-md border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

            <!-- Logo Izquierda -->
            <a href="/" class="flex items-center gap-3 group" aria-label="Inicio TRENA">
                <div class="w-10 h-10 text-indigo-500 group-hover:scale-105 transition-transform">
                    <x-application-logo />
                </div>
                <span class="text-2xl font-bold tracking-tight uppercase text-white">TRENA</span>
            </a>

            <!-- Botones Derecha -->
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-500 transition-all shadow-lg shadow-indigo-500/20">
                            Mi Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="hidden sm:block px-6 py-2.5 bg-white text-gray-900 font-bold rounded-full hover:bg-gray-200 transition-all shadow-lg">
                            Iniciar Sesión
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2.5 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-500 transition-all shadow-lg">
                                Registrarse
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">

        <!-- Hero Section -->
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center hero-bg pt-20 px-6 overflow-hidden">

            <!-- Contenido Principal -->
            <div class="relative z-10 text-center max-w-5xl mx-auto flex flex-col items-center justify-center">

                <span
                    class="inline-flex items-center gap-3 px-6 py-2.5 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 text-base md:text-lg font-bold tracking-[0.2em] uppercase mb-8 backdrop-blur-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-400 animate-pulse"></span>
                    Plataforma de Alto Rendimiento
                </span>

                <!-- Título Principal (Ahora sí, en grande) -->
                <h1
                    class="text-6xl md:text-8xl lg:text-9xl font-black text-white mb-6 tracking-tighter leading-none uppercase drop-shadow-2xl">
                    TRENA ELITE
                </h1>

                <!-- Descripción (En color claro para que contraste) -->
                <p
                    class="text-xl md:text-2xl text-gray-200 font-medium mb-12 max-w-3xl mx-auto leading-relaxed drop-shadow-md">
                    Tu sistema profesional para dominar cada entrenamiento y controlar tus resultados con precisión
                    absoluta.
                </p>

                <!-- Botones de Acción (Separados correctamente por sesión) -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center w-full">
                    @guest
                        <!-- Botones si el usuario NO ha iniciado sesión -->
                        <a href="{{ route('login') }}"
                            class="w-full sm:w-auto px-10 py-4 bg-white text-gray-900 text-lg font-black uppercase tracking-wide rounded-full hover:bg-gray-200 transition-all shadow-xl flex items-center justify-center">
                            Iniciar Sesión
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="w-full sm:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-lg font-black uppercase tracking-wide rounded-full transition-all shadow-lg shadow-indigo-600/30 flex items-center justify-center">
                                Registrarse
                            </a>
                        @endif
                    @else
                        <!-- Botón si el usuario SÍ ha iniciado sesión -->
                        <a href="{{ url('/dashboard') }}"
                            class="w-full sm:w-auto px-12 py-5 bg-indigo-600 hover:bg-indigo-500 text-white text-xl font-black uppercase tracking-wide rounded-full transition-all shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-3">
                            Entrar al Panel
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Explicación de la web (Limpia y Ordenada) -->
        <section class="py-24 bg-white dark:bg-gray-950">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-24">
                    <div>
                        <h2 class="text-indigo-600 font-black uppercase tracking-widest text-sm mb-4">Eficiencia Máxima
                        </h2>
                        <h3
                            class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-8 leading-tight">
                            ¿Por qué elegir <span class="italic text-indigo-600">TRENA</span>?
                        </h3>
                        <p class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed mb-8">
                            Hemos diseñado una herramienta pensando en el atleta moderno. Centraliza toda tu actividad
                            deportiva en un solo lugar y alcanza tus metas.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 text-gray-700 dark:text-gray-200 font-bold">
                                <span
                                    class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 flex items-center justify-center rounded-full text-sm">1</span>
                                Interfaz intuitiva adaptada a móviles.
                            </div>
                            <div class="flex items-center gap-4 text-gray-700 dark:text-gray-200 font-bold">
                                <span
                                    class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 flex items-center justify-center rounded-full text-sm">2</span>
                                Historial completo de levantamientos.
                            </div>
                            <div class="flex items-center gap-4 text-gray-700 dark:text-gray-200 font-bold">
                                <span
                                    class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 flex items-center justify-center rounded-full text-sm">3</span>
                                Base de datos con cientos de ejercicios.
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-gray-50 dark:bg-gray-900 p-8 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                            <div class="text-3xl mb-4">💪</div>
                            <h4 class="font-bold text-lg mb-2">Rutinas</h4>
                            <p class="text-sm text-gray-500">Crea y edita tus sesiones.</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-900 p-8 rounded-[2rem] border border-gray-100 dark:border-gray-800 mt-8">
                            <div class="text-3xl mb-4">📈</div>
                            <h4 class="font-bold text-lg mb-2">Progreso</h4>
                            <p class="text-sm text-gray-500">Analiza tu evolución semanal.</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-900 p-8 rounded-[2rem] border border-gray-100 dark:border-gray-800 -mt-8">
                            <div class="text-3xl mb-4">📅</div>
                            <h4 class="font-bold text-lg mb-2">Planificación</h4>
                            <p class="text-sm text-gray-500">Organiza tu semana.</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-900 p-8 rounded-[2rem] border border-gray-100 dark:border-gray-800">
                            <div class="text-3xl mb-4">🚀</div>
                            <h4 class="font-bold text-lg mb-2">Elite</h4>
                            <p class="text-sm text-gray-500">Resultados garantizados.</p>
                        </div>
                    </div>
                </div>

                <!-- Opciones que ofrece -->
                <div class="border-t border-gray-100 dark:border-gray-800 pt-24">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                        <div>
                            <div
                                class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-2xl mb-6 mx-auto">
                                🏋️‍♂️</div>
                            <h5 class="text-xl font-bold mb-3">Gestión de Rutinas</h5>
                            <p class="text-gray-500 text-sm">Sistema avanzado para añadir ejercicios, series y
                                repeticiones.</p>
                        </div>
                        <div>
                            <div
                                class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-2xl mb-6 mx-auto">
                                🗓️</div>
                            <h5 class="text-xl font-bold mb-3">Planificador Semanal</h5>
                            <p class="text-gray-500 text-sm">Visualiza tu carga de trabajo por días con un clic.</p>
                        </div>
                        <div>
                            <div
                                class="w-16 h-16 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-2xl mb-6 mx-auto">
                                📊</div>
                            <h5 class="text-xl font-bold mb-3">Estadísticas Reales</h5>
                            <p class="text-gray-500 text-sm">Gráficas dinámicas que muestran tu progresión histórica.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-12 bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-500 text-xs font-black uppercase tracking-widest">
                &copy; {{ date('Y') }} TRENA ELITE - DISEÑO PARA ATLETAS
            </p>
        </div>
    </footer>

</body>

</html>