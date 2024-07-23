<script lang="ts" setup>
import { boolean } from 'yup';

    defineProps({
        class: String,
        name: { 
            required: true,
            type: String
        },
        rounded: {
            type: Boolean,
            default: false,
        }
    });    

    const iconCssClass: string = 'd-flex justify-content-center align-items-center bg-gray rounded-circle';
    const iconStyle: string = 'width: 36px; height: 36px;';
</script>

<template>
    <span 
        :class="[rounded ? iconCssClass : '', $props.class, 'material-icons']" 
        :style="[rounded ? iconStyle : '', 'line-height: .9;']"
        translate="no"
    >
        {{ name }}
    </span>
</template>