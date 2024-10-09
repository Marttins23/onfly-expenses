<template>
  <q-page>
    <div class="row">
      <div class="col-none col-sm-5 col-md-7 window-height">
        <q-img
          fit="cover"
          src="~assets/img/login-background.jpg"
          width="100%"
          height="100%"
        />
      </div>
      <div class="col-12 col-sm-7 col-md-5 q-pa-xl shadow-8 window-height flex flex-center">
        <div class="row full-width">
          <h5 class="text-primary q-mx-auto">Onfly Despesas</h5>
          <q-form @submit="onSubmit" class="full-width">
            <q-input
              outlined
              v-model="email"
              label="E-mail"
              type="email"
              :rules="[val => !!val || 'O E-mail é obrigatório']"
              lazy-rules
              class="q-my-md"
            />

            <q-input
              outlined
              v-model="password"
              label="Senha"
              type="password"
              :rules="[val => !!val || 'A senha é obrigatória']"
              lazy-rules
              class="q-my-md"
            />

            <q-btn
              label="Entrar"
              color="primary"
              type="submit"
              class="full-width q-my-md"
            />

            <div class="text-center q-mt-lg">
              <span>Não tem uma conta?</span>
              <q-btn flat label="Cadastre-se" color="blue" to="/register" class="q-ml-md"/>
            </div>
          </q-form>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script setup>
  import { ref } from 'vue';
  import { useAuthStore } from 'stores/auth';

  const authStore = useAuthStore();
  const email = ref('');
  const password = ref('');

  const onSubmit = async () => {
    await authStore.login({ email: email.value, password: password.value });
  };
</script>
