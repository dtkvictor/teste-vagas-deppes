<script lang="ts" setup>
    defineProps({
        offCanvasId: {
            required: true,
            type: String,
        }
    })
</script>

<template>
    <button class="btn" type="button" data-bs-toggle="offcanvas" :data-bs-target="'#' + offCanvasId" :aria-controls="offCanvasId">
        <slot />
    </button>
</template>