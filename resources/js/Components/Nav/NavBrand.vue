<template>
    <div class="flex items-center">
        <button @click="$emit('toggle-menu')" id="open-side-nav" class="lg:hidden">
            <i class="fa-solid fa-bars text-white text-xl"></i>
        </button>
        
        <a href="#" 
           @click.prevent="handleLogoClick" 
           class="flex items-center transition-opacity duration-200 hover:opacity-80">
            <img v-if="setting" 
                 :src="`/storage/${setting.software_logo_white}`" 
                 alt="Logo" 
                 class="h-8">
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