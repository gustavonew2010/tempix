<template>
    <div class="flex items-center justify-start" style="align-items: center">
        <button id="open-side-nav" 
                @click.prevent="$emit('toggle-menu')" 
                type="button" 
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg" 
                style="margin: 0 auto">
            <span class="sr-only">Open sidebar</span>
            <svg height="22px" viewBox="0 0 448 512" width="22px" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" fill="#fff"/>
            </svg>
        </button>

        <a v-if="setting" href="/" class="flex md:ml-2 ml:1 md:mr-24 align-items">
            <img :src="`/storage/${setting.software_logo_black}`" alt="" class="h-8 block dark:hidden imagem-logo" />
            <img :src="`/storage/${setting.software_logo_white}`" alt="" class="md:max-h-[35px] max-h-[30px] hidden dark:block imagem-logo" />
        </a>
    </div>
</template>

<script>
export default {
    name: 'NavBrand',
    props: {
        setting: {
            type: Object,
            default: null
        }
    },
    emits: ['toggle-menu']
}
</script> 