import { useAuthStore } from "@/stores/authStore";
import type { RouteMiddlewareFunction } from "@/types";

const unauthMiddleware:RouteMiddlewareFunction = async (to , from) => {
    const auth = useAuthStore();    
    if(auth.isAuth) return { name: 'home' };
}

export default unauthMiddleware;
