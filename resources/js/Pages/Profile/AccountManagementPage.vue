<template>
  <BaseLayout>
    <transition name="notification-slide">
      <div v-if="notification.message" :class="['notification', notification.type]">
        {{ notification.message }}
      </div>
    </transition>

    <div class="account-management">
      <div class="account-settings-container">
        <!-- Mini menu interno (lado esquerdo) - Escondido no mobile -->
        <div class="mini-menu hidden md:block">
          <ul>
            <li :class="{ active: selectedTab === 'acesso' }" @click="selectedTab = 'acesso'">
              <i class="fas fa-key"></i>
              <span>Dados de acesso</span>
            </li>
            <li :class="{ active: selectedTab === 'pessoais' }" @click="selectedTab = 'pessoais'">
              <i class="fas fa-user"></i>
              <span>Dados pessoais</span>
            </li>
            <li :class="{ active: selectedTab === 'verificacao' }" @click="selectedTab = 'verificacao'">
              <i class="fas fa-shield-alt"></i>
              <span>Verificação</span>
            </li>
          </ul>
        </div>

        <!-- Conteúdo principal (lado direito) -->
        <div class="settings-content">
          <!-- Benefícios do nível - Escondido no mobile -->
          <div class="level-benefits-container">
            <div class="level-benefits hidden md:block">
              <!-- ... conteúdo existente ... -->
            </div>
          </div>

          <!-- Tabs para mobile -->
          <div class="mobile-tabs md:hidden grid grid-cols-2 gap-4 mb-6">
            <div class="col-span-1">
              <button 
                @click="selectedTab = 'acesso'"
                :class="['mobile-tab', { active: selectedTab === 'acesso' }]"
              >
                <i class="fas fa-key"></i>
                <span>Dados de acesso</span>
              </button>
            </div>
            <div class="col-span-1">
              <button 
                @click="selectedTab = 'pessoais'"
                :class="['mobile-tab', { active: selectedTab === 'pessoais' }]"
              >
                <i class="fas fa-user"></i>
                <span>Dados pessoais</span>
              </button>
            </div>
            <div class="col-span-2">
              <button 
                @click="selectedTab = 'verificacao'"
                :class="['mobile-tab', { active: selectedTab === 'verificacao' }]"
              >
                <i class="fas fa-shield-alt"></i>
                <span>Verificação</span>
              </button>
            </div>
          </div>

          <!-- Conteúdo das tabs -->
          <template v-if="isLoading">
            <div class="skeleton-wrapper" :key="selectedTab">
              <!-- Skeleton do ProfileHeader -->
              <div class="profile-header-skeleton">
                <div class="header-left">
                  <div class="skeleton avatar-skeleton"></div>
                  <div class="user-info-skeleton">
                    <div class="skeleton name-skeleton"></div>
                    <div class="skeleton email-skeleton"></div>
                    <div class="skeleton balance-skeleton"></div>
                  </div>
                </div>
                <div class="level-badge-skeleton">
                  <div class="skeleton badge-skeleton"></div>
                </div>
              </div>

              <!-- Skeleton do conteúdo específico da tab -->
              <div class="tab-content-skeleton">
                <!-- Dados de Acesso -->
                <template v-if="selectedTab === 'acesso'">
                  <div class="card-skeleton">
                    <div class="card-header-skeleton">
                      <div class="skeleton title-skeleton"></div>
                      <div class="skeleton subtitle-skeleton"></div>
                    </div>
                    
                    <!-- Email e Nome de exibição -->
                    <div class="field-row">
                      <div class="field-group">
                        <div class="skeleton label-skeleton"></div>
                        <div class="verification-field-skeleton">
                          <div class="skeleton input-skeleton"></div>
                          <div class="skeleton button-skeleton"></div>
                        </div>
                      </div>
                      <div class="field-group">
                        <div class="skeleton label-skeleton"></div>
                        <div class="skeleton input-skeleton"></div>
                      </div>
                    </div>

                    <!-- Telefone e Senha -->
                    <div class="field-row">
                      <div class="field-group">
                        <div class="skeleton label-skeleton"></div>
                        <div class="verification-field-skeleton">
                          <div class="skeleton input-skeleton"></div>
                          <div class="skeleton button-skeleton"></div>
                        </div>
                      </div>
                      <div class="field-group">
                        <div class="skeleton label-skeleton"></div>
                        <div class="skeleton input-skeleton"></div>
                      </div>
                    </div>

                    <!-- Botão Salvar -->
                    <div class="action-skeleton">
                      <div class="skeleton save-button-skeleton"></div>
                    </div>
                  </div>
                </template>

                <!-- Dados Pessoais -->
                <template v-if="selectedTab === 'pessoais'">
                  <div class="cards-container-skeleton">
                    <!-- Card Dados Pessoais -->
                    <div class="card-skeleton">
                      <div class="card-header-skeleton">
                        <div class="skeleton title-skeleton"></div>
                        <div class="skeleton subtitle-skeleton"></div>
                      </div>
                      
                      <div class="fields-grid">
                        <div v-for="i in 2" :key="i" class="field-row">
                          <div class="field-group">
                            <div class="skeleton label-skeleton"></div>
                            <div class="skeleton input-skeleton"></div>
                          </div>
                          <div class="field-group">
                            <div class="skeleton label-skeleton"></div>
                            <div class="skeleton input-skeleton"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Card Endereço -->
                    <div class="card-skeleton">
                      <div class="card-header-skeleton">
                        <div class="skeleton title-skeleton"></div>
                        <div class="skeleton subtitle-skeleton"></div>
                      </div>
                      
                      <div class="fields-grid">
                        <div v-for="i in 3" :key="i" class="field-row">
                          <div class="field-group">
                            <div class="skeleton label-skeleton"></div>
                            <div class="skeleton input-skeleton"></div>
                          </div>
                          <div class="field-group">
                            <div class="skeleton label-skeleton"></div>
                            <div class="skeleton input-skeleton"></div>
                          </div>
                        </div>
                      </div>

                      <!-- Botão Salvar -->
                      <div class="action-skeleton">
                        <div class="skeleton save-button-skeleton"></div>
                      </div>
                    </div>
                  </div>
                </template>

                <!-- Verificação -->
                <template v-if="selectedTab === 'verificacao'">
                  <div class="verification-skeleton">
                    <div class="card-header-skeleton">
                      <div class="skeleton title-skeleton"></div>
                      <div class="skeleton subtitle-skeleton"></div>
                    </div>

                    <div class="documents-list-skeleton">
                      <div v-for="i in 3" :key="i" class="document-card-skeleton">
                        <div class="document-header">
                          <div class="document-info">
                            <div class="skeleton icon-skeleton"></div>
                            <div class="content">
                              <div class="skeleton title-skeleton"></div>
                              <div class="skeleton subtitle-skeleton"></div>
                            </div>
                          </div>
                          <div class="document-status">
                            <div class="skeleton status-badge-skeleton"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </template>

          <div v-else>
            <AccessDataTab 
              v-if="selectedTab === 'acesso'"
              :user-data="userData"
              @update="handleUpdate"
            />
            
            <PersonalDataTab 
              v-else-if="selectedTab === 'pessoais'"
              :user-data="userData"
              @update="handleUpdate"
            />
            
            <VerificationTab 
              v-else-if="selectedTab === 'verificacao'"
              :user-data="userData"
              @update="handleUpdate"
            />
          </div>
        </div>
      </div>
    </div>
  </BaseLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useNotification } from '@/Composables/useNotification'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import AccessDataTab from '@/Components/Profile/AccessDataTab.vue'
