import { CommonModule } from '@angular/common';
import { Component, EventEmitter, Output } from '@angular/core';
import { SidebarComponent } from '../sidebar/sidebar.component';

@Component({
  selector: 'app-header',
  standalone: true,
  imports: [CommonModule, SidebarComponent],
  templateUrl: './header.component.html',
  styles: ``,
})
export class HeaderComponent {
  isEmpty: boolean = true; // Initialise à true pour afficher l'icône au début
  
  @Output() sidebarToggle = new EventEmitter<boolean>();
  sidebarOpen: boolean = false; // État pour gérer l'ouverture/fermeture de la sidebar

  // Méthode appelée lors de la frappe dans l'input
  onInput(event: Event) {
    const input = event.target as HTMLInputElement;
    this.isEmpty = input.value === ''; // Met à jour isEmpty en fonction de la présence de texte
  }
  
  // Méthode pour basculer l'état de la sidebar
  toggleSidebar() {
    this.sidebarOpen = !this.sidebarOpen;// Change l'état de la sidebar
    this.sidebarToggle.emit(this.sidebarOpen); // Émet l'état actuel de la sidebar
  }
}
