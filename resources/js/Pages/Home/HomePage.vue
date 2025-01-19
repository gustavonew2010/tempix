<style>
.btn-scroll-top {
    position: relative;
    z-index: 2;
    bottom: 2em;
    display: none;
    align-items: center;
    background-color: #000000b3;
    border: 1px solid rgba(65, 105, 225, .7);
    color: #fff;
    cursor: pointer;
    font-size: 13px;
    gap: 0.5em;
    padding: 6px 12px;
    border-radius: 20px;
    margin-top: -30px;
    left: 48.5%;
    transform: translateX(-50%);
}

.categories-margin {
    margin-bottom: 15px;
}

.show-btn-scroll-top {
    display: block;
    display: flex;
}

.search-mobile {
    background-color: var(--ci-gray-dark);
    border-radius: 3px;
    font-size: 14px;
    padding-left: 40px;
    padding-top: 10px;
    padding-bottom: 10px;
}

.margin-search {
    margin-top: -6px;
}

.placeholder-search::placeholder {
    color: #ACAFAF;
    font-size: 13px;
}

@media(max-width:1024px) {
    .btn-scroll-top {
        bottom: 5em;
        padding: 2px 7px;
    }


    .item-sombra2 {
        position: relative;

    }

    .item-sombra2:after {
        content: "";
        position: absolute;
        bottom: 0;
        margin-right: -1px;
        right: 0;
        width: 25px;
        height: 100%;
        background: linear-gradient(to right, rgb(33 36 37 / 0%), var(--carousel-banners));
    }
}

.padding-mobile-banner {
    padding-top: 100px;
}

@media (max-width:768px) {
    .categories-margin {
        margin-top: 0px;
        margin-left: 20px;
    }

    #svg-lupa {
        margin-top: -2px;
    }

    .search-mobile {
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .margin-search {
        margin-top: 0px;
    }

    .padding-mobile-banner {
        padding: 0;
        padding-top: 40px;
    }
}

:root {
    --body-color: transparent !important;
    --ci-gray-dark: transparent !important;
}

.background-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-image: linear-gradient(rgba(28, 32, 37, 0.85),
            rgba(28, 32, 37, 0.85)), url('https://casb7k.s3.sa-east-1.amazonaws.com/uploads/storage/MJ0CX49xvFAcoPEgIMGSYLrz4Nrx0huZOsq4DUrc.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    z-index: 0;
}

.background-overlay::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(28, 32, 37, 0.25);
    z-index: -1;
}

.content-wrapper {
    position: relative;
    z-index: 1;
    min-height: 100vh;

}

.carousel-banners {
    position: relative;
    z-index: 2;
}

.mx-auto {
    position: relative;
    z-index: 2;
}

.search-container {
    position: relative;
    z-index: 999;
    margin: 2rem 0rem
}

.search-mobile {
    height: 48px;
    font-size: 1rem;
    padding: 0.75rem 3rem;
    width: 100%;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    color: white;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.5);
}

.category-item {
    position: relative;
    padding: 10px;
    overflow: hidden;
}

.category-icon {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    padding: 1.2rem;
    position: relative;
    border: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 1;
}

.category-name {
    margin-top: 0.8rem;
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    position: relative;
}

.category-icon-container {
    background-color: var(--ci-primary-opacity-color);
    border-radius: 50%;
    padding: 1rem;
    position: relative;
    width: 65px;
    height: 65px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.category-icon-container img {
    width: 35px;
    height: 35px;
    object-fit: contain;
    position: relative;
    z-index: 2;
}

@media (max-width: 768px) {
    .category-icon {
        padding: 0.8rem;
    }
}

.search-results-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: rgba(33, 36, 37, 0.95);
    border-radius: 12px;
    padding: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 9999;
    max-height: 80vh;
    overflow-y: auto;
}

.results-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(2, 1fr);
    padding: 8px;
    width: 100%;
}

