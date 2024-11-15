import { inject, Injectable } from '@angular/core';
import { Product, ProductApiResponse } from '../models/product.model';
import { catchError, map, Observable, of } from 'rxjs';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  // API de test
  private apiUrl = 'http://127.0.0.1:8000/api/furniture'; // ROUTE A CONFIRMER

  // Injection de `HttpClient` sans constructeur
  // `inject` permet de se passer du constructeur pour obtenir une instance de `HttpClient`
  private http: HttpClient = inject<HttpClient>(HttpClient);

  // Injection de HttpClient AVEC constructeur (optionnelle)
  // constructor(private http: HttpClient) {}

  // Cette méthode retourne un tableau de produits typé avec la classe Product
  getProducts(): Observable<Product[]> {
    return this.http.get<ProductApiResponse[]>(this.apiUrl).pipe(
      map((response) =>
        response.map((product: ProductApiResponse) => {
          const firstImageUrl = product.images?.[0]?.url || ''; // URL de la première image, ou chaîne vide si aucune
          return new Product(
            product.id,
            product.Title,
            product.Description,
            product.Price,
            product.State,
            +product.Stock,
            product.Color,
            product.Material,
            product.Created_At,
            product.Modified_At,
            firstImageUrl // Associer l'URL de la première image
          );
        })
      ),
      catchError((error) => {
        console.error('Erreur lors de la récupération des produits:', error);
        return of([]); // Retourne un tableau vide en cas d'erreur
      })
    );
  }
}
