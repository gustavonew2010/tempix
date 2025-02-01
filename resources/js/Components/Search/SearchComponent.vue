<template>
  <div class="search-container" ref="searchContainer">
    <svg class="search-icon" data-v-49f1cded="" height="14px" viewBox="0 0 512 512" width="14px"
      xmlns="http://www.w3.org/2000/svg" style="width: 20px; height: 16px;">
      <path
        d="M500.3 443.7l-119.7-119.7c-15.03 22.3-34.26 41.54-56.57 56.57l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7z"
        fill="currentColor"></path>
      <path
        d="M207.1 0C93.12 0-.0002 93.13-.0002 208S93.12 416 207.1 416s208-93.13 208-208S322.9 0 207.1 0zM207.1 336c-70.58 0-128-57.42-128-128c0-70.58 57.42-128 128-128s128 57.42 128 128C335.1 278.6 278.6 336 207.1 336z"
        fill="currentColor" opacity="0.4"></path>
    </svg>
    <input 
      type="text"
      class="search-mobile"
      :placeholder="$t('Pesquise um jogo de cassino')"
      v-model="searchTerm"
      @focus="openSearch"
      @keydown.enter="handleEnterKey"
    >

    <!-- Dropdown de resultados -->
    <div v-if="showSearchResults" class="search-results-dropdown">
      <!-- Mensagem inicial -->
      <div v-if="searchTerm.length < 3" class="initial-message">
        <p>Digite pelo menos 3 letras para pesquisar</p>
      </div>

      <!-- Estado de carregamento -->
      <div v-else-if="isSearchLoading" class="loading-state">
        <i class="fa-duotone fa-spinner-third fa-spin"></i>
      </div>

      <!-- Resultados da pesquisa -->
      <div v-else-if="searchResults && searchResults.length > 0" class="search-results">
        <div class="results-grid">
          <CassinoGameCard 
            v-for="game in visibleResults" 
            :key="game.id" 
            :game="game"
            @open-game="handleOpenGame(game)"
            class="search-game-card" 
          />
        </div>

        <!-- Informações e botão de carregar mais -->
        <div class="search-results-info">
          <p class="results-count">
            Mostrando {{ visibleResults.length }} de {{ searchPagination.total }} jogos
          </p>
          
          <button 
            v-if="hasMoreResults"
            @click.stop="loadMoreSearchResults"
            :disabled="isLoadingMore"
            class="load-more-button"
          >
            <span v-if="!isLoadingMore">Carregar mais resultados</span>
            <i v-else class="fa-duotone fa-spinner-third fa-spin"></i>
          </button>
        </div>
      </div>

      <!-- Nenhum resultado encontrado -->
      <div v-else-if="searchTerm.length >= 3" class="no-results">
        <p>Nenhum jogo encontrado para "{{ searchTerm }}"</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, watch } from 'vue';
import HttpApi from "@/Services/HttpApi.js";
import CassinoGameCard from '@/Pages/Cassino/Components/CassinoGameCard.vue';

