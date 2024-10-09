<template>
  <q-page padding>
    <div class="col-12 full-width full-height">
      <h5 class="q-my-md">Despesas</h5>
      <expense-form />
      <expenses-table />
    </div>
  </q-page>
</template>

<script setup>
  import ExpenseForm from '../components/ExpenseForm.vue';
  import ExpensesTable from '../components/ExpensesTable.vue';
</script>
