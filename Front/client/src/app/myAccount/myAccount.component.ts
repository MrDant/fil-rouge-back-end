import { Component, OnInit } from '@angular/core';
import { FormBuilder } from "@angular/forms";


@Component({
  selector: 'app-my-account',
  templateUrl: './myAccount.component.html',
  styleUrls: ['./myAccount.component.css']
})
export class MyAccountComponent implements OnInit {
  title = 'Mon compte';
  editAccountForm = this.formBuilder.group({
    lastname: '',
    firstname: '',
    mail:'',
    phone: '',
    address: '',
    CP: '',
    city: ''
  })
  constructor(
    private formBuilder: FormBuilder
  ){}
  ngOnInit(){}
  onSubmit(): void {
    console.warn('Your order has been submitted', this.editAccountForm.value);
    this.editAccountForm.reset();
  }
}
