<style scoped>
.affiliate-page-wrapper {
    @apply min-h-screen py-12 px-4 md:px-6;
}

.affiliate-page {
    @apply max-w-7xl mx-auto;
}

.affiliate-container {
    @apply max-w-5xl mx-auto w-full;
}

.affiliate-content {
    @apply bg-gray-800/40 backdrop-blur-sm rounded-2xl p-4 md:p-8 border border-white/10 shadow-xl;
}

.section-header {
    @apply text-center mb-6 md:mb-10;
}

.section-title {
    @apply text-xl md:text-2xl font-bold mb-2;
    background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.section-subtitle {
    @apply text-blue-300 text-xs md:text-sm font-medium px-4;
}

.stats-section {
    @apply mb-10;
}

.stats-grid {
    @apply grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4;
}

.stat-card {
    @apply bg-gray-800/60 rounded-xl p-3 md:p-4 flex items-center gap-3 md:gap-4 border border-white/5;
}

.stat-icon {
    @apply w-10 h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center text-lg;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.stat-info {
    @apply flex flex-col;
}

.stat-label {
    @apply text-sm text-gray-400;
}

.stat-value {
    @apply text-base md:text-lg font-medium text-white;
}

.links-section {
    @apply space-y-4 mb-10;
}

.link-card {
    @apply bg-gray-800/60 rounded-xl border border-white/5 overflow-hidden;
}

.link-header {
    @apply p-4 border-b border-white/5 flex items-center gap-2 text-sm font-medium text-gray-300;
}

.link-content {
    @apply p-3 md:p-4 flex flex-col sm:flex-row items-stretch sm:items-center gap-2;
}

.link-content input {
    @apply w-full sm:flex-1 bg-gray-900/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm;
}

.copy-button {
    @apply w-full sm:w-auto px-4 md:px-6 py-3 rounded-xl text-sm font-medium flex items-center gap-2 transition-all duration-200;
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.copy-button:hover {
    @apply shadow-lg;
    filter: brightness(110%);
}

.actions-section {
    @apply grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4;
}

.action-button {
    @apply w-full py-4 px-6 rounded-xl text-white font-medium flex items-center justify-center gap-2 transition-all duration-200;
}

.withdraw-button {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
}

.panel-button {
    background: linear-gradient(135deg, #4F46E5 0%, #4338CA 100%);
}

.action-button:hover {
    @apply shadow-lg;
    filter: brightness(110%);
}

.modal-wrapper {
    @apply fixed inset-0 z-50 md:p-4;
    height: 100dvh; /* dynamic viewport height */
    background: rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

.modal-container {
    @apply relative h-full w-full md:max-w-2xl mx-auto flex items-end md:items-center;
    @apply md:h-auto;
}

.modal-content {
    @apply relative w-full bg-gray-800/95 backdrop-blur-sm border border-white/10 shadow-2xl;
    @apply rounded-t-2xl md:rounded-2xl;
    @apply h-[85vh] md:h-auto md:max-h-[85vh];
    @apply flex flex-col;
}

.modal-body {
    @apply p-4 md:p-6 space-y-4 md:space-y-6;
    @apply flex-1 overflow-y-auto;
    @apply pb-[calc(1rem+env(safe-area-inset-bottom,20px))] md:pb-6;
}

.modal-form {
    @apply h-full flex flex-col;
}

.modal-form-content {
    @apply flex-1 overflow-y-auto;
}

.modal-form-footer {
    @apply mt-auto pt-4 sticky bottom-0 bg-gray-800/95 backdrop-blur-sm;
    padding-bottom: calc(env(safe-area-inset-bottom, 20px) + 1rem);
}

body.modal-open {
    @apply overflow-hidden;
}

/* Safe Area e Responsividade */
.pb-safe {
    padding-bottom: env(safe-area-inset-bottom, 1rem);
}

@media (max-width: 768px) {
    .affiliate-page-wrapper {
        @apply py-6;
    }

    .affiliate-content {
        @apply p-4;
    }

    .stats-grid {
        @apply grid-cols-1;
    }

    .actions-section {
        @apply grid-cols-1;
    }

    .modal-content {
        min-height: 60vh;
        margin-bottom: env(safe-area-inset-bottom, 80px);
    }

    .link-content {
        @apply flex-col;
    }

    .copy-button {
        @apply w-full;
    }

    .modal-body {
        padding-bottom: calc(env(safe-area-inset-bottom, 20px) + 80px);
    }
}

/* Melhorias para dispositivos com notch e menu inferior */
@supports(padding: max(0px)) {
    .modal-content {
        padding-bottom: max(1rem, env(safe-area-inset-bottom));
        padding-left: max(1rem, env(safe-area-inset-left));
        padding-right: max(1rem, env(safe-area-inset-right));
    }

    .modal-wrapper {
        padding-bottom: max(80px, env(safe-area-inset-bottom, 80px));
    }

    .modal-body {
        padding-bottom: max(80px, env(safe-area-inset-bottom, 80px));
    }
}

/* Garantir que o botão de submit fique sempre visível */
.modal-body form {
    @apply pb-[80px] md:pb-0;
    }
</style>
<template>
    <BaseLayout>
        <div class="affiliate-page-wrapper">
            <div class="affiliate-page">
                <div v-if="wallet && !isLoading" class="affiliate-container">
                    <!-- Conteúdo quando já é afiliado -->
                    <div v-if="isShowForm" class="affiliate-content">
                        <!-- Header Section -->
                        <div class="section-header">
                            <h1 class="section-title">Indique um amigo e ganhe dinheiro</h1>
                            <p class="section-subtitle">Ganhe muito dinheiro! Receba % de todos depósitos dos seus indicados.</p>
                        </div>

                        <!-- Stats Grid -->
                        <div class="stats-section">
                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">CPA</span>
                                        <span class="stat-value">{{ state.currencyFormat(parseFloat(userData.affiliate_cpa), wallet.currency) }}</span>
                                    </div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fa-solid fa-percent"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">RevShare</span>
                                        <span class="stat-value">{{ userData.affiliate_revenue_share_fake || userData.affiliate_revenue_share }}%</span>
                                    </div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fa-solid fa-users"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">Indicados</span>
                                        <span class="stat-value">{{ indications }}</span>
                                    </div>
                                </div>

                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-label">Disponível</span>
                                        <span class="stat-value">{{ state.currencyFormat(parseFloat(wallet.refer_rewards), wallet.currency) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Referral Links Section -->
                        <div class="links-section">
                            <div class="link-card">
                                <div class="link-header">
                                    <i class="fa-solid fa-link"></i>
                                    <span>Link de Afiliado</span>
                                </div>
                                <div class="link-content">
                                    <input
                                        type="text"
                                        id="referenceLink"
                                        v-model="referencelink"
                                        readonly
                                    >
                                    <button @click.prevent="copyLink" class="copy-button">
                                        <i class="fa-duotone fa-copy"></i>
                                        Copiar
                                </button>
                            </div>
                            </div>

                            <div class="link-card">
                                <div class="link-header">
                                    <i class="fa-solid fa-hashtag"></i>
                                    <span>Código de Referência</span>
                            </div>
                                <div class="link-content">
                                    <input
                                        type="text"
                                        id="referenceCode"
                                        v-model="referencecode"
                                        readonly
                                    >
                                    <button @click.prevent="copyCode" class="copy-button">
                                        <i class="fa-duotone fa-copy"></i>
                                        Copiar
                                    </button>
                            </div>
                            </div>
                        </div>

                        <!-- Actions Section -->
                        <div class="actions-section">
                            <button @click.prevent="opemModalWithdrawal" class="action-button withdraw-button">
                                <i class="fa-light fa-envelope-open-dollar"></i>
                                <span>Solicitar saque</span>
                            </button>

                            <a href="/affiliate/login" target="_blank" class="action-button panel-button">
                                <i class="fa-solid fa-chart-line"></i>
                                <span>Painel do Afiliado</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL RECOMPENSAS DE REFERÊNCIA -->
        <div id="referenceRewardsEl" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex justify-between p-4 dark:bg-gray-600 rounded-t-lg">
                        <h1>{{ $t('Referral Reward Rules') }}</h1>
                        <button class="" @click.prevent="toggleReferenceRewards">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="w-full flex justify-center p-4">
                        <div class="flex items-center">
                            <div class="l"></div>
                            <div class="text-white px-3">
                                Regras de Desbloqueio
                            </div>
                            <div class="r"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL RECOMPENSAS POR COMISSÃO -->
        <div id="commissionRewardsEl" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">

                    <!-- Modal header -->
                    <div class="flex justify-between p-4 dark:bg-gray-600 rounded-t-lg">
                        <h1>Regras de recompensas por comissão</h1>
                        <button class="" @click.prevent="toggleCommissionRewards">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="flex flex-col  w-full justify-center p-4">
                        <div class="flex items-center text-center w-full justify-center">
                            <div class="l"></div>
                            <div class="text-white px-3">
                                Taxas de comissões
                            </div>
                            <div class="r"></div>
                        </div>

                        <div class="mt-5">
                            <ul>
                                <li class="flex dark:bg-gray-800 shadow rounded-lg aposta-1 w-full p-4 mb-3">
                                    <div>
                                        <h1 class="font-mono text-4xl font-bold">7%</h1>
                                        <p class="text-gray-400 text-sm"><strong class="text-gray-400">Jogo:</strong> Os Jogos Originais</p>
                                    </div>
                                </li>
                                <li class="flex dark:bg-gray-800 shadow rounded-lg aposta-2 w-full p-4 mb-3">
                                    <div>
                                        <h1 class="font-mono text-4xl font-bold">7%</h1>
                                        <p class="text-gray-400 text-sm"><strong class="text-gray-400">Jogo:</strong> slots de terceiros, cassino ao vivo</p>
                                    </div>
                                </li>
                                <li class="flex dark:bg-gray-800 shadow rounded-lg aposta-3 w-full p-4 mb-3">
                                    <div>
                                        <h1 class="font-mono text-4xl font-bold">25%</h1>
                                        <p class="text-gray-400 text-sm"><strong class="text-gray-400">Jogo:</strong> Esportes</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-5 ml-4">
                            <ul class="list-outside list-disc">
                                <li class="mb-3">
                                    Em qualquer ambiente público (por exemplo, universidades, escolas, bibliotecas e espaços de escritório), apenas uma comissão pode ser paga para cada usuário,
                                    endereço IP, dispositivo eletrônico, residência, número de telefone, método de cobrança, endereço de e-mail e computador e IP endereço compartilhado com outras pessoas.
                                </li>
                                <li class="mb-3">
                                    Nossa decisão de fazer uma aposta será baseada inteiramente em nosso critério depois que um depósito for feito e uma aposta for feita com sucesso.
                                </li>
                                <li class="mb-3">
                                    As comissões podem ser retiradas em nossa carteira CREDK interna do painel a qualquer momento. (Veja a extração de sua comissão no painel e visualize o saldo na carteira).
                                </li>
                                <li class="mb-3">
                                    Apoiamos a maioria das moedas no mercado.
                                </li>
                                <li class="mb-3">
                                    O sistema calcula a comissão a cada 24 horas.
                                </li>
                            </ul>
                        </div>

                        <div class="mt-5 w-full border dark:border-gray-500 p-4 rounded">
                            Se você tiver alguma dúvida sobre nossas regras, por favor <a href="" class="text-green-500 font-bold"> Contate-nos </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL SAQUE -->
        <WithdrawAffiliateModal 
            v-model="isWithdrawModalOpen"
            :wallet="wallet"
            @success="handleWithdrawSuccess"
        />

    </BaseLayout>
</template>


<script>

import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Modal } from 'flowbite';
import HttpApi from "@/Services/HttpApi.js";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import {useRouter} from "vue-router";
import WithdrawAffiliateModal from '@/Components/Profile/WithdrawAffiliateModal.vue';

export default {
    props: [],
    components: { BaseLayout, Modal, WithdrawAffiliateModal },
    data() {
        return {
            isLoading: true,
            isLoadingGenerate: false,
            isShowForm: false,
            wallet: null,
            indications: 0,
            referencecode: '',
            referencelink: '',
            withdrawalForm: {
                amount: 0,
                pix_key: '',
                pix_type: '',
            },
            errors: {
                amount: null,
                pix_key: null,
                pix_type: null
            },
            state: {
                currencyFormat: (amount, currency = 'BRL') => {
                    if (!amount) return 'R$ 0,00';
                    return new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: currency
                    }).format(amount);
                }
            },
            isWithdrawModalOpen: false
        }
    },
    setup(props) {
        const router = useRouter();
        return {
            router
        };
    },
    computed: {
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        }
    },
    mounted() {
        window.scrollTo(0, 0);
        
        this.referenceRewards = new Modal(document.getElementById('referenceRewardsEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {},
            onShow: () => {},
            onToggle: () => {},
        });

        this.commissionRewards = new Modal(document.getElementById('commissionRewardsEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {},
            onShow: () => {},
            onToggle: () => {},
        });
    },
    methods: {
        copyCode: function(event) {
            const _toast = useToast();
            var inputElement = document.getElementById("referenceCode");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999);  // Para dispositivos móveis

            // Copia o conteúdo para a área de transferência
            document.execCommand("copy");
            _toast.success(this.$t('Code copied successfully'));
        },
        copyLink: function(event) {
            const _toast = useToast();
            var inputElement = document.getElementById("referenceLink");
            inputElement.select();
            inputElement.setSelectionRange(0, 99999);  // Para dispositivos móveis

            // Copia o conteúdo para a área de transferência
            document.execCommand("copy");
            _toast.success(this.$t('Link copied successfully'));
        },
        getCode: async function() {
            try {
                const response = await HttpApi.get('profile/affiliates');
                if (response.data.status) {
                    this.isShowForm = true;
                    this.wallet = response.data.wallet;
                    this.indications = response.data.indications;
                    this.referencecode = response.data.code;
                    this.referencelink = response.data.url;
                }
            } catch (error) {
                console.error('Erro ao buscar código:', error);
                throw error; // Propaga o erro para ser tratado no created()
            }
        },
        generateCode: async function() {
            this.isLoadingGenerate = true;
            try {
                const response = await HttpApi.get('profile/affiliates/generate');
                if (response.data.status) {
                    await this.getCode();
                    const toast = useToast();
                    toast.success('Código gerado com sucesso!');
                }
            } catch (error) {
                console.error('Erro ao gerar código:', error);
                const toast = useToast();
                toast.error('Erro ao gerar código. Por favor, tente novamente.');
            } finally {
                this.isLoadingGenerate = false;
            }
        },
        toggleCommissionRewards: function(event) {
            this.commissionRewards.toggle();
        },
        toggleReferenceRewards: function(event) {
            this.referenceRewards.toggle();
        },
        toggleBodyScroll(shouldLock) {
            if (shouldLock) {
                document.body.classList.add('modal-open');
                document.body.style.overflow = 'hidden';
            } else {
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
            }
        },
        opemModalWithdrawal() {
            this.isWithdrawModalOpen = true;
            this.toggleBodyScroll(true);
        },
        handleWithdrawSuccess() {
            this.isWithdrawModalOpen = false;
            this.toggleBodyScroll(false);
            this.getCode();
        },
        makeWithdrawal: async function() {
            const _this = this;
            const _toast = useToast();

            // Reset errors
            _this.errors = {
                amount: null,
                pix_key: null,
                pix_type: null
            };

            // Validations
            if (!_this.withdrawalForm.amount || _this.withdrawalForm.amount < 50) {
                _this.errors.amount = 'O valor mínimo para saque é R$ 50,00';
                return;
            }

            if (_this.withdrawalForm.amount > _this.wallet.refer_rewards) {
                _this.errors.amount = 'Valor solicitado maior que o saldo disponível';
                return;
            }

            if (!_this.withdrawalForm.pix_key) {
                _this.errors.pix_key = 'A chave PIX é obrigatória';
                return;
            }

            if (!_this.withdrawalForm.pix_type) {
                _this.errors.pix_type = 'O tipo de chave PIX é obrigatório';
                return;
            }

            _this.isLoading = true;

            try {
                const response = await HttpApi.post('profile/affiliates/request', {
                    amount: _this.withdrawalForm.amount,
                    pix_key: _this.withdrawalForm.pix_key,
                    pix_type: _this.withdrawalForm.pix_type
                });
                
                _this.opemModalWithdrawal();
                _toast.success('Solicitação de saque realizada com sucesso!');
                _this.getCode(); // Atualiza os dados após o saque
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;
                    Object.keys(errors).forEach(key => {
                        _this.errors[key] = errors[key][0];
                    });
                } else if (error.response?.data?.message) {
                    _toast.error(error.response.data.message);
                } else {
                    _toast.error('Ocorreu um erro ao processar sua solicitação. Tente novamente.');
                }
            } finally {
                _this.isLoading = false;
            }
        }
    },
    async created() {
        try {
            await this.getCode();
        } catch (error) {
            console.error('Erro ao carregar dados:', error);
            const toast = useToast();
            toast.error('Erro ao carregar dados. Por favor, tente novamente.');
        } finally {
            this.isLoading = false;
        }
    },
    watch: {
        isWithdrawModalOpen(newValue) {
            this.toggleBodyScroll(newValue);
        }
    },
    beforeUnmount() {
        this.toggleBodyScroll(false);
    }
};
</script>
