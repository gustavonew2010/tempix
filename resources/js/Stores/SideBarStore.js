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
            this.sidebarStatus = !this.sidebarStatus;
        },
        setSidebarStatus(status) {
            this.sidebarStatus = status;
        }
    }
})
