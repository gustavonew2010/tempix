<template>
    <div class="layout-wrapper" :class="{ 'sidebar-collapsed': sidebarStatus }">
        <NavTopComponent 
            :auth-status="isAuthenticated"
            class="layout-header"
        />
        
        <SideBarComponent :categories="categories" />

        <div class="layout-container">
            <main class="layout-main">
                <div class="layout-content">
                    <slot></slot>
                </div>
                <!-- Lazy load do Footer -->
                <Suspense>
                    <template #default>
                        <FooterComponent v-once class="layout-footer" />
                    </template>
                    <template #fallback>
                        <div class="layout-footer bg-gray-800 h-20"></div>
                    </template>
                </Suspense>
                <BottomNavComponent v-once class="layout-bottom-nav"/>
            </main>
        </div>

        <!-- Modal de Depósito -->
        <Teleport to="body">
            <DepositWidget v-if="modalStore.showDepositModal"/>
        </Teleport>
    </div>
</template>

<script>
import { defineComponent, defineAsyncComponent, computed } from 'vue'
import { useAuthStore } from '@/Stores/Auth.js'
import { storeToRefs } from 'pinia'
import { initFlowbite } from 'flowbite'
import NavTopComponent from "@/Components/Nav/NavTopComponent.vue"
import SideBarComponent from '@/Components/Nav/SideBarComponent.vue'
import FooterComponent from "@/Components/UI/FooterComponent.vue"
import BottomNavComponent from "@/Components/Nav/BottomNavComponent.vue"
import DepositWidget from "@/Components/Widgets/DepositWidget.vue"
import { sidebarStore } from "@/Stores/SideBarStore.js"
import HttpApi from "@/Services/HttpApi.js"
import { useModalStore } from '@/Stores/ModalStore'

export default defineComponent({
    name: 'BaseLayout',
    components: {
        BottomNavComponent,
        FooterComponent: defineAsyncComponent(() => 
            import('@/Components/UI/FooterComponent.vue')
        ),
        SideBarComponent,
        NavTopComponent,
        DepositWidget
    },
    setup() {
        const modalStore = useModalStore()
        const authStore = useAuthStore()
        const { isAuth } = storeToRefs(authStore)
        const sidebarStoreInstance = sidebarStore()
        const sidebarStatus = computed(() => sidebarStoreInstance.getSidebarStatus)
        const categories = []
        
        return {
            modalStore,
            isAuthenticated: isAuth,
            sidebarStatus,
            categories,
        }
    },
    data() {
        return {
            logo: '/assets/images/logo_verde.png',
        }
    },
    async mounted() {
        try {
            await this.loadInitialData()
            initFlowbite()
        } catch (error) {
            console.error('Erro ao inicializar layout:', error)
        }
    },
    methods: {
        async loadInitialData() {
            try {
                const response = await HttpApi.get('categories')
                if (response.data && response.data.categories) {
                    this.categories = response.data.categories
                }
            } catch (error) {
                console.error('Erro ao carregar categorias:', error)
            }
        },
        getInitialSidebarState() {
            return /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
                ? false
                : JSON.parse(localStorage.getItem('sidebarStatus') || 'false')
        },
    },
    watch: {
        isAuthenticated(newValue) {
            this.$nextTick(() => {
                this.$forceUpdate()
            })
        }
    },
    beforeUnmount() {
        document.body.style.overflow = 'auto'
    }
})
</script>

<style scoped>
.layout-wrapper {
    min-height: 100vh;
    background: var(--page-bg, #121212);
    display: flex;
    flex-direction: column;
    padding-top: 115px; /* 50px PromoBar + 65px NavTop */
}

.layout-header {
    position: fixed;
    top: 50px;
    left: 0;
    width: 100%;
    height: 65px;
    z-index: 50;
}

.layout-sidebar {
    position: fixed;
    top: 115px;
    left: 0;
    bottom: 0;
    width: 280px;
    min-width: 280px;
    max-width: 280px;
    transition: all 0.3s ease;
    z-index: 40;
    overflow: hidden;
}

.layout-sidebar.sidebar-collapsed {
    width: 65px;
    min-width: 65px;
    max-width: 65px;
}

.layout-container {
    display: flex;
    flex: 1;
    margin-left: 300px;
    transition: margin-left 0.3s ease;
    width: calc(100% - 300px);
}

.sidebar-collapsed .layout-container {
    margin-left: 80px;
    width: calc(100% - 80px);
}

.layout-main {
    flex: 1;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: calc(100vh - 65px);
}

.layout-content {
    width: 100%;
    max-width: var(--content-max-width, 1440px);
    flex: 1;
    margin: 0 auto;
}

.layout-footer {
    width: 100%;
    margin-top: auto;
}

.layout-bottom-nav {
    display: none;
    width: 100%;
}

/* Responsivo */
@media (max-width: 1024px) {
    .layout-sidebar {
        display: none;
    }

    .layout-container {
        margin-left: 0;
        width: 100%;
    }

    .layout-content {
        padding: 0 1rem;
    }
}

@media (max-width: 768px) {
    .layout-header {
        height: 55px;
    }

    .layout-wrapper {
        padding-top: 105px;
    }

    .layout-content {
        padding: 0 0.5rem;
    }

    .layout-bottom-nav {
        display: block;
    }
}
</style>
