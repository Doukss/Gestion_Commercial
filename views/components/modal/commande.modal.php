

<dialog id="add_order_modal" class="modal backdrop-blur-sm <?= ($client || !empty($errors)) ? 'modal-open' : '' ?>">
    <div class="modal-box max-w-3xl p-0 overflow-visible">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-6 rounded-t-lg">
            <h3 class="text-xl font-bold text-white">Nouvelle Commande</h3>
        </div>

        <form method="dialog" class="absolute right-2 top-2">
            <button class="btn btn-sm btn-circle bg-white text-gray-600 hover:bg-gray-100 border-none">
                ✕
            </button>
        </form>

        <!-- Corps -->
        <div class="p-6 space-y-6">
            <!-- Sélection client -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <form method="get" action="<?= $_ENV["WEB_ROOT"] ?>/accueil" class="flex space-x-2">
                    <input type="hidden" name="open_modal" value="1">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                        <input type="search" name="tel_client" placeholder="Téléphone client"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="self-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                            Rechercher
                        </button>
                    </div>
                </form>
                
                <div class="flex items-center">
                    <?php if ($client): ?>
                        <form method="post" action="/commandes/set-client">
                            <input type="hidden" name="client_id" value="<?= $client->getId() ?>">
                            <button type="submit" class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                Client: <?= $client->getNomComplet() ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Liste produits -->
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <h4 class="text-lg font-semibold text-gray-800">Produits</h4>
                    <form method="post" action="/commandes/ajouter-produit" class="flex items-center gap-2">
                        <select name="produit_id" class="px-2 py-1 border rounded">
                            <?php foreach ($produits as $produit): ?>
                                <option value="<?= $produit->getId() ?>">
                                    <?= $produit->getLibelle() ?> (€<?= number_format($produit->getPrix(), 2) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="number" name="quantite" value="1" min="1" class="w-16 px-2 py-1 border rounded">
                        <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-plus mr-1"></i> Ajouter
                        </button>
                    </form>
                </div>

                <!-- Tableau produits -->
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left">Produit</th>
                                <th class="px-4 py-2 text-left">Prix</th>
                                <th class="px-4 py-2 text-left">Qté</th>
                                <th class="px-4 py-2 text-left">Total</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($panier['items'] as $id => $item): ?>
                                <tr>
                                    <td class="px-4 py-2"><?= $item['libelle'] ?></td>
                                    <td class="px-4 py-2">€<?= number_format($item['prix'], 2) ?></td>
                                    <td class="px-4 py-2"><?= $item['quantite'] ?></td>
                                    <td class="px-4 py-2">€<?= number_format($item['prix'] * $item['quantite'], 2) ?></td>
                                    <td class="px-4 py-2">
                                        <form method="post" action="/commandes/retirer-produit">
                                            <input type="hidden" name="produit_id" value="<?= $id ?>">
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-right font-semibold">Total:</td>
                                <td class="px-4 py-2 font-bold text-blue-600">€<?= number_format($panier['total'], 2) ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pied de modal -->
        <div class="flex justify-end p-6 bg-gray-50 rounded-b-lg space-x-3">
            <form method="dialog">
                <button type="submit" class="px-4 py-2 text-gray-700 border rounded-lg">
                    Annuler
                </button>
            </form>
            
            <form method="post" action="/commandes/enregistrer">
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>
</dialog>