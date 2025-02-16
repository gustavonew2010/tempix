<template>
  <div v-if="!userData" class="skeleton-loader">
    <!-- Header Skeleton -->
    <div class="profile-header">
      <div class="left-info">
        <div class="skeleton avatar-skeleton"></div>
        <div class="user-info-skeleton">
          <div class="skeleton name-skeleton"></div>
          <div class="skeleton balance-skeleton"></div>
        </div>
      </div>
      <div class="skeleton tag-skeleton"></div>
    </div>

    <!-- Access Card Skeleton -->
    <div class="access-card">
      <div class="card-header">
        <div class="skeleton header-title-skeleton"></div>
        <div class="skeleton header-subtitle-skeleton"></div>
      </div>

      <!-- Row 1 Skeleton -->
      <div class="row-field">
        <div class="field-column">
          <div class="skeleton label-skeleton"></div>
          <div class="verification-control">
            <div class="skeleton input-skeleton"></div>
          </div>
        </div>
        <div class="field-column">
          <div class="skeleton label-skeleton"></div>
          <div class="skeleton input-skeleton"></div>
        </div>
      </div>

      <!-- Row 2 Skeleton -->
      <div class="row-field">
        <div class="field-column">
          <div class="skeleton label-skeleton"></div>
          <div class="verification-control">
            <div class="skeleton input-skeleton"></div>
          </div>
        </div>
        <div class="field-column">
          <div class="skeleton label-skeleton"></div>
          <div class="skeleton input-skeleton"></div>
        </div>
      </div>

      <!-- Save Button Skeleton -->
      <div class="card-actions">
        <div class="skeleton button-skeleton"></div>
      </div>
    </div>

    <!-- Exit Button Skeleton -->
    <div class="exit-button">
      <div class="skeleton exit-button-skeleton"></div>
    </div>
  </div>
  <div v-else>
    <transition name="notification-slide">
      <div 
        v-if="notification.message" 
        :class="['notification', notification.type]"
      >
        {{ notification.message }}
      </div>
    </transition>

    <ProfileHeader 
      :userData="userData"
      @update="handleProfileUpdate"
    />

    <div class="access-card">
      <div class="card-header">
        <h3><i class="fas fa-lock"></i> Dados de acesso</h3>
        <p class="card-subtitle">Edite as informações da sua conta</p>
      </div>

      <!-- Linha 1: E-mail e Nome de exibição -->
      <div class="row-field">
        <div class="field-column">
          <label for="email">
            <i class="fas fa-envelope"></i> E-mail
          </label>
          <div class="verification-control">
            <div class="input-wrapper">
              <input
                id="email"
                type="text"
                :value="userData?.email"
                disabled
                :class="['form-input', 'verification-field', { 'verified': userData?.email_verified_at }]"
                placeholder="seuemail@example.com"
              />
              <template v-if="userData?.email_verified_at">
                <span class="verification-button verified verification-button-adjusted">
                  <i class="fas fa-check"></i>
                </span>
              </template>
              <button 
                v-else
                class="verification-button confirm"
                @click="verifyEmailContact"
                :disabled="showEmailVerificationInput || isEmailSending"
              >
                <template v-if="isEmailSending">
                   <span class="spinner"></span>
                </template>
                <template v-else>
                   Verificar
                </template>
              </button>
            </div>
            <template v-if="showEmailVerificationInput && !userData?.email_verified_at">
              <div class="input-wrapper">
                <input
                  id="email-code"
                  type="text"
                  v-model="emailVerificationCode"
                  placeholder="Digite o código de verificação"
                  class="form-input verification-field"
                />
                <button 
                  class="verification-button confirm" 
                  @click="confirmEmailVerification"
                  :disabled="isEmailConfirming"
                >
                  <template v-if="isEmailConfirming">
                    <span class="spinner"></span>
                  </template>
                  <template v-else>
                    Confirmar
                  </template>
                </button>
              </div>
            </template>
          </div>
        </div>
        <div class="field-column">
          <label for="displayName">
            <i class="fas fa-id-card"></i> Nome de exibição
          </label>
          <input
            id="displayName"
            type="text"
            v-model="formData.displayName"
            placeholder="Seu nome de exibição"
          />
        </div>
      </div>

      <!-- Linha 2: Telefone e Senha atual -->
      <div class="row-field">
        <div class="field-column">
          <label for="phone">
            <i class="fas fa-phone"></i> Telefone
          </label>
          <div class="verification-control">
            <div class="input-wrapper">
              <input
                type="text"
                v-model="formData.phone"
                placeholder="(00) 00000-0000"
                @input="maskPhone"
                :class="['form-input', 'verification-field', { 'verified': userData?.phone_verified_at }]"
                :disabled="userData?.phone_verified_at"
              />
              <template v-if="userData?.phone_verified_at">
                <span class="verification-button verified verification-button-adjusted">
                  <i class="fas fa-check"></i>
                </span>
              </template>
              <template v-else>
                <button 
                  class="verification-button confirm"
                  @click="verifyPhoneContact"
                  :disabled="showPhoneVerificationInput || isPhoneSending"
                >
                  <template v-if="isPhoneSending">
                    <span class="spinner"></span>
                  </template>
                  <template v-else>
                    Verificar
                  </template>
                </button>
              </template>
            </div>
            <template v-if="showPhoneVerificationInput && !userData?.phone_verified_at">
              <div class="input-wrapper">
                <input
                  id="phone-code"
                  type="text"
                  v-model="phoneVerificationCode"
                  placeholder="Digite o código"
                  class="form-input verification-field"
                />
                <button 
                  class="verification-button confirm"
                  @click="confirmPhoneVerification"
                  :disabled="isPhoneConfirming"
                >
                  <template v-if="isPhoneConfirming">
                    <span class="spinner"></span>
                  </template>
                  <template v-else>
                    Confirmar
                  </template>
                </button>
              </div>
            </template>
          </div>
        </div>
        <div class="field-column">
          <label for="password">
            <i class="fas fa-lock"></i> Senha atual
          </label>
          <div class="input-wrapper">
            <input
              id="password"
              type="password"
              v-model="userData.password"
              placeholder="•••••••••••"
              disabled
            />
            <button 
              class="btn-change-password" 
              @click="openChangePasswordModal"
            >
              Alterar senha
            </button>
          </div>
        </div>
      </div>

      <!-- Botão Salvar -->
      <div class="card-actions">
        <button class="btn-save" @click="saveChanges" :disabled="isSaving">
          <span v-if="isSaving" class="spinner"></span>
          <template v-else>
            <i class="fas fa-save"></i>
            Salvar
          </template>
        </button>
      </div>
    </div>

    <div class="exit-button">
      <button class="btn-exit" @click="logout">
        <i class="fas fa-sign-out-alt"></i>
        Sair
      </button>
    </div>

    <!-- Modal de alteração de senha -->
    <ChangePasswordModal
      :isOpen="isChangePasswordModalOpen"
      @close="closeChangePasswordModal"
      @passwordChanged="handlePasswordChanged"
    />
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import ChangePasswordModal from '../ChangePasswordModal.vue'
import ProfileHeader from './ProfileHeader.vue'
import { useNotification } from '@/Composables/useNotification'
import HttpApi from '@/Services/HttpApi.js'

