<?php
namespace App\Core;

class Panier
{
    private Session $session;
    private string $sessionKey = 'panier';

    public function __construct()
    {
        $this->session = Session::getInstance();
        $this->initializePanier();
    }

    private function initializePanier(): void
    {
        if (!$this->session->get($this->sessionKey)) {
            $this->session->set($this->sessionKey, [
                'client_id' => null,
                'items' => [],
                'total' => 0.0
            ]);
        }
    }

    public function setClient(int $clientId): void
    {
        $panier = $this->session->get($this->sessionKey);
        $panier['client_id'] = $clientId;
        $this->session->set($this->sessionKey, $panier);
    }

    public function ajouterProduit(int $produitId, string $libelle, float $prix, int $quantite = 1): void
    {
        $panier = $this->session->get($this->sessionKey);
        
        if (isset($panier['items'][$produitId])) {
            $panier['items'][$produitId]['quantite'] += $quantite;
        } else {
            $panier['items'][$produitId] = [
                'libelle' => $libelle,
                'prix' => $prix,
                'quantite' => $quantite
            ];
        }

        $panier['total'] = $this->calculerTotal($panier['items']);
        $this->session->set($this->sessionKey, $panier);
    }

    public function retirerProduit(int $produitId): void
    {
        $panier = $this->session->get($this->sessionKey);
        unset($panier['items'][$produitId]);
        $panier['total'] = $this->calculerTotal($panier['items']);
        $this->session->set($this->sessionKey, $panier);
    }

    public function viderPanier(): void
    {
        $this->session->set($this->sessionKey, [
            'client_id' => null,
            'items' => [],
            'total' => 0.0
        ]);
    }

    private function calculerTotal(array $items): float
    {
        return array_reduce($items, fn($total, $item) => 
            $total + ($item['prix'] * $item['quantite']), 0.0
        );
    }

    public function getPanier(): array
    {
        return $this->session->get($this->sessionKey) ?? [
            'client_id' => null,
            'items' => [],
            'total' => 0.0
        ];
    }

    public function getClientId(): ?int
    {
        return $this->getPanier()['client_id'];
    }

    public function getTotal(): float
    {
        return $this->getPanier()['total'];
    }

    public function getItems(): array
    {
        return $this->getPanier()['items'];
    }
}