import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { RegisterClientComponent } from "./registerClient/registerClient.component";
import { EditPasswordComponent } from "./editPassword/editPassword.component";
import { MyAccountComponent } from "./myAccount/myAccount.component";
import { HomeComponent } from "./home/home.component";
import {LoginComponent} from "./view/login/login.component";
import {AuthenticationGuard} from "./UI/guard/authentication.guard";

const routes: Routes = [

  {path: "register", component: RegisterClientComponent},
  {path: "editPassword", component: EditPasswordComponent},
  {path: "myAccount", component: MyAccountComponent},
  {
    path: "",
    canActivate: [AuthenticationGuard],
    children: [
      {path: "", component: HomeComponent},
      {path: "login", component: LoginComponent}
    ]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
