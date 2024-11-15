import { CurrencyPipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-product-card',
  standalone: true,
  imports: [CurrencyPipe],
  templateUrl: './product-card.component.html',
  styles: ``,
})
export class ProductCardComponent implements OnInit {
  ngOnInit(): void {
    // this.name = 'testName';
    // this.image = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff';
    // this.category = 'testCategory';
    // this.price = 29.99;
  }
}
