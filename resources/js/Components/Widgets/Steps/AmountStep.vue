<template>
    <div class="deposit-step">
        <div class="section-group"> 
            <div class="amount-input-container">
                <label class="input-label">Valor do depósito</label>
                <div class="input-wrapper">
                    <div class="currency-symbol">R$</div>
                    <input 
                        type="text" 
                        :value="amount"
                        class="amount-input"
                        @input="formatAmount"
                        placeholder="0"
                    />
                </div>
            </div>

            <div class="section-divider"></div>

            <div class="quick-values-section"> 
                <label class="section-label">Valores sugeridos</label>
                <div class="quick-values-grid">
                    <button 
                        v-for="value in quickValues" 
                        :key="value.amount"
                        @click="selectAmount(value.amount)"
                        :class="['quick-value-btn', { active: amount === value.amount }]"
                    >
                        <span class="amount">{{ formatPrice(value.amount) }}</span>
                        <span 
                            v-if="value.tag" 
                            :class="['value-tag', `tag-${value.tag.type}`]"
                        >
                            {{ value.tag.text }}
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <div class="summary-section">
            <div class="summary">
                <div class="summary-row total">
                    <span>Valor total</span>
                    <span class="amount">{{ formatPrice(amount) }}</span>
                </div>
            </div>

            <button 
                @click="$emit('submit')"
                :disabled="!isValid || isLoading"
                class="submit-button"
            >
                <span v-if="isLoading" class="spinner"></span>
                <span v-else>
                    <i class="fa-regular fa-qrcode mr-2"></i>
                    Gerar QR Code
                </span>
            </button>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification"

export default {
    name: 'AmountStep',
    props: {
        amount: {
            type: Number,
            required: true
        },
        isLoading: {
            type: Boolean,
            default: false
        },
        quickValues: {
            type: Array,
            required: true
        }
    },
    computed: {
        isValid() {
            return this.amount >= 10
        }
    },
    methods: {
        formatAmount(event) {
            let value = event.target.value.replace(/[^\d]/g, '')
            if (!value) {
                this.$emit('update:amount', 0)
                return
            }
            this.$emit('update:amount', parseInt(value))
        },
        selectAmount(value) {
            this.$emit('update:amount', value)
        },
        formatPrice(value) {
            return value ? value.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }) : 'R$ 0'
        },
        async submitDeposit() {
            const toast = useToast()
            
            if (this.amount < 10) {
                toast.error('O valor mínimo para depósito é R$ 10')
                return
            }
        }
    }
}
</script>

<style scoped>
.deposit-step {
    @apply flex flex-col gap-4;
    min-height: calc(100vh - 64px);
}

.section-group {
    @apply p-4;
}

.amount-input-container {
    @apply mb-4;
}

.input-label {
    @apply text-gray-400 text-xs font-medium uppercase tracking-wide mb-2 block;
}

.input-wrapper {
    @apply relative rounded-xl overflow-hidden;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(37, 99, 235, 0.05));
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.2s;
}

.input-wrapper:focus-within {
    border-color: rgba(255, 255, 255, 0.15);
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(37, 99, 235, 0.08));
}

.currency-symbol {
    @apply absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm;
}

.amount-input {
    @apply w-full bg-transparent border-none text-white text-sm;
    padding: 0.75rem 0.75rem 0.75rem 2.75rem;
    outline: none;
}

.section-divider {
    @apply my-4 h-px bg-white/5;
}

.quick-values-section {
    @apply mt-4;
}

.section-label {
    @apply text-gray-400 text-xs font-medium uppercase tracking-wide mb-3 block;
}

.quick-values-grid {
    @apply grid grid-cols-2 sm:grid-cols-3 gap-2;
}

.quick-value-btn {
    @apply relative py-3 px-4 rounded-xl text-sm font-medium transition-all duration-200;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.quick-value-btn:hover:not(.active) {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.12);
    transform: translateY(-1px);
}

.quick-value-btn.active {
    background: var(--ci-primary-color);
    border-color: transparent;
    color: white;
}

.amount {
    @apply font-medium;
}

.value-tag {
    @apply absolute -top-2 -right-2 px-2 py-0.5 rounded text-[10px] font-bold uppercase;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.tag-popular { @apply bg-blue-500 text-white; }
.tag-bonus { @apply bg-emerald-500 text-white; }
.tag-best { @apply bg-amber-500 text-white; }
.tag-hot { @apply bg-red-500 text-white; }

.summary-section {
    @apply mt-auto p-4 bg-black/20 border-t border-white/5;
}

.summary-row {
    @apply flex items-center justify-between text-sm text-gray-300;
}

.summary-row.total {
    @apply text-white font-medium;
}

.summary-row .amount {
    @apply text-base font-semibold;
}

.submit-button {
    @apply w-full mt-4 py-3 px-4 rounded-xl font-medium text-sm transition-all;
    background: linear-gradient(135deg, var(--ci-primary-color), var(--ci-primary-color-dark, var(--ci-primary-color)));
    border: none;
    color: white;
}

.submit-button:not(:disabled):hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.submit-button:disabled {
    @apply opacity-50 cursor-not-allowed;
}

.spinner {
    @apply w-5 h-5 border-2 border-white/20 border-t-white rounded-full inline-block animate-spin;
}

@media (min-width: 768px) {
    .deposit-step {
        min-height: auto;
    }

    .section-group {
        @apply p-6;
    }

    .summary-section {
        @apply p-6;
    }

    .quick-values-grid {
        @apply gap-3;
    }
}

@media (max-width: 374px) {
    .quick-values-grid {
        @apply grid-cols-1;
    }
}
</style> 