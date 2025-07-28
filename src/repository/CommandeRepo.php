<?php

namespace App\repository;

use App\Core\Abstract\AbstractRepository;
use App\Core\Filter;
use App\Entity\Commande;
use PDOException;

class CommandeRepo extends AbstractRepository
{
    private Filter $filter;

    public function __construct()
    {
        parent::__construct();
        $this->table = "commande";
        $this->filter = Filter::getInstance();
    }

    public function getCommandes($filters = [])
    {
        $sql = "SELECT c.*, 
                   p.nom AS nom, 
                   p.prenom AS prenom, 
                   p.telephone AS telephone,
                   p.email AS email
            FROM " . $this->table . " c
            JOIN personne p ON c.client_id = p.id
            WHERE c.deleted = 1";
    
    $params = [];

    if (!empty($filters['numero'])) {
        $sql .= " AND c.numero = ?";
        $params[] = (string)$filters['numero']; 
    }

        if (!empty($filters['date'])) {
            $filterDefinitions['c.date'] = [
                'type' => 'date',
                'value' => $filters['date']
            ];
        }

        if (!empty($filters['client_nom'])) {
            $filterDefinitions['p.nom'] = [
                'type' => 'like',
                'value' => $filters['client_nom']
            ];
        }

        // Application des filtres
        $result = $this->filter->apply($sql, $filterDefinitions);
        $sql = $result['query'];
        $params = $result['params'];

        // Debug final
        error_log("Requête finale: " . $sql);
        error_log("Paramètres finaux: " . print_r($params, true));

        return parent::query($sql, $params, [Commande::class, "toObject"]);
    }

    public function getCommandeById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
        return parent::query($sql, [$id], null, true);
    }
}