import { AbstractControl, ValidationErrors } from "@angular/forms";

export class CustomValidator {
  static email(control: AbstractControl): ValidationErrors | null {
    return null;
  }
}
