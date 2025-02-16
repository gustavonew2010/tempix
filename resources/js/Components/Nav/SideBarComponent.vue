<style>
.gray-scale-menu {
    color: #8C9099 !important;
    display: flex;
    align-items: center;
    padding: 8px 16px;
    width: 100%;
    margin: 4px 0;
    border-radius: 6px;
    transition: none;
    position: relative;
    overflow: hidden;
}

.gray-scale-menu::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.03),
        transparent
    );
    transition: none;
}

.gray-scale-menu:hover::before {
    left: 100%;
}

.gray-scale-menu img,
.gray-scale-menu svg {
    color: #8C9099;
    width: 20px !important;
    height: 20px !important;
    filter: grayscale(100%);
    -webkit-filter: grayscale(100%);
    background: none; /* Remove o background */
    transition: none;
}

/* Hover effects */
.gray-scale-menu:hover {
    color: white !important;
    background-color: rgba(255, 255, 255, 0.1);
    transform: none;
    box-shadow: none;
}

.gray-scale-menu:hover svg,
.gray-scale-menu:hover img {
    filter: grayscale(100%) brightness(140%);
    -webkit-filter: grayscale(100%) brightness(140%);
    transform: none;
}

.gray-scale-menu span {
    transition: none;
}

.gray-scale-menu:hover span {
    transform: none;
}

/* Active state */
.gray-scale-menu.active {
    background: rgba(255, 255, 255, 0.15);
    color: white !important;
}

.gray-scale-menu.active::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: linear-gradient(180deg, #ffffff40 0%, transparent 100%);
}

.filter-gray-hover {
    filter: grayscale(100%) brightness(140%);
    -webkit-filter: grayscale(100%) brightness(140%);
    transition: filter 0.3s ease, color 0.3s ease;
}

.filter-gray-hover:hover {
    filter: grayscale(0%) brightness(100%);
    -webkit-filter: grayscale(0%) brightness(100%);
    color: white;
}

.texto-categoria:hover {
    color: white;
}

.opacidade-hover:hover {
    opacity: 1;
    transform: none;
}

.opacidade-1-texto-menu {
    color: #A8BEBE;
}

.opacidade-1-texto-menu:hover {
    color: white;
    opacity: 1;
}

/* Updated sidebar styles */
aside {
    background: #1E2328;
    width: 280px !important;
    position: fixed;
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 40;
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

aside.active {
    transform: translateX(0);
}

.sidebar-content {
    background: linear-gradient(145deg, rgba(0, 162, 212, 0.2) 0%, rgba(30, 35, 40, 1) 25%);
    min-height: min-content; /* Ajusta para o tamanho mínimo necessário */
    width: 100%;
    display: flex;
    flex-direction: column;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

/* Container do conteúdo principal */
.sidebar-content > div {
    display: flex;
    flex-direction: column;
}

/* Lista de itens do menu */
.space-y-2.font-medium {
    display: flex;
    flex-direction: column;
    gap: 0.5rem; /* Espaçamento consistente entre itens */
    padding: 1rem;
}

/* Links do menu */
.space-y-2.font-medium a {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* Dividers */
div[style*="background-color: #27292A"] {
    margin: 0.5rem 0;
    height: 1px;
}

aside:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Custom scrollbar styles */
aside::-webkit-scrollbar {
    width: 6px;
    display: block; /* Force display scrollbar */
}

aside::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 3px;
}

aside::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    transition: all 0.3s ease;
}

aside::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Updated button styles - for the blue promotion button */
button.bg-primary {
    background: linear-gradient(90deg, #0095FF 0%, #0077FF 100%);
    border-radius: 6px;
    transition: none;
    border: none;
}

button.bg-primary:hover {
    opacity: 0.9;
    transform: none;
}

ul li a {
    transition: none;
}

ul li a:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

/* Category headers (like "CASSINO", "ESPORTES") */
.category-header {
    color: #8A8D92;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 16px 12px 8px;
    letter-spacing: 0.5px;
}

/* Divider lines */
.sidebar-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.1);
    margin: 8px 0;
}

