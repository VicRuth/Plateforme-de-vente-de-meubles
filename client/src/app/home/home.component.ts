import { Component } from '@angular/core';
import { ProductListComponent } from '../products/product-list.component';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [ProductListComponent],
  templateUrl: './home.component.html',
  styles: ``,
})
export class HomeComponent {}
