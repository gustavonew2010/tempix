<template>
  <div class="flex items-center">
    <!-- Botão de Login -->
    <button 
      @click="$emit('login')"
      class="text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors"
    >
      {{ $t('Login') }}
    </button>

    <!-- Botão de Registro Animado -->
    <button 
      @click="handleRegister"
      class="register-button-animated ml-3 px-4 py-2 rounded-md font-medium text-white relative overflow-hidden"
    >
      {{ $t('Registre-se') }}
      <div class="button-glow"></div>
    </button>
  </div>
</template>

<style scoped>
/* Estilo base do botão de registro */
.register-button-animated {
  background: linear-gradient(45deg, #00A2D4, #0077FF);
  transition: all 0.3s ease;
  animation: pulse 2s infinite;
  border: none;
  transform-style: preserve-3d;
}

/* Efeito de pulsar */
@keyframes pulse {
  0% {
    transform: scale(1);
    box-shadow: 0 0 0 0 rgba(0, 162, 212, 0.7);
  }
  
  70% {
    transform: scale(1.05);
    box-shadow: 0 0 0 10px rgba(0, 162, 212, 0);
  }
  
  100% {
    transform: scale(1);
    box-shadow: 0 0 0 0 rgba(0, 162, 212, 0);
  }
}

/* Efeito de brilho deslizante */
.button-glow {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(
    45deg,
    transparent,
    rgba(255, 255, 255, 0.1),
    transparent
  );
  transform: rotate(45deg);
  animation: glow 3s linear infinite;
}

@keyframes glow {
  0% {
    transform: rotate(45deg) translateX(-100%);
  }
  100% {
    transform: rotate(45deg) translateX(100%);
  }
}

/* Hover effect */
.register-button-animated:hover {
  transform: translateY(-2px);
  box-shadow: 0 7px 14px rgba(0, 162, 212, 0.3);
  background: linear-gradient(45deg, #0077FF, #00A2D4);
}

/* Active effect */
.register-button-animated:active {
  transform: translateY(1px);
  box-shadow: 0 5px 10px rgba(0, 162, 212, 0.2);
}

/* Efeito de texto brilhante */
.register-button-animated {
  text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
  letter-spacing: 0.5px;
  font-weight: 600;
}

/* Responsividade */
@media (max-width: 768px) {
  .register-button-animated {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }
}

/* Efeito de destaque em telas maiores */
@media (min-width: 1024px) {
  .register-button-animated::after {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #00A2D4, #0077FF);
    z-index: -1;
    filter: blur(8px);
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .register-button-animated:hover::after {
    opacity: 1;
  }
}
</style>

<script>
export default {
  name: 'AuthButtons',
  emits: ['login', 'register'],
  methods: {
    handleRegister() {
      // Emite o evento register com um parâmetro indicando para abrir na aba de registro
      this.$emit('register', { openTab: 'register' })
    }
  }
}
</script>