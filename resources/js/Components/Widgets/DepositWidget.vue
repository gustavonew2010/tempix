<style>
    .item-sombra {
            position: relative;

        }

        .item-sombra::after {
            display: none;
        }
    #placeholder-input::placeholder {
        color: white; 
    }
    .texto-valor {
        font-size: 15px;
    }
    @media (max-width:768px) {
        .loading-mobile-qr {
            margin-top: 30vh;
        }
    }
    @media (max-width:600px) {
        .texto-valor {
            font-size: 12px;
        }
        
    }

    /* Novo estilo para o modal */
    .deposit-modal {
        background: linear-gradient(145deg, #2a2d2e, #323637);
        border-radius: 16px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .amount-input {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .amount-input:focus {
        border-color: var(--ci-primary-color);
        box-shadow: 0 0 0 2px rgba(var(--ci-primary-color-rgb), 0.2);
    }

    .amount-options {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin: 16px 0;
    }

    .amount-option {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 12px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .amount-option:hover {
        background: var(--ci-primary-opacity-color);
        transform: translateY(-2px);
    }

    .amount-option.active {
        background: var(--ci-primary-color);
        border-color: var(--ci-primary-color);
        color: white;
    }

    .payment-method {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 16px;
        margin: 16px 0;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .payment-method:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .qr-code-container {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 24px;
        text-align: center;
    }

    .copy-button {
        background: var(--ci-primary-color);
        color: white;
        border-radius: 8px;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }

    .copy-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--ci-primary-color-rgb), 0.3);
    }

    @media (max-width: 768px) {
        .amount-options {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .deposit-container {
        background: linear-gradient(145deg, #2a2d2e, #323637);
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        padding: 24px;
        position: relative;
    }

    .close-button {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .close-button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    .input-with-icon {
        position: relative;
        margin: 16px 0;
    }

    .input-with-icon input {
        background: #424344;
        border-radius: 8px;
        padding: 12px 12px 12px 40px;
        width: 100%;
        border: 2px solid #424344;
        transition: border-color 0.2s ease-in-out;
    }

    .input-with-icon input:focus {
        border-color: var(--ci-primary-color);
        outline: none;
        box-shadow: 0 0 0 1px var(--ci-primary-color);
    }

    .amount-input {
        background: #424344;
        border: 2px solid #424344;
        transition: border-color 0.2s ease-in-out;
    }

    .amount-input:focus {
        border-color: var(--ci-primary-color);
        outline: none;
        box-shadow: 0 0 0 1px var(--ci-primary-color);
    }

    /* Update button style */
    .generate-button {
        width: 100%;
        background: linear-gradient(145deg, #2563eb, #3b82f6);
        color: white;
        padding: 16px;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .generate-button:hover {
        background: linear-gradient(145deg, #1d4ed8, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .generate-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    /* Add this to remove scroll arrows from number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<template>
    <div class="deposit-container">

        <!-- PIX section -->
        <div class="pix-section">
            <div v-if="!showPixQRCode">
                <form @submit.prevent="submitQRCode" class="space-y-6">
                    <!-- Cabeçalho PIX -->
                    <div class="flex items-center justify-between">
                        <img src="https://logospng.org/download/pix/logo-pix-1024.png" alt="PIX" class="h-12">
                        <div class="text-sm text-gray-400">
                            Pagamento instantâneo
                        </div>
                    </div>

                    <!-- Input de valor -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">Valor do depósito</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                R$
                            </span>
                            <input 
                                type="text"
                                v-model="deposit.amount"
                                class="amount-input w-full pl-10 pr-4 py-3 rounded-lg text-white"
                                :placeholder="$t('0,00')"
                                @input="formatAmount"
                                required
                            >
                        </div>
                    </div>

                    <!-- Opções de valor rápido -->
                    <div class="amount-options">
                        <div 
                            v-for="amount in [50, 100, 200, 500]" 
                            :key="amount"
                            @click="setAmount(amount)"
                            :class="['amount-option', {'active': selectedAmount === amount}]"
                        >
                            R$ {{ amount }},00
                        </div>
                    </div>

                    <!-- Input CPF -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-300">CPF/CNPJ</label>
                        <div class="relative">
                            <i class="fa-duotone fa-id-card absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input 
                                type="text"
                                v-model="deposit.cpf"
                                class="amount-input w-full pl-10 pr-4 py-3 rounded-lg text-white"
                                placeholder="Digite seu CPF ou CNPJ"
                                v-maska
                                data-maska="[
                                    '###.###.###-##',
                                    '##.###.###/####-##'
                                ]"
                                required
                            >
                        </div>
                    </div>

                    <!-- Botão gerar -->
                    <button 
                        type="submit" 
                        class="generate-button"
                    >
                        GERAR QR CODE PIX
                    </button>
                </form>
            </div>

            <!-- QR Code -->
            <div v-else class="qr-code-container">
                <h3 class="text-xl font-medium mb-4">Escaneie o QR Code</h3>
                <div class="max-w-[250px] mx-auto mb-6">
                    <QRCodeVue3 :value="qrcodecopypast"/>
                </div>
                <div class="space-y-4">
                    <p class="text-2xl font-bold text-green-500">
                        {{ state.currencyFormat(parseFloat(deposit.amount), wallet.currency) }}
                    </p>
                    <div class="relative">
                        <input 
                            id="pixcopiaecola"
                            type="text"
                            class="amount-input w-full px-4 py-3 rounded-lg text-white text-sm"
                            v-model="qrcodecopypast"
                            readonly
                        >
                        <button 
                            @click="copyQRCode"
                            class="copy-button mt-4 w-full"
                        >
                            Copiar código PIX
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading -->
        <div v-if="isLoading" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="text-center space-y-4">
                <div class="text-xl text-white">Gerando QR Code...</div>
                <i class="fa-duotone fa-spinner-third fa-spin text-4xl text-green-500"></i>
            </div>
        </div>
    </div>
</template>

<script>
    import {useToast} from "vue-toastification";
    import HttpApi from "@/Services/HttpApi.js";
    import QRCodeVue3 from "qrcode-vue3";
    import {useAuthStore} from "@/Stores/Auth.js";
    import { StripeCheckout } from '@vue-stripe/vue-stripe';
    import {useSettingStore} from "@/Stores/SettingStore.js";

    export default {
        props: ['showMobile', 'title', 'isFull'],
        components: { QRCodeVue3, StripeCheckout },
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
                    amount: '',
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
                amount: null,
                currency: null,
                publishableKey: null,
                sessionId: null,
                paymentGateway: '',

                initialState: {
                    showPixQRCode: false,
                    deposit: {
                        amount: '',
                        cpf: '',
                        gateway: '',
                        accept_bonus: true
                    },
                    selectedAmount: 0,
                    qrcodecopypast: '',
                    idTransaction: '',
                },

                checkingStatus: false,
                maxCheckAttempts: 60, // 5 minutos (5s * 60)
                currentAttempt: 0
            }
        },
        setup(props) {
            const toast = useToast();
            return { toast }
        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
        },
        mounted() {
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
        },
       
mounted() {
    if (this.setting.suitpay_is_enable) {
        this.setPaymentMethod('pix', 'suitpay');
    }
},

        beforeUnmount() {
            clearInterval(this.timer);
            this.paymentType = null;
        },
        methods: {
            closeModal() {
                this.resetState();
                this.isModalOpen = false;
            },

            resetState() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
                
                this.showPixQRCode = false;
                this.deposit = {
                    amount: '',
                    cpf: '',
                    gateway: 'digitopay',
                    accept_bonus: true,
                    paymentType: 'pix'
                };
                this.selectedAmount = 0;
                this.qrcodecopypast = '';
                this.idTransaction = '';
                this.checkingStatus = false;
                this.currentAttempt = 0;
            },

            getSession: function() {
                const _this = this;
                HttpApi.post('stripe/session', { amount: _this.amount, currency: _this.currency}).then(response => {
                    if(response.data.id) {
                        _this.sessionId = response.data.id;
                    }
                }).catch(error => { });
            },
            checkoutStripe: function() {
                const _toast = useToast();
                if(this.amount <= 0 || this.amount === '') {
                    _toast.error('Você precisa digitar um valor');
                    return;
                }

                this.$refs.checkoutRef.redirectToCheckout();
            },
            getPublicKeyStripe: function() {
                const _this = this;
                HttpApi.post('stripe/publickey', {}).then(response => {
                    _this.$nextTick(() => {
                        _this.publishableKey = response.data.stripe_public_key;
                        _this.elementsOptions.clientSecret  = response.data.stripe_secret_key;
                        _this.confirmParams.return_url      = response.data.successURL;
                    });

                }).catch(error => { });
            },
            setPaymentMethod: function(type, gateway) {
                if(type === 'stripe') {
                    this.getPublicKeyStripe();
                }
                this.paymentType = type;
                this.paymentGateway = gateway;
            },
            formatAmount(event) {
                // Remove any non-numeric characters except decimal point
                let value = event.target.value.replace(/[^\d.]/g, '');
                
                // Ensure only one decimal point
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                
                // Limit to 2 decimal places
                if (parts[1]?.length > 2) {
                    value = parts[0] + '.' + parts[1].slice(0, 2);
                }

                this.deposit.amount = value;
            },

            validateCPF(cpf) {
                cpf = cpf.replace(/[^\d]/g, '');
                
                if (cpf.length !== 11) return false;
                
                // Validate first digit
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf.charAt(i)) * (10 - i);
                }
                let rev = 11 - (sum % 11);
                if (rev === 10 || rev === 11) rev = 0;
                if (rev !== parseInt(cpf.charAt(9))) return false;
                
                // Validate second digit
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf.charAt(i)) * (11 - i);
                }
                rev = 11 - (sum % 11);
                if (rev === 10 || rev === 11) rev = 0;
                if (rev !== parseInt(cpf.charAt(10))) return false;
                
                return true;
            },

            validateCNPJ(cnpj) {
                cnpj = cnpj.replace(/[^\d]/g, '');
                
                if (cnpj.length !== 14) return false;
                
                // Validate first digit
                let size = cnpj.length - 2;
                let numbers = cnpj.substring(0, size);
                let digits = cnpj.substring(size);
                let sum = 0;
                let pos = size - 7;
                
                for (let i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) pos = 9;
                }
                
                let result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result !== parseInt(digits.charAt(0))) return false;
                
                // Validate second digit
                size = size + 1;
                numbers = cnpj.substring(0, size);
                sum = 0;
                pos = size - 7;
                
                for (let i = size; i >= 1; i--) {
                    sum += numbers.charAt(size - i) * pos--;
                    if (pos < 2) pos = 9;
                }
                
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result !== parseInt(digits.charAt(1))) return false;
                
                return true;
            },

            submitQRCode: function(event) {
                const _this = this;
                const _toast = useToast();

                // Validações do CPF/CNPJ
                const document = _this.deposit.cpf.replace(/[^\d]/g, '');
                
                if (!document) {
                    this.toast.error('Digite um CPF ou CNPJ válido');
                    return;
                }

                // Validar se é CPF ou CNPJ
                const documentType = document.length === 11 ? 'CPF' : 'CNPJ';
                
                // Validar o documento
                if (documentType === 'CPF' && !this.validateCPF(document)) {
                    this.toast.error('CPF inválido');
                    return;
                } else if (documentType === 'CNPJ' && !this.validateCNPJ(document)) {
                    this.toast.error('CNPJ inválido');
                    return;
                }

                // Preparar dados para envio
                const payload = {
                    amount: _this.deposit.amount,
                    cpf: _this.deposit.cpf,
                    gateway: 'digitopay',
                    accept_bonus: _this.deposit.accept_bonus,
                    paymentType: 'pix'
                };

                // Enviar para o backend
                HttpApi.post('wallet/deposit/payment', payload)
                    .then(response => {
                        if (response.data.status) {
                            _this.qrcodecopypast = response.data.qrcode;
                            _this.idTransaction = response.data.idTransaction;
                            _this.showPixQRCode = true;
                            _this.startCheckingStatus();
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao processar depósito:', error);
                        _toast.error('Erro ao processar o depósito. Tente novamente.');
                    });
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
            copyQRCode: function(event) {
                const _toast = useToast();
                var inputElement = document.getElementById("pixcopiaecola");
                inputElement.select();
                inputElement.setSelectionRange(0, 99999);  // Para dispositivos móveis

                // Copia o conteúdo para a área de transferência
                document.execCommand("copy");
                _toast.success('Pix Copiado com sucesso');
            },
            setAmount: function(amount) {
                this.deposit.amount = amount;
                this.selectedAmount = amount;
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
                    console.log('Status check response:', response); // Debug

                    // Verificar todos os possíveis status de sucesso
                    if (response.data.status === 'PAID' || 
                        response.data.status === 'approved' || 
                        response.data.status === 'completed') {
                        
                        // Parar de verificar
                        clearInterval(this.intervalId);
                        this.checkingStatus = false;
                        
                        // Notificar o usuário
                        _toast.success('Pagamento confirmado com sucesso!');
                        
                        // Atualizar a carteira do usuário
                        this.getWallet();
                        
                        // Resetar o modal
                        this.resetState();
                        
                        // Fechar o modal
                        this.isModalOpen = false;
                        
                        // Recarregar a página ou atualizar os dados necessários
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Erro ao verificar status:', error);
                });
            },

            beforeDestroy() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            }
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
            }
        },
    };
</script>

<style scoped>

</style>
