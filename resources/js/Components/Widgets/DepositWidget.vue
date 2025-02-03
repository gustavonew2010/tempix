<style scoped>
/* Base Styles */
.deposit-widget { 
    background: var(--background-color);
    min-height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

/* Modal Backdrop */
.modal-backdrop { 
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.75);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
}

/* Base do Modal */
.modal-container {
    @apply fixed inset-0 flex flex-col bg-[#1A1D24] overflow-hidden;
}

@media (min-width: 768px) {
    .modal-container {
        position: relative;
        background: #1A1D24;
        border-radius: 16px;
        width: min(480px, 95%);
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        margin: 1rem;
    }
}

/* Scrollbar Styles - Simplificado */
.modal-container::-webkit-scrollbar {
    width: 8px;
}

.modal-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

/* Header Styles */
.modal-header {
    position: relative;
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: inherit;
    @apply sticky top-0 z-10 bg-[#1A1D21];
}

.header-content {
    display: flex;
    align-items: center;
    gap: 4;
}

.close-button {
    @apply w-8 h-8 flex items-center justify-center;
    @apply bg-white/5 rounded-lg transition-colors;
    @apply hover:bg-white/10;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    margin: 0;
}

.modal-subtitle {
    font-size: 0.875rem;
    color: #9CA3AF;
    margin-top: 0.25rem;
}

/* Input Styles */
.input-wrapper {
    position: relative;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 0.5rem;
}

.currency-symbol {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-color);
    opacity: 0.7;
    font-size: 1rem;
    pointer-events: none;
}

.amount-input {
    width: 100%;
    background: transparent;
    border: none;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    color: var(--text-color);
    font-size: 1rem;
    outline: none;
}

/* Conteúdo do Modal */
.modal-content {
    @apply flex-1 overflow-y-auto;
}

.deposit-step {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    @apply p-6;
}

/* Grupos de Seção */
.section-group {
    @apply p-6 pt-0;
}

.section-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    margin: 2rem 0;
}

/* Valores Rápidos */
.quick-values-section {
    margin-top: 1.5rem;
}

.quick-values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    margin-top: 1rem;
}

.quick-value-btn {
    position: relative;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1rem 0.75rem;
    color: var(--text-color);
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
}

.quick-value-btn.active {
    background: var(--ci-primary-color);
    border-color: var(--ci-primary-color);
    color: white;
}

/* Adicionar estilos para tags nos valores */
.value-tag {
    position: absolute;
    top: -6px;
    right: -6px;
    font-size: 0.625rem;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 600;
}

.tag-bonus {
    background: #4CAF50;
    color: white;
}

.tag-popular {
    background: #FF9800;
    color: white;
}

.tag-best {
    background: #f44336;
    color: white;
}

.tag-hot {
    background: #DC2626;
    color: white;
}

/* Summary Section */
.summary-section {
    background: rgba(0, 0, 0, 0.2);
    @apply p-6;
    margin: 0 -2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.summary {
    margin-bottom: 1.5rem;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--text-color);
    font-size: 0.875rem;
}

.summary-row.total {
    font-size: 1rem;
    font-weight: 600;
}

/* Submit Button */
.submit-button {
    width: 100%;
    height: 48px;
    background: var(--ci-primary-color);
    color: white;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    border: none;
    transition: all 0.2s;
}

.submit-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* QR Code Container */
.pix-container {
    padding: 0 2rem 2rem;
}

/* Timer Container */
.timer-container {
    background: transparent;
    text-align: center;
}

.timer {
    font-size: 2rem;
    font-weight: bold;
    color: var(--ci-primary-color);
}

