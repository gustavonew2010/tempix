<template>
  <div class="profile-header-wrapper">
    <!-- Skeleton loader -->
    <div v-if="isLoading" class="profile-header skeleton-header">
      <!-- Level badge skeleton -->
      <div class="level-badge-skeleton">
        <div class="skeleton badge-skeleton"></div>
      </div>

      <!-- Header content skeleton -->
      <div class="header-content">
        <div class="flex flex-col md:flex-row items-start gap-4">
          <div class="avatar-section">
            <div class="skeleton avatar-skeleton"></div>
          </div>

          <div class="user-info-skeleton">
            <div class="skeleton name-skeleton"></div>
            <div class="skeleton email-skeleton"></div>
            <div class="skeleton balance-skeleton"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Conteúdo real -->
    <div v-else-if="userData" class="profile-header">
      <div 
        v-if="verificationData?.level" 
        class="level-badge-section"
      >
        <div 
          class="level-badge px-4 py-2 rounded-full text-white text-sm font-medium flex items-center gap-2 cursor-pointer"
          :style="{ backgroundColor: verificationData.level.color_hex }"
          @click="showLevelsModal = true"
        >
          <i class="fas fa-shield-alt"></i>
          <span>{{ verificationData.level.name }}</span>
        </div>
      </div>

      <div class="header-content">
        <div class="flex flex-col md:flex-row items-start gap-4">
          <div class="avatar-section">
            <div 
              class="avatar-container"
              @click="triggerFileSelect"
              @mouseenter="hoverAvatar = true"
              @mouseleave="hoverAvatar = false"
            >
              <img
                v-if="currentAvatar"
                :src="currentAvatar"
                @error="handleAvatarError"
                class="avatar-img"
                alt="Avatar"
              />
              <div v-else class="avatar-placeholder">
                {{ initials }}
              </div>
              <div class="avatar-overlay" :class="{ 'show': hoverAvatar }">
                <div class="overlay-content">
                  <i class="fas fa-camera"></i>
                  <span>Alterar foto</span>
                </div>
              </div>
              <input
                ref="avatarInput"
                type="file"
                accept="image/*"
                class="file-input"
                @change="handleAvatarChange"
              />
            </div>
          </div>

          <div class="user-info flex flex-col justify-between py-0.5 md:h-20">
            <div class="user-details">
              <h2 class="user-name">{{ firstName }}</h2>
              <span class="user-email">{{ userData.email }}</span>
              <div class="balance-info">
                <i class="fas fa-wallet"></i>
                <span class="balance-value">
                  R$ {{ isLoadingWallet ? '...' : currencyFormat(wallet?.total_balance) }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Botão de benefícios - oculto no mobile -->
      <div 
        v-if="verificationData?.level" 
        class="benefits-button-section hidden md:block"
      >
        <button 
          @click="showLevelsModal = true"
          class="benefits-button"
        >
          <span>Descubra os benefícios do seu nível</span>
        </button>
      </div>
    </div>

    <!-- Modal de níveis -->
    <VerificationLevelsModal
      v-if="verificationData"
      :show="showLevelsModal"
      :verification="verificationData"
      :current-level="verificationData.level"
      :all-levels="allLevels"
      @close="showLevelsModal = false"
    />
  </div>
</template>

<style scoped>
.profile-header-wrapper {
  @apply w-full;
}

.profile-header {
  @apply bg-[#1A1D24] rounded-xl overflow-hidden relative;
  @apply border border-white/5;
}

.header-content {
  @apply p-5;
}

.avatar-section {
  @apply flex-shrink-0;
}

.avatar-container {
  @apply w-20 h-20 rounded-xl overflow-hidden relative cursor-pointer;
  @apply bg-gradient-to-br from-[#00c6ff] to-[#0072ff];
  @apply transition-transform duration-300 hover:scale-[1.02];
}

.avatar-img {
  @apply w-full h-full object-cover;
}

.avatar-placeholder {
  @apply w-full h-full flex items-center justify-center;
  @apply text-2xl font-semibold text-white;
}

.avatar-overlay {
  @apply absolute inset-0 flex items-center justify-center;
  @apply bg-gradient-to-b from-black/60 to-black/80;
  @apply opacity-0 transition-opacity duration-300;
}

.avatar-overlay.show {
  @apply opacity-100;
}

.overlay-content {
  @apply flex flex-col items-center gap-1 text-white text-sm text-center p-2;
}

.overlay-content i {
  @apply text-xl mb-1;
}

.file-input {
  @apply hidden;
}

.user-name {
  @apply text-base font-bold text-white m-0;
}

.user-email {
  @apply text-xs text-gray-400;
}

.balance-info {
  @apply flex items-center gap-2 text-gray-300 mt-1;
}

.balance-info i {
  @apply text-[#00c6ff] text-sm;
}

.balance-value {
  @apply text-sm font-medium;
}

/* Estatísticas */
.stat-item {
  @apply flex items-center gap-3 bg-white/5 rounded-lg p-3;
  @apply transition-all duration-300 hover:bg-white/10;
}

.stat-item i {
  @apply text-[#00c6ff] text-lg;
}

.stat-content {
  @apply flex flex-col;
}

.stat-label {
  @apply text-xs text-gray-400;
}

.stat-value {
  @apply text-sm text-white font-medium;
}

/* Skeleton Styles */
.skeleton {
  @apply animate-pulse;
  background: linear-gradient(
    90deg,
    rgba(255, 255, 255, 0.03) 25%,
    rgba(255, 255, 255, 0.05) 50%,
    rgba(255, 255, 255, 0.03) 75%
  );
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

.skeleton-header {
  @apply bg-[#1A1D24] rounded-xl overflow-hidden relative;
  @apply border border-white/5;
}

.level-badge-skeleton {
  @apply absolute top-5 right-5 z-10;
}

.badge-skeleton {
  @apply h-10 w-32 rounded-full;
}

.avatar-skeleton {
  @apply w-20 h-20 rounded-xl;
}

.user-info-skeleton {
  @apply flex flex-col gap-2;
}

.name-skeleton {
  @apply h-6 w-40 rounded;
}

.email-skeleton {
  @apply h-4 w-48 rounded;
}

.balance-skeleton {
  @apply h-5 w-32 rounded mt-1;
}

@keyframes loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

.level-badge-section {
  @apply absolute top-5 right-5 z-10;
}

.level-badge {
  @apply transition-all duration-300 hover:scale-[1.02] hover:brightness-110;
}

/* Novo estilo para a seção do botão de benefícios */
.benefits-button-section {
  @apply absolute bottom-5 right-5 z-10;
}

.benefits-button {
  @apply text-xs text-gray-400 hover:text-white transition-colors duration-300 
         px-4 py-2 rounded-full bg-white/5 hover:bg-white/10;
}

/* Ajuste responsivo */
@media (max-width: 768px) {
  .profile-header {
    @apply pb-5; /* Reduz o padding inferior quando o botão está oculto */
  }
}
</style>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue'
import { useNotification } from '@/Composables/useNotification'
import HttpApi from '@/Services/HttpApi.js'
import VerificationLevelsModal from './VerificationLevelsModal.vue'
import VerificationService from '@/Services/VerificationService'

const props = defineProps({
  userData: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['update'])

// Estados
const avatarError = ref(false)
const tagCopied = ref(false)
const hoverAvatar = ref(false)
const hoverTag = ref(false)
const avatarInput = ref(null)
const currentAvatar = ref(null)
const isLoadingWallet = ref(true)
const wallet = ref(null)
const processInterval = ref(null)
const pollingDelay = ref(3000)
const showLevelsModal = ref(false)
const verificationData = ref(null)
const nextLevel = ref(null)
const allLevels = ref([])
const isLoading = ref(true)

// Computed properties
const firstName = computed(() => {
  return props.userData?.displayName || props.userData?.name?.split(' ')[0] || ''
})

const initials = computed(() => {
  const fullName = props.userData?.displayName || props.userData?.name || ''
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

const userTag = computed(() => {
  return props.userData?.id?.toString().padStart(6, '0') || '000000'
})

// Métodos
const handleAvatarError = () => {
  avatarError.value = true
  currentAvatar.value = null
}

const copyUserTag = () => {
  navigator.clipboard.writeText(userTag.value)
  tagCopied.value = true
  setTimeout(() => {
    tagCopied.value = false
  }, 2000)
}

const triggerFileSelect = () => {
  avatarInput.value.click()
}

const handleAvatarChange = async (event) => {
  // ... código existente do handleAvatarChange ...
}

const getWallet = async () => {
  try {
    const response = await HttpApi.get('profile/wallet')
    wallet.value = response.data.wallet
    isLoadingWallet.value = false
    scheduleNextCheck()
  } catch (error) {
    console.error('Erro ao buscar wallet:', error)
    isLoadingWallet.value = false
  }
}

const scheduleNextCheck = () => {
  if (processInterval.value) {
    clearTimeout(processInterval.value)
  }
  processInterval.value = setTimeout(() => {
    getWallet()
  }, pollingDelay.value)
}

const loadVerificationData = async () => {
  try {
    const response = await VerificationService.getVerificationStatus()
    verificationData.value = response.verification
    nextLevel.value = response.next_level
    allLevels.value = response.all_levels
    
    console.log('Verification Data:', verificationData.value)
    console.log('Current Level:', verificationData.value?.level)
    console.log('All Levels:', allLevels.value)
  } catch (error) {
    console.error('Erro ao carregar dados de verificação:', error)
  }
}

const currencyFormat = (value) => {
  if (!value) return '0,00'
  return new Intl.NumberFormat('pt-BR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(value)
}

// Adicionar função para formatar data
const formatDate = (date) => {
  if (!date) return '-'
  return new Date(date).toLocaleDateString('pt-BR', {
    month: 'long',
    year: 'numeric'
  })
}

// Lifecycle hooks
onMounted(async () => {
  if (props.userData?.avatar) {
    currentAvatar.value = props.userData.avatar
  }
  isLoading.value = true
  await Promise.all([
    getWallet(),
    loadVerificationData()
  ])
  isLoading.value = false
})

onBeforeUnmount(() => {
  if (processInterval.value) {
    clearTimeout(processInterval.value)
  }
})

// Watch
watch(() => props.userData, (newVal) => {
  if (newVal) {
    isLoading.value = false
  }
}, { immediate: true })
</script>