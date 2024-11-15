import { Component } from '@angular/core';
import { CommonModule } from '@angular/common'; // Ajoutez cette ligne
import { SidebarFamiliesComponent } from '../family/family.component';
import { ListeProduitsComponent } from '../products-list/liste-produits.component';

@Component({
  selector: 'app-sidebar',
  standalone: true,
  imports: [CommonModule, SidebarFamiliesComponent, ListeProduitsComponent], // Incluez CommonModule ici
  templateUrl: './sidebar.component.html',
  styles: ``,
})
export class SidebarComponent {
  // Variables pour contrôler l'affichage
  isCategoriesVisible = true;
  isListeProduitsVisible = false;

  // Méthode pour afficher les catégories
  showCategories() {
    this.isCategoriesVisible = true;
    this.isListeProduitsVisible = false;
  }

  // Méthode pour afficher la liste des produits
  showListeProduits() {
    this.isCategoriesVisible = false;
    this.isListeProduitsVisible = true;
  }
}
