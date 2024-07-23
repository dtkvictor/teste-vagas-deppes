<script lang="ts" setup>
    import DefaultLayout from '@/layouts/DefaultLayout.vue';    
    import Icon from '@/components/Icon.vue';
    import OffCanvas from './OffCanvas.vue';
    import OffCanvasButton from './OffCanvasButton.vue';
    //import Pagination from './Pagination.vue';    
</script>

<template>
    <DefaultLayout>    
        <nav class="w-100 d-flex flex-wrap justify-content-between">    
            <div class="col-12 col-lg-3">    
                <h3 class="fw-ligth">Estante</h3>                
            </div>
            <div class="col-12 col-lg-3 d-flex gap-1">
                <OffCanvasButton off-canvas-id="filters" class="btn btn-outline-secondary d-flex d-lg-none justify-content-center align-items-center">                
                    <Icon name="settings_input_component"/>
                </OffCanvasButton>           

                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Editora, título, isbn" aria-label="título, nome, isbn" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary d-flex justify-content-center align-items-center" type="button" id="button-addon2">
                        <Icon name="search"/>    
                    </button>
                </div>
            </div>
            <div class="col-lg-3 gap-1 d-none d-lg-flex justify-content-end">
                <OffCanvasButton off-canvas-id="filters" class="btn btn-outline-secondary d-flex justify-content-center align-items-center">                
                    <Icon name="settings_input_component"/>
                </OffCanvasButton>           
                <slot name="afterFilterButton"/>            
            </div>
        </nav>
        <OffCanvas id="filters"></OffCanvas>        
        <slot/>
        <!--Pagination></Pagination-->
    </DefaultLayout>
</template>