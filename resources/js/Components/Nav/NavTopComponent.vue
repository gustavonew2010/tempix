<template>
    <nav :class="['fixed top-10 navtop-color nav-indexx', sidebar ? 'w-full' : 'w-full']">
        <PromoBar />
        
        <div class="nav-gradient-container">
            <div class="px-3 lg:px-5 lg:pl-3 nav-menu relative">
                <NavCategories />
                
                <div class="absolute top-0 left-5 hidden lg:block">
                    <div class="flex items-center justify-center h-full" style="align-items: center;">
                        <div class="flex-row w-[100%] cursor-pointer items-center px-2 py-3 border-primary flex justify-center tirar-esporte" 
                             style="border-bottom: 3px solid;margin-left: 10px;margin-top:10px;padding-left: 10px;padding-right: 10px;padding-bottom: 1em;">
                            <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path d="M220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM143.8 277.3C136.9 303.2 152.3 329.1 178.3 336.9C204.3 343.9 230.1 328.5 237.9 302.5L240.3 293.6C240.4 293.3 240.5 292.9 240.6 292.5L258.4 323.2L246.3 330.2C239.6 334 237.4 342.5 241.2 349.2C245.1 355.9 253.6 358.1 260.2 354.3L308.4 326.5C315.1 322.6 317.4 314.1 313.5 307.4C309.7 300.8 301.2 298.5 294.5 302.3L282.5 309.3L264.7 278.6C265.1 278.7 265.5 278.8 265.9 278.9L274.7 281.2C300.7 288.2 327.4 272.8 334.4 246.8C341.3 220.8 325.9 194.1 299.9 187.1L196.1 159.6C185.8 156.6 174.4 163.2 171.4 174.3L143.8 277.3z" fill="currentColor"/>
                            </svg>
                            <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;color: white">CASSINO</p>
                        </div>
 
                        <div class="flex-row w-[100%] items-center px-2 py-3 gap-2 flex justify-center texto-esportes tirar-esporte cursor-not-allowed">
                            <div style="display: flex;align-items: center;opacity: 0.5;">
                                <svg style="margin-top: -3px;" height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M355.5 45.53L342.4 14.98c-27.95-9.983-57.18-14.98-86.42-14.98c-29.25 0-58.51 4.992-86.46 14.97L156.5 45.53l99.5 55.13L355.5 45.53zM86.78 96.15L53.67 99.09c-34.79 44.75-53.67 99.8-53.67 156.5L.0001 256c0 2.694 .0519 5.379 .1352 8.063l24.95 21.76l83.2-77.67L86.78 96.15zM318.8 336L357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336zM512 255.6c0-56.7-18.9-111.8-53.72-156.5L425.6 96.16L403.7 208.2l83.21 77.67l24.92-21.79C511.1 260.1 512 258.1 512 255.6zM51.77 367.7l-7.39 32.46c33.48 49.11 82.96 85.07 140 101.7l28.6-16.99l-48.19-103.3L51.77 367.7zM347.2 381.5l-48.19 103.3l28.57 17c57.05-16.66 106.5-52.62 140-101.7l-7.38-32.46L347.2 381.5z" fill="currentColor"/>
                                </svg>
                                <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;">ESPORTES</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div :class="[sidebar ? 'lg:ml-[65px]' : 'lg:ml-[280px]']">
                    <div class="mx-auto w-full" style="max-width: 1110px">
                        <div class="flex items-center justify-between">
                            <NavBrand :setting="setting" @toggle-menu="toggleMenu" @navigate-home="navigateHome" />
                            
                            <div class="flex items-center py-3">
                                <!-- Botões de Auth apenas quando não autenticado -->
                                <template v-if="!authStatus">
                                    <AuthButtons 
                                        @login="openAuthModal('login')" 
                                        @register="openAuthModal('register')" 
                                    />
                                </template>

                                <!-- Menu do usuário apenas quando autenticado -->
                                <div v-else class="flex items-center h-full gap-3">
                                    <button @click="openDepositModal" 
                                            class="ui-button-blue2 h-10 mr-3 hover:scale-105 transition-transform">
                                        {{ $t('Deposit') }}
                                    </button>
                                    
                                    <!-- Wallet Balance com margem à direita -->
                                    <div class="mr-3">
                                        <WalletBalance />
                                    </div>
                                    
                                    <!-- User Menu com novo design -->
                                    <div class="flex items-center h-10 margin-teste relative">
                                        <button type="button" 
                                                @click="toggleUserDropdown"
                                                class="profile-button h-full flex items-center"
                                                aria-expanded="false">
                                            <span class="sr-only">Open user menu</span>
                                            <img :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                                                 alt="avatar" 
                                                 class="w-10 h-10 rounded-full border-2 border-primary">
                                        </button>
                                        
                                        <!-- Dropdown Menu -->
                                        <div class="user-dropdown absolute right-0 top-[calc(100%+0.5rem)] w-64"
                                             id="dropdown-user2" 
                                             :class="{ 'hidden': !showUserDropdown }">
                                            <div class="p-3 border-b border-gray-700">
                                                <div class="flex items-center space-x-3">
                                                    <img :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                                                         alt="avatar" 
                                                         class="w-12 h-12 rounded-full border-2 border-primary">
                                                    <div>
                                                        <p class="text-sm font-bold text-white">{{ userData?.name }}</p>
                                                        <p class="text-xs text-gray-400">{{ userData?.email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <ul class="py-2" role="none">
                                                <li>
                                                    <RouterLink :to="{ name: 'profileWallet' }" 
                                                              class="dropdown-item">
                                                        <i class="fa-duotone fa-wallet text-primary"></i>
                                                        <span>Carteira</span>
                                                    </RouterLink>
                                                </li>
                                                
                                                <li>
                                                    <RouterLink 
                                                        :to="{ name: 'profileAffiliate' }" 
                                                        class="dropdown-item"
                                                        @click="showUserDropdown = false"
                                                    >
                                                        <i class="fa-duotone fa-users text-primary"></i>
                                                        <span>{{ $t('Painel Afiliado') }}</span>
                                                    </RouterLink>
                                                </li>
                                                
                                                <li>
                                                    <a @click.prevent="openProfileModal" 
                                                       href="#" 
                                                       class="dropdown-item">
                                                        <i class="fa-duotone fa-user text-primary"></i>
                                                        <span>{{ $t('Dados da conta') }}</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a @click.prevent="logoutAccount" 
                                                       href="#"
                                                       class="dropdown-item text-red-500 hover:bg-red-500/10">
                                                        <i class="fa-duotone fa-right-from-bracket"></i>
                                                        <span>Sair</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <SearchModal v-if="showSearchMenu" 
                    @close="toggleSearch"
                    :search-term="searchTerm"
                    :games="games"
                    :is-loading="isLoadingSearch" />
        
        <AuthModal 
            v-model="showAuthModal"
            @close="closeAuthModal"
            ref="authModal"
        />
        
        <RegisterModal v-model="showRegisterModal"
                      @close="registerToggle"
                      @show-login="hideRegisterShowLoginToggle" />

        <!-- Input file oculto para upload de avatar -->
        <input 
            type="file"
            ref="fileInput"
            @change="handleAvatarUpload"
            accept="image/*"
            class="hidden"
        />
        
        <ProfileModal 
            ref="profileModal"
            :userData="userData"
            :stats="{totalEarnings, totalBets, sumBets}"
            :isLoading="isLoadingProfile"
            :profileUser="profileUser"
            @close="closeProfileModal"
            @update-name="updateName"
            @update-avatar="openFileInput"
        />
    </nav>
</template>

<script>
import { useAuthStore } from '@/Stores/Auth.js'
import { useToast } from 'vue-toastification'
import { storeToRefs } from 'pinia'
import { useRouter } from 'vue-router'
import { sidebarStore } from '@/Stores/SideBarStore.js'
import { useSettingStore } from '@/Stores/SettingStore.js'
import { Modal } from 'flowbite'
import { RouterLink, useRoute } from "vue-router";
import { onMounted, ref, watch, watchEffect } from "vue";
import DropdownDarkLight from "@/Components/UI/DropdownDarkLight.vue";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import WalletBalance from "@/Components/UI/WalletBalance.vue";
import HttpApi from "@/Services/HttpApi.js";
import {searchGameStore} from "@/Stores/SearchGameStore.js";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import ProfileModal from '@/Components/UI/ProfileModal.vue'
import { useCacheStore } from '@/Stores/CacheStore.js'
import { useModalStore } from '@/Stores/ModalStore'
import DepositWidget from '@/Components/Widgets/DepositWidget.vue'

// Componentes
import PromoBar from './PromoBar.vue'
import NavCategories from './NavCategories.vue'
import NavBrand from './NavBrand.vue'
import AuthButtons from './AuthButtons.vue'
import UserMenu from './UserMenu.vue'
import SearchModal from './SearchModal.vue'
import AuthModal from '@/Components/Nav/AuthModal.vue'
import RegisterModal from './RegisterModal.vue'

export default {
    name: 'NavTopComponent',
    components: {
        PromoBar,
        NavCategories,
        NavBrand,
        AuthButtons,
        UserMenu,
        SearchModal,
        AuthModal,
        RegisterModal,
        CassinoGameCard,
        WalletBalance,
        LanguageSelector,
        DropdownDarkLight,
        RouterLink,
        ProfileModal,
        DepositWidget
    },
    
    props: {
        authStatus: {
            type: Boolean,
            required: true
        }
    },

    setup() {
        const authStore = useAuthStore()
        const settingStore = useSettingStore()
        const router = useRouter()
        const toast = useToast()
        const { user: userData } = storeToRefs(authStore)
        const sidebarMenuStore = sidebarStore()
        const cacheStore = useCacheStore()
        const modalStore = useModalStore()

        return { 
            authStore, 
            userData,
            router,
            toast,
            sidebarMenuStore,
            setting: settingStore.setting,
            cacheStore,
            modalStore
        }
    },

    data() {
        return {
            sidebar: this.getInitialSidebarState(),
            searchTerm: '',
            showSearchMenu: false,
            isLoadingSearch: false,
            games: null,
            modalAuth: null,
            modalRegister: null,
            modalDeposit: null,
            showAuthModal: false,
            showRegisterModal: false,
            showUserDropdown: false,
            wallet: null,
            isLoadingWallet: true,
            depositModal: null,
            isLoadingProfile: false,
            totalEarnings: 0,
            totalBets: 0,
            sumBets: 0,
            profileUser: null,
            profileName: '',
            avatarUrl: null,
            showDepositModal: false,
            state: {
                currencyFormat: (amount, currency = 'BRL') => {
                    if (!amount) return 'R$ 0,00';
                    
                    const formatter = new Intl.NumberFormat('pt-BR', {
                        style: 'currency',
                        currency: currency || 'BRL',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    
                    return formatter.format(amount);
                }
            },
            profileModal: null
        }
    },

    methods: {
        getInitialSidebarState() {
            return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
                ? false
                : JSON.parse(localStorage.getItem('sidebarStatus') || 'false')
        },
        
        toggleMenu() {
            this.sidebarMenuStore.setSidebarToogle()
        },
        
        toggleSearch() {
            this.showSearchMenu = !this.showSearchMenu
        },
        
        openAuthModal(tab = 'login') {
            this.showAuthModal = true
            this.$nextTick(() => {
                if (this.$refs.authModal) {
                    this.$refs.authModal.activeTab = tab
                }
            })
        },
        
        closeAuthModal() {
            this.showAuthModal = false
        },
        
        registerToggle() {
            console.log('Toggle register modal', this.showRegisterModal)
            this.showRegisterModal = !this.showRegisterModal
        },
        
        hideLoginShowRegisterToggle() {
            this.showAuthModal = false
            this.showRegisterModal = true
        },
        
        hideRegisterShowLoginToggle() {
            this.showRegisterModal = false
            this.showAuthModal = true
        },
        
        async logoutAccount() {
            try {
                await this.authStore.logout()
                // Limpa o cache ao fazer logout
                this.cacheStore.clearCache()
                this.router.push({ name: 'home' })
                this.toast.success(this.$t('You have been successfully disconnected'))
            } catch (error) {
                console.error('Logout error:', error)
            }
        },
        
        toggleUserDropdown() {
            this.showUserDropdown = !this.showUserDropdown;
        },
        
        handleClickOutside(event) {
            if (!event.target.closest('.margin-teste')) {
                this.showUserDropdown = false;
            }
        },
        
        openDepositModal() {
            console.log('Abrindo modal de depósito')
            this.modalStore.openDepositModal()
        },
        
        profileToggle() {
            this.isLoadingProfile = true;
        },
        
        getWallet: async function() {
            const _this = this;
            _this.isLoadingWallet = true;

            await HttpApi.get('profile/wallet')
                .then(response => {
                    _this.wallet = response.data.wallet;
                    _this.isLoadingWallet = false;
                })
                .catch(error => {
                    console.error('Erro ao carregar carteira:', error);
                    _this.isLoadingWallet = false;
                });
        },
        
        updateName(newName) {
            // Implement the logic to update the user's name
        },
        
        openFileInput() {
            // Aciona o input file oculto
            this.$refs.fileInput.click();
        },
        
        async handleAvatarUpload(event) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Validação do tipo de arquivo
            if (!file.type.startsWith('image/')) {
                this.toast.error('Por favor, selecione uma imagem válida');
                return;
            }
            
            // Validação do tamanho (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                this.toast.error('A imagem deve ter no máximo 2MB');
                return;
            }
            
            const formData = new FormData();
            formData.append('avatar', file);
            
            try {
                this.isLoadingProfile = true;
                const response = await HttpApi.post('/profile/update-avatar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                
                // Atualiza o avatar no store
                if (this.authStore && this.authStore.updateUserAvatar) {
                    this.authStore.updateUserAvatar(response.data.avatar);
                }
                
                this.toast.success('Avatar atualizado com sucesso!');
            } catch (error) {
                console.error('Erro ao atualizar avatar:', error);
                this.toast.error('Erro ao atualizar avatar. Tente novamente.');
            } finally {
                this.isLoadingProfile = false;
                // Limpa o input file
                event.target.value = '';
            }
        },
        
        async openProfileModal() {
            this.showUserDropdown = false;
            this.isLoadingProfile = true;
            
            try {
                const response = await HttpApi.get('/profile');
                this.sumBets = response.data.sumBets;
                this.totalBets = response.data.totalBets;
                this.totalEarnings = response.data.totalEarnings;
                this.profileUser = response.data.user;
                
                this.$nextTick(() => {
                    const modalProfileEl = document.getElementById('modalProfileEl');
                    if (!this.profileModal && modalProfileEl) {
                        this.profileModal = new Modal(modalProfileEl, {
                            placement: 'center',
                            backdrop: 'dynamic',
                            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                            closable: false,
                        });
                    }
                    
                    if (this.profileModal) {
                        this.profileModal.show();
                    }
                });
            } catch (error) {
                console.error('Erro ao carregar dados do perfil:', error);
                this.toast.error('Erro ao carregar dados do perfil');
            } finally {
                this.isLoadingProfile = false;
            }
        },
        
        closeProfileModal() {
            if (this.profileModal) {
                this.profileModal.hide();
            }
        },
        
        async getProfile() {
            try {
                const response = await HttpApi.get('/profile/');
                this.sumBets = response.data.sumBets;
                this.totalBets = response.data.totalBets;
                this.totalEarnings = response.data.totalEarnings;
                this.profileUser = response.data.user;
                this.profileName = response.data.user.name;
                
                if(response.data.user?.avatar != null) {
                    this.avatarUrl = '/storage/'+response.data.user.avatar;
                }
            } catch (error) {
                console.error('Erro ao carregar perfil:', error);
                throw error;
            }
        },
        
        navigateHome(event) {
            event.preventDefault()
            
            if (this.$route.name === 'home') {
                return
            }

            this.modalStore.closeDepositModal()
            this.$router.replace({ name: 'home' })
        },

        handleLogoClick(event) {
            this.navigateHome(event);
        },

        formatBalance(balance) {
            if (!balance) return '0,00';
            
            // Converte para número e formata com 2 casas decimais
            return Number(balance)
                .toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
        },

        // Método para navegar para o painel de afiliados (caso precise usar em outro lugar)
        goToAffiliate() {
            this.showUserDropdown = false; // Fecha o dropdown
            this.$router.push({ name: 'profileAffiliate' });
        }
    },

    watch: {
        searchTerm(newValue) {
            // Implementar lógica de busca aqui
        },
        
        isAuthenticated(newVal) {
            if (newVal) {
                this.getWallet();
            }
        }
    },

    mounted() {
        // Inicializar modais
        const modalAuthEl = document.getElementById('modalElAuth')
        const modalRegisterEl = document.getElementById('modalElRegister')

        if (modalAuthEl) {
            this.modalAuth = new Modal(modalAuthEl, {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                closable: false,
                onHide: () => {
                    // Limpar dados do formulário se necessário
                },
                onShow: () => {
                    // Focar no primeiro campo se necessário
                }
            })
        }

        if (modalRegisterEl) {
            this.modalRegister = new Modal(modalRegisterEl, {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                closable: false,
                onHide: () => {
                    // Limpar dados do formulário se necessário
                },
                onShow: () => {
                    // Focar no primeiro campo se necessário
                }
            })
        }

        // Fechar menu ao clicar fora
        document.addEventListener('click', this.handleClickOutside);

        // Adiciona listener para fechar o dropdown quando clicar fora
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('dropdown-user2');
            const profileButton = e.target.closest('.profile-button');
            
            if (!dropdown?.contains(e.target) && !profileButton) {
                this.showUserDropdown = false;
            }
        });

        // Inicialização do modal de perfil
        const modalProfileEl = document.getElementById('modalProfileEl');
        if (modalProfileEl) {
            this.profileModal = new Modal(modalProfileEl, {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                closable: false,
                onHide: () => {
                    // Limpar dados se necessário
                },
                onShow: () => {
                    // Inicializar dados se necessário
                    this.initializeProfile();
                }
            });
        }
    },

    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
    }
}
</script>

