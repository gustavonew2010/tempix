<style>
@media(max-width:600px) {
.celular-providers-setas {
    display: none;
}
}
</style>
<template>
    <div :key="index" class="game-list flex flex-col relative">
        <div class="w-full flex justify-between provider-header">
            <div class="flex items-center">
                <h2 class="text-lg provider-title">{{ $t(provider.name) }}</h2>
                <button @click.prevent="ckCarousel.prev()" class="item-game px-2 py-1 rounded-lg text-[12px] ml-2 mr-2 celular-providers-setas">
                    <i class="fa-solid fa-angle-left"></i>
                </button>
                <button @click.prevent="ckCarousel.next()" class="item-game px-2 py-1 rounded-lg text-[12px] celular-providers-setas">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
            <div class="flex items-center view-all-wrapper">
                <RouterLink 
                    :to="{ name: 'casinosAll', params: { provider: provider.id, category: 'all' } }"
                    class="view-all-link">
                    <p class="view-all-text">Ver todos</p>
                </RouterLink>
            </div>
        </div>

        <Carousel class="item-sombra2" ref="ckCarousel"
                  v-bind="settingsGames"
                  :breakpoints="breakpointsGames"
                  @init="onCarouselInit(index)"
                  @slide-start="onSlideStart(index)"
        >
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
.provider-header {
    margin-bottom: 12px;
}

.provider-title {
    color: white;
}

.view-all-wrapper {
    padding-right: 8px;
}

.view-all-text {
    background-color: var(--ci-primary-opacity-color);
    color: var(--ci-primary-color);
    font-size: 10px;
    padding: 4px 10px;
    border-radius: 10px;
}

@media (max-width: 768px) {
    
    .provider-title {
        font-size: 16px;
    }
}
</style>
