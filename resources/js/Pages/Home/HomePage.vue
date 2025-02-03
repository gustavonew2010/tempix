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
 
.home-container {
    width: 100%;
    max-width: var(--content-width, 1200px);
    margin: 0 auto;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.categories-margin {
    margin-bottom: 0.25rem;
    max-width: 1000px; /* Limita a largura máxima */
    margin-left: auto;
    margin-right: auto;
    padding: 0 1rem;
}

.show-btn-scroll-top {
    display: block;
    display: flex;
}

.search-mobile {
    height: 48px;
    width: 100%;
    padding: 0.75rem 3rem;
    font-size: 0.875rem;
    color: white;
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    border-radius: 12px;
    transition: all 0.2s ease;
}

.search-mobile:focus {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
    box-shadow: 0 0 0 2px rgba(0, 122, 255, 0.1);
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
        margin: 0;
        padding: 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE and Edge */
    }

    .categories-margin::-webkit-scrollbar {
        display: none; /* Chrome, Safari and Opera */
    }

    .categories-container {
        display: flex;
        padding: 0.5rem 1rem;
        gap: 1rem;
        width: max-content;
    }

    .category-item {
        flex: 0 0 auto;
        width: 70px; /* Largura fixa para cada item */
    }

    .category-icon {
        padding: 0.6rem;
    }

    .category-name {
        font-size: 0.7rem;
        margin-top: 0.5rem;
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
        padding-top: 20px; /* Reduzido o padding no mobile */
    }

    .search-section {
        margin-bottom: 0.5rem; /* Reduzido margin no mobile */
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
    background-image: linear-gradient(rgba(0, 122, 255, 0.15),
            rgba(0, 153, 255, 0.25)), url('https://casb7k.s3.sa-east-1.amazonaws.com/uploads/storage/MJ0CX49xvFAcoPEgIMGSYLrz4Nrx0huZOsq4DUrc.webp');
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
    background-color: rgba(0, 122, 255, 0.1);
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
    z-index: 30;
    width: 100%;
    margin: 1rem 0;
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
    padding: 8px; /* Reduzido de 10px para 8px */
    overflow: hidden;
}

.category-icon {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    padding: 0.8rem; /* Reduzido de 1.2rem para 0.8rem */
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
    background: rgba(33, 36, 37, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
    max-height: 80vh;
    overflow-y: auto;
    transform-origin: top;
    animation: dropdownEnter 0.2s ease;
}

/* Estados do dropdown */
.initial-message,
.loading-state,
.no-results {
    padding: 2rem;
    text-align: center;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.875rem;
}

/* Grid de resultados responsivo */
.results-grid {
    display: grid;
    gap: 1rem;
    padding: 1rem;
}

/* Responsividade do grid */
@media (min-width: 640px) {
    .results-grid { grid-template-columns: repeat(3, 1fr); }
}

@media (min-width: 768px) {
    .results-grid { grid-template-columns: repeat(4, 1fr); }
}

@media (min-width: 1024px) {
    .results-grid { grid-template-columns: repeat(5, 1fr); }
}

/* Informações de resultados e paginação */
.search-results-info {
    padding: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.results-count {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.813rem;
    margin-bottom: 0.5rem;
}

/* Botão de carregar mais */
.load-more-button {
    background: linear-gradient(135deg, #007AFF 0%, #0063CC 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.load-more-button:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 122, 255, 0.2);
}

.load-more-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Scrollbar personalizada */
.search-results-dropdown::-webkit-scrollbar {
    width: 8px;
}

.search-results-dropdown::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 4px;
}

.search-results-dropdown::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
    transition: background 0.2s ease;
}

.search-results-dropdown::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Animações */
@keyframes dropdownEnter {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Overlay para mobile */
.search-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 39;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
}

.search-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Ajustes para mobile */
@media (max-width: 768px) {
    .search-results-dropdown {
        position: fixed;
        top: 60px; /* Ajuste conforme o header */
        left: 1rem;
        right: 1rem;
        bottom: 1rem;
        max-height: none;
        animation: mobileDropdownEnter 0.3s ease;
    }

    .results-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }

    .search-mobile {
        font-size: 1rem;
    }
}

@keyframes mobileDropdownEnter {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
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
    z-index: 30;
    margin: 1rem 0;
    width: 100%;
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

/* Ajuste para as seções */
.banner-section,
.search-section,
.categories-section,
.games-section {
    width: 100%;
    max-width: 100%;
}

.search-section {
    padding: 0.5rem 0;
}

/* Ajuste o grid de resultados da pesquisa */
.results-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(3, 1fr); /* Começa com 3 colunas */
    padding: 8px;
    width: 100%;
}

@media (min-width: 640px) {
    .results-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (min-width: 768px) {
    .results-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

@media (min-width: 1024px) {
    .results-grid {
        grid-template-columns: repeat(6, 1fr);
    }
}

/* Ajuste o container do carousel */
.carousel__slide {
    padding: 0; /* Reduz o espaço entre os slides */
}

.carousel__viewport {
    padding: 0; /* Adiciona um pequeno padding nas extremidades */
}

/* Adicione estes estilos */
.provider-header {
    margin-bottom: 0.25rem;
    padding: 0 0.5rem;
}

.navigation-buttons {
    display: flex;
    gap: 0.5rem;
}

.nav-button {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.nav-button:hover {
    background: var(--ci-primary-color);
}

.nav-button i {
    font-size: 12px;
}

.clear-filter-button {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.813rem;
    color: white;
    background: rgba(239, 68, 68, 0.8);
    transition: all 0.2s ease;
}

.clear-filter-button:hover {
    background: rgba(239, 68, 68, 1);
}

@media (max-width: 768px) {
    .provider-header {
        margin-bottom: 0.75rem;
    }

    
    .nav-button {
        width: 24px;
        height: 24px;
    }
    
    .clear-filter-button {
        padding: 4px 10px;
        font-size: 0.75rem;
    }
}

/* Paginação */
.banner-pagination {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
}

:deep(.carousel__pagination-button) {
    width: 50px !important; /* Forçando com !important */
    height: 8px !important;
    border-radius: 4px !important; /* Forçando branco com opacidade */
    transition: all 0.3s ease !important;
    border: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

:deep(.carousel__pagination-button--active) {
    background: #FFFFFF !important; /* Forçando branco sólido */
    width: 50px !important;
}

/* Remove qualquer estilo padrão que possa estar interferindo */
:deep(.carousel__pagination-button::after),
:deep(.carousel__pagination-button::before) {
    display: none !important;
}

/* Responsivo */
@media (max-width: 768px) {
    .banner-pagination {
        bottom: 15px;
        gap: 8px;
    }

    :deep(.carousel__pagination-button) {
        width: 35px !important;
        height: 6px !important;
    }

    :deep(.carousel__pagination-button--active) {
        width: 35px !important;
    }
}

/* Nova paginação customizada */
.custom-pagination {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 12px;
    z-index: 10;
}

.pagination-dot {
    width: 50px;
    height: 4px;
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.pagination-dot.active {
    background: #FFFFFF;
}

@media (max-width: 768px) {
    .banner-slide {
        height: 200px;
    }

    :deep(.carousel__slide) {
        height: 200px;
    }

    .custom-pagination {
        bottom: 15px;
        gap: 8px;
    }

    .pagination-dot {
        width: 35px;
        height: 4px;
    }
}

.banner-section {
    position: relative;
    width: 100%;
    margin-bottom: 0; /* Removido margin-bottom */
}

.auth-overlay {
    width: 100%;
    height: 80vh;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

.auth-content {
    text-align: center;
    padding: 2rem;
}

.auth-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.auth-icon i {
    font-size: 40px;
    color: #fff;
}

.auth-title {
    color: white;
    font-size: 24px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.auth-button {
    background: #98EC2D;
    color: #000;
    padding: 12px 32px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.auth-button:hover {
    transform: translateY(-2px);
    background: #A5F943;
}

.auth-button i {
    font-size: 18px;
}

.carousel {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-slide {
    position: relative;
    min-width: 100%;
    width: 100%;
    cursor: pointer;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.banner-image {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 12px;
}

@media (max-width: 1024px) {
    .banner-section {
        height: 250px; /* Tablet */
    }
}

@media (max-width: 768px) {
    .banner-section {
        height: 180px; /* Mobile */
    }
}

@media (max-width: 480px) {
    .banner-section {
        height: 150px; /* Mobile pequeno */
    }
}

.modal-deposit {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: none;
}

.modal-deposit.show {
    display: flex !important;
    align-items: center;
    justify-content: center;
}

.modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
}

.modal-container {
    position: relative;
    width: 100%;
    max-width: 500px;
    margin: 1rem;
    z-index: 100000;
}

.modal-content {
    background: #212425;
    border-radius: 0.5rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    position: relative;
    width: 100%;
}

@media (max-width: 768px) {
    .modal-container {
        margin: 0.5rem;
        max-height: calc(100vh - 1rem);
    overflow-y: auto;
    }
}

.filters-container {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 2rem;
}

.filters-wrapper {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-start;
}

.search-input,
.filter-select {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    color: white;
    min-width: 200px;
    transition: all 0.3s ease;
}

.search-input:focus,
.filter-select:focus {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
    box-shadow: 0 0 0 2px rgba(0, 122, 255, 0.1);
}

.search-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

/* Estilização do select */
.filter-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12' fill='none'%3E%3Cpath d='M2.5 4.5L6 8L9.5 4.5' stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    padding-right: 2.5rem;
}

/* Estilização das options do select */
.filter-select option {
    background-color: #1a1d1f;
    color: white;
    padding: 12px;
}

/* Hover nas options */
.filter-select option:hover,
.filter-select option:focus {
    background-color: rgba(0, 122, 255, 0.2);
}

/* Botão de limpar filtros */
.clear-filter-button {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.2) 100%);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: white;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    margin-left: auto; /* Move para a direita */
}

.clear-filter-button:hover {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.3) 100%);
    border-color: rgba(239, 68, 68, 0.3);
}

/* Responsividade */
@media (max-width: 768px) {
    .filters-wrapper {
        flex-direction: column;
        gap: 0.75rem;
    }

    .search-input,
    .filter-select {
        width: 100%;
        min-width: unset;
    }

    .clear-filter-button {
        width: 100%;
        justify-content: center;
        margin-left: 0;
    }
}

/* Estilização específica para o Firefox */
@-moz-document url-prefix() {
    .filter-select {
        background-color: transparent;
        border: 1px solid rgba(0, 122, 255, 0.2);
    }
}

/* Estilização para navegadores WebKit (Chrome, Safari) */
.filter-select::-webkit-scrollbar {
    width: 8px;
}

.filter-select::-webkit-scrollbar-track {
    background: #1a1d1f;
}

.filter-select::-webkit-scrollbar-thumb {
    background: rgba(0, 122, 255, 0.3);
    border-radius: 4px;
}

.filter-select::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 122, 255, 0.4);
}

.no-games-message {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.7);
}

.game-card-wrapper {
    width: 100%;
    aspect-ratio: 3/4;
    height: 100%;
}

.loading-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.7);
}

