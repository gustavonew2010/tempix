<style>
.wallet-page {
    @apply min-h-screen py-8 px-4 md:px-6;
}

.wallet-container {
    @apply max-w-6xl mx-auto space-y-8;
}

/* Card Principal */
.main-balance-card {
    @apply rounded-2xl p-8;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
    border: 1px solid rgba(59, 130, 246, 0.2);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
}

.balance-header {
    @apply flex flex-col md:flex-row justify-between items-start md:items-center gap-6;
}

.balance-info h2 {
    @apply text-gray-400 text-sm font-medium mb-2;
}

.balance-amount {
    @apply text-4xl md:text-5xl font-bold mb-2;
    background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.bonus-amount {
    @apply flex items-center gap-2 text-gray-400 text-sm;
}

.balance-actions {
    @apply flex flex-col sm:flex-row gap-4 w-full md:w-auto;
}

.action-button {
    @apply flex items-center justify-center gap-3 px-6 py-3 rounded-xl font-medium transition-all duration-300
           min-w-[160px] relative overflow-hidden;
}

.action-button::before {
    content: '';
    @apply absolute inset-0 opacity-0 transition-opacity duration-300;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
}

.action-button:hover::before {
    @apply opacity-100;
}

.action-button.deposit {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    @apply text-white shadow-lg shadow-blue-500/25;
}

.action-button.withdraw {
    @apply bg-white/10 text-white backdrop-blur-sm;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Transactions Card */
.transactions-card {
    @apply rounded-2xl bg-white/5 backdrop-blur-sm overflow-hidden;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.transactions-header {
    @apply p-6 border-b border-white/10;
}

.tab-buttons {
    @apply flex gap-6;
}

.tab-button {
    @apply flex items-center gap-2 px-4 py-2 text-gray-400 relative transition-all duration-300;
}

.tab-button.active {
    @apply text-blue-500;
}

.tab-indicator {
    @apply absolute bottom-0 left-0 w-full h-0.5 scale-x-0 transition-transform duration-300;
    background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);
}

.tab-button.active .tab-indicator {
    @apply scale-x-100;
}

.transactions-content {
    @apply p-6;
}

.transactions-list {
    @apply space-y-4;
}

.transaction-item {
    @apply flex items-center justify-between p-4 rounded-xl transition-all duration-300
           hover:bg-white/5 border border-transparent hover:border-white/10;
}

.transaction-info {
    @apply flex items-center gap-4;
}

.transaction-icon {
    @apply w-10 h-10 rounded-full flex items-center justify-center;
}

.transaction-icon.success {
    @apply bg-green-500/10 text-green-500;
}

.transaction-icon.pending {
    @apply bg-yellow-500/10 text-yellow-500;
}

.transaction-details {
    @apply flex flex-col;
}

.transaction-date {
    @apply text-sm text-gray-300;
}

.transaction-status {
    @apply text-xs text-gray-400;
}

.transaction-amount {
    @apply text-lg font-medium;
}

.transaction-amount.success {
    @apply text-green-500;
}

.transaction-amount.pending {
    @apply text-yellow-500;
}

.empty-state {
    @apply flex flex-col items-center justify-center py-16 text-center;
}

.empty-state i {
    @apply text-4xl mb-4 text-gray-400;
}

.empty-state p {
    @apply text-lg text-gray-300 mb-1;
}

.empty-state span {
    @apply text-sm text-gray-400;
}

/* Animations */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(10px);
}

@media (max-width: 768px) {
    .wallet-page {
        @apply py-4 px-3;
    }

    .main-balance-card {
        @apply p-4;
    }

    .balance-header {
        @apply flex-col gap-4;
    }

    .balance-info {
        @apply w-full text-center;
    }

    .balance-amount {
        @apply text-3xl;
    }

    .quick-stats {
        @apply grid-cols-1 gap-3;
    }

    .stat-item {
        @apply p-3;
    }

    .info-cards-grid {
        @apply grid-cols-1 gap-4;
    }

    .info-card {
        @apply p-4 flex-col text-center;
    }

    .info-card-icon {
        @apply mx-auto mb-3;
    }

    .transactions-card {
        @apply p-4;
    }

    .tab-buttons {
        @apply overflow-x-auto pb-2;
        -webkit-overflow-scrolling: touch;
    }

    .tab-button {
        @apply whitespace-nowrap px-3 py-2 text-sm;
    }

    .transaction-item {
        @apply flex-col gap-3 p-3;
    }

    .transaction-info {
        @apply w-full justify-between;
    }

    .transaction-amount {
        @apply text-base;
    }

    /* Ajustes para telas muito pequenas */
    @media (max-width: 360px) {
        .balance-amount {
            @apply text-2xl;
        }

        .stat-value {
            @apply text-sm;
        }

        .info-card h3 {
            @apply text-base;
        }
    }
}

/* Ajustes para tablets */
@media (min-width: 769px) and (max-width: 1024px) {
    .wallet-page {
        @apply py-6 px-4;
    }

    .info-cards-grid {
        @apply grid-cols-2;
    }

    .quick-stats {
        @apply grid-cols-2;
    }
}

/* Fix para notch e barras de navegação mobile */
@supports(padding: max(0px)) {
    .wallet-page {
        padding-left: max(1rem, env(safe-area-inset-left));
        padding-right: max(1rem, env(safe-area-inset-right));
        padding-bottom: max(1rem, env(safe-area-inset-bottom));
    }
}

/* Melhorias de usabilidade para touch */
@media (hover: none) and (pointer: coarse) {
    .tab-button,
    .action-button {
        @apply min-h-[44px];
    }

    .transaction-item {
        @apply py-3;
    }
}

/* Otimizações de performance */
.transaction-item,
.info-card,
.stat-item {
    will-change: transform;
    -webkit-font-smoothing: antialiased;
}

/* Scrolling suave em iOS */
.transactions-content {
    -webkit-overflow-scrolling: touch;
}

/* Ajustes de fonte para melhor legibilidade em mobile */
@media screen and (max-width: 768px) {
    .balance-details,
    .transaction-date,
    .transaction-status {
        @apply text-xs;
    }

    .stat-label,
    .info-card p {
        @apply text-xs;
    }
}

/* Melhorias de acessibilidade para touch */
@media (hover: none) {
    .action-button,
    .tab-button {
        @apply active:opacity-70;
    }
}

/* Loading States */
.is-loading {
    position: relative;
}

.is-loading::after {
    display: none;
}

.skeleton-card-content {
    @apply flex gap-4 w-full;
}

.skeleton-icon {
    @apply w-12 h-12 rounded-full flex-shrink-0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
}

.skeleton-text-group {
    @apply flex-1 space-y-4;
}

.skeleton-title {
    @apply h-6 rounded-lg w-32;
    background: rgba(255, 255, 255, 0.05);
}

.skeleton-text {
    @apply h-4 rounded-lg w-24;
    background: rgba(255, 255, 255, 0.05);
}

.skeleton-progress {
    @apply h-2 rounded-full w-full mt-6;
    background: rgba(255, 255, 255, 0.05);
}

.skeleton-limit {
    @apply h-5 rounded-lg w-full flex items-center justify-between;
    background: rgba(255, 255, 255, 0.05);
}

/* Animação suave de pulse */
.is-loading .skeleton-icon,
.is-loading .skeleton-title,
.is-loading .skeleton-text,
.is-loading .skeleton-progress,
.is-loading .skeleton-limit {
    position: relative;
    overflow: hidden;
}

.is-loading .skeleton-icon::after,
.is-loading .skeleton-title::after,
.is-loading .skeleton-text::after,
.is-loading .skeleton-progress::after,
.is-loading .skeleton-limit::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform: translateX(-100%);
    background-image: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255, 255, 255, 0.05) 50%,
        transparent 100%
    );
    animation: shimmer 2s infinite ease-out;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

