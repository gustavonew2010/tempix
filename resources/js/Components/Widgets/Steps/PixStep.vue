<template>
    <div class="pix-step">
        <!-- Valor e Timer -->
        <div class="payment-info">
            <div class="amount-display">
                <span class="label">Valor a pagar</span>
                <span class="value">R$ {{ amount.toFixed(2) }}</span>
            </div>
            <div class="timer-display">
                <span class="timer">{{ formattedTimer }}</span>
                <span class="label">Tempo restante</span>
            </div>
        </div>

        <!-- QR Code -->
        <div class="qr-section">
            <div class="qr-wrapper">
                <QRCodeVue3
                    :value="qrCode"
                    :width="200"
                    :height="200"
                    :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }"
                />
            </div>
            
            <!-- Código PIX -->
            <div class="pix-code-container">
                <button @click="copyQRCode" class="copy-button">
                    <span class="code-preview">{{ qrCode.slice(0, 35) }}...</span>
                    <span class="copy-icon">
                        <i class="fa-regular fa-copy"></i>
                        Copiar
                    </span>
                </button>
            </div>
        </div>

        <!-- Instruções simplificadas -->
        <div class="instructions">
            <div class="step">
                <i class="fa-regular fa-qrcode"></i>
                <span>Escaneie o QR code</span>
            </div>
            <div class="step">
                <i class="fa-regular fa-mobile"></i>
                <span>Pague pelo seu banco</span>
            </div>
            <div class="step">
                <i class="fa-regular fa-check-circle"></i>
                <span>Confirmação automática</span>
            </div>
        </div>
    </div>
</template>

<script>
import QRCodeVue3 from "qrcode-vue3"
import { useToast } from "vue-toastification"

export default {
    name: 'PixStep',
    components: {
        QRCodeVue3
    },
    props: {
        qrCode: {
            type: String,
            required: true
        },
        amount: {
            type: Number,
            required: true
        },
        minutes: {
            type: Number,
            required: true
        },
        seconds: {
            type: Number,
            required: true
        }
    },
    computed: {
        formattedTimer() {
            const minutes = String(this.minutes).padStart(2, '0')
            const seconds = String(this.seconds).padStart(2, '0')
            return `${minutes}:${seconds}`
        }
    },
    methods: {
        copyQRCode() {
            navigator.clipboard.writeText(this.qrCode)
            const toast = useToast()
            toast.success('Código PIX copiado!')
        }
    }
}
</script>

<style scoped>
.pix-step {
    @apply flex flex-col gap-6 p-4 md:p-6;
}

/* Seção de Valor e Timer */
.payment-info {
    @apply flex flex-col gap-4 text-center;
}

.amount-display {
    @apply flex flex-col items-center;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(37, 99, 235, 0.05));
    border-radius: 12px;
    padding: 1rem;
}

.amount-display .label {
    @apply text-xs text-gray-400 uppercase tracking-wide mb-1;
}

.amount-display .value {
    @apply text-2xl font-bold text-white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.timer-display {
    @apply flex flex-col items-center;
}

.timer-display .timer {
    @apply text-xl font-bold mb-1 text-[#00A2D4];
    text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
}

.timer-display .label {
    @apply text-xs text-gray-400 uppercase tracking-wide;
}

/* Seção QR Code */
.qr-section {
    @apply flex flex-col items-center gap-4;
}

.qr-wrapper {
    @apply p-4 rounded-xl bg-white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

:deep(.qrcode > img) {
    @apply rounded-lg;
}

.pix-code-container {
    @apply w-full max-w-md;
}

.copy-button {
    @apply w-full flex items-center justify-between p-3 rounded-xl text-sm transition-all;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.copy-button:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.12);
}

.code-preview {
    @apply text-gray-400 font-mono truncate flex-1 text-left mr-3;
}

.copy-icon {
    @apply flex items-center gap-2 text-[#00A2D4] whitespace-nowrap;
}

/* Instruções */
.instructions {
    @apply flex flex-col gap-3 mt-2;
}

.step {
    @apply flex items-center gap-3 text-sm text-gray-300 py-2;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.step:last-child {
    border-bottom: none;
}

.step i {
    @apply text-lg text-[#00A2D4];
}

@media (max-width: 768px) {
    .pix-step {
        @apply gap-4;
    }

    .amount-display .value {
        @apply text-xl;
    }

    .timer-display .timer {
        @apply text-lg;
    }
}
</style> 