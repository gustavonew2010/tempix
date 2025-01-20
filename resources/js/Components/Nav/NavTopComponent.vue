<template>
    <nav :class="['fixed top-10 navtop-color nav-indexx', sidebar ? 'w-full' : 'w-full']">
        <PromoBar />
        
        <div class="px-3 lg:px-5 lg:pl-3 nav-menu relative" style="background-color: var(--navtop-color-dark);">
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
                        <NavBrand :setting="setting" @toggle-menu="toggleMenu" />
                        
                        <div class="flex items-center py-3">
                            <AuthButtons v-if="!authStatus"
                                       @login="loginToggle"
                                       @register="registerToggle" />
                            
                            <div v-if="authStatus" class="flex items-center">
                                <MakeDeposit 
                                    :showMobile="false" 
                                    :title="$t('Depositar')"
                                    ref="makeDepositRef"
                                />

                                <WalletBalance />
                                
                                <div class="flex items-center ml-3 margin-teste">
                                    <div>
                                        <button type="button" 
                                                @click="toggleUserDropdown"
                                                class="flex text-sm bg-[white] rounded-full ui-button-blue3" 
                                                aria-expanded="false">
                                            <span class="sr-only">Open user menu</span>
                                            <img :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                                                 alt="avatar" 
                                                 class="w-5 h-5 rounded-full">
                                        </button>
                                    </div>
                                    
                                    <!-- Dropdown Menu -->
                                    <div class="z-50 text-left list-none absolute right-0 mt-2 w-48 rounded-md shadow-lg" 
                                         id="dropdown-user2" 
                                         :class="{ 'hidden': !showUserDropdown }"
                                         style="background-color: white; top: 100%;">
                                        <ul class="py-1" role="none">
                                            <li class="hover-menu">
                                                <RouterLink :to="{ name: 'profileWallet' }" 
                                                          class="flex items-center block px-4 py-2 text-sm"
                                                          style="color: var(--title-color);">
                                                    <i class="fa-duotone fa-wallet pr-3"></i>
                                                    <p style="font-weight: bold">Carteira</p>
                                                </RouterLink>
                                            </li>
                                            
                                            <li class="hover-menu">
                                                <RouterLink :to="{ name: 'profileAffiliate' }"
                                                          class="flex items-center block px-4 py-2 text-sm"
                                                          style="color: var(--title-color);">
                                                    <span class="pr-3">
                                                        <svg height="1em" viewBox="0 0 576 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                            <!-- ... SVG path ... -->
                                                        </svg>
                                                    </span>
                                                    <p style="font-weight: bold">{{ $t('Painel Afiliado') }}</p>
                                                </RouterLink>
                                            </li>
                                            
                                            <li class="hover-menu">
                                                <a style="color: var(--title-color);" 
                                                   href="#" 
                                                   @click.prevent="openProfileModal" 
                                                   class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300" 
                                                   role="menuitem">
                                                    <span class="pr-3">
                                                        <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg" active="true" aria-hidden="true" class="I9SFw"><path d="M610.5 373.3c2.625-14 2.625-28.5 0-42.5l25.75-15c3-1.625 4.375-5.125 3.375-8.5c-6.75-21.5-18.25-41.13-33.25-57.38c-2.25-2.5-6-3.125-9-1.375l-25.75 14.88c-10.88-9.25-23.38-16.5-36.88-21.25V212.3c0-3.375-2.5-6.375-5.75-7c-22.25-5-45-4.875-66.25 0c-3.25 .625-5.625 3.625-5.625 7v29.88c-13.5 4.75-26 12-36.88 21.25L394.4 248.5c-2.875-1.75-6.625-1.125-9 1.375c-15 16.25-26.5 35.88-33.13 57.38c-1 3.375 .3751 6.875 3.25 8.5l25.75 15c-2.5 14-2.5 28.5 0 42.5l-25.75 15c-3 1.625-4.25 5.125-3.25 8.5c6.625 21.5 18.13 41 33.13 57.38c2.375 2.5 6 3.125 9 1.375l25.88-14.88c10.88 9.25 23.38 16.5 36.88 21.25v29.88c0 3.375 2.375 6.375 5.625 7c22.38 5 45 4.875 66.25 0c3.25-.625 5.75-3.625 5.75-7v-29.88c13.5-4.75 26-12 36.88-21.25l25.75 14.88c2.875 1.75 6.75 1.125 9-1.375c15-16.25 26.5-35.88 33.25-57.38c1-3.375-.3751-6.875-3.375-8.5L610.5 373.3zM496 400.5c-26.75 0-48.5-21.75-48.5-48.5s21.75-48.5 48.5-48.5c26.75 0 48.5 21.75 48.5 48.5S522.8 400.5 496 400.5z" fill="currentColor"></path><path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM425.1 491.8v-9.172c-2.303-1.25-4.572-2.559-6.809-3.93l-7.818 4.493c-6.002 3.504-12.83 5.352-19.75 5.352c-10.71 0-21.13-4.492-28.97-12.75c-18.41-20.09-32.29-44.15-40.22-69.9c-5.352-18.06 2.343-36.87 17.83-45.24l8.018-4.669c-.0664-2.621-.0664-5.242 0-7.859l-7.655-4.461c-12.3-6.953-19.4-19.66-19.64-33.38C305.6 306.3 290.4 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512H413.3c5.727 0 10.9-1.727 15.66-4.188C426.7 502.8 425.1 497.5 425.1 491.8z" fill="currentColor" opacity="0.4"></path></svg>
                                                    </span>
                                                    <p style="font-weight: bold"> {{ $t('Dados da conta') }}</p> 
                                                </a>
                                            </li>

                                            <div style="height: 1px;background-color: #27292A;width: 100%;margin-top: 10px;margin-bottom: 10px"></div>
                                            
                                            <li class="sair-menu mb-3">
                                                <a @click.prevent="logoutAccount" 
                                                   href="#"
                                                   class="flex items-center block px-4 py-2 text-sm"
                                                   style="color: var(--title-color);">
                                                    <i class="fa-duotone fa-right-from-bracket pr-3"></i>
                                                    <p>Sair</p>
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
        
        <SearchModal v-if="showSearchMenu" 
                    @close="toggleSearch"
                    :search-term="searchTerm"
                    :games="games"
                    :is-loading="isLoadingSearch" />
        
        <AuthModal v-model="showAuthModal"
                  @close="loginToggle"
                  @show-register="hideLoginShowRegisterToggle" />
        
        <RegisterModal v-model="showRegisterModal"
                      @close="registerToggle"
                      @show-login="hideRegisterShowLoginToggle" />

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
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import {searchGameStore} from "@/Stores/SearchGameStore.js";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";
import ProfileModal from '@/Components/UI/ProfileModal.vue'

