import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router'; 
import { UserService } from '../../../services/user.service';

@Component({
  selector: 'app-login-page',
  standalone: true,
  imports: [CommonModule,ReactiveFormsModule],
  templateUrl: './login-page.component.html',
  styleUrl: './login-page.component.css',
})
export class LoginPageComponent {
  loginForm: FormGroup;
  errorMessage: string | null = null;
  isLoading = false;

  constructor(
    private fb: FormBuilder, 
    private router: Router,
    private userService:UserService) {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required]
    });
  }

  onLogin() {
    if (this.loginForm.valid) {
      this.errorMessage = '';
      this.isLoading = true;
      const email = this.loginForm.get('email')?.value ?? '';
      const password = this.loginForm.get('password')?.value ?? '';

      this.userService.login(email, password)
        .subscribe(
          response => {
            this.isLoading = false;
            this.router.navigate(['/dashboard']);
          },
          error => {
            this.isLoading = false;
            this.errorMessage = error.error?.data || 'Login Failed. Please check your credentials.';
          }
        );
    } else {
      this.errorMessage = 'Something is wrong. Please contact administrator.';
    }
  }
  
}
