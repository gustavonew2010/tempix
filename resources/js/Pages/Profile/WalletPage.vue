<style>

.teste-margin {
    background-color: var(--footer-color-dark);
    border-radius: 12px;
    margin-top: 70px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.teste-margin:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px -2px rgba(0, 0, 0, 0.15);
}

.wallet-card {
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.wallet-balance {
    font-size: 2.8em;
    font-weight: bold;
    background: linear-gradient(45deg, var(--ci-primary-color), #4a90e2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin: 0.5rem 0;
}

.wallet-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.wallet-actions a, 
.wallet-actions button {
    flex: 1;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.transactions-section {
    background-color: var(--footer-color-dark);
    border-radius: 12px;
    margin-top: 2rem;
    padding: 1.5rem;
}

.transactions-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
}

.transactions-table {
    border-radius: 8px;
    overflow: hidden;
}

.transactions-table th {
    background-color: rgba(0, 0, 0, 0.2);
    font-weight: 600;
}

.transactions-table td, 
.transactions-table th {
    padding: 1rem;
}

@media (min-width:1025px) and (max-width:1410px) {
    .padding-wallet {
        padding: 0px 4%;
    }
}
@media (min-width:640px) and (max-width:1024px) {
    .teste-margin {
        margin-top: 70px;
    }
}
@media (max-width:600px) {
    .wallet-card {
        padding: 1rem;
    }
    
    .wallet-balance {
        font-size: 2em;
    }
    
    .wallet-actions {
        flex-direction: column;
    }
}
@media (max-width:768px) {
    .padding-wallet {
      padding: 0px 4%;
    }
}

/* Adicionando margem superior para evitar sobreposição com navtopbar */
.wallet-container {
    padding-top: 2rem;
}

/* Status badges estilizados */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.875rem;
}

.status-badge i {
    font-size: 1rem;
}

.status-badge.success {
    background-color: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.status-badge.pending {
    background-color: rgba(234, 179, 8, 0.1);
    color: #eab308;
}

/* Animação do spinner */
.status-badge.pending i {
    animation: spin 1.5s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
<template>
    <BaseLayout>
        <div v-if="setting != null" class="wallet-container grid grid-cols-1 mx-auto w-full sm:max-w-[690px] lg:max-w-[1110px] padding-wallet">
            <!-- Carteira Principal -->
            <div v-if="!isLoadingWallet" class="wallet-card teste-margin">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold mb-2">Saldo disponível</h2>
                        <div class="wallet-balance">
                            {{ state.currencyFormat(wallet?.total_balance, wallet?.currency) }}
                        </div>
                        <div class="text-gray-400">
                            Bônus: B$ {{ state.currencyFormat((wallet.balance_bonus), wallet.currency) }}
                        </div>
                    </div>
                    <i class="fa-duotone fa-wallet text-5xl opacity-50" style="color: #5B5E5F;"></i>
                </div>
                
                <div class="wallet-actions">
                    <MakeDeposit :showMobile="false" :title="$t('Depositar')" />
                    <RouterLink 
                        :to="{ name: 'profileWithdraw' }" 
                        class="bg-[#5B5E5F] hover:bg-[#4a4d4e] text-white"
                    >
                        <i class="fas fa-money-bill-transfer"></i>
                        {{ $t('Sacar') }}
                    </RouterLink>
                </div>
            </div>

            <!-- Seção de Transações -->
            <div class="transactions-section">
                <div v-if="!isLoading && wallet">
                    <!-- Saques -->
                    <div class="mb-8">
                        <div class="transactions-header">
                            <h3 class="text-2xl font-bold" style="color: var(--ci-primary-color);">
                                Histórico de Saques
                            </h3>
                        </div>
                        
                        <div class="transactions-table">
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Date') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Value') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Status') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(withdraw, index) in withdraws.data" 
                                            :key="index" 
                                            class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-4">
                                                {{ withdraw.dateHumanReadable }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ state.currencyFormat(parseFloat(withdraw.amount), withdraw.currency) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span v-if="withdraw.status === 1" 
                                                      class="status-badge success">
                                                    <i class="fa-sharp fa-solid fa-badge-check"></i>
                                                    Confirmado
                                                </span>
                                                <span v-if="withdraw.status === 0" 
                                                      class="status-badge pending">
                                                    <i class="fa-solid fa-spinner"></i>
                                                    Processando
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Depósitos -->
                    <div>
                        <div class="transactions-header">
                            <h3 class="text-2xl font-bold" style="color: var(--ci-primary-color);">
                                Histórico de Depósitos
                            </h3>
                        </div>
                        
                        <div class="transactions-table">
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 ">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Date') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Value') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ $t('Status') }}
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(deposit, index) in deposits.data" 
                                            :key="index" 
                                            class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-4">
                                                {{ deposit.dateHumanReadable }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ state.currencyFormat(parseFloat(deposit.amount), deposit.currency) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span v-if="deposit.status === 1" 
                                                      class="status-badge success">
                                                    <i class="fa-sharp fa-solid fa-badge-check"></i>
                                                    Confirmado
                                                </span>
                                                <span v-if="deposit.status === 0" 
                                                      class="status-badge pending">
                                                    <i class="fa-solid fa-spinner"></i>
                                                    Processando
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading State -->
                <div v-if="isLoading" class="flex justify-center items-center py-20">
                    <div class="status-badge pending">
                        <i class="fa-solid fa-spinner text-4xl"></i>
                        Carregando...
                    </div>
                </div>
            </div>
        </div>
    </BaseLayout>
</template>


<script>

import { RouterLink } from "vue-router";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import BaseLayout from "@/Layouts/BaseLayout.vue";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import HttpApi from "@/Services/HttpApi.js";
import {useSettingStore} from "@/Stores/SettingStore.js";
import WalletSideMenu from "@/Pages/Profile/Components/WalletSideMenu.vue";
import CustomPagination from "@/Components/UI/CustomPagination.vue";

export default {
    props: [],
    components: {MakeDeposit, CustomPagination, WalletSideMenu, BaseLayout, RouterLink },
    data() {
        return {
            isLoading: false,
            isLoadingWallet: true,
            wallet: {},
            mywallets: null,
            setting: null,
            withdraws: null,
            deposits: null,
        }
    },
    setup(props) {


        return {};
    },
    computed: {
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
    },
    mounted() {
        window.scrollTo(0, 0);
    },
    methods: {
        getWallet: function() {
            const _this = this;
            const _toast = useToast();

            HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                });
        },
        getWithdraws: function() {
            const _this = this;
            _this.isLoading = true;

            HttpApi.get('wallet/withdraw')
                .then(response => {
                    _this.withdraws = response.data.withdraws;
                    _this.isLoading = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        getDeposits: function() {
            const _this = this;
            _this.isLoading = true;

            HttpApi.get('wallet/deposit')
                .then(response => {
                    _this.deposits = response.data.deposits;
                    _this.isLoading = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        setWallet: function(id) {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.post('profile/mywallet/'+ id, {})
                .then(response => {
                   _this.getMyWallet();
                    _this.isLoadingWallet = false;
                    window.location.reload();

                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getWallet: function() {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingWallet = true;

            HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingWallet = false;
                });
        },
        getMyWallet: function() {
            const _this = this;
            const _toast = useToast();

            HttpApi.get('profile/mywallet')
                .then(response => {
                    _this.mywallets = response.data.wallets;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                });
        },
        getSetting: function() {
            const _this = this;
            const settingStore = useSettingStore();
            const settingData = settingStore.setting;

            if(settingData) {
                _this.setting = settingData;
            }

            _this.isLoading = false;
        },
        rolloverPercentage(balance) {
            return Math.max(0, ((balance / 100) * 100).toFixed(2));
        },
    },
    created() {
        this.getWallet();
        this.getMyWallet();
        this.getSetting();
        this.getWithdraws();
        this.getDeposits();
    },
    watch: {

    },
};
</script>

<style scoped>

</style>
