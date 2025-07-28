<?php

namespace App\Core;

use App\Core\Abstract\Singleton;

class Filter extends Singleton
{
    // Tableau qui va contenir les filtres disponibles (nom du filtre => callback)
    private array $filters = [];
    
    // Tableau des valeurs (paramètres) à utiliser pour les requêtes préparées
    private array $params = [];
    
    // La requête SQL construite après application des filtres
    private string $query = '';

    public function __construct()
    {
        // Déclare un filtre 'equals' qui teste l'égalité d'un champ
        $this->make('equals', function (string $field, $value): string {
            $this->params[] = $value; // Ajoute la valeur à la liste des paramètres
            return " AND $field = ?"; // Ajoute une condition SQL avec un placeholder
        });

        // Déclare un filtre 'date' qui compare seulement la date (ignore l'heure)
        $this->make('date', function (string $field, $value): string {
            $this->params[] = $value;
            return " AND DATE($field) = ?";
        });

        // Déclare un filtre 'like' qui effectue une recherche partielle (wildcards %)
        $this->make('like', function (string $field, $value): string {
            $this->params[] = '%' . $value . '%'; // Encapsule la valeur avec des % pour LIKE
            return " AND $field LIKE ?";
        });
    }

    // Ajoute ou modifie un filtre dans le tableau des filtres
    public function make(string $filterName, callable $callback): void
    {
        $this->filters[$filterName] = $callback;
    }

    // Applique les filtres passés en paramètre à une requête de base
    public function apply(string $baseQuery, array $filtersToApply): array
    {
        $this->query = $baseQuery; // Initialise la requête avec la requête de base
        $this->params = [];        // Réinitialise les paramètres

        // Parcourt les filtres à appliquer
        foreach ($filtersToApply as $field => $filter) {
            if (is_array($filter)) {
                // Cas où le filtre est défini comme ['type' => ..., 'value' => ...]
                $filterName = $filter['type'];
                $value = $filter['value'];
            } else {
                // Cas (moins clair) où la valeur n'est pas un tableau
                $filterName = $filter;
                $value = $filtersToApply[$field];
                unset($filtersToApply[$field]); // Supprime cette entrée (optionnel)
            }

            // Vérifie que le filtre existe
            if (!isset($this->filters[$filterName])) {
                throw new \InvalidArgumentException("Le filtre '$filterName' n'existe pas.");
            }

            // Ajoute la condition SQL retournée par le callback du filtre
            $this->query .= call_user_func($this->filters[$filterName], $field, $value);
        }

        // Retourne la requête finale et les paramètres associés
        return ['query' => $this->query, 'params' => $this->params];
    }

    // Retourne la liste des paramètres accumulés
    public function getParams(): array
    {
        return $this->params;
    }

    // Retourne la requête SQL complète construite
    public function getQuery(): string
    {
        return $this->query;
    }
}