/* Quick Stats */
.quick-stats {
    @apply grid grid-cols-1 sm:grid-cols-2 gap-4 w-full md:w-auto mt-6 md:mt-0;
}

.stat-item {
    @apply flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10;
}

.stat-icon {
    @apply w-12 h-12 rounded-full flex items-center justify-center text-xl;
}

.stat-icon.deposits {
    @apply bg-green-500/10 text-green-500;
}

.stat-icon.withdraws {
    @apply bg-blue-500/10 text-blue-500;
}

.stat-info {
    @apply flex flex-col;
}

.stat-label {
    @apply text-sm text-gray-400;
}

.stat-value {
    @apply text-lg font-medium text-white;
}

/* Info Cards */
.info-cards-grid {
    @apply grid grid-cols-1 md:grid-cols-2 gap-6 mt-6;
}

.info-card {
    @apply flex gap-4 p-6 rounded-2xl bg-white/5 border border-white/10;
}

.info-card-icon {
    @apply w-12 h-12 rounded-full flex items-center justify-center text-xl;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
}

.info-card-content {
    @apply flex-1;
}

.info-card-content h3 {
    @apply text-lg font-medium mb-2;
}

.verification-progress {
    @apply mt-4;
}

.progress-bar {
    @apply h-2 bg-white/10 rounded-full overflow-hidden mb-2;
}