.loading-state i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.no-games-message {
    grid-column: 1 / -1;
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.7);
}

.load-more-container {
    display: flex;
    justify-content: center;
    padding: 2rem 0;
}

.load-more-button {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.load-more-button:hover:not(:disabled) {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
}

.load-more-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.ver-mais-btn {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.ver-mais-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
}

.ver-mais-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.game-card-skeleton {
    aspect-ratio: 3/4;
    background: #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
}

/* Adicione estes estilos */
.providers-section {
    padding: 1rem;
    margin-bottom: 2rem;
}

.providers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
    padding: 1rem;
}

.provider-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.provider-item:hover {
    background: rgba(255, 255, 255, 0.1);
}

.provider-item.active {
    background: rgba(0, 122, 255, 0.2);
    border: 1px solid rgba(0, 122, 255, 0.3);
}

.provider-image {
    width: 64px;
    height: 64px;
    object-fit: contain;
    margin-bottom: 0.5rem;
}

.provider-name {
    font-size: 0.875rem;
    color: white;
    text-align: center;
}

.provider-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 0.5rem;
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
}

.provider-rtp, .provider-views {
    margin: 0.1rem 0;
}

.load-more-card {
    aspect-ratio: 4/3;
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.load-more-card:hover {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
    transform: translateY(-2px);
}

.load-more-card:active {
    transform: translateY(0);
}

.load-more-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    text-align: center;
}

.load-more-card.loading {
    cursor: not-allowed;
    opacity: 0.8;
}

/* Ajuste para garantir que o card tenha o mesmo tamanho dos outros */
.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 1rem;
    padding: 1rem;
}

@media (max-width: 640px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    }
}

    .game-card-wrapper {
    width: 100%;
    aspect-ratio: 3/4;
}

.load-more-card {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border: 1px solid rgba(0, 122, 255, 0.2);
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.load-more-card:hover {
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.15) 0%, rgba(0, 153, 255, 0.25) 100%);
    border-color: rgba(0, 122, 255, 0.3);
    transform: translateY(-2px);
}

.load-more-card:active {
    transform: translateY(0);
}

.load-more-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    text-align: center;
}

.load-more-card.loading {
    cursor: not-allowed;
    opacity: 0.8;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 1rem;
    padding: 1rem;
}

@media (min-width: 640px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    }
}

@media (min-width: 768px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    }
}

