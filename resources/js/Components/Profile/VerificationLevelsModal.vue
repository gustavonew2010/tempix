<template>
  <Modal :show="show" @close="$emit('close')" max-width="md">
    <div class="vlm-container">
      <!-- Cabeçalho -->
      <div class="vlm-header">
        <h2 class="vlm-title">Níveis de Verificação</h2>
        <p class="vlm-subtitle">
          Alcance novos patamares e desbloqueie benefícios exclusivos
        </p>
      </div>
      
      <!-- Progress Steps - Desktop -->
      <div class="vlm-progress-steps hidden md:flex">
        <div 
          v-for="(level, index) in allLevels" 
          :key="level.id"
          class="vlm-progress-step"
          :class="{ 
            'completed': verification?.points >= level.points_required,
            'current': currentSlide === index
          }"
          @click="currentSlide = index"
        >
          <div class="step-connector" v-if="index > 0"></div>
          <div 
            class="vlm-step-indicator"
            :style="{
              backgroundColor: verification?.points >= level.points_required ? level.color_hex : 'transparent',
              borderColor: verification?.points >= level.points_required ? level.color_hex : '#555'
            }"
          >
            <i class="fas" :class="getStepIcon(level)"></i>
          </div>
          <span class="vlm-step-label">{{ level.name }}</span>
        </div>
      </div>

      <!-- Mobile Progress -->
      <div class="vlm-mobile-progress md:hidden">
        <div class="vlm-current-level-info">
          <div class="vlm-level-badge" :style="{ backgroundColor: currentLevel?.color_hex }">
            {{ currentLevel?.name }}
          </div>
          <div class="vlm-points-counter">
            {{ verification?.points }} / {{ currentLevel?.points_required }} pontos
          </div>
        </div>
      </div>

      <!-- Cards Container -->
      <div class="vlm-cards-container">
        <div 
          class="vlm-cards-wrapper"
          :style="{ transform: `translateX(-${currentSlide * 100}%)` }"
        >
          <div 
            v-for="level in allLevels" 
            :key="level.id"
            class="vlm-level-card"
          >
            <!-- Card Header -->
            <div class="vlm-card-header" :style="{ backgroundColor: level.color_hex + '15' }">
              <h3 class="vlm-level-title">{{ level.name }}</h3>
              <div class="vlm-points-required" :style="{ backgroundColor: level.color_hex }">
                {{ level.points_required }} pontos
              </div>
            </div>

            <!-- Card Content -->
            <div class="vlm-card-content">
              <!-- Requirements -->
              <div class="vlm-section">
                <h4 class="vlm-section-title">
                  <i class="fas fa-list-check mr-2"></i>
                  Requisitos
                </h4>
                <div class="vlm-requirements-list">
                  <div
                    v-if="level.name === 'Bronze'"
                    class="vlm-requirement-item completed"
                  >
                    <i class="fas fa-check-circle"></i>
                    <span>Criar conta</span>
                  </div>
                  <div 
                    v-else
                    v-for="(required, key) in level.requirements" 
                    :key="key"
                    class="vlm-requirement-item"
                    :class="{ 'completed': verification?.completed_steps?.includes(key) }"
                  >
                    <i class="fas" :class="verification?.completed_steps?.includes(key) ? 'fa-check-circle' : 'fa-times-circle'"></i>
                    <span>{{ getRequirementLabel(key) }}</span>
                  </div>
                </div>
              </div>

              <!-- Benefits -->
              <div class="vlm-section">
                <h4 class="vlm-section-title">
                  <i class="fas fa-gift mr-2"></i>
                  Benefícios
                </h4>
                <div class="vlm-benefits-list">
                  <div class="vlm-benefit-item">
                    <span>Limite de saque</span>
                    <span class="vlm-benefit-value">{{ formatCurrency(level.withdrawal_limit) }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Mobile Navigation -->
      <div class="vlm-mobile-nav md:hidden">
        <button 
          class="vlm-nav-btn"
          :disabled="currentSlide === 0"
          @click="currentSlide--"
        >
          <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="vlm-nav-dots">
          <span 
            v-for="(_, index) in allLevels"
            :key="index"
            class="vlm-dot"
            :class="{ active: currentSlide === index }"
            @click="currentSlide = index"
          ></span>
        </div>
        
        <button 
          class="vlm-nav-btn"
          :disabled="currentSlide === allLevels.length - 1"
          @click="currentSlide++"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue'
import { ref, onMounted } from 'vue'
import { getRequirementLabel, formatCurrency } from '@/Utils/verification'

const props = defineProps({
  show: Boolean,
  verification: Object,
  currentLevel: Object,
  allLevels: Array
})

defineEmits(['close'])

const currentSlide = ref(0)

onMounted(() => {
  // Define o slide inicial com base no nível atual:
  if (props.currentLevel) {
    const currentIndex = props.allLevels?.findIndex(level => level.id === props.currentLevel.id) ?? 0
    currentSlide.value = currentIndex
  }
})

const getStepIcon = (level) => {
  if (props.verification?.points >= level.points_required) return 'fa-check'
  if (props.currentLevel?.id === level.id) return 'fa-star'
  return 'fa-lock'
}

</script>

<style scoped>
.vlm-container {
  @apply p-4 md:p-6;
}

/* Header */
.vlm-header {
  @apply text-center mb-6 md:mb-8;
}

.vlm-title {
  @apply text-xl md:text-2xl font-bold mb-2;
  background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.vlm-subtitle {
  @apply text-sm text-gray-400;
}

/* Progress Steps - Desktop */
.vlm-progress-steps {
  @apply items-center justify-between mb-8 px-4;
}

.vlm-progress-step {
  @apply flex items-center cursor-pointer;
}

.vlm-step-indicator {
  @apply w-8 h-8 rounded-full border-2 flex items-center justify-center text-white;
}

.vlm-step-label {
  @apply ml-2 text-sm font-medium;
}

/* Mobile Progress */
.vlm-mobile-progress {
  @apply mb-6;
}

.vlm-current-level-info {
  @apply flex justify-between items-center mb-4;
}

.vlm-level-badge {
  @apply px-3 py-1 rounded-full text-white text-sm font-medium;
}

.vlm-points-counter {
  @apply text-sm text-gray-400;
}

/* Cards */
.vlm-cards-container {
  @apply relative overflow-hidden;
}

.vlm-cards-wrapper {
  @apply flex transition-transform duration-300 ease-in-out;
}

.vlm-level-card {
  @apply w-full flex-shrink-0 bg-gray-800 rounded-xl overflow-hidden;
}

.vlm-card-header {
  @apply p-4 flex justify-between items-center;
}

.vlm-level-title {
  @apply text-lg font-bold;
}

.vlm-points-required {
  @apply px-3 py-1 rounded-full text-white text-sm;
}

.vlm-card-content {
  @apply p-4 space-y-6;
}

.vlm-section-title {
  @apply text-base font-medium mb-4 flex items-center;
}

.vlm-requirements-list, .vlm-benefits-list {
  @apply space-y-3;
}

.vlm-requirement-item {
  @apply flex items-center gap-3 text-sm text-gray-400;
}

.vlm-requirement-item.completed {
  @apply text-white;
}

.vlm-requirement-item i {
  @apply text-base;
}

.vlm-benefit-item {
  @apply flex justify-between items-center text-sm;
}

.vlm-benefit-value {
  @apply font-medium text-white;
}

/* Mobile Navigation */
.vlm-mobile-nav {
  @apply flex items-center justify-between mt-6 px-4;
}

.vlm-nav-btn {
  @apply w-10 h-10 flex items-center justify-center rounded-full bg-gray-700 text-white;
  @apply disabled:opacity-50 disabled:cursor-not-allowed;
}

.vlm-nav-dots {
  @apply flex gap-2;
}

.vlm-dot {
  @apply w-2 h-2 rounded-full bg-gray-600 cursor-pointer transition-all;
}

.vlm-dot.active {
  @apply w-3 h-3 bg-blue-500;
}

@media (max-width: 768px) {
  .vlm-level-card {
    @apply mx-0;
  }
  
  .vlm-card-header {
    @apply p-3;
  }
  
  .vlm-card-content {
    @apply p-3;
  }
}
</style> 