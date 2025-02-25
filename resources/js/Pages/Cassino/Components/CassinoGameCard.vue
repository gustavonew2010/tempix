<template>
  <div class="game-card" @click="handleGameClick">
    <div class="game-thumbnail">
      <img 
        :src="gameImage" 
        :alt="gameName"
        @error="handleImageError"
      >
      <div class="hover-overlay">
        <button class="play-btn">JOGAR</button>
      </div>
    </div>
    <!-- Temporário para debug -->
    <pre style="display: none;">{{ JSON.stringify(game, null, 2) }}</pre>
  </div>
</template>

<script setup>
import { computed, onUnmounted } from 'vue';

const props = defineProps({
  game: {
    type: Object,
    required: true
  }
});

// Log para debug
console.log('Game data:', props.game);

const gameImage = computed(() => {
  if (!props.game.cover) return '/images/default-game.jpg';
  
  return props.game.cover.startsWith('http') 
    ? props.game.cover 
    : `/storage/${props.game.cover}`;
});

const gameName = computed(() => {
  return props.game.game_name || 'Jogo sem nome';
});

const providerName = computed(() => {
  return props.game.provider_name || props.game.provider || 'Provedor';
});

const handleGameClick = () => {
  if (window.innerWidth <= 768) { // Verifica se é mobile
    // Ajusta o layout para tela cheia
    document.body.style.overflow = 'hidden';
    
    // Dispara evento com flag para mobile
    window.dispatchEvent(new CustomEvent('openGame', { 
      detail: {
        ...props.game,
        isMobile: true
      }
    }));
  } else {
    // Comportamento desktop normal
    window.scrollTo({ top: 0, behavior: 'smooth' });
    window.dispatchEvent(new CustomEvent('openGame', { 
      detail: props.game 
    }));
  }
};

const handleImageError = (event) => {
  console.error('Erro ao carregar imagem:', props.game);
  event.target.src = '/images/default-game.jpg';
};

// Limpa os estilos quando o componente é destruído
onUnmounted(() => {
  document.body.style.overflow = '';
});
</script>

<style scoped>
.game-card {
  width: 100%;
  cursor: pointer;
  transition: transform 0.2s;
}

.game-thumbnail {
  position: relative;
  width: 100%;
  aspect-ratio: 3/4;
  border-radius: 8px;
  overflow: hidden;
  background: #1a1a1a;
}

.game-thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.2s;
}

.game-card:hover .game-thumbnail img {
  transform: scale(1.05);
}

.hover-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  backdrop-filter: blur(2px);
}

.game-card:hover .hover-overlay {
  opacity: 1;
}

.play-btn {
  background: linear-gradient(135deg, #0066FF 0%, #0052cc 100%);
  color: #fff;
  border: none;
  padding: 8px 24px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 13px;
  box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
  backdrop-filter: blur(4px);
}

.play-btn:hover {
  background: linear-gradient(135deg, #0052cc 0%, #0066FF 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 102, 255, 0.4);
}

.game-title {
  display: block;
  margin-top: 8px;
  color: #fff;
  font-size: 13px;
  font-weight: 500;
  text-align: center;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Ajustes responsivos para diferentes tamanhos de tela */
@media (min-width: 1920px) {
  .play-btn {
    padding: 10px 28px;
    font-size: 14px;
  }
  
  .game-title {
    font-size: 14px;
  }
}

@media (min-width: 1366px) and (max-width: 1919px) {
  .play-btn {
    padding: 9px 26px;
    font-size: 13px;
  }
  
  .game-title {
    font-size: 13px;
  }
}

@media (min-width: 768px) and (max-width: 1365px) {
  .play-btn {
    padding: 8px 24px;
    font-size: 12px;
  }
  
  .game-title {
    font-size: 12px;
  }
}

@media (max-width: 767px) {
  .game-thumbnail {
    aspect-ratio: 3/4;
  }

  .play-btn {
    display: none;
  }
  
  .game-title {
    font-size: 10px;
    margin-top: 4px;
  }

  .hover-overlay {
    opacity: 0;
    background: none;
  }

  .game-thumbnail img {
    opacity: 1 !important;
  }
}

/* Ajuste para o grid de 3 colunas no mobile */
@media (max-width: 767px) {
  :deep(.results-grid) {
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 8px !important;
    padding: 8px !important;
  }
}

/* Ajustes para mobile */
@media (max-width: 768px) {
  .game-card.fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 1000;
    background: var(--bg-color);
  }
}
</style>
