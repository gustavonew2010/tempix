<template>
</template>

<script>
import UserDropdownMenu from './UserDropdownMenu.vue'
import { useSettingStore } from '@/Stores/SettingStore.js'

export default {
    name: 'UserMenu',
    components: {
        UserDropdownMenu
    },
    props: {
        userData: {
            type: Object,
            required: true
        }
    },
    computed: {
        avatarUrl() {
            return this.userData?.avatar 
                ? `/storage/${this.userData.avatar}` 
                : `/assets/images/profile.jpg`
        }
    },
    methods: {
        formatCurrency(value) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(value)
        },
        openDeposit() {
            // Emitir evento para abrir modal de depósito
            this.$emit('open-deposit')
        }
    },
    emits: ['logout', 'open-deposit']
}
</script>

