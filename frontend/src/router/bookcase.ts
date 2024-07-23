import authMiddleware from '@/middlewares/route/authMiddleware';

export default {
    path: '/estante',
    children: [
      { 
          path: '', 
          name: 'bookcase', 
          component: () => import('@/pages/bookcase/IndexBook.vue'),
          meta: { 
            middlewares: [
              authMiddleware
            ]
          }
      },
    
      { 
          path: 'novo/livro', 
          name: 'bookcase.create', 
          component: () => import('@/pages/bookcase/CreateBook.vue'),
          meta: { 
            middlewares: [
              authMiddleware
            ]
          }
      },

      { 
          path: 'atualizar/livro/:id',
          name: 'bookcase.update',
          props: true,
          component: () => import('@/pages/bookcase/UpdateBook.vue'),
          meta: { 
            middlewares: [
              authMiddleware
            ]
          }
      },       
    ]
  };