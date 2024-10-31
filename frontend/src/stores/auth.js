import { defineStore } from 'pinia';
import axios from 'axios';
import Cookies from 'js-cookie';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: null,
        user: null,
        isAuthenticated: false,
    }),
    actions: {
        async fetchUser() {
            const token = Cookies.get('authToken');
            if (!token) {
                this.isAuthenticated = false;
                this.user = null;
                return;
            }

            try {
                const response = await axios.get('/api/profile', {
                    headers: { Authorization: `Bearer ${token}` },
                });
                this.token = token
                this.user = response.data.data;
                this.isAuthenticated = true;
            } catch (error) {
                console.error('Ошибка при получении данных пользователя:', error);
                this.isAuthenticated = false;
                this.user = null;
            }
        },
        async logout(router) {
            const token = Cookies.get('authToken');
            const response = await axios.post('/api/logout', {}, {
                headers: { Authorization: `Bearer ${token}` },
            })
            if (response.status === 200) {
                Cookies.remove('authToken');
                this.user = null;
                this.isAuthenticated = false;
                await router.push('/');
            }
        },
        async login(credentials) {
            try {
                const response = await axios.post('/api/login', credentials);
                const token = response.data.data.token;
                Cookies.set('authToken', token);
                await this.fetchUser();
            } catch (error) {
                console.error('Ошибка входа:', error);
            }
        }
    }
});