@media (min-width: 640px) {
    .results-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 768px) {
    .results-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (min-width: 1024px) {
    .results-grid {
        grid-template-columns: repeat(6, 1fr);
    }
}

.game-card-skeleton {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    aspect-ratio: 3/4;
    background: rgba(255, 255, 255, 0.05);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.skeleton-image {
    width: 100%;
    height: 100%;
    background: linear-gradient(
        110deg,
        rgba(255, 255, 255, 0.05) 30%,
        rgba(255, 255, 255, 0.08) 50%,
        rgba(255, 255, 255, 0.05) 70%
    );
    background-size: 200% 100%;
    border-radius: 12px;
}

.skeleton-title {
    display: none; /* Removendo o título skeleton já que os cards reais não mostram título */
}

/* Ajustes específicos para mobile */
@media (max-width: 768px) {
    .results-grid {
        padding: 4px;
        gap: 8px;
        margin-bottom: 16px;
    }

    .game-card-skeleton {
        margin: 0 4px;
        padding: 2px;
        min-height: 160px;
        max-height: 200px;
    }
}

@keyframes shimmer {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

.animate-pulse {
    animation: shimmer 2s infinite linear;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .search-results-dropdown {
        animation: slideUp 0.3s ease-out;
    }
}

.loading-state {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 32px;
    color: var(--ci-primary-color);
    font-size: 24px;
}

.results-count {
    font-size: 0.875rem;
    margin-top: 8px;
    opacity: 0.7;
}

.loading-state {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 32px;
    color: var(--ci-primary-color);
    font-size: 24px;
}

.results-grid::-webkit-scrollbar {
    width: 6px;
}

.results-grid::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
}

.results-grid::-webkit-scrollbar-thumb {
    background: var(--ci-primary-color);
    border-radius: 3px;
}

.mx-auto.w-full.sm\:max-w-\[690px\].lg\:max-w-\[1210px\].px-4 {
    position: relative;
    z-index: 9999;
}

.search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
}

.search-overlay.active {
    opacity: 1;
    visibility: visible;
}

.search-container {
    position: relative;
    z-index: 999;
    margin: 2rem 0rem
}

.search-results-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: rgba(33, 36, 37, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 16px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    z-index: 9999;
    min-height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.initial-message {
    text-align: center;
    padding: 32px 16px;
    color: #8C9099;
    font-size: 0.875rem;
}

.game-card {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
}

.game-info-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    opacity: 0;
    transition: opacity 0.2s ease;
    background: rgba(0, 0, 0, 0.7);

}

.game-card:hover .game-info-overlay {
    opacity: 1;
}

.game-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
}

.provider-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 255, 255, 0.15);
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    color: white;
    font-weight: 500;
}

.game-cover {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 16px;
}

.latest-bets-container {
    background: rgba(33, 36, 37, 0.95);
    border-radius: 12px;
    width: 100%;
}

.latest-bets-wrapper {
    width: 100%;
}

.latest-bets-table {
    min-width: 800px;
    width: 100%;
    table-layout: fixed;
}

.table-header, .table-row {
    display: grid;
    grid-template-columns: 0.6fr 1fr 0.8fr 0.8fr 0.8fr 0.8fr;
    align-items: center;
    padding: 12px 16px;
    width: 100%;
}

.table-header {
    padding: 12px 16px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 8px 8px 0 0;
    position: sticky;
    top: 0;
    z-index: 1;
}

.table-body {
    overflow-y: auto;
}

.table-row {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.header-cell {
    font-weight: 600;
    color: #8C9099;
    font-size: 0.875rem;
}

.cell {
    font-size: 0.875rem;
    color: #fff;
}

.win {
    color: #00ff88;
    font-weight: 600;
}

.loss {
    color: #ff4444;
    font-weight: 500;
}

@media (max-width: 768px) {
    .latest-bets-container {
        margin: 0 -8px;
        border-radius: 8px;
    }

    .latest-bets-wrapper {
        padding: 12px 0;
    }

    .table-scroll-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .latest-bets-table {
        min-width: 800px;
    }

    .table-header, .table-row {
        padding: 8px;
        gap: 8px;
    }

    .header-cell, .cell {
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0 4px;
    }

    .time-cell {
        font-size: 10px;
    }

    .amount-cell, .prize-cell {
        font-size: 10px;
    }

    .table-scroll-container::-webkit-scrollbar {
        height: 5px;
        width: 5px;
    }

    .table-scroll-container::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .table-scroll-container::-webkit-scrollbar-thumb {
        background: var(--ci-primary-color);
        border-radius: 5px;
    }
}

.game-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.game-modal {
    position: relative;
    width: 100%;
    height: 100%;
    background: #000;
    overflow: hidden;
}

.game-frame {
    width: 100%;
    height: 100%;
    background: #000;
}

.close-button {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    z-index: 10;
}

.game-loading {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #000;
    color: white;
    gap: 1rem;
    font-size: 1.5rem;
}

.last-bets-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1rem;
}

.bet-item {
    transition: none;
    transform: none;
}

.bet-item:hover {
    transform: none;
    background: rgba(255, 255, 255, 0.1);
}

.bet-skeleton {
    animation: none;
    background: rgba(255, 255, 255, 0.1);
}

.bet-amount {
    transition: none;
}

.bet-amount:hover {
    transform: none;
}

.fade-enter-active,
.fade-leave-active {
    transition: none;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.game-container {
    position: relative;
    width: 100%;
    height: 80vh;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

.game-frame {
    width: 100%;
    height: 100%;
    border: none;
}

.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.8);
    color: white;
}

.close-button {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    cursor: pointer;
    z-index: 10;
}

.game-loading {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #000;
    color: white;
    gap: 1rem;
    font-size: 1.5rem;
}

.last-bets-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1rem;
}

