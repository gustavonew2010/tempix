<template>
  <div v-if="!userData" class="skeleton-loader">
    <!-- Header Skeleton -->
    <div class="header-skeleton">
      <div class="skeleton title-skeleton"></div>
      <div class="skeleton subtitle-skeleton"></div>
    </div>

    <!-- Documents Skeleton -->
    <div class="documents-skeleton">
      <div class="document-card-skeleton" v-for="i in 3" :key="i">
        <div class="card-header-skeleton">
          <div class="skeleton icon-skeleton"></div>
          <div class="content-skeleton">
            <div class="skeleton title-line"></div>
            <div class="skeleton subtitle-line"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <!-- Adicionar notificação no topo -->
    <transition name="notification-slide">
      <div 
        v-if="notification.message" 
        :class="['notification', notification.type]"
      >
        {{ notification.message }}
      </div>
    </transition>

    <!-- Adicionar o ProfileHeader -->
    <ProfileHeader 
      :userData="userData"
      @update="handleProfileUpdate"
    />

    <!-- Seção de Documentos -->
    <div class="verification-section">
      <div class="section-header">
        <h3 class="flex items-center gap-2 text-lg md:text-xl font-semibold">
          <i class="fas fa-id-card-alt"></i> Documentos
        </h3>
        <p class="section-subtitle text-sm md:text-base text-gray-400"> 
          Envie seus documentos para aumentar seu nível de verificação
        </p>
      </div>
 
      <div class="documents-list grid gap-4 md:gap-6">
        <!-- Card CPF -->
        <div class="document-card" :class="{ verified: userData?.cpf_verified_at }">
          <div class="card-main">
            <div class="card-info">
              <i class="fas fa-id-card card-icon"></i>
              <div class="card-content">
                <h4 class="text-base md:text-lg font-medium">CPF</h4>
                <p class="text-sm text-gray-400">Verificação do CPF</p>
              </div>
            </div>
            <div class="card-action">
              <template v-if="userData?.cpf_verified_at">
                <span class="badge verified">
                  <i class="fas fa-check"></i> Verificado
                </span>
              </template>
              <template v-else>
                <div class="status-container">
                  <span 
                    v-if="getDocumentStatus('cpf')" 
                    :class="['badge', getStatusBadgeClass(getDocumentStatus('cpf'))]"
                  >
                    <i class="fas" :class="getStatusIcon(getDocumentStatus('cpf'))"></i>
                    {{ getStatusText(getDocumentStatus('cpf')) }}
                  </span>
                  <button
                    v-if="getDocumentStatus('cpf') === 'rejected'"
                    class="btn-view-reason text-sm"
                    @click="toggleRejectionReason('cpf')"
                  >
                    <span>Visualizar motivo</span>
                    <i class="fas" :class="showRejectionReason.cpf ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                  </button>
                  <button
                    v-else-if="activeUploadType !== 'cpf' && !getDocumentStatus('cpf')"
                    class="btn btn-outline text-sm"
                    @click="openUploadArea('cpf')"
                    :disabled="isUploading"
                  >
                    Verificar
                  </button>
                </div>

                <!-- Área de rejeição -->
                <transition name="expand">
                  <div v-if="getDocumentStatus('cpf') === 'rejected' && showRejectionReason.cpf" 
                       class="rejection-container">
                    <p class="rejection-reason text-sm">{{ getDocumentRejectionReason('cpf') }}</p>
                    <button
                      class="btn btn-resubmit text-sm"
                      @click="openUploadArea('cpf')"
                      :disabled="isUploading"
                    >
                      <i class="fas fa-redo"></i>
                      <span>Reenviar documento</span>
                    </button>
                  </div>
                </transition>
              </template>
            </div>
          </div>

          <!-- Área de Upload -->
          <transition name="slide-down">
            <div
              v-if="activeUploadType === 'cpf'"
              class="dropzone-expanded"
              @click="triggerFileSelect('cpf')"
            >
              <template v-if="isUploading">
                <span class="spinner"></span>
                <span class="drop-text text-sm">Enviando documento...</span>
              </template>
              <template v-else>
                <i class="fas fa-cloud-upload-alt drop-icon"></i>
                <span class="drop-text text-sm">Clique para enviar o documento</span>
              </template>
              <input
                type="file"
                ref="fileInputCpf"
                class="file-input"
                accept="image/*,.pdf"
                @change="handleFileChange($event, 'cpf')"
              />
            </div>
          </transition>
        </div>

        <!-- Card RG ou CNH -->
        <div class="document-card" :class="{ verified: userData?.document_verified_at }">
          <div class="card-main">
            <div class="card-info">
              <i class="fas fa-address-card card-icon"></i>
              <div class="card-content">
                <h4 class="text-base md:text-lg font-medium">RG ou CNH</h4>
                <p class="text-sm text-gray-400">Documento com foto</p>
              </div>
            </div>
            <div class="card-action">
              <template v-if="userData?.document_verified_at">
                <span class="badge verified">
                  <i class="fas fa-check"></i> Verificado
                </span>
              </template>
              <template v-else>
                <div class="status-container">
                  <span 
                    v-if="getDocumentStatus('document')" 
                    :class="['badge', getStatusBadgeClass(getDocumentStatus('document'))]"
                  >
                    <i class="fas" :class="getStatusIcon(getDocumentStatus('document'))"></i>
                    {{ getStatusText(getDocumentStatus('document')) }}
                  </span>
                  <button
                    v-if="getDocumentStatus('document') === 'rejected'"
                    class="btn-view-reason text-sm"
                    @click="toggleRejectionReason('document')"
                  >
                    <span>Visualizar motivo</span>
                    <i class="fas" :class="showRejectionReason.document ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                  </button>
                  <button
                    v-else-if="activeUploadType !== 'document' && !getDocumentStatus('document')"
                    class="btn btn-outline text-sm"
                    @click="openUploadArea('document')"
                    :disabled="isUploading"
                  >
                    Verificar
                  </button>
                </div>

                <!-- Área de rejeição -->
                <transition name="expand">
                  <div v-if="getDocumentStatus('document') === 'rejected' && showRejectionReason.document" 
                       class="rejection-container">
                    <p class="rejection-reason text-sm">{{ getDocumentRejectionReason('document') }}</p>
                    <button
                      class="btn btn-resubmit text-sm"
                      @click="openUploadArea('document')"
                      :disabled="isUploading"
                    >
                      <i class="fas fa-redo"></i>
                      <span>Reenviar documento</span>
                    </button>
                  </div>
                </transition>
              </template>
            </div>
          </div>

          <!-- Área de Upload -->
          <transition name="slide-down">
            <div
              v-if="activeUploadType === 'document'"
              class="dropzone-expanded"
              @click="triggerFileSelect('document')"
            >
              <template v-if="isUploading">
                <span class="spinner"></span>
                <span class="drop-text text-sm">Enviando documento...</span>
              </template>
              <template v-else>
                <i class="fas fa-cloud-upload-alt drop-icon"></i>
                <span class="drop-text text-sm">Clique para enviar o documento</span>
              </template>
              <input
                type="file"
                ref="fileInputDocument"
                class="file-input"
                accept="image/*,.pdf"
                @change="handleFileChange($event, 'document')"
              />
            </div>
          </transition>
        </div>

        <!-- Card Selfie -->
        <div class="document-card" :class="{ verified: userData?.selfie_verified_at }">
          <div class="card-main">
            <div class="card-info">
              <i class="fas fa-user-check card-icon"></i>
              <div class="card-content">
                <h4 class="text-base md:text-lg font-medium">Selfie</h4>
                <p class="text-sm text-gray-400">Verificação por selfie</p>
              </div>
            </div>
            <div class="card-action">
              <template v-if="userData?.selfie_verified_at">
                <span class="badge verified">
                  <i class="fas fa-check"></i> Verificado
                </span>
              </template>
              <template v-else>
                <div class="status-container">
                  <span 
                    v-if="getDocumentStatus('selfie')" 
                    :class="['badge', getStatusBadgeClass(getDocumentStatus('selfie'))]"
                  >
                    <i class="fas" :class="getStatusIcon(getDocumentStatus('selfie'))"></i>
                    {{ getStatusText(getDocumentStatus('selfie')) }}
                  </span>
                  <button
                    v-if="getDocumentStatus('selfie') === 'rejected'"
                    class="btn-view-reason text-sm"
                    @click="toggleRejectionReason('selfie')"
                  >
                    <span>Visualizar motivo</span>
                    <i class="fas" :class="showRejectionReason.selfie ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                  </button>
                  <button
                    v-else-if="activeUploadType !== 'selfie' && !getDocumentStatus('selfie')"
                    class="btn btn-outline text-sm"
                    @click="openUploadArea('selfie')"
                    :disabled="isUploading"
                  >
                    Verificar
                  </button>
                </div>

                <!-- Área de rejeição -->
                <transition name="expand">
                  <div v-if="getDocumentStatus('selfie') === 'rejected' && showRejectionReason.selfie" 
                       class="rejection-container">
                    <p class="rejection-reason text-sm">{{ getDocumentRejectionReason('selfie') }}</p>
                    <button
                      class="btn btn-resubmit text-sm"
                      @click="openUploadArea('selfie')"
                      :disabled="isUploading"
                    >
                      <i class="fas fa-redo"></i>
                      <span>Reenviar documento</span>
                    </button>
                  </div>
                </transition>
              </template>
            </div>
          </div>

          <!-- Área de Upload -->
          <transition name="slide-down">
            <div
              v-if="activeUploadType === 'selfie'"
              class="dropzone-expanded"
              @click="triggerFileSelect('selfie')"
            >
              <template v-if="isUploading">
                <span class="spinner"></span>
                <span class="drop-text text-sm">Enviando documento...</span>
              </template>
              <template v-else>
                <i class="fas fa-cloud-upload-alt drop-icon"></i>
                <span class="drop-text text-sm">Clique para enviar o documento</span>
              </template>
              <input
                type="file"
                ref="fileInputSelfie"
                class="file-input"
                accept="image/*"
                @change="handleFileChange($event, 'selfie')"
              />
            </div>
          </transition>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useNotification } from '@/Composables/useNotification'
