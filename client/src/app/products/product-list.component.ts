import { Component, OnInit } from '@angular/core';
import { ProductCardComponent } from '../product-card/product-card.component';
import { Product } from '../models/product.model';
import { ProductService } from '../services/product.service';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-product-list',
  standalone: true,
  imports: [RouterLink, CommonModule, ProductCardComponent],
  templateUrl: './product-list.component.html',
  styles: ``,
})
export class ProductListComponent implements OnInit {
  // Définition de la classe `ProductListComponent` et implémentation de `OnInit`
  products: Product[] = []; // Déclaration d'un tableau `products` de type `Product` pour stocker les produits récupérés

  constructor(private productService: ProductService) {} // Injection du service `ProductService` pour récupérer les produits

  // Méthode d'initialisation appelée au chargement du composant
  ngOnInit(): void {
    // Appel du service pour récupérer les produits
    // `subscribe` écoute les données fournies par l'observable (async) et met à jour `products` quand elles sont reçues
    this.productService.getProducts().subscribe((products) => {
      this.products = products; // Mise à jour du tableau `products` avec les produits reçus
    });
  }
}
