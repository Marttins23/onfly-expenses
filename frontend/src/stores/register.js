import { defineStore } from 'pinia';
import axios from 'axios';
import { Notify } from 'quasar';

export const useRegisterStore = defineStore('register', {
  state: () => {
    return {
        form: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    }
  },

  actions: {
    async register() {
      try {
          await axios.post(`/api/register`, this.form);
          Notify.create({
            message: 'Usuário cadastrado com sucesso!',
            color: 'positive',
          });
          this.router.push('/login');
      } catch (error) {
        Object.values(error.response.data.errors).forEach((errorsArray) => {
            errorsArray.forEach((errorMessage) => {
                Notify.create({
                    message: errorMessage,
                    color: 'negative',
                });
            });
        });
      }
    },

    $reset() {
      this.form.name = '';
      this.form.email = '';
      this.form.password = '';
      this.form.password_confirmation = '';
    }
  },
});
