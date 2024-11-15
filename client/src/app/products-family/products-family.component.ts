import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';

@Component({
  selector: 'app-products-family',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './products-family.component.html',
  styles: ``,
})
export class ProductsFamilyComponent implements OnInit {
  produits: any[] = []; // Stocke tous les produits récupérés de l'API
  produitsGroupes: { [key: string]: any[] } = {}; // Produits regroupés par catégorie
  produitsAffiches: any[] = []; // Produits actuellement affichés
  categories: string[] = []; // Liste des catégories pour la navigation
  apiUrl: string = 'https://dummyjson.com/products';

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    // Récupérer les produits directement dans le composant
    this.http.get<any>(this.apiUrl).subscribe((data) => {
      this.produits = data.products; // Utilisez data.products pour accéder au tableau des produits
      this.trierEtGrouperProduitsParCategorie();
    });
  }

  trierEtGrouperProduitsParCategorie(): void {
    // Grouper les produits par catégorie
    this.produits.forEach((produit) => {
      const categorieProduit = produit.category;
      if (!this.produitsGroupes[categorieProduit]) {
        this.produitsGroupes[categorieProduit] = [];
      }
      this.produitsGroupes[categorieProduit].push(produit);
    });

    // Créer une liste de catégories uniques pour l'affichage
    this.categories = Object.keys(this.produitsGroupes);
  }

  afficherProduitsDeCategorie(categorie: string): void {
    // Afficher les produits de la catégorie sélectionnée
    this.produitsAffiches = this.produitsGroupes[categorie];
  }

  // Fonction du composant liste-produits
  /*afficherProduitsDeCategorie(categorie: string): void {
     // Afficher les produits de la catégorie sélectionnée
    this.produitsAffichesParCategorie = this.produitsAffiches.filter((produit) =>
      produit.category === categorie
    );
    //console.log(this.produitsAffichesParCategorie);

  }*/
}
