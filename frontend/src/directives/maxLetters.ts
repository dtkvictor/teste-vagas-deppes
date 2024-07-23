import type { DirectiveBinding } from "vue";

function maxLetters(el: HTMLElement, binding: DirectiveBinding) {    
    if (el.textContent && el.textContent.length > binding.value) {
        el.textContent = el.textContent.substring(0, binding.value) + '...';
    }
}

export default {
    mounted(el: HTMLInputElement, binding: DirectiveBinding) {
        if(!binding.value) throw new Error('The maximum value has not been defined');        
        maxLetters(el, binding);                
    },
    updated(el: HTMLInputElement, binding: DirectiveBinding) {
        maxLetters(el, binding);
    }
}