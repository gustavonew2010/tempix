<template>
  <div class="mobile-game-player">
    <!-- Sempre mostra o NavTopComponent no topo -->
    <NavTopComponent :inGameMode="true" @back="closeGame"/>

    <!-- Área para executar o jogo em tela cheia -->
    <div class="game-container">
      <!-- Aqui você pode renderizar o jogo usando o game ID ou outras props -->
      <h2 class="game-title">{{ game.game_name }}</h2>
      <!-- Exemplo: um iframe (substitua pela implementação real) -->
      <iframe 
        v-if="gameUrl"
        :src="gameUrl"
        frameborder="0"
        class="game-frame"
      ></iframe>
      <!-- Caso não tenha uma URL definida, mostre uma mensagem ou loader -->
      <div v-else class="game-placeholder">
        Carregando jogo...
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import NavTopComponent from '@/Components/Nav/NavTopComponent.vue'
import { defineProps, defineEmits } from 'vue'

const props = defineProps({
  game: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['close'])

// Exemplo: Gere a URL para execução do jogo com base em uma propriedade do game
const gameUrl = computed(() => {
  return props.game?.url || null
})

function closeGame() {
  emit('close')
}
</script>

<style scoped>
.mobile-game-player {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  display: flex;
  flex-direction: column;
  z-index: 1000;
}

.game-container {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

.game-title {
  color: #fff;
  margin-bottom: 1rem;
  font-size: 1.5rem;
}

.game-frame {
  width: 100%;
  height: 100%;
  border: 0;
}

.game-placeholder {
  color: #fff;
  font-size: 1.2rem;
}

.close-btn {
  position: absolute;
  top: 4rem;
  right: 1rem;
  background: rgba(255,255,255,0.2);
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
  cursor: pointer;
  z-index: 1100;
}
</style> 