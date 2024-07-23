import type { RouteLocationNormalizedGeneric, RouteLocationNormalizedLoadedGeneric } from "vue-router";

export interface Data {
    id: number,
    created_at: string,
    updated_at: string,
}

export interface User {
    name: string,
    email: string,       
    created_at?: string,
    updated_at?: string,
}

export interface AuthUser {
    token?: string,
    user?: User,
    created_at?: string,
    expiration_at?: number,
}

export interface Category extends Data
{
    thumb: string,
    name: string,
    description: string    
}

export interface Publisher extends Data 
{
    name: string,
    description: string
}

export interface Book extends Data 
{    
    thumb: string,
    thumb_url: string,
    title: string,
    author: string,
    isbn: string
    description: string,
    number_pages: number,
    language: string,
    user: User;
    category: Category,
    publisher: Publisher,    
}

export type RouteNext = { 
    name?: string
}

export type RouteMiddlewareFunction = (
    to: RouteLocationNormalizedGeneric,
    from: RouteLocationNormalizedLoadedGeneric,
) => Promise<RouteNext|void>;