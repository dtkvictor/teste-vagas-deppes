<script lang="ts" setup>
    import DefaultLayout from '@/layouts/DefaultLayout.vue';
    import Subheader from '@/components/Subheader.vue';
    import UpdateProfileInfo from './partials/UpdateProfileInfo.vue';
    import UpdatePassword from './partials/UpdatePassword.vue';
    import DeleteProfile from './partials/DeleteProfile.vue';
</script>

<template>
    <DefaultLayout class="">
        <Subheader title="Perfil"></Subheader>
        <div class="d-flex flex-column gap-3">
            <UpdateProfileInfo />
            <UpdatePassword />
            <DeleteProfile />
        </div>
    </DefaultLayout>
</template>