import HttpApi from '@/Services/HttpApi.js'
import ProfileHeader from './ProfileHeader.vue'

const props = defineProps({
  userData: { type: Object, required: true }
})

const emit = defineEmits(['update'])
const { showNotification, notification } = useNotification()

// Lógica de envio do documento
const activeUploadType = ref('')
const docStatus = ref({
  cpf: null,
  document: null,
  selfie: null
})

const openUploadArea = (type) => {
  activeUploadType.value = type
}
const fileInputCpf = ref(null)
const fileInputDocument = ref(null)
const fileInputSelfie = ref(null)
const triggerFileSelect = (type) => {
  if (type === 'cpf') {
    fileInputCpf.value.click()
  } else if (type === 'document') {
    fileInputDocument.value.click()
  } else if (type === 'selfie') {
    fileInputSelfie.value.click()
  }
}

// Estado para documentos
const documents = ref([])
const isUploading = ref(false)

// Função para carregar documentos
const loadDocuments = async () => {
  try {
    const { data } = await HttpApi.get('/profile/documents')
    if (data.status) {
      documents.value = data.documents
    }
  } catch (error) {
    showNotification(
      error.response?.data?.message || 'Erro ao carregar documentos',
      'error'
    )
  }
}

// Função para enviar documento
const handleFileChange = async (event, type) => {
  const file = event.target.files[0]
  if (!file) return

  try {
    isUploading.value = true
    const formData = new FormData()
    formData.append('document', file)
    formData.append('document_type', type)

    const { data } = await HttpApi.post('/profile/documents', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })

    if (data.status) {
      showNotification('Documento enviado com sucesso', 'success')
      activeUploadType.value = ''
      await loadDocuments()
      emit('update')
    }
  } catch (error) {
    showNotification(
      error.response?.data?.message || 'Erro ao enviar documento',
      'error'
    )
  } finally {
    isUploading.value = false
  }
}

