<?php

namespace App\Entity;

use App\Enum\StatutProduit;

 class Produit{
    private int $id; 
    private string $libelle;
    private int $qtstk;
    private float $prix;
    private StatutProduit $statutProduit;
    private $commande= [];

    public function __construct($id=null,$libelle=null,$qtstk=null,$prix=null,$statutProduit=StatutProduit::DISPONIBLE)
    {
        $this->id=$id;
        $this->libelle=$libelle;
        $this->qtstk=$qtstk;
        $this->prix=$prix;
        $this->statutProduit=$statutProduit;

    }

      public function getId()
    {
        return $this->id;
    }

        public function setId($id)
    {
        $this->id = $id;
    }

       public function getLibelle()
    {
        return $this->libelle;
    }

        public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

       public function getQtstk()
    {
        return $this->qtstk;
    }

        public function setQtstk($qtstk)
    {
        $this->qtstk = $qtstk;
    }

        public function getPrix()
    {
        return $this->prix;
    }

        public function setPrix($prix)
    {
        $this->prix = $prix;
    }

        public function getCommande()
    {
        return $this->commande;
    }

         public function getStatutProduit()
    {
        return $this->statutProduit;
    }

        public function setStatutProduit($statutProduit)
    {
        $this->statutProduit = $statutProduit;
    }

    public static function toObject(array $data): self
{
    $produit = new self(
        $data['id'] ?? null,
        $data['libelle'] ?? null,
        $data['qtstk'] ?? 0,
        $data['prix'] ?? 0.0,
        StatutProduit::from($data['statut'] ?? StatutProduit::DISPONIBLE->value)
    );

    return $produit;
}
}
