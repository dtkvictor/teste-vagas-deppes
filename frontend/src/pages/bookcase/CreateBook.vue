<script lang="ts" setup>
    import DefaultLayout from '@/layouts/DefaultLayout.vue';
    import FormBook from './partials/FormBook.vue';
    import Icon from '@/components/Icon.vue';
</script>

<template>
    <DefaultLayout>
        <div class="d-flex justify-content-end mb-3">
            <RouterLink :to="{name: 'bookcase'}" class="btn btn-outline-secondary d-flex align-items-center">
                <Icon name="arrow_back" />
            </RouterLink>
        </div>
        <FormBook method="post" url="/bookcase/create"></FormBook>
    </DefaultLayout>
</template>