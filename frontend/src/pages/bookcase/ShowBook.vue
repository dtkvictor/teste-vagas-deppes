<script lang="ts" setup>
    import DefaultLayout from '@/layouts/DefaultLayout.vue';
    import { onBeforeMount, ref } from 'vue';

    const props = defineProps({
        id: String,    
    });

    const book = ref(null);

    onBeforeMount(() => {
        axios.get('/bookcase/' + props.id)
            .then(response => console.log(response))
            .catch(error => console.log(error))
    })

</script> 

<template>
    <DefaultLayout>
        <div class="d-flex justify-content-end mb-3">
            <RouterLink :to="{name: 'bookcase'}" class="btn btn-outline-secondary d-flex align-items-center">
                <Icon name="arrow_back" />
            </RouterLink>
        </div>        
    </DefaultLayout>
</template>w