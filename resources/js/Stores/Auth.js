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
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
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
            delete axios.defaults.headers.common['Authorization'];
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

        async fetchUser() {
            try {
                const response = await axios.get('/api/profile'); // Retorna { status, user, totalEarnings, ... }
                console.log("Retorno do fetchUser:", response.data);

                // Verifica se a response contém a chave "user"
                if (response.data && response.data.user) {
                    // Conversão dos campos para camelCase (se o front espera 'birthDate' em vez de 'birth_date', etc.)
                    const userFromApi = response.data.user;
                    const userCamelCase = {
                        ...userFromApi,
                        // Você pode mapear ou renomear os campos conforme o esperado:
                        fullName: userFromApi.name,         // se o front espera fullName
                        motherName: userFromApi.mother_name,
                        birthDate: userFromApi.birth_date,
                        // Caso queira mapear outros campos, adicione aqui
                    };

                    // Define apenas o objeto do usuário na store
                    this.user = userCamelCase;
                    localStorage.setItem('user', JSON.stringify(userCamelCase));
                } else {
                    console.error('Resposta inválida da API:', response.data);
                }
            } catch (error) {
                console.error("Erro ao buscar usuário:", error);
            }
        }
    }
})
