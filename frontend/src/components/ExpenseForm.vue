<template>
    <q-card bordered tag="form" class="my-card q-py-lg q-px-md full-height">
        <q-card-section>
            <q-form @submit="onSubmit">
                <div class="row q-gutter-y-md col-gap-3">
                    <q-input
                        outlined
                        v-model="form.description"
                        label="Descrição"
                        lazy-rules
                        :rules="[ val => val && val.length > 0 || 'A descrição é obrigatória']"
                        class="col-12 col-sm"
                    />

                    <q-input
                        outlined
                        type="number"
                        v-model="form.value"
                        label="Valor da Despesa"
                        lazy-rules
                        :rules="[
                            val => val !== null && val !== '' || 'O valor é obrigatório',
                            val => val > 0 || 'O valor deve ser maior do que zero'
                        ]"
                        class="col-12 col-md-2"
                    />

                    <q-input
                        outlined
                        type="date"
                        v-model="form.date"
                        label="Data da Despesa"
                        lazy-rules
                        :rules="[
                            val => val !== null && val !== '' || 'A data é obrigatória'
                        ]"
                        class="col-12 col-md-2"
                    />

                    <q-btn
                        type="submit"
                        color="light-blue-8"
                        :label="btnText"
                        class="col-auto form-height"
                        glossy
                    />
                </div>
            </q-form>
        </q-card-section>
    </q-card>
</template>

<script setup>
    import { ref, watch } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useExpensesStore } from 'stores/expenses';

    const expensesStore = useExpensesStore();
    const { expenses, isEditing, form } = storeToRefs(expensesStore);
    const btnText = ref('Cadastrar');

    watch(isEditing, () => {
        btnText.value = isEditing.value ? 'Editar' : 'Cadastrar';
    })

    const onSubmit = async () => {
        isEditing.value
            ? await expensesStore.updateExpense(form.value)
            : await expensesStore.createExpense(form.value);
    };
</script>

<style scoped>
    .form-height {
        height: 56px;
    }

    .col-gap-3 {
        gap: 0.5rem 1rem;
    }
</style>
