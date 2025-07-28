 <!-- Barre latérale -->
    <div id="sidebar" class="bg-white border-r border-gray-200 h-[100vh] fixed w-20 md:w-64 transition-all duration-300 ease-in-out overflow-hidden flex flex-col">
        <!-- En-tête -->
        <div class="p-5 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 w-10 h-10 rounded-lg flex items-center justify-center">
                    <i class="fas fa-palette text-white text-xl"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-800 hidden md:block">Commerce.io</h1>
            </div>
            <button id="toggle-sidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 py-4 px-2 overflow-y-auto">
            <ul class="space-y-1">
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 group">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-home sidebar-icon text-blue-500 group-hover:text-blue-600 transition-transform duration-200"></i>
                        </div>
                        <span class="ml-4 font-medium hidden md:block">Accueil</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 group">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-chart-line sidebar-icon text-green-500 group-hover:text-green-600 transition-transform duration-200"></i>
                        </div>
                        <span class="ml-4 font-medium hidden md:block">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 group">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-users sidebar-icon text-purple-500 group-hover:text-purple-600 transition-transform duration-200"></i>
                        </div>
                        <span class="ml-4 font-medium hidden md:block">Clients</span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 group">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="fas fa-bell sidebar-icon text-red-500 group-hover:text-red-600 transition-transform duration-200"></i>
                        </div>
                        <span class="ml-4 font-medium hidden md:block">Notifications</span>
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full hidden md:block">3</span>
                    </a>
                </li>
            </ul>
            
            <div class="mt-8 pt-4 border-t border-gray-200">
                <div class="text-xs text-gray-500 uppercase font-medium px-3 mb-2 hidden md:block">Autres</div>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="sidebar-item flex items-center p-3 rounded-lg text-gray-700 hover:bg-blue-50 group">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-question-circle sidebar-icon text-gray-500 group-hover:text-gray-700 transition-transform duration-200"></i>
                            </div>
                            <span class="ml-4 font-medium hidden md:block">Aide</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $_ENV['WEB_ROOT'] ?>/logout" class="sidebar-item flex items-center p-3 rounded-lg text-red-500 hover:bg-blue-50 group">
                            <div class="w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-sign-out-alt sidebar-icon text-red-500 group-hover:text-gray-700 transition-transform duration-200"></i>
                            </div>
                            <span class="ml-4 font-medium hidden md:block">Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- Profil utilisateur -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold">
                    <?= substr($_SESSION['user']->getPrenom(), 0, 1) . substr($_SESSION['user']->getNom(), 0, 1) ?>
                </div>
                <div class="ml-3 hidden md:block">
                    <div class="font-medium text-gray-800"><?= $_SESSION['user']->getPrenom() ?? 'Indefined' ?> <?= $_SESSION['user']->getNom() ?? 'Indefined' ?></div>
                    <div class="text-xs text-gray-500">Administrateur</div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle-sidebar');
            
            toggleBtn.addEventListener('click', function() {
                if (sidebar.classList.contains('w-20')) {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');
                } else {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');
                }
            });
        });
    </script>