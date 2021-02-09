import { Component, OnInit } from '@angular/core';
import { FormBuilder } from "@angular/forms";

@Component({
  selector: 'login',
  templateUrl: './loginClient.html',
  styleUrls: ['./loginClient.css']
})
export class LoginClient implements OnInit {
  title = 'Connexion';
  loginForm = this.formBuilder.group({
    mail:'',
    password:''
  })
  constructor(
    private formBuilder: FormBuilder
  ){}
  ngOnInit(){}
  onSubmit(): void {
    console.warn('Your order has been submitted', this.loginForm.value);
    this.loginForm.reset();
  }
}
