import { defineStore } from 'pinia'

export const sidebarStore = defineStore('sidebar', {
    state: () => ({
        // Ajustando para usar o mesmo breakpoint de 1024px
        sidebarStatus: window.innerWidth > 1024
    }),
    getters: {
        getSidebarStatus: (state) => state.sidebarStatus
    },
    actions: {
        setSidebarStatus(status) {
            this.sidebarStatus = status;
            console.log('Store: Sidebar status atualizado para:', status);
        },
        
        initializeSidebarStatus() {
            const status = window.innerWidth > 1024;
            this.sidebarStatus = status;
            console.log('Store: Sidebar status inicializado como:', status);
        }
    },
    persist: true // Adiciona persistência ao estado
})
