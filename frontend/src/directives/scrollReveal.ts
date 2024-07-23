import ScrollReveal from 'scrollreveal';

import type { DirectiveBinding } from "vue";

interface ScrollRevealBindigIterface extends DirectiveBinding {
    value: ScrollReveal.ScrollRevealObjectOptions,
}

const scrollreveal = ScrollReveal({ reset: true });
const effects: Record<string, ScrollReveal.ScrollRevealObjectOptions> = {
    fadeIn: {
        duration: 3000,
        distance: '40%',
        origin: 'top'
    },
    flip: {
        duration: 3000,
        rotate: {
            x: 0, 
            y: 100,
            z: 0            
        }
    }
}

function reveal(el: HTMLElement, bindig: ScrollRevealBindigIterface): void {
    el.style.visibility = 'hidden';

    const effect = effects[bindig?.arg] ?? {};
    const options = typeof(bindig.value) == 'object' ? bindig.value : {};

    scrollreveal.reveal(el, {
        ...effect,
        ...options
    });
}

export default {
    mounted(el: HTMLElement, bindig: ScrollRevealBindigIterface) {
        reveal(el, bindig);
    }
}