/* Active menu item */
.category-active {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

/* Icons */
.menu-icon {
    opacity: 0.7;
    width: 20px;
    height: 20px;
    margin-right: 12px;
    filter: grayscale(120%);
    -webkit-filter: grayscale(120%);
}

.gray-scale-menu:hover img,
.gray-scale-menu:hover svg,
.gray-scale-menu:hover .menu-icon {
    filter: grayscale(0%);
    -webkit-filter: grayscale(0%);
    opacity: 1;
    color: white;
}

/* Section titles (if needed) */
.section-title {
    color: #8A8D92;
    font-size: 12px;
    font-weight: 600;
    padding: 0 12px;
    margin-top: 24px;
}




/* Adjust container padding */
.px-4 {
    padding-left: 1.25rem;
    padding-right: 1.25rem;
}

/* Menu items alignment and colors */
.gray-scale-menu {
    color: #8C9099 !important;
    display: flex;
    align-items: center;
    padding: 8px 16px;
    width: 100%;
    margin: 4px 0;
    border-radius: 6px;
    transition: none;
    position: relative;
    overflow: hidden;
}

.gray-scale-menu::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.03),
        transparent
    );
    transition: none;
}

.gray-scale-menu:hover::before {
    left: 100%;
}

.gray-scale-menu img,
.gray-scale-menu svg {
    color: #8C9099;
    width: 20px !important;
    height: 20px !important;
    filter: grayscale(100%);
    -webkit-filter: grayscale(100%);
    background: none; /* Remove o background */
    transition: none;
}

/* Hover effects */
.gray-scale-menu:hover {
    color: white !important;
    background-color: rgba(255, 255, 255, 0.1);
    transform: none;
    box-shadow: none;
}

.gray-scale-menu:hover svg,
.gray-scale-menu:hover img {
    filter: grayscale(100%) brightness(140%);
    -webkit-filter: grayscale(100%) brightness(140%);
    transform: none;
}

.gray-scale-menu span {
    transition: none;
    background: none !important; /* Remove o background do texto */
}


.gray-scale-menu:hover span {
    transform: none;
    background: none !important; /* Garante que não apareça background no hover */
}

/* Active state */
.gray-scale-menu.active {
    background: rgba(255, 255, 255, 0.15);
    color: white !important;
}

.gray-scale-menu.active::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: linear-gradient(180deg, #ffffff40 0%, transparent 100%);
}

/* Ajuste do alinhamento e espaçamento da lista */
.space-y-2.font-medium {
    padding: 0 16px !important;
}

.space-y-2.font-medium li {
    padding: 2px 0 !important;
}

/* Adiciona margem lateral para a lista inteira */
ul.space-y-2.font-medium {
    margin-left: 24px;
    margin-right: 24px;
}

/* Section titles (if needed) */
.section-title {
    color: #8A8D92;
    font-size: 12px;
    font-weight: 600;
    padding: 0 12px;
    margin-top: 24px;
}





/* Adjust container padding */
.px-4 {
    padding-left: 1.25rem;
    padding-right: 1.25rem;
}

/* Menu items alignment and colors */
.gray-scale-menu {
    color: #8C9099 !important; /* Cor padrão do Canal do Telegram */
    display: flex;
    align-items: center;
    padding: 8px 16px;
    width: 100%;
}

.gray-scale-menu img,
.gray-scale-menu svg {
    color: #8C9099;
    width: 20px !important;
    height: 20px !important;
    filter: grayscale(100%);
    -webkit-filter: grayscale(100%);
}


.space-y-2.font-medium li {
    padding-left: 0 !important;
}

/* Ajustes para o sidebar mobile */
aside {
    background: #1E2328; /* Base solid color */
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    width: 300px !important;
    overflow-y: auto !important;
    overflow-x: hidden;
}

