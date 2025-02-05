<template>
    <div class="casino-header">
        <!-- Linha superior: texto + ícone de voltar e área direita com ícones (no mobile) ou input/select (desktop) -->
        <div class="header-top">
            <div class="left-header">
                <button 
                    v-if="hasActiveFilters"
                    @click="clearFilters" 
                    class="back-button"
                >
                    <svg class="back-icon" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                    </svg>
                </button>
                <svg 
                    v-else 
                    class="back-icon disabled" 
                    width="24" 
                    height="24" 
                    viewBox="0 0 24 24"
                >
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                </svg>
                <h1 class="title">Todos os jogos</h1>
            </div>
            <!-- Área direita -->
            <!-- Se não for mobile, exibe input e selects na mesma linha -->
            <div class="right-header" v-if="!isMobile">
                <div class="search-container">
                    <input 
                        type="text" 
                        v-model="searchQuery"
                        placeholder="Pesquise um jogo..."
                        class="search-input"
                    >
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 17.5L13.875 13.875" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <select 
                    v-model="selectedProvider"
                    class="filter-select"
                    :class="{ 'active-filter': selectedProvider }"
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
                <select 
                    v-model="selectedCategory"
                    class="filter-select"
                    :class="{ 'active-filter': selectedCategory }"
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
            <!-- Mobile: mostra somente os ícones nesta linha -->
            <div class="right-header" v-else>
                <button class="icon-button" @click="showFilterMobile" :class="{ 'active-icon': mobileMode === 'selects' }">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M3 4h18l-7 8v6l-4-4v-4z" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"/>
                    </svg>
                </button>
                <button class="icon-button" @click="showSearchMobile" :class="{ 'active-icon': mobileMode === 'search' }">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2" fill="none"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Linha inferior para mobile: exibe input OU selects, dependendo do modo -->
        <div class="header-bottom" v-if="isMobile">
            <div v-if="mobileMode === 'search'" class="mobile-search">
                <div class="search-container">
                    <input 
                        type="text" 
                        v-model="searchQuery"
                        placeholder="Pesquise um jogo..."
                        class="search-input"
                    >
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20">
                        <path d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 17.5L13.875 13.875" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div v-else class="mobile-filters">
                <select 
                    v-model="selectedProvider"
                    class="filter-select"
                    :class="{ 'active-filter': selectedProvider }"
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
                <select 
                    v-model="selectedCategory"
                    class="filter-select"
                    :class="{ 'active-filter': selectedCategory }"
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
    </div>
</template>

<script setup>
import { ref, watch, computed, onMounted, onUnmounted } from 'vue';

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

// Estado para o modo mobile: 'selects' exibe os selects, 'search' exibe o input
const mobileMode = ref('selects');

// Responsividade: detecta se é mobile
const isMobile = ref(window.innerWidth <= 768);
const updateIsMobile = () => {
    isMobile.value = window.innerWidth <= 768;
};
onMounted(() => {
    window.addEventListener('resize', updateIsMobile);
});
onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile);
});

// Observa alterações nos filtros iniciais
watch(() => props.initialFilters, (newFilters) => {
    if (newFilters) {
        searchQuery.value = newFilters.search || '';
        selectedProvider.value = newFilters.provider || '';
        selectedCategory.value = newFilters.category || '';
    }
}, { immediate: true, deep: true });

// Debounce para o searchQuery
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

const emitFilters = () => {
    const filters = {
        search: searchQuery.value?.trim() || '',
        provider: selectedProvider.value || '',
        category: selectedCategory.value || ''
    };
    emit('update:filters', filters);
};

const hasActiveFilters = computed(() => {
    return searchQuery.value || selectedProvider.value || selectedCategory.value;
});

const clearFilters = () => {
    searchQuery.value = '';
    selectedProvider.value = '';
    selectedCategory.value = '';
    emitFilters();
    emit('reset-view');
};

// Funções para alternar o modo mobile
const showFilterMobile = () => {
    mobileMode.value = 'selects';
};

const showSearchMobile = () => {
    mobileMode.value = 'search';
};
</script>

<style scoped>
.casino-header {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    border-bottom: 0.0625rem solid rgba(1, 1, 1, 0.1);
}

/* Linha superior */
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Lado esquerdo: seta e título */
.left-header {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.back-button {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
}

.back-icon {
    width: 1.5rem;
    height: 1.5rem;
    fill: white;
}

.back-icon.disabled {
    opacity: 0.5;
}

.title {
    font-size: 1.25rem;
    color: white;
    margin: 0;
}

/* Lado direito */
.right-header {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Search input e container */
.search-container {
    position: relative;
}

.search-input {
    padding: 0.5rem 2.5rem 0.5rem 2.5rem;
    font-size: 1rem;
    border: 0.0625rem solid rgba(255, 255, 255, 0.2);
    border-radius: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1rem;
}

.search-icon {
    position: absolute;
    left: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    width: 1rem;
    height: 1rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Selects */
.filter-select {
    padding: 0.5rem;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.1);
    border: 0.0625rem solid rgba(255, 255, 255, 0.2);
    border-radius: 0.5rem;
    color: white;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5 5L9 1' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
}

/* Estilo para filtro ativo */
.filter-select.active-filter {
    border-color: #00A2D4;
}

/* Linha inferior para mobile */
.header-bottom {
    margin-top: 1rem;
}

/* Espaço para o modo mobile */
.mobile-search,
.mobile-filters {
    display: flex;
    gap: 1rem;
}

.mobile-search .search-container,
.mobile-filters .filter-select {
    flex: 1;
}

/* Botões de ícones (mobile) */
.icon-button {
    background: none;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    color: white; /* Cor padrão: branco */
}

/* Quando ativo, altera a cor para azul */
.icon-button.active-icon {
    color: #00A2D4 !important;
}

/* Faz com que os SVG usem o currentColor para definir stroke e fill */
.icon-button svg {
    stroke: currentColor;
    fill: currentColor;
}
</style> 