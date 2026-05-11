<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRENA ELITE | Potencia tu Evolución</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,700,900|outfit:300,400,600,900" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .text-gradient {
            background: linear-gradient(135deg, #fff 0%, #6366f1 50%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-bg-glow {
            position: absolute;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 50% 50%, rgba(79, 70, 229, 0.15) 0%, rgba(0, 0, 0, 0) 50%);
            top: -20vh;
            left: 0;
            z-index: -1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .indigo-glow-hover:hover {
            box-shadow: 0 0 50px rgba(99, 102, 241, 0.3);
            border-color: rgba(99, 102, 241, 0.5);
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-100 selection:bg-indigo-500 selection:text-white selection:bg-opacity-30 overflow-x-hidden">

    <div class="hero-bg-glow"></div>

    <!-- Navigation -->
    <nav
        class="fixed top-0 w-full z-[100] transition-all duration-500 border-b border-white/5 bg-slate-950/50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-4 group cursor-pointer">
                <div
                    class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center font-black text-white text-2xl italic shadow-2xl shadow-indigo-500/20 group-hover:rotate-6 transition-transform">
                    T</div>
                <span class="text-2xl font-black tracking-tighter uppercase italic text-white">TRENA<span
                        class="text-indigo-500 not-italic">ELITE</span></span>
            </div>

            <div class="hidden md:flex items-center gap-10">
                <a href="#features"
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-white transition-colors">Sistemas</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-8 py-3 bg-white text-slate-950 text-[10px] font-black uppercase tracking-widest rounded-xl hover:scale-105 transition-transform shadow-xl">Panel
                            de Control</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-indigo-400 transition-colors">Acceso</a>
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-500/20">Registrarse</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Hero -->
    <header class="relative pt-48 pb-32 px-6 flex flex-col items-center overflow-hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[1200px] h-[1200px] bg-indigo-500/5 rounded-full blur-[120px] -z-10 animate-pulse">
        </div>

        <div class="max-w-6xl mx-auto text-center relative z-10">
            <div
                class="inline-flex items-center gap-3 px-6 py-2.5 rounded-full glass mb-10 border-indigo-500/20 animate-fade-in shadow-2xl">
                <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_12px_#6366f1] animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-300">New Performance Standard
                    2026</span>
            </div>

            <h1 class="text-7xl md:text-9xl font-black tracking-tighter mb-10 leading-[0.85] uppercase">
                ELEVA TU <br />
                <span class="text-gradient italic">POTENCIAL</span>
            </h1>

            <p class="max-w-2xl mx-auto text-xl text-slate-400 mb-16 font-medium leading-relaxed opacity-80">
                La plataforma definitiva para el atleta moderno. Gestiona tu biomecánica, monitorea tu sobrecarga
                progresiva y domina cada entrenamiento con analíticas en tiempo real.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-8 mb-32">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto px-12 py-6 bg-white text-slate-950 font-black uppercase tracking-[0.2em] rounded-[2rem] hover:scale-105 transition-all shadow-[0_20px_50px_rgba(255,255,255,0.15)] text-sm">
                    Comenzar Evolución
                </a>
                <a href="#features"
                    class="w-full sm:w-auto px-12 py-6 glass font-black uppercase tracking-[0.2em] rounded-[2rem] hover:bg-white/5 transition-all text-sm border-white/10">
                    Sistemas Elite
                </a>
            </div>

            <!-- Device Mockup -->
            <div class="relative max-w-6xl mx-auto animate-float">
                <div
                    class="absolute -inset-4 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 rounded-[3.5rem] blur-2xl opacity-20 animate-pulse">
                </div>
                <div class="relative glass rounded-[3rem] p-4 border-white/10 shadow-2xl overflow-hidden group">
                    <div
                        class="relative rounded-[2.2rem] overflow-hidden bg-slate-900 border border-white/5 aspect-video">
                        <img src="{{ asset('images/hero.png') }}"
                            class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-all duration-1000">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60">
                        </div>

                        <!-- Dynamic Overlay Elements -->


                        <div class="absolute bottom-12 left-12 flex gap-6">
                            <div class="glass p-6 rounded-3xl border-indigo-500/20 backdrop-blur-2xl">
                                <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-1">Volumen
                                    Total</p>
                                <p class="text-3xl font-black text-white">+12.4% <span
                                        class="text-sm font-medium text-slate-500 ml-1">Semana</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features -->
    <section id="features" class="py-40 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-10 mb-24">
                <div class="max-w-xl">
                    <h2 class="text-5xl font-black tracking-tight mb-6 uppercase">Ecosistema <br /> de <span
                            class="text-indigo-500 italic">Alto Rendimiento</span></h2>
                    <p class="text-slate-400 text-lg font-medium">Diseñado por atletas para atletas. Cada herramienta
                        está optimizada para la precisión técnica.</p>
                </div>
                <div class="pb-2">
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-[0.5em]">Trena Elite OS
                        v3.0</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="glass p-12 rounded-[3rem] indigo-glow-hover transition-all duration-500 group">
                    <div
                        class="w-16 h-16 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-400 mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-6 uppercase tracking-tight">Sistemas de Rutinas</h3>
                    <p class="text-slate-400 leading-relaxed font-medium">Algoritmos inteligentes para organizar tus
                        sesiones de fuerza e hipertrofia con máxima eficiencia metabólica.</p>
                </div>

                <div class="glass p-12 rounded-[3rem] indigo-glow-hover transition-all duration-500 group">
                    <div
                        class="w-16 h-16 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-400 mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-6 uppercase tracking-tight">Data Biomecánica</h3>
                    <p class="text-slate-400 leading-relaxed font-medium">Visualización avanzada de registros
                        personales, volumen de carga y frecuencia por grupo muscular.</p>
                </div>

                <div class="glass p-12 rounded-[3rem] indigo-glow-hover transition-all duration-500 group">
                    <div
                        class="w-16 h-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-400 mb-10 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black mb-6 uppercase tracking-tight">Macro Planificación</h3>
                    <p class="text-slate-400 leading-relaxed font-medium">Control absoluto sobre tu microciclo semanal.
                        Equilibrio estratégico entre tensión mecánica y recuperación.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 px-6 border-t border-white/5 bg-slate-950">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="flex items-center gap-4">
                <div
                    class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center font-black text-white text-lg italic">
                    T</div>
                <span class="text-lg font-black tracking-tighter uppercase italic text-white">TRENA<span
                        class="text-indigo-500 not-italic">ELITE</span></span>
            </div>
            <div class="text-[10px] font-black text-slate-600 uppercase tracking-[0.4em]">
                &copy; 2026 TRENA ELITE CORE SYSTEMS. ALL RIGHTS RESERVED.
            </div>
            <div class="flex gap-8">
                <a href="#"
                    class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">Términos</a>
                <a href="#"
                    class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-white transition-colors">Privacidad</a>
            </div>
        </div>
    </footer>

</body>

</html>