<template>
    <q-table
        :rows="expenses"
        :columns="columns"
        row-key="id"
        class="q-mt-lg"
    >
        <template v-slot:header="props">
            <q-tr :props="props">
                <q-th
                    v-for="col in props.cols"
                    :key="col.name"
                    :props="props"
                    class="bg-light-blue-8"
                >
                    <span class="text-weight-bold text-subtitle1 text-white">{{ col.label }}</span>
                </q-th>
            </q-tr>
        </template>
        <template v-slot:body-cell-actions="props">
            <q-td align="right">
                <q-btn
                    flat
                    icon="edit"
                    @click="expensesStore.editExpense(props.row.id, props.row)"
                    color="primary"
                    dense
                />
                <q-btn
                    flat
                    icon="delete"
                    @click="expensesStore.deleteExpense(props.row.id)"
                    color="negative"
                    dense
                />
            </q-td>
        </template>
    </q-table>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useExpensesStore } from 'stores/expenses';
    import { formatBRDate } from '../services/FormatDateService';
    import { formatBRCurrency } from '../services/FormatCurrencyService';

    const expensesStore = useExpensesStore();
    const { expenses } = storeToRefs(expensesStore);
    const btnText = ref('Cadastrar');

    const columns = [
        { name: 'description', label: 'Descrição', field: 'description', align: 'left' },
        { name: 'value', label: 'Valor', field: 'value', format: (val) => formatBRCurrency(val), align: 'center' },
        { name: 'date', label: 'Data', field: 'date', format: (val) => formatBRDate(val), align: 'center' },
        { name: 'actions', label: 'Ações', align: 'right' },
    ];

    onMounted(async () => {
        await expensesStore.fetchExpenses();
    });
</script>

