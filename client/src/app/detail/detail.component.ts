// Importations nécessaires pour le composant Angular
import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { Details } from '../models/detail.model'; // Modèle de données des détails du produit
import { ActivatedRoute } from '@angular/router'; // Permet de récupérer l'ID depuis l'URL
import { DetailService } from '../services/detail.service'; // Service pour récupérer les détails du produit

@Component({
  selector: 'app-detail',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './detail.component.html',
  styles: ``,
})
export class DetailComponent implements OnInit {
  details!: Details; // Objet contenant les détails du produit
  mainImage: string = ''; // URL de l'image principale affichée

  // Constructeur pour injecter les services nécessaires
  constructor(
    private detailService: DetailService,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    // Récupération de l'ID du produit depuis l'URL
    const id = this.route.snapshot.paramMap.get('id'); // On obtient l'ID du produit via la route active
    if (id) {
      // Appel du service pour récupérer les détails du produit en fonction de l'ID
      this.detailService.getProductDetails(Number(id)).subscribe((details) => {
        if (details) {
          this.details = details;
          this.mainImage = details.images[0] || 'default-image-url.jpg';
          // Initialisation de l'image principale avec la première image du tableau d'images
          // Utilise une image par défaut si aucune image n'est disponible
        }
      });
    }
  }

  // Méthode pour changer l'image principale
  //TODO si possible : permettre d'afficher à nouveau l'image principale une fois une miniature aggradie, impossible de sélectionner l'image principale
  changeImage(imageSrc: string): void {
    this.mainImage = imageSrc;
  }
}
