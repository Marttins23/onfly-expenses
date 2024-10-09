import { Notify } from 'quasar';

export const handleAsyncOperation = async (asyncOperation, successMessage = null, errorMessage = 'Erro ao realizar a operação') => {
    try {
      const result = await asyncOperation();
      if (successMessage) {
        Notify.create({
          message: successMessage,
          color: 'positive',
        });
      }
      return result.data;
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            Object.values(error.response.data.errors).forEach((errorsArray) => {
                errorsArray.forEach((errorMessage) => {
                    Notify.create({
                        message: errorMessage,
                        color: 'negative',
                    });
                });
            });
        } else {
            Notify.create({
                message: errorMessage,
                color: 'negative',
            });
        }
    }
}