/* Add this new class */
.sidebar-content {
    background: linear-gradient(145deg, rgba(0, 162, 212, 0.2) 0%, rgba(30, 35, 40, 1) 25%);
    height: 100%;
    width: 100%;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.category-item {
    position: relative;
}

/* Tooltip styles */
.gray-scale-menu[data-tooltip] {
    position: relative;
}

.gray-scale-menu[data-tooltip]::after {
    content: attr(data-tooltip);
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    margin-left: 12px;
    padding: 6px 10px;
    color: var(--title-color);
    font-size: 12px;
    border-radius: 4px;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: none;
    z-index: 50;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.gray-scale-menu[data-tooltip]::before {
    content: '';
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    margin-left: 6px;
    border: 6px solid transparent;
    border-right-color: var(--sidebar-color);
    opacity: 0;
    visibility: hidden;
    transition: none;
    z-index: 50;
}

.gray-scale-menu[data-tooltip]:hover::after,
.gray-scale-menu[data-tooltip]:hover::before {
    opacity: 1;
    visibility: visible;
}

/* Hover effect for icons */
.gray-scale-menu:hover img {
    filter: brightness(1.2);
}

/* Transition for sidebar toggle */
.category-item {
    transition: none;
}


/* Quando o menu está expandido */
.sidebar-expanded {
    width: 280 px !important; /* Largura quando expandido */
}

/* Ajuste para os elementos do menu */
.gray-scale-menu {
    width: 100% !important;
    transition: none;
}

/* Ajuste dos ícones */
.gray-scale-menu img,
.gray-scale-menu svg {
    width: 20px !important;
    height: 20px !important;
}





/* Estilos comuns */
.gray-scale-menu img,
.gray-scale-menu svg {
    width: 20px !important;
    height: 20px !important;
}

/* ... resto dos estilos ... */

/* Adicionar estilos para submenu */
.submenu {
    position: absolute;
    left: 100%;
    top: 0;
    background: var(--sidebar-bg, #1E1E1E);
    border: 1px solid var(--border-color, #27292A);
    border-radius: 4px;
    min-width: 200px;
    display: none;
    z-index: 60;
}

.category-item:hover .submenu {
    display: block;
}

.submenu-item {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: var(--text-color);
    transition: background-color 0.2s;
}

.submenu-item:hover {
    background-color: var(--hover-bg, rgba(255, 255, 255, 0.1));
}


.subcategories {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.subcategories .gray-scale-menu {
    padding: 8px 16px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    text-decoration: none;
}


/* Adicione estes novos estilos */
.category-header {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    width: 100%;
    border-radius: 6px;
    transition: background-color 0.2s;
}

.category-header.active {
    background: rgba(255, 255, 255, 0.1);
}

.subcategories {
    margin-top: 4px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.subcategories .gray-scale-menu {
    padding-left: 48px; /* Indent subcategories */
}

/* Ajuste o estilo do ícone de dropdown */
.category-header span:last-child {
    font-size: 12px;
    opacity: 0.5;
    transition: transform 0.2s;
}

/* Adicione estes estilos para a transição */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease, max-height 0.3s ease;
    max-height: 500px; /* Altura máxima para a animação */
    overflow: hidden;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
    max-height: 0;
}

/* Ajuste o estilo do dropdown para melhor visualização */
.category-header {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    width: 100%;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.category-header span:last-child {
    font-size: 10px;
    transition: transform 0.2s ease;
}

.subcategories {
    margin-top: 4px;
    margin-bottom: 8px;
}

/* Ajuste o tamanho da fonte e espaçamento do cabeçalho da categoria */
.category-header {
    padding: 10px 14px;
    font-size: 0.875rem;
}

/* Estilo para a seta de dropdown */
.category-header span:last-child {
    font-size: 8px;
    color: #8C9099;
    transition: transform 0.3s ease;
}

/* Linha divisória entre categorias */
.category-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.05);
    margin: 4px 0;
}

/* Animação de expansão/colapso */
.expand-enter-active,
.expand-leave-active {
    transition: height 0.3s ease;
    overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
    height: 0;
}


/* Ajuste o tamanho da fonte nas subcategorias */
.subcategories .gray-scale-menu {
    font-size: 0.875rem;
    padding: 6px 14px;
}

/* Melhore o visual do hover */
.gray-scale-menu:hover {
    background-color: rgba(255, 255, 255, 0.08);
    transition: background-color 0.2s ease;
}

/* Adicione estes novos estilos para a animação */
.slide-enter-active,
.slide-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateY(-10px);
    max-height: 0;
}

.slide-enter-to,
.slide-leave-from {
    opacity: 1;
    transform: translateY(0);
    max-height: 1000px;
}

/* Adicione estes estilos para a nova seção de suporte */
.support-links {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.support-links .gray-scale-menu {
    padding: 8px 16px;
    margin: 2px 0;
    border-radius: 6px;
}

.support-links svg {
    margin-right: 12px;
}

/* Adicione estes estilos */
.sidebar-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 35;
    display: none;
}

.sidebar-backdrop.active {
    display: block;
}

aside {
    background: #1E2328;
    width: 280px;
    position: fixed;
    height: 100vh;
    left: 0;
    z-index: 40;
}



/* Ajuste do container principal */
.space-y-2.font-medium {
    padding: 0 !important;
    margin: 0 !important;
    width: 100%;
}

/* Ajuste do grupo de categorias */
.category-group {
    width: 100%;
}

/* Ajuste do cabeçalho da categoria */
.category-header.gray-scale-menu {
    width: 100%;
    justify-content: flex-start;
    padding: 12px 16px;
    margin: 0;
}

/* Ajuste das subcategorias */
.subcategories {
    width: 100%;
}

.subcategories .gray-scale-menu {
    width: 100%;
    cursor: pointer;
    justify-content: flex-start;
    padding: 12px 16px 12px 26px !important;
    margin: 0;
    font-size: 0.875rem;
    opacity: 0.85;
}

/* Hover na subcategoria */
.subcategories .gray-scale-menu:hover {
    opacity: 1;
    cursor: pointer;
    padding-left: 28px !important;
    transition: all 0.2s ease;
}

/* Ajuste geral do gray-scale-menu */
.gray-scale-menu {
    width: 100%;
    justify-content: flex-start;
    padding: 12px 16px;
    margin: 0;
}

/* Ajuste para mobile */
@media (max-width: 1024px) {
    aside {
        width: 280px !important;
    }
    
    .gray-scale-menu {
        width: 100% !important;
    }

    /* Adiciona padding inferior para o conteúdo do sidebar em mobile */
    .sidebar-content {
        padding-bottom: 80px !important;
    }
}

/* Ajuste para garantir que o sidebar permaneça visível em desktop */
@media (min-width: 1025px) {
    aside {
        transform: translateX(0) !important;
        display: block !important;
    }
}

</style>
<template>
    <div>
        <!-- Backdrop para mobile -->
        <div 
            v-if="isMobile" 
            @click="toggleSidebar"
            :class="[
                'sidebar-backdrop',
                { 'active': sidebarStatus }
            ]"
        ></div>

        <aside
            v-show="sidebarStatus"
            :class="[
                'pt-20',
                { 'active': sidebarStatus && isMobile },
                { 'hidden': !sidebarStatus }
            ]"
        >
            <div class="h-full pb-4 overflow-y-auto sidebar-content">
                <div class="px-4">
                    <button @click.prevent="$router.push('/profile/affiliate')"
                        class="opacidade-hover bg-primary rounded-[3px] flex w-full items-center h-auto" 
                        style="justify-content: space-between;padding: 5px 10px;margin-top: 50px; margin-bottom: 20px">
                        <h1 class="" style="font-size: .875rem;font-weight: 700;line-height: 1.25rem;color: var(--title-color);padding-left: 10px;">
                            Ganhe R$ 5,00 grátis
                        </h1>
                        <span class="text-[25px]">💥</span>
                    </button>
                </div>

                <!-- Categorias principais -->
                <div class="space-y-2 font-medium">
                    <div v-for="category in mainCategories" 
                         :key="category.id" 
                         class="category-group">
                        <!-- Cabeçalho da categoria principal -->
                        <div class="category-header gray-scale-menu cursor-pointer"
                             @click="handleCategoryClick(category)"
                             :class="{ 'active': isActiveCategory(category.id) }">
                            <img :src="`/storage/${category.icon}`" 
                                 alt="" 
                                 width="18" 
                                 class="mr-3">
                            <span class="text-[#8A8D92] font-semibold text-xs uppercase">{{ $t(category.name) }}</span>
                            <span v-if="hasSubCategories(category.id)" 
                                  class="ml-auto transform transition-transform duration-300"
                                  :class="{ 'rotate-180': isActiveCategory(category.id) }">
                                ▼
                            </span>
                        </div>

                        <!-- Lista de subcategorias -->
                        <div v-if="hasSubCategories(category.id)"
                             class="subcategories"
                             v-show="isActiveCategory(category.id)">
                            <a v-for="subCategory in getSubCategories(category.id)"
                               :key="subCategory.id"
                               @click.prevent="handleSubCategoryClick(subCategory)"
                               class="gray-scale-menu"
                               :class="{ 'active': isActiveRoute(subCategory.url) }">
                                <img :src="`/storage/${subCategory.icon}`" 
                                     alt="" 
                                     width="16" 
                                     class="mr-3">
                                <span class="text-sm">{{ $t(subCategory.name) }}</span>
                            </a>
                        </div>
                        
                        <!-- Linha divisória após cada categoria -->
                        <div class="category-divider"></div>
                    </div>
                </div>

                <!-- Links de Suporte -->
                <div class="space-y-2 font-medium py-2 px-6">
                    <div class="support-links">
                        <a href="#" class="gray-scale-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="text-sm">Suporte ao vivo</span>
                        </a>

                        <a href="#" class="gray-scale-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"></path>
                                <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"></path>
                                <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"></path>
                            </svg>
                            <span class="text-sm">Promoções</span>
                        </a>

                        <a href="#" class="gray-scale-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <span class="text-sm">Central de Ajuda</span>
                        </a>

                        <a href="#" class="gray-scale-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            <span class="text-sm">App Download</span>
                        </a>

                        <a href="#" class="gray-scale-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"></path>
                                <path d="M8 7h8"></path>
                                <path d="M8 11h8"></path>
                                <path d="M8 15h6"></path>
                            </svg>
                            <span class="text-sm">Blog</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</template>

<script>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { sidebarStore } from "@/Stores/SideBarStore.js";
import { useRouter } from 'vue-router';

export default {
    props: {
        categories: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    setup(props, { emit }) {
        const sidebarMenuStore = sidebarStore();
        const router = useRouter();
        const isMobile = ref(window.innerWidth <= 1024);
        const activeCategoryStates = ref({});
        let resizeTimeout;

        // Computed para controlar a visibilidade do sidebar
        const sidebarStatus = computed(() => {
            return sidebarMenuStore.getSidebarStatus;
        });

        // Função para atualizar o estado do sidebar com debounce
        const updateSidebarStatus = () => {
            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }
            
            resizeTimeout = setTimeout(() => {
                const newIsMobile = window.innerWidth <= 1024;
                isMobile.value = newIsMobile;
                sidebarMenuStore.setSidebarStatus(!newIsMobile);
                console.log('Status final do sidebar após resize:', !newIsMobile);
            }, 250); // Delay de 250ms
        };

        // Inicializa o estado do sidebar
        onMounted(() => {
            const newIsMobile = window.innerWidth <= 1024;
            isMobile.value = newIsMobile;
            sidebarMenuStore.setSidebarStatus(!newIsMobile);
            
            // Inicializa explicitamente todas as categorias principais como true
            props.categories.forEach(category => {
                if (!category.parent_id) {
                    activeCategoryStates.value[category.id] = true;
                }
            });
            
            window.addEventListener('resize', updateSidebarStatus);
        });

        // Remove o listener quando o componente é destruído
        onUnmounted(() => {
            window.removeEventListener('resize', updateSidebarStatus);
            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }
        });

        // Fecha o sidebar apenas no mobile quando a rota muda
        router.afterEach(() => {
            if (isMobile.value) {
                sidebarMenuStore.setSidebarStatus(false);
            }
        });

        function toggleSidebar() {
            // Só permite toggle em mobile
            if (isMobile.value) {
                sidebarMenuStore.setSidebarStatus(!sidebarMenuStore.getSidebarStatus);
            }
        }

        function handleCategoryClick(category) {
            // Garante que o estado existe antes de fazer o toggle
            const currentState = activeCategoryStates.value[category.id] ?? true;
            activeCategoryStates.value[category.id] = !currentState;
        }

        function hasSubCategories(categoryId) {
            return props.categories.some(cat => cat.parent_id === categoryId);
        }

        function getSubCategories(categoryId) {
            return props.categories.filter(cat => cat.parent_id === categoryId);
        }

        function handleSubCategoryClick(subCategory) {
            // Se tem slug, é um jogo que deve ser aberto diretamente
            if (subCategory.slug) {
                emit('open-game', {
                    id: subCategory.id,
                    game_name: subCategory.name,
                    slug: subCategory.slug
                });
            } else {
                // Se não tem slug, é uma categoria para filtrar
                emit('select-category', subCategory);
            }

            // Se estiver em mobile, fecha o sidebar
            if (isMobile.value) {
                sidebarMenuStore.setSidebarStatus(false);
            }
        }

        function isActiveCategory(categoryId) {
            // Retorna true se o estado não estiver explicitamente definido como false
            return activeCategoryStates.value[categoryId] ?? true;
        }

        function isActiveRoute(url) {
            return router.currentRoute.value.path === url;
        }

        return {
            sidebarMenuStore,
            isMobile,
            sidebarStatus,
            activeCategoryStates,
            handleCategoryClick,
            hasSubCategories,
            getSubCategories,
            handleSubCategoryClick,
            isActiveCategory,
            isActiveRoute,
            toggleSidebar
        }
    },
    computed: {
        mainCategories() {
            return this.categories?.filter(cat => !cat.parent_id) || [];
        }
    }
};
</script>

