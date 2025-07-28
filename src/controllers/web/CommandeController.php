<?php

namespace App\Controller\Web;

use App\Core\Abstract\AbstractController;
use App\Core\Gard;
use App\Service\CommandeService;
use App\Service\PersonneService;

class CommandeController extends AbstractController
{
    private $commandeService;
    private $personneService;
    public function __construct()
    {
        parent::__construct();
        $this->commandeService = CommandeService::getInstance();
        $this->personneService = PersonneService::getInstance();
    }
   public function index(): void
{
    $filters = [
        'numero' => $_GET['search'] ?? null,
        'date' => $_GET['Date_search'] ?? null,
        'client_nom' => $_GET['client_search'] ?? null
    ];
  

    // Exemple d'utilisation du validator
    $rules = [
        'numero' => ['required' => "Le numéro est requis"],
        // Ajoutez d'autres règles si besoin
    ];
    $isValid = $this->validator->validate($filters, $rules);
    if (!$isValid) {
        // On stocke les erreurs en session
        $this->session->set('errors', $this->validator->getErrors());
    } else {
        // On stocke les filtres valides en session
        $this->session->set('last_filters', $filters);
    }

    // Appel unique du service
    $commandes = $this->commandeService->getAllCommandes($filters);
    $client = null;
    if (isset($_GET['tel_client'])) {
        $client = $this->personneService->getClientByTel($_GET['tel_client']);
        $openModal = true;
        // dd($client);
    }

    $this->render_view('commande/listeCommande', [
    'commandes' => $commandes,
    'client' => $client,
    'openModal' => $openModal ?? false,
    ]);

}

    public function store(): void {}
}
