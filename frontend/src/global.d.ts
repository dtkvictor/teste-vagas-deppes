import type { Axios } from "axios";
import type { IziToast } from "izitoast";

declare global {
    var axios: Axios;
    var iziToast: IziToast;
}