import { Component, OnInit } from '@angular/core';
import { FormBuilder } from "@angular/forms";

@Component({
  selector: 'app-registerClient',
  templateUrl: './registerClient.component.html',
  styleUrls: ['./registerClient.component.css']
})
export class RegisterClientComponent implements OnInit {
  title = 'Inscription';
  registerForm = this.formBuilder.group({
    lastname: '',
    firstname: '',
    phone: '',
    address: '',
    CP: '',
    city: '',
    confirmMail: '',
    mail:'',
    password:'',
    confirmPassword: '',
    captcha: '',
  })
  constructor(
    private formBuilder: FormBuilder
  ){}
  ngOnInit(){}
  onSubmit(): void {
    console.warn('Your order has been submitted', this.registerForm.value);
    this.registerForm.reset();
  }

}
