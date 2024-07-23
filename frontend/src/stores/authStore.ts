import { ref, computed, type ComputedRef } from 'vue';
import { defineStore } from 'pinia';
import type { AuthUser, User } from '@/types';

const AUTH_SESSION_KEY = 'session.auth';

function setAuthSessionInformations(informations: AuthUser): void
{
    try {
        const informationsJson = JSON.stringify(informations);
        localStorage.setItem(AUTH_SESSION_KEY, informationsJson);
    }catch {
        console.error('Failed to add session in storeding.')
    }
}

function getAuthSessionInformations(): AuthUser
{
    let sessionInformations: AuthUser = 
    {
        token: undefined,
        user: undefined,
        created_at: undefined,
        expiration_at: undefined,
    };

    try {
        const session: string = localStorage.getItem(AUTH_SESSION_KEY) ?? '';
        if(session) sessionInformations = JSON.parse(session) as AuthUser;
        
    }catch {
        console.error('Failed to load stored informations.')

    }finally {
        return sessionInformations;
    }    
}

function destroyAuthSession(): void
{
    localStorage.removeItem(AUTH_SESSION_KEY);
}

export const useAuthStore = defineStore('auth', () => 
{
    const auth = ref<AuthUser>(getAuthSessionInformations());

    const remainingTimeInMinute:ComputedRef<number> = computed(() => {
        if(!auth.value.created_at || !auth.value.expiration_at) return 0;

        const now = new Date();
        const createTokenDate = new Date(auth.value.created_at);
        const expirationTokenDate = new Date(createTokenDate.getTime() + auth.value.expiration_at * 60000);

        const remainingTimeInMilliseconds = expirationTokenDate.getTime() - now.getTime();
        const remainingTimeInMinute = Math.floor(remainingTimeInMilliseconds / 60000);

        return remainingTimeInMinute;
    });
    
    const getUser:ComputedRef<User|undefined> = computed(() => auth.value.user);
    const getToken:ComputedRef<string|undefined> = computed(() => auth.value.token);    
    const hasToken:ComputedRef<boolean> = computed(() => auth.value.token ? true : false);    
    const isAuth:ComputedRef<boolean> = computed(() => hasToken.value && (remainingTimeInMinute.value > 15));    
    

    function updateAuthInformations(informations: AuthUser) 
    {
        try {
            auth.value = {
                ...auth.value,
                ...informations
            };
            setAuthSessionInformations(auth.value);            
        }catch {
            console.error('Failed to update session information.')
        }
    }

    function updateUserInformations(user: User) 
    {
        try {
            auth.value.user = {
                ...auth.value.user,
                ...user,
            };
            setAuthSessionInformations(auth.value);
        }catch {
            console.error('Failed to update user informations.')
        }
    }

    function revokeAuthentication()
    {
        destroyAuthSession();        
        auth.value = getAuthSessionInformations();
    }   

    return { 
        getUser,
        getToken,
        hasToken,
        isAuth,          
        remainingTimeInMinute, 
        updateAuthInformations,
        updateUserInformations,
        revokeAuthentication,
    }
});