const props = defineProps({
  userData: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['update'])

// Estados locais
const avatarError = ref(false)
const tagCopied = ref(false)
const isChangePasswordModalOpen = ref(false)
const showEmailVerificationInput = ref(false)
const showPhoneVerificationInput = ref(false)
const emailVerificationCode = ref('')
const phoneVerificationCode = ref('')
const isEmailSending = ref(false)
const isPhoneSending = ref(false)
const isSaving = ref(false)
const isEmailConfirming = ref(false)
const isPhoneConfirming = ref(false)

// Composables
const { showNotification, notification } = useNotification()

// Computed properties
const firstName = computed(() => {
  return props.userData?.displayName || props.userData?.name?.split(' ')[0] || ''
})

const initials = computed(() => {
  if (!props.userData?.name) return ''
  return props.userData.name
    .split(' ')
    .map(word => word[0])
    .join('')
    .toUpperCase()
})

const userTag = computed(() => {
  return props.userData?.id?.toString().padStart(6, '0') || '000000'
})

// Inicializar formData com os dados do userData
const formData = ref({
  displayName: props.userData?.displayName || props.userData?.name || '',
  phone: props.userData?.phone && props.userData.phone !== '00' ? props.userData.phone : ''
})

// Watch para atualizar o formData quando userData mudar
watch(() => props.userData, (newValue) => {
  if (newValue) {
    formData.value = {
      displayName: newValue.displayName || newValue.name || '',
      phone: newValue.phone && newValue.phone !== '00' ? newValue.phone : ''
    }
  }
}, { immediate: true })

// Métodos
const handleAvatarError = () => {
  avatarError.value = true
}

const copyUserTag = () => {
  navigator.clipboard.writeText(userTag.value)
  tagCopied.value = true
  setTimeout(() => {
    tagCopied.value = false
  }, 2000)
}

const openChangePasswordModal = () => {
  isChangePasswordModalOpen.value = true
}

const closeChangePasswordModal = () => {
  isChangePasswordModalOpen.value = false
}

const handlePasswordChanged = (message) => {
  showNotification(message, 'success')
}

const maskPhone = (event) => {
  let value = event.target.value.replace(/\D/g, '')
  
  // Se o valor for apenas zeros, limpar o campo
  if (value.match(/^0+$/)) {
    formData.value.phone = ''
    return
  }
  
  if (value.length > 11) value = value.slice(0, 11)
  
  if (value.length > 2) {
    value = `(${value.slice(0, 2)}) ${value.slice(2)}`
  }
  if (value.length > 9) {
    value = `${value.slice(0, 9)}-${value.slice(9)}`
  }
  
  formData.value.phone = value
}

const verifyEmailContact = async () => {
  try {
    isEmailSending.value = true
    const response = await HttpApi.post('/verification/email')
    if (response.data.status) {
      showEmailVerificationInput.value = true
      showNotification('Código de verificação enviado para seu email', 'success')
    }
  } catch (error) {
    showNotification(error.response?.data?.message || 'Erro ao enviar código', 'error')
  } finally {
    isEmailSending.value = false
  }
}

const confirmEmailVerification = async () => {
  if (isEmailConfirming.value) return
  
  try {
    isEmailConfirming.value = true
    const response = await HttpApi.post('/verification/email/confirm', {
      code: emailVerificationCode.value
    })
    if (response.data.status) {
      showNotification('Email verificado com sucesso', 'success')
      // Emitir o usuário completo retornado da API
      emit('update', response.data.user)
      showEmailVerificationInput.value = false
      emailVerificationCode.value = '' // Limpar o código
    }
  } catch (error) {
    showNotification(error.response?.data?.message || 'Código inválido', 'error')
  } finally {
    isEmailConfirming.value = false
  }
}

const verifyPhoneContact = async () => {
  try {
    // Primeiro, salvar o telefone
    const saveResponse = await HttpApi.post('/profile/update', {
      displayName: formData.value.displayName,
      phone: formData.value.phone
    })

    if (!saveResponse.data.status) {
      showNotification('Erro ao salvar telefone', 'error')
      return
    }

    // Depois, enviar o código de verificação
    isPhoneSending.value = true
    const response = await HttpApi.post('/verification/phone')
    
    if (response.data.status) {
      showPhoneVerificationInput.value = true
      showNotification('Código de verificação enviado para seu telefone', 'success')
    }
  } catch (error) {
    showNotification(error.response?.data?.message || 'Erro ao enviar código', 'error')
  } finally {
    isPhoneSending.value = false
  }
}

const confirmPhoneVerification = async () => {
  if (isPhoneConfirming.value) return
  
  try {
    isPhoneConfirming.value = true
    const response = await HttpApi.post('/verification/phone/confirm', {
      code: phoneVerificationCode.value
    })
    if (response.data.status) {
      showNotification('Telefone verificado com sucesso', 'success')
      // Emitir o usuário completo retornado da API
      emit('update', response.data.user)
      showPhoneVerificationInput.value = false
      phoneVerificationCode.value = '' // Limpar o código
    }
  } catch (error) {
    showNotification(error.response?.data?.message || 'Código inválido', 'error')
  } finally {
    isPhoneConfirming.value = false
  }
}

const saveChanges = async () => {
  if (isSaving.value) return

  try {
    isSaving.value = true
    const response = await HttpApi.post('/profile/update', {
      displayName: formData.value.displayName,
      phone: formData.value.phone
    })
    
    if (response.data.status) {
      showNotification('Dados atualizados com sucesso', 'success')
      // Usar os dados retornados da API
      emit('update', response.data.user)
    }
  } catch (error) {
    console.error('Erro ao salvar:', error)
    showNotification(
      error.response?.data?.message || 'Erro ao salvar alterações', 
      'error'
    )
  } finally {
    isSaving.value = false
  }
}

const logout = async () => {
  try {
    await HttpApi.post('/auth/logout')
    window.location.href = '/login'
  } catch (error) {
    showNotification('Erro ao fazer logout', 'error')
  }
}

const handleProfileUpdate = (updatedUser) => {
  emit('update', updatedUser)
}
</script>

<style scoped>
/* Profile Header Styles */
.profile-header {
  background: var(--card-bg);
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.left-info {
  display: flex;
  align-items: center;
  gap: 16px;
}

.avatar-wrapper {
  position: relative;
}

.avatar-container-square {
  width: 80px;
  height: 80px;
  border-radius: 8px;
  overflow: hidden;
  position: relative;
  background: #333;
}

.avatar-img-square {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.avatar-placeholder {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: #fff;
  background: #666;
}

.avatar-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
  cursor: pointer;
}

.avatar-overlay:hover {
  opacity: 1;
}

.avatar-overlay i {
  color: #fff;
  font-size: 24px;
}

.user-info {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.name-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.full-name {
  color: #fff;
  margin: 0;
}

.user-balance {
  color: #666;
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
}

.user-tag-container {
  position: relative;
  cursor: pointer;
}

.user-tag {
  background: #1a1a1a;
  padding: 8px 16px;
  border-radius: 4px;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #666;
}

.copy-message {
  position: absolute;
  top: -30px;
  right: 0;
  background: #00c6ff;
  color: #fff;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
}

/* Access Card Styles */
.access-card {
  background: var(--card-bg);
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 24px;
}

.card-header {
  margin-bottom: 24px;
}

.card-header h3 {
  color: #fff;
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
}

.card-subtitle {
  color: #666;
  margin: 4px 0 0 0;
}

.row-field {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
  margin-bottom: 24px;
}

.field-column {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.field-column.full-width {
  grid-column: 1 / -1;
}

label {
  color: #fff;
  display: flex;
  align-items: center;
  gap: 8px;
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

input, select {
  width: 100%;
  padding: 12px;
  background: #1a1a1a;
  border: 1px solid #333;
  border-radius: 4px;
  color: #fff;
  font-size: 14px;
}

input:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.verification-control {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.verification-field {
  padding-right: 100px;
}

.verification-field.verified {
  border-color: #00c6ff;
}

.verification-button {
  position: absolute;
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-size: 12px;
  transition: all 0.3s ease;
}

.verification-button.confirm {
  background: #00c6ff;
  color: #fff;
}

.verification-button.verified {
  background: transparent;
  color: #00c6ff;
  cursor: default;
}

.verification-button-adjusted {
  padding: 6px 8px;
}

.btn-icon {
  background: none;
  border: none;
  color: #666;
  cursor: pointer;
  padding: 8px;
}

.btn-icon:hover {
  color: #fff;
}

.toggle-password {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
}

.btn-change-password {
  position: absolute;
  right: 4px;
  top: 50%;
  transform: translateY(-50%);
  background: #00c6ff;
  color: #fff;
  border: none;
  padding: 6px 12px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 12px;
  transition: background 0.3s ease;
}

.btn-change-password:hover {
  background: #0099cc;
}

.card-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 24px;
}

.btn-save {
  background: #00c6ff;
  color: #fff;
  border: none;
  padding: 12px 24px;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background 0.3s ease;
}

.btn-save:hover {
  background: #0099cc;
}

.exit-button {
  margin-top: 24px;
  text-align: center;
}

.btn-exit {
  background: #f44336;
  color: #fff;
  border: none;
  padding: 12px 24px;
  border-radius: 4px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: background 0.3s ease;
}

.btn-exit:hover {
  background: #d32f2f;
}

.error-message {
  color: #f44336;
  font-size: 12px;
  margin-top: 4px;
}

.spinner {
  width: 16px;
  height: 16px;
  border: 2px solid #fff;
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* Fade animation */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Responsividade */
@media (max-width: 768px) {
  .row-field {
    grid-template-columns: 1fr;
    gap: 16px;
  }

  .profile-header {
    flex-direction: column;
    gap: 16px;
    text-align: center;
  }

  .left-info {
    flex-direction: column;
  }

  .user-tag-container {
    width: 100%;
  }

  .user-tag {
    justify-content: center;
  }
}

/* Adicionar estilos para a notificação */
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

/* Atualizar estilos do spinner */
.spinner {
  display: inline-block;
  width: 16px;
  height: 16px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 1s ease-in-out infinite;
  margin-right: 8px;
}

/* Estilo para o botão desabilitado */
.btn-save:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Ajustar o botão para manter alinhamento com spinner */
.btn-save {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 120px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Adicionar os estilos do skeleton loader */
.skeleton {
  background: linear-gradient(90deg, #2a2a2a 25%, #333 50%, #2a2a2a 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
  border-radius: 4px;
}

@keyframes loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

.skeleton-loader {
  width: 100%;
}

.avatar-skeleton {
  width: 80px;
  height: 80px;
  border-radius: 8px;
}

.user-info-skeleton {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.name-skeleton {
  width: 150px;
  height: 24px;
}

.balance-skeleton {
  width: 100px;
  height: 16px;
}

.tag-skeleton {
  width: 120px;
  height: 36px;
}

.header-title-skeleton {
  width: 200px;
  height: 24px;
  margin-bottom: 8px;
}

.header-subtitle-skeleton {
  width: 300px;
  height: 16px;
  margin-bottom: 24px;
}

.label-skeleton {
  width: 120px;
  height: 16px;
  margin-bottom: 8px;
}

.input-skeleton {
  width: 100%;
  height: 42px;
}

.button-skeleton {
  width: 120px;
  height: 42px;
  margin-left: auto;
}

.exit-button-skeleton {
  width: 120px;
  height: 42px;
  margin: 24px auto 0;
}

/* Responsividade para o skeleton loader */
@media (max-width: 768px) {
  .header-subtitle-skeleton {
    width: 200px;
  }
  
  .name-skeleton {
    width: 120px;
  }
  
  .row-field {
    grid-template-columns: 1fr;
  }
  
  .button-skeleton {
    width: 100%;
  }
}
</style> 