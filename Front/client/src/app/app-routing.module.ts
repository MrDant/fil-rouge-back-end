import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { RegisterClientComponent } from "./registerClient/registerClient.component";
import { EditPasswordComponent } from "./editPassword/editPassword.component";
import { MyAccountComponent } from "./myAccount/myAccount.component";
import { HomeComponent } from "./home/home.component";
import {LoginComponent} from "./View/login/login.component";

const routes: Routes = [
  {path: "login", component: LoginComponent},
  {path: "register", component: RegisterClientComponent},
  {path: "editPassword", component: EditPasswordComponent},
  {path: "myAccount", component: MyAccountComponent},
  {path: "", component: HomeComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
