<template>
  <div v-if="!userData" class="skeleton-loader">
    <!-- Personal Data Card Skeleton -->
    <div class="data-card">
      <div class="card-header-skeleton">
        <div class="skeleton title-skeleton"></div>
        <div class="skeleton subtitle-skeleton"></div>
      </div>
      
      <!-- Form Fields Skeleton -->
      <div class="row-field" v-for="i in 3" :key="i">
        <div class="field-skeleton">
          <div class="skeleton label-skeleton"></div>
          <div class="skeleton input-skeleton"></div>
        </div>
        <div class="field-skeleton">
          <div class="skeleton label-skeleton"></div>
          <div class="skeleton input-skeleton"></div>
        </div>
      </div>
      
      <!-- Button Skeleton -->
      <div class="card-actions">
        <div class="skeleton button-skeleton"></div>
      </div>
    </div>
  </div>
  <div v-else>
    <!-- Adicionar a notificação no topo -->
    <transition name="notification-slide">
      <div 
        v-if="notification.message" 
        :class="['notification', notification.type]"
      >
        {{ notification.message }}
      </div>
    </transition>

    <!-- Substituir o header antigo pelo novo componente -->
    <ProfileHeader 
      :userData="userData"
      @update="handleProfileUpdate"
    />

    <div class="cards-container">
      <!-- Card de Dados Pessoais -->
      <div class="data-card">
        <div class="card-header">
          <h3><i class="fas fa-user"></i> Dados pessoais</h3>
          <p class="card-subtitle">Informações básicas da sua conta</p>
        </div>

        <div class="row-field">
          <div class="field-column">
            <label for="fullName">
              <i class="fas fa-user"></i> Nome completo
            </label>
            <input
              id="fullName"
              type="text"
              v-model="formData.fullName"
              placeholder="Seu nome completo"
            />
          </div>
          <div class="field-column">
            <label for="cpf">
              <i class="fas fa-id-card"></i> CPF
            </label>
            <div class="input-wrapper">
              <input
                id="cpf"
                type="text"
                v-model="formData.cpf"
                placeholder="000.000.000-00"
                @input="maskCPF"
                @blur="validateAndSearchCPF"
                :class="{ 'loading': isSearchingCPF }"
              />
              <span v-if="isSearchingCPF" class="spinner small"></span>
            </div>
          </div>
        </div>

        <div class="row-field">
          <div class="field-column">
            <label for="motherName">
              <i class="fas fa-female"></i> Nome da mãe
            </label>
            <input
              id="motherName"
              type="text"
              v-model="formData.motherName"
              placeholder="Nome completo da mãe"
            />
          </div>
          <div class="field-column">
            <label for="birthDate">
              <i class="fas fa-calendar"></i> Data de nascimento
            </label>
            <DatePicker
              v-model="formData.birthDate"
              placeholder="Selecione a data de nascimento"
            />
          </div>
        </div>
      </div>

      <!-- Card de Endereço -->
      <div class="data-card">
        <div class="card-header">
          <h3><i class="fas fa-map-marker-alt"></i> Endereço</h3>
          <p class="card-subtitle">Informações de localização</p>
        </div>

        <div class="row-field">
          <div class="field-column">
            <label for="cep">
              <i class="fas fa-map-pin"></i> CEP
            </label>
            <div class="input-wrapper">
              <input
                id="cep"
                type="text"
                v-model="formData.cep"
                placeholder="00000-000"
                @input="maskCEP"
                @blur="searchCEP"
                :class="{ 'loading': isSearchingCEP }"
              />
              <span v-if="isSearchingCEP" class="spinner small"></span>
            </div>
          </div>
          <div class="field-column">
            <label for="street">
              <i class="fas fa-road"></i> Rua
            </label>
            <input
              id="street"
              type="text"
              v-model="formData.street"
              placeholder="Nome da rua"
            />
          </div>
        </div>

        <div class="row-field">
          <div class="field-column">
            <label for="neighborhood">
              <i class="fas fa-building"></i> Bairro
            </label>
            <input
              id="neighborhood"
              type="text"
              v-model="formData.neighborhood"
              placeholder="Nome do bairro"
            />
          </div>
          <div class="field-column">
            <label for="city">
              <i class="fas fa-city"></i> Cidade
            </label>
            <input
              id="city"
              type="text"
              v-model="formData.city"
              placeholder="Nome da cidade"
            />
          </div>
        </div>

        <div class="row-field">
          <div class="field-column">
            <label for="state">
              <i class="fas fa-map"></i> Estado
            </label>
            <select id="state" v-model="formData.state">
              <option value="">Selecione um estado</option>
              <option v-for="state in states" :key="state.value" :value="state.value">
                {{ state.label }}
              </option>
            </select>
          </div>
          <div class="field-column">
            <label for="number">
              <i class="fas fa-home"></i> Número
            </label>
            <input
              id="number"
              type="text"
              v-model="formData.number"
              placeholder="Número"
            />
          </div>
        </div>

        <div class="row-field">
          <div class="field-column full-width">
            <label for="complement">
              <i class="fas fa-info-circle"></i> Complemento
            </label>
            <input
              id="complement"
              type="text"
              v-model="formData.complement"
              placeholder="Apartamento, bloco, etc."
            />
          </div>
        </div>

        <div class="card-actions">
          <button class="btn-save" @click="savePersonalData" :disabled="isSaving">
            <span v-if="isSaving" class="spinner"></span>
            <template v-else>
              <i class="fas fa-save"></i>
              Salvar
            </template>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import ProfileHeader from './ProfileHeader.vue'
