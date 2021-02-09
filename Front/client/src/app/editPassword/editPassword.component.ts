import { Component, OnInit } from '@angular/core';
import { FormBuilder } from "@angular/forms";

@Component({
  selector: 'app-editPassword',
  templateUrl: './editPassword.component.html',
  styleUrls: ['./editPassword.component.css']
})
export class EditPasswordComponent implements OnInit {

  title = 'Modifier mot de passe';
  editPasswordForm = this.formBuilder.group({
    currentPassword:'',
    newPassword:'',
    confirmNewPassword:'',
  })
  constructor(
    private formBuilder: FormBuilder
  ){}
  ngOnInit(){}
  onSubmit(): void {
    console.warn('Your order has been submitted', this.editPasswordForm.value);
    this.editPasswordForm.reset();
  }

}
