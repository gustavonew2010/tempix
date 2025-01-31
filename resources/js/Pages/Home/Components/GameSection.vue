<template>
  <section class="game-section" v-if="games && games.length > 0">
    <header class="section-header">
      <div class="header-left">
        <h2 class="section-title_2">{{ title }}</h2>
        <div class="nav-buttons">
          <button 
            class="nav-btn" 
            @click="handlePrev" 
            :disabled="currentSlide === 0"
          >
            <i class="fas fa-chevron-left"></i>
          </button>
          <button 
            class="nav-btn" 
            @click="handleNext" 
            :disabled="currentSlide >= maxSlides"
          >
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
      <a href="#" class="see-all">Ver todos</a>
    </header>

    <Carousel
      ref="carousel"
      v-model="currentSlide"
      :items-to-show="itemsToShow"
      :wrap-around="false"
      :transition="500"
      :breakpoints="breakpoints"
      class="games-carousel"
      :snap-align="'start'"
    >
      <Slide v-for="game in games" :key="game.id">
        <CassinoGameCard
          :game="game"
          @click="$emit('open-game', game)"
          class="game-card-wrapper"
        />
      </Slide>
    </Carousel>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Carousel, Slide } from 'vue3-carousel';
import CassinoGameCard from '@/Pages/Cassino/Components/CassinoGameCard.vue';
import 'vue3-carousel/dist/carousel.css';

const props = defineProps({
  title: String,
  games: {
    type: Array,
    default: () => []
  }
});

const carousel = ref(null);
const currentSlide = ref(0);
const itemsToShow = 6;

// Calcula o número máximo de slides
const maxSlides = computed(() => {
  return Math.max(0, props.games.length - itemsToShow);
});

// Funções de navegação
const handlePrev = () => {
  if (currentSlide.value > 0) {
    currentSlide.value--;
  }
};

const handleNext = () => {
  if (currentSlide.value < maxSlides.value) {
    currentSlide.value++;
  }
};

// Breakpoints responsivos com gap reduzido
const breakpoints = {
  300: {
    itemsToShow: 2,
    snapAlign: 'start',
  },
  576: {
    itemsToShow: 3,
    snapAlign: 'start',
  },
  768: {
    itemsToShow: 4,
    snapAlign: 'start',
  },
  992: {
    itemsToShow: 5,
    snapAlign: 'start',
  },
  1200: {
    itemsToShow: 6,
    snapAlign: 'start',
  },
};
</script>

<style scoped>
.game-section {
  width: 100%;
  max-width: var(--content-width, 1200px);
  margin: 0 auto;
  padding: 20px 0;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 0 20px;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 16px;
}

.section-title_2 {
  font-size: 24px;
  font-weight: 600;
  color: #fff;
  margin: 0;
}

.nav-buttons {
  display: flex;
  gap: 8px;
  margin-left: 16px;
}

.nav-btn {
  background: rgba(255, 255, 255, 0.1);
  border: none;
  border-radius: 4px;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s ease;
}

.nav-btn:hover:not(:disabled) {
  background: rgba(255, 255, 255, 0.2);
}

.nav-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.see-all {
  color: #0066FF;
  text-decoration: none;
  font-weight: 500;
}

.games-carousel {
  padding: 0 20px;
}

.game-card-wrapper {
  padding: 0 4px; /* Reduzido o espaço entre os cards */
  height: 100%;
  aspect-ratio: 3/4;
}

/* Sobrescrevendo estilos da biblioteca */
:deep(.carousel__track) {
  padding: 0;
  gap: 8px; /* Espaço entre os slides */
}

:deep(.carousel__slide) {
  padding: 0;
}

:deep(.carousel__viewport) {
  padding: 0;
}

/* Remove textos e labels desnecessários */
:deep(.carousel__slide-info) {
  display: none;
}

:deep(.carousel__pagination) {
  display: none;
}

@media (max-width: 768px) {
  .section-header {
    padding: 0 12px;
  }
  
  .games-carousel {
    padding: 0 12px;
  }
  
  .nav-btn {
    width: 28px;
    height: 28px;
  }
  
  .nav-buttons {
    gap: 4px;
    margin-left: 12px;
  }
  
  :deep(.carousel__track) {
    gap: 6px; /* Espaço reduzido em telas menores */
  }
}

@media (max-width: 576px) {
  .game-section {
    padding: 12px 0;
  }
  
  .section-header {
    margin-bottom: 12px;
  }
  
  .nav-btn {
    width: 24px;
    height: 24px;
  }
  
  .section-title_2 {
    font-size: 20px;
  }
  
  :deep(.carousel__track) {
    gap: 4px; /* Espaço ainda menor em mobile */
  }
}
</style> 