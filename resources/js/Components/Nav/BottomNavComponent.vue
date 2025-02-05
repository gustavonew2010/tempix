<style>
@media(max-width:1025px) {
    .aparecer-menu {
        display: block;
        z-index: 999;
    }
}

.bg-gradient {
    background: linear-gradient(180deg, 
        rgba(13, 19, 33, 0.95) 0%,
        rgba(20, 30, 48, 0.98) 50%,
        rgba(26, 41, 66, 1) 100%
    );
    box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
}

.mobile-menu-wrapper {
    display: none;
}

@media (max-width: 1024px) {
    .mobile-menu-wrapper {
        display: block;
    }
}

.mobile-menu {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    align-items: center;
    height: 70px;
    padding: 0 0.5rem;
}

.btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px;
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    flex-direction: column;
}

.menu-toggle {
    position: relative;
    z-index: 1000;
    cursor: pointer;
}

.menu-toggle svg {
    transition: transform 0.3s ease;
}

.menu-toggle .menu-active {
    transform: rotate(90deg);
}

.btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
}

@media (min-width: 1025px) {
    .mobile-menu-wrapper {
        display: none;
    }
}

/* Adicione estas classes para melhorar a visibilidade do estado ativo */
.menu-toggle.active {
    color: #00A2D4;
}

.menu-toggle.active svg {
    color: #00A2D4;
}

.menu-toggle:active {
    transform: scale(0.95);
}

.profile-modal {
    position: fixed;
    bottom: 80px;
    left: 0;
    right: 0;
    background: #1E2024;
    padding: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);
    z-index: 999;
}

.profile-header {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 16px;
}

