import { defineStore } from 'pinia'

export const useLoadingStore = defineStore('loading', {
    state: () => ({
        isLoading: true
    }),
    actions: {
        finishLoading() {
            this.isLoading = false;
        }
    }
}) 