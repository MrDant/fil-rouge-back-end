import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginClient } from './LoginClient/loginClient';
import { RegisterClientComponent } from './registerClient/registerClient.component';
import { StockComponent } from "./AdminStock/AdminStock.component";
import { EditPasswordComponent } from "./editPassword/editPassword.component";
import { MyAccountComponent } from "./myAccount/myAccount.component"

const routes: Routes = [
  {path:'', component:LoginClient},
  {path:'register', component:RegisterClientComponent},
  {path:'admin/stock', component:StockComponent},
  {path:'editPassword', component:EditPasswordComponent},
  {path:'myAccount', component:MyAccountComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
