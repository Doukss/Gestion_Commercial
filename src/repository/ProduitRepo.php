<?php

namespace App\Repository;

use App\Core\Abstract\AbstractRepository;
use App\Entity\Produit;

class ProduitRepo extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "produit";
    }

    public function find(int $id): ?Produit
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? AND deleted = 0";
        $result = parent::query($sql, [$id], [Produit::class, "toObject"], true);
        return $result ?: null;
    }

    public function findBy(): array
    {
        $sql = "SELECT * FROM {$this->table}";
    return parent::query($sql, [] , [Produit::class,"toObject"]);
    }
}
