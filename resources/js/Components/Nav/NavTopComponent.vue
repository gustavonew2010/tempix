<template>
    <nav :class="['fixed', inGameMode ? 'top-0' : 'top-10', 'navtop-color', 'nav-indexx', 'w-full']">
        <PromoBar v-if="!inGameMode" />
        
        <div class="nav-gradient-container">
            <div class="px-3 lg:px-5 lg:pl-3 nav-menu relative">
                <NavCategories />
                
                <div :class="[sidebar ? 'lg:ml-[65px]' : 'lg:ml-[280px]']">
                    <div class="mx-auto w-full" style="max-width: 1110px">
                        <div class="flex items-center justify-between">
                            <template v-if="inGameMode">
                                <button class="back-button ml-4" @click="$emit('back')">
                                    <i class="fas fa-arrow-left"></i>
                                </button>
                            </template>
                            <template v-else>
                                <NavBrand :setting="setting" @navigate-home="navigateHome" />
                            </template>
                            
                            <div class="flex items-center py-3">
                                <!-- Botões de Auth apenas quando não autenticado -->
                                <template v-if="!authStatus && !inGameMode">
                                    <AuthButtons  
                                        @login="openAuthModal('login')" 
                                        @register="openAuthModal('register')" 
                                        class="space-x-2"
                                    />
                                </template>

                                <!-- Menu do usuário apenas quando autenticado -->
                                <div v-else class="flex items-center h-full gap-2">
                                    <button @click="openDepositModal" 
                                            class="ui-button-blue2 h-9 hover:scale-105 transition-transform text-sm">
                                        {{ $t('Deposit') }}
                                    </button>
                                    
                                    <!-- Wallet Balance com margem reduzida -->
                                    <div class="mr-2">
                                        <WalletBalance />
                                    </div>
                                    
                                    <!-- User Menu apenas em desktop -->
                                    <div class="hidden md:flex items-center h-9 margin-teste relative">
                                        <button type="button" 
                                                @click="toggleUserDropdown"
                                                class="profile-button h-full flex items-center"
                                                aria-expanded="false">
                                            <span class="sr-only">Open user menu</span>
                                            <div class="avatar-container">
                                                <img
                                                    v-if="currentAvatar"
                                                    :src="currentAvatar"
                                                    @error="handleAvatarError"
                                                    class="w-8 h-8 rounded-full border-2 border-primary"
                                                    alt="Avatar"
                                                />
                                                <div v-else class="avatar-placeholder-small">
                                                    {{ initials }}
                                                </div>
                                            </div>
                                        </button>
                                        
                                        <!-- Dropdown Menu -->
                                        <div class="user-dropdown absolute right-0 top-[calc(100%+0.5rem)] w-64"
                                             id="dropdown-user2" 
                                             :class="{ 'hidden': !showUserDropdown }">
                                            <div class="flex flex-col items-center p-4 bg-[#1E2024]">
                                                <div class="avatar-container-large">
                                                    <img
                                                        v-if="currentAvatar"
                                                        :src="currentAvatar"
                                                        @error="handleAvatarError"
                                                        class="w-16 h-16 rounded-full border-2 border-primary mb-2"
                                                        alt="Avatar"
                                                    />
                                                    <div v-else class="avatar-placeholder-large">
                                                        {{ initials }}
                                                    </div>
                                                </div>
                                                <p class="text-base font-bold text-white">{{ userData?.name }}</p>
                                                <p class="text-sm text-gray-400">{{ userData?.email }}</p>
                                                <button @click="navigateToAccountManagement" class="mt-3 w-full border border-gray-500 rounded p-2 text-sm text-white">
                                                    {{ $t('Administrar Conta') }}
                                                </button>
                                            </div>
                                            <div class="mt-3 border-t border-gray-700"></div>
                                            <ul class="py-2" role="none">
                                                <li>
                                                    <RouterLink :to="{ name: 'profileWallet' }" class="dropdown-item">
                                                        <i class="fa-duotone fa-wallet text-primary"></i>
                                                        <span>Carteira</span>
                                                    </RouterLink>
                                                </li>
                                                <li>
                                                    <RouterLink :to="{ name: 'profileAffiliate' }" class="dropdown-item" @click="showUserDropdown = false">
                                                        <i class="fa-duotone fa-users text-primary"></i>
                                                        <span>{{ $t('Painel Afiliado') }}</span>
                                                    </RouterLink>
                                                </li>
                                                <li>
                                                    <a @click.prevent="logoutAccount" href="#" class="dropdown-item text-red-500 hover:bg-red-500/10">
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

        <!-- Remova ou comente esta linha se não for mais utilizar o componente inline -->
        <!-- <AccountManagement v-if="showAccountManagement" :userData="userData" /> -->
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
import { onMounted, ref, watch, watchEffect, computed } from "vue";
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
import AccountManagement from '@/Pages/Profile/AccountManagementPage.vue'

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
        DepositWidget,
        AccountManagement
    },
    
    props: {
        authStatus: {
            type: Boolean,
            required: true
        },
        inGameMode: {
            type: Boolean,
            default: false
        },
        userData: {
            type: Object,
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

        const avatarError = ref(false)
        const currentAvatar = ref(null)
        const hoverAvatar = ref(false)
        const avatarInput = ref(null)

        const initials = computed(() => {
            const fullName = userData.value?.displayName || userData.value?.name || ''
            
            if (!fullName) return ''
            
            const nameParts = fullName.trim().split(' ').filter(part => part.length > 0)
            
            if (nameParts.length === 0) return ''
            
            if (nameParts.length === 1) {
                return nameParts[0][0].toUpperCase()
            }
            
            const firstInitial = nameParts[0][0]
            const lastInitial = nameParts[nameParts.length - 1][0]
            
            return (firstInitial + lastInitial).toUpperCase()
        })

        const handleAvatarError = () => {
            console.log('Erro ao carregar avatar:', {
                currentAvatar: currentAvatar.value,
                userData: userData.value?.avatar
            })
            avatarError.value = true
            currentAvatar.value = null
        }

        const triggerFileSelect = () => {
            avatarInput.value.click()
        }

        const validateFile = (file) => {
            if (!file) {
                toast.error('Nenhum arquivo selecionado.')
                return false
            }

            const extension = file.name.split('.').pop().toLowerCase()
            const allowedExtensions = ['jpg', 'jpeg', 'png']
            
            if (!allowedExtensions.includes(extension)) {
                toast.error(`Arquivo ${extension.toUpperCase()} não é permitido. Use apenas JPG ou PNG.`)
                return false
            }

            const maxSize = 5 * 1024 * 1024 // 5MB
            if (file.size > maxSize) {
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2)
                toast.error(`Arquivo muito grande (${sizeMB}MB). O limite é 5MB.`)
                return false
            }

            if (file.size === 0) {
                toast.error('O arquivo está vazio.')
                return false
            }

            return true
        }

        const handleAvatarChange = async (event) => {
            try {
                const file = event.target.files[0]
                
                if (!file) {
                    toast.error('Nenhuma imagem selecionada.')
                    return
                }

                if (!validateFile(file)) {
                    event.target.value = null
                    return
                }

                toast.info('Enviando imagem...')

                // Criar preview local
                const reader = new FileReader()
                reader.onload = (e) => {
                    currentAvatar.value = e.target.result
                    avatarError.value = false // Resetar o erro ao ter um novo preview
                }
                reader.onerror = () => {
                    toast.error('Erro ao ler o arquivo. Tente novamente.')
                    if (event.target) {
                        event.target.value = null
                    }
                }
                reader.readAsDataURL(file)

                const formData = new FormData()
                formData.append('avatar', file)

                const response = await HttpApi.post('/profile/upload-avatar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })

                if (response.data.status) {
                    toast.success('Imagem atualizada com sucesso!')
                    if (authStore.updateUser) {
                        authStore.updateUser(response.data.user)
                    }
                } else {
                    throw new Error(response.data.message || 'Erro ao atualizar imagem.')
                }
            } catch (error) {
                let errorMessage = 'Erro ao fazer upload da imagem.'
                
                if (error.response?.data?.message) {
                    errorMessage = error.response.data.message
                } else if (error.message) {
                    errorMessage = error.message
                }

                toast.error(errorMessage)
                // Restaurar o avatar anterior
                if (userData.value?.avatar) {
                    const avatarPath = userData.value.avatar.startsWith('/storage/') 
                        ? userData.value.avatar 
                        : `/storage/${userData.value.avatar}`
                    currentAvatar.value = avatarPath
                    avatarError.value = false
                } else {
                    currentAvatar.value = null
                    avatarError.value = true
                }
            } finally {
                if (event.target) {
                    event.target.value = null
                }
            }
        }

        const initializeAvatar = () => {
            console.log('Inicializando avatar:', {
                hasUserData: !!userData.value,
                avatar: userData.value?.avatar,
                currentAvatar: currentAvatar.value
            })

            if (userData.value?.avatar) {
                const avatarPath = userData.value.avatar.startsWith('/storage/') 
                    ? userData.value.avatar 
                    : `/storage/${userData.value.avatar}`
                currentAvatar.value = avatarPath
                avatarError.value = false
                console.log('Avatar inicializado:', currentAvatar.value)
            } else {
                currentAvatar.value = null
                avatarError.value = true
                console.log('Sem avatar, usando iniciais')
            }
        }

        // Watch para mudanças no avatar
        watch(() => userData.value?.avatar, (newAvatar) => {
            console.log('Avatar mudou:', {
                new: newAvatar,
                currentAvatar: currentAvatar.value
            })

            if (newAvatar) {
                const avatarPath = newAvatar.startsWith('/storage/') 
                    ? newAvatar 
                    : `/storage/${newAvatar}`
                currentAvatar.value = avatarPath
                avatarError.value = false
                console.log('Avatar atualizado para:', currentAvatar.value)
            } else {
                currentAvatar.value = null
                avatarError.value = true
                console.log('Avatar removido, usando iniciais')
            }
        }, { immediate: true })

        // Watch para o userData inteiro
        watch(() => userData.value, (newUserData, oldUserData) => {
            console.log('UserData mudou:', {
                oldAvatar: oldUserData?.avatar,
                newAvatar: newUserData?.avatar,
                currentAvatar: currentAvatar.value
            })
            
            if (newUserData) {
                initializeAvatar()
            }
        }, { immediate: true })

        onMounted(() => {
            console.log('Componente montado:', {
                hasUserData: !!userData.value,
                avatar: userData.value?.avatar,
                currentAvatar: currentAvatar.value
            })
            initializeAvatar()
        })

        return { 
            authStore, 
            userData,
            router,
            toast,
            sidebarMenuStore,
            setting: settingStore.setting,
            cacheStore,
            modalStore,
            avatarError,
            initials,
            handleAvatarError,
            currentAvatar,
            hoverAvatar,
            avatarInput,
            triggerFileSelect,
            handleAvatarChange
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
            profileModal: null,
            showAccountManagement: false,
            userData: {
                avatar: '/assets/images/default-avatar.png',
                name: 'Gustavo Ribeiro',
                email: 'gustavo.ribeiro01001@gmail.com',
                balance: '0,00',
                displayName: 'Gustavo Ribeiro da Silva Santos',
                phone: '(15) 99184-4611',
                password: '******'
            }
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
        },

        navigateToAccountManagement() {
            this.$router.push({ name: 'accountManagement' });
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
    @apply flex items-center px-3 rounded-lg bg-[#00A2D4] hover:bg-[#0077FF] text-white font-medium;
    height: 36px;
}

.wallet-container {
    @apply flex items-center;
    height: 36px;
}

.profile-button {
    @apply flex items-center justify-center;
    height: 36px;
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
        @apply px-2;
    }
    
    .ui-button-blue2 {
        @apply px-2 text-xs;
    }
}

.avatar-container {
    position: relative;
}

.avatar-container-large {
    position: relative;
}

.avatar-placeholder-small {
    @apply w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold text-white;
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
}

.avatar-placeholder-large {
    @apply w-16 h-16 rounded-full flex items-center justify-center text-xl font-semibold text-white;
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
}
</style>