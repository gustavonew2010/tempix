<template>
    <div class="games-display">
        <!-- Header da categoria -->
        <div class="category-header">
            <span class="games-count" v-if="gameState.total">
                {{ gameState.total }} jogos encontrados
            </span>
        </div>

        <!-- Loading state -->
        <div v-if="gameState.isLoading" class="loading-state">
            <div class="loading-spinner"></div>
            <span>Carregando jogos...</span>
        </div>

        <!-- Games grid -->
        <div v-else-if="gameState.games.length > 0" class="games-grid">
            <CassinoGameCard 
                v-for="game in gameState.games" 
                :key="game.id"
                :game="game"
                @click="$emit('open-game', game)"
            />
        </div>

        <!-- Empty state -->
        <div v-else class="empty-state">
            <p>Nenhum jogo encontrado nesta categoria.</p>
        </div>

        <!-- Load more button -->
        <div v-if="hasMoreGames" class="load-more-container">
            <button
                @click="$emit('load-more')"
                class="load-more-button"
                :disabled="gameState.isLoadingMore"
            >
                {{ gameState.isLoadingMore ? 'Carregando...' : 'Carregar mais' }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed } from "vue";
import CassinoGameCard from '@/Pages/Cassino/Components/CassinoGameCard.vue';

// Atualiza as props para incluir activeCategory
const props = defineProps({
    providers: Array,
    gameState: Object,
    activeCategory: Object
});

// Define os emits
const emit = defineEmits(['open-game', 'load-more']);

const gamesByProvider = computed(() => {
    const groupedGames = {};
    
    if (Array.isArray(props.providers)) {
        props.providers.forEach(provider => {
            if (provider && provider.code) { // Ensure provider and provider.code exist
                groupedGames[provider.code] = props.gameState.games.filter(
                    game => game && game.provider === provider.code
                );
            }
        });
    }
    
    return groupedGames;
});

const hasMoreGames = computed(() => {
    return props.gameState.total > props.gameState.games.length;
});


</script>

<style scoped>
.games-display {
    padding: 0 16px;
}

.category-header {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 12px;
}

.category-title {
    font-size: 18px;
    font-weight: 600;
    color: #fff;
}

.games-count {
    color: rgba(236, 236, 236, 0.7);
    font-size: 14px;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr); /* Força 6 colunas */
    gap: 6px; /* Espaçamento reduzido entre os cards */
    margin-bottom: 16px;
}

/* Responsividade */
@media (max-width: 1400px) {
    .games-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

@media (max-width: 1200px) {
    .games-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 768px) {
    .games-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }
}

@media (max-width: 480px) {
    .games-grid {
        grid-template-columns: repeat(3, 1fr); /* Alterado de 2 para 3 */
        gap: 8px;
    }
    
    .games-display {
        padding: 0 8px;
    }
}

.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 32px;
    color: rgba(255, 255, 255, 0.7);
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    border-top-color: #007AFF;
    animation: spin 1s linear infinite;
    margin-bottom: 16px;
}

.empty-state {
    text-align: center;
    padding: 24px;
    color: rgba(255, 255, 255, 0.7);
}

.load-more-container {
    display: flex;
    justify-content: center;
    margin-top: 16px;
    margin-bottom: 16px;
}

.load-more-button {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.load-more-button:hover:not(:disabled) {
    background: rgba(255, 255, 255, 0.15);
}

.load-more-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}
</style> 