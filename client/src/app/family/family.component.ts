import { Component, OnInit } from '@angular/core';
import { FamilyService } from '../services/family.service';
import { Family } from '../models/family.model';
import { CommonModule } from '@angular/common';

interface Family_list {
  id: number;
  name: string;
}

@Component({
  selector: 'app-families',
  templateUrl: './family.component.html',
  styles: ``,
  standalone: true,
  imports: [CommonModule],
})
export class SidebarFamiliesComponent implements OnInit {
  families: Family_list[] = []; // Liste des familles avec le type Family_list

  constructor(private familyService: FamilyService) {}

  ngOnInit(): void {
    this.familyService.getFamilies().subscribe(
      (families: Family_list[]) => { // Typage explicite ici
        this.families = families; // Mise à jour du tableau families
      },
      (error) => {
        console.error('Erreur de récupération des familles:', error);
      }
    );
  }
}
