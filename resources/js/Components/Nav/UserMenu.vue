<template>
    <div class="flex items-center">
        <!-- Botão Depositar -->
        <button @click="openDeposit" 
                class="ui-button-blue flex flex-row items-center botao-entrar-mobile">
            <i class="fa-duotone fa-wallet pr-2"></i>
            {{ $t('Depositar') }}
        </button>

        <!-- Saldo -->
        <div class="flex items-center ml-3">
            <div class="text-sm">
                <p class="text-gray-500 dark:text-gray-400">Saldo</p>
                <p class="text-lg font-semibold">
                    {{ formatCurrency(userData?.wallet?.balance || 0) }}
                </p>
            </div>
        </div>
        
        <div class="flex items-center ml-3 margin-teste">
            <div>
                <button type="button" 
                        class="flex text-sm bg-[white] rounded-full ui-button-blue3" 
                        aria-expanded="false" 
                        data-dropdown-toggle="dropdown-user2">
                    <span class="sr-only">Open user menu</span>
                    <img :src="avatarUrl" 
                         alt="avatar" 
                         class="w-5 h-5 rounded-full">
                </button>
            </div>
            <UserDropdownMenu @logout="$emit('logout')" />
        </div>
    </div>
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

<style scoped>
@import './styles/nav.css';
</style> 