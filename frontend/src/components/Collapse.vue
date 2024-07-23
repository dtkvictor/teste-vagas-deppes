<script lang="ts" setup>
    import { onMounted, onUnmounted, ref } from 'vue';
    import Icon from './Icon.vue';

    defineProps({
        title: String,
    });
    
    const show = ref<Boolean>(false);
    const collapseRef = ref(null);

    const handleDocumentClick = (event: MouseEvent) => {
        const target = event.target as HTMLElement;
        if (!collapseRef.value.contains(target)) {
            show.value = false;
        }
    };

    onMounted(() => {
        document.addEventListener('click', handleDocumentClick);
    });

    onUnmounted(() => {
        document.removeEventListener('click', handleDocumentClick);
    }); 

</script>

<template>
    <div ref="collapseRef" class="flex flex-col w-full border-y border-gray-300 select-none">
        <a class="flex justify-between w-full p-4 cursor-pointer" @click="show = !show">
            <span>{{ title }}</span>
            <Icon :name=" show ? 'keyboard_arrow_down' : 'keyboard_arrow_right'"/>
        </a>
        <Transition>
            <div v-show="show" class="border-t border-gray-300 bg-gray-100 shadow-inner p-4">
                <slot />
            </div>
        </Transition>
    </div>    
</template>

<style scoped>    
    .v-enter-active {
        transition: opacity 0.5s linear;
    }
    .v-leave-active {
        transition: opacity 0s linear;
    }
    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }
</style>