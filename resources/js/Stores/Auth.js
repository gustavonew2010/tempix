import { defineStore } from 'pinia'
import axios from 'axios';
import router from '../Router';
import Echo from "laravel-echo";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('token') || null,
        user: JSON.parse(localStorage.getItem('user')) || null,
        isAuth: localStorage.getItem('token') ? true : false,
        userData: null,
    }),

    actions: {
        updateUserData(newData) {
            this.user = newData;
            localStorage.setItem('user', JSON.stringify(newData));
        },

        setToken(token) {
            this.token = token;
            localStorage.setItem('token', token);
        },

        getToken() {
            return this.token;
        },

        setUser(user) {
            this.user = user;
            localStorage.setItem('user', JSON.stringify(user));
        },

        setIsAuth(isAuth) {
            this.isAuth = isAuth;
        },

        async checkToken() {
            try {
                const tokenAuth = 'Bearer ' + this.token;
                const { data } = await axios.get('/api/auth/verify', {
                    headers: {
                        Authorization: tokenAuth
                    }
                });

                return data;
            } catch (error) {
                if(error.response.status === 401) {
                    this.logout();
                    router.push('/');
                }else{
                    console.log(error.response);
                }
            }
        },

        logout() {
            this.token = null;
            this.user = null;
            this.isAuth = false;
            localStorage.removeItem('token');
            localStorage.removeItem('user');
        },

        initializingEcho() {
            window.EchoPrivate = new Echo({
                broadcaster: 'pusher',
                key: import.meta.env.VITE_PUSHER_APP_KEY,
                cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
                wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
                wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
                forceTLS: false,
                enabledTransports: ['ws', 'wss'],
                disabledTransports: ['sockjs', 'xhr_polling', 'xhr_streaming'],
                authEndpoint: `/api/broadcasting/auth`,
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]'),
                        Authorization: `Bearer ${this.token}`
                    }
                }
            });
        },
    }
})
