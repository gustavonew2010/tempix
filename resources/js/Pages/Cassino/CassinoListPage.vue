<template>
    <BaseLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>Carregando os jogos</span>
            </div>
        </LoadingComponent>

        <div v-if="!isLoading" class="mx-auto">
            <div class="px-4">
                <HeaderComponent>
                    <template #header></template>
                </HeaderComponent>

                <form class="sm:max-w-[1110px] lg:max-w-[1110px] mx-auto w-full mb-[15px] mt-[30px]">
                    <div class="flex start mx-auto items-center">
                        <a style="margin-right: 10px;margin-bottom: 35px;" href="../">
                            <svg height="1em" viewBox="0 0 448 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" fill="currentColor"></path>
                            </svg>
                        </a>
                        <p class="text-2xl flex items-center justify-center" style="margin-bottom: 35px;font-size: 14px;font-weight: bold;padding-right: 5px;">
                            {{ $t('Todos') }} {{ games?.total ?? 0 }} {{ $t('jogos da categoria.') }}
                        </p>
                    </div>

                    <input v-model="searchTerm" @input="searchGames" type="search" id="search"
                           class="block relative w-full"
                           style="background-color: #202223;padding: 0;padding-left: 15px;padding-top: 5px;padding-bottom: 5px;border-radius: 3px;font-size: 12px;"
                           :placeholder="$t('Pesquisar um jogo...')"
                           required>
                </form>

                <div v-if="games && games?.total > 0">
                    <div class="relative w-full sm:max-w-[690px] lg:max-w-[1110px] mx-auto w-full">
                        <div class="grid grid-cols-3 md:grid-cols-6 gap-4 mb-5">
                            <template v-for="(game, index) in visibleGames" :key="game.id">
                                <CassinoGameCard
                                    v-observe-visibility="onGameCardVisible"
                                    :game="game"
                                    :index="index"
                                    @click="loadGame(game)"
                                />
                            </template>
                        </div>
                    </div>

                    <div class="mt-[50px] relative sm:max-w-[690px] lg:max-w-[1110px] mx-auto w-full">
                        <CustomPagination :data="games" @pagination-change-page="getGameData"/>
                    </div>
                </div>
                <div v-else class="empty-data flex flex-col justify-center items-center text-center mt-[50px] mb-[30px] sm:max-w-[690px] lg:max-w-[1110px] mx-auto w-full">
                    <div class="flex justify-center p-2 w-full" style="background-color: #383028;border-radius: 5px;">
                        <h3 style="color: #FF9F43;font-size: .75rem;">{{ $t('No data to show') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adicionar o botão de scroll -->
        <button 
            class="btn-scroll-top fixed bottom-4 right-4 opacity-0 invisible transition-all duration-300"
            @click="scrollToTop"
        >
            <svg height="1em" viewBox="0 0 448 512" width="1em">
                <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/>
            </svg>
        </button>
    </BaseLayout>
</template>

<script>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import HttpApi from "@/Services/HttpApi.js";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import {useRoute, useRouter} from "vue-router";
import {computed, ref, watch, onMounted, onUnmounted} from "vue";
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
import HeaderComponent from "@/Components/UI/HeaderComponent.vue";
import { useIntersectionObserver } from '@vueuse/core'
import debounce from 'lodash/debounce' 

export default {
    props: [],
    components: {HeaderComponent, LoadingComponent, CustomPagination, CassinoGameCard, BaseLayout},
    data() {
        return {
            isLoading: false,
            games: null,
            searchTerm: '',
            provider: null,
            category: null,
        }
    },
    setup() {
        const isLoading = ref(false)
        const games = ref(null)
        const searchTerm = ref('')
        const provider = ref(null)
        const category = ref(null)
        const pageSize = 12
        const currentPage = ref(1)

        // Apenas a versão computed do visibleGames
        const visibleGames = computed(() => {
            if (!games.value?.data) return []
            return games.value.data.slice(0, currentPage.value * pageSize)
        })


        // Callback quando um card se torna visível
        const onGameCardVisible = (isVisible, entry) => {
            if (isVisible && entry.target) {
                // Se estamos próximos do fim da lista atual, carregamos mais
                const index = parseInt(entry.target.dataset.index)
                if (index >= (visibleGames.value.length - 4)) {
                    currentPage.value++
                }
            }
        }

        // Otimização do carregamento de dados
        const getGameData = async (page = 1, loading = true) => {
            if (loading) isLoading.value = true
            
            try {
                const params = new URLSearchParams({
                    page,
                    searchTerm: searchTerm.value,
                    category: category.value,
                    provider: provider.value,
                    limit: pageSize
                })

                const response = await HttpApi.get(`/casinos/games?${params}`)
                
                if (page === 1) {
                    games.value = response.data.games
                } else {
                    // Append new games to existing list
                    games.value.data = [...games.value.data, ...response.data.games.data]
                }
            } catch (error) {
                console.error('Error loading games:', error)
            } finally {
                isLoading.value = false
            }
        }

        // Debounce para busca
        const searchGames = debounce(async () => {
            if (searchTerm.value.length > 2 || searchTerm.value.length === 0) {
                currentPage.value = 1
                await getGameData(1, false)
            }
        }, 300)

        watch(() => route.params.provider, (newProvider, oldProvider) => {

        });

        const loadGame = (game) => {
            try {
                // Criar um slug amigável baseado no nome do jogo
                const slug = game.id
                
                // Navegar para o GameLoader com todos os parâmetros necessários
                router.push({
                    name: 'game.play',
                    params: {
                        slug: slug
                    },
                    query: {
                        gameId: game.id,
                        gameCode: game.game_code,
                        gameName: game.game_name,
                        gameProvider: game.provider,
                        gameType: game.type,
                        gameUrl: game.url || '',
                        distribution: game.distribution,
                        category: game.category,
                        cover: game.cover
                    }
                });
            } catch (error) {
                console.error('Erro ao carregar o jogo:', error);
                console.log('Game data:', game); // Para debug
            }
        };

        // Scroll handler com verificação de existência do elemento
        const initScrollHandler = () => {
            const handleScroll = () => {
                const btnScrollTop = document.querySelector('.btn-scroll-top')
                if (btnScrollTop) {
                    if (window.scrollY > 100) {
                        btnScrollTop.classList.add('show-btn-scroll-top')
                        btnScrollTop.classList.remove('opacity-0', 'invisible')
                    } else {
                        btnScrollTop.classList.remove('show-btn-scroll-top')
                        btnScrollTop.classList.add('opacity-0', 'invisible')
                    }
                }
            }

            window.addEventListener('scroll', handleScroll)
            
            // Cleanup
            onUnmounted(() => {
                window.removeEventListener('scroll', handleScroll)
            })
        }

        // Função para scroll to top
        const scrollToTop = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        }

        // Inicializa o scroll handler após a montagem do componente
        onMounted(() => {
            initScrollHandler()
        })

        return {
            route,
            loadGame,
            visibleGames,
            onGameCardVisible,
            searchGames,
            getGameData,
            scrollToTop
        };
    },
    computed: {},
    mounted() {
        window.scrollTo(0, 0);
    },
    beforeUnmount() {},
    methods: {
        searchGames: async function () {
            const _this = this;
            if (_this.searchTerm.length > 2) {
                await _this.getGameData(1,  false);
            }else{
                await _this.getGameData(1,  false);
            }
        },
        getGameData: async function (page = 1, loading = true) {
            const _this = this;
            _this.isLoading = loading;
            const provider = _this.route.params.provider;
            const category = _this.route.params.category;

            this.provider = provider;
            this.category = category;

            await HttpApi.get('/casinos/games?page=' + page + '&searchTerm=' + _this.searchTerm+'&category='+_this.category+'&provider='+_this.provider)
                .then(response => {
                    _this.games = response.data.games;
                    _this.isLoading = false;
                })
                .catch(error => {
                    _this.isLoading = false;
                });
        },
    },
   async created() {

        await this.getGameData(1,  false);
    },
    watch: {
        'route.params.provider'(newGame, oldGame) {
            this.getGameData(1,  true);
        },
        'route.params.category'(newGame, oldGame) {
            this.getGameData(1,  true);
        }
    },
};
</script>

<style scoped>
.casino-game-card {
    cursor: pointer;
    transition: none;
}

.casino-game-card:hover {
    transform: none;
}

/* Remover efeito shimmer */
.game-card-placeholder {
    background: rgba(255, 255, 255, 0.1);
    animation: none;
}

/* Remover keyframes não utilizados */
@keyframes shimmer {
    0% { }
    100% { }
}

.btn-scroll-top {
    background-color: var(--ci-primary-color);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 50;
    box-shadow: none;
    transition: none;
}

.show-btn-scroll-top {
    opacity: 1 !important;
    visibility: visible !important;
}
</style>
