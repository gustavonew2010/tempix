<template>
  <Transition name="modal">
    <div v-if="show" class="modal-backdrop">
      <div class="modal-container" :style="{ maxWidth }">
        <div class="modal-content">
          <button 
            class="modal-close" 
            @click="$emit('close')"
          >
            <i class="fas fa-times"></i>
          </button>
          
          <slot></slot>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
defineProps({
  show: Boolean,
  maxWidth: {
    type: String,
    default: '2xl'
  }
})

defineEmits(['close'])
</script>

<style scoped>
.modal-backdrop {
  @apply fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4;
}

.modal-container {
  @apply w-full bg-[#1A1D24] rounded-xl shadow-xl relative;
  max-height: 90vh;
  overflow-y: auto;
}

.modal-content {
  @apply relative;
}

.modal-close {
  @apply absolute right-4 top-4 text-gray-400 hover:text-white transition-colors p-2;
}

/* Animações */
.modal-enter-active,
.modal-leave-active {
  transition: all 0.3s ease;
}

.modal-enter-from {
  opacity: 0;
  transform: scale(0.95);
}

.modal-leave-to {
  opacity: 0;
  transform: scale(0.95);
}

/* Scrollbar personalizada */
.modal-container::-webkit-scrollbar {
  width: 8px;
}

.modal-container::-webkit-scrollbar-track {
  @apply bg-black/20;
}

.modal-container::-webkit-scrollbar-thumb {
  @apply bg-white/10 rounded-full hover:bg-white/20;
}
</style> 