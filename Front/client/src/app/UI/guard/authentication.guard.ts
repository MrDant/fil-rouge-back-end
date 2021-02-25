import { Injectable } from "@angular/core";
import {
    CanActivate,
    ActivatedRouteSnapshot,
    RouterStateSnapshot,
    UrlTree,
    Router,
    CanActivateChild,
} from "@angular/router";
import { Observable } from "rxjs";
import { UserService } from "../../services/user.service";

@Injectable({
    providedIn: "root",
})
export class AuthenticationGuard implements CanActivate, CanActivateChild {
    constructor(private userService: UserService, private router: Router) {}

    check(state: RouterStateSnapshot): any {
        const loginPath = ["/login", "/register"];
        if (loginPath.includes(state.url)) {
            return this.userService.isConnected()
                ? this.router.createUrlTree(["/home"])
                : true;
        }
        return !this.userService.isConnected()
            ? this.router.createUrlTree(["/login"])
            : true;
    }

    canActivate(
        next: ActivatedRouteSnapshot,
        state: RouterStateSnapshot
    ):
        | Observable<boolean | UrlTree>
        | Promise<boolean | UrlTree>
        | boolean
        | UrlTree {
        return this.check(state);
    }

    canActivateChild(
        childRoute: ActivatedRouteSnapshot,
        state: RouterStateSnapshot
    ):
        | Observable<boolean | UrlTree>
        | Promise<boolean | UrlTree>
        | boolean
        | UrlTree {
        return this.check(state);
    }
}