import PersonalDataTab from '@/Components/Profile/PersonalDataTab.vue'
import VerificationTab from '@/Components/Profile/VerificationTab.vue'
import HttpApi from '@/Services/HttpApi.js'

const selectedTab = ref('acesso')
const userData = ref(null)
const notification = ref({ message: '', type: '' })
const isLoading = ref(true)

const { showNotification } = useNotification()

// Carrega os dados do usuário
const fetchUserData = async () => {
  try {
    const response = await HttpApi.get('/profile')
    if (response.data?.user) {
      userData.value = response.data.user
    }
  } catch (error) {
    console.error('Erro ao buscar dados:', error)
    showNotification('Erro ao carregar dados do usuário', 'error')
  } finally {
    isLoading.value = false
  }
}

// Atualiza os dados do usuário quando recebe atualizações dos componentes filhos
const handleUpdate = async (newData) => {
  if (newData) {
    userData.value = { ...userData.value, ...newData }
  }
}

onMounted(() => {
  fetchUserData()
})
</script>

<style scoped>
.account-management {
  padding: 24px;
  max-width: 1200px;
  margin: 0 auto;
}

.account-settings-container {
  display: flex;
  gap: 24px;
  /* O container flex faz com que o mini-menu acompanhe a altura do conteúdo. */
}

/* Mini menu styles */
.mini-menu {
  width: 200px;
  background: var(--card-bg);
  border-radius: 8px;
  padding: 16px;
  /* A borda acompanha a altura total do container */
  border-right: 1px solid rgba(255, 255, 255, 0.1);
}

.mini-menu ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.mini-menu li {
  padding: 10px; /* Reduzido */
  margin-bottom: 8px;
  border-radius: 4px;
  cursor: pointer;
  color: #fff;
  display: flex;
  align-items: center;
  gap: 8px; /* Gap menor */
  transition: all 0.3s ease;
  white-space: nowrap; /* Garante que o item fique em uma única linha */
}

.mini-menu li:hover {
  background: rgba(255, 255, 255, 0.1);
}

.mini-menu li.active {
  background: #00c6ff;
  color: #fff;
}

.mini-menu li i {
  width: 20px;
  text-align: center;
}

