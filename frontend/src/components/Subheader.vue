<script lang="ts" setup>
    defineProps({
        title: String
    })
</script>
<template>
    <nav class="d-flex justify-content-betweeen">        
        <h3 class="fw-ligth">{{ title }}</h3>
        <slot/>
    </nav>
</template>