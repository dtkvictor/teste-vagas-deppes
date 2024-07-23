<script lang='ts' setup>
    import Spinner from './Spinner.vue';
    
    const props = defineProps({
        class: String,
        content: String,
        spinner: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        }
    });
</script>

<template>
    <button
        :disabled="disabled"
        :class="'btn' + props.class"
    >
        <div class="flex justify-center items-center gap-2" v-if="spinner">
            <Spinner />                        
            <span>{{ content }}</span>
        </div>                
        <slot v-else />
    </button>
</template>
