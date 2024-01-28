import { Component } from '@angular/core';

@Component({
  selector: 'app-admin-navbar',
  standalone: true,
  imports: [],
  templateUrl: './admin-navbar.component.html',
  styleUrl: './admin-navbar.component.css'
})
export class AdminNavbarComponent {
  isActive(route: string): boolean {
    return true;
  }
}
