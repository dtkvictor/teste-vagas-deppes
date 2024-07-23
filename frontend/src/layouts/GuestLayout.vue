<script lang="ts" setup>
    import ApplicationLogo from '@/components/ApplicationLogo.vue';
    defineProps({
        class: String,
    });
</script>
<template>
    <div class="w-100 h-100">
        <header class="shadow-sm">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-lg justify-content-between" style="min-height: 55px;">                                            
                    <RouterLink to="/" class="underline-none text-black">
                        <ApplicationLogo />
                    </RouterLink>
                </div>                            
            </nav>
        </header>        
        <div :class="[$props.class, 'container-lg']">
            <slot />
        </div>
    </div>
</template>