import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./../global/toolbar.css', './header.component.css']
})
export class HeaderComponent implements OnInit{
  static adminArea: boolean
  constructor(
  ){
    HeaderComponent.adminArea = false;
  }
  ngOnInit(){}
  get isAdminArea(){
    return HeaderComponent.adminArea;
  }
}
