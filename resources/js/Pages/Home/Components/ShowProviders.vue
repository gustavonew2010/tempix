<style>
@media(max-width:600px) {
.celular-providers-setas {
    display: none;
}
}
</style>
<template>
    <div :key="index" class="game-list flex flex-col relative">
        <div class="provider-header">
            <div class="flex items-center justify-between">
                <!-- Título e Navegação -->
                <div class="flex items-center gap-3">
                    <h2 class="provider-title">{{ $t(provider.name) }}</h2>
                    <div class="navigation-buttons">
                        <button @click.prevent="ckCarousel.prev()" 
                                class="nav-button celular-providers-setas">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button @click.prevent="ckCarousel.next()" 
                                class="nav-button celular-providers-setas">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Ver Todos -->
                <RouterLink 
                    :to="{ name: 'casinosAll', params: { provider: provider.id, category: 'all' } }"
                    class="view-all-link">
                    Ver todos
                    <i class="fa-solid fa-arrow-right text-xs ml-1"></i>
                </RouterLink>
            </div>
        </div>

        <Carousel class="provider-carousel" 
                  ref="ckCarousel"
                  v-bind="settingsGames"
                  :breakpoints="breakpointsGames"
                  @init="onCarouselInit(index)"
                  @slide-start="onSlideStart(index)">
            <Slide v-if="isLoading" v-for="(i, iloading) in 10" :index="iloading">
                <div  role="status" class="w-full flex items-center justify-center h-48 mr-6 max-w-sm bg-gray-300 rounded-lg animate-pulse dark:bg-gray-700 text-4xl">
                    <i class="fa-duotone fa-gamepad-modern"></i>
                </div>
            </Slide>

            <Slide v-if="provider.games && !isLoading" 
                   v-for="(game, providerId) in provider.games" 
                   :key="providerId" 
                   class="p-2">
                <CassinoGameCard
                    :game="game"
                    @open-game="(game) => $emit('open-game', game)"
                />
            </Slide>
        </Carousel>
    </div>
</template>


<script>

import { Carousel, Navigation, Slide } from 'vue3-carousel';
import {onMounted, ref} from "vue";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";

export default {
    props: ['provider', 'index'],
    components: {CassinoGameCard, Carousel, Navigation, Slide },
    emits: ['open-game'],
    data() {
        return {
            isLoading: false,
            settingsGames: {
                itemsToShow: 2.5,
                snapAlign: 'start',
            },
            breakpointsGames: {
                700: {
                    itemsToShow: 3.5,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 6,
                    snapAlign: 'start',
                },
            },
        }
    },
    setup(props, { emit }) {
        const ckCarousel = ref(null)

        const handleGameOpen = (game) => {
            console.log('ShowProviders emitting game:', game);
            emit('open-game', game);
        };

        onMounted(() => {

        });

        return {
            ckCarousel,
            handleGameOpen
        };
    },
    computed: {

    },
    mounted() {

    },
    methods: {
        onCarouselInit(index) {

        },
        onSlideStart(index) {

        },
    },
    watch: {

    },
};
</script>

<style scoped>
.game-list {
    margin-bottom: 2rem;
}

.provider-header {
    margin-bottom: 1rem;
    padding: 0 0.5rem;
}

.provider-title {
    color: white;
    font-size: 1.125rem;
    font-weight: 600;
    letter-spacing: -0.025em;
}

.navigation-buttons {
    display: flex;
    gap: 0.5rem;
}

.nav-button {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.nav-button:hover {
    background: var(--ci-primary-color);
}

.nav-button i {
    font-size: 12px;
}

.view-all-link {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.813rem;
    color: var(--ci-primary-color);
    background: rgba(var(--ci-primary-rgb), 0.1);
    transition: all 0.2s ease;
}

.view-all-link:hover {
    background: rgba(var(--ci-primary-rgb), 0.2);
}

.provider-carousel {
    margin: 0 -0.5rem; /* Compensa o padding do header */
}

/* Responsivo */
@media (max-width: 768px) {
    .game-list {
        margin-bottom: 1.5rem;
    }
    
    .provider-header {
        margin-bottom: 0.75rem;
    }
    
    .provider-title {
        font-size: 1rem;
    }
    
    .nav-button {
        width: 24px;
        height: 24px;
    }
    
    .view-all-link {
        padding: 4px 10px;
        font-size: 0.75rem;
    }
}

@media (max-width: 600px) {
    .celular-providers-setas {
        display: none;
    }
    
    .provider-header {
        padding: 0 0.75rem;
    }
}
</style>
