import { defineStore } from 'pinia';
import axios from 'axios';
import { LocalStorage, Notify } from 'quasar';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: LocalStorage.getItem('token') || null,
    user: LocalStorage.getItem('user') || null,
  }),

  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('/api/login', credentials).then(response => response.data);
        const token = response.data.token;
        const user = response.data.user;

        this.token = token;
        this.user = user;

        LocalStorage.set('token', token);
        LocalStorage.set('user', user);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        Notify.create({
          message: 'Login realizado com sucesso',
          color: 'positive',
        });

        this.router.push('/index');

      } catch (error) {
        Notify.create({
          message: 'Erro no login',
          color: 'negative',
        });
      }
    },

    logout() {
      this.token = null;
      this.user = null;
      LocalStorage.remove('token');
      LocalStorage.remove('user');
      delete axios.defaults.headers.common['Authorization'];
      this.router.push('/login');
    },

    isAuthenticated() {
      return !!this.token;
    },
  },
});
