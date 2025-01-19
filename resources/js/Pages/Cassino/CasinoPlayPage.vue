<template>
    <GameLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>{{ $t('Carregando o jogo...') }}</span>
            </div>
        </LoadingComponent>

        <div v-if="!isLoading && game && isLogged" class="relative h-full">

            <fullscreen :active="fullscreen" @close="fullscreen = false">
                <div class="game-screen" id="game-screen" style="height: calc(100% - 60px);">
                    <div v-if="showButton && game.game_type === 'live'" class="game-full fullscreen-wrapper flex items-center justify-center">
                        <button @click.prevent="openModal(gameUrl)" type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Clique para começar
                        </button>
                    </div>
                    <iframe v-else :src="gameUrl" class="game-full fullscreen-wrapper"></iframe>
                </div>
            </fullscreen>

            
        </div>

        <div v-if="!isLogged">
            <div class="game-login">
                <div class="cont">
                    <svg class="cadeado" data-v-875c1bb1="" height="1em" viewBox="0 0 448 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M384 192C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H384zM256 320C256 302.3 241.7 288 224 288C206.3 288 192 302.3 192 320V384C192 401.7 206.3 416 224 416C241.7 416 256 401.7 256 384V320z" fill="currentColor"></path><path d="M224 64C179.8 64 144 99.82 144 144V192H80V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H304V144C304 99.82 268.2 64 224 64z" fill="currentColor" opacity="0.4"></path></svg>
                    <h2 style="font-size: 14px;font-weight: bold;">Você precisa entrar para jogar.</h2>
                    <button style="max-width: 100px;" @click.prevent="loginToggle" class="ui-button-blue rounded flex flex-row items-center botao-entrar-mobile mx-auto">
                        <svg data-v-2b009606=""
                        class="mr-2" height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M344.7 273.5l-144.1 136c-6.975 6.578-17.2 8.375-26 4.594C165.8 410.3 160.1 401.6 160.1 392V320H32.02C14.33 320 0 305.7 0 288V224c0-17.67 14.33-32 32.02-32h128.1V120c0-9.578 5.707-18.25 14.51-22.05c8.803-3.781 19.03-1.984 26 4.594l144.1 136C354.3 247.6 354.3 264.4 344.7 273.5z" fill="currentColor"></path><path d="M416 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c17.67 0 32 14.33 32 32v256c0 17.67-14.33 32-32 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c53.02 0 96-42.98 96-96V128C512 74.98 469 32 416 32z" fill="currentColor" opacity="0.4"></path></svg>
                        Entrar
                    </button>
                </div>
            </div>


            
        </div>



        <div v-if="undermaintenance" class="flex flex-col items-center justify-center text-center py-24">
            <h1 class="text-2xl mb-4">JOGO EM MANUTENÇÃO</h1>
            <img :src="`/assets/images/work-in-progress.gif`" alt="" width="400">
        </div>
    </GameLayout>
</template>

