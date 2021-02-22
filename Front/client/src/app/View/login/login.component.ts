import { Component } from "@angular/core";
import { FormBuilder } from "@angular/forms";
import {UserService} from "../../Services/user.service";
import {Router} from "@angular/router";

@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.scss"]
})
export class LoginComponent  {
  title = "Connexion";
  loginForm = this.formBuilder.group({
    email: "",
    password: ""
  });
  constructor(
    private formBuilder: FormBuilder, private userService: UserService, private router: Router
  ){}

  onSubmit(): void {
    this.userService.login(this.loginForm.value).subscribe(() => {
      this.router.navigate(["/"]);
    });

  }
}
