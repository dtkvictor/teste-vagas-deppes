<script lang="ts" setup>
    import { RouterLink } from 'vue-router';

    const props = defineProps({
        links: Array<any>
    })

    const active = (status: boolean) => status
        ? ''
        : '' 
    ;

    const lastLink = (props.links.length - 1);
    const dynamicLinks = props.links.slice(1, lastLink);
</script>
<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <RouterLink :to="links[0].url ?? ''" class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </RouterLink>
            </li>
            <li v-for="link, key in dynamicLinks" :key="key">
                <li class="page-item"><a class="page-link" :href="link.url">{{ link.label }}</a></li>                
            </li>                                            
            <li class="page-item">
                <RouterLink :to="links[lastLink].url ?? ''" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </RouterLink>
            </li>
        </ul>
    </nav>
</template>