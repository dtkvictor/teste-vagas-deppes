import unauthMiddleware from '@/middlewares/route/unauthMiddleware';
import Login from '@/pages/auth/Login.vue';
import Register from '@/pages/auth/Register.vue';

export default {
    path: '/auth',
    children: [
        { 
            path: 'login', 
            name: 'auth.login',             
            component: Login, 
            meta: {
              middlewares: [
                unauthMiddleware
              ]
            }
        },
        { 
            path: 'registrar', 
            name: 'auth.register', 
            component: Register,
            meta: {
              middlewares: [
                unauthMiddleware
              ]
            }
        },
    ]
};