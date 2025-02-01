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
import { computed } from 'vue';

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
  // Dispara um evento global que o HomePage vai escutar
  window.dispatchEvent(new CustomEvent('openGame', { 
    detail: props.game 
  }));
};

const handleImageError = (event) => {
  console.error('Erro ao carregar imagem:', props.game);
  event.target.src = '/images/default-game.jpg';
};
</script>

<style scoped>
.game-card {
  width: 160px;
  cursor: pointer;
  transition: transform 0.2s;
}

.game-thumbnail {
  position: relative;
  width: 100%;
  height: 200px;
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
  background: rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.2s;
}

.game-card:hover .hover-overlay {
  opacity: 1;
}

.play-btn {
  background: #0066FF;
  color: #fff;
  border: none;
  padding: 8px 24px;
  border-radius: 4px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.play-btn:hover {
  background: #0052cc;
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

@media (max-width: 768px) {
  .game-card {
    width: 120px;
  }
  
  .game-thumbnail {
    height: 150px;
  }
  
  .game-title {
    font-size: 12px;
  }
}
</style>
