<template>
  <q-page>
    <div class="row">
      <div class="col-12 col-sm-7 col-md-5 q-pa-xl shadow-8 window-height flex flex-center">
        <div class="row full-width">
          <h5 class="text-primary q-mx-auto">Onfly Despesas</h5>
          <q-form @submit="onSubmit" class="full-width">
            <q-input
              outlined
              v-model="form.name"
              label="Nome"
              type="name"
              :rules="[val => !!val || 'O nome é obrigatório']"
              lazy-rules
              class="q-my-md"
            />

            <q-input
              outlined
              v-model="form.email"
              label="E-mail"
              type="email"
              :rules="[val => !!val || 'O E-mail é obrigatório']"
              lazy-rules
              class="q-my-md"
            />

            <q-input
              outlined
              v-model="form.password"
              label="Senha"
              type="password"
              :rules="[val => !!val || 'A senha é obrigatória']"
              lazy-rules
              class="q-my-md"
            />

            <q-input
              outlined
              v-model="form.password_confirmation"
              label="Confirmar Senha"
              type="password"
              :rules="[
                val => !!val || 'A confirmação da senha é obrigatória',
                val => val === form.password || 'A confirmação deve ser igual a senha'
              ]"
              lazy-rules
              class="q-my-md"
            />

            <q-btn
              label="Cadastrar"
              color="primary"
              type="submit"
              class="full-width q-my-md"
            />

            <q-btn flat label="Voltar" color="blue" to="/login" class="full-width"/>

          </q-form>
        </div>
      </div>
      <div class="col-none col-sm-5 col-md-7 window-height">
        <q-img
          fit="cover"
          src="~assets/img/register-background.jpg"
          width="100%"
          height="100%"
        />
      </div>
    </div>
  </q-page>
</template>

<script setup>
  import { ref } from 'vue';
  import { useRegisterStore } from 'stores/register';

  const registerStore = useRegisterStore();
  const form = ref(registerStore.form);

  const onSubmit = async () => {
    await registerStore.register();
  };
</script>
