import type { DirectiveBinding } from "vue";

function maxLength(el: HTMLInputElement, binding: DirectiveBinding) {
    if (el.value.length > binding.value) {
        el.value = el.value.substring(0, binding.value);
    }
}

export default {
    mounted(el: HTMLInputElement, binding: DirectiveBinding) {
        if(!binding.value) throw new Error('The maximum value has not been defined');
        el.addEventListener('input', () => {
            maxLength(el, binding);
        })        
        maxLength(el, binding);
    },
    updated(el: HTMLInputElement, binding: DirectiveBinding) {
        maxLength(el, binding);
    }
}