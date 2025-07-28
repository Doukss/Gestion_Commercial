    <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <h1 class="text-3xl font-bold text-gray-800">Liste des Commandes</h1>
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <span class="text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Vendeur: <?= $_SESSION['user']->getPrenom() ?? 'Indefined' ?> <?= $_SESSION['user']->getNom() ?? 'Indefined' ?></span>
                    <button onclick="add_order_modal.showModal()" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full px-4 py-2 text-sm font-medium hover:opacity-90 transition-opacity cursor-pointer">
                        <i class="fas fa-plus mr-2"></i>Nouveau
                    </button>
                </div>
            </div>

            <?=
            include_component('modal/commande.modal', [
                'errors' => $errors ?? [],
                'oldValues' => $_POST,
                'client' => $client,
                'panier' => $panier,
                'errors' => $_SESSION['errors'] ?? [],
                'old' => $_SESSION['old'] ?? [],
                "produits" => $produits
            ]);
            ?>

            <!-- Filters and Actions -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
                <?= include_required("commandes/form",[]) ?>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <?= include_required("commandes/table",[
                    "commandes" => $commandes
                ]) ?>
            </div>
        </div>
    </main>
