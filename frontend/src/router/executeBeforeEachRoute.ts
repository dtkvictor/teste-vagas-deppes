import type { RouteMiddlewareFunction } from '@/types';
import type { RouteLocationNormalizedGeneric, RouteLocationNormalizedLoadedGeneric } from 'vue-router';

function isAsyncMethod(method: Function): boolean {
    return method.toString().includes('async');
}
  
async function executeRouteMiddleware (
      middleware: RouteMiddlewareFunction|Function,
      to: RouteLocationNormalizedGeneric,
      from: RouteLocationNormalizedLoadedGeneric
): Promise<any> {
    if(!isAsyncMethod(middleware)) return middleware(to, from);
    return await middleware(to, from);    
}
  
export default async function (
    to: RouteLocationNormalizedGeneric,
    from: RouteLocationNormalizedLoadedGeneric
): Promise<any> {    
    const middlewares = (to.meta.middlewares as Array<RouteMiddlewareFunction>) ?? [];
    for(let middleware of middlewares) {        
      let middlewareResult = executeRouteMiddleware(middleware, to, from);
      if(middlewareResult) return middlewareResult;
    }    
}