.timer-text {
    color: #9CA3AF;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* QR Code Section */
.qr-section {
    @apply flex flex-col items-center gap-8;
    @apply p-10;
    @apply bg-gradient-to-b from-black/20 to-black/10;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.qr-instructions {
    text-align: center;
    color: #9CA3AF;
    font-size: 0.875rem;
    margin: 1rem;
}

.qr-wrapper {
    @apply bg-[#1A1D24] border border-gray-800;
    padding: 2rem;
    border-radius: 16px;
    @apply flex items-center justify-center;
}

/* Estilo para o QR Code */
:deep(.qrcode > img) {
    @apply invert; /* Inverte as cores do QR code para ficar branco */
    margin: 0 auto; /* Centraliza horizontalmente */
}

/* PIX Code Container */
.pix-code-container {
    width: 100%;
    @apply mt-6;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 0.75rem;
}

.pix-label {
    color: var(--text-color);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.copy-wrapper {
    display: flex;
    gap: 0.5rem;
}

.pix-code-input {
    flex: 1;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 0.875rem 1rem;
    border-radius: 8px;
    color: var(--text-color);
    font-size: 0.875rem;
    font-family: monospace;
}

.copy-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0 1.25rem;
    background: #0284c7;
    color: white;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s;
}

/* Mobile Payment Section */
.mobile-payment-section {
    width: 100%;
    margin-top: 1rem;
}

.mobile-payment-title {
    color: var(--text-color);
    margin-bottom: 1rem;
    font-size: 0.875rem;
    text-align: center;
}

.bank-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.75rem;
}

.bank-button {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: var(--text-color);
    transition: all 0.2s;
}

.bank-button:hover {
    background: rgba(255, 255, 255, 0.1);
}

.bank-icon {
    width: 32px;
    height: 32px;
    object-fit: contain;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .qr-wrapper {
        width: 100%;
        max-width: 280px;
    }

    .bank-buttons {
        grid-template-columns: repeat(2, 1fr);
    }

    .modal-header {
        padding: 1.25rem 1.5rem;
    }

    .header-content {
        left: 1.5rem;
    }

    .close-button {
        right: 1.5rem;
    }

    .modal-content {
        padding: 1.5rem;
    }

    .summary-section {
        padding: 1.5rem;
        margin: 0 -1.5rem;
    }

    .pix-container {
        padding: 0 1.5rem 1.5rem;
    }
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid #ffffff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.confirmation-modal {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 100000;
}

.confirmation-content {
    background: #1A1D24;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    max-width: 90%;
    width: 400px;
}

.confirmation-content h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: white;
}

.confirmation-content p {
    color: #9CA3AF;
    margin-bottom: 1.5rem;
}

.confirmation-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.confirm-btn, .cancel-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
}

.confirm-btn {
    background: #DC2626;
    color: white;
}

.cancel-btn {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.back-button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-color);
    margin-right: 1rem;
}

.value-tag {
    position: absolute;
    top: -8px;
    right: -8px;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
}

.tag-popular {
    background: #3B82F6;
    color: white;
}

.tag-bonus {
    background: #10B981;
    color: white;
}

.tag-best {
    background: #F59E0B;
    color: white;
}

.tag-hot {
    background: #DC2626;
    color: white;
}

/* Valor do Depósito Display */
.deposit-amount-display {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.1));
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}

.amount-label {
    display: block;
    color: #9CA3AF;
    font-size: 0.875rem;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.amount-value {
    font-size: 2rem;
    font-weight: 600;
    color: var(--ci-primary-color);
    line-height: 1.2;
    text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

/* Timer Container */
.timer-container {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.2));
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
}

.timer {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--ci-primary-color);
    line-height: 1;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

.timer-text {
    color: #9CA3AF;
    font-size: 0.875rem;
}

/* QR Section */
.qr-section {
    @apply flex flex-col items-center gap-8 p-8;
    @apply bg-gradient-to-b from-black/20 to-black/10;
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.qr-instructions {
    text-align: center;
    color: #9CA3AF;
    @apply flex flex-col gap-2;
}

.qr-wrapper {
    padding: 2rem;
    border-radius: 16px;
    @apply flex items-center justify-center;
}

/* PIX Code Container */
.pix-code-container {
    width: 100%;
    @apply mt-6;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 0.75rem;
}

.pix-label {
    color: #9CA3AF;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.copy-wrapper {
    display: flex;
    gap: 0.75rem;
}

.pix-code-input {
    flex: 1;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 0.875rem 1rem;
    border-radius: 8px;
    color: var(--text-color);
    font-size: 0.875rem;
    font-family: monospace;
}
 
.copy-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0 1.25rem;
    background: var(--ci-primary-color);
    color: white;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s;
}

.copy-button:hover {
    opacity: 0.9;
}

.copy-button:active {
    transform: scale(0.98);
}

/* Responsividade */
@media (max-width: 768px) {
    .pix-step {
        @apply flex-1 flex flex-col gap-4 p-4;
    }

    .qr-section {
        @apply flex-1 flex flex-col gap-6 p-6;
    }

    .deposit-amount-display,
    .timer-container {
        padding: 1.5rem;
    }

    .qr-wrapper {
        padding: 1.5rem;
        @apply mx-auto; /* Centraliza na versão mobile */
        max-width: 280px;
    }

    .amount-value {
        font-size: 1.75rem;
    }

    .timer {
        font-size: 2rem;
    }
}

