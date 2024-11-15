// Importations nécessaires pour le composant Angular
import { Injectable } from '@angular/core';
import { FamilyApiResponse, Family } from '../models/family.model'; // Modèles pour la structure des données des produits
import { catchError, map, Observable, of } from 'rxjs'; // Opérateurs RxJS pour la gestion des flux de données
import { HttpClient } from '@angular/common/http'; // Service HTTP d'Angular pour effectuer des requêtes API

@Injectable({
  providedIn: 'root',
})
export class FamilyService {
  private apiUrl = 'http://127.0.0.1:8000/api/family';

  constructor(private http: HttpClient) {}

  getFamilies(): Observable<Family[]> {
    return this.http.get<{ families: Family[] }>(this.apiUrl).pipe(
      map((response) => {
        if (response && Array.isArray(response)) {
          return response.map((family) => new Family(family.id, family.name));
        } else {
          console.error('Structure de données incorrecte', response);
          return [];  // Retourne un tableau vide si la structure est incorrecte
        }
      }),
      catchError((error) => {
        console.error('Erreur lors de la récupération des catégories:', error);
        return of([]); // Retourne un tableau vide en cas d'erreur
      })
    );
  }
}