.load-more-card {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #1a1f25, #212b36);
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.load-more-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.plus-wrapper {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #007AFF, #00C6FF);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.plus-icon {
    color: white;
    font-size: 28px;
    font-weight: 300;
}

.load-more-text {
    color: white;
    font-size: 16px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Borda animada */
.animated-border {
    position: absolute;
    inset: 0;
    border-radius: 12px;
    padding: 2px;
    background: linear-gradient(135deg, #007AFF, #00C6FF, #007AFF);
    -webkit-mask: 
        linear-gradient(#fff 0 0) content-box, 
        linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    background-size: 300% 300%;
    animation: borderAnimation 4s linear infinite;
}

@keyframes borderAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

/* Estado de Loading */
.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    border-top-color: #007AFF;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Efeitos Hover */
.load-more-card:hover {
    transform: translateY(-5px);
}

.load-more-card:hover .plus-wrapper {
    transform: scale(1.1) rotate(90deg);
    box-shadow: 0 0 20px rgba(0, 122, 255, 0.5);
}

.load-more-card:hover .animated-border {
    animation: borderAnimation 2s linear infinite;
}

.loading-text {
    color: #007AFF;
    font-size: 14px;
    font-weight: 500;
}

.load-more-card.loading {
    cursor: not-allowed;
}

.load-more-card.loading .animated-border {
    opacity: 0.5;
}

.empty-state {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 400px;
    padding: 2rem;
}

.empty-state-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    max-width: 400px;
    animation: fadeIn 0.3s ease;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, rgba(0, 122, 255, 0.1) 0%, rgba(0, 153, 255, 0.2) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #007AFF;
    margin-bottom: 1.5rem;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 0.75rem;
}

.empty-description {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.clear-filters-btn {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.2) 100%);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.clear-filters-btn:hover {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(239, 68, 68, 0.25) 100%);
    border-color: rgba(239, 68, 68, 0.3);
    transform: translateY(-1px);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .empty-state {
        min-height: 300px;
        padding: 1rem;
    }

    .empty-icon {
        width: 60px;
        height: 60px;
    }

    .empty-title {
        font-size: 1.25rem;
    }

    .empty-description {
    font-size: 0.875rem;
    }
}

.providers-games-container {
    display: flex;
    flex-direction: column;
    gap: 3rem;
    padding: 1rem;
}

.provider-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.provider-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.5rem 1rem;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.05) 0%, transparent 100%);
    border-radius: 12px;
}

.provider-logo {
    height: 40px;
    object-fit: contain;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.provider-logo:hover {
    opacity: 1;
}

.games-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    padding: 0;
    width: 100%;
}

/* Full HD (1920px e acima) */
@media (min-width: 1920px) {
    .games-grid > * {
        width: calc(16.666% - 0.25rem); /* 6 items por linha */
    }
}

/* HD (1366px até 1919px) */
@media (min-width: 1366px) and (max-width: 1919px) {
    .games-grid > * {
        width: calc(20% - 0.25rem); /* 5 items por linha */
    }
}

/* Tablet (768px até 1365px) */
@media (min-width: 768px) and (max-width: 1365px) {
    .games-grid > * {
        width: calc(25% - 0.25rem); /* 4 items por linha */
    }
}

/* Mobile (até 767px) */
@media (max-width: 767px) {
    .games-grid > * {
        width: calc(33.333% - 0.25rem); /* 3 items por linha */
    }
}

/* Responsividade */
@media (min-width: 640px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    }
}

@media (min-width: 768px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    }
    
    .provider-header {
        padding: 1rem 2rem;
    }
}

