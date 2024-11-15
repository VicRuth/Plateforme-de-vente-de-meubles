// // Importations nécessaires pour le composant Angular
// import { Injectable } from '@angular/core';
// import { DetailApiResponse, Details } from '../models/detail.model'; // Modèles pour la structure des données des produits
// import { catchError, map, Observable, of } from 'rxjs'; // Opérateurs RxJS pour la gestion des flux de données
// import { HttpClient } from '@angular/common/http'; // Service HTTP d'Angular pour effectuer des requêtes API

// @Injectable({
//   providedIn: 'root',
// })
// export class DetailService {
//   // URL de l'API pour récupérer les produits
//   private apiUrl = 'https://localhost:8000/api/furniture';

//   // Injection du service HttpClient pour effectuer les requêtes API
//   constructor(private http: HttpClient) {}

//   /**
//    * Méthode pour récupérer les détails d'un produit en fonction de son ID.
//    * Retourne un Observable de type `Details` si le produit est trouvé, ou `null` s'il est absent.
//    * @param id - L'identifiant du produit à récupérer
//    * @returns Un Observable émettant une instance de `Details` ou `null` si le produit n'existe pas
//    */

//   getProductDetails(id: number): Observable<Details | null> {
//     const url = `${this.apiUrl}/${id}`; // URL spécifique pour l'ID du produit

//     return this.http.get<DetailApiResponse>(url).pipe(
//       map((product) => {
//         return new Details(
//           product.id,
//           product.title,
//           product.price,
//           product.description,
//           product.state,
//           product.color,
//           product.material,
//           product.stock
//         );
//       }),
//       catchError(this.handleError<Details | null>('getProductDetails', null))
//     );
//   }

//   // getProductDetails(id: number): Observable<Details | null> {
//   //   // Envoie une requête GET à l'API pour récupérer les produits
//   //   return this.http.get<{ products: DetailApiResponse[] }>(this.apiUrl).pipe(
//   //     // Transformation de la réponse de l'API pour ne garder que le produit souhaité
//   //     map((response) => {
//   //       // Transformation des produits pour créer des instances de Details
//   //       const product = response.products.find((p) => p.id === id); // Recherche du produit correspondant à l'ID donné dans la réponse

//   //       if (product) {
//   //         // Si trouvé, retourne une nouvelle instance de `Details` avec les données du produit
//   //         return new Details(
//   //           product.id,
//   //           product.title, // Mapping du nom du produit
//   //           product.price,
//   //           product.description,
//   //           // product.category,
//   //           product.images,
//   //           product.state,
//   //           product.color,
//   //           product.material,
//   //           product.stock
//   //         );
//   //       }
//   //       return null; // Retourne `null` si aucun produit ne correspond à l'ID
//   //     }),

//   //     // Gestion des erreurs de la requête HTTP
//   //     catchError((error) => {
//   //       console.error('Erreur lors de la récupération des produits:', error); // Log de l'erreur dans la console pour faciliter le debug

//   //       // Retourne `null` en cas d'erreur, encapsulé dans un Observable
//   //       return of(null);
//   //     })
//   //   );
//   // }
// }

import { Injectable } from '@angular/core';
import { DetailApiResponse, Details } from '../models/detail.model';
import { catchError, map, Observable, of } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class DetailService {
  private apiUrl = 'http://localhost:8000/api/furniture';

  constructor(private http: HttpClient) {}

  getProductDetails(id: number): Observable<Details | null> {
    const url = `${this.apiUrl}/${id}`;

    return this.http.get<DetailApiResponse>(url).pipe(
      map(
        (product) =>
          new Details(
            product.id,
            product.Title,
            product.Price,
            product.Description,
            product.images,
            product.State,
            product.Color,
            product.Material,
            product.Stock
          )
      ),
      catchError(this.handleError<Details | null>('getProductDetails', null))
    );
  }

  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.error(`${operation} failed: ${error.message}`);
      return of(result as T);
    };
  }
}
