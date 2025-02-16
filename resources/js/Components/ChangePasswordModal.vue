<template>
  <div v-if="isOpen" class="modal-overlay">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Alterar senha</h2>
        <button class="close-button" @click="close">
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <!-- Senha atual -->
        <div class="form-group">
          <label>Senha atual</label>
          <div class="input-wrapper">
            <input
              :type="showCurrentPassword ? 'text' : 'password'"
              v-model="currentPassword"
              placeholder="Confirme sua senha"
              class="form-input"
              :class="{ 'error': validationErrors.currentPassword }"
              @input="handleCurrentPasswordInput"
            />
            <button 
              class="btn-icon toggle-password" 
              @click="showCurrentPassword = !showCurrentPassword"
            >
              <i :class="showCurrentPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
            </button>
          </div>
          <span v-if="validationErrors.currentPassword" class="error-message">
            {{ validationErrors.currentPassword }}
          </span>
        </div>

        <!-- Nova senha -->
        <div class="form-group">
          <label>Nova senha</label>
          <div class="input-wrapper">
            <input
              :type="showNewPassword ? 'text' : 'password'"
              v-model="newPassword"
              placeholder="Digite sua senha"
              class="form-input"
              :class="{ 'error': validationErrors.newPassword }"
              @input="validatePassword"
            />
            <button 
              class="btn-icon toggle-password" 
              @click="showNewPassword = !showNewPassword"
            >
              <i :class="showNewPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
            </button>
          </div>
          
          <!-- Indicadores de força da senha -->
          <div class="password-strength">
            <div class="strength-bars">
              <div 
                v-for="(requirement, index) in passwordRequirements" 
                :key="index"
                class="strength-bar"
                :class="{ 'active': requirement.valid }"
              ></div>
            </div>
            <div class="strength-requirements">
              <p 
                v-for="(requirement, index) in passwordRequirements" 
                :key="index"
                :class="{ 'valid': requirement.valid }"
              >
                <i :class="requirement.valid ? 'fas fa-check' : 'fas fa-times'"></i>
                {{ requirement.text }}
              </p>
            </div>
          </div>
        </div>

        <!-- Confirmar nova senha -->
        <div class="form-group">
          <label>Confirmar Senha</label>
          <div class="input-wrapper">
            <input
              :type="showConfirmPassword ? 'text' : 'password'"
              v-model="confirmPassword"
              placeholder="Confirme sua senha"
              class="form-input"
              :class="{ 'error': validationErrors.confirmPassword }"
              @input="validateConfirmPassword"
            />
            <button 
              class="btn-icon toggle-password" 
              @click="showConfirmPassword = !showConfirmPassword"
            >
              <i :class="showConfirmPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
            </button>
          </div>
          <span v-if="validationErrors.confirmPassword" class="error-message">
            {{ validationErrors.confirmPassword }}
          </span>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn-cancel" @click="close">Voltar</button>
        <button 
          class="btn-confirm" 
          @click="handleChangePassword"
          :disabled="!isFormValid || isLoading"
        >
          <span v-if="isLoading" class="spinner"></span>
          <span v-else>Alterar</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Modal de confirmação -->
  <div v-if="showSuccessModal" class="modal-overlay">
    <div class="modal-content success-modal">
      <div class="success-icon">
        <i class="fas fa-check-circle"></i>
      </div>
      <h3>Senha alterada com sucesso!</h3>
      <p>Sua senha foi atualizada com segurança.</p>
      <button class="btn-confirm" @click="closeSuccessModal">
        Entendi
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import HttpApi from '@/Services/HttpApi.js'

const props = defineProps({
  isOpen: {
    type: Boolean,
    required: true
  }
})

const emit = defineEmits(['close', 'passwordChanged'])

// Estados do formulário
const currentPassword = ref('')
const newPassword = ref('')
const confirmPassword = ref('')
const isLoading = ref(false)
const showSuccessModal = ref(false)

// Estados de visibilidade das senhas
const showCurrentPassword = ref(false)
const showNewPassword = ref(false)
const showConfirmPassword = ref(false)

// Estados de validação
const validationErrors = ref({
  currentPassword: '',
  newPassword: '',
  confirmPassword: ''
})