// Função para obter status do documento
const getDocumentStatus = (type) => {
  const document = documents.value.find(doc => doc.document_type === type)
  return document?.status || docStatus.value[type] || null
}

// Função para obter URL do documento
const getDocumentUrl = (type) => {
  const document = documents.value.find(doc => doc.document_type === type)
  return document?.file_url || null
}

// Funções helper para status atualizadas
function getStatusBadgeClass(status) {
  if (!status) return ''
  switch (status) {
    case 'pending': return 'badge-pending'
    case 'approved': return 'badge-accepted'
    case 'rejected': return 'badge-rejected'
    default: return ''
  }
}

function getStatusIcon(status) {
  if (!status) return ''
  switch (status) {
    case 'pending': return 'fa-clock'
    case 'approved': return 'fa-check'
    case 'rejected': return 'fa-times'
    default: return ''
  }
}

function getStatusText(status) {
  if (!status) return ''
  switch (status) {
    case 'pending': return 'Pendente'
    case 'approved': return 'Aprovado'
    case 'rejected': return 'Recusado'
    default: return ''
  }
}

// Função para obter motivo da rejeição
const getDocumentRejectionReason = (type) => {
  const document = documents.value.find(doc => doc.document_type === type)
  return document?.rejection_reason || 'Documento rejeitado. Por favor, envie novamente.'
}