// Componentes
import PromoBar from './PromoBar.vue'
import NavCategories from './NavCategories.vue'
import NavBrand from './NavBrand.vue'
import AuthButtons from './AuthButtons.vue'
import UserMenu from './UserMenu.vue'
import SearchModal from './SearchModal.vue'
import AuthModal from './AuthModal.vue'
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
        MakeDeposit,
        CassinoGameCard,
        WalletBalance,
        LanguageSelector,
        DropdownDarkLight,
        RouterLink,
        ProfileModal
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

        return { 
            authStore, 
            userData,
            router,
            toast,
            sidebarMenuStore,
            setting: settingStore.setting
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
        
        loginToggle() {
            console.log('Toggle login modal', this.showAuthModal)
            this.showAuthModal = !this.showAuthModal
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
        
        openDeposit() {
            if (this.$refs.makeDepositRef) {
                this.$refs.makeDepositRef.toggleModalDeposit();
            }
        },
        
        closeDepositModal() {
            if (this.depositModal) {
                this.depositModal.hide();
            }
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
            // Implement the logic to open the file input for updating the avatar
        },
        
        async openProfileModal() {
            this.showUserDropdown = false;
            this.isLoadingProfile = true;
            
            try {
                await this.getProfile();
                
                this.$nextTick(() => {
                    const modalProfileEl = document.getElementById('modalProfileEl');
                    if (!this.modalProfile && modalProfileEl) {
                        this.modalProfile = new Modal(modalProfileEl, {
                            placement: 'center',
                            backdrop: 'dynamic',
                            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
                            closable: false,
                        });
                    }
                    
                    if (this.modalProfile) {
                        this.modalProfile.show();
                    } else {
                        console.error('Modal não foi inicializado corretamente');
                    }
                });
            } catch (error) {
                console.error('Erro ao carregar dados do perfil:', error);
            } finally {
                this.isLoadingProfile = false;
            }
        },
        
        closeProfileModal() {
            if (this.modalProfile) {
                this.modalProfile.hide();
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
        const modalDepositEl = document.getElementById('modalElDeposit')

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

        if (modalDepositEl) {
            this.modalDeposit = new Modal(modalDepositEl, {
                placement: 'center',
                backdrop: 'dynamic',
                backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40 backmodaldeposit',
                closable: true,
                onHide: () => {
                    const divsToDelete = document.querySelectorAll('.backmodaldeposit');
                    divsToDelete.forEach(div => div.remove());
                }
            })
        }

        // Inicializar modal de depósito
        this.depositModal = new Modal(document.getElementById('depositModal'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
            closable: false,
        });

        // Fechar menu ao clicar fora
        document.addEventListener('click', this.handleClickOutside);

        // Adiciona listener para fechar o dropdown quando clicar fora
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('dropdown-user2');
            const profileButton = e.target.closest('.ui-button-blue3');
            
            if (!dropdown?.contains(e.target) && !profileButton) {
                this.showUserDropdown = false;
            }
        });

        // Inicialização do modal de perfil
        const modalProfileEl = document.getElementById('modalProfileEl');
        if (modalProfileEl) {
            this.modalProfile = new Modal(modalProfileEl, {
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
        // Limpar modais ao desmontar
        if (this.modalDeposit) {
            this.modalDeposit.hide();
            this.modalDeposit = null;
        }
        if (this.depositModal) {
            this.depositModal.hide();
            this.depositModal = null;
        }
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
</style>