<script>
    import { initFlowbite, Tabs, Modal } from 'flowbite';
    import { RouterLink, useRoute, useRouter } from "vue-router";
    import { useAuthStore } from "@/Stores/Auth.js";
    import { component } from 'vue-fullscreen';
    import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
    import GameLayout from "@/Layouts/GameLayout.vue";
    import HttpApi from "@/Services/HttpApi.js";

    import {
        defineComponent,
        toRefs,
        reactive,
    } from 'vue';

    export default {
        props: [],
        components: {
            GameLayout,
            LoadingComponent,
            RouterLink,
            component
        },
        data() {
            return {
                isLoading: true,
                isLogged: false,
                game: null,
                modeMovie: false,
                gameUrl: null,
                token: null,
                gameId: null,
                tabs: null,
                undermaintenance: false,
                modalAuth: null,
                isLoadingDebounced: false,
                loadingTimeout: null
            }
        },
        setup() {
            const router = useRouter();
            const state = reactive({
                fullscreen: false,
                pageOnly: false,
            })
            function togglefullscreen() {
                console.log("CLICOU");
                state.fullscreen = !state.fullscreen
            }

            return {
                ...toRefs(state),
                togglefullscreen,
                router
            }
        },
        computed: {
            userData() {
                const authStore = useAuthStore();
                return authStore.user;
            },
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            },
        },
        mounted() {
            
            const userAgent = navigator.userAgent.toLowerCase();
            const isSafari = userAgent.includes('safari') && !userAgent.includes('chrome');
            const isSamsungInternet = userAgent.includes('samsung') && userAgent.includes('safari') && !userAgent.includes('chrome');

            if (isSafari || isSamsungInternet) {
                this.showButton = true;
            }

            /*
            * $targetEl: required
            * options: optional
            */
            this.modalAuth = new Modal(document.getElementById('modalElAuth'), {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                closable: false,
                onHide: () => {

                },
                onShow: () => {

                },
                onToggle: () => {

                }
            });
    

        },
        methods: {

            loadingTab: function() {
                const tabsElement = document.getElementById('tabs-info');
                if(tabsElement) {
                    const tabElements = [
                        {
                            id: 'default',
                            triggerEl: document.querySelector('#default-tab'),
                            targetEl: document.querySelector('#default-panel'),
                        },
                        {
                            id: 'descriptions',
                            triggerEl: document.querySelector('#description-tab'),
                            targetEl: document.querySelector('#description-panel'),
                        },
                        {
                            id: 'reviews',
                            triggerEl: document.querySelector('#reviews-tab'),
                            targetEl: document.querySelector('#reviews-panel'),
                        },
                    ];

                    const options = {
                        defaultTabId: 'default',
                        activeClasses: 'text-green-600 hover:text-green-600 dark:text-green-500 dark:hover:text-green-400 border-green-600 dark:border-green-500',
                        inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
                        onShow: () => {

                        },
                    };

                    const instanceOptions = {
                        id: 'default',
                        override: true
                    };

                    /*
                    * tabElements: array of tab objects
                    * options: optional
                    * instanceOptions: optional
                    */
                    this.tabs = new Tabs(tabsElement, tabElements, options, instanceOptions);
                }
            },
            openModal(gameUrl) {
                window.open(gameUrl);
            },

            setLoading(state) {
                if (this.loadingTimeout) {
                    clearTimeout(this.loadingTimeout)
                }
                this.loadingTimeout = setTimeout(() => {
                    this.isLoading = state
                }, 300)
            },

            async getGame() {
                this.setLoading(true)
                try {
                    const response = await HttpApi.get(`games/single/${this.gameId}`)
                    
                    // Process response in next tick
                    this.$nextTick(() => {
                        if (response.data?.action === 'deposit') {
                            this.router.push({ name: 'profileDeposit' })
                            return
                        }
                        
                        this.game = response.data.game
                        this.gameUrl = response.data.gameUrl
                        this.token = response.data.token
                        
                        this.loadingTab()
                    })
                } catch (error) {
                    this.undermaintenance = true
                    console.error(error)
                } finally {
                    this.setLoading(false)
                }
            },
            toggleFavorite: function() {
                const _this = this;
                return HttpApi.post('games/favorite/'+ _this.game.id, {})
                    .then(response =>  {
                        _this.getGame();
                        _this.isLoading = false;
                    })
                    .catch(error => {
                        _this.isLoading = false;
                    });
            },
            toggleLike: async function() {
                const _this = this;
                return await HttpApi.post('games/like/'+ _this.game.id, {})
                    .then(async response =>  {
                        await _this.getGame();
                        _this.isLoading = false;
                    })
                    .catch(error => {
                        _this.isLoading = false;
                    });
            },
            loginToggle: function() {
                this.modalAuth.toggle();
            },
        },
        async created() {
            if(this.isAuthenticated) {
                const route = useRoute();
                this.gameId = route.params.id;

                this.isLogged = true;

                await this.getGame();
            }else{
                // this.router.push({ , params: { action: 'openlogin' } });
            }
        },
        watch: {


        },
    };
</script>

<style>
    .game-screen {
        width: 100%;
        min-height: calc(100vh); /* Subtrai 30 pixels para a margem superior */
    }

    .game-screen .game-full {
        width: 100%;
        min-height: calc(100vh); /* Subtrai 30 pixels da margem superior e 60 pixels da altura do rodapé */
    }

    .game-login {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #000;
        z-index: 0;
        position: relative;
    }

    .game-login .cont {
        display: flex;
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }

    .game-login .cont h2{
        font-size: 22px;
    }

    .game-login .cont svg.cadeado {
        height: 50px;
        width: auto;
    }
</style>
