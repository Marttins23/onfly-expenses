import { useAuthStore } from 'stores/auth';
import { Notify } from 'quasar';

const routes = [
  {
    path: '/',
    beforeEnter: (to, from, next) => {
      if (useAuthStore().isAuthenticated()) {
        next('/index');
      } else {
        next('/login');
      }
    }
  },
  {
    path: '/',
    component: () => import('src/layouts/NotLoggedLayout.vue'),
    children: [
      { path: 'login', component: () => import('pages/LoginPage.vue') },
      { path: 'register', component: () => import('pages/RegisterPage.vue') }
    ]
  },
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    beforeEnter: (to, from, next) => {
      if (!useAuthStore().isAuthenticated()) {
        next('/login');
        Notify.create({
          message: 'Você precisa estar logado para acessar esse recurso',
          color: 'negative'
        });
      } else {
        next();
      }
    },
    children: [
      { path: 'index', component: () => import('pages/IndexPage.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
];

export default routes;
