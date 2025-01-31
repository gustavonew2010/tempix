<template>
  <div class="loading-screen">
    <div class="loading-content">
      <div class="loading-wrapper">
        <div class="loading-text">
          <span v-for="(letter, index) in 'Carregando'.split('')" 
                :key="index"
                :style="{ animationDelay: `${index * 0.1}s` }"
                class="letter">
            {{ letter }}
          </span>
        </div>
        <div class="loading-circle">
          <svg class="circle-svg" viewBox="0 0 100 100">
            <circle class="circle-bg" cx="50" cy="50" r="40"/>
            <circle class="circle-progress" cx="50" cy="50" r="40"/>
          </svg>
          <div class="pulse-ring"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    setTimeout(() => {
      this.$emit('loading-complete');
    }, 3500); // 3.5 segundos
  }
}
</script>

<style scoped>
.loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 99999;
  animation: fadeOut 0.3s ease-out 3.5s forwards;
}

.loading-content {
  position: relative;
  text-align: center;
}

.loading-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
}

.loading-text {
  display: flex;
  gap: 2px;
}

.letter {
  color: #2196F3;
  font-size: 1.5rem;
  font-weight: 600;
  opacity: 0;
  transform: translateY(10px);
  animation: letterFloat 3.5s ease-in-out forwards;
}

.loading-circle {
  position: relative;
  width: 80px;
  height: 80px;
}

.circle-svg {
  transform: rotate(-90deg);
  filter: drop-shadow(0 0 8px rgba(33, 150, 243, 0.3));
}

.circle-bg {
  fill: none;
  stroke: rgba(255, 255, 255, 0.1);
  stroke-width: 4;
}

.circle-progress {
  fill: none;
  stroke: #2196F3;
  stroke-width: 4;
  stroke-dasharray: 251.2;
  stroke-dashoffset: 251.2;
  stroke-linecap: round;
  animation: circleProgress 3.5s linear forwards;
}

.pulse-ring {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 70px;
  height: 70px;
  border: 2px solid #2196F3;
  border-radius: 50%;
  animation: pulseRing 3.5s cubic-bezier(0.215, 0.61, 0.355, 1) forwards;
}

@keyframes letterFloat {
  0% {
    opacity: 0;
    transform: translateY(10px);
  }
  20% {
    opacity: 1;
    transform: translateY(0);
  }
  80% {
    opacity: 1;
    transform: translateY(0);
  }
  100% {
    opacity: 0;
    transform: translateY(-10px);
  }
}

@keyframes circleProgress {
  0% {
    stroke-dashoffset: 251.2;
  }
  90% {
    stroke-dashoffset: 0;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes pulseRing {
  0% {
    transform: translate(-50%, -50%) scale(0.7);
    opacity: 0;
  }
  50% {
    opacity: 0.3;
  }
  90% {
    transform: translate(-50%, -50%) scale(1.3);
    opacity: 0.3;
  }
  100% {
    transform: translate(-50%, -50%) scale(1.3);
    opacity: 0;
  }
}

@keyframes fadeOut {
  to {
    opacity: 0;
    visibility: hidden;
  }
}

/* Partículas com duração ajustada */
.loading-content::before,
.loading-content::after {
  content: '';
  position: absolute;
  width: 10px;
  height: 10px;
  background: #2196F3;
  border-radius: 50%;
  filter: blur(2px);
  opacity: 0;
  animation: particleFloat 3.5s ease-in-out forwards;
}

.loading-content::before {
  top: -20px;
  left: -20px;
  animation-delay: 0.2s;
}

.loading-content::after {
  bottom: -20px;
  right: -20px;
  animation-delay: 0.4s;
}

@keyframes particleFloat {
  0% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  50% {
    transform: translate(20px, -20px) scale(1);
    opacity: 0.5;
  }
  90% {
    transform: translate(40px, -40px) scale(1);
    opacity: 0.5;
  }
  100% {
    transform: translate(40px, -40px) scale(0);
    opacity: 0;
  }
}
</style> 