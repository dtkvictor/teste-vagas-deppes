import notifyByResponseErrorMiddleware from "@/middlewares/response/notifyByResponseErrorMiddleware";
import redirectByResponseErrorMiddleware from "@/middlewares/response/redirectByResponseErrorMiddleware";
import { useAuthStore } from "@/stores/authStore";
import { useProgressBarStore } from "@/stores/progressBarStore";

import axios from "axios";

const { VITE_API_URL } = import.meta.env;

const instance = axios.create({    
    baseURL: VITE_API_URL,
    timeout: 10000,
    headers: {
        'Content-Type': 'application/json',        
    }
});

instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
instance.defaults.withCredentials = true;
instance.defaults.withXSRFToken = true;
instance.defaults.xsrfHeaderName = 'X-XSRF-TOKEN';
instance.defaults.xsrfCookieName = 'XSRF-TOKEN';

instance.interceptors.request.use(
    /**
     * 
     * @param request 
     * @returns request
     */
    request => {
        const auth = useAuthStore();               
        request.headers.Authorization = `Bearer ${auth.getToken}`;        
        //progressBar.show(75);
        return request;        
    }, 
    error => {           
        //progressBar.show(100);
        //progressBar.hide();
        return Promise.reject(error);
    }
);

instance.interceptors.response.use(
    response => {    
        //progressBar.hide();        
        return response;
    }, 
    error => {
        //progressBar.hide();
        notifyByResponseErrorMiddleware(error);
        redirectByResponseErrorMiddleware(error);
        return Promise.reject(error);
    }
);

export default instance;