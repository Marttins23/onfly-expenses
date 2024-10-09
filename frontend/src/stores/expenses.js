import { defineStore } from 'pinia';
import { useAuthStore } from './auth';
import { formatDate } from '../services/FormatDateService';
import { handleAsyncOperation } from '../services/ErrorHandlerService';
import { fetchExpenses, createExpense, updateExpense, deleteExpense } from '../services/ExpenseService';

export const useExpensesStore = defineStore('expenses', {
  state: () => {
    return {
      userId: useAuthStore().user.id,
      isEditing: false,
      editingId: null,
      expenses: [],
      form: {
        description: "",
        value: null,
        date: ""
      }
    }
  },

  actions: {
    async fetchExpenses() {
      this.expenses = await handleAsyncOperation(
        () => fetchExpenses(this.userId),
        null,
        'Erro ao buscar despesas'
      );
    },

    async createExpense(expenseData) {
      const newExpense = await handleAsyncOperation(
        () => createExpense(this.userId, expenseData),
        'Despesa criada com sucesso',
        'Erro ao criar despesa'
      );
      this.expenses.push(newExpense);

      this.cleanForm();
    },

    async updateExpense(expenseData) {
      const updatedExpense = await handleAsyncOperation(
        () => updateExpense(this.editingId, expenseData),
        'Despesa atualizada com sucesso',
        'Erro ao atualizar despesa'
      );
      const index = this.expenses.findIndex((expense) => expense.id === this.editingId);
      if (index !== -1) { this.expenses[index] = updatedExpense; }

      this.cleanForm();
    },

    async deleteExpense(id) {
      await handleAsyncOperation(
        () => deleteExpense(id),
        'Despesa deletada com sucesso',
        'Erro ao deletar despesa'
      );
      this.expenses = this.expenses.filter((expense) => expense.id !== id);
    },
    
    editExpense(id, expense) {
      this.form.description = expense.description;
      this.form.value = expense.value;
      this.form.date = formatDate(expense.date);
      this.isEditing = true;
      this.editingId = id;
    },

    cleanForm() {
      this.isEditing = false;
      this.editingId = null;
      this.form.description = '';
      this.form.value = null;
      this.form.date = '';
    },

    $reset() {
      this.userId = null;
      this.isEditing = false;
      this.editingId = null;
      this.expenses = [];
      this.form.description = '';
      this.form.value = null;
      this.form.date = '';
    }
  },
});