.profile-info {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user-details {
    color: white;
    line-height: 1.4;
}

.user-name {
    font-weight: 600;
    font-size: 16px;
}

.user-email {
    font-size: 12px;
    opacity: 0.7;
}

.close-button {
    color: white;
    padding: 8px;
}

.profile-actions {
    padding: 8px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.admin-button {
    width: 100%;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: white;
    font-size: 14px;
    background: #00A2D4;
    border: none;
    text-align: center;
    border-radius: 8px;
    transition: background 0.2s ease;
}

.admin-button:hover {
    background: #0088b3;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.grid-action-button {
    padding: 12px 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: white;
    font-size: 13px;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    transition: background 0.2s ease;
}

.grid-action-button i {
    font-size: 20px;
    color: #00A2D4;
}

.grid-action-button:hover {
    background: rgba(255, 255, 255, 0.05);
}

.logout-button {
    width: 100%;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: #ff4757;
    font-size: 14px;
    background: rgba(255, 71, 87, 0.1);
    border: none;
    border-radius: 8px;
    transition: background 0.2s ease;
}

.logout-button:hover {
    background: rgba(255, 71, 87, 0.2);
}

.deposit-button {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    color: #fff;
    background: transparent;
    transform: translateY(-10px);
    position: relative;
    z-index: 1001;
    height: 100%;
}

.deposit-button.active,
.deposit-button.active .deposit-icon-wrapper i {
    color: #00A2D4;
}

.deposit-icon-wrapper {
    width: 42px;
    height: 42px;
    background: linear-gradient(135deg, #00A2D4, #0088b3);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2em;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    transition: color 0.2s ease;
}

.deposit-button span {
    font-size: 11px;
    font-weight: 500;
    white-space: nowrap;
    line-height: 1;
    margin: 0;
}

/* Novos estilos para melhorar o design da barra inferior */
.nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    color: #fff;
    padding: 8px 4px;
    transition: color 0.2s ease;
    cursor: pointer;
    text-align: center;
    height: 100%;
    gap: 4px;
}

.nav-item span {
    white-space: nowrap;
    line-height: 1;
    margin: 0;
    font-size: 11px;
}

.nav-item i, 
.nav-item svg {
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s ease;
}

.nav-item:hover {
    color: #00A2D4;
}

.nav-item:hover i,
.nav-item:hover svg {
    color: #00A2D4;
}

/* Active state styles */
.nav-item.active {
    color: #00A2D4;
}

.nav-item.active i,
.nav-item.active svg {
    color: #00A2D4;
}

/* Specific style for profile nav item */
.nav-item img {
    width: 24px;
    height: 24px;
    margin: 0;
}

/* Add media query for small screens */
@media (max-width: 375px) {
    .nav-item {
        padding: 8px 2px;
    }
    
    .nav-item span {
        font-size: 10px;
    }
    
    .nav-item i, 
    .nav-item svg {
        height: 18px;
        width: 18px;
    }
    
    .deposit-icon-wrapper {
        width: 38px;
        height: 38px;
    }
}
</style>
<template>
    <div class="mobile-menu-wrapper aparecer-menu fixed bottom-0 left-0 right-0 bg-gradient z-50">
        <div class="mobile-menu grid grid-cols-7 items-center h-[70px] relative px-4">
            <button @click="toggleMenu" class="nav-item" :class="{ 'active': temporaryActive === 'menu' }">
                <svg
                    height="1em" viewBox="0 0 448 512" width="1em" xmlns="http://www.w3.org/2000/svg"
                    :class="{ 'menu-active': temporaryActive === 'menu' }"
                >
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                        fill="currentColor"></path>
                </svg>
                <span>Menu</span>
            </button>

            <button @click="goToHome" class="nav-item" :class="{ 'active': temporaryActive === 'home' }">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </button>

            <button @click="goToCasino" class="nav-item" :class="{ 'active': temporaryActive === 'cassino' }">
                <i class="fa-solid fa-dice"></i>
                <span>Cassino</span>
            </button>

            <button @click="openDepositModal" 
                    class="nav-item deposit-button"
                    :class="{ 'active': temporaryActive === 'deposit' }">
                <div class="deposit-icon-wrapper">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <span>Depósito</span>
            </button>

            <button @click="goToSlots" class="nav-item" :class="{ 'active': temporaryActive === 'slots' }">
                <i class="fa-solid fa-gamepad"></i>
                <span>Slots</span>
            </button>

            <button @click="handleCategoryClick({name: 'Ao vivo', type: 'apostasaovivo'})" 
                    class="nav-item" 
                    :class="{ 'active': temporaryActive === 'apostasaovivo' }">
                <svg height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path class="primary"
                        d="M201.9 32l-128 128h92.13l128-128H201.9zM64 32C28.65 32 0 60.65 0 96v64h6.062l128-128H64zM326.1 160l127.4-127.4C451.7 32.39 449.9 32 448 32h-86.06l-128 128H326.1zM497.7 56.19L393.9 160H512V96C512 80.87 506.5 67.15 497.7 56.19zM224.3 241.7C221.1 239.5 216.9 239.5 213.5 241.4C210.1 243.3 208 247 208 251v137.9c0 4.008 2.104 7.705 5.5 9.656C215.1 399.5 216.9 400 218.7 400c1.959 0 3.938-.5605 5.646-1.682l106.7-68.97C334.1 327.3 336 323.8 336 319.1s-1.896-7.34-5.021-9.354L224.3 241.7z"
                        fill="currentColor"></path>
                    <path class="secondary"
                        d="M0 160v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V160H0zM330.1 329.3l-106.7 68.97C222.6 399.4 220.6 400 218.7 400c-1.77 0-3.562-.4648-5.166-1.379C210.1 396.7 208 392.1 208 388.1V251c0-4.01 2.104-7.705 5.5-9.656c3.375-1.918 7.562-1.832 10.81 .3027l106.7 68.97C334.1 327.3 336 323.8 336 319.1S334.1 327.3 330.1 329.3z"
                        fill="currentColor" opacity="0.4"></path>
                </svg>
                <span>Ao vivo</span>
            </button>

            <button v-if="userData" @click="openProfileMenu" 
                    class="nav-item" 
                    :class="{ 'active': temporaryActive === 'profile' }">
                <img :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                     alt="avatar" 
                     class="w-8 h-8 rounded-full border-2 border-primary">
                <span>Perfil</span>
            </button>
        </div>

        <div v-if="showProfileMenu" class="profile-modal">
            <div class="profile-header">
                <div class="profile-info">
                    <img :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                         alt="avatar" 
                         class="w-12 h-12 rounded-full border-2 border-primary">
                    <div class="user-details">
                        <p class="user-name">{{ userData?.name }}</p>
                        <p class="user-email">{{ userData?.email }}</p>
                    </div>
                </div>
                <button @click="closeProfileMenu" class="close-button">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <div class="profile-actions">
                <button @click="adminAccount" class="admin-button">
                    <i class="fa-duotone fa-user"></i>
                    Administrar conta
                </button>

                <div class="actions-grid">
                    <button @click="openDepositModal" class="grid-action-button">
                        <i class="fa-duotone fa-wallet"></i>
                        Depósito
                    </button>

                    <button @click="goToWallet" class="grid-action-button">
                        <i class="fa-duotone fa-sack-dollar"></i>
                        Carteira
                    </button>

                    <button @click="goToAffiliate" class="grid-action-button">
                        <i class="fa-duotone fa-users"></i>
                        Indicações
                    </button>
                </div>

                <button @click="logoutAccount" class="logout-button">
                    <i class="fa-duotone fa-right-from-bracket"></i>
                    Sair
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import { sidebarStore } from "@/Stores/SideBarStore.js";
    import { useSettingStore } from '@/Stores/SettingStore.js';
    import { useAuthStore } from "@/Stores/Auth.js";
    import { inject, onMounted, ref } from 'vue';
    import emitter from '@/eventBus';
    import { useModalStore } from '@/Stores/ModalStore'

    export default {
        props: {
            categories: {
                type: Array,
                required: true
            }
        },
        setup() {
            const modalStore = useModalStore()
            const sidebarMenuStore = sidebarStore();
            const authStore = useAuthStore();
            const settingStore = useSettingStore();
            const filterGamesByCategory = inject('filterGamesByCategory', () => {});
            const openGameModal = inject('openGameModal', () => {});
            
            const userData = ref(authStore.user);
            
            return {
                modalStore,
                sidebarMenuStore,
                authStore,
                filterGamesByCategory,
                openGameModal,
                userData
            };
        },
        data() {
            return {
                isLoading: false,
                custom: null,
                showProfileMenu: false,
                activeCategory: null,
                temporaryActive: null,
            }
        },
        computed: {
            sidebarStatus() {
                return this.sidebarMenuStore.getSidebarStatus;
            },
            isAuthenticated() {
                return !!this.userData;
            }
        },
        methods: {
            getSetting() {
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;
                if(settingData) {
                    this.setting = settingData;
                }
            },
            toggleMenu() {
                this.setTemporaryActive('menu');
                this.sidebarMenuStore.setSidebarToogle();
            },
            async handleCategoryClick(category) {
                event?.preventDefault();
                
                try {
                    const categoryData = {
                        id: category.id || category.type,
                        name: category.name,
                        type: category.type
                    };
                    
                    emitter.emit('filter-category', categoryData);
                    
                    this.sidebarMenuStore.setSidebarStatus(false);
                    
                    const gamesSection = document.querySelector('.featured-games-section');
                    if (gamesSection) {
                        gamesSection.scrollIntoView({ behavior: 'smooth' });
                    }
                } catch (error) {
                    console.error('Erro ao processar categoria:', error);
                }
            },
            openProfileMenu() {
                this.setTemporaryActive('profile');
                this.showProfileMenu = true;
            },
            closeProfileMenu() {
                this.showProfileMenu = false;
            },
            adminAccount() {
                this.closeProfileMenu();
                this.$emit('open-profile-modal');
            },
            openDepositModal() {
                this.setTemporaryActive('deposit');
                this.modalStore.openDepositModal();
            },
            goToWallet() {
                this.closeProfileMenu();
                this.$router.push({ name: 'profileWallet' });
            },
            goToAffiliate() {
                this.closeProfileMenu();
                this.$router.push({ name: 'profileAffiliate' });
            },
            async logoutAccount() {
                try {
                    await this.authStore.logout();
                    this.closeProfileMenu();
                    this.$router.push({ name: 'home' });
                    this.$toast.success(this.$t('You have been successfully disconnected'));
                } catch (error) {
                    console.error('Logout error:', error);
                }
            },
            goToHome() {
                this.setTemporaryActive('home');
                this.$router.push({ name: 'home' });
            },
            goToCasino() {
                this.setTemporaryActive('cassino');
                this.handleCategoryClick({ name: 'Cassino', type: 'cassino' });
            },
            goToSlots() {
                this.setTemporaryActive('slots');
                this.handleCategoryClick({ name: 'Slots', type: 'slots' });
            },
            setTemporaryActive(item) {
                this.temporaryActive = item;
                setTimeout(() => {
                    this.temporaryActive = null;
                }, 1000);
            },
        },
        created() {
            this.getSetting();
            this.custom = custom;
            if (this.authStore.user) {
                this.userData = this.authStore.user;
            }
        },
        mounted() {
            console.log('Component mounted');
            console.log('Auth status:', this.authStore.isAuthenticated);
            console.log('User data:', this.userData);
        }
    };
</script>