.progress {
    @apply h-full bg-green-500;
}

.limits-info {
    @apply space-y-2 mt-2;
}

.limit-item {
    @apply flex justify-between items-center text-sm;
}

.limit-item span {
    @apply text-gray-400;
}

.limit-item strong {
    @apply text-white;
}

/* Balance Details */
.balance-details {
    @apply flex flex-col gap-2 mt-4;
}

.detail-item {
    @apply flex items-center gap-2 text-sm text-gray-400;
}

/* Skeleton para os Stats */
.skeleton-stat-content {
    @apply flex items-center gap-4 w-full;
}

.skeleton-stat-icon {
    @apply w-12 h-12 rounded-full flex-shrink-0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
}

.skeleton-stat-info {
    @apply flex flex-col gap-2 flex-1;
}

.skeleton-stat-label {
    @apply h-4 rounded-lg w-24;
    background: rgba(255, 255, 255, 0.05);
}

.skeleton-stat-value {
    @apply h-6 rounded-lg w-32;
    background: rgba(255, 255, 255, 0.05);
}

/* Aplicar a mesma animação de shimmer */
.is-loading .skeleton-stat-icon::after,
.is-loading .skeleton-stat-label::after,
.is-loading .skeleton-stat-value::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform: translateX(-100%);
    background-image: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255, 255, 255, 0.05) 50%,
        transparent 100%
    );
    animation: shimmer 2s infinite ease-out;
}
</style>
<template>
    <BaseLayout>
        <div class="wallet-page">
            <div class="wallet-container">
                <!-- Card Principal -->
                <div class="main-balance-card" :class="{ 'is-loading': isPageLoading }">
                    <div class="balance-header">
                        <div class="balance-info">
                            <h2>Saldo Total</h2>
                            <div class="balance-amount" v-if="!isPageLoading">
                                {{ state.currencyFormat(wallet?.total_balance || 0, wallet?.currency || 'BRL') }}
                            </div>
                            <div class="skeleton-text" v-else></div>
                            
                        </div>

                        <div class="quick-stats">
                            <!-- Total Depositado -->
                            <div class="stat-item" :class="{ 'is-loading': isPageLoading }">
                                <template v-if="!isPageLoading">
                                    <div class="stat-icon deposits">
                                        <i class="fa-solid fa-arrow-down"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">Total Depositado</span>
                                        <span class="stat-value">{{ state.currencyFormat(totalDeposits || 0, wallet?.currency || 'BRL') }}</span>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="skeleton-stat-content">
                                        <div class="skeleton-stat-icon"></div>
                                        <div class="skeleton-stat-info">
                                            <div class="skeleton-stat-label"></div>
                                            <div class="skeleton-stat-value"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Total Retirado -->
                            <div class="stat-item" :class="{ 'is-loading': isPageLoading }">
                                <template v-if="!isPageLoading">
                                    <div class="stat-icon withdraws">
                                        <i class="fa-solid fa-arrow-up"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">Total Retirado</span>
                                        <span class="stat-value">{{ state.currencyFormat(totalWithdraws || 0, wallet?.currency || 'BRL') }}</span>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="skeleton-stat-content">
                                        <div class="skeleton-stat-icon"></div>
                                        <div class="skeleton-stat-info">
                                            <div class="skeleton-stat-label"></div>
                                            <div class="skeleton-stat-value"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="balance-actions">
                            <button @click="openDeposit" class="action-button deposit">
                                <i class="fas fa-wallet"></i>
                                <span>Depositar</span>
                            </button>
                            <RouterLink :to="{ name: 'profileWithdraw' }" class="action-button withdraw">
                                <i class="fas fa-money-bill-transfer"></i>
                                <span>Sacar</span>
                            </RouterLink>
                        </div>
                    </div>
                </div>

                <!-- Cards de Informação -->
                <div class="info-cards-grid">
                    <!-- Status da Conta Card -->
                    <div class="info-card verification-status" :class="{ 'is-loading': isPageLoading }">
                        <template v-if="!isPageLoading">
                            <div class="info-card-icon">
                                <i class="fa-solid fa-shield-check"></i>
                            </div>
                            <div class="info-card-content">
                                <h3>Status da Conta</h3>
                                <p>Conta Verificada</p>
                                <div class="verification-progress">
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 100%"></div>
                                    </div>
                                    <span>100% Completo</span>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="skeleton-card-content">
                                <div class="skeleton-icon"></div>
                                <div class="skeleton-text-group">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-text"></div>
                                    <div class="skeleton-progress"></div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Limites Card -->
                    <div class="info-card limits" :class="{ 'is-loading': isPageLoading }">
                        <template v-if="!isPageLoading">
                            <div class="info-card-icon">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="info-card-content">
                                <h3>Limites da Conta</h3>
                                <div class="limits-info">
                                    <div class="limit-item">
                                        <span>Depósito Mínimo:</span>
                                        <strong>R$ 20,00</strong>
                                    </div>
                                    <div class="limit-item">
                                        <span>Saque Mínimo:</span>
                                        <strong>R$ 50,00</strong>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="skeleton-card-content">
                                <div class="skeleton-icon"></div>
                                <div class="skeleton-text-group">
                                    <div class="skeleton-title"></div>
                                    <div class="skeleton-limit"></div>
                                    <div class="skeleton-limit"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Histórico de Transações -->
                <div class="transactions-card" :class="{ 'is-loading': isPageLoading }">
                    <div class="transactions-header">
                        <div class="tab-buttons">
                            <button 
                                v-for="tab in ['withdraws', 'deposits']"
                                :key="tab"
                                @click="activeTab = tab"
                                :class="['tab-button', { active: activeTab === tab }]"
                            >
                                <i :class="tab === 'withdraws' ? 'fa-solid fa-money-bill-transfer' : 'fa-solid fa-wallet'"></i>
                                {{ tab === 'withdraws' ? 'Saques' : 'Depósitos' }}
                                <div class="tab-indicator"></div>
                            </button>
                        </div>
                    </div>

                    <Transition name="fade" mode="out-in">
                        <div class="transactions-content" :key="activeTab">
                            <!-- Lista de Transações -->
                            <div v-if="getActiveTransactions.length" class="transactions-list">
                                <div v-for="transaction in getActiveTransactions" 
                                     :key="transaction.id" 
                                     class="transaction-item">
                                    <div class="transaction-info">
                                        <div class="transaction-icon" :class="transaction.status === 1 ? 'success' : 'pending'">
                                            <i :class="transaction.status === 1 ? 'fa-solid fa-check' : 'fa-solid fa-clock'"></i>
                                        </div>
                                        <div class="transaction-details">
                                            <span class="transaction-date">{{ transaction.dateHumanReadable }}</span>
                                            <span class="transaction-status">
                                                {{ transaction.status === 1 ? 'Confirmado' : 'Processando' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="transaction-amount" :class="transaction.status === 1 ? 'success' : 'pending'">
                                        {{ state.currencyFormat(parseFloat(transaction.amount), transaction.currency) }}
                                    </div>
                                </div>
                            </div>

                            <!-- Estado Vazio -->
                            <div v-else class="empty-state">
                                <i :class="activeTab === 'withdraws' ? 'fa-duotone fa-money-bill-transfer' : 'fa-duotone fa-wallet'"></i>
                                <p>Nenhum {{ activeTab === 'withdraws' ? 'saque' : 'depósito' }} realizado</p>
                                <span>Suas transações aparecerão aqui</span>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>

<script>
import { ref, onMounted, computed, onBeforeUnmount } from 'vue'
import { RouterLink } from "vue-router";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import HttpApi from "@/Services/HttpApi.js";
import {useSettingStore} from "@/Stores/SettingStore.js";
import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import { useModalStore } from '@/Stores/ModalStore'

export default {
    components: { CustomPagination, WalletSideMenu, BaseLayout, RouterLink },
    
    setup() {
        const modalStore = useModalStore()
        const isPageLoading = ref(true)
        const wallet = ref({})
        const withdraws = ref(null)
        const deposits = ref(null)
        const setting = ref(null)
        const mywallets = ref(null)
        const activeTab = ref('withdraws')

        const hasTransactionData = computed(() => {
            return withdraws.value?.data && deposits.value?.data
        })

        // Função unificada para carregar dados
        const loadPageData = async () => {
            try {
                isPageLoading.value = true
                
                // Carregar dados em paralelo
                const [
                    walletResponse,
                    withdrawsResponse,
                    depositsResponse,
                    myWalletsResponse
                ] = await Promise.all([
                    HttpApi.get('profile/wallet'),
                    HttpApi.get('wallet/withdraw'),
                    HttpApi.get('wallet/deposit'),
                    HttpApi.get('profile/mywallet')
                ])

                // Atualizar dados
                wallet.value = walletResponse.data.wallet
                withdraws.value = withdrawsResponse.data.withdraws
                deposits.value = depositsResponse.data.deposits
                mywallets.value = myWalletsResponse.data.wallets

                // Carregar configurações
                const settingStore = useSettingStore()
                setting.value = settingStore.setting
            } catch (error) {
                console.error('Erro ao carregar dados:', error)
                const toast = useToast()
                toast.error('Erro ao carregar dados da carteira')
            } finally {
                isPageLoading.value = false
            }
        }

        // Carregar dados quando o componente for montado
        onMounted(async () => {
            await loadPageData()
            window.scrollTo(0, 0)
            // Adicionar efeito de brilho ao hover
            const buttons = document.querySelectorAll('.tab-button')
            buttons.forEach(button => {
                button.addEventListener('mousemove', (e) => {
                    const rect = button.getBoundingClientRect()
                    const x = ((e.clientX - rect.left) / rect.width) * 100
                    const y = ((e.clientY - rect.top) / rect.height) * 100
                    button.style.setProperty('--x', `${x}%`)
                    button.style.setProperty('--y', `${y}%`)
                })
            })
        })

        const openDeposit = () => {
            modalStore.openDepositModal()
        }

        return {
            isPageLoading,
            wallet,
            withdraws,
            deposits,
            setting,
            mywallets,
            hasTransactionData,
            openDeposit,
            activeTab,
            modalStore
        }
    },

    methods: {
        rolloverPercentage(balance) {
            return Math.max(0, ((balance / 100) * 100).toFixed(2))
        }
    },

    computed: {
        getActiveTransactions() {
            return this.activeTab === 'withdraws' ? this.withdraws?.data || [] : this.deposits?.data || []
        },
        lastUpdate() {
            return new Date().toLocaleString()
        },
        totalDeposits() {
            return this.deposits?.data?.reduce((acc, dep) => acc + parseFloat(dep.amount), 0) || 0
        },
        totalWithdraws() {
            return this.withdraws?.data?.reduce((acc, wit) => acc + parseFloat(wit.amount), 0) || 0
        }
    },

    beforeUnmount() {
        this.modalStore.closeDepositModal()
    }
}
</script>

<style scoped>
/* ... estilos existentes ... */
</style>