.bet-item {
    transition: none;
    transform: none;
}

.bet-item:hover {
    transform: none;
    background: rgba(255, 255, 255, 0.1);
}

.bet-skeleton {
    animation: none;
    background: rgba(255, 255, 255, 0.1);
}

.bet-amount {
    transition: none;
}

.bet-amount:hover {
    transform: none;
}

.fade-enter-active,
.fade-leave-active {
    transition: none;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.game-container {
    animation: none;
}

.game-container.fade-out {
    animation: none;
}

.item-game {
    transition: none;
}

.item-game:hover {
    transform: none;
    background: var(--ci-primary-color);
}

.animate-pulse {
    animation: none;
}

.transition-colors {
    transition: none;
}

.featured-games-section {
    scroll-behavior: auto;
}

.header-container {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 1rem;
    padding: 1rem;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 50;
    background-color: #0F0F11;
}

.logo-container {
    display: flex;
    align-items: center;
}

.logo-container img {
    height: 35px;
    width: auto;
}

.menu-button {
    display: flex;
    align-items: center;
    justify-content: center;
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 0.5rem;
}

.carousel-banners {
    margin-top: 80px;
}

@media (max-width: 768px) {
    .logo-container img {
        height: 30px;
    }
}

.table-scroll-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 12px;
}

.table-scroll-container::-webkit-scrollbar {
    height: 6px;
    width: 6px;
}

.table-scroll-container::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    margin: 0 10px;
}

.table-scroll-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.05);
    transition: background 0.2s ease;
}

.table-scroll-container::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

