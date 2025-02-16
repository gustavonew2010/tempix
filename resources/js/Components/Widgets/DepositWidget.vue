<style scoped>
.modal-backdrop {
    @apply fixed inset-0 bg-black/75 flex items-center justify-center;
    backdrop-filter: blur(4px);
    z-index: 99990;
}

.modal-container {
    @apply fixed inset-0 flex flex-col bg-[#1A1D24] overflow-hidden;
    background: linear-gradient(180deg, 
        rgba(26, 29, 36, 0.95) 0%,
        rgba(26, 29, 36, 1) 100%
    );
    z-index: 99991;
}

@media (min-width: 768px) {
    .modal-container {
        @apply relative rounded-2xl w-[480px] max-h-[90vh] m-4 overflow-y-auto;
        box-shadow: 
            0 0 0 1px rgba(255, 255, 255, 0.05),
            0 8px 32px rgba(0, 0, 0, 0.4);
    }
}

.modal-header {
    @apply sticky top-0 z-10 px-4 py-3;
    background: linear-gradient(180deg, 
        rgba(26, 29, 36, 1) 0%,
        rgba(26, 29, 36, 0.95) 100%
    );
    border-bottom: 1px solid rgba(255, 255, 255, 0.06);
    backdrop-filter: blur(8px);
}

.header-content {
    @apply flex items-center gap-3;
}

.back-button {
    @apply flex items-center justify-center w-8 h-8 rounded-lg transition-all;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.back-button:hover {
    @apply bg-white/10;
    transform: translateX(-2px);
}

.header-text {
    @apply flex-1;
}

.modal-title {
    @apply text-lg font-semibold text-white flex items-center;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.modal-subtitle {
    @apply text-xs text-gray-400 mt-0.5;
}

.close-button {
    @apply flex items-center justify-center w-8 h-8 rounded-lg ml-auto transition-all;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.close-button:hover {
    @apply bg-white/10;
    transform: scale(1.05);
}

.modal-content {
    @apply flex-1 overflow-y-auto;
}

.modal-enter-active,
.modal-leave-active {
    transition: all 0.3s ease-out;
}

.modal-enter-from {
    opacity: 0;
    transform: scale(0.95);
}

.modal-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

@media (max-width: 768px) {
    .modal-header {
        @apply py-4;
    }

    .modal-title {
        @apply text-base;
    }
}

.wallet-icon {
    @apply mr-2 text-lg;
    color: #00A2D4;
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}

@supports not (background-clip: text) {
    .wallet-icon {
        color: #00A2D4;
        -webkit-text-fill-color: currentColor;
    }
}

.confirmation-modal {
    @apply fixed inset-0 flex items-center justify-center;
    background: rgba(0, 0, 0, 0.9);
    z-index: 99992;
}

.confirmation-content {
    @apply bg-[#1A1D24] p-6 rounded-xl max-w-sm w-full mx-4 relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 99993;
}

.confirmation-content h3 {
    @apply text-lg font-semibold text-white mb-2;
}

.confirmation-content p {
    @apply text-sm text-gray-400 mb-6;
}

.confirmation-buttons {
    @apply flex gap-3;
}

.confirm-btn {
    @apply flex-1 py-2.5 px-4 rounded-lg text-gray-400 text-sm font-medium transition-all;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: transparent;
}

.confirm-btn:hover {
    @apply text-white bg-white/5;
}

.cancel-btn {
    @apply flex-1 py-2.5 px-4 rounded-lg text-white text-sm font-medium transition-all;
    background: linear-gradient(135deg, #00A2D4, #0072ff);
}

.cancel-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 114, 255, 0.2);
}

/* Animações */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}

/* Animação do conteúdo do modal */
.confirmation-content {
    animation: modal-pop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes modal-pop {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<template>
    <Transition name="modal">
        <div v-if="modalStore.showDepositModal" class="modal-backdrop">
            <Transition name="fade">
                <div v-if="showCloseConfirmation" class="confirmation-modal">
                    <div class="confirmation-content">
                        <h3>Cancelar pagamento?</h3>
                        <p>Se você sair agora, o código PIX será invalidado.</p>
                        <div class="confirmation-buttons">
                            <button @click="confirmClose" class="confirm-btn">
                                Sim, cancelar
                            </button>
                            <button @click="showCloseConfirmation = false" class="cancel-btn">
                                Continuar pagamento
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>

            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <div class="header-content">
                        <button 
                            v-if="showPixQRCode" 
                            @click="goBack" 
                            class="back-button"
                            aria-label="Voltar"
                        >
                            <i class="fa-light fa-arrow-left"></i>
                        </button>
                        <div class="header-text">
                            <h2 class="modal-title">
                                <i class="fa-duotone fa-wallet wallet-icon"></i>
                                {{ showPixQRCode ? 'Pagamento PIX' : 'Depositar' }}
                            </h2>
                            <p class="modal-subtitle">
                                {{ showPixQRCode ? 'Escaneie o QR Code para pagar' : 'Adicione saldo à sua conta' }}
                            </p>
                        </div>
                    </div>
                    <button 
                        @click="handleClose" 
                        class="close-button"
                        aria-label="Fechar"
                    >
                        <i class="fa-light fa-xmark"></i>
                    </button>
                </div>

                <div class="modal-content">
                    <AmountStep
                        v-if="!showPixQRCode"
                        v-model:amount="amount"
                        :is-loading="isLoading"
                        :quick-values="quickValues"
                        @submit="submitDeposit"
                    />

                    <PixStep
                        v-else
                        :qr-code="qrcodecopypast"
                        :amount="amount"
                        :minutes="minutes"
                        :seconds="seconds"
                    />
                </div>
            </div>
        </div>
    </Transition>
</template>


<script>
    import {useToast} from "vue-toastification";
    import HttpApi from "@/Services/HttpApi.js";
    import QRCodeVue3 from "qrcode-vue3";
    import {useAuthStore} from "@/Stores/Auth.js";
    import { StripeCheckout } from '@vue-stripe/vue-stripe';
    import {useSettingStore} from "@/Stores/SettingStore.js";
    import { useModalStore } from '@/Stores/ModalStore'
    import { defineComponent } from 'vue'
    import { storeToRefs } from 'pinia'
    import AmountStep from './Steps/AmountStep.vue'
    import PixStep from './Steps/PixStep.vue'

    export default defineComponent({
        name: 'DepositWidget',
        props: {
            isMobile: {
                type: Boolean,
                default: () => window.innerWidth <= 768
            }
        },
        components: { QRCodeVue3, StripeCheckout, AmountStep, PixStep },
        data() {
            return {
                isModalOpen: true,
                isLoading: false,
                minutes: 15,
                seconds: 0,
                timer: null,
                setting: null,
                wallet: null,
                deposit: {
                    amount: 0,
                    cpf: '',
                    gateway: 'digitopay',
                    accept_bonus: true,
                    paymentType: 'pix'
                },
                selectedAmount: 0,
                showPixQRCode: false,
                qrcodecopypast: '',
                idTransaction: '',
                intervalId: null,
                paymentType: null,

                /// stripe
                elementsOptions: {
                    appearance: {}, // appearance options
                },
                confirmParams: {
                    return_url: null, // success url
                },
                successURL: null,
                cancelURL: null,
                amount: 0,
                currency: null,
                publishableKey: null,
                sessionId: null,
                paymentGateway: '',

                initialState: {
                    showPixQRCode: false,
                    deposit: {
                        amount: 0,
                        cpf: '',
                        gateway: 'digitopay',
                        accept_bonus: true,
                        paymentType: 'pix'
                    },
                    selectedAmount: 0,
                    qrcodecopypast: '',
                    idTransaction: '',
                },

                checkingStatus: false,
                maxCheckAttempts: 60, // 5 minutos (5s * 60)
                currentAttempt: 0,
                useBonus: false,
                bonusCode: '',
                bonusAmount: 0,
                totalAmount: 0,
                quickValues: [
                    { amount: 50, tag: { type: 'popular', text: 'POPULAR' } },
                    { amount: 100, tag: { type: 'bonus', text: '+10%' } },
                    { amount: 200, tag: null },
                    { amount: 500, tag: { type: 'best', text: 'BEST DEAL' } },
                    { amount: 1000, tag: { type: 'hot', text: 'HOT' } },
                    { amount: 2000, tag: { type: 'bonus', text: '+20%' } }
                ],
                showCloseConfirmation: false,
            }
        },
        setup(props) {
            const toast = useToast();
            const modalStore = useModalStore()
            const authStore = useAuthStore()
            const { user } = storeToRefs(authStore)
            console.log('DepositWidget mounted, modalStore:', modalStore)
            return { toast, modalStore, user }
        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
            
            isFormValid() {
                return this.deposit.amount && parseFloat(this.deposit.amount) > 0
            },
            
            isValidDocument() {
                const document = this.deposit.cpf.replace(/[^\d]/g, '');
                if (document.length === 11) {
                    return this.validateCPF(document);
                } else if (document.length === 14) {
                    return this.validateCNPJ(document);
                }
                return false;
            },
            formattedTimer() {
                const minutes = String(this.minutes).padStart(2, '0');
                const seconds = String(this.seconds).padStart(2, '0');
                return `${minutes}:${seconds}`;
            },
            bonusAmount() {
                return this.useBonus ? 0 : this.amount * 0.1
            },
            totalAmount() {
                return this.amount + this.bonusAmount
            },
            isValid() {
                return this.amount >= 10
            }
        },
        mounted() {
            // Garantir que o valor inicial é 0
            this.amount = 0
            this.deposit.amount = 0
            this.selectedAmount = 0
            
            if (this.setting.suitpay_is_enable) {
                this.setPaymentMethod('pix', 'suitpay');
            }

            // Store initial state when component is mounted
            this.initialState = {
                showPixQRCode: this.showPixQRCode,
                deposit: { ...this.deposit },
                selectedAmount: this.selectedAmount,
                qrcodecopypast: this.qrcodecopypast,
                idTransaction: this.idTransaction,
            };

            // Garantir que o gateway e paymentType estejam sempre definidos
            this.deposit.gateway = 'digitopay';
            this.deposit.paymentType = 'pix';

            // Detectar mobile/desktop
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth <= 768;
            });

            // Preencher o CPF/CNPJ do usuário logado
            if (this.user?.document) {
                this.deposit.cpf = this.user.document
            }
        },
        beforeUnmount() {
            clearInterval(this.timer);
            this.paymentType = null;
            this.modalStore.closeDepositModal()
        },
        methods: {
            handleClose() {
                if (this.showPixQRCode) {
                    this.showCloseConfirmation = true
                } else {
                    this.modalStore.closeDepositModal()
                }
            },
            
            confirmClose() {
                this.showCloseConfirmation = false
                this.resetState()
                this.modalStore.closeDepositModal()
            },

            resetState() {
                this.showPixQRCode = false
                this.qrcodecopypast = ''
                this.amount = 0
                this.idTransaction = ''
                if (this.timer) {
                    clearInterval(this.timer)
                }
                if (this.intervalId) {
                    clearInterval(this.intervalId)
                }
            },

            goBack() {
                this.showPixQRCode = false
                this.qrcodecopypast = ''
            },

            async submitDeposit() {
                const _this = this;
                const _toast = useToast();

                if (_this.amount < 10) {
                    _toast.error('O valor mínimo para depósito é R$ 10');
                    return;
                }

                _this.isLoading = true;

                try {
                    const payload = {
                        amount: _this.amount,
                        cpf: '40392373823',
                        gateway: 'digitopay',
                        accept_bonus: _this.deposit.accept_bonus,
                        paymentType: 'pix'
                    };

                    const response = await HttpApi.post('wallet/deposit/payment', payload);
                    
                    if (response.data.status) {
                        _this.qrcodecopypast = response.data.qrcode;
                        _this.idTransaction = response.data.idTransaction;
                        _this.showPixQRCode = true;
                        _this.startTimer();
                        _this.startCheckingStatus();
                        _toast.success('QR Code PIX gerado com sucesso!');
                    } else {
                        _toast.error(response.data.message || 'Erro ao gerar o PIX');
                    }
                } catch (error) {
                    console.error('Erro ao processar depósito:', error);
                    _toast.error(error.response?.data?.message || 'Erro ao processar o depósito. Tente novamente.');
                } finally {
                    _this.isLoading = false;
                }
            },
            checkTransactions: function(idTransaction) {
                const _this = this;
                const _toast = useToast();

                HttpApi.post(_this.paymentGateway+'/consult-status-transaction', { idTransaction: idTransaction }).then(response => {
                    _toast.success('Pedido concluído com sucesso');
                    clearInterval(_this.intervalId);
                }).catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        // _toast.error(`${value}`);
                    });
                });
            },
            copyQRCode() {
                const input = document.getElementById('pixcopiaecola');
                input.select();
                document.execCommand('copy');
                
                const toast = useToast();
                toast.success('Código PIX copiado!');
            },
            setAmount: function(amount) {
                this.deposit.amount = amount
                this.selectedAmount = amount
                this.calculateTotal()
            },
            getWallet: function() {
                const _this = this;
                const _toast = useToast();
                _this.isLoadingWallet = true;

                HttpApi.get('profile/wallet')
                    .then(response => {
                        _this.wallet = response.data.wallet;
                        _this.currency = response.data.wallet.currency;
                        _this.isLoadingWallet = false;
                    })
                    .catch(error => {
                        const _this = this;
                        Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                            _toast.error(`${value}`);
                        });
                        _this.isLoadingWallet = false;
                    });
            },
            getSetting: function() {
                const _this = this;
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;

                if(settingData) {
                    _this.setting = settingData;
                    _this.amount  = settingData.max_deposit;

                    if(_this.paymentType === 'stripe' && settingData.stripe_is_enable) {
                        _this.getSession();
                    }
                }
            },
            startCheckingStatus() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }

                this.currentAttempt = 0;
                this.checkingStatus = true;

                // Verificar a cada 5 segundos
                this.intervalId = setInterval(() => {
                    this.checkTransactionStatus();
                }, 5000);
            },

            checkTransactionStatus() {
                const _this = this;
                const _toast = useToast();

                if (!this.idTransaction || this.currentAttempt >= this.maxCheckAttempts) {
                    clearInterval(this.intervalId);
                    this.checkingStatus = false;
                    return;
                }

                this.currentAttempt++;

                HttpApi.post('digitopay/consult-status-transaction', {
                    idTransaction: this.idTransaction
                })
                .then(response => {
                    if (response.data.status === 'PAID' || 
                        response.data.status === 'approved' || 
                        response.data.status === 'completed') {
                        
                        clearInterval(this.intervalId);
                        this.checkingStatus = false;
                        _toast.success('Pagamento confirmado com sucesso!');
                        this.getWallet();
                        this.resetState();
                        this.modalStore.closeDepositModal();
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Erro ao verificar status:', error);
                });
            },

            startTimer() {
                this.minutes = 15;
                this.seconds = 0;
                
                if (this.timer) {
                    clearInterval(this.timer);
                }
                
                this.timer = setInterval(() => {
                    if (this.seconds > 0) {
                        this.seconds--;
                    } else if (this.minutes > 0) {
                        this.minutes--;
                        this.seconds = 59;
                    } else {
                        clearInterval(this.timer);
                        this.handleExpiration();
                    }
                }, 1000);
            },
            
            handleExpiration() {
                this.toast.error('O tempo para pagamento expirou. Por favor, gere um novo código.');
                this.resetState(); // Método que já existe para resetar o estado
            },

            calculateTotal() {
                const amount = parseFloat(this.deposit.amount) || 0
                this.bonusAmount = this.useBonus && this.bonusCode ? amount * 0.1 : 0
                this.totalAmount = amount + this.bonusAmount
            },

            selectAmount(value) {
                this.amount = value
            },
            formatPrice(value) {
                return value ? value.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) : 'R$ 0'
            },
            processDeposit() {
                if (this.amount < 10) {
                    this.toast.error('O valor mínimo para depósito é R$ 10,00')
                    return
                }
                // ... lógica do depósito ...
            },
            openBankApp(bank) {
                if (this.isMobile) {
                    // Tenta abrir o deep link do banco
                    window.location.href = bank.deepLink;
                    
                    // Fallback para loja de apps após um pequeno delay
                    setTimeout(() => {
                        if (this.isIOS && bank.appStoreUrl) {
                            window.location.href = bank.appStoreUrl;
                        } else if (this.isAndroid && bank.playStoreUrl) {
                            window.location.href = bank.playStoreUrl;
                        }
                    }, 1000);
                }
            },
            formatAmount(event) {
                let value = event.target.value.replace(/[^\d]/g, '')
                if (!value) {
                    this.amount = 0
                    return
                }
                this.amount = parseInt(value)
            },
        },
        created() {
            if(this.isAuthenticated) {
                this.getWallet();
                this.getSetting();

                if(this.paymentType === 'stripe') {
                    this.getSession();
                    this.currency = 'USD';
                }
            }
        },
        watch: {
            amount(oldValue, newValue) {
                if(this.paymentType === 'stripe') {
                    this.getSession();
                    this.currency = 'USD';
                }

            },
            currency(oldValue, newValue) {
                if(this.paymentType === 'stripe') {
                    this.getSession();
                }
            },
            isModalOpen(newValue) {
                if (!newValue) {
                    this.resetState();
                }
            },
            useBonus() {
                this.calculateTotal()
            },
            bonusCode() {
                this.calculateTotal()
            }
        },
        beforeUnmount() {
            if (this.timer) {
                clearInterval(this.timer);
            }
            if (this.intervalId) {
                clearInterval(this.intervalId);
            }
        }
    });
</script>
