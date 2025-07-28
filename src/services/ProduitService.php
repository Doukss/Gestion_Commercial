<?php

namespace App\Service;

use App\Core\Abstract\Singleton;
use App\Enum\StatutProduit;
use App\Repository\ProduitRepo;

class ProduitService extends Singleton
{
    private ProduitRepo $produitRepo;

    protected function __construct()
    {
        $this->produitRepo = ProduitRepo::getInstance();
    }

    public function getProduitsDisponibles(): array
    {
        return $this->produitRepo->findBy();
    }

    public function getProduitById(int $id){
        return $this->produitRepo->find($id);
    }
}