<style scoped>
@import './styles/nav.css';

.hover-menu:hover {
  background-color: #0F2B39;
  border-radius: 10px;
}

.sair-menu:hover {
  background-color: #27171A;
  border-radius: 10px;
  color: #D3345D;
}

.sairp-menu:hover {
  color: #D3345D;
}

.botao-entrar-mobile {
  padding: 3px 10px;
}

@media (max-width:768px) {
  .botao-entrar-mobile {
    padding: 3px 10px;
  }
}

.texto-esportes {
    opacity: .5;
    transition: .3s;
}

.texto-esportes:hover {
    opacity: 1;
}

@media (max-width:1025px) {
    #open-side-nav {
        display: none;
    }
    .tirar-esporte {
        display: none;
    }
}

/* Novo container com gradiente */
.nav-gradient-container {
  background: linear-gradient(
    90deg,
    rgba(0, 162, 212, 0.15) 0%,
    rgba(30, 35, 40, 1) 35%
  );
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  position: relative;
  z-index: 1;
}

/* Efeito de brilho sutil */
.nav-gradient-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(
    90deg,
    rgba(0, 162, 212, 0.05) 0%,
    transparent 50%
  );
  pointer-events: none;
  z-index: -1;
}

/* Ajuste do fundo do menu para transparente */
.nav-menu {
  background: transparent !important;
}

