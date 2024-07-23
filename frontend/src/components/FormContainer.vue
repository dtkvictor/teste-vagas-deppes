<script lang="ts" setup>
    defineProps({
        title: {
            type: String,
            required: true,
        },
        handleSubmit: {
            type: Function,
            required: true,
        }
    })
</script>

<template>    
    <form class="w-100 d-flex flex-column bg-white p-4 rounded shadow-sm" @submit.prevent="(event) => handleSubmit(event)">
        <div class="w-100 d-flex items-center mb-4">
            <h4 class="m-0 fw-light border-bottom border-2">{{ title }}</h4>
        </div>
        <slot />
    </form>
</template>