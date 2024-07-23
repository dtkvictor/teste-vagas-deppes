import type { DirectiveBinding } from "vue";

function maxNumericValue(el: HTMLInputElement, binding: DirectiveBinding) {
    if (el.value > binding.value) {
        el.value = binding.value;
    }
}

export default {
    mounted(el: HTMLInputElement, binding: DirectiveBinding) {
        if(!binding.value) throw new Error('The maximum value has not been defined');
        el.addEventListener('input', () => {
            maxNumericValue(el, binding);
        })        
        maxNumericValue(el, binding);
    },
    updated(el: HTMLInputElement, binding: DirectiveBinding) {
        maxNumericValue(el, binding);
    }
}