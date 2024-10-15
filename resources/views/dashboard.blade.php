<x-app-layout>
    <div id="background" class="min-h-screen bg-gradient-to-br from-gray-900 via-indigo-900 to-black flex items-center justify-center p-4 transition-all duration-500">
        <div id="dashboard" class="glassmorphism w-full max-w-4xl p-8 rounded-3xl shadow-2xl backdrop-blur-lg bg-gray-800 bg-opacity-30 border border-gray-700 border-opacity-50 transform transition-all duration-300 ease-out">
            <div id="light" class="absolute inset-0 bg-gradient-radial from-transparent to-transparent pointer-events-none transition-opacity duration-300 opacity-0"></div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500 mb-6 text-center relative z-10">
                Dashboard 
            </h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                <div class="neo-card p-6 rounded-2xl">
                    <h2 class="text-2xl font-bold text-blue-300 mb-4">Estadísticas</h2>
                    <div class="flex justify-around">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-400">{{ session()->get('visit_count', 0) }}</div>
                            <div class="text-sm text-gray-400">Visitas</div>
                        </div>
                        <div class="text-center">
                            <div id="currentTime" class="text-3xl font-bold text-purple-400">{{ now()->format('H:i') }}</div>
                            <div class="text-sm text-gray-400">Hora Actual</div>
                        </div>
                    </div>
                </div>
                
                <div class="neo-card p-6 rounded-2xl">
                    <h2 class="text-2xl font-bold text-blue-300 mb-4">Acciones Rápidas</h2>
                    <div class="flex flex-col space-y-4">
                        <button id="toggleTheme" class="neo-button py-2 px-4 rounded-full text-gray-200 font-semibold hover:bg-indigo-600 hover:bg-opacity-30 transition duration-300">
                            Cambiar Tema
                        </button>
                        <button id="showAlert" class="neo-button py-2 px-4 rounded-full text-gray-200 font-semibold hover:bg-indigo-600 hover:bg-opacity-30 transition duration-300">
                            Notificación
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 neo-card p-6 rounded-2xl relative z-10">
                <h2 class="text-2xl font-bold text-blue-300 mb-4">Objetivos del Proyecto</h2>
                <ul class="space-y-2 text-gray-300">
                    <li class="flex items-center"><span class="mr-2">🚀</span> Explorar nuevas características de Laravel</li>
                    <li class="flex items-center"><span class="mr-2">🔧</span> Desarrollar APIs RESTful</li>
                    <li class="flex items-center"><span class="mr-2">🔒</span> Implementar autenticación avanzada</li>
                    <li class="flex items-center"><span class="mr-2">💾</span> Optimizar consultas de base de datos</li>
                    <li class="flex items-center"><span class="mr-2">📚</span> Aplicar mejores prácticas de desarrollo</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .glassmorphism {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
        }
        .neo-card {
            background: rgba(30, 41, 59, 0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .neo-button {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.6), rgba(30, 41, 59, 0.8));
            box-shadow: 0 4px 15px 0 rgba(31, 38, 135, 0.37);
        }
        .bg-gradient-radial {
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        }
    </style>

    <script>
        let isDark = true;
        const dashboard = document.getElementById('dashboard');
        const background = document.getElementById('background');
        const light = document.getElementById('light');

        document.getElementById('toggleTheme').addEventListener('click', function() {
            isDark = !isDark;
            if (isDark) {
                background.style.background = 'linear-gradient(to bottom right, #111827, #1e3a8a, #312e81)';
                dashboard.style.backgroundColor = 'rgba(31, 41, 55, 0.3)';
            } else {
                background.style.background = 'linear-gradient(to bottom right, #3730a3, #4f46e5, #6366f1)';
                dashboard.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
            }
        });

        document.getElementById('showAlert').addEventListener('click', function() {
            alert('¡Notificación del futuro recibida!');
        });

        function updateTime() {
            const now = new Date();
            document.getElementById('currentTime').textContent = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
        }

        setInterval(updateTime, 60000); // Actualiza cada minuto
        updateTime(); // Actualiza inmediatamente al cargar la página

        // Efecto 3D y luz al mover el cursor
        document.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const { innerWidth, innerHeight } = window;
            
            const xAxis = (clientX / innerWidth - 0.5) * 20;
            const yAxis = (clientY / innerHeight - 0.5) * 20;
            
            dashboard.style.transform = `perspective(1000px) rotateY(${xAxis}deg) rotateX(${-yAxis}deg)`;

            // Efecto de luz
            const lightX = (clientX / innerWidth) * 100;
            const lightY = (clientY / innerHeight) * 100;
            light.style.background = `radial-gradient(circle at ${lightX}% ${lightY}%, rgba(33,25,255,0.1) 0%, rgba(255,255,255,0) 70%)`;
            light.style.opacity = '1';
        });

        // Restablecer la posición y quitar la luz cuando el cursor sale del dashboard
        dashboard.addEventListener('mouseleave', () => {
            dashboard.style.transform = 'perspective(1000px) rotateY(0) rotateX(0)';
            light.style.opacity = '0';
        });
    </script>
</x-app-layout>