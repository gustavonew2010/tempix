<template>
  <div class="search-container" ref="searchContainer">
    <input 
      type="text"
      class="search-mobile"
      :placeholder="$t('Pesquise um jogo de cassino')"
      v-model="searchTerm"
      @focus="openSearch"
      @keydown.enter="handleEnterKey"
    />

    <!-- Dropdown de resultados -->
    <div 
      v-if="showSearchResults" 
      ref="searchDropdown"
      class="search-results-dropdown" 
      :style="dropdownStyle" 
      :class="{ 'mobile-static': isMobile && searchConfirmed }"
    >
      <!-- Estado inicial para termos menos de 3 caracteres -->
      <div v-if="searchTerm.length < 3" class="initial-message">
        <p>Digite pelo menos 3 letras para pesquisar</p>
      </div>

      <!-- Estado de carregamento -->
      <div v-else-if="isSearchLoading" class="loading-state">
        <i class="fa-duotone fa-spinner-third fa-spin"></i>
      </div>

      <!-- Mensagem para confirmação da busca -->
      <div v-else-if="!searchConfirmed" class="confirm-message">
        <p>Pressione Enter para confirmar</p>
      </div>

      <!-- Resultados -->
      <div v-else-if="searchResults && searchResults.length > 0" class="search-results">
        <div class="results-wrapper">
          <div class="results-grid">
            <CassinoGameCard 
              v-for="game in visibleResults" 
              :key="game.id" 
              :game="game"
              @open-game="handleOpenGame(game)"
              class="search-game-card" 
            />
          </div>
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

      <!-- Sem resultados -->
      <div v-else class="no-results">
        <p>Nenhum jogo encontrado para "{{ searchTerm }}"</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed, nextTick } from 'vue';
import HttpApi from "@/Services/HttpApi.js";
import CassinoGameCard from '@/Pages/Cassino/Components/CassinoGameCard.vue';

export default {
  name: 'SearchComponent',
  components: {
    CassinoGameCard
  },
  emits: ['open-game'],
  setup(_, { emit }) {
    const searchTerm = ref('');
    const searchConfirmed = ref(false);
    const showSearchResults = ref(false);
    const searchResults = ref([]);
    const isSearchLoading = ref(false);
    const isLoadingMore = ref(false);
    const searchContainer = ref(null);
    const searchDropdown = ref(null);
    const searchPagination = ref({
      currentPage: 1,
      lastPage: 1,
      total: 0
    });
    const visibleResults = ref([]);
    const itemsPerPage = 12;

    // Define "mobile" como telas com largura <= 375px
    const isMobile = computed(() => typeof window !== 'undefined' && window.innerWidth <= 375);

    const hasMoreResults = computed(() => {
      return searchResults.value.length < searchPagination.value.total;
    });
    
    // Estilo do dropdown:
    // Antes da busca ser confirmada: altura menor
    // Após a confirmação: 400px no mobile e 600px no web
    const dropdownStyle = computed(() => {
      if (searchTerm.value.length < 3 || !searchConfirmed.value) {
        return { height: isMobile.value ? '200px' : '150px' };
      }
      return isMobile.value 
        ? { height: '400px', overflow: 'visible' }
        : { height: '600px', overflowY: 'auto' };
    });

    const openSearch = () => {
      showSearchResults.value = true;
      searchConfirmed.value = false;
      document.body.style.overflow = 'auto';
    };

    const handleEnterKey = () => {
      if (searchTerm.value.length >= 3) {
        searchConfirmed.value = true;
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
      // Preserva o scroll atual do container do dropdown
      const container = searchDropdown.value;
      const previousScrollTop = container ? container.scrollTop : 0;

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
        await nextTick();        
        // Restaura a posição do scroll para manter os itens já visíveis
        if (container) {
          container.scrollTop = previousScrollTop;
        }
        isLoadingMore.value = false;
      }
    };

    const resetSearch = () => {
      searchTerm.value = '';
      searchConfirmed.value = false;
      searchResults.value = [];
      visibleResults.value = [];
      showSearchResults.value = false;
      searchPagination.value = { currentPage: 1, lastPage: 1, total: 0 };
      document.body.style.overflow = 'auto';
    };

    const handleOpenGame = (game) => {
      resetSearch();
      emit('open-game', game);
    };

    // Fecha o dropdown ao clicar fora
    if (typeof window !== 'undefined') {
      document.addEventListener('click', (e) => {
        if (searchContainer.value && !searchContainer.value.contains(e.target)) {
          resetSearch();
        }
      });
    }

    return {
      searchTerm,
      searchConfirmed,
      showSearchResults,
      searchResults,
      isSearchLoading,
      isLoadingMore,
      searchContainer,
      searchDropdown,
      searchPagination,
      hasMoreResults,
      dropdownStyle,
      isMobile,
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
.search-container {
  position: relative;
  width: 100%;
  z-index: 20;
  margin: 0.5rem 0;
}

.search-results-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: #1a1a1a;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  border: 1px solid #333;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
  overflow: hidden;
}

.search-results {
  flex: 1;
  display: flex;
  flex-direction: column;
  height: 100%;
  overflow: hidden;
}

.results-wrapper {
  flex: 1;
  overflow-y: auto;
  position: relative;
  padding-top: 3rem;
}

.results-grid {
  display: grid;
  gap: 0.5rem;
  padding: 0 0.75rem 0.75rem;
  position: relative;
}

@media (min-width: 1361px) {
  .results-grid {
    grid-template-columns: repeat(6, 1fr);
  }
}

@media (min-width: 1200px) and (max-width: 1360px) {
  .results-grid {
    grid-template-columns: repeat(5, 1fr);
  }
}

@media (min-width: 768px) and (max-width: 1199px) {
  .results-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

@media (max-width: 767px) {
  .results-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 0.25rem;
    padding: 0 0.5rem 0.5rem;
  }
  
  .results-wrapper {
    padding-top: 1rem;
  }
  
  .search-game-card {
    transform: scale(0.85);
    transform-origin: top left;
  }
}

.search-results-info {
  padding: 1rem;
  background: #1a1a1a;
  border-top: 1px solid #333;
}

.initial-message, 
.loading-state, 
.no-results,
.confirm-message {
  padding: 1rem;
  text-align: center;
  color: #999;
  background: #1a1a1a;
  display: flex;
  align-items: center;
  justify-content: center;
}

.mobile-static {
  position: static !important;
  top: auto !important;
  left: auto !important;
  right: auto !important;
  box-shadow: none !important;
  border: none !important;
}
</style>