export default {
  name: 'SearchComponent',
  components: {
    CassinoGameCard
  },
  emits: ['open-game'],
  setup() {
    const searchTerm = ref('');
    const showSearchResults = ref(false);
    const searchResults = ref([]);
    const isSearchLoading = ref(false);
    const isLoadingMore = ref(false);
    const searchContainer = ref(null);
    const searchPagination = ref({
      currentPage: 1,
      lastPage: 1,
      total: 0
    });
    const visibleResults = ref([]);
    const itemsPerPage = 12;

    const hasMoreResults = computed(() => {
      return searchResults.value.length < searchPagination.value.total;
    });

    const openSearch = () => {
      showSearchResults.value = true;
    };

    const handleEnterKey = () => {
      if (searchTerm.value.length >= 3) {
        searchGames();
      }
    };

    const searchGames = async () => {
      if (!searchTerm.value || searchTerm.value.length < 3) {
        searchResults.value = [];
        visibleResults.value = [];
        return;
      }

      try {
        isSearchLoading.value = true;
        const response = await HttpApi.get(`/games/search?q=${searchTerm.value}&page=1`);
        
        if (response.data?.status && response.data?.games?.data) {
          searchResults.value = response.data.games.data;
          visibleResults.value = response.data.games.data.slice(0, itemsPerPage);
          searchPagination.value = {
            currentPage: response.data.games.current_page,
            lastPage: response.data.games.last_page,
            total: response.data.games.total
          };
        }
      } catch (error) {
        console.error('Erro na busca:', error);
      } finally {
        isSearchLoading.value = false;
      }
    };

    const loadMoreSearchResults = async () => {
      if (isLoadingMore.value) return;

      try {
        isLoadingMore.value = true;
        const nextPage = searchPagination.value.currentPage + 1;
        const response = await HttpApi.get(`/games/search?q=${searchTerm.value}&page=${nextPage}`);

        if (response.data?.status && response.data?.games?.data) {
          const newGames = response.data.games.data;
          searchResults.value = [...searchResults.value, ...newGames];
          
          visibleResults.value = [...visibleResults.value, ...newGames];

          searchPagination.value = {
            currentPage: response.data.games.current_page,
            lastPage: response.data.games.last_page,
            total: response.data.games.total
          };
        }
      } catch (error) {
        console.error('Erro ao carregar mais resultados:', error);
      } finally {
        isLoadingMore.value = false;
      }
    };

    const resetSearch = () => {
      searchTerm.value = '';
      searchResults.value = [];
      visibleResults.value = [];
      showSearchResults.value = false;
      searchPagination.value = {
        currentPage: 1,
        lastPage: 1,
        total: 0
      };
    };

    const handleOpenGame = (game) => {
      resetSearch();
      emit('open-game', game);
    };

    // Adiciona listener para fechar o dropdown quando clicar fora
    if (typeof window !== 'undefined') {
      document.addEventListener('click', (e) => {
        if (searchContainer.value && !searchContainer.value.contains(e.target)) {
          showSearchResults.value = false;
        }
      });
    }

    return {
      searchTerm,
      showSearchResults,
      searchResults,
      isSearchLoading,
      isLoadingMore,
      searchContainer,
      searchPagination,
      hasMoreResults,
      openSearch,
      handleEnterKey,
      visibleResults,
      searchGames,
      loadMoreSearchResults,
      handleOpenGame,
      resetSearch
    };
  }
};
</script>

<style scoped>
.search-results-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: #1a1a1a;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  height: 600px;
  overflow: hidden;
  z-index: 1000;
  border: 1px solid #333;
  display: flex;
  flex-direction: column;
}

.search-results {
  position: relative;
  height: 100%;
  overflow-y: auto;
}

.results-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
  gap: 0.75rem;
  width: 100%;
  padding: 0.75rem;
  padding-bottom: 100px;
}

.search-game-card {
  transform: scale(0.95);
  transform-origin: top left;
  width: 100%;
}

.search-results-info {
  position: sticky;
  bottom: 0;
  left: 0;
  right: 0;
  background: #1a1a1a;
  padding: 0.75rem;
  border-top: 1px solid #333;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  z-index: 1001;
  margin-top: auto;
}

.results-count {
  font-size: 0.85rem;
  color: #999;
  margin: 0;
}

.load-more-button {
  background: #2563eb;
  color: white;
  border: none;
  padding: 0.4rem 1rem;
  border-radius: 4px;
  cursor: pointer;
  min-width: 160px;
  font-size: 0.9rem;
  transition: background 0.2s;
  margin: 0 auto;
}

.load-more-button:hover {
  background: #1d4ed8;
}

.load-more-button:disabled {
  background: #333;
  cursor: not-allowed;
}

/* Estados de mensagem */
.initial-message, 
.loading-state, 
.no-results {
  padding: 1rem;
  text-align: center;
  color: #999;
  background: #1a1a1a;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loading-state i {
  color: #2563eb;
  font-size: 1.5rem;
}

/* Estilo para a barra de rolagem */
.search-results::-webkit-scrollbar {
  width: 8px;
}

.search-results::-webkit-scrollbar-track {
  background: #262626;
}

.search-results::-webkit-scrollbar-thumb {
  background: #404040;
  border-radius: 4px;
}
</style> 