/* Animações */
.provider-section {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Aplicar delay na animação para criar efeito cascata */
.provider-section:nth-child(1) { animation-delay: 0.1s; }
.provider-section:nth-child(2) { animation-delay: 0.2s; }
.provider-section:nth-child(3) { animation-delay: 0.3s; }
.provider-section:nth-child(4) { animation-delay: 0.4s; }
.provider-section:nth-child(5) { animation-delay: 0.5s; }

.loading-games {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    color: white;
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    border-top-color: #007AFF;
    animation: spin 1s ease-in-out infinite;
    margin-bottom: 1rem;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: rgba(255, 255, 255, 0.6);
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.provider-section {
    margin-bottom: 2rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.provider-header {
    margin-bottom: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    padding: 1rem 0;
}

.providers-games-container {
    padding: 1rem;
}

.provider-section {
    margin-bottom: 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1.5rem;
}

.provider-header {
    margin-bottom: 1.5rem;
}


.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

@media (max-width: 640px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}

.providers-games-container {
    padding: 20px;
}

.provider-section {
    margin-bottom: 40px;
}

.provider-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 0 10px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.carousel-container::-webkit-scrollbar {
    display: none; /* Chrome/Safari/Opera */
}


@media (max-width: 768px) {
    .games-wrapper {
        grid-auto-columns: 140px;
        gap: 12px;
    }
}

@media (max-width: 576px) {
    .games-wrapper {
        grid-auto-columns: 120px;
        gap: 10px;
    }
}

.providers-games-container {
    padding: 20px;
}

.provider-section {
    margin-bottom: 30px;
    background: #1E2128; /* background apenas na seção */
    border-radius: 8px;
    padding: 15px;
}

.provider-header {
    margin-bottom: 1.5rem;
}


.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

@media (max-width: 640px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}

.providers-games-container {
    padding: 20px;
}

.provider-section {
    margin-bottom: 40px;
}

.provider-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 0 10px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.carousel-container::-webkit-scrollbar {
    display: none; /* Chrome/Safari/Opera */
}


@media (max-width: 1400px) {
    .games-wrapper {
        grid-auto-columns: calc(14.28% - 12px); /* 7 items por linha */
    }
}

@media (max-width: 1200px) {
    .games-wrapper {
        grid-auto-columns: calc(16.666% - 12px); /* 6 items por linha */
    }
}

@media (max-width: 992px) {
    .games-wrapper {
        grid-auto-columns: calc(20% - 10px); /* 5 items por linha */
    }
}

@media (max-width: 768px) {
    .games-wrapper {
        grid-auto-columns: calc(25% - 8px); /* 4 items por linha */
        gap: 8px;
    }
}

@media (max-width: 576px) {
    .games-wrapper {
        grid-auto-columns: calc(33.333% - 8px); /* 3 items por linha */
    }
}

.game-sections {
    display: flex;
    flex-direction: column;
    gap: 0.25rem; /* 4px de espaçamento entre as seções */
    padding: 0;
    width: 100%;
}

@media (max-width: 768px) {
    .game-sections {
        gap: 24px;
        padding: 16px 0;
    }
}

.auth-overlay {
    width: 100%;
    height: 80vh;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

.auth-content {
    text-align: center;
    padding: 2rem;
}

.auth-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.auth-icon i {
    font-size: 40px;
    color: #fff;
}

.auth-title {
    color: white;
    font-size: 24px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.auth-button {
    background: #98EC2D;
    color: #000;
    padding: 12px 32px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
}

.auth-button:hover {
    transform: translateY(-2px);
    background: #A5F943;
}

.auth-button i {
    font-size: 18px;
}

.game-modal {
    backdrop-filter: blur(5px);
}

.loading-spinner {
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-left-color: #98EC2D;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.game-container {
    height: 60vh;
    width: 100%;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

.game-header {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

@media (max-width: 768px) {
    .game-container {
        height: 100vh;
    }
}

/* Estilos do Loading State */
.loading-container {
  padding: 1rem;
}

.loading-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
  gap: 1rem;
  animation: fadeIn 0.3s ease;
}

.game-skeleton {
  position: relative;
    width: 100%;
  aspect-ratio: 3/4;
  background: rgba(255, 255, 255, 0.03);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.skeleton-image {
  width: 100%;
    height: 100%;
  background: linear-gradient(
    110deg,
    rgba(255, 255, 255, 0.03) 30%,
    rgba(255, 255, 255, 0.07) 50%,
    rgba(255, 255, 255, 0.03) 70%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite linear;
}

.skeleton-content {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1rem;
  background: linear-gradient(
    to top,
    rgba(0, 0, 0, 0.8) 0%,
    rgba(0, 0, 0, 0) 100%
  );
}

.skeleton-title {
  height: 14px;
  width: 80%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 4px;
  margin-bottom: 0.5rem;
}

.skeleton-provider {
  height: 10px;
  width: 50%;
  background: rgba(255, 255, 255, 0.07);
  border-radius: 4px;
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

@media (min-width: 640px) {
  .loading-grid {
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  }
}

@media (min-width: 768px) {
  .loading-grid {
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  }
}

/* Usar transform e opacity para animações */
.game-section {
    transform: translateZ(0); /* Force GPU acceleration */
    will-change: transform;
}

.carousel-slide {
    transform: translateZ(0);
    will-change: transform;
}

/* Remover transições em dispositivos móveis */
@media (max-width: 768px) {
    * {
        transition: none !important;
        animation: none !important;
    }
}

/* Otimizar animações usando transform */
.slide-enter-active,
.slide-leave-active {
    transition: transform 0.3s ease, opacity 0.3s ease;
    will-change: transform, opacity;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Reduzir complexidade das sombras */
.item-sombra2 {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Otimizar backdrop filters */
.auth-overlay {
    background: rgba(0,0,0,0.7);
    /* Remover backdrop-filter para melhor performance */
}

/* Usar classes utilitárias para transformações comuns */
.gpu-accelerated {
    transform: translateZ(0);
    will-change: transform;
}

/* Reduzir quantidade de reflows */
.category-list {
    contain: content;
}

.carousel {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.carousel-container {
  width: 100%;
  overflow: hidden;
}

.carousel-track {
  display: flex;
  transition: transform 0.5s ease-in-out;
  width: 100%;
}

.carousel-slide {
  min-width: 100%;
  flex: 0 0 100%;
}

.banner-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.custom-pagination {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
}

.pagination-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  border: none;
  cursor: pointer;
  padding: 0;
  transition: background-color 0.3s ease;
}

.pagination-dot.active {
  background: white;
}

.search-results {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.search-results-info {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.results-count {
    color: #8C9099;
    font-size: 0.875rem;
}

.load-more-button {
    background: linear-gradient(135deg, #0066FF 0%, #0052cc 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.load-more-button:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 102, 255, 0.2);
}

.load-more-button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.banner-section {
    position: relative;
    width: 100%;
    margin-bottom: 0; /* Removido margin-bottom */
}

.search-section {
    position: relative;
    z-index: 20;
    width: 100%;
    margin-bottom: 1rem;
}

.padding-mobile-banner {
    padding-top: 100px;
}

@media (max-width: 768px) {
    .padding-mobile-banner {
        padding-top: 20px; /* Reduzido o padding no mobile */
    }

    .search-section {
        margin-bottom: 0.5rem; /* Reduzido margin no mobile */
    }
}

/* Estilo base para os indicadores */
.banner-indicators {
    position: absolute;
    bottom: 1rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 0.5rem;
}

@media (max-width: 768px) {
    .banner-indicators {
        position: static; /* Remove o posicionamento absoluto no mobile */
        transform: none;
        justify-content: center;
        padding: 0.5rem 0;
        margin-top: -0.5rem; /* Ajuste fino para aproximar do banner */
    }

    .padding-mobile-banner {
        padding-top: 20px;
    }

    /* Container do banner para melhor organização no mobile */
    .banner-container {
        display: flex;
        flex-direction: column;
    }
}

/* Adicione estes estilos */
.mobile-fullscreen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: #000;
}

.game-header {
    position: relative;
    z-index: 10;
}

.game-container {
    height: calc(100vh - 60px); /* Ajuste conforme a altura do seu header */
}

/* Esconde o BottomNavComponent quando o jogo está ativo no mobile */
@media (max-width: 768px) {
    .mobile-fullscreen + .mobile-menu-wrapper {
        display: none !important;
    }
    
    .mobile-fullscreen .game-header {
        padding: 1rem;
        background: rgba(0, 0, 0, 0.8);
    }
    
    .mobile-fullscreen .game-container {
        height: calc(100vh - 56px); /* Ajuste para mobile */
    }
}

/* Ajuste a posição do container do jogo para considerar o novo header */
.mobile-fullscreen {
    position: fixed;
    top: 56px; /* Altura do novo header */
    left: 0;
    width: 100vw;
    height: calc(100vh - 56px); /* Ajusta a altura considerando o header */
    z-index: 40; /* Menor que o z-index do nav */
}

@media (max-width: 768px) {
    .mobile-fullscreen + .mobile-menu-wrapper {
        display: none !important;
    }
    
    .mobile-fullscreen .game-container {
        height: 100%; /* Usa toda a altura disponível */
    }
}
</style>
<template>
    <BaseLayout>
        <!-- Adicione os listeners no SideBarComponent -->
        <SideBarComponent
            :categories="categories"
            :sidebar="sidebarStatus"
            @select-category="handleCategorySelect"
        />
        <div class="home-container">
            <!-- Apenas a seção do banner/jogo alterna -->
            <template v-if="activeGame">
                <!-- Container do Jogo -->
                <div v-if="activeGame" class="game-section w-full bg-gray-900 relative" :class="{'mobile-fullscreen': activeGame}">
                    <div class="game-header flex items-center justify-between p-4 bg-gray-800">
                        <button @click="closeGameModal" class="text-white hover:text-primary-500 flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i>
                            <h3 class="text-white text-lg font-medium">
                                {{ activeGame.game_name }}
                            </h3>
                        </button>
                    </div>
                    
                    <div class="game-container relative">
                        <!-- Loading State -->
                        <div v-if="isLoadingGame" class="absolute inset-0 flex items-center justify-center bg-gray-900">
                            <div class="loading-spinner"></div>
                        </div>
                        
                        <!-- Game Iframe -->
                        <iframe
                            v-if="gameUrl"
                            :src="gameUrl"
                            class="w-full h-full border-0"
                            allow="fullscreen"
                        ></iframe>
                        
                        <!-- Error State -->
                        <div v-if="!isLoadingGame && !gameUrl" class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center p-8">
                                <i class="fas fa-exclamation-triangle text-4xl text-yellow-500 mb-4"></i>
                                <p class="text-white text-lg mb-4">{{ errorMessage || 'Não foi possível carregar o jogo' }}</p>
                                <button 
                                    @click="retryLoadGame" 
                                    class="px-6 py-2 bg-primary-500 text-white rounded hover:bg-primary-600 transition-colors"
                                >
                                    Tentar Novamente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <!-- Banner Section -->
                <section class="banner-section">
                    <div class="banner-container">
                        <!-- Banner Carousel -->
                        <div class="banner-carousel">
                            <template v-if="showLoginMessage">
                                <div class="auth-overlay">
                                    <div class="auth-content">
                                        <div class="auth-icon">
                                            <i class="fa-solid fa-shield-exclamation"></i>
                                        </div>
                                        <h2 class="auth-title">Você precisa entrar para jogar.</h2>
                                        <button @click="openAuthModal" class="auth-button">
                                            <i class="fa-solid fa-right-to-bracket"></i>
                                            Entrar
                                        </button>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="carousel">
                                    <div class="carousel-container">
                                        <div class="carousel-track" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                                            <div class="carousel-slide">
                                                <img 
                                                    src="https://casb7k.s3.sa-east-1.amazonaws.com/uploads/storage/01JHGVX1ANJXPCQFGYHRCTY33R.png" 
                                                    alt="Banner 1"
                                                    class="banner-image"
                                                >
                                            </div>
                                            <div class="carousel-slide">
                                                <img 
                                                    src="https://casb7k.s3.sa-east-1.amazonaws.com/uploads/storage/01JHGVYPK805BB7Q482965KTY8.png" 
                                                    alt="Banner 2"
                                                    class="banner-image"
                                                >
                                            </div>
                                            <div class="carousel-slide">
                                                <img 
                                                    src="https://casb7k.s3.sa-east-1.amazonaws.com/uploads/storage/01JHGVVC1MYKKJJG6M5CPEZKWC.png" 
                                                    alt="Banner 3"
                                                    class="banner-image"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="custom-pagination">
                                        <button 
                                            v-for="index in 3" 
                                            :key="index"
                                            @click="goToSlide(index - 1)"
                                            :class="['pagination-dot', { active: currentSlide === index - 1 }]"
                                        >
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Indicadores -->
                        <div class="banner-indicators">
                            <!-- ... indicadores do banner ... -->
                        </div>
                    </div>
                </section>
            </template>

            <!-- Search Section -->
            <section class="search-section">
                <div class="w-full">
                    <SearchComponent @open-game="openGameModal" />
                </div>
            </section>

            <!-- Categories Section -->
            <section class="categories-section">
                <div class="category-list item-sombra2 margin-categorias categories-margin">
                    <div class="flex gap-1 "
                        style="max-height: 200px; overflow-x: auto; overflow-y: hidden;margin-left: -10px;">
                        <div class="flex flex-row justify-between items-center w-full "
                            style="min-width: 100%; white-space: nowrap;">

                            <div v-for="(category, index) in categories" :key="index"
                                @click="selectCategory(category)"
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
            </section>

            <!-- Seção de jogos condicional -->
            <div v-if="!activeCategory">
                <!-- Mostra GameSection quando não há categoria selecionada -->
                <div class="game-sections">
                    <GameSection
                        v-for="provider in providers"
                        :key="provider.id"
                        :title="`Jogos da ${provider.name}`"
                        :games="provider.games"
                        @open-game="openGameModal"
                        @show-all="showAllGames"
                    />
                </div>
            </div>
            <div v-else>
                <!-- Mostra CassinoHeader e GamesDisplay quando uma categoria está selecionada -->
                <CassinoHeader
                    :providers="providers"
                    :categories="categories"
                    :loading="gameState.isLoading"
                    :total="gameState.total"
                    :currentPage="gameState.page"
                    :perPage="gameState.perPage"
                    :initial-filters="gameState.filters"
                    @update:filters="handleFiltersUpdate"
                    @load-more="loadMore"
                    @reset-view="resetView"
                />
                
                <!-- Estado de Carregamento Melhorado -->
                <div v-if="gameState.isLoading" class="loading-container">
                  <div class="loading-grid">
                    <div v-for="n in 12" :key="n" class="game-skeleton">
                      <div class="skeleton-image"></div>
                      <div class="skeleton-content">
                        <div class="skeleton-title"></div>
                        <div class="skeleton-provider"></div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <GamesDisplay
                    v-else
                    :providers="providers"
                    :gameState="gameState"
                    :activeCategory="activeCategory"
                    @open-game="openGameModal"
                    @load-more="loadMore"
                />
            </div>

            <!-- Latest Bets Section -->
            <LatestBetsSection v-if="!activeCategory" />

            <!-- Auth Modal -->
            <AuthModal 
                v-model="showAuthModal"
                @close="showAuthModal = false"
                @login-success="handleLoginSuccess"
            />
        </div>
        <NavTopComponent 
            :auth-status="authStatus"
            :is-game-active="!!activeGame"
            :game-title="activeGame?.game_name"
            @close-game="closeGameModal"
        />
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
    onUnmounted,
    reactive,
    computed,
    watch
} from "vue";
import axios from 'axios';

import BaseLayout from "@/Layouts/BaseLayout.vue";
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
import { searchGameStore } from "@/Stores/SearchGameStore.js";
import CustomPagination from "@/Components/UI/CustomPagination.vue";
import mitt from 'mitt';
import { useRouter } from 'vue-router' 
import NavTopComponent from '@/Components/Nav/NavTopComponent.vue'
import { useCacheStore } from '@/Stores/CacheStore.js';
import CassinoHeader from '@/Pages/Cassino/Components/CassinoHeader.vue';
import CassinoGameCard from '@/Pages/Cassino/Components/CassinoGameCard.vue';
import GamesDisplay from '@/Pages/Home/Components/GamesDisplay.vue';
import GameSection from './Components/GameSection.vue';
import AuthModal from '@/Components/Nav/AuthModal.vue'
import SideBarComponent from '@/Components/Nav/SideBarComponent.vue'
import SearchComponent from '@/Components/Search/SearchComponent.vue';
import { sidebarStore } from "@/Stores/SideBarStore.js";
import LatestBetsSection from './Components/LatestBetsSection.vue';

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
        ShowCarousel,
        Carousel,
        Navigation,
        Slide,
        LanguageSelector,
        BaseLayout,
        RouterLink,
        NavTopComponent,
        CassinoHeader,
        CassinoGameCard,
        GamesDisplay,
        GameSection,
        AuthModal,
        SideBarComponent,
        SearchComponent,
        LatestBetsSection
    },
    data() {
        return {
            gameState: reactive({
                isLoading: false,
                isLoadingMore: false,
                games: [],
                total: 0,
                page: 1,
                perPage: 24, // Atualizado de 12 para 24
                filters: {
                    search: '',
                    provider: '',
                    category: ''
                }
            }),
            /// banners settings
            settings: {
                itemsToShow: 1,
                snapAlign: 'center',
                wrapAround: true,
                autoplay: 5000,
                pauseAutoplayOnHover: true,
                transition: 500,
                mouseDrag: false, // Desativa drag com mouse
                touchDrag: false, // Desativa drag touch
                dir: 'ltr',
                rewind: false,
                clipSlides: true,
                slideWidth: '100%'
            },
            breakpoints: {
                // Mantém 1 slide visível em todas as resoluções
                768: {
                    itemsToShow: 1,
                }
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
                itemsToShow: 3,
                snapAlign: 'start',
            },
            breakpointsGames: {
                640: {
                    itemsToShow: 4,
                },
                768: {
                    itemsToShow: 5,
                },
                1024: {
                    itemsToShow: 6,
                },
            },
            settingsImages: {
                itemsToShow: 2,
                snapAlign: 'start',
            },
            providers: [],

            categories: null,
            searchTerm: '',
            showSearchResults: false,
            searchResults: [],
            isSearchLoading: false,
            allGamesNames: [], // Será preenchido com os nomes dos jogos reais
            activeGame: null,
            gameUrl: null,
            isLoadingGame: false,
            isFullscreen: false,
            isClosing: false,
            filteredGames: [],
            activeCategory: null,
            skeletonCount: 6, // Added for the new loading state
            currentSlide: 0,
            autoplayInterval: null,
            gameNameFilter: '',
            selectedCategory: '',
            selectedProvider: null,
            gamesByProvider: reactive({}),
            loadingStates: reactive({}),
            showLoginMessage: false,
            showAuthModal: false,
            pendingGame: null, // Para armazenar o jogo que estava tentando abrir
            showModal: false, // Novo estado para controlar a visibilidade do modal
            errorMessage: null, // Novo estado para mensagem de erro
            sidebar: false, // Novo estado para controlar a visibilidade do sidebar
            searchPagination: {
                currentPage: 1,
                lastPage: 1,
                total: 0
            },
        }
    },
    setup(props) {
        const ckCarouselOriginals = ref(null)
        const fgCarousel = ref(null)
        const router = useRouter();
        const sidebarMenuStore = sidebarStore();

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
            router,
            sidebarMenuStore
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
            return this.gameState.games.slice(0, this.gameState.displayLimit);
        },
        
        hasMoreGames() {
            return this.gameState.total > (this.gameState.page * this.gameState.perPage);
        },
        gamesByProvider() {
            const groupedGames = {};
            
            if (Array.isArray(this.providers)) {
                this.providers.forEach(provider => {
                    if (provider && provider.code) {
                        const games = this.gameState.games.filter(
                            game => game && game.provider && game.provider.code === provider.code
                        );
                        console.log(`Provider: ${provider.code}, Games:`, games); // Log para depuração
                        groupedGames[provider.code] = games;
                    }
                });
            }
            
            return groupedGames;
        },
        hasMoreResults() {
            return this.searchResults.length < this.searchPagination.total;
        },
        sidebarStatus() {
            return this.sidebarMenuStore.getSidebarStatus;
        }
    },
    async mounted() {
        window.scrollTo(0, 0);
        await this.loadInitialData();
        // Usar Intersection Observer ao invés de scroll listener
        const scrollObserver = new IntersectionObserver((entries) => {
            const btnScrollTop = document.querySelector('.btn-scroll-top');
            if (btnScrollTop) {
                if (entries[0].isIntersecting) {
                    btnScrollTop.classList.remove('show-btn-scroll-top');
                } else {
                    btnScrollTop.classList.add('show-btn-scroll-top');
                }
            }
        }, { threshold: 0.1 });

        const observerTarget = document.createElement('div');
        observerTarget.style.height = '1px';
        document.body.prepend(observerTarget);
        scrollObserver.observe(observerTarget);

        // Cleanup no unmount
        onUnmounted(() => {
            scrollObserver.disconnect();
        });

        // Fecha o dropdown quando clicar fora
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-container')) {
                this.showSearchResults = false;
            }
        });

        // Adiciona os listeners usando o emitter
        emitter.on('filter-category', (category) => {
            console.log('Recebido evento de filtro:', category);
            this.filterGamesByCategory(category);
        });

        emitter.on('open-game', (game) => {
            this.openGameModal(game);
        });

        this.initScrollHandler();
        this.startAutoplay();

        // Adicionar listener para evento de abrir modal
        window.addEventListener('open-deposit-modal', () => {
            this.openDepositModal()
        })

        await this.loadProvidersWithGames();
    },
    methods: {
        async loadInitialData() {
            const cacheStore = useCacheStore();
            
            try {
                if (this.$route.meta?.useCache) {
                    const cachedData = cacheStore.getHomeCache;
                    
                    if (cachedData && cachedGames) {
                        this.categories = cachedData.categories || [];
                        this.banners = cachedData.banners || [];
                        this.bannersHome = cachedData.bannersHome || [];
                        this.providers = cachedData.providers || [];
                        return;
                    }
                }

                const [
                    categoriesResponse,
                    bannersResponse,
                    providersResponse,
                ] = await Promise.all([
                    this.getCasinoCategories(),
                    this.getBanners(),
                ]);

                const homeData = {
                    categories: this.categories,
                    banners: this.banners,
                    bannersHome: this.bannersHome,
                    providers: this.providers
                };

                cacheStore.setHomeData(homeData);
                
            } catch (error) {
                console.error('Erro ao carregar dados:', error);
                const cachedData = cacheStore.getHomeCache;

            }
        },
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
        async getAllGames() {
        try {
            const response = await axios.get('/api/games');
            const providers = response.data.providers;

            // Certifique-se de que providers é um array antes de usar reduce
            if (Array.isArray(providers)) {
                this.allGames = providers.reduce((acc, provider) => {
                    return acc.concat(provider.games || []);
                }, []);
            } else {
                console.error('Expected providers to be an array');
                this.allGames = [];
            }
        } catch (error) {
            console.error('Erro ao carregar jogos:', error);
        }
    },
        async searchGames() {
            if (!this.searchTerm || this.searchTerm.length < 3) {
                this.searchResults = [];
                return;
            }

            try {
                this.isSearchLoading = true;
                
                // Faz a requisição para buscar os jogos
                const response = await HttpApi.get(`/games/search?q=${this.searchTerm}`);
                
                if (response.data?.status && response.data?.games?.data) {
                    // Atualiza os resultados da pesquisa
                    this.searchResults = response.data.games.data;
                    
                    // Atualiza informações da paginação
                    this.searchPagination = {
                        currentPage: response.data.games.current_page,
                        lastPage: response.data.games.last_page,
                        total: response.data.games.total
                    };
                } else {
                    this.searchResults = [];
                }
            } catch (error) {
                console.error('Erro na pesquisa:', error);
                this.searchResults = [];
            } finally {
                this.isSearchLoading = false;
            }
        },

        async loadMoreSearchResults() {
            if (this.isLoadingMore || !this.hasMoreResults) return;
            
            try {
                this.isLoadingMore = true;
                const nextPage = this.searchPagination.currentPage + 1;
                
                const response = await HttpApi.get(
                    `/games/search?q=${this.searchTerm}&page=${nextPage}`
                );
                
                if (response.data?.status && response.data?.games?.data) {
                    // Adiciona os novos resultados ao array existente
                    this.searchResults = [...this.searchResults, ...response.data.games.data];
                    
                    // Atualiza a paginação
                    this.searchPagination = {
                        currentPage: response.data.games.current_page,
                        lastPage: response.data.games.last_page,
                        total: response.data.games.total
                    };
                }
            } catch (error) {
                console.error('Erro ao carregar mais resultados:', error);
            } finally {
                this.isLoadingMore = false;
            }
        },

        handleEnterKey() {
            if (this.searchTerm.length >= 3) {
                this.searchGames();
            }
        },

        // Observador para o searchTerm
        watch: {
            searchTerm(newValue) {
                if (newValue.length >= 3) {
                    this.searchGames();
                } else {
                    this.searchResults = [];
                }
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
            // Nomes realistas de jogos de cassino
            const games = [
                'Sweet Bonanza', 'Gates of Olympus', 'Fruit Party', 
                'Spaceman', 'Fortune Tiger', 'Fortune Mouse'
            ];
            
            // Nomes de usuários mais realistas e anônimos
            const users = [
                'player***', 'user***', 'gamer***', 
                'lucky***', 'bet***', 'win***'
            ];

            // Gera valor da aposta entre R$5 e R$100
            const amount = Number((Math.random() * 95 + 5).toFixed(2));
            
            // Gera multiplicador mais realista
            // 70% chance de perda (0.1x - 0.9x)
            // 30% chance de ganho (1.1x - 2.5x)
            let multiplier;
            if (Math.random() < 0.7) { // 70% chance de perda
                multiplier = Number((Math.random() * 0.8 + 0.1).toFixed(2)); // 0.1x - 0.9x
            } else { // 30% chance de ganho
                multiplier = Number((Math.random() * 1.4 + 1.1).toFixed(2)); // 1.1x - 2.5x
            }

            // Calcula o prêmio baseado no multiplicador
            const prize = Number((amount * multiplier).toFixed(2));

            // Gera horário dos últimos 5 minutos
            const minutes = Math.floor(Math.random() * 5);
            const seconds = Math.floor(Math.random() * 60);
            const time = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            return {
                id: Math.random(),
                time,
                game: games[Math.floor(Math.random() * games.length)],
                user: users[Math.floor(Math.random() * users.length)],
                amount,
                multiplier,
                prize
            };
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
            if (!category || this.gameState.isLoading) return;
            
            try {
                // Reset state for new category
                this.gameState = reactive({
                    isLoading: true,
                    isLoadingMore: false,
                    games: [],
                    filters: {
                        category: category.id,
                        search: '',
                        provider: ''
                    },
                    page: 1,
                    perPage: 12
                });
                
                await this.loadGames(); // Usar o método loadGames existente
            } catch (error) {
                console.error('Error loading games:', error);
            } finally {
                this.gameState.isLoading = false;
            }
        },

        async loadMore() {
            if (this.gameState.isLoadingMore) return;
            
            this.gameState.isLoadingMore = true;
            
            try {
                const response = await axios.get('/api/games', {
                    params: {
                        page: this.gameState.page + 1,
                        per_page: this.gameState.perPage,
                        search: this.gameState.filters.search,
                        provider: this.gameState.filters.provider,
                        category: this.gameState.filters.category
                    }
                });

                if (response.data) {
                    // Adiciona novos jogos ao array existente
                    this.gameState.games = [...this.gameState.games, ...response.data.data];
                    this.gameState.page += 1;
                    this.gameState.total = response.data.total;
                    this.gameState.lastPage = response.data.last_page;
                }
            } catch (error) {
                console.error('Error loading more games:', error);
            } finally {
                this.gameState.isLoadingMore = false;
            }
        },

        async openGameModal(game) {
            // Rola a página para o topo suavemente
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            this.isLoadingGame = true;
            this.activeGame = game;
            this.errorMessage = null;
            
            try {
                const endpoint = game.slug 
                    ? `games/single/${game.slug}`
                    : `games/single/${game.id}`;

                const response = await HttpApi.get(endpoint);
                
                if (response?.data?.gameUrl) {
                    this.gameUrl = response.data.gameUrl;
                } else {
                    throw new Error('URL do jogo não encontrada');
                }
                
            } catch (error) {
                console.error('Erro ao abrir o jogo:', error);
                this.errorMessage = 'Erro ao carregar o jogo. Por favor, tente novamente.';
            } finally {
                this.isLoadingGame = false;
            }
        },

        closeGameModal() {
            this.showModal = false;
            this.activeGame = null;
            this.gameUrl = null;
            this.errorMessage = null;
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
        clearFilters() {
            this.gameNameFilter = '';
            this.selectedCategory = '';
            this.selectedProvider = null;
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
            
            if (this.$refs.searchContainer) {
                const headerHeight = 80;
                const containerTop = this.$refs.searchContainer.getBoundingClientRect().top;
                const targetScroll = window.pageYOffset + containerTop - headerHeight - 20;
                
                // Usar transform ao invés de scroll
                document.body.style.transform = `translateY(-${targetScroll}px)`;
                document.body.style.transition = 'transform 0.3s ease';
            }
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
                this.searchGames();
            }
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
        startAutoplay() {
            // Usar requestAnimationFrame para melhor performance
            let lastTime = 0;
            const animate = (currentTime) => {
                if (currentTime - lastTime >= 5000) {
                    this.currentSlide = (this.currentSlide + 1) % this.banners.length;
                    lastTime = currentTime;
                }
                this.autoplayFrame = requestAnimationFrame(animate);
            };
            this.autoplayFrame = requestAnimationFrame(animate);
        },
        stopAutoplay() {
            if (this.autoplayFrame) {
                cancelAnimationFrame(this.autoplayFrame);
            }
        },
        openDepositModal() {
            window.dispatchEvent(new Event('open-deposit-modal'))
        },
        closeDepositModal() {
            const modalEl = document.getElementById('depositModal')
            if (modalEl) {
                modalEl.classList.remove('show')
                document.body.style.overflow = 'auto'
            }
        },
        // Método para forçar atualização dos dados
        async refreshData() {
            const cacheStore = useCacheStore();
            
            try {
                await Promise.all([
                    this.getCasinoCategories(),
                    this.getBanners(),
                    this.getAllGames(),
                ]);

                // Atualiza o cache com os novos dados
                cacheStore.setHomeData({
                    categories: this.categories,
                    banners: this.banners,
                    bannersHome: this.bannersHome,
                    providers: this.providers,
                });
            } catch (error) {
                console.error('Erro ao atualizar dados:', error);
            }
        },
        async loadProviders() {
            try {
                const response = await HttpApi.get('providers');
                if (response.data?.status && response.data?.providers) {
                    this.providers = response.data.providers;
                }
            } catch (error) {
                console.error('Erro ao carregar provedores:', error);
            }
        },

        async loadCategories() {
            try {
                const response = await axios.get('/api/categories');
                this.categories = response.data;
            } catch (error) {
                console.error('Error loading categories:', error);
            }
        },

        handleFiltersUpdate(filters) {
            this.gameState.filters = filters;
            this.gameState.page = 1; // Reset página ao filtrar
            this.loadGames(); // Recarrega os jogos com os novos filtros
        },

        async loadGames() {
            console.log('loadGames called'); // Log para verificar se a função é chamada
            if (this.gameState.isLoading) return;
            
            this.gameState.isLoading = true;
            
            try {
                const response = await axios.get('/api/games', {
                    params: {
                        page: this.gameState.page,
                        per_page: this.gameState.perPage,
                        search: this.gameState.filters.search,
                        provider: this.gameState.filters.provider,
                        category: this.gameState.filters.category
                    }
                });

                if (response.data) {
                    console.log('API Response:', response.data); // Log para verificar a resposta
                    if (this.gameState.page === 1) {
                        this.gameState.games = response.data.data;
                    } else {
                        this.gameState.games = [...this.gameState.games, ...response.data.data];
                    }
                    
                    this.gameState.total = response.data.total;
                    this.gameState.lastPage = response.data.last_page;
                }
            } catch (error) {
                console.error('Error loading games:', error);
            } finally {
                this.gameState.isLoading = false;
            }
        },

        async loadMoreGames() {
            if (this.gameState.isLoadingMore) return;
            
            this.gameState.isLoadingMore = true;
            this.gameState.page += 1;
            
            await this.loadGames();
            
            this.gameState.isLoadingMore = false;
        },

        filterByProvider(provider) {
            this.selectedProvider = provider.id;
            // Add any additional logic you want to execute when a provider is selected
            console.log('Provider selected:', provider);
        },
        selectCategory(category) {
            this.activeCategory = category; // Set activeCategory when a category is selected
            this.filterGamesByCategory(category); // Optionally filter games by category
        },
        getProviderName(providerCode) {
            const provider = this.providers.find(p => p.code === providerCode);
            return provider ? provider.name : 'Unknown Provider';
        },
        async loadGamesByProvider(providerCode) {
            try {
                const response = await axios.get('/api/games', {
                    params: {
                        provider: providerCode,
                        per_page: 12,
                        page: 1
                    }
                });

                if (response.data?.data) {
                    const games = Array.isArray(response.data.data) ? response.data.data : [];
                    this.gamesByProvider[providerCode] = games;
                }
            } catch (error) {
                console.error(`Error loading games for ${providerCode}:`, error);
                this.gamesByProvider[providerCode] = [];
            }
        },

        hasGames(providerCode) {
            const games = this.gamesByProvider[providerCode];
            return Array.isArray(games) && games.length > 0;
        },

        getGamesCount(providerCode) {
            const games = this.gamesByProvider[providerCode];
            return games?.length || 0;
        },

        async loadAllProvidersGames() {
            for (const provider of this.providers) {
                await this.loadGamesByProvider(provider.code);
            }
        },
        async loadProvidersWithGames() {
            try {
                const response = await axios.get('/api/providers-with-games');
                if (response.data.status) {
                    this.providers = response.data.providers;
                }
            } catch (error) {
                console.error('Error loading providers with games:', error);
            }
        },
        async selectCategory(category) {
            this.activeCategory = category;
            this.gameState.isLoading = true;
            
            try {
                const response = await axios.get('/api/games', {
                    params: {
                        category: category.id,
                        page: 1,
                        per_page: 24
                    }
                });

                if (response.data) {
                    this.gameState = {
                        ...this.gameState,
                        games: response.data.data,
                        total: response.data.total,
                        page: 1,
                        filters: {
                            ...this.gameState.filters,
                            category: category.id,
                            provider: '', // Reset do provider
                            search: '' // Reset da busca
                        }
                    };

                    // Emite o evento para atualizar o select do CassinoHeader
                    this.$nextTick(() => {
                        this.$emit('update:filters', {
                            category: category.id,
                            provider: '',
                            search: ''
                        });
                    });
                }
            } catch (error) {
                console.error('Error loading category games:', error);
            } finally {
                this.gameState.isLoading = false;
            }
        },
        resetView() {
            this.activeCategory = null;
            this.gameState = {
                ...this.gameState,
                games: [],
                total: 0,
                page: 1,
                filters: {
                    search: '',
                    provider: '',
                    category: ''
                }
            };
            // Recarrega os jogos iniciais se necessário
            this.loadProvidersWithGames();
        },
        goToLogin() {
            this.openAuthModal();
        },
        closeLoginMessage(e) {
            if (e.target.classList.contains('auth-overlay')) {
                this.showLoginMessage = false;
                document.body.style.overflow = 'auto';
            }
        },
        openAuthModal() {
            this.showAuthModal = true;
        },
        handleLoginSuccess() {
            this.showAuthModal = false;
            this.showLoginMessage = false;
            
            // Se havia um jogo pendente, abre ele
            if (this.pendingGame) {
                this.openGameModal(this.pendingGame);
                this.pendingGame = null;
            }
        },
        retryLoadGame() {
            if (this.activeGame) {
                this.openGameModal(this.activeGame);
            }
        },
        showAllGames() {
            // Define a categoria como nula mas força a visualização de todos os jogos
            this.activeCategory = { id: null, name: 'Todos os Jogos' };
            
            // Reseta os filtros e carrega os jogos
            this.gameState.filters = {
                search: '',
                provider: '',
                category: ''
            };
            
            this.gameState.page = 1;
            this.gameState.games = [];
            
            // Carrega os jogos imediatamente
            this.loadGames();
        },
        handleCategorySelect(category) {
            // Usa o mesmo método que já existe para selecionar categoria
            this.selectCategory(category);
        },
        scrollToSearch() {
            setTimeout(() => {
                const searchInput = document.querySelector('.search-mobile') || 
                                  document.querySelector('.search-input');
                
                if (searchInput) {
                    // Aumentado o offset para 200px para rolar mais para cima
                    const headerOffset = 200; 
                    const elementPosition = searchInput.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: Math.max(0, offsetPosition),
                        behavior: 'smooth'
                    });

                    // Foca no input após o scroll
                    searchInput.focus();
                }
            }, 100);
        },

        // Modifique o método que abre a pesquisa
        openSearch() {
            this.showSearchResults = true;
            // Removido o scroll automático aqui
        },

        // Método para fechar o dropdown de pesquisa
        closeSearchDropdown() {
            this.showSearchResults = false;
        },

        // Adicionar listener para cliques fora do dropdown
        handleClickOutside(event) {
            const searchContainer = this.$refs.searchContainer;
            if (searchContainer && !searchContainer.contains(event.target)) {
                this.closeSearchDropdown();
            }
        }
    },
    async beforeMount() {
        await this.loadInitialData();
    },
    watch: {
        searchTerm(newValue) {
            // Realiza a busca automaticamente após digitar
            if (newValue.length >= 3) {
                this.searchGames();
            }
        },
        showSearchResults(newValue) {
            if (!newValue) {
                document.body.style.overflow = 'auto';
            } else {
                document.body.style.overflow = 'hidden';
            }
        },
        gameState: {
            handler(newState) {
                console.log('Game State Changed:', newState);
            },
            deep: true
        },
        isLoading(newValue) {
            console.log('Loading state changed:', newValue);
        },
        gamesByProvider: {
            handler(newVal) {
                console.log('gamesByProvider updated:', newVal);
            },
            deep: true
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
        this.stopAutoplay();
        // Remove listener e restaura scroll
        document.removeEventListener('click', this.closeLoginMessage);
        // Remover listener quando o componente for desmontado
        document.removeEventListener('click', this.handleClickOutside);
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

const getProviderGames = (providerCode) => {
    return gameState.games.filter(game => game.provider === providerCode);
};

const scrollCarousel = (direction, providerId) => {
    const carousel = document.getElementById(`carousel-${providerId}`);
    const container = carousel.querySelector('.carousel-container');
    const scrollAmount = container.offsetWidth;
    
    container.scrollBy({
        left: direction === 'left' ? -scrollAmount : scrollAmount,
        behavior: 'smooth'
    });
};
</script>
