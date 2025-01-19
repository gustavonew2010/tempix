<template>
    <BaseLayout>
        <div class="min-h-screen bg-gray-900 py-8 mt-20">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Container principal -->
                <div class="relative">
                    <div v-if="setting != null && wallet != null && isLoading === false" 
                         class="bg-gray-800 rounded-2xl shadow-2xl p-4 sm:p-6 lg:p-8 border border-gray-700">
                        
                        <!-- Cabeçalho -->
                        <div class="border-b border-gray-700 pb-6 mb-6">
                            <h1 class="text-2xl sm:text-3xl font-bold text-white bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                                Solicitar Saque
                            </h1>
                            <p class="text-sm sm:text-base text-gray-400 mt-2">Escolha o método de saque e preencha as informações</p>
                        </div>

                        <!-- Formulário BRL -->
                        <form v-if="wallet.currency === 'BRL'" @submit.prevent="submitWithdraw" class="space-y-6">
                            <!-- Cabeçalho PIX -->
                            <div class="flex items-center justify-between p-4 sm:p-6 bg-gradient-to-r from-gray-700 to-gray-800 rounded-xl border border-gray-600 shadow-lg hover:shadow-xl transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="p-2 sm:p-3 bg-blue-500 rounded-lg">
                                        <i class="fa-solid fa-qrcode text-2xl sm:text-3xl text-white"></i>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <h3 class="font-bold text-lg sm:text-xl text-white">Saque via PIX</h3>
                                        <p class="text-xs sm:text-sm text-gray-400">Receba em instantes</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Campos do formulário -->
                            <div class="grid gap-6">
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Nome do Titular</label>
                                    <input v-model="withdraw.name" 
                                           type="text"
                                           class="w-full px-4 py-3 rounded-xl bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="Digite o nome completo do titular"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Chave PIX</label>
                                    <input v-model="withdraw.pix_key"
                                           v-maska
                                           data-maska="['###.###.###-##']"
                                           class="w-full px-4 py-3 rounded-xl bg-gray-700 border border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                           placeholder="Digite sua chave PIX"
                                           required>
                                </div>

                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-300 mb-2">Tipo de Chave</label>
                                    <select v-model="withdraw.pix_type"
                                            class="w-full px-4 py-3 rounded-xl bg-gray-700 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                            required>
                                        <option value="">Selecione o tipo de chave</option>
                                        <option value="document">CPF/CNPJ</option>
                                    </select>
                                </div>

                                <!-- Valor do saque -->
                                <div class="form-group bg-gray-700 p-4 sm:p-6 rounded-xl border border-gray-600">
                                    <div class="flex flex-col sm:flex-row sm:justify-between mb-4 space-y-2 sm:space-y-0">
                                        <span class="text-sm font-medium text-gray-300">
                                            Valor ({{ setting.min_withdrawal }} ~ {{ setting.max_withdrawal }})
                                        </span>
                                        <span class="text-sm font-medium text-blue-400">
                                            Saldo: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <input v-model="withdraw.amount"
                                               type="text"
                                               class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                               :min="setting.min_withdrawal"
                                               :max="setting.max_withdrawal"
                                               required>
                                        
                                        <div class="grid grid-cols-2 sm:flex gap-1">
                                            <button @click.prevent="setMinAmount" 
                                                    class="px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-600 text-gray-300 text-sm font-medium transition-all duration-300">
                                                Min
                                            </button>
                                            <button @click.prevent="setPercentAmount(50)"
                                                    class="px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-600 text-gray-300 text-sm font-medium transition-all duration-300">
                                                50%
                                            </button>
                                            <button @click.prevent="setPercentAmount(100)"
                                                    class="px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-600 text-gray-300 text-sm font-medium transition-all duration-300">
                                                100%
                                            </button>
                                            <button @click.prevent="setMaxAmount"
                                                    class="px-3 py-2 rounded-lg bg-gray-800 hover:bg-gray-600 text-gray-300 text-sm font-medium transition-all duration-300">
                                                Max
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row justify-between mt-4 text-xs sm:text-sm space-y-2 sm:space-y-0">
                                        <span class="text-gray-400">Disponível: {{ state.currencyFormat(parseFloat(wallet.balance_withdrawal), wallet.currency) }}</span>
                                        <span class="text-gray-400">Bônus: {{ state.currencyFormat(parseFloat(wallet.balance_bonus), wallet.currency) }}</span>
                                    </div>
                                </div>

                                <!-- Termos -->
                                <div class="flex items-center gap-3 p-4 bg-gray-700 rounded-xl border border-gray-600">
                                    <input id="accept_terms_checkbox"
                                           v-model="withdraw.accept_terms"
                                           type="checkbox"
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 bg-gray-800">
                                    <label for="accept_terms_checkbox" class="text-xs sm:text-sm text-gray-300">
                                        Aceito os termos de transferência
                                    </label>
                                </div>
                            </div>

                            <!-- Botão de submit -->
                            <button type="submit" 
                                    class="w-full py-3 sm:py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-xl transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                                SOLICITAR SAQUE
                            </button>
                        </form>
                    </div>

                    <!-- Loading -->
                    <div v-if="isLoading" 
                         class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800/90 backdrop-blur-sm">
                        <div class="flex flex-col items-center">
                            <i class="fa-duotone fa-spinner-third fa-spin text-4xl text-blue-500 mb-2"></i>
                            <span class="text-gray-300">Processando...</span>
                        </div>
                    </div>
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

export default {
    props: [],
    components: {WalletSideMenu, BaseLayout, RouterLink},
    data() {
        return {
            isLoading: false,
            setting: null,
            wallet: null,
            withdraw: {
                name: '',
                pix_key: '',
                pix_type: '',
                amount: '',
                type: 'pix',
                currency: '',
                symbol: '',
                accept_terms: false
            },
            withdraw_deposit: {
                name: '',
                bank_info: '',
                amount: '',
                type: 'bank',
                currency: '',
                symbol: '',
                accept_terms: false
            },
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
        setMinAmount: function() {
            this.withdraw.amount = this.setting.min_withdrawal;
        },
        setMaxAmount: function() {
            this.withdraw.amount = this.setting.max_withdrawal;
        },
        setPercentAmount: function(percent) {
            this.withdraw.amount = ( percent / 100 ) * this.wallet.balance_withdrawal;
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

                    _this.withdraw_deposit.currency = response.data.wallet.currency;
                    _this.withdraw_deposit.symbol = response.data.wallet.symbol;

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
                _this.withdraw_deposit.amount   = settingData.min_withdrawal;
            }

            _this.isLoading                 = false;
        },
        submitWithdrawBank: function(event) {
            const _this = this;
            const _toast = useToast();
            _this.isLoading = true;

            HttpApi.post('wallet/withdraw/request', _this.withdraw_deposit).then(response => {
                _this.isLoading = false;
                _this.withdraw_deposit = {
                    name: '',
                    bank_info: '',
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
        },
        submitWithdraw: function(event) {
            const _this = this;
            const _toast = useToast();
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
        this.getSetting();

    },
    watch: {},
};
</script>

<style scoped>
/* Previne que o conteúdo fique por cima do menu fixo */
.min-h-screen {
    position: relative;
    z-index: 0;
} 

/* Ajusta o loading para ficar fixo na tela */
.fixed {
    position: fixed;
}
</style>
