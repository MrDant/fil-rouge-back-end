import { Component, OnInit } from "@angular/core";
import { IProduct } from "../../models/Product";

@Component({
  selector: "app-product",
  templateUrl: "./product.component.html",
  styleUrls: ["./product.component.scss"],
})
export class ProductComponent implements OnInit {
  product: IProduct = {
    id: 1,
    name: "Paroi de douche",
    description: "Paroi de dcouhe sdfheridsufbsdibxcisd",
    media: [],
  };

  constructor() {}

  ngOnInit(): void {}
}
