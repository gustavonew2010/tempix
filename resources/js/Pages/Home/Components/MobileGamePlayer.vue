<template>
    <div class="mobile-game-player">
        <!-- Menu Superior -->
        <NavTopComponent :inGameMode="true" @back="$emit('close')"/>

        <!-- Game Header -->
        <div class="game-header">
            <h3 class="game-title">{{ game.game_name }}</h3>
            <button @click="$emit('close')" class="close-button">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Loading State -->
        <div v-if="isLoadingGame" class="loading-overlay">
            <div class="loading-spinner"></div>
            <span class="loading-text">Carregando jogo...</span>
        </div>

        <!-- Game Content -->
        <template v-else-if="gameUrl">
            <div class="game-container">
                <iframe
                    :src="gameUrl"
                    class="game-frame"
                    frameborder="0"
                    allowfullscreen
                ></iframe>
            </div>
        </template>

        <!-- Error State -->
        <div v-else class="error-container">
            <i class="fas fa-exclamation-circle error-icon"></i>
            <p class="error-message">{{ errorMessage || 'Não foi possível carregar o jogo' }}</p>
            <button @click="$emit('retry')" class="retry-button">
                Tentar Novamente
            </button>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import NavTopComponent from '@/Components/Nav/NavTopComponent.vue'

defineProps({
    game: Object,
    gameUrl: String,
    isLoadingGame: Boolean,
    errorMessage: String
})

defineEmits(['close', 'retry'])
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

.game-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.8);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    z-index: 10;
}

.game-title {
    color: white;
    font-size: 1.1rem;
    font-weight: 500;
    margin: 0;
}

.close-button {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    padding: 0.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.game-container {
    flex: 1;
    position: relative;
    display: flex;
    flex-direction: column;
}

.game-frame {
    flex: 1;
    width: 100%;
    height: 100%;
    border: none;
}

.loading-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #000;
    gap: 1rem;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-top-color: #007AFF;
    border-radius: 50%;
    animation: spinner 1s linear infinite;
}

.loading-text {
    color: white;
    font-size: 0.9rem;
}

.error-container {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #000;
    padding: 2rem;
    text-align: center;
}

.error-icon {
    font-size: 3rem;
    color: #FF3B30;
    margin-bottom: 1rem;
}

.error-message {
    color: white;
    margin-bottom: 1.5rem;
}

.retry-button {
    background: #007AFF;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

@keyframes spinner {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style> 