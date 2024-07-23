import { reactive } from "vue";
import axios from "@/services/axios";
import type { AxiosError, AxiosResponse } from "axios";
import { ref } from "vue";
import { object, ValidationError} from "yup";

type FormRequestSubmit = {
    method: string, 
    url: string, 
    headers?: Record<any,any>,
    onSuccess?: (response: AxiosResponse) => void, 
    onError?: (error: AxiosError) => void,
    onFinally?: () => void,
    beforeRequest?: (data: Record<string, any>) => void
}

async function yupResolve(rules: Record<string, any>, data: Record<string, any>) 
{
    let objectErrors: Record<string, string> = {};

    try {
        await (object().shape(rules)).validate(data, { abortEarly: false });
    }catch(errors) {
        if(errors instanceof ValidationError) {                        
            /** Create object key value; */
            for (let key in errors.inner) {                
                if (errors.inner.hasOwnProperty(key)) {                    
                    let field = errors.inner[key].path as string;
                    let message = errors.inner[key].message;
                    objectErrors[field] = message;
                }
            } 
        }
    }

    return objectErrors;
}

export const useForm = (data: Record<string, any>) => {

    const initErrors: Record<string, string> = {};        

    for(let key in data) {        
        initErrors[key] = '';
    }

    return({
        
        data: reactive(data),
        errors: reactive(initErrors),
        validator: {},
        processing: ref(false),

        isProcessing() {
            return this.processing.value;
        },

        getData(): Record<string, any> {        
            return { ...this.data };
        },

        setData(key: string, value: any): void {
            this.data[key] = value;
        },

        getErrors(): Record<string, string> {
            return this.errors;
        },

        setError(key: string, value: string): void {
            this.errors[key] = value;
        },

        setErrors(errors: Record<string, string>): void {
            for(let key in errors) {
                let message = errors[key];
                this.setError(key, message);
            }
        },

        resetData(): void {
            for(let key in this.data) {
                this.data[key] = '';
            }
        },

        resetErrors(): void {
            for(let key in this.errors) {
                this.errors[key] = '';
            }
        },

        
        defineYupRules(rules: Record<string, any>)
        {
            this.validator = rules;
        },
        
        async submit({ method, url, headers, onSuccess, onError, onFinally, beforeRequest}: FormRequestSubmit): Promise<void>
        {            
            if(this.isProcessing()) return;
            this.resetErrors();
            this.processing.value = true;            

            if(Object.keys(this.validator).length > 0) {                        
                const errors = await yupResolve(this.validator, this.getData());                      
                if(Object.keys(errors).length > 0) {
                    this.setErrors(errors);                
                    this.processing.value = false;
                    return
                }
            }
            
            let options:Record<any, any> = {
                method: method,
                url: url,
                data: this.getData()
            }

            if(headers) {
                options.headers = headers;
            }

            if(beforeRequest) beforeRequest(this.data);

            axios(options).then(response => {                
                if(onSuccess) onSuccess(response);
            })
            .catch(error => {
                this.resetErrors();
                if(error.response && error.response.data) {                    
                    this.setErrors(error.response.data.errors);
                }        
                if(onError) onError(error);                
            })
            .finally(() => { 
                if(onFinally) onFinally();
                this.processing.value = false;
            })
        }
    })
}