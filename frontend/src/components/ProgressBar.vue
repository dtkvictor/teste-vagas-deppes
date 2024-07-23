<script setup lang="ts">
    import { useProgressBarStore } from '@/stores/progressBarStore';
    import { onMounted, ref, watch } from 'vue';

    const progressBarRef = ref<null|HTMLElement>(null);
    const progressBarStore = useProgressBarStore();
/*
    function showProgressBar(state: boolean) 
    {
        const progressBar = progressBarRef.value;

        if(!progressBar) return;

        if(state) {            
            progressBar.style.display = 'flex';
            setTimeout(() => {                
                progressBar.style.width = '75%';
            }, 100);

        }else {
            progressBar.style.width = '100%';
            setTimeout(() => {
                progressBar.style.display = 'none';
                progressBar.style.width = '0%';
            }, 700);
        }
    }

    onMounted(() => {
        progressBarStore.show();
        setInterval(() => progressBarStore.hide(), 150);        
    })

    watch(progressBarStore.isProgressing, (state) => showProgressBar(state));*/

    onMounted(() => {
        const progressBar = progressBarRef.value;
        if(!progressBar) return;

        progressBar.style.width = '100%';
        setTimeout(() => {
            progressBar.style.width = '0%';
            progressBar.style.display = 'none';
        })
    })
</script>
<template>
    <div class="w-100 progress rounded-0 bg-transparent position-fixed" role="progressbar" style="height: 5px;">
        <div 
            ref="progressBarRef"
            style="width: 0%;"
            class="progress-bar progress-bar-striped progress-bar-animated bord"
        ></div>
    </div>
</template>