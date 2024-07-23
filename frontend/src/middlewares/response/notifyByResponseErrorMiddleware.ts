import type { AxiosError } from "axios";
import iziToast from "izitoast";

const errors: Record<number, Function> = {
    403: () => {
        iziToast.error({
            title: 'Não autorizado',
            message: 'Você não tem permissão para realizar essa ação.'
        })
    }
}
/**
 * Analyzes the response and notify based on the message.
 * @param {AxiosError} error 
 * @returns { AxiosError }
 */
export default function(error: AxiosError): AxiosError 
{
    const statusCode = error.response?.status;
    const action = statusCode ? errors[statusCode] : null;

    if(action) action(error);

    return error;       
}