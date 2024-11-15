// Déclaration d'une interface pour définir la structure des données provenant de l'API
export interface DetailApiResponse {
  id: number;
  Title: string;
  Price: number;
  Description: string;
  // category: string;
  images: string[]; // Tableau d'images, si plusieurs images disponibles
  State: string;
  Color: string;
  Material: string;
  Stock: number;
}

// Déclaration d'une classe pour modéliser et manipuler les données d'un produit dans l'application
export class Details {
  constructor(
    public id: number,
    public title: string,
    public price: number,
    public description: string,
    // public category: string,
    public images: string[], // Tableau d'images du produit
    public state: string,
    public color: string,
    public material: string,
    public stock: number
  ) {}
}
