<template>
    <div class="flex items-center">
        <a href="#" 
           @click.prevent="handleLogoClick" 
           class="flex items-center transition-opacity duration-200 hover:opacity-80">
            <img v-if="setting" 
                 :src="`/storage/${setting.software_logo_white}`" 
                 alt="Logo" 
                 class="h-6">
        </a>
    </div>
</template>

<script>
export default {
    name: 'NavBrand',
    
    props: {
        setting: {
            type: Object,
            required: true
        }
    },

    emits: ['toggle-menu', 'navigate-home'],

    methods: {
        handleLogoClick(event) {
            this.$emit('navigate-home', event)
        }
    }
}
</script> 