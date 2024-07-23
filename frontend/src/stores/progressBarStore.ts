import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useProgressBarStore = defineStore('progressBar', () => {
  const progressing = ref<{ state: boolean, percentage: number }>({
    state: false,
    percentage: 0,
  });

  const isProgressing = computed(() => progressing.value.state);
  const percentage = computed(() => progressing.value.percentage);

  function show(percentage: number) {
    progressing.value.state = true;
    progressing.value.percentage = percentage;
  }

  function hide() {
    progressing.value.state = false;
    progressing.value.percentage = 0;
  }

  return { percentage, isProgressing, show, hide };
});