.table-scroll-container {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) rgba(255, 255, 255, 0.05);
}
</style>
<template>
    <BaseLayout>
        <!-- Header fixo -->
        <div class="header-container">
            <button @click="toggleSidebar" class="menu-button">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <div class="logo-container">
                <a href="/" v-if="setting">
                    <img :src="`/storage/${setting.software_logo_black}`" alt="" class="block dark:hidden">
                    <img :src="`/storage/${setting.software_logo_white}`" alt="" class="hidden dark:block">
                </a>
            </div>
        </div>

        <!-- Resto do conteúdo -->
        <div class="background-overlay"></div>
        <div class="content-wrapper">
            <!-- Banners carousel com position relative -->
            <div class="carousel-banners" ref="bannerSection">
                <!-- Área do banner/jogo -->
                <div class="mx-auto w-full sm:max-w-[690px] lg:max-w-[1210px] padding-mobile-banner"
                    ref="gameContainer">
                    <!-- Mostra o jogo quando ativo -->
                    <div v-if="activeGame" ref="gameSection" class="game-container" :class="{ 'fade-out': isClosing }">
                        <div class="game-modal-header">
                            <div class="game-title-wrapper">
                                <i class="fa-duotone fa-gamepad-modern game-icon"></i>
                                <h3>{{ activeGame.game_name }}</h3>
                            </div>
                            <div class="game-controls">
                                <button @click="toggleFullscreen" class="control-button"
                                    :title="isFullscreen ? 'Sair da tela cheia' : 'Tela cheia'">
                                    <i class="fa-solid" :class="isFullscreen ? 'fa-compress' : 'fa-expand'"></i>
                                </button>
                                <button @click="closeGameModal" class="control-button" title="Fechar jogo">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>

                        <div v-if="isLoadingGame" class="game-loading">
                            <i class="fa-duotone fa-spinner-third fa-spin"></i>
                            <span>{{ $t('Carregando o jogo...') }}</span>
                        </div>

                        <iframe v-else-if="gameUrl" :src="gameUrl" frameborder="0" class="game-frame" allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Mostra o carousel quando não tem jogo ativo -->
                    <div v-else>
                        <Carousel v-bind="settings" :breakpoints="breakpoints" ref="carouselBanner">
                            <Slide v-for="(banner, index) in banners" :key="index">
                                <div class="carousel__item rounded w-full">
                                    <div @click="handleBannerClick(banner)"
                                        class="w-full h-full bg-blue-800 rounded cursor-pointer">
                                        <img :src="`/storage/${banner.image}`" :alt="banner.title || ''"
                                            class="h-full w-full rounded" style="max-height: 413px">
                                    </div>
                                </div>
                            </Slide>

                            <template #addons>
                                <navigation>
                                    <template #next>
                                        <i style="font-size: 18px;" class="fa-solid fa-chevron-right text-white"></i>
                                    </template>
                                    <template #prev>
                                        <i style="font-size: 18px;" class="fa-solid fa-chevron-left text-white"></i>
                                    </template>
                                </navigation>
                            </template>
                        </Carousel>
                    </div>
                </div>
            </div>

            <!-- Adicione o overlay antes do container de busca -->
            <div class="search-overlay" :class="{ active: showSearchResults }" @click="closeSearch"></div>

            <div class="mx-auto my-5 w-full sm:max-w-[690px] lg:max-w-[1210px] px-4">
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
                        class="search-mobile" 
                        v-model="searchTerm" 
                        type="search"
                        placeholder="Pesquise um jogo de cassino..." 
                        @focus="handleSearchFocus"
                        @keydown.enter="handleEnterKey"
                        ref="searchInput"
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
                        <div v-else-if="searchResults && searchResults.length > 0" class="results-grid">
                            <CassinoGameCard v-for="game in searchResults" :key="game.id" :game="game"
                                @open-game="openGameModal" />

                        </div>

                        <!-- Nenhum resultado encontrado -->
                        <div v-else-if="searchTerm.length >= 3" class="no-results">
                            <p>Nenhum jogo encontrado para "{{ searchTerm }}"</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto p-4x sm:max-w-[690px] lg:max-w-[1210px]">
                <!-- categories -->
                <div class="category-list item-sombra2 margin-categorias categories-margin">
                    <div class="flex gap-1 "
                        style="max-height: 200px; overflow-x: auto; overflow-y: hidden;margin-left: -10px;">
                        <div class="flex flex-row justify-between items-center w-full "
                            style="min-width: 100%; white-space: nowrap;">

                            <div v-for="(category, index) in categories" :key="index"
                                @click="filterGamesByCategory(category)"
                                class="flex flex-col justify-center items-center min-w-[80px] text-center cursor-pointer">
                                <div class="category-icon-container flex items-center justify-center">
                                    <img :src="`/storage/${category.image}`" alt="" width="35" height="35" class="">
                                </div>
                                <p class="mt-1 flex flex-wrap wrap" style="font-size: .75rem;">{{ $t(category.name) }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div v-if="!activeCategory" class="mt-10 mx-4">
                    <Carousel v-bind="settingsRecommended" :breakpoints="breakpointsRecommended"
                        ref="carouselSubBanner">
                        <Slide v-for="(banner, index) in bannersHome" :key="index">
                            <div class="carousel__item min-h-[60px] md:min-h-[150px] rounded-2xl w-full mr-4">
                                <div @click="handleBannerClick(banner)"
                                    class="w-full h-full rounded-2xl cursor-pointer">
                                    <img :src="`/storage/${banner.image}`" :alt="banner.title || ''"
                                        class="h-full w-full rounded-2xl">
                                </div>
                            </div>
                        </Slide>

                        <template #addons>
                        </template>
                    </Carousel>
                </div>


                <div v-if="featured_games" class="mt-3">

                    <div class="w-full flex justify-between mb-2">
                        <div class="flex items-center">
                            <h2 class="text-lg" style="color: white">
                                {{ activeCategory ? activeCategory.name : $t('Recomendados') }}
                            </h2>
                            <button v-if="activeCategory" @click="clearCategoryFilter"
                                class="ml-2 px-3 py-1 rounded-lg text-sm bg-red-500 hover:bg-red-600 text-white flex items-center">
                                <i class="fa-solid fa-xmark mr-1"></i>
                                Limpar filtro
                            </button>
                            <div v-else class="flex">
                                <button @click.prevent="fgCarousel.prev()"
                                    class="item-game px-2 py-1 rounded-lg text-[12px] ml-2 mr-2 celular-providers-setas">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button @click.prevent="fgCarousel.next()"
                                    class="item-game px-2 py-1 rounded-lg text-[12px] celular-providers-setas">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex">

                        </div>

                    </div>

                    <!-- Loading state com skeleton -->
                    <div v-if="isLoading" class="results-grid">
                        <div v-for="i in skeletonCount" :key="i" class="game-card-skeleton">
                            <div class="animate-pulse">
                                <div class="skeleton-image"></div>
                                <div class="skeleton-title"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Estado vazio centralizado -->
                    <div v-else-if="activeCategory && (!filteredGames || filteredGames.length === 0)"
                        class="flex justify-center items-center min-h-[200px] text-gray-400">
                        <div class="text-center">
                            <i class="fa-duotone fa-ghost text-6xl mb-4 block"></i>
                            <p class="text-lg">Nenhum jogo disponível nesta categoria</p>
                        </div>
                    </div>

                    <!-- Games carousel -->
                    <Carousel v-else class="item-sombra2" ref="fgCarousel" v-bind="settingsGames"
                        :breakpoints="breakpointsGames">
                        <Slide v-for="(game, providerId) in displayedGames" :key="providerId" class="p-2">
                            <CassinoGameCard :index="providerId" :title="game.game_name" :cover="game.cover"
                                :gamecode="game.game_code" :type="game.distribution" :game="game"
                                @open-game="openGameModal" />
                        </Slide>
                    </Carousel>
                </div>

                <div v-if="!activeCategory" class="mt-5 ">
                    <ShowProviders v-for="(provider, index) in providers" :provider="provider" :index="index"
                        @open-game="openGameModal" />
                </div>


            </div>

            <div v-if="!activeCategory"
                class="latest-bets-container mx-auto w-full sm:max-w-[690px] lg:max-w-[1210px] px-4 mt-8 mb-16">
                <div class="latest-bets-wrapper">
                    <div class="latest-bets-header">
                        <h2 class="text-white text-lg mb-4">Últimas Apostas</h2>
                    </div>
                    <!-- Novo container para scroll -->
                    <div class="table-scroll-container">
                        <div class="latest-bets-table">
                            <div class="table-header">
                                <div class="header-cell">Horário</div>
                                <div class="header-cell">Jogo</div>
                                <div class="header-cell">Usuário</div>
                                <div class="header-cell">Valor da Aposta</div>
                                <div class="header-cell">Multiplicador</div>
                                <div class="header-cell">Premiação</div>
                            </div>
                            <div class="table-body">
                                <div v-for="bet in latestBets" :key="bet.id" class="table-row">
                                    <div class="cell time-cell">{{ bet.time }}</div>
                                    <div class="cell game-cell">{{ bet.game }}</div>
                                    <div class="cell user-cell">{{ bet.user }}</div>
                                    <div class="cell amount-cell">R$ {{ bet.amount.toFixed(2) }}</div>
                                    <div class="cell multiplier-cell"
                                        :class="{ 'win': bet.multiplier > 1, 'loss': bet.multiplier < 1 }">
                                        x{{ bet.multiplier.toFixed(3) }}
                                    </div>
                                    <div class="cell prize-cell"
                                        :class="{ 'win': bet.multiplier > 1, 'loss': bet.multiplier < 1 }">
                                        R$ {{ bet.prize.toFixed(2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </BaseLayout>
</template>

<script>
import {
    Carousel,
    Navigation,
    Pagination,
    Slide
} from 'vue3-carousel';
import {
    onMounted,
    ref,
    provide,
    defineAsyncComponent,
    onUnmounted
} from "vue";

import BaseLayout from "@/Layouts/BaseLayout.vue";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import {
    RouterLink,
    useRoute
} from "vue-router";
import {
    useAuthStore
} from "@/Stores/Auth.js";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import HttpApi from "@/Services/HttpApi.js";
import ShowCarousel from "@/Pages/Home/Components/ShowCarousel.vue";
import {
    useSettingStore
} from "@/Stores/SettingStore.js";
import LoadingScreen from "@/Components/UI/LoadingScreen.vue";
import {
    searchGameStore
} from "@/Stores/SearchGameStore.js";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import mitt from 'mitt'; // Adicione esta importação
import { useRouter } from 'vue-router' 
// Crie um emitter global
export const emitter = mitt();

export default {
    props: [],
    components: {
        CustomPagination,
        Pagination,
        ShowProviders: defineAsyncComponent(() => 
          import('@/Pages/Home/Components/ShowProviders.vue')
        ),
        CassinoGameCard: defineAsyncComponent(() => 
          import('@/Pages/Cassino/Components/CassinoGameCard.vue')
        ),
        LoadingScreen,
        ShowCarousel,
        Carousel,
        Navigation,
        Slide,
        LanguageSelector,
        MakeDeposit,
        BaseLayout,
        RouterLink
    },
    data() {
        return {
            loading: true,
            isLoading: true,

            /// banners settings
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                autoplay: 6000,
                wrapAround: true,
                pauseAutoplayOnHover: true,
                mouseDrag: true,
                touchDrag: true,
                pagination: true
            },
            breakpoints: {
                700: {
                    itemsToShow: 1,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 1,
                    snapAlign: 'center',
                },
            },

            settingsRecommended: {
                itemsToShow: 2,
                snapAlign: 'start',
            },
            breakpointsRecommended: {
                700: {
                    itemsToShow: 3,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 3,
                    snapAlign: 'start',
                },
            },

            /// banners
            banners: null,
            bannersHome: null,

            settingsGames: {
                itemsToShow: 2.5,
                snapAlign: 'start',
            },
            breakpointsGames: {
                700: {
                    itemsToShow: 3.5,
                    snapAlign: 'center',
                },
                1024: {
                    itemsToShow: 6,
                    snapAlign: 'start',
                },
            },
            settingsImages: {
                itemsToShow: 2,
                snapAlign: 'start',
            },
            providers: null,

            featured_games: null,
            categories: null,
            searchTerm: '',
            showSearchResults: false,
            searchResults: [],
            isSearchLoading: false,
            latestBets: [],
            updateInterval: null,
            allGamesNames: [], // Será preenchido com os nomes dos jogos reais
            activeGame: null,
            gameUrl: null,
            isLoadingGame: false,
            isFullscreen: false,
            isClosing: false,
            filteredGames: [],
            activeCategory: null,
            skeletonCount: 6, // Added for the new loading state
        }
    },
    setup(props) {
        const ckCarouselOriginals = ref(null)
        const fgCarousel = ref(null)
        const router = useRouter();

        onMounted(() => {
            // Prefetch components when idle
            if ('requestIdleCallback' in window) {
                requestIdleCallback(() => {
                    import('@/Pages/Home/Components/ShowProviders.vue')
                    import('@/Pages/Cassino/Components/CassinoGameCard.vue')
                })
            }
        });

        return {
            ckCarouselOriginals,
            fgCarousel,
            router
        };

    },
    computed: {
        searchGameStore() {
            return searchGameStore();
        },
        userData() {
            const authStore = useAuthStore();
            return authStore.user;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        setting() {
            const settingStore = useSettingStore();
            return settingStore.setting;
        },
        displayedGames() {
            if (this.activeCategory) {
                if (this.filteredGames === null) {
                    return [];  // Retorna array vazio quando não há jogos
                }
                return this.filteredGames;
            }
            return this.featured_games;
        },
        skeletonCount() {
            // Retorna número diferente de skeletons baseado no tamanho da tela
            if (window.innerWidth <= 640) {
                return 4; // 2x2 grid em mobile pequeno
            } else if (window.innerWidth <= 768) {
                return 6; // 2x3 grid em mobile
            } else if (window.innerWidth <= 1024) {
                return 8; // 2x4 grid em tablets
            }
            return 12; // Desktop
        }
    },
    mounted() {
        window.scrollTo(0, 0);
        window.addEventListener('scroll', () => {
            const btnScrollTop = document.querySelector('.btn-scroll-top');
            if (btnScrollTop) {  // Adiciona verificação de existência
                if (window.scrollY > 100) {
                    btnScrollTop.classList.add('show-btn-scroll-top');
                } else {
                    btnScrollTop.classList.remove('show-btn-scroll-top');
                }
            }
        });
        // Fecha o dropdown quando clicar fora
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-container')) {
                this.showSearchResults = false;
            }
        });

        // Inicializa com algumas apostas
        for (let i = 0; i < 10; i++) {
            this.latestBets.push(this.generateRandomBet());
        }

        // Inicia as atualizações
        this.updateBets();

        // Adiciona os listeners usando o emitter
        emitter.on('filter-category', (category) => {
            console.log('Recebido evento de filtro:', category);
            this.filterGamesByCategory(category);
        });

        emitter.on('open-game', (game) => {
            this.openGameModal(game);
        });

        this.initScrollHandler();
    },
    methods: {
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleBannerClick(banner) {
            if (banner.link) {
                // Verifica se é um link de jogo
                const gameMatch = banner.link.match(/\/games\/play\/(\d+)\/([^/]+)/);
                const gameSlug = gameMatch[1];

                // Navega para o GameLoader usando o router do Vue
                this.$router.push({
                    name: 'game.play',
                    params: {
                        slug: gameSlug
                    }
                });

            }
        },
        getCasinoCategories: async function () {
            const _this = this;
            await HttpApi.get('categories')
                .then(response => {
                    _this.categories = response.data.categories;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                });
        },
        toggleSearch: function () {
            this.searchGameStore.setSearchGameToogle();
        },
        getBanners: async function () {
            const _this = this;

            try {
                const response = await HttpApi.get('settings/banners');
                const allBanners = response.data.banners;

                _this.banners = allBanners.filter(banner => banner.type === 'carousel');
                _this.bannersHome = allBanners.filter(banner => banner.type === 'home');
            } catch (error) {
                console.error(error);
            } finally {

            }
        },
        getAllGames: async function () {
            const _this = this;
            return await HttpApi.get('games/all')
                .then(async response => {
                    if (response.data !== undefined) {
                        _this.providers = response.data.providers;
                        _this.isLoading = false;
                    }
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        getFeaturedGames: async function () {
            const _this = this;
            return await HttpApi.get('featured/games')
                .then(async response => {


                    _this.featured_games = response.data.featured_games;
                    _this.isLoading = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(`${value}`);
                    });
                    _this.isLoading = false;
                });
        },
        async loadInitialData() {
            try {
                // Carrega todos os dados necessários
                await Promise.all([
                    this.getCasinoCategories(),
                    this.getBanners(),
                    this.getAllGames(),
                    this.getFeaturedGames()
                ]);
            } catch (error) {
                console.error('Erro ao carregar dados:', error);
            }
        },
        onCarouselInit(index) {

        },
        onSlideStart(index) {

        },
        async searchGames(term) {
            if (term.length < 3) return;

            this.isSearchLoading = true;
            
            try {
                const response = await HttpApi.get('/search/games', {
                    params: { searchTerm: term },
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.data && response.data.games && response.data.games.data) {
                    this.searchResults = response.data.games.data;
                    
                    // Fecha o teclado após receber os resultados
                    if (this.$refs.searchInput) {
                        this.$refs.searchInput.blur();
                    }
                } else {
                    this.searchResults = [];
                }
            } catch (error) {
                console.error('Erro na busca:', error);
                this.searchResults = [];
            } finally {
                this.isSearchLoading = false;
            }
        },
        generateRandomName() {
            const consoantes = 'bcdfghjklmnpqrstvwxyz';
            const vogais = 'aeiou';
            let name = '';

            // Gera um nome de 3-5 caracteres
            const nameLength = Math.floor(Math.random() * 3) + 3;

            for (let i = 0; i < nameLength; i++) {
                if (i % 2 === 0) {
                    name += consoantes[Math.floor(Math.random() * consoantes.length)];
                } else {
                    name += vogais[Math.floor(Math.random() * vogais.length)];
                }
            }

            // Adiciona asteriscos para mascarar
            const asterisks = '***';
            return name.charAt(0).toUpperCase() + name.slice(1, 2) + asterisks;
        },

        generateRandomAmount() {
            // Gera valores entre 5 e 200
            return Number((Math.random() * 195 + 5).toFixed(2));
        },

        generateRandomMultiplier() {
            // 80% de chance de perder (multiplicador < 1)
            // 20% de chance de ganhar (multiplicador > 1)
            const isWin = Math.random() > 0.5;

            if (isWin) {
                // Quando ganha, multiplicador mais controlado entre 1.1 e 30
                return Number((Math.random() * 28.9 + 1.1).toFixed(3));
            } else {
                // Quando perde, multiplicador entre 0 e 0.99
                return Number((Math.random() * 0.99).toFixed(3));
            }
        },

        getRandomGame() {
            // Usa os jogos reais do sistema
            if (this.allGamesNames.length === 0 && this.providers) {
                // Preenche o array de nomes de jogos se estiver vazio
                this.providers.forEach(provider => {
                    provider.games.forEach(game => {
                        this.allGamesNames.push(game.game_name);
                    });
                });
            }

            // Caso ainda não tenha jogos carregados, usa um nome genérico
            if (this.allGamesNames.length === 0) {
                return 'Slot Game';
            }

            return this.allGamesNames[Math.floor(Math.random() * this.allGamesNames.length)];
        },

        formatTime(date) {
            return date.toLocaleTimeString('pt-BR', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        },

        generateRandomBet() {
            const amount = this.generateRandomAmount();
            const multiplier = this.generateRandomMultiplier();

            return {
                id: Date.now() + Math.random(),
                game: this.getRandomGame(),
                user: this.generateRandomName(),
                amount: amount,
                multiplier: multiplier,
                prize: Number((amount * multiplier).toFixed(2)),
                time: this.formatTime(new Date()) // Adiciona o horário atual
            };
        },

        updateBets() {
            // Adiciona apenas 1 nova aposta por vez
            this.latestBets.unshift(this.generateRandomBet());

            // Mantém apenas as últimas 10 apostas
            this.latestBets = this.latestBets.slice(0, 10);

            // Define próximo intervalo aleatório (entre 1 e 3 segundos)
            const nextUpdate = Math.floor(Math.random() * 2000) + 1000;
            this.updateInterval = setTimeout(() => this.updateBets(), nextUpdate);
        },
        async handleCategoryClick(category) {
            console.log('Category clicked:', category);

            // Se o slug for null, é uma categoria para filtrar
            if (category.slug === null) {
                await this.filterGamesByCategory(category);
            } else {
                // Se tiver slug, é um jogo direto
                const gameData = {
                    id: category.id,
                    game_name: category.name,
                    slug: category.slug
                };
                await this.openGameModal(gameData);
            }
        },

        async filterGamesByCategory(category) {
            this.isLoading = true; // Ativa o loading
            this.activeCategory = category;
            this.filteredGames = null; // Limpa os jogos anteriores

            try {
                const response = await HttpApi.get(`games/category/${category.id}`);
                
                if (response.data && response.data.games && response.data.games.length > 0) {
                    console.log('Jogos encontrados:', response.data.games.length);
                    this.filteredGames = response.data.games;
                } else {
                    console.log('Nenhum jogo encontrado');
                    this.filteredGames = null;
                }

            } catch (error) {
                console.error('Error filtering games:', error);
                this.filteredGames = null;
            } finally {
                this.isLoading = false; // Desativa o loading independente do resultado
            }
        },

        async openGameModal(game) {
            console.log('Opening game:', game);

            if (!this.isAuthenticated) {
                this.$router.push('/login');
                return;
            }

            this.activeGame = game;
            this.isLoadingGame = true;

            try {

                // Scroll suave para a seção do jogo
                const bannerSection = this.$refs.bannerSection;
                if (bannerSection) {
                    const offset = 20; // Ajuste este valor conforme necessário
                    const elementPosition = bannerSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }

                // Se o jogo tem slug, usa ele diretamente
                if (game.slug) {
                    const response = await HttpApi.get(`games/single/${game.slug}`);
                    if (response.data && response.data.gameUrl) {
                        this.gameUrl = response.data.gameUrl;
                    }
                } else {
                    // Caso contrário, busca a URL do jogo na API
                    const response = await HttpApi.get(`games/single/${game.id}`);
                    if (response.data && response.data.gameUrl) {
                        this.gameUrl = response.data.gameUrl;
                    }
                }
                await this.$nextTick();


            } catch (error) {
                console.error('Error loading game:', error);
                this.gameUrl = null;
            } finally {
                this.isLoadingGame = false;
            }
        },
        closeGameModal() {
            this.activeGame = null;
            this.gameUrl = null;
        },
        toggleFullscreen() {
            if (!document.fullscreenElement) {
                this.$refs.gameSection.requestFullscreen();
                this.isFullscreen = true;
            } else {
                document.exitFullscreen();
                this.isFullscreen = false;
            }
        },
        clearCategoryFilter() {
            this.activeCategory = null;
            this.filteredGames = null;
        },
        initScrollHandler() {
            const handleScroll = () => {
                const btnScrollTop = document.querySelector('.btn-scroll-top');
                if (btnScrollTop) {
                    if (window.scrollY > 100) {
                        btnScrollTop.classList.add('show-btn-scroll-top');
                        btnScrollTop.classList.remove('opacity-0', 'invisible');
                    } else {
                        btnScrollTop.classList.remove('show-btn-scroll-top');
                        btnScrollTop.classList.add('opacity-0', 'invisible');
                    }
                }
            };

            // Adiciona o listener
            window.addEventListener('scroll', handleScroll);
            
            // Garante que o handler seja chamado uma vez para configurar o estado inicial
            handleScroll();

            // Cleanup quando o componente for desmontado
            onUnmounted(() => {
                window.removeEventListener('scroll', handleScroll);
            });
        },
        closeSearch() {
            this.showSearchResults = false;
            document.body.style.overflow = 'auto';
        },
        handleSearchFocus() {
            this.showSearchResults = true;
            document.body.style.overflow = 'hidden';
            
            // Ajuste mais suave do scroll
            setTimeout(() => {
                if (this.$refs.searchContainer) {
                    const headerHeight = 80; // Altura aproximada do header fixo
                    const containerTop = this.$refs.searchContainer.getBoundingClientRect().top;
                    const currentScroll = window.pageYOffset;
                    
                    // Calcula a posição ideal mantendo o input visível
                    const targetScroll = currentScroll + containerTop - headerHeight - 20;
                    
                    // Só faz scroll se o input estiver abaixo do header
                    if (containerTop > headerHeight) {
                        window.scrollTo({ 
                            top: targetScroll, 
                            behavior: 'smooth' 
                        });
                    }
                }
            }, 100);
        },
        handleEnterKey(event) {
            // Fecha o teclado no mobile
            if (this.$refs.searchInput) {
                this.$refs.searchInput.blur();
            }
            
            // Previne o comportamento padrão do enter
            event.preventDefault();
            
            // Se tiver pelo menos 3 caracteres, realiza a busca
            if (this.searchTerm.length >= 3) {
                this.searchGames(this.searchTerm);
            }
        }
    },
    async beforeMount() {
        // Garante que os dados sejam carregados antes de montar o componente
        await this.loadInitialData();
        // Adiciona um pequeno delay para melhor UX
        await new Promise(r => setTimeout(r, 1500));
        this.loading = false;
    },
    watch: {
        searchTerm(newValue) {
            // Realiza a busca automaticamente após digitar
            if (newValue.length >= 3) {
                this.searchGames(newValue);
            }
        },
        showSearchResults(newValue) {
            if (!newValue) {
                document.body.style.overflow = 'auto';
            } else {
                document.body.style.overflow = 'hidden';
            }
        }
    },
    beforeUnmount() {
        if (this.updateInterval) {
            clearTimeout(this.updateInterval);
        }
        // Remove os listeners quando o componente for desmontado
        emitter.off('filter-category');
        emitter.off('open-game');
        document.body.style.overflow = 'auto';
    },
    created() {
        // Adiciona os listeners dos eventos
        window.addEventListener('filterGames', (event) => {
            console.log('Evento filterGames recebido:', event.detail);
            if (event.detail) {
                this.filterGamesByCategory(event.detail);
            }
        });

        window.addEventListener('openGame', (event) => {
            console.log('Evento openGame recebido:', event.detail);
            if (event.detail) {
                this.openGameModal(event.detail);
            }
        });
    },
    beforeDestroy() {
        // Remove os listeners quando o componente for destruído
        window.removeEventListener('filterGames', this.filterGamesByCategory);
        window.removeEventListener('openGame', this.openGameModal);
    },
};
</script>
