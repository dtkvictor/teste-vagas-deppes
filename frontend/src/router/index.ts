import { createRouter, createWebHistory } from 'vue-router';
import authMiddleware from '@/middlewares/route/authMiddleware';
import unauthMiddleware from '@/middlewares/route/unauthMiddleware';
import executeBeforeEachRoute from './executeBeforeEachRoute';
import Welcome from '@/pages/Welcome.vue';

import auth from './auth';
import bookcase from './bookcase';
import errors from './errors';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { 
      path: '/', 
      name: 'welcome', 
      component: Welcome, 
      meta: {
        middlewares: [
          unauthMiddleware
        ]
      }
    },

    { 
      path: '/inicio', 
      name: 'home', 
      component: () => import('@/pages/Home.vue'),       
      meta: { 
        middlewares: [
          authMiddleware
        ]
      }
    },

    { 
      path: '/livros', 
      name: 'books', 
      component: () => import('@/pages/Books.vue'), 
      meta: { 
        middlewares: [
          authMiddleware
        ]
      }
    },
    
    {
      path: '/perfil',    
      name: 'profile', 
      component: () => import('@/pages/profile/IndexProfile.vue'),
      meta: { 
          middlewares: [
              authMiddleware
          ]
      }
    },
    auth,    
    bookcase,
    errors,
  ]
});

router.beforeEach(executeBeforeEachRoute);

export default router
