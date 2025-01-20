import { defineStore } from 'pinia'

export const sidebarStore = defineStore('sidebar', {
    state: () => ({
        sidebarStatus: false
    }),
    getters: {
        getSidebarStatus: (state) => state.sidebarStatus
    },
    actions: {
        setSidebarToogle() {
            this.sidebarStatus = !this.sidebarStatus
            localStorage.setItem('sidebarStatus', this.sidebarStatus)
        }
    }
})
