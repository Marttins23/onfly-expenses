import axios from 'axios';

export const fetchExpenses = async(userId) => {
    return await axios.get(`/api/users/${userId}/expenses`)
        .then(response => response.data);
};

export const createExpense = async(userId, expenseData) => {
    return await axios.post(`/api/users/${userId}/expenses`, expenseData)
        .then(response => response.data);
};

export const updateExpense = async(id, expenseData) => {
    return await axios.put(`/api/expenses/${id}`, expenseData)
        .then(response => response.data);
};

export const deleteExpense = async(id) => {
    return await axios.delete(`/api/expenses/${id}`);
};