.user-dropdown {
    background: #1E2024;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    z-index: 50;
}

.dropdown-item {
    @apply flex items-center gap-3 px-4 py-2 text-sm text-gray-300 hover:bg-gray-700/50 w-full transition-colors duration-150;
}

/* Garante que o nav não seja afetado pelo dropdown */
.nav-menu {
    @apply z-40;
}

/* Garante que o dropdown fique por cima */
.margin-teste {
    @apply z-50;
}

.ui-button-blue2 {
    @apply flex items-center px-4 rounded-lg bg-[#00A2D4] hover:bg-[#0077FF] text-white font-medium;
    height: 40px;
}

.wallet-container {
    @apply flex items-center;
    height: 40px;
}

.profile-button {
    @apply flex items-center justify-center;
    height: 40px;
}

.user-dropdown {
    @apply bg-[#1E2024] border border-[rgba(255,255,255,0.1)] rounded-lg shadow-lg;
    top: calc(100% + 8px);
}

.wallet-balance-button {
    @apply flex items-center px-4 h-10 rounded-lg font-medium transition-all;
    background: linear-gradient(to right, rgba(0, 162, 212, 0.1), rgba(0, 162, 212, 0.2));
    border: 1px solid rgba(0, 162, 212, 0.2);
    color: white;
}

.wallet-balance-button:hover {
    background: linear-gradient(to right, rgba(0, 162, 212, 0.15), rgba(0, 162, 212, 0.25));
    border-color: rgba(0, 162, 212, 0.3);
}

.wallet-balance-button i {
    @apply text-[#00A2D4];
    font-size: 1.1rem;
}

.wallet-balance-button span {
    @apply text-sm;
}

/* Ajuste para mobile */
@media (max-width: 768px) {
    .wallet-balance-button {
        @apply px-3;
    }
    
    .wallet-balance-button span {
        @apply text-xs;
    }
}
</style>