/* Estilização do texto do menu:
   - O texto não será cortado;
   - Utiliza clamp() para reduzir dinamicamente a fonte, garantindo que caiba dentro do mini-menu. */
.mini-menu li span {
  white-space: nowrap;
  font-size: clamp(0.65rem, 1.5vw, 0.85rem);
}

/* Conteúdo principal */
.settings-content {
  flex: 1;
  min-height: 500px;
}

/* Notification styles */
.notification {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 12px 24px;
  border-radius: 4px;
  color: #fff;
  z-index: 1000;
  display: flex;
  align-items: center;
  gap: 8px;
}

.notification.success {
  background: #4CAF50;
}

.notification.error {
  background: #f44336;
}

.notification-slide-enter-active,
.notification-slide-leave-active {
  transition: all 0.3s ease;
}

.notification-slide-enter-from,
.notification-slide-leave-to {
  transform: translateX(100%);
  opacity: 0;
}

/* Responsividade */
@media (max-width: 768px) {
  .account-settings-container {
    flex-direction: column;
  }

  .mini-menu {
    width: 100%;
    border-right: none; /* Remove a borda à direita no mobile */
    border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Adiciona borda inferior para separação */
  }

  .mini-menu ul {
    display: flex;
    overflow-x: auto;
    padding-bottom: 8px;
  }

  .mini-menu li {
    margin: 0 8px 0 0;
  }
  
  .mini-menu li span {
    font-size: clamp(0.65rem, 1.5vw, 0.8rem);
  }
}

.skeleton-wrapper {
  @apply space-y-6;
}

.profile-header-skeleton {
  @apply bg-gray-800 p-6 rounded-xl flex justify-between items-center;
}

.header-left {
  @apply flex items-center gap-4;
}

.avatar-skeleton {
  @apply w-20 h-20 rounded-xl;
}

.user-info-skeleton {
  @apply space-y-2;
}

.name-skeleton {
  @apply h-6 w-40 rounded-lg;
}

.email-skeleton {
  @apply h-4 w-48 rounded-lg;
}

.balance-skeleton {
  @apply h-5 w-32 rounded-lg;
}

.level-badge-skeleton {
  @apply h-8 w-24 rounded-full;
}

.card-skeleton {
  @apply bg-gray-800 p-6 rounded-xl space-y-6;
}

.title-skeleton {
  @apply h-7 w-48 rounded-lg;
}

.subtitle-skeleton {
  @apply h-4 w-64 rounded-lg;
}

.fields-skeleton {
  @apply space-y-6;
}

.field-row {
  @apply grid grid-cols-2 gap-6;
}

.field-group {
  @apply space-y-2;
}

.label-skeleton {
  @apply h-4 w-32 rounded-lg;
}

.input-skeleton {
  @apply h-12 w-full rounded-lg;
}

.documents-skeleton {
  @apply space-y-4;
}

.document-card {
  @apply bg-gray-700/50 p-4 rounded-lg;
}

.document-header {
  @apply flex items-center gap-4;
}

.icon-skeleton {
  @apply w-10 h-10 rounded-lg flex-shrink-0;
}

.document-info {
  @apply space-y-2 flex-grow;
}

.doc-title-skeleton {
  @apply h-5 w-32 rounded-lg;
}

.doc-subtitle-skeleton {
  @apply h-4 w-48 rounded-lg;
}

.skeleton {
  background: linear-gradient(
    90deg,
    rgba(255, 255, 255, 0.03) 25%,
    rgba(255, 255, 255, 0.05) 50%,
    rgba(255, 255, 255, 0.03) 75%
  );
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

.verification-field-skeleton {
  @apply relative;
}

.verification-field-skeleton .button-skeleton {
  @apply absolute right-2 top-1/2 -translate-y-1/2 w-20 h-8 rounded-md;
}

.cards-container-skeleton {
  @apply space-y-6;
}

.fields-grid {
  @apply space-y-6;
}

.action-skeleton {
  @apply flex justify-end mt-6 pt-6 border-t border-gray-700;
}

.save-button-skeleton {
  @apply w-24 h-10 rounded-md;
}

.document-card-skeleton {
  @apply bg-gray-800 p-6 rounded-xl mb-4;
}

.document-header {
  @apply flex justify-between items-center;
}

.document-info {
  @apply flex items-center gap-4;
}

.status-badge-skeleton {
  @apply w-24 h-8 rounded-full;
}

.mobile-tab {
  @apply flex items-center justify-center gap-2 w-full p-4 rounded-lg text-sm font-medium transition-all;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.mobile-tab.active {
  @apply bg-primary text-white;
  border-color: transparent;
}

.mobile-tab i {
  @apply text-lg;
}

/* Ajustes responsivos */
@media (max-width: 768px) {
  .account-settings-container {
    @apply px-4;
  }

  .settings-content {
    @apply w-full;
  }

  /* Garante que o container de benefícios fique oculto no mobile */
  .level-benefits-container {
    @apply hidden md:block;
  }
}
</style>