@media (max-width: 767px) {
    .pix-step {
        @apply flex-1 flex flex-col gap-4;
        @apply min-h-full;
        @apply p-4;
    }

    .section-group {
        @apply p-0;
    }

    .qr-section {
        @apply flex-1 flex flex-col gap-6;
        @apply p-6;
    }

    .deposit-amount-display,
    .timer-container {
        padding: 1.5rem;
    }

    .qr-wrapper {
        padding: 1.5rem;
        @apply mx-auto; /* Centraliza na versão mobile */
        max-width: 280px;
    }

    .amount-value {
        font-size: 1.75rem;
    }

    .timer {
        font-size: 2rem;
    }

    .modal-content {
        @apply h-[calc(100vh-64px)] overflow-y-auto; /* Altura total menos header com scroll */
    }

    /* Ajusta o container do timer para ficar no final da tela */
    .timer-container {
        @apply mt-auto mb-4;
    }
}

@media (max-width: 380px) {
    .copy-wrapper {
        @apply flex-col;
    }

    .copy-button {
        @apply w-full justify-center py-3;
    }

    .pix-code-input {
        @apply text-center;
    }
}
</style>

<template>
    <Transition name="modal">
        <div v-if="modalStore.showDepositModal" class="modal-backdrop">
            <!-- Modal Principal -->
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <div class="header-content">
                        <button v-if="showPixQRCode" @click="goBack" class="back-button">
                            <i class="fa-light fa-arrow-left"></i>
                        </button>
                        <div>
                            <h2 class="modal-title">Depositar</h2>
                            <p class="modal-subtitle">Adicione saldo à sua conta</p>
                        </div>
                    </div>
                    <button @click="handleClose" class="close-button">
                        <i class="fa-light fa-x"></i>
                    </button>
                </div>

                <div class="modal-content">
                    <!-- Step 1: Valor -->
                    <div v-if="!showPixQRCode" class="deposit-step">
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
                                        style="position: relative"
                                    >
                                        {{ formatPrice(value.amount) }}
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

                        <!-- Summary -->
                        <div class="summary-section">
                            <div class="summary">
                                <div class="summary-row total">
                                    <span>Valor total</span>
                                    <span>{{ formatPrice(amount) }}</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                @click="submitDeposit"
                                :disabled="!isValid || isLoading"
                                class="submit-button"
                            >
                                <span v-if="isLoading" class="spinner"></span>
                                <span v-else>Gerar QR Code</span>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: QR Code -->
                    <div v-if="showPixQRCode" class="pix-step">
                        <p class="qr-instructions">Escaneie a imagem para realizar o pagamento</p>
                        
                        <div class="qr-wrapper">
                            <QRCodeVue3
                                :value="qrcodecopypast"
                                :width="240"
                                :height="240"
                                :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                                :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                            />
                        </div>

                        <ol class="qr-instructions">
                            <li>1. Leia o código QR acima no aplicativo Pix</li>
                            <li>2. Conclua o depósito com seu banco</li>
                            <li>3. O saldo de R$ {{ amount.toFixed(2) }} e qualquer bônus de depósito aplicável serão creditados</li>
                        </ol>

                        <!-- Código PIX -->
                        <div class="pix-code-container">
                            <div class="copy-wrapper">
                                <input 
                                    type="text" 
                                    :value="qrcodecopypast" 
                                    readonly 
                                    class="pix-code-input"
                                />
                                <button @click="copyQRCode" class="copy-button">
                                    <i class="fa-regular fa-copy"></i>
                                    <span>Copiar Código</span>
                                </button>
                            </div>
                        </div>

                        <div class="timer-container">
                            <p class="timer-text">O tempo para você pagar acaba em:</p>
                            <div class="timer">{{ formattedTimer }}</div>
                            <div class="timer-progress"></div>
                        </div>
                    </div>
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

    export default defineComponent({
        name: 'DepositWidget',
        props: {
            isMobile: {
                type: Boolean,
                default: () => window.innerWidth <= 768
            }
        },
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
                this.modalStore.closeDepositModal()
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
            // ... outros cleanups existentes ...
        }
    });
</script>