// Estado para controlar a visibilidade do motivo da rejeição
const showRejectionReason = ref({
  cpf: false,
  document: false,
  selfie: false
})

// Função para alternar a visibilidade do motivo da rejeição
const toggleRejectionReason = (type) => {
  showRejectionReason.value[type] = !showRejectionReason.value[type]
}

const handleProfileUpdate = (updatedUser) => {
  emit('update', updatedUser)
}

// Carregar documentos ao montar o componente
onMounted(() => {
  loadDocuments()
})
</script>

<style scoped>
/* Remover estilos do header e manter apenas os estilos relacionados aos documentos */
.verification-section {
  background: var(--card-bg);
  border-radius: 8px;
  padding: 20px;
}

/* Seção de Documentos */
.section-header h3 {
  color: #fff;
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0;
}
.section-subtitle {
  color: #666;
  margin: 4px 0 16px 0;
}
.documents-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Document Card */
.document-card {
  background: #2a2a2a;
  border-radius: 8px;
  padding: 16px;
  transition: all 0.3s ease;
  overflow: hidden;
}
.document-card.verified {
  border: 2px solid #00c6ff;
}
.document-card:hover {
  transform: translateY(-2px);
}
.card-main {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.card-info {
  display: flex;
  align-items: center;
  gap: 12px;
}
.card-icon {
  font-size: 2rem;
  color: #00c6ff;
}
.card-content h4 {
  margin: 0;
  color: #fff;
  font-size: 1.1rem;
}
.card-content p {
  margin: 4px 0 0;
  color: #ccc;
  font-size: 0.9rem;
}
.card-action {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

/* Botões */
.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  font-size: 0.9rem;
  cursor: pointer;
}
.btn.btn-outline {
  background: transparent;
  color: #00c6ff;
  border: 2px solid #00c6ff;
  transition: background 0.3s, color 0.3s;
}
.btn.btn-outline:hover {
  background: #00c6ff;
  color: #fff;
}

/* Dropzone expandida */
.dropzone-expanded {
  margin-top: 16px;
  padding: 16px;
  border: 2px dashed #00c6ff;
  border-radius: 6px;
  text-align: center;
  color: #00c6ff;
  background: rgba(0, 198, 255, 0.1);
  cursor: pointer;
  transition: background 0.3s, border-color 0.3s;
}
.dropzone-expanded:hover {
  background: rgba(0, 198, 255, 0.2);
  border-color: #0099cc;
}
.dropzone-expanded .drop-icon {
  font-size: 1rem; /* mesmo tamanho que o texto */
  margin-right: 8px;
  vertical-align: middle;
}
.dropzone-expanded .drop-text {
  font-size: 1rem;
  vertical-align: middle;
}
.file-input {
  display: none;
}

/* Transição para dropzone expandida */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}
.slide-down-enter-from,
.slide-down-leave-to {
  opacity: 0;
  transform: translateY(-10px);
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

.section-title-skeleton {
  width: 180px;
  height: 24px;
  margin-bottom: 8px;
}

.section-subtitle-skeleton {
  width: 300px;
  height: 16px;
}

.document-card-skeleton {
  background: #2a2a2a;
  padding: 16px;
  border-radius: 8px;
  margin-bottom: 16px;
}

.card-content-skeleton {
  display: flex;
  align-items: center;
  gap: 16px;
}

.icon-skeleton {
  width: 40px;
  height: 40px;
  border-radius: 4px;
}

.text-group {
  flex: 1;
}

.text-skeleton {
  height: 16px;
  width: 70%;
  margin-bottom: 8px;
}

.text-skeleton-short {
  height: 14px;
  width: 40%;
}

/* Responsividade para o skeleton loader */
@media (max-width: 768px) {
  .section-subtitle-skeleton {
    width: 200px;
  }
  
  .name-skeleton {
    width: 120px;
  }
  
  .document-card-skeleton {
    padding: 12px;
  }
}

/* Atualizar estilos dos badges */
.badge {
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 0.9rem;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
}

.badge-pending {
  background: #ff9800;
  color: #fff;
}

.badge-accepted {
  background: #4caf50;
  color: #fff;
}

.badge-rejected {
  background: rgba(244, 67, 54, 0.15);
  color: #f44336;
  border: 1px solid #f44336;
}

.badge.verified {
  background: #4caf50;
  color: #fff;
}

/* Desabilitar botão durante upload */
.btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Spinner durante upload */
.spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 2px solid rgba(0, 198, 255, 0.3);
  border-radius: 50%;
  border-top-color: #00c6ff;
  animation: spin 1s linear infinite;
  margin-right: 8px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.status-container {
  display: flex;
  align-items: center;
  gap: 8px;
}

.btn-view-reason {
  background: none;
  border: none;
  color: #f44336;
  font-size: 0.9rem;
  padding: 4px 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: opacity 0.3s;
}

.btn-view-reason:hover {
  opacity: 0.8;
}

.btn-view-reason i {
  font-size: 0.8rem;
  transition: transform 0.3s;
}

.rejection-container {
  background: rgba(244, 67, 54, 0.05);
  border-radius: 4px;
  padding: 12px;
  margin-top: 8px;
  border: 1px solid rgba(244, 67, 54, 0.2);
}

.rejection-reason {
  color: #f44336;
  font-size: 0.9rem;
  margin: 0 0 12px 0;
  line-height: 1.4;
}

.btn-resubmit {
  width: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: transparent;
  border: 1px solid #f44336;
  color: #f44336;
  padding: 8px 16px;
  font-size: 0.9rem;
  transition: all 0.3s ease;
  border-radius: 4px;
}

.btn-resubmit:hover {
  background: #f44336;
  color: #fff;
}

/* Animação de expansão mais suave */
.expand-enter-active,
.expand-leave-active {
  transition: all 0.3s ease;
  max-height: 200px;
  opacity: 1;
  margin-top: 8px;
  overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
  max-height: 0;
  opacity: 0;
  margin-top: 0;
  padding-top: 0;
  padding-bottom: 0;
}

/* Adicionar estilos da notificação */
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

.skeleton-loader {
  @apply space-y-6;
}

.header-skeleton {
  @apply space-y-2 mb-8;
}

.title-skeleton {
  @apply h-8 w-48 rounded-lg;
}

.subtitle-skeleton {
  @apply h-4 w-72 rounded-lg;
}

.documents-skeleton {
  @apply space-y-4;
}

.document-card-skeleton {
  @apply bg-gray-800 p-6 rounded-xl;
}

.card-header-skeleton {
  @apply flex items-start gap-4;
}

.icon-skeleton {
  @apply w-10 h-10 rounded-lg flex-shrink-0;
}

.content-skeleton {
  @apply flex-grow space-y-2;
}

.title-line {
  @apply h-6 w-32 rounded-lg;
}

.subtitle-line {
  @apply h-4 w-48 rounded-lg;
}

.skeleton {
  @apply bg-gray-700 animate-pulse;
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

.verification-section {
  @apply bg-gray-900 rounded-xl p-4 md:p-6 mt-6;
}

.section-header {
  @apply mb-6;
}

.documents-list {
  @apply space-y-4 md:space-y-6;
}

.document-card {
  @apply bg-gray-800 rounded-lg overflow-hidden transition-all duration-300;
}

.card-main {
  @apply p-4 md:p-6;
}

.card-info {
  @apply flex items-start gap-4;
}

.card-icon {
  @apply text-xl md:text-2xl text-primary;
}

.card-action {
  @apply mt-4 md:mt-0;
}

.badge {
  @apply inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium;
}

.badge.verified {
  @apply bg-green-500/20 text-green-400;
}

.btn {
  @apply px-4 py-2 rounded-lg transition-all duration-300 text-sm font-medium;
}

.btn-outline {
  @apply border border-primary text-primary hover:bg-primary hover:text-white;
}

.btn-resubmit {
  @apply bg-primary/10 text-primary hover:bg-primary/20;
}

.dropzone-expanded {
  @apply p-6 flex flex-col items-center justify-center gap-4 cursor-pointer
         border-t border-gray-700 bg-gray-800/50 transition-all duration-300;
}

.spinner {
  @apply w-6 h-6 border-2 border-primary border-t-transparent rounded-full animate-spin;
}

/* Responsividade */
@media (max-width: 768px) {
  .document-card {
    @apply p-3;
  }

  .card-main {
    @apply flex-col;
  }

  .card-action {
    @apply flex-col items-start;
  }

  .status-container {
    @apply w-full flex flex-col gap-2;
  }

  .btn {
    @apply w-full justify-center;
  }
}
</style>