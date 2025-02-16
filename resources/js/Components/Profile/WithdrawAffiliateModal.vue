<template>
    <div 
        v-if="modelValue" 
        id="withdrawalEl" 
        tabindex="-1" 
        aria-hidden="true" 
        class="modal-wrapper"
    >
        <div class="modal-container">
            <div class="modal-content">
                <div class="flex items-center justify-between p-4 border-b border-white/10">
                    <h3 class="text-xl font-semibold text-white">
                        Solicitar Saque
                    </h3>
                    <button
                        @click="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-800 hover:text-white rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    >
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form @submit.prevent="makeWithdrawal" class="modal-form">
                        <div class="form-container">
                            <div class="balance-card">
                                <p class="text-blue-400 text-sm mb-1">Saldo Disponível para Saque</p>
                                <p v-if="wallet" class="text-2xl font-bold text-white">
                                    {{ currencyFormat(parseFloat(wallet?.refer_rewards), wallet?.currency) }}
                                </p>
                            </div>

                            <div class="form-fields">
                                <div class="form-group">
                                    <label class="form-label">Valor do Saque</label>
                                    <div class="relative">
                                        <input 
                                            v-model="form.amount"
                                            type="number"
                                            class="form-input pl-10"
                                            placeholder="Mínimo: R$ 50,00"
                                            :min="50"
                                            required
                                        >
                                    </div>
                                    <p v-if="errors.amount" class="form-error">{{ errors.amount }}</p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Chave Pix</label>
                                    <input 
                                        v-model="form.pix_key"
                                        v-maska
                                        data-maska="['###.###.###-##', '##.###.###/####-##']"
                                        type="text"
                                        class="form-input"
                                        placeholder="Digite seu CPF/CNPJ"
                                        required
                                    >
                                    <p v-if="errors.pix_key" class="form-error">{{ errors.pix_key }}</p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tipo de Chave</label>
                                    <select 
                                        v-model="form.pix_type"
                                        class="form-input"
                                        required
                                    >
                                        <option value="">Selecione o tipo de chave</option>
                                        <option value="document">CPF/CNPJ</option>
                                    </select>
                                    <p v-if="errors.pix_type" class="form-error">{{ errors.pix_type }}</p>
                                </div>

                                <div class="info-card">
                                    <div class="info-container">
                                        <div class="info-item">
                                            <i class="info-icon fa-solid fa-circle-info"></i>
                                            <span class="info-text">
                                                Valor mínimo para saque: 
                                                <b class="whitespace-nowrap">R$ 50,00</b>
                                            </span>
                                        </div>

                                        <div class="info-item">
                                            <i class="info-icon fa-solid fa-clock"></i>
                                            <span class="info-text">
                                                Prazo para pagamento: 
                                                <b>Até 24 horas úteis</b>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-container">
                            <button 
                                type="submit"
                                class="submit-button"
                                :disabled="isLoading"
                            >
                                <i v-if="isLoading" class="fa-solid fa-spinner fa-spin"></i>
                                <span>{{ isLoading ? 'Processando...' : 'Solicitar Saque' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from 'flowbite';
import { useToast } from "vue-toastification";
import HttpApi from "@/Services/HttpApi.js";

export default {
    name: 'WithdrawAffiliateModal',
    props: {
        modelValue: {
            type: Boolean,
            default: false,
            required: true
        },
        wallet: {
            type: Object,
            required: true
        }
    },
    emits: ['update:modelValue', 'success'],
    data() {
        return {
            isLoading: false,
            form: {
                amount: 0,
                pix_key: '',
                pix_type: '',
            },
            errors: {
                amount: null,
                pix_key: null,
                pix_type: null
            },
            modal: null
        }
    },
    mounted() {
        this.modal = new Modal(document.getElementById('withdrawalEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: false,
            onShow: () => {
                document.body.style.overflow = 'hidden';
                document.body.style.position = 'fixed';
                document.body.style.width = '100%';
                document.addEventListener('touchmove', this.preventDefault, { passive: false });
            },
            onHide: () => {
                document.body.style.overflow = '';
                document.body.style.position = '';
                document.body.style.width = '';
                document.removeEventListener('touchmove', this.preventDefault);
            }
        });
        this.modal.hide();
    },
    beforeUnmount() {
        document.body.style.overflow = '';
        document.body.style.position = '';
        document.body.style.width = '';
        document.removeEventListener('touchmove', this.preventDefault);
    },
    methods: {
        preventDefault(e) {
            e.preventDefault();
        },
        currencyFormat(amount, currency = 'BRL') {
            if (!amount) return 'R$ 0,00';
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: currency
            }).format(amount);
        },
        toggle() {
            this.modal?.toggle();
        },
        closeModal() {
            this.$emit('update:modelValue', false);
        },
        async makeWithdrawal() {
            const toast = useToast();
            this.errors = { amount: null, pix_key: null, pix_type: null };

            if (!this.form.amount || this.form.amount < 50) {
                this.errors.amount = 'O valor mínimo para saque é R$ 50,00';
                return;
            }

            if (this.form.amount > this.wallet.refer_rewards) {
                this.errors.amount = 'Valor solicitado maior que o saldo disponível';
                return;
            }

            if (!this.form.pix_key) {
                this.errors.pix_key = 'A chave PIX é obrigatória';
                return;
            }

            if (!this.form.pix_type) {
                this.errors.pix_type = 'O tipo de chave PIX é obrigatório';
                return;
            }

            this.isLoading = true;

            try {
                await HttpApi.post('profile/affiliates/request', this.form);
                this.$emit('update:modelValue', false);
                toast.success('Solicitação de saque realizada com sucesso!');
                this.$emit('success');
            } catch (error) {
                if (error.response?.data?.errors) {
                    const errors = error.response.data.errors;
                    Object.keys(errors).forEach(key => {
                        this.errors[key] = errors[key][0];
                    });
                } else if (error.response?.data?.message) {
                    toast.error(error.response.data.message);
                } else {
                    toast.error('Ocorreu um erro ao processar sua solicitação. Tente novamente.');
                }
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>

<style scoped>
.modal-wrapper {
    @apply fixed inset-0 z-50;
    @apply bg-gray-900/80 backdrop-blur-sm;
    @apply flex items-start md:items-center justify-center;
    height: 100%;
}

.modal-container {
    @apply w-full h-full md:h-auto md:max-w-lg;
    @apply px-0 md:px-4;
    @apply relative;
    @apply flex flex-col;
}

.modal-content {
    @apply w-full h-full md:h-auto;
    @apply bg-gray-800 md:rounded-2xl;
    @apply border border-white/10;
    @apply flex flex-col;
    @apply md:max-h-[90vh];
}

.modal-header {
    @apply flex items-center justify-between;
    @apply p-4 md:p-6;
    @apply border-b border-white/10;
    @apply bg-gray-800;
    @apply sticky top-0 z-10;
}

.modal-title {
    @apply text-xl font-semibold;
    @apply bg-gradient-to-r from-blue-400 to-blue-600 bg-clip-text text-transparent;
}

.modal-close {
    @apply text-gray-400 hover:text-white;
    @apply transition-colors duration-200;
}

.modal-body {
    @apply flex-1;
    @apply overflow-y-auto;
}

.modal-form {
    @apply flex flex-col;
    @apply h-full;
}

.form-container {
    @apply p-4 md:p-6;
    @apply space-y-6;
    @apply flex-1;
}

.balance-card {
    @apply bg-gradient-to-r from-blue-500/10 to-blue-600/10;
    @apply border border-blue-500/20;
    @apply p-4 rounded-xl;
}

.form-fields {
    @apply space-y-4;
}

.form-group {
    @apply space-y-1.5;
}

.form-label {
    @apply text-sm font-medium text-blue-400;
}

.form-input {
    @apply w-full px-4 py-3;
    @apply bg-gray-900/50;
    @apply border border-white/10;
    @apply rounded-xl;
    @apply text-white;
    @apply transition-all duration-200;
    @apply focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
}

.currency-prefix {
    @apply absolute left-3 top-1/2 -translate-y-1/2;
    @apply text-blue-400;
}

.form-error {
    @apply text-red-500 text-sm;
}

.info-card {
    @apply bg-gray-900/50 rounded-xl p-4;
    @apply border border-white/10;
}

.info-container {
    @apply grid grid-cols-1 sm:grid-cols-2 gap-3;
}

.info-item {
    @apply flex items-center gap-2;
    @apply text-sm text-gray-300;
}

.info-icon {
    @apply text-blue-500 text-base flex-shrink-0;
}

.info-text {
    @apply flex-1;
    @apply flex items-center flex-wrap gap-1;
}

.button-container {
    @apply mt-auto;
    @apply px-4 pt-4;
    @apply bg-gray-800;
    @apply border-t border-white/10;
}

.submit-button {
    @apply w-full py-3.5 px-6;
    @apply bg-gradient-to-r from-blue-600 to-blue-700;
    @apply hover:from-blue-700 hover:to-blue-800;
    @apply text-white font-medium;
    @apply rounded-xl;
    @apply transition-all duration-300;
    @apply flex items-center justify-center gap-2;
    @apply disabled:opacity-50 disabled:cursor-not-allowed;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .modal-content {
        @apply h-screen;
    }

    .button-container {
        @apply bg-gray-800/95 backdrop-blur-sm;
        padding-bottom: calc(env(safe-area-inset-bottom, 20px) + 60px);
    }
}

/* Safe Area Support */
@supports(padding: max(0px)) {
    .button-container {
        padding-bottom: max(calc(env(safe-area-inset-bottom, 20px) + 60px), 60px);
    }
}
</style>