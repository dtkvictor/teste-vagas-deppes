import router from "@/router";
import { useAuthStore } from "@/stores/authStore";
import type { AxiosError, AxiosResponse } from "axios";

const actions: Record<string, Function>= {
    404() {
        return router.push({name: 'not-found'});
    },
    500() {
        return router.push({name: 'internal-error-server'});
    },
    401() {
        const auth = useAuthStore();
        auth.revokeAuthentication();
        return router.push({name: 'auth.login'});
    }
}
/**
 * Analyzes the response and redirects based on the message.
 * @param {AxiosError} error 
 * @returns { AxiosError }
 */
export default function(error: AxiosError): AxiosError 
{
    const statusCode = error.response?.status ?? 0;

    if(actions[statusCode]) {
        actions[statusCode]();
    }

    return error;       
}