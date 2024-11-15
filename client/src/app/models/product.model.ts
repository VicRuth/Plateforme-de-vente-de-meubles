// Typage de la reponse de l'API de test
// Voir si ajouter category
export interface ProductApiResponse {
  id: number;
  Title: string;
  Description: string;
  Price: number;
  State: string;
  Stock: string;
  Color: string;
  Material: string;
  Created_At: string;
  Modified_At: string;
  images: Image[]; // à convertir en objet date
}
export interface Image {
  id: number;
  url: string;
  alt: string;
}

// Classe `Product` utilisée pour les produits dans l'application
export class Product {
  constructor(
    public id: number,
    public title: string,
    public description: string,
    public price: number,
    public state: string,
    public stock: number,
    public color: string,
    public material: string,
    public created_at: string,
    public modified_at: string,
    public imageUrl?: string
  ) {}
}
