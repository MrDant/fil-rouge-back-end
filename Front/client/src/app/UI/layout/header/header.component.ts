import { Component, OnInit } from "@angular/core";
import {UserService} from "../../../Services/user.service";

@Component({
  selector: "app-header",
  templateUrl: "./header.component.html",
  styleUrls: ["./header.component.scss"]
})
export class HeaderComponent {
  static adminArea: boolean;

  constructor(private userService: UserService
  ){
    HeaderComponent.adminArea = false;
  }
  get isConnected(): boolean {
    return this.userService.isConnected();
  }
  get isAdminArea(): boolean{
    return HeaderComponent.adminArea;
  }

  logout(): void {
    this.userService.logout();
  }
}
