
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
  bottom: -1px;
  left: 0;
  right: 0;
  background: #1a1a1a;
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