// Requisitos de senha
const passwordRequirements = ref([
  { text: 'Mínimo de 8 caracteres', valid: false, test: (pwd) => pwd.length >= 8 },
  { text: 'Pelo menos uma letra maiúscula', valid: false, test: (pwd) => /[A-Z]/.test(pwd) },
  { text: 'Pelo menos uma letra minúscula', valid: false, test: (pwd) => /[a-z]/.test(pwd) },
  { text: 'Pelo menos um número', valid: false, test: (pwd) => /[0-9]/.test(pwd) },
  { text: 'Pelo menos um caractere especial', valid: false, test: (pwd) => /[!@#$%^&*]/.test(pwd) }
])

// Computed property para verificar se o formulário é válido
const isFormValid = computed(() => {
  return passwordRequirements.value.every(req => req.valid) &&
         !validationErrors.value.currentPassword &&
         !validationErrors.value.confirmPassword &&
         currentPassword.value &&
         newPassword.value === confirmPassword.value
})

// Validação da senha
const validatePassword = () => {
  // Limpa o erro da senha atual quando o usuário começa a digitar a nova senha
  validationErrors.value.currentPassword = ''
  validationErrors.value.newPassword = ''
  
  passwordRequirements.value.forEach(requirement => {
    requirement.valid = requirement.test(newPassword.value)
  })
  
  validateConfirmPassword()
}

// Validação da confirmação de senha
const validateConfirmPassword = () => {
  if (confirmPassword.value && newPassword.value !== confirmPassword.value) {
    validationErrors.value.confirmPassword = 'As senhas não coincidem'
  } else {
    validationErrors.value.confirmPassword = ''
  }
}

// Adicionar função para limpar erro da senha atual
const handleCurrentPasswordInput = () => {
  validationErrors.value.currentPassword = ''
}

// Função para alterar a senha
const handleChangePassword = async () => {
  if (!isFormValid.value) return

  try {
    isLoading.value = true
    const response = await HttpApi.post('/profile/change-password', {
      current_password: currentPassword.value,
      new_password: newPassword.value,
      confirm_password: confirmPassword.value
    })

    if (response.data.status) {
      // Limpa os campos
      currentPassword.value = ''
      newPassword.value = ''
      confirmPassword.value = ''
      validationErrors.value = {}
      passwordRequirements.value.forEach(req => req.valid = false)
      // Emite evento para fechar o modal principal
      emit('close')
      // Depois mostra o modal de sucesso
      showSuccessModal.value = true
    }
  } catch (error) {
    if (error.response?.data?.message === 'Current password is incorrect') {
      validationErrors.value.currentPassword = 'Senha atual incorreta'
    } else {
      emit('error', error.response?.data?.message || 'Erro ao alterar senha')
    }
  } finally {
    isLoading.value = false
  }
}

// Função para fechar o modal de sucesso
const closeSuccessModal = () => {
  showSuccessModal.value = false
}

// Função para fechar o modal principal
const close = () => {
  currentPassword.value = ''
  newPassword.value = ''
  confirmPassword.value = ''
  validationErrors.value = {}
  passwordRequirements.value.forEach(req => req.valid = false)
  emit('close')
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: #1a1a1a;
  border-radius: 12px;
  width: 90%;
  max-width: 400px;
  padding: 24px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.modal-header h2 {
  color: #fff;
  font-size: 1.25rem;
  margin: 0;
}

.close-button {
  background: none;
  border: none;
  color: #fff;
  cursor: pointer;
  font-size: 1.25rem;
  padding: 4px;
}

.modal-body {
  margin-bottom: 24px;
}

.form-group {
  margin-bottom: 16px;
}

.form-group label {
  display: block;
  color: #fff;
  margin-bottom: 8px;
  font-size: 0.875rem;
}

.input-wrapper {
  position: relative;
}

.form-input {
  width: 100%;
  padding: 12px;
  padding-right: 40px;
  background: #2a2a2a;
  border: 1px solid #333;
  border-radius: 6px;
  color: #fff;
  font-size: 0.875rem;
}

.toggle-password {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #fff;
  cursor: pointer;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}

.btn-cancel,
.btn-confirm {
  padding: 8px 16px;
  border-radius: 6px;
  font-size: 0.875rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 100px;
}

.btn-cancel {
  background: transparent;
  border: 1px solid #333;
  color: #fff;
}

.btn-confirm {
  background: linear-gradient(135deg, #0072ff, #00c6ff);
  border: none;
  color: #fff;
}

.btn-confirm:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.spinner {
  border: 2px solid #f3f3f3;
  border-top: 2px solid #fff;
  border-radius: 50%;
  width: 16px;
  height: 16px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Remove o ícone de revelação de senha do Edge/IE */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
  display: none;
}

/* Remove o ícone de revelação de senha do Chrome/Safari */
input[type="password"]::-webkit-contacts-auto-fill-button,
input[type="password"]::-webkit-credentials-auto-fill-button {
  visibility: hidden;
  display: none !important;
  pointer-events: none;
  height: 0;
  width: 0;
  margin: 0;
}

/* Garante que o input não mostre os ícones nativos */
input[type="password"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

.error {
  border-color: #ff4444 !important;
}

.error-message {
  color: #ff4444;
  font-size: 0.75rem;
  margin-top: 4px;
  display: block;
}

.password-strength {
  margin-top: 12px;
}

.strength-bars {
  display: flex;
  gap: 4px;
  margin-bottom: 8px;
}

.strength-bar {
  height: 4px;
  flex: 1;
  background: #333;
  border-radius: 2px;
  transition: background-color 0.3s ease;
}

.strength-bar.active {
  background: #00c6ff;
}

.strength-requirements {
  font-size: 0.75rem;
  color: #666;
}

.strength-requirements p {
  margin: 4px 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.strength-requirements p.valid {
  color: #00c6ff;
}

.strength-requirements i {
  width: 14px;
}

/* Modal de sucesso */
.success-modal {
  text-align: center;
  padding: 32px;
}

.success-icon {
  font-size: 48px;
  color: #00c6ff;
  margin-bottom: 16px;
}

.success-modal h3 {
  color: #fff;
  margin-bottom: 8px;
}

.success-modal p {
  color: #666;
  margin-bottom: 24px;
}

/* Novo estilo para centralizar o botão */
.success-modal .btn-confirm {
  margin: 0 auto; /* Centraliza horizontalmente */
  width: fit-content; /* Ajusta a largura ao conteúdo */
  min-width: 120px; /* Largura mínima para melhor aparência */
}
</style> 