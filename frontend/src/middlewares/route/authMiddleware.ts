import { useAuthStore } from "@/stores/authStore";
import type { RouteMiddlewareFunction } from "@/types";

const authMiddleware:RouteMiddlewareFunction = async (to , from) => {
    const auth = useAuthStore();
    if(!auth.isAuth) return { name: 'auth.login' };
}

export default authMiddleware;
