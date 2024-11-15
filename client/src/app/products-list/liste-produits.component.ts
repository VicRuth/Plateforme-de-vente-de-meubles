import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-liste-produits',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './liste-produits.component.html',
  styles: [],
})
export class ListeProduitsComponent implements OnInit {
  produits: any[] = []; // Produits récupérés de l'API
  produitsGroupes: { [key: string]: any[] } = {}; // Produits regroupés par nom
  produitsAffiches: any[] = []; // Produits actuellement affichés par groupe
  produitsAffichesParCategorie: any[] = []; // Produits affichés par catégorie
  produitsGroupesCat: { [key: string]: any[] } = {}; // Produits regroupés par catégorie
  produitsAffichesCat: any[] = []; // Produits actuellement affichés
  categories: string[] = []; // Liste des catégories pour la navigation
  apiUrl: string = 'https://dummyjson.com/products';

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    // Récupérer les produits depuis l'API
    this.http.get<any>(this.apiUrl).subscribe((data) => {
      this.produits = data.products;
      this.trierEtGrouperProduits();
      this.trierEtGrouperProduitsParCategorie();
    });
  }

  trierEtGrouperProduits(): void {
    // Grouper les produits par nom
    this.produits.forEach((produit) => {
      const nomProduit = produit.title;
      if (!this.produitsGroupes[nomProduit]) {
        this.produitsGroupes[nomProduit] = [];
      }
      this.produitsGroupes[nomProduit].push(produit);
    });

    // Trier les produits par nom alphabétiquement
    this.produits = Object.keys(this.produitsGroupes)
      .sort()
      .map((nom) => ({ name: nom, items: this.produitsGroupes[nom] }));
  }

  afficherProduitsGroupe(produits: any[]): void {
    this.produitsAffiches = produits; // Afficher les produits du groupe sélectionné
    //console.log(this.produitsAffiches);
    
    this.produitsAffichesParCategorie = []; // Réinitialiser les produits filtrés par catégorie
  }

  afficherCategories(produit: any): string[] {
    // Retourner la liste des catégories associées au produit
    return produit.category ? [produit.category] : [];
  }
  
  
  trierEtGrouperProduitsParCategorie(): void {
    console.log(this.produits);
    
    // Grouper les produits par catégorie
    this.produits.forEach((produit) => {
      const productItems = produit.items; // Accéder au tableau d'items de ce produit
      let index = 0; // Ou une autre valeur dynamique si nécessaire
      let categoryItems = productItems[index].category; // Récupérer la catégorie du premier élément dans items
      
      // Vérifier si la catégorie existe déjà dans le groupe
      if (!this.produitsGroupesCat[categoryItems]) {
        this.produitsGroupesCat[categoryItems] = []; // Créer un groupe si non existant
      }
  
      // Ajouter ce produit au groupe correspondant à la catégorie
      this.produitsGroupesCat[categoryItems].push(produit);
    });
  }  

  afficherProduitsDeCategorie(categorie: string): void {
    // Afficher les produits de la catégorie sélectionnée
    this.produitsAffichesParCategorie= this.produitsGroupesCat[categorie];
    console.log(this.produitsAffichesParCategorie)
  
  }

  /*
  afficherProduitsDeCategorie(categorie: string): void {
     // Afficher les produits de la catégorie sélectionnée
    this.produitsAffichesParCategorie = this.produits.filter((produit) => 
      produit.category === categorie
    );
    console.log(this.produits);
  
  }*/
}
