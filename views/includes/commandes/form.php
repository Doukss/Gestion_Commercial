<form action="<?= $_ENV['WEB_ROOT'] ?>/accueil" method="GET" class="space-y-4 md:space-y-0">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Client Filter -->
        <div class="space-y-1">
            <label class="block text-sm font-medium text-gray-700">Nom du client</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="client_search" placeholder="Rechercher..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Date Filter -->
        <div class="space-y-1">
            <label class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" name="Date_search"
                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Order Number Filter -->
        <div class="space-y-1">
            <label class="block text-sm font-medium text-gray-700">N° Commande</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-hashtag text-gray-400"></i>
                </div>
                <input type="text" name="search" placeholder="Numéro..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-end gap-2">
            <button type="submit" class="h-10 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2 w-full">
                <i class="fas fa-filter"></i>
                <span>Filtrer</span>
            </button>
            <a href="<?= $_ENV['WEB_ROOT'] ?>/accueil" class="h-10 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center justify-center">
                <i class="ri-loop-right-line"></i>
            </a>

        </div>
    </div>
</form>