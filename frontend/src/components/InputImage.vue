<script lang="ts" setup>
    import { computed, ref, watch } from 'vue';

    const props = defineProps({        
        id: String,
        name: String,
        value: [String, File],
        defaultImage: String,
        imgClass: String,
    });

    const emits = defineEmits(['loadFile']);
    const inputRef = ref(null);
    const urlBase64 = ref('');    

    const defaultImage = computed(() => {
        if(urlBase64.value) return urlBase64.value;
        else if(props.defaultImage) return props.defaultImage;
        else return '/assets/images/camera.png';
    });

    function loadFile(file: File) {
        let fileReader = new FileReader();
        fileReader.onload = (event) => {    
            if(event.target)  {
                urlBase64.value = event.target.result as string;
            }                   
        }
        fileReader.readAsDataURL(file);
    }

    function setFile(event: Event) {     
        let input = event.target as HTMLInputElement;   
        let files = input.files;

        if(files && files.length > 0) {
            loadFile(files[0]);
            emits('loadFile', files[0]);
        }
    }

    watch(props, () => {        
        if(urlBase64.value && !props.value) {
            urlBase64.value = '';
            inputRef.value.value = '';
        }
    });

</script>

<template>                                   
    <div>
        <div class="d-flex flex-wrap justify-content-center align-items-center mb-2">
            <label :for="id">
                <img 
                    :class="['cursor-pointer shadow-sm d-flex justify-content-center align-items-center border border-1', imgClass]"
                    :src="defaultImage" 
                    alt="picture"
                    style="width: 125px; height: 125px;"
                >
            </label>
        </div>
        <div class="flex">
            <input              
                :id="id"
                :name="name"
                ref="inputRef"
                type="file"             
                class="file"        
                accept="image/png, image/jpeg"            
                @change="setFile"            
            />
        </div>
    </div>
</template>