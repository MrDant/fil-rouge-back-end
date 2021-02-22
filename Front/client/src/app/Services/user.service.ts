import { Injectable } from "@angular/core";
import {Observable, of} from "rxjs";
import {tap} from "rxjs/operators";

@Injectable({
  providedIn: "root"
})
export class UserService {

  constructor() { }

  login(form: {email: string; password: string}): Observable<string> {
    return of("dsfcsd").pipe(tap(token => {
      localStorage.setItem("token", token);
    }));
  }

  logout(): void {
    localStorage.clear();
  }

  isConnected(): boolean {
    return !!localStorage.getItem("token");
  }
}
