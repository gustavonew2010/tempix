<style>
    .teste-place {
        color: #999B9B;
    }

    .container {
        margin-top: 80px; /* ou ajuste conforme necessário */
    }

    @media (max-width: 768px) {
        .container {
            margin-top: 60px; /* menor margem para mobile */
        }
    }
</style>
<template>
    <BaseLayout>
        <div class="container mx-auto p-4 relative min-h-[calc(100vh-565px)]" style="padding: 0 2%; margin-top: 20px;">
            <div v-if="wallet && !isLoading" class="grid grid-cols-1 mx-auto w-full sm:max-w-[690px] lg:max-w-[710px] w-full">
                <div v-if="isShowForm" class="col-span-1 shadow-lg mb-3 p-4" style="background-color: var(--footer-color-dark);border-radius: 5px;">
                    
                    <div class="mt-3 p-4">
                        <div class="flex flex-col mb-4">
                            <h1 data-v-a6a3f6da="" class="user-page-title mb-3" style="color: var(--ci-primary-color);font-weight: bold;font-size: 1.5em;">Indique um amigo e ganhe dinheiro</h1>
                            <p data-v-a6a3f6da="" class="refers-text warning xl:text-sm mb-3" style="color: #FF9A40;font-size: 14px;font-weight: 600;">Ganhe muito dinheiro! receba % de todos depósitos que seus indicados depositarem na plataforma, e acompanhe seu progresso em tempo real. </p>
                            <div class="flex flex-col">
                            <label aria-readonly="false" style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('Seu link:') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em;opacity: .5;" type="text"
                                       id="referenceLink"
                                       class="teste-place block p-3 w-full z-20 text-sm text-gray-900 border-gray-300 bg-gray-50 rounded-lg rounded-gray-100 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                                       :placeholder="$t('Reference Link')"
                                       v-model="referencelink"
                                       required readonly>
                                <button style="background-color: var(--ci-primary-color);color: var(--title-color);font-weight: 600;font-size: 14px;border-radius: 3px;padding-bottom: 2px;" @click.prevent="copyLink" type="submit"
                                        class="w-full mt-2 mb-3">
                                    <i style="color: var(--title-color);font-size: 14px;" class="fa-duotone fa-copy text-2xl pr-1"></i> Copiar link
                                </button>
                            </div>
                        </div>
                            <label style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('Seu Código de referência:') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em;opacity: .5;" type="text"
                                       id="referenceCode"
                                       class="teste-place mb-3 block p-3 w-full z-20 text-sm text-gray-900 border-gray-300 bg-gray-50 rounded-lg rounded-gray-100 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                                       :placeholder="$t('Reference Code')"
                                       v-model="referencecode"
                                       required readonly>
                                       <button style="background-color: var(--ci-primary-color);color: var(--title-color);font-weight: 600;font-size: 14px;border-radius: 3px;padding-bottom: 2px;" @click.prevent="copyCode" type="submit"
                                        class="w-full mt-2 mb-3">
                                    <i style="color: var(--title-color);font-size: 14px;" class="fa-duotone fa-copy text-2xl pr-1"></i> Copiar link
                                </button>
                            </div>

                            <h1 data-v-a6a3f6da="" class="user-page-title mb-3" style="color: var(--ci-primary-color);font-weight: bold;font-size: 1.5em;">Estatísticas</h1>
                            <label style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('CPA (R$)') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em" type="text"
                                       class="mb-3 block p-3 w-full z-20 text-sm text-gray-900 border-gray-300 bg-gray-50 rounded-lg rounded-gray-100 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                                       :placeholder=" state.currencyFormat(parseFloat(userData.affiliate_cpa), wallet.currency) "
                                       required readonly>
                                    
                            </div>

                            <label style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('RevShare (%)') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em" type="text"
                                       class="mb-3 block p-3 w-full z-20 text-sm text-gray-900 border-gray-300 bg-gray-50 rounded-lg rounded-gray-100 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                                       :placeholder=" userData.affiliate_revenue_share_fake ? userData.affiliate_revenue_share_fake : userData.affiliate_revenue_share "
                                       required readonly>
                                    
                            </div>

                            <label style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('Pessoas que você indicou') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em" type="text"
                                       class="mb-3 block p-3 w-full z-20 text-sm text-gray-900 border-gray-300 bg-gray-50 rounded-lg rounded-gray-100 focus:border-gray-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                                       :placeholder=" indications  "
                                       required readonly>
                                    
                            </div>

                            <label style="font-weight: 600;opacity: .5;" for="reference-code" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $t('Valor disponível') }}</label>
                            <div class="relative w-full">
                                <input style="background-color: var(--input-primary);font-size: .775em" type="text"
                                       class="mb-3 block p-3 w-full z-20 text-sm text-gray-90 rounded-lg rounded-gray-100 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                                       :placeholder="  state.currencyFormat(parseFloat(wallet.refer_rewards), wallet.currency)   "
                                       required readonly>
                                    
                            </div>

                            <button @click.prevent="opemModalWithdrawal" type="button" class="ui-button-blue w-full flex justify-center items-center" style="font-size: 14px;font-weight: 600;">
                                <i style="font-size: 14px;font-weight: 600;" class="fa-light fa-envelope-open-dollar pr-1"></i> <p style="font-size: 14px;font-weight: 600;"> Solicitar saque</p>  
                            </button>
                        </div>

                       

                        <div class="mt-16 grid grid-cols-1 md:grid-cols-1 gap-4">
                            <!-- <button @click.prevent="generateCode" type="button" class="ui-button-yellow">
                                {{ $t('Create another code') }}
                            </button> -->
                            <p style="font-size: 12px;opacity: .7;padding: 20px;margin-top:-30px;text-align: center;">Nossa plataforma dispõe de um painel de afiliados avançado, permitindo que você visualize detalhes sobre ganhos e perdas. Além disso, oferece a capacidade de adicionar subafiliados.</p>
                            <button type="button" class="ui-button-blue" style="max-width: 350px;border-radius: 8px;margin: 0 auto;padding: 10px 40px;margin-bottom: 30px">
                                <a href="/affiliate/login" target="_blank">Painel do Afiliado</a>
                                <!-- {{ $t('Share on social media') }} -->
                            </button>
                        </div>

                        <!-- <div class="mt-5 flex justify-end items-end">
                            <button @click="$router.push('/terms-conditions/reference')" type="button" class="text-gray-500 hover:text-gray-600 dark:text-gray-300 hover:dark:text-gray-400">
                                {{ $t('Terms and Conditions of Reference') }} <i class="fa-regular fa-arrow-right ml-2"></i>
                            </button>
                        </div> -->
                    </div>
                </div>
                <div v-else class="relative flex flex-col items-center justify-center text-center p-6">
                    <div v-if="!isLoadingGenerate" class="">
                        <p class="text-gray-400">
                            {{ $t('Se torne agora mesmo um Afiliado da casa e lucre até R$20000 por dia apenas indicando pessoas, acompanhe seus ganhos em tempo real!') }}
                        </p>
                        <div class="mt-5 w-full">
                            <button @click.prevent="generateCode" type="button" class="ui-button-blue w-full" style="font-weight: bold;color: var(--title-color);">
                                {{ $t('Tornar-me um Afiliado') }}
                            </button>
                        </div>
                    </div>

                    <div v-if="isLoadingGenerate" role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                        <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                        <span class="sr-only">{{ $t('Loading') }}...</span>
                    </div>
                </div>
              
            </div>
            <div v-else role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 h-full mt-16">
                <div class="text-center flex flex-col justify-center items-center">
                    <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                    <span class="mt-3">{{ $t('Loading') }}...</span>
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
        <div id="withdrawalEl" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0">
            <div class="relative max-h-full w-full max-w-2xl">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 dark:bg-gray-600 rounded-t-lg border-b dark:border-gray-500">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            <i class="fa-solid fa-money-bill-transfer mr-2"></i>
                            Solicitar Saque de Comissão
                        </h3>
                        <button class="text-gray-400 hover:text-gray-500 focus:outline-none" @click.prevent="opemModalWithdrawal">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6">
                        <form @submit.prevent="makeWithdrawal" class="space-y-4">
                            <!-- Saldo Disponível -->
                            <div class="bg-gray-800 p-4 rounded-lg mb-6">
                                <p class="text-gray-400 text-sm mb-1">Saldo Disponível</p>
                                <p v-if="wallet" class="text-2xl font-bold text-green-500">
                                    {{ state.currencyFormat(parseFloat(wallet?.refer_rewards), wallet?.currency) }}
                                </p>
                            </div>

                            <!-- Valor do Saque -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">
                                    Valor do Saque
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">R$</span>
                                    <input 
                                        v-model="withdrawalForm.amount"
                                        type="number"
                                        class="w-full pl-10 pr-4 py-2.5 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white"
                                        :placeholder="'Mínimo: R$ 50,00'"
                                        :min="50"
                                        required
                                    >
                                </div>
                                <p v-if="errors.amount" class="text-red-500 text-sm mt-1">{{ errors.amount }}</p>
                            </div>

                            <!-- Chave Pix -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">
                                    Chave Pix
                                </label>
                                <input 
                                    v-model="withdrawalForm.pix_key"
                                    v-maska
                                    data-maska="[
                                        '###.###.###-##',
                                        '##.###.###/####-##'
                                    ]"
                                    type="text"
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white"
                                    placeholder="Digite seu CPF/CNPJ"
                                    required
                                >
                                <p v-if="errors.pix_key" class="text-red-500 text-sm mt-1">{{ errors.pix_key }}</p>
                            </div>

                            <!-- Tipo de Chave -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-300">
                                    Tipo de Chave
                                </label>
                                <select 
                                    v-model="withdrawalForm.pix_type"
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-white"
                                    required
                                >
                                    <option value="">Selecione o tipo de chave</option>
                                    <option value="document">CPF/CNPJ</option>
                                </select>
                                <p v-if="errors.pix_type" class="text-red-500 text-sm mt-1">{{ errors.pix_type }}</p>
                            </div>

                            <!-- Informações -->
                            <div class="bg-gray-800 p-4 rounded-lg space-y-2 text-sm">
                                <p class="text-gray-300">
                                    <i class="fa-solid fa-circle-info mr-2 text-blue-500"></i>
                                    Valor mínimo para saque: <span class="font-semibold">R$ 50,00</span>
                                </p>
                                <p class="text-gray-300">
                                    <i class="fa-solid fa-clock mr-2 text-blue-500"></i>
                                    Prazo para pagamento: <span class="font-semibold">Até 24 horas úteis</span>
                                </p>
                            </div>

                            <!-- Submit Button -->
                            <button 
                                type="submit" 
                                class="w-full py-3 px-4 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                :disabled="isLoading"
                            >
                                <i v-if="isLoading" class="fa-solid fa-spinner fa-spin mr-2"></i>
                                <span v-if="!isLoading">Solicitar Saque</span>
                                <span v-else>Processando...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </BaseLayout>
</template>


<script>

import BaseLayout from "@/Layouts/BaseLayout.vue";
import { Modal } from 'flowbite';
import HttpApi from "@/Services/HttpApi.js";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import {useRouter} from "vue-router";

export default {
    props: [],
    components: { BaseLayout, Modal },
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
            }
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
        
        // Ensure DOM elements exist before initializing modals
        const withdrawalEl = document.getElementById('withdrawalEl');
        if (withdrawalEl) {
            this.withdrawalModal = new Modal(withdrawalEl, {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                closable: false
            });
        }
        
        this.referenceRewards = new Modal(document.getElementById('referenceRewardsEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            },
        });

        this.commissionRewards = new Modal(document.getElementById('commissionRewardsEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
            closable: true,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            },
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
        opemModalWithdrawal: function() {
            // Initialize modal if it doesn't exist
            if (!this.withdrawalModal) {
                this.withdrawalModal = new Modal(document.getElementById('withdrawalEl'), {
                    placement: 'center',
                    backdrop: 'dynamic',
                    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
                    closable: false
                });
            }
            
            // Check if modal exists before toggling
            if (this.withdrawalModal) {
                this.withdrawalModal.toggle();
            }
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

    },
};
</script>

<style scoped>

</style>
