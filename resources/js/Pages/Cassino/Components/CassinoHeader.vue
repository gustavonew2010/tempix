<template>
    <div class="casino-header">
        <div class="flex items-center gap-4">
            <button 
                v-if="hasActiveFilters"
                @click="clearFilters" 
                class="back-button"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" fill="currentColor"/>
                </svg>
                <span>Todos os jogos</span>
            </button>
            <h1 v-else class="text-xl text-white font-medium">Todos os jogos</h1>
        </div>

        <div class="flex items-center gap-4">
            <!-- Busca -->
            <div class="search-container">
                <input 
                    type="text" 
                    v-model="searchQuery"
                    placeholder="Pesquise um jogo..."
                    class="search-input"
                >
                <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.5 17.5L13.875 13.875" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <!-- Filtro de Provedores -->
            <select 
                v-model="selectedProvider"
                class="filter-select"
                @change="emitFilters"
            >
                <option value="">Provedores: Todos</option>
                <option v-for="provider in providers" 
                        :key="provider.id" 
                        :value="provider.code"
                >
                    {{ provider.code }}
                </option>
            </select>

            <!-- Filtro de Categorias -->
            <select 
                v-model="selectedCategory"
                class="filter-select"
                @change="emitFilters"
            >
                <option value="">Categorias: Todas</option>
                <option v-for="category in categories" 
                        :key="category.id" 
                        :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, computed } from 'vue';

const props = defineProps({
    providers: {
        type: Array,
        default: () => []
    },
    categories: {
        type: Array,
        default: () => []
    },
    loading: {
        type: Boolean,
        default: false
    },
    total: {
        type: Number,
        required: true
    },
    currentPage: {
        type: Number,
        required: true
    },
    perPage: {
        type: Number,
        required: true
    },
    initialFilters: {
        type: Object,
        default: () => ({
            category: '',
            provider: '',
            search: ''
        })
    }
});

const emit = defineEmits(['update:filters', 'load-more', 'reset-view']);

const searchQuery = ref('');
const selectedProvider = ref('');
const selectedCategory = ref('');

// Observa mudanças nos initialFilters
watch(() => props.initialFilters, (newFilters) => {
    if (newFilters) {
        searchQuery.value = newFilters.search || '';
        selectedProvider.value = newFilters.provider || '';
        selectedCategory.value = newFilters.category || '';
    }
}, { immediate: true, deep: true });

// Watch para emitir alterações nos filtros com debounce para a busca
let searchTimeout;
watch(searchQuery, (newValue) => {
    clearTimeout(searchTimeout);
    if (newValue.length >= 3 || newValue.length === 0) {
        searchTimeout = setTimeout(() => {
            emitFilters();
        }, 300);
    }
});

// Watch para os selects
watch([selectedProvider, selectedCategory], () => {
    emitFilters();
});

// Função para emitir os filtros
const emitFilters = () => {
    const filters = {
        search: searchQuery.value?.trim() || '',
        provider: selectedProvider.value || '',
        category: selectedCategory.value || ''
    };
    emit('update:filters', filters);
};

// Computed para verificar se há filtros ativos
const hasActiveFilters = computed(() => {
    return searchQuery.value || selectedProvider.value || selectedCategory.value;
});

// Método para limpar filtros
const clearFilters = () => {
    searchQuery.value = '';
    selectedProvider.value = '';
    selectedCategory.value = '';
    emitFilters();
    emit('reset-view');
};
</script>

<style scoped>
.casino-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.back-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 1rem;
    font-weight: 500;
    transition: opacity 0.2s;
}

.back-button:hover {
    opacity: 0.8;
}

.search-container {
    position: relative;
    width: 300px;
}

.search-input {
    width: 100%;
    padding: 0.5rem 1rem 0.5rem 2.5rem;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: white;
    font-size: 0.875rem;
    transition: all 0.2s;
}

.search-input:focus {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.2);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.5);
}

.filter-select {
    padding: 0.5rem 2rem 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: white;
    font-size: 0.875rem;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    transition: all 0.2s;
}

.filter-select:focus {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.2);
    outline: none;
}

@media (max-width: 768px) {
    .casino-header {
        flex-direction: column;
        gap: 1rem;
    }

    .search-container {
        width: 100%;
    }

    .filter-select {
        width: 100%;
    }
}
</style> 