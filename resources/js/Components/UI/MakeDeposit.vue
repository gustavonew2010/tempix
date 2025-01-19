<style>
.container-deposit {
    margin: 4%;
}
.ui-button-blue2 {
    font-size: .875rem;
    font-weight: 700;
    line-height: 1.25rem;
    border-radius: 3px;
    -webkit-box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    -moz-box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    box-shadow: 0px 2px 11px 0px var(--ci-primary-color);
    background-color: var(--ci-primary-color);
    color: var(--title-color);
    width: auto;
    padding: 9px 15px;
    -webkit-flex: none;
    -ms-flex: none;
    flex: none;
}

.ui-button-blue2:hover {
    opacity: .9;
}

@media(max-width:768px) {
    .container-deposit {
        margin: 0;
        width: 100vw;
        height: 100vh;
    }
    .ui-button-blue2 {
    font-size: .775rem;
    font-weight: 700;
    line-height: 1.25rem;
    
    padding: 5px 8px;
   
}
}

</style>
<template>
    
    <button class="ui-button-blue2" id="animar-dep" @click.prevent="toggleModalDeposit" type="button" :class="[showMobile === true ? 'hidden md:block' : '', isFull ? 'w-full' : '']">
        {{ title }}
    </button>

    <div style="  background-color:rgba(0, 0, 0, 0.47);
  backdrop-filter: none;height: 100vh;" id="modalElDeposit" tabindex="-1" aria-hidden="true" class="fixed  top-0 left-0 right-0 z-1 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
 
        <div class="relative w-full max-w-2xl max-h-full container-deposit" style="background-color: #212425;border-radius: 8px;max-width: 450px;margin: 0 auto;">

            
            
            <div class="flex flex-col px-6 pb-8 my-auto relative" style="justify-content: flex-end;position: relative;">

                <a style="position: absolute;right: 12%;top: 4%;z-index: 3;" class="login-register-x" @click.prevent="toggleModalDeposit" href="">
                    <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px;max-width: 40px;">
                    <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                    </div>
                </a>

                <div class="flex justify-between modal-header mb-6 mt-6">
                    <div>
                        <h1 class="font-bold text-xl pt-3" style="color: var(--ci-primary-color);">{{ $t('Deposit') }}</h1>
                    </div>
                </div>

                <DepositWidget />
            </div>
        </div>
    </div>

</template>

<script>
    import {useAuthStore} from "@/Stores/Auth.js";
    import DepositWidget from "@/Components/Widgets/DepositWidget.vue";
    import {onMounted, ref, watch, watchEffect} from "vue";
    import {initFlowbite} from "flowbite";
    import HttpApi from "@/Services/HttpApi.js";

    import { useRouter } from 'vue-router';

    export default {
        props: ['showMobile', 'title', 'isFull'],
        components: { DepositWidget },
        data() {
            return {
                isModalOpen: true,
                isLoading: false,
                modalDeposit: null,
                isLoadingWallet: true,
                wallet: null,
            }
        },
        setup(props) {
            onMounted(() => {
                initFlowbite();
            });

            const router = useRouter();
            const isCasinoPlayPage = ref(false);

            watchEffect(() => {
                checkRoute();
            });

            onMounted(() => {
                checkRoute();
            });

            function checkRoute() {
                // Verifique se a rota atual é 'casinoPlayPage'
                isCasinoPlayPage.value = router.currentRoute._value.name === 'casinoPlayPage';
            }

            return {
                router,
                isCasinoPlayPage
            };

        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
        },
        mounted() {
            window.scrollTo(0, 0);
            this.modalDeposit = new Modal(document.getElementById('modalElDeposit'), {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-1 backmodaldeposit',
                closable: true,
                onHide: () => {
                    this.paymentType = null;
                    const divsToDelete = document.querySelectorAll('.backmodaldeposit');
                    if (divsToDelete.length > 0) {
                        divsToDelete.forEach(div => {
                        div.remove();
                        });
                    }
                },
                onShow: () => {

                },
                onToggle: () => {
                    
                },
            });
        },
        beforeUnmount() {

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
                                localStorage. clear();
                                clearInterval(this.processInterval);
                            }
                        });

                        _this.isLoadingWallet = false;
                    });
            },
            toggleModalDeposit: function() {
                this.modalDeposit.toggle();
            },
        },
        async created() {
            await this.getWallet(); // Substitua 'seuMetodo' pelo nome do seu método

            
        },
        watch: {

        },
    };
</script>

<style scoped>

</style>
