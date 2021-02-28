import { Component, OnInit } from '@angular/core';
import { FormBuilder } from "@angular/forms";

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.scss']
})
export class ContactComponent implements OnInit {
  title = 'Contact'
  registerForm = this.formBuilder.group({
    lastname: '',
    firstname: '',
    mail:'',
    object:'',
    message: '',
  })
  
  constructor(
    private formBuilder: FormBuilder
  ){}

  ngOnInit(): void {
  }
  onSubmit(): void {
    console.warn('Your order has been submitted', this.registerForm.value);
    this.registerForm.reset();
  }
}
