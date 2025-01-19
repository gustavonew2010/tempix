<template>
  <div class="loading-screen">
    <div class="loading-content">
      <div class="loading-wrapper">
        <div class="loading-text">
          Carregando
        </div>
        <div class="loading-dots">
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background-color: var(--body-color);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999;
}

.loading-content {
  text-align: center;
}

.loading-wrapper {
  display: flex;
  align-items: center;
  gap: 8px;
}

.loading-text {
  color: var(--title-color);
  font-size: 1.2rem;
}

.loading-dots {
  display: flex;
  align-items: center;
  gap: 4px;
  margin-left: 4px;
}

.dot {
  width: 8px;
  height: 8px;
  background: var(--ci-primary-color);
  border-radius: 50%;
  opacity: 0;
  animation: bounce 1.4s linear infinite;
}

.dot:nth-child(2) {
  animation-delay: 0.4s;
}

.dot:nth-child(3) {
  animation-delay: 0.8s;
}

@keyframes bounce {
  0%, 50%, 100% {
    transform: translateY(0);
    opacity: 0.2;
  }
  15% {
    transform: translateY(-4px);
    opacity: 1;
  }
  30% {
    transform: translateY(0);
    opacity: 0.2;
  }
}
</style> 