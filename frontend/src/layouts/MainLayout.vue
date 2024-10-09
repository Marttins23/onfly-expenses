<template>
  <q-layout view="lHr lpR lFr" class="bg-blue-grey-1">
    <q-header elevated class="bg-light-blue-10 text-white q-py-sm">
      <q-toolbar>
        <span class="q-pr-lg">Gerenciamento de Despesas - Onfly</span>
        <q-space />
        <div class="flex justify-end items-center q-pl-lg">
            <span class="text-weight-bold">
              {{ userName }}
            </span>
            <q-btn
              label="Sair"
              type="button"
              class="bg-white text-primary q-ml-md"
              @click="onLogout"
            />
        </div>
      </q-toolbar>
    </q-header>

    <q-page-container class="boxed">
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
  import { useAuthStore } from 'stores/auth';

  const auth = useAuthStore();
  const userName = auth.user.name;

  const onLogout = async () => {
    await auth.logout();
  };
</script>

<style scoped>
  .boxed {
    max-width: 1440px;
    margin: 0 auto;
  }
</style>
