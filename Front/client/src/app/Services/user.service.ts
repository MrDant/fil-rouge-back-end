import { Injectable } from "@angular/core";
import { BehaviorSubject, Observable } from "rxjs";
import { mapTo, tap } from "rxjs/operators";
import { HttpClient } from "@angular/common/http";
import { Router } from "@angular/router";

@Injectable({
  providedIn: "root",
})
export class UserService {
  constructor(private http: HttpClient, private router: Router) {}

  private connected: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(
    !!localStorage.getItem("token")
  );

  login(form: { email: string; password: string }): Observable<boolean> {
    return this.http.post<{ token: string }>("/api/auth/login", form).pipe(
      tap((e) => {
        localStorage.setItem("token", e.token);
        this.connected.next(true);
      }),
      mapTo(true)
    );
  }

  logout(): void {
    localStorage.clear();
    this.connected.next(false);
    this.router.navigate(["/login"]);
  }

  get connected$(): Observable<boolean> {
    return this.connected;
  }

  isConnected(): boolean {
    return this.connected.getValue();
  }

  register(user): Observable<any> {
    return this.http.post("/api/auth/register", user);
  }
}
