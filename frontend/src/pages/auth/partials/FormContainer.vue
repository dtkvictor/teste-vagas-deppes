<script lang="ts" setup>
    import { RouterLink } from 'vue-router';
    import Icon from '@/components/Icon.vue';

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
    <main class="w-100 d-flex justify-content-center align-items-center">
        <form class="col-12 col-lg-6 col-xl-4 d-flex flex-column bg-white p-4 rounded shadow-sm mt-0 mt-lg-5" @submit.prevent="(event) => handleSubmit(event)">
            <div class="w-100 d-flex justify-content-between items-center mb-4">
                <h1 class="m-0 fw-light border-bottom border-2">{{ title }}</h1>
                <RouterLink class="text-black d-flex justify-content-center align-items-center underline-none" to="/">
                    <Icon class="fs-1" name="home" />
                </RouterLink>
            </div>
            <slot />
        </form>
    </main>
</template>