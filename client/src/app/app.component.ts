import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HeaderComponent } from './header/header.component';
import { SidebarFamiliesComponent } from './family/family.component'; // Importer ton composant
import { FooterComponent } from './footer/footer.component';
import { SidebarComponent } from './sidebar/sidebar.component';
import { ProductsFamilyComponent } from './products-family/products-family.component';
import { ListeProduitsComponent } from './products-list/liste-produits.component';
@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
    RouterOutlet,
    HeaderComponent,
    SidebarFamiliesComponent,
    FooterComponent,
    SidebarComponent,
    ListeProduitsComponent,
    ProductsFamilyComponent,
  ],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  //TODO si possible, gestion de l'affichage ou non de la sidebar
  title = 'client';
  sidebarOpen: boolean = false;

  onSidebarToggle(open: boolean) {
    this.sidebarOpen = open;
  }
}