import { useNotification } from '@/Composables/useNotification'
import HttpApi from '@/Services/HttpApi.js'
import DatePicker from '@/Components/Common/DatePicker.vue'

const props = defineProps({
  userData: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['update'])
const { showNotification, notification } = useNotification()

const avatarError = ref(false)
const tagCopied = ref(false)
const isSaving = ref(false)

// Novo estado para controle da busca
const isSearchingCPF = ref(false)
const isSearchingCEP = ref(false)

// Novo estado para hover do avatar
const hoverAvatar = ref(false)
// Ref para o input de arquivo do avatar
const avatarInput = ref(null)

// Estados
const states = [
  { value: 'AC', label: 'Acre' },
  { value: 'AL', label: 'Alagoas' },
  { value: 'AP', label: 'Amapá' },
  { value: 'AM', label: 'Amazonas' },
  { value: 'BA', label: 'Bahia' },
  { value: 'CE', label: 'Ceará' },
  { value: 'DF', label: 'Distrito Federal' },
  { value: 'ES', label: 'Espírito Santo' },
  { value: 'GO', label: 'Goiás' },
  { value: 'MA', label: 'Maranhão' },
  { value: 'MT', label: 'Mato Grosso' },
  { value: 'MS', label: 'Mato Grosso do Sul' },
  { value: 'MG', label: 'Minas Gerais' },
  { value: 'PA', label: 'Pará' },
  { value: 'PB', label: 'Paraíba' },
  { value: 'PR', label: 'Paraná' },
  { value: 'PE', label: 'Pernambuco' },
  { value: 'PI', label: 'Piauí' },
  { value: 'RJ', label: 'Rio de Janeiro' },
  { value: 'RN', label: 'Rio Grande do Norte' },
  { value: 'RS', label: 'Rio Grande do Sul' },
  { value: 'RO', label: 'Rondônia' },
  { value: 'RR', label: 'Roraima' },
  { value: 'SC', label: 'Santa Catarina' },
  { value: 'SP', label: 'São Paulo' },
  { value: 'SE', label: 'Sergipe' },
  { value: 'TO', label: 'Tocantins' }
]

// Computed properties
const firstName = computed(() => {
  // Usar display_name se existir, caso contrário usar o primeiro nome
  return props.userData?.displayName || props.userData?.name?.split(' ')[0] || ''
})

const initials = computed(() => {
  // Primeiro tenta usar o displayName, se não existir usa o name
  const fullName = props.userData?.displayName || props.userData?.name || ''
  
  if (!fullName) return ''
  
  // Divide o nome em palavras
  const nameParts = fullName.trim().split(' ').filter(part => part.length > 0)
  
  if (nameParts.length === 0) return ''
  
  if (nameParts.length === 1) {
    // Se só tem uma palavra, retorna a primeira letra
    return nameParts[0][0].toUpperCase()
  }
  
  // Pega a primeira letra do primeiro nome e a primeira letra do último nome
  const firstInitial = nameParts[0][0]
  const lastInitial = nameParts[nameParts.length - 1][0]
  
  return (firstInitial + lastInitial).toUpperCase()
})

const userTag = computed(() => {
  return props.userData?.id?.toString().padStart(6, '0') || '000000'
})

// Criar um objeto formData separado para gerenciar os dados do formulário
const formData = ref({
  fullName: '',
  cpf: '',
  motherName: '',
  birthDate: '',
  cep: '',
  street: '',
  neighborhood: '',
  city: '',
  state: '',
  number: '',
  complement: ''
})

// Atualizar formData quando userData mudar
watch(() => props.userData, (newValue) => {
  if (newValue) {
    formData.value = {
      fullName: newValue.fullName || '',
      cpf: newValue.cpf || '',
      motherName: newValue.motherName || '',
      birthDate: newValue.birthDate || '',
      cep: newValue.cep || '',
      street: newValue.street || '',
      neighborhood: newValue.neighborhood || '',
      city: newValue.city || '',
      state: newValue.state || '',
      number: newValue.number || '',
      complement: newValue.complement || ''
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

const maskCPF = (event) => {
  let value = event.target.value.replace(/\D/g, '')
  if (value.length > 11) value = value.slice(0, 11)
  
  if (value.length > 3) {
    value = value.replace(/^(\d{3})/, '$1.')
  }
  if (value.length > 6) {
    value = value.replace(/^(\d{3})\.(\d{3})/, '$1.$2.')
  }
  if (value.length > 9) {
    value = value.replace(/^(\d{3})\.(\d{3})\.(\d{3})/, '$1.$2.$3-')
  }
  
  formData.value.cpf = value
}

const maskCEP = (event) => {
  let value = event.target.value.replace(/\D/g, '')
  if (value.length > 8) value = value.slice(0, 8)
  
  if (value.length > 5) {
    value = value.replace(/^(\d{5})/, '$1-')
  }
  
  formData.value.cep = value
}

const searchCEP = async () => {
  const cep = formData.value.cep.replace(/\D/g, '')
  if (cep.length !== 8) return

  try {
    isSearchingCEP.value = true
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`)
    const data = await response.json()

    if (!data.erro) {
      formData.value = {
        ...formData.value,
        street: data.logradouro,
        neighborhood: data.bairro,
        city: data.localidade,
        state: data.uf,
        complement: data.complemento
      }
      showNotification('Endereço preenchido com sucesso', 'success')
    }
  } catch (error) {
    showNotification('Erro ao buscar CEP', 'error')
  } finally {
    isSearchingCEP.value = false
  }
}

// Nova função que valida e busca os dados do CPF
const validateAndSearchCPF = async () => {
  const cpf = formData.value.cpf.replace(/\D/g, '')
  if (cpf.length !== 11) return
  
  isSearchingCPF.value = true
  
  try {
    const response = await HttpApi.get(`/profile/search-cpf?cpf=${cpf}`)

    if (response.data.error) {
      showNotification(response.data.message, 'error')
      return
    }

    const data = response.data.data
    formData.value = {
      ...formData.value,
      fullName: data.nome,
      motherName: data.mae,
      birthDate: formatDateFromAPI(data.data_nascimento),
      // Preencher endereço se disponível
      cep: data.endereco?.cep || formData.value.cep,
      street: data.endereco?.logradouro || formData.value.street,
      number: data.endereco?.numero || formData.value.number,
      complement: data.endereco?.complemento || formData.value.complement,
      neighborhood: data.endereco?.bairro || formData.value.neighborhood,
      city: data.endereco?.cidade || formData.value.city,
      state: data.endereco?.estado || formData.value.state
    }
  } catch (error) {
    showNotification(
      'Erro ao consultar CPF. Por favor, tente novamente mais tarde.',
      'error'
    )
  } finally {
    isSearchingCPF.value = false
  }
}

const formatDateFromAPI = (dateString) => {
  try {
    const [day, month, year] = dateString.split('/')
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}T12:00:00`
  } catch {
    return null
  }
}

const savePersonalData = async () => {
  if (isSaving.value) return
  
  // Validar campo avatar (obrigatório)
  if (!props.userData.avatar || !props.userData.avatar.trim()) {
    showNotification('O campo avatar é obrigatório', 'error')
    return
  }

  // Validar campos obrigatórios
  const requiredFields = {
    fullName: 'Nome completo',
    cpf: 'CPF',
    motherName: 'Nome da mãe',
    birthDate: 'Data de nascimento',
    cep: 'CEP',
    street: 'Rua',
    neighborhood: 'Bairro',
    city: 'Cidade',
    state: 'Estado',
    number: 'Número'
  }
  
  // Verificar campos vazios
  for (const [field, label] of Object.entries(requiredFields)) {
    if (!formData.value[field]?.trim()) {
      showNotification(`O campo ${label} é obrigatório`, 'error')
      return
    }
  }
  
  // Validar CPF
  const cpf = formData.value.cpf.replace(/\D/g, '')
  if (cpf.length !== 11) {
    showNotification('Por favor, insira um CPF válido', 'error')
    return
  }
  
  // Validar CEP
  const cep = formData.value.cep.replace(/\D/g, '')
  if (cep.length !== 8) {
    showNotification('Por favor, insira um CEP válido', 'error')
    return
  }
  
  try {
    isSaving.value = true
    const response = await HttpApi.put('/profile/update-personal-data', {
      fullName: formData.value.fullName,
      cpf: formData.value.cpf,
      motherName: formData.value.motherName,
      birthDate: formData.value.birthDate,
      cep: formData.value.cep,
      street: formData.value.street,
      neighborhood: formData.value.neighborhood,
      city: formData.value.city,
      state: formData.value.state,
      number: formData.value.number,
      complement: formData.value.complement,
      avatar: props.userData.avatar
    })

    if (response.data.status) {
      showNotification('Dados atualizados com sucesso', 'success')
      emit('update', response.data.user)
    } else {
      showNotification('Erro ao atualizar os dados', 'error')
    }
  } catch (error) {
    showNotification('Erro ao atualizar os dados: ' + error.message, 'error')
  } finally {
    isSaving.value = false
  }
}

// Adicionar método para lidar com atualizações do perfil
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
  cursor: pointer;
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

/* Cards Container Styles */
.cards-container {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.data-card {
  background: var(--card-bg);
  border-radius: 8px;
  padding: 20px;
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

/* Button Styles */
.card-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 24px;
  padding-top: 24px;
  border-top: 1px solid #333;
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

/* Animations */
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

  .card-actions {
    flex-direction: column;
    align-items: stretch;
  }

  .btn-save {
    width: 100%;
    justify-content: center;
  }
}

/* Error States */
.error {
  border-color: #f44336;
}

.error-message {
  color: #f44336;
  font-size: 12px;
  margin-top: 4px;
}

/* Loading States */
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

.input-wrapper {
  position: relative;
  width: 100%;
}

.input-wrapper input {
  width: 100%;
  padding: 12px;
  background: #1a1a1a;
  border: 1px solid #333;
  border-radius: 4px;
  color: #fff;
  font-size: 14px;
}

.input-wrapper input.loading {
  padding-right: 35px;
}

.spinner.small {
  width: 16px;
  height: 16px;
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  border: 2px solid rgba(0, 198, 255, 0.2);
  border-top-color: #00c6ff;
  border-radius: 50%;
  animation: spinOnly 0.8s linear infinite;
}

@keyframes spinOnly {
  from { transform: translateY(-50%) rotate(0deg); }
  to { transform: translateY(-50%) rotate(360deg); }
}

/* Remover estilos não utilizados */
.input-group,
.btn-search {
  display: none;
}

.avatar-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.5);
  color: #fff;
  font-size: 16px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.avatar-container-square:hover .avatar-overlay {
  opacity: 1;
}

.skeleton-loader {
  @apply space-y-6;
}

.card-header-skeleton {
  @apply mb-6 space-y-2;
}

.title-skeleton {
  @apply h-7 w-48 rounded-lg;
}

.subtitle-skeleton {
  @apply h-4 w-64 rounded-lg;
}

.field-skeleton {
  @apply space-y-2;
}

.label-skeleton {
  @apply h-4 w-32 rounded-lg;
}

.input-skeleton {
  @apply h-12 w-full rounded-lg;
}

.button-skeleton {
  @apply h-12 w-32 rounded-lg ml-auto;
}

.skeleton {
  @apply bg-gray-700;
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
</style> 