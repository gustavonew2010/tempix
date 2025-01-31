import { defineStore } from 'pinia'

export const useModalStore = defineStore('modal', {
    state: () => ({
        showDepositModal: false,
        isLoading: false,
        modalType: null,
        modalData: null
    }),

    actions: {
        openDepositModal() {
            console.log('Store: Abrindo modal')
            this.showDepositModal = true
            document.body.style.overflow = 'hidden'
        },
        
        closeDepositModal() {
            console.log('Store: Fechando modal')
            this.showDepositModal = false
            document.body.style.overflow = 'auto'
            this.resetModalState()
        },

        resetModalState() {
            this.modalType = null
            this.modalData = null
            this.isLoading = false
        },

        setLoading(status) {
            this.isLoading = status
        },

        setModalData(type, data = null) {
            this.modalType = type
            this.modalData = data
        }
    },

    getters: {
        isModalOpen: (state) => state.showDepositModal,
        getModalType: (state) => state.modalType,
        getModalData: (state) => state.modalData,
        getLoadingStatus: (state) => state.isLoading
    }
}) 