import { defineStore } from 'pinia'

export const useCacheStore = defineStore('cache', {
    state: () => ({
        homeData: null,
        featured_games: null,
        lastUpdated: null,
        featuredGamesLastUpdated: null,
        cacheTimeout: 86400000 // 24 horas em millisegundos (1 dia)
    }),

    getters: {
        getHomeCache: (state) => state.homeData,
        getFeaturedGames: (state) => state.featured_games,
        
        isValidCache: (state) => (key) => {
            // Verifica se tem dados no cache
            if (key === 'home' && !state.homeData) return false;
            if (key === 'featured_games' && !state.featured_games) return false;
            
            // Pega o timestamp correto baseado na key
            const lastUpdated = key === 'home' ? state.lastUpdated : state.featuredGamesLastUpdated;
            if (!lastUpdated) return false;
            
            // Verifica se o cache ainda é válido
            const now = new Date().getTime();
            return (now - lastUpdated) < state.cacheTimeout;
        }
    },

    actions: {
        setHomeData(data) {
            this.homeData = data;
            this.lastUpdated = new Date().getTime();
            console.log('Cache da home atualizado:', {
                data: this.homeData,
                timestamp: this.lastUpdated
            });
        },

        setFeaturedGames(games) {
            this.featured_games = games;
            this.featuredGamesLastUpdated = new Date().getTime();
            console.log('Cache dos jogos em destaque atualizado:', {
                games: this.featured_games,
                timestamp: this.featuredGamesLastUpdated
            });
        },

        clearCache() {
            this.homeData = null;
            this.featured_games = null;
            this.lastUpdated = null;
            this.featuredGamesLastUpdated = null;
            console.log('Cache limpo');
        }
    },
    
    persist: {
        enabled: true,
        strategies: [
            {
                key: 'cache-store',
                storage: localStorage,
                paths: ['homeData', 'featured_games', 'lastUpdated', 'featuredGamesLastUpdated']
            }
        ]
    }
}) 