<template>
    <BaseLayout>
        <div class="withdraw-page">
            <div class="withdraw-container">
                <!-- Header com informações do saldo -->
                <div class="balance-overview-card">
                    <div class="balance-grid">
                        <div class="balance-item main-balance">
                            <div class="balance-icon">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="balance-info">
                                <span class="balance-label">Saldo Disponível</span>
                                <span class="balance-value">
                                    {{ state.currencyFormat(Number(wallet?.balance_withdrawal || 0).toFixed(2), wallet?.currency) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="balance-item">
                            <div class="balance-icon limits">
                                <i class="fa-solid fa-arrow-down-up-across-line"></i>
                            </div>
                            <div class="balance-info">
                                <span class="balance-label">Limites de Saque</span>
                                <span class="balance-value">
                                    {{ state.currencyFormat(Number(verificationData?.level?.withdrawal_limit || 0).toFixed(2), wallet?.currency) }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="balance-item">
                            <div class="balance-icon daily">
                                <i class="fa-solid fa-calendar-day"></i>
                            </div>
                            <div class="balance-info">
                                <span class="balance-label">Saque Disponível Hoje</span>
                                <span class="balance-value">
                                    {{ state.currencyFormat(Number(getDailyAvailable()).toFixed(2), wallet?.currency) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulário de Saque -->
                <div class="withdraw-form-card" :class="{ 'is-loading': isLoading }">
                    <div class="card-header">
                        <h1>Solicitar Saque</h1>
                        <p>Escolha o método de saque e preencha as informações necessárias</p>
                    </div>

                    <!-- Método PIX -->
                    <div class="pix-method-card">
                        <div class="method-header">
                            <div class="method-icon">
                                <i class="fa-solid fa-qrcode"></i>
                            </div>
                            <div class="method-info">
                                <h3>Saque via PIX</h3>
                                <p>Receba em instantes na sua conta</p>
                            </div>
                            <div class="instant-badge">
                                <i class="fa-solid fa-bolt"></i>
                                Instantâneo
                            </div>
                        </div>
                    </div>

                    <!-- Formulário -->
                    <form v-if="wallet?.currency === 'BRL'" @submit.prevent="submitWithdraw" class="withdraw-form">
                        <div class="form-grid">
                            <!-- Nome do Titular -->
                            <div class="form-group">
                                <label>Nome do Titular</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-user"></i>
                                    <input 
                                        v-model="withdraw.name"
                                        type="text"
                                        placeholder="Digite o nome completo"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Chave PIX -->
                            <div class="form-group">
                                <label>Chave PIX</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-key"></i>
                                    <input 
                                        v-model="withdraw.pix_key"
                                        v-maska
                                        data-maska="['###.###.###-##']"
                                        placeholder="Digite sua chave PIX"
                                        required
                                    >
                                </div>
                            </div>

                            <!-- Tipo de Chave -->
                            <div class="form-group">
                                <label>Tipo de Chave</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-list"></i>
                                    <select v-model="withdraw.pix_type" required>
                                        <option value="">Selecione o tipo</option>
                                        <option value="document">CPF/CNPJ</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Valor do Saque -->
                            <div class="form-group amount-group">
                                <label>Valor do Saque</label>
                                <div class="amount-input-wrapper">
                                    <div class="input-wrapper">
                                        <i class="fa-solid fa-money-bill"></i>
                                        <input 
                                            v-model="withdraw.amount"
                                            type="text"
                                            placeholder="0,00"
                                            required
                                        >
                                    </div>
                                    <div class="amount-buttons">
                                        <button @click.prevent="setMinAmount" class="amount-btn">Min</button>
                                        <button @click.prevent="setPercentAmount(50)" class="amount-btn">50%</button>
                                        <button @click.prevent="setPercentAmount(100)" class="amount-btn">100%</button>
                                        <button @click.prevent="setMaxAmount" class="amount-btn">Max</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informações Adicionais -->
                        <div class="info-section">
                            <div class="info-grid">
                                <div class="info-item">
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Processamento em até 24h</span>
                                </div>
                                <div class="info-item">
                                    <i class="fa-solid fa-shield-check"></i>
                                    <span>Transação Segura</span>
                                </div>
                                <div class="info-item">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>Suporte 24/7</span>
                                </div>
                            </div>
                        </div>

                        <!-- Termos -->
                        <div class="terms-section">
                            <label class="terms-checkbox">
                                <input 
                                    type="checkbox"
                                    v-model="withdraw.accept_terms"
                                    required
                                >
                                <span class="checkmark"></span>
                                <span class="terms-text">
                                    Aceito os termos de transferência e confirmo que os dados estão corretos
                                </span>
                            </label>
                        </div>

                        <!-- Botão Submit -->
                        <button 
                            type="submit"
                            class="submit-button"
                            :disabled="isLoading || !withdraw.accept_terms"
                        >
                            <span v-if="!isLoading">SOLICITAR SAQUE</span>
                            <i v-else class="fa-solid fa-spinner-third fa-spin"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>

import {RouterLink, useRouter} from "vue-router";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";
import HttpApi from "@/Services/HttpApi.js";
import {useToast} from "vue-toastification";
import {useSettingStore} from "@/Stores/SettingStore.js";
import VerificationService from '@/Services/VerificationService'

export default {
    props: [],
    components: {WalletSideMenu, BaseLayout, RouterLink},
    data() {
        return {
            isLoading: false,
            setting: null,
            wallet: null,
            verificationData: null,
            dailyWithdrawn: 0,
            withdraw: {
                name: '',
                pix_key: '',
                pix_type: '',
                amount: '',
                type: 'pix',
                currency: '',
                symbol: '',
                accept_terms: false
            }
        }
    },
    setup(props) {
        const router = useRouter();
        return {
            router
        };
    },
    computed: {},
    mounted() {
        window.scrollTo(0, 0);
    },
    methods: {
        getDailyAvailable() {
            const limit = this.verificationData?.level?.withdrawal_limit || 0;
            const available = Math.max(0, limit - this.dailyWithdrawn);
            return Number(available.toFixed(2));
        },
        
        async loadVerificationData() {
            try {
                const response = await VerificationService.getVerificationStatus();
                this.verificationData = response.verification;
            } catch (error) {
                console.error('Erro ao carregar dados de verificação:', error);
            }
        },

        async getDailyWithdrawn() {
            try {
                const response = await HttpApi.get('wallet/withdraw/daily-total');
                this.dailyWithdrawn = response.data.total || 0;
            } catch (error) {
                console.error('Erro ao buscar total de saques diários:', error);
            }
        },

        setMinAmount: function() {
            this.withdraw.amount = Number(20).toFixed(2);
        },
        
        setMaxAmount: function() {
            const availableDaily = this.getDailyAvailable();
            const maxAmount = Math.min(
                Number(this.wallet.balance_withdrawal),
                Number(availableDaily)
            );
            this.withdraw.amount = Number(maxAmount).toFixed(2);
        },
        
        setPercentAmount: function(percent) {
            const availableDaily = this.getDailyAvailable();
            const maxAmount = Math.min(
                Number(this.wallet.balance_withdrawal),
                Number(availableDaily)
            );
            this.withdraw.amount = Number((percent / 100) * maxAmount).toFixed(2);
        },
        getWallet: function() {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;

                    _this.withdraw.currency = response.data.wallet.currency;
                    _this.withdraw.symbol = response.data.wallet.symbol;

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
                _this.setting                   = settingData;
                _this.withdraw.amount           = settingData.min_withdrawal;
            }

            _this.isLoading                 = false;
        },
        submitWithdraw: function(event) {
            const _this = this;
            const _toast = useToast();
            
            // Validar limite diário
            const availableDaily = this.getDailyAvailable();
            if (this.withdraw.amount > availableDaily) {
                _toast.error(`Valor excede o limite diário disponível de ${this.state.currencyFormat(availableDaily, this.wallet.currency)}`);
                return;
            }

            // Validar limite do nível
            const levelLimit = this.verificationData?.level?.withdrawal_limit || 0;
            if (this.withdraw.amount > levelLimit) {
                _toast.error(`Valor excede o limite do seu nível de ${this.state.currencyFormat(levelLimit, this.wallet.currency)}`);
                return;
            }

            _this.isLoading = true;

            HttpApi.post('wallet/withdraw/request', _this.withdraw).then(response => {
                _this.isLoading = false;
                _this.withdraw = {
                    name: '',
                    pix_key: '',
                    pix_type: '',
                    amount: '',
                    type: '',
                    accept_terms: false
                }

                _this.router.push({ name: 'profileTransactions' });
                _toast.success(response.data.message);
            }).catch(error => {
                Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                    _toast.error(`${value}`);
                });
                _this.isLoading = false;
            });
        }
    },
    created() {
        this.getWallet();
        this.loadVerificationData();
        this.getDailyWithdrawn();

    },
    watch: {},
};
</script>

<style scoped>
.withdraw-page {
    @apply min-h-screen py-8 px-4;
}

.withdraw-container {
    @apply max-w-4xl mx-auto space-y-6;
}

/* Balance Overview Card */
.balance-overview-card {
    @apply rounded-2xl p-6 bg-white/5 backdrop-blur-sm border border-white/10;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
}

.balance-grid {
    @apply grid grid-cols-1 md:grid-cols-3 gap-6;
}

.balance-item {
    @apply flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10;
}

.balance-icon {
    @apply w-12 h-12 rounded-full flex items-center justify-center text-xl;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.balance-icon.bonus {
    background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);
}

.balance-icon.limits {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

.balance-info {
    @apply flex flex-col;
}

.balance-label {
    @apply text-sm text-gray-400;
}

.balance-value {
    @apply text-lg font-medium text-white;
}

/* Withdraw Form Card */
.withdraw-form-card {
    @apply rounded-2xl p-6 bg-white/5 backdrop-blur-sm border border-white/10;
}

.card-header {
    @apply mb-8 text-center;
}

.card-header h1 {
    @apply text-2xl font-bold mb-2;
    background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card-header p {
    @apply text-gray-400;
}

/* PIX Method Card */
.pix-method-card {
    @apply mb-8 p-4 rounded-xl bg-white/5 border border-white/10;
}

.method-header {
    @apply flex items-center gap-4;
}

.method-icon {
    @apply w-12 h-12 rounded-full flex items-center justify-center text-xl;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.method-info h3 {
    @apply text-lg font-medium text-white;
}

.method-info p {
    @apply text-sm text-gray-400;
}

.instant-badge {
    @apply ml-auto px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}

/* Form Styles */
.form-grid {
    @apply grid grid-cols-1 md:grid-cols-2 gap-6;
}

.form-group {
    @apply space-y-2;
}

.form-group label {
    @apply block text-sm font-medium text-gray-300;
}

.input-wrapper {
    @apply relative flex items-center;
}

.input-wrapper i {
    @apply absolute left-4 text-gray-400;
}

.input-wrapper input,
.input-wrapper select {
    @apply w-full pl-12 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500
           focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all;
}

/* Amount Input */
.amount-group {
    @apply col-span-full;
}

.amount-input-wrapper {
    @apply space-y-2;
}

.amount-buttons {
    @apply grid grid-cols-4 gap-2;
}

.amount-btn {
    @apply px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 text-sm font-medium
           hover:bg-white/10 transition-all;
}

/* Info Section */
.info-section {
    @apply mt-8 p-4 rounded-xl bg-white/5 border border-white/10;
}

.info-grid {
    @apply grid grid-cols-1 md:grid-cols-3 gap-4;
}

.info-item {
    @apply flex items-center gap-2 text-sm text-gray-400;
}

/* Terms Section */
.terms-section {
    @apply mt-6;
}

.terms-checkbox {
    @apply flex items-center gap-3 cursor-pointer;
}

.terms-text {
    @apply text-sm text-gray-400;
}

/* Submit Button */
.submit-button {
    @apply w-full mt-8 py-4 rounded-xl font-medium text-white relative overflow-hidden
           disabled:opacity-50 disabled:cursor-not-allowed transition-all;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.submit-button::before {
    content: '';
    @apply absolute inset-0 opacity-0 transition-opacity;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
}

.submit-button:not(:disabled):hover::before {
    @apply opacity-100;
}

/* Loading State */
.is-loading {
    @apply relative;
}

.is-loading::after {
    content: '';
    @apply absolute inset-0 bg-gray-900/50 backdrop-blur-sm rounded-2xl;
}

/* Animations */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.balance-item {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .withdraw-page {
        @apply py-4 px-3;
    }

    .balance-overview-card {
        @apply p-4;
    }

    .balance-grid {
        @apply grid-cols-1 gap-3;
    }

    .balance-item {
        @apply p-3;
    }

    .balance-icon {
        @apply w-10 h-10 text-lg;
    }

    .balance-value {
        @apply text-base;
    }

    .withdraw-form-card {
        @apply p-4;
    }

    .card-header {
        @apply mb-4;
    }

    .card-header h1 {
        @apply text-xl;
    }

    .card-header p {
        @apply text-sm;
    }

    .pix-method-card {
        @apply mb-4 p-3;
    }

    .method-icon {
        @apply w-10 h-10 text-lg;
    }

    .method-info h3 {
        @apply text-base;
    }

    .method-info p {
        @apply text-xs;
    }

    .form-grid {
        @apply grid-cols-1 gap-4;
    }

    .input-wrapper input,
    .input-wrapper select {
        @apply py-2.5 text-sm;
    }

    .amount-buttons {
        @apply grid-cols-2;
    }

    .amount-btn {
        @apply py-1.5 text-xs;
    }

    .info-section {
        @apply mt-4 p-3;
    }

    .info-grid {
        @apply grid-cols-1 gap-2;
    }

    .info-item {
        @apply text-xs;
    }

    .submit-button {
        @apply mt-4 py-3 text-sm;
    }

    /* Ajustes para telas muito pequenas */
    @media (max-width: 360px) {
        .balance-value {
            @apply text-sm;
        }

        .card-header h1 {
            @apply text-lg;
        }

        .method-info {
            @apply flex-1;
        }

        .instant-badge {
            @apply text-[10px] px-2;
        }
    }
}

/* Ajustes para tablets */
@media (min-width: 769px) and (max-width: 1024px) {
    .withdraw-page {
        @apply py-6 px-4;
    }

    .balance-grid {
        @apply grid-cols-2;
    }

    .form-grid {
        @apply grid-cols-1;
    }
}

/* Fix para notch e barras de navegação mobile */
@supports(padding: max(0px)) {
    .withdraw-page {
        padding-left: max(1rem, env(safe-area-inset-left));
        padding-right: max(1rem, env(safe-area-inset-right));
        padding-bottom: max(1rem, env(safe-area-inset-bottom));
    }
}

/* Melhorias de usabilidade para touch */
@media (hover: none) and (pointer: coarse) {
    .amount-btn,
    .submit-button,
    .input-wrapper input,
    .input-wrapper select {
        @apply min-h-[44px]; /* Mínimo recomendado para touch targets */
    }

    .terms-checkbox {
        @apply py-2; /* Área maior para toque */
    }
}

/* Animações otimizadas para mobile */
@media (prefers-reduced-motion: reduce) {
    .balance-item,
    .submit-button::before,
    .input-wrapper input,
    .input-wrapper select {
        @apply transition-none;
    }
}

/* Melhorias de performance */
.balance-item,
.withdraw-form-card,
.pix-method-card {
    will-change: transform;
    -webkit-font-smoothing: antialiased;
}
</style>
