import { Component } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { UserService } from "../../services/user.service";

@Component({
  selector: "app-register",
  templateUrl: "./register.component.html",
  styleUrls: ["./register.component.scss"],
})
export class RegisterComponent {
  form: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private userService: UserService
  ) {
    this.form = this.formBuilder.group({
      firstName: ["", Validators.required],
      lastName: ["", Validators.required],
      phone: [""],
      email: ["", Validators.email],
      CP: [""],
      address: "",
      city: "",
      confirmEmail: "",
      password: "",
      confirmPassword: "",
    });
  }

  onSubmit(): void {
    this.userService.register(this.form.value).subscribe();
  }
}
