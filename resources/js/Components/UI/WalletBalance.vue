<style>
.mecher-mobile2 {
    font-size: 12px;
    font-weight: 500;
    opacity: .3;
}

.mecher-mobile1 {
    font-size: 14px;
}
.ui-button-blue3 {
    font-size: .775rem;
    font-weight: 700;
    line-height: 1.25rem;
    border-radius: 3px;
    color: white;
    width: auto;
    background-color: var(--ci-gray-medium);
    color: var(--ci-primary-color);
    padding: 9px;
    -webkit-flex: none;
    -ms-flex: none;
    flex: none;
}
.ui-button-blue3:hover {
    opacity: .9;
}


@media (max-width: 600px) {
.mecher-mobile1 {
    font-size: 12px;
}
.mecher-mobile2 {
    font-size: 10px;
}
    .ui-button-blue3 {
    font-size: .675rem;
    font-weight: 700;
    line-height: 1.25rem;
    
    padding: 5px ;
   
}
    .margin-teste {
        margin-left: 8px;
    }
}

</style>
<template>
    <button 
        v-if="wallet?.total_balance === undefined || isLoadingWallet" 
        disabled 
        type="button" 
        class="wallet-button loading"
    >
        <div class="flex items-center gap-2">
            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>{{ $t('Loading') }}</span>
        </div>
    </button>
    
    <button 
        @click="$router.push('/profile/wallet')" 
        v-else 
        type="button" 
        class="wallet-button"
    > 
        <div class="flex items-center gap-2">
            <i class="fa-duotone fa-wallet"></i>
            <strong>{{ state.currencyFormat(wallet?.total_balance, wallet?.currency) }}</strong>
        </div>
    </button>
</template>

<script>
    import HttpApi from "@/Services/HttpApi.js";
    import {onMounted, ref, watch, watchEffect} from "vue";
    import {useRoute} from "vue-router";

    export default {
        props: [],
        components: {},
        data() {
            return {
                isLoadingWallet: true,
                wallet: null
            }
        },
        setup(props) {
            const route = useRoute();
            const isCasinoPlayPage = ref(false);

            watchEffect(() => {
                checkRoute();
            });

            onMounted(() => {
                checkRoute();
            });

            function checkRoute() {
                isCasinoPlayPage.value = route.name === 'casinoPlayPage';
            }

            return {
                isCasinoPlayPage
            };
        },
        computed: {

        },
        beforeUnmount() {
            this.stopPolling();
        },
        mounted() {
            window.scrollTo(0, 0);
        },
        methods: {
            getWallet: async function() {
                const _this = this;

                await HttpApi.get('profile/wallet')
                    .then(response => {
                        _this.wallet = response.data.wallet;
                        _this.isLoadingWallet = false;
                    })
                    .catch(error => {
                        Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                            if(value == 'unauthenticated') {
                                localStorage.clear();
                            }
                        });
                        _this.isLoadingWallet = false;
                    });
            },
            scheduleNextCheck() {
                if (this.processInterval) {
                    clearTimeout(this.processInterval);
                }

                // Se estiver na página do casino, usa polling mais rápido
                const delay = this.isCasinoPlayPage ? 3000 : this.pollingDelay;
                
                this.processInterval = setTimeout(() => {
                    this.getWallet();
                }, delay);
            },
            stopPolling() {
                if (this.processInterval) {
                    clearTimeout(this.processInterval);
                    this.processInterval = null;
                }
            },
            startPolling() {
                this.pollingDelay = 3000; // Reset para intervalo inicial
                this.getWallet(); // Primeira chamada imediata
            }
        },
        async created() {
            try {
                await this.getWallet(); // Carrega o saldo inicial apenas uma vez
            } catch (error) {
                console.error('Erro no created:', error);
            }
        },
        watch: {
            // Se mudar para a página do casino, atualiza mais frequentemente
            isCasinoPlayPage(newValue) {
                if (newValue) {
                    this.pollingDelay = 3000;
                    this.getWallet();
                }
            }
        },
    };
</script>

<style scoped>
.wallet-button {
    @apply flex items-center px-4 h-10 rounded-lg font-medium transition-all;
    background: linear-gradient(to right, rgba(0, 162, 212, 0.1), rgba(0, 162, 212, 0.2));
    border: 1px solid rgba(0, 162, 212, 0.2);
    color: var(--ci-primary-color);
}

.wallet-button:hover {
    background: linear-gradient(to right, rgba(0, 162, 212, 0.15), rgba(0, 162, 212, 0.25));
    border-color: rgba(0, 162, 212, 0.3);
    transform: translateY(-1px);
}

.wallet-button.loading {
    @apply opacity-75 cursor-not-allowed;
}

.wallet-button i {
    font-size: 1.1rem;
}

.wallet-button strong {
    @apply text-sm font-bold;
}

/* Ajuste para mobile */
@media (max-width: 600px) {
    .wallet-button {
        @apply px-3;
    }
    
    .wallet-button strong {
        @apply text-xs;
    }
    
    .wallet-button i {
        font-size: 1rem;
    }
}

@media (max-width: 768px) {
    .wallet-balance-button {
        @apply px-2;
        height: 32px;
        font-size: 0.875rem;
    }
}
</style>
