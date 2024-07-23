import NotFound from '@/pages/errors/NotFound.vue';
import InternalErrorServer from '@/pages/errors/InternalErrorServer.vue';

export default {
    path: '/errors',
    children: [
        {
            path: '500',
            name: 'internal-error-server',
            component: InternalErrorServer,
        },
        {
            path: ':pathMatch(.*)*',
            name: 'not-found',
            component: NotFound
        }
    ]
};