import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  constructor(private httpClient: HttpClient) { }

  private baseUrl = 'http://127.0.0.1:8000/api/users/';
   
  login(email: string, password: string){
    const loginUrl = `${this.baseUrl}login`;
    const payload = {
      email: email,
      password: password
    };
    return this.httpClient.post(loginUrl, payload);
  }
  
}
