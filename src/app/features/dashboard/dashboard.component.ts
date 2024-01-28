import { Component } from '@angular/core';
import { AdminNavbarComponent } from '../../components/admin-navbar/admin-navbar.component';

@Component({
  selector: 'app-dashboard',
  standalone: true,
  imports: [AdminNavbarComponent],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.css'
})
export class DashboardComponent {

}
