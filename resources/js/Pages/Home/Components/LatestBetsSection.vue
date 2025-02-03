<template>
  <div class="latest-bets-container">
    <div class="latest-bets-wrapper">
      <div class="latest-bets-header">
        <div class="header-content">
          <i class="fa-solid fa-chart-line-up text-primary-500 mr-2"></i>
          <h2>Últimas Apostas</h2>
        </div>
      </div>
      <div class="table-scroll-container">
        <div class="latest-bets-table">
          <div class="table-header">
            <div class="header-cell">Horário</div>
            <div class="header-cell">Jogo</div>
            <div class="header-cell">Usuário</div> 
            <div class="header-cell">Valor da Aposta</div>
            <div class="header-cell">Multiplicador</div>
            <div class="header-cell">Premiação</div>
          </div>
          <div class="table-body">
            <div v-for="bet in latestBets" 
                 :key="bet.id" 
                 class="table-row"
                 :class="{ 'win': bet.multiplier > 1, 'loss': bet.multiplier < 1 }"> 
              <div class="cell time-cell">
                <i class="fa-regular fa-clock mr-2 opacity-50"></i>
                {{ bet.time }}
              </div>
              <div class="cell game-cell">
                <i class="fa-solid fa-gamepad-modern mr-2 opacity-50"></i>
                {{ bet.game }}
              </div>
              <div class="cell user-cell">
                <i class="fa-regular fa-user mr-2 opacity-50"></i>
                {{ bet.user }}
              </div>
              <div class="cell amount-cell">
                <i class="fa-solid fa-money-bill-wave mr-2 opacity-50"></i>
                R$ {{ bet.amount.toFixed(2) }}
              </div>
              <div class="cell multiplier-cell">
                <i class="fa-solid fa-chart-line mr-2 opacity-50"></i>
                x{{ bet.multiplier.toFixed(3) }}
              </div>
              <div class="cell prize-cell">
                <i class="fa-solid fa-coins mr-2 opacity-50"></i>
                R$ {{ bet.prize.toFixed(2) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const latestBets = ref([]);
const updateInterval = ref(null);

// Lista de jogos populares com suas características
const games = [
  { name: 'Fortune Tiger', minBet: 1, maxBet: 100, maxMultiplier: 88 },
  { name: 'Spaceman', minBet: 1, maxBet: 200, maxMultiplier: 5000 },
  { name: 'Sweet Bonanza', minBet: 0.20, maxBet: 100, maxMultiplier: 100 },
  { name: 'Gates of Olympus', minBet: 0.20, maxBet: 100, maxMultiplier: 500 },
  { name: 'Mines', minBet: 1, maxBet: 150, maxMultiplier: 1000 },
  { name: 'Aviator', minBet: 1, maxBet: 100, maxMultiplier: 1000 },
  { name: 'Fortune Mouse', minBet: 1, maxBet: 80, maxMultiplier: 88 },
  { name: 'Fortune Ox', minBet: 1, maxBet: 80, maxMultiplier: 88 },
  { name: 'Fruit Party', minBet: 0.20, maxBet: 100, maxMultiplier: 100 },
  { name: 'Wild West Gold', minBet: 0.20, maxBet: 100, maxMultiplier: 500 },
  { name: 'Sweet Bonanza Xmas', minBet: 0.20, maxBet: 100, maxMultiplier: 100 },
  { name: 'Big Bass', minBet: 0.20, maxBet: 100, maxMultiplier: 200 },
  { name: 'Dog House', minBet: 0.20, maxBet: 100, maxMultiplier: 200 },
  { name: 'Rabbit Garden', minBet: 1, maxBet: 80, maxMultiplier: 88 },
  { name: 'Dragon Tiger', minBet: 1, maxBet: 80, maxMultiplier: 88 },
  { name: 'Plinko', minBet: 1, maxBet: 100, maxMultiplier: 1000 },
  { name: 'Dice', minBet: 1, maxBet: 100, maxMultiplier: 990 },
  { name: 'Crash', minBet: 1, maxBet: 100, maxMultiplier: 1000 }
];

// Gera um nome de usuário realista e anônimo
const generateUsername = () => {
  const firstNames = [
    'João', 'Maria', 'Pedro', 'Ana', 'Lucas', 'Julia', 'Carlos', 'Bruno', 'Paulo',
    'Gabriel', 'Rafael', 'Daniel', 'Marcos', 'Felipe', 'Thiago', 'Diego', 'Eduardo',
    'Victor', 'Rodrigo', 'Gustavo', 'Ricardo', 'Fernando', 'Marcelo', 'Alexandre',
    'Luis', 'André', 'Guilherme', 'Leonardo', 'Matheus', 'Arthur', 'Henrique',
    'Miguel', 'Davi', 'Samuel', 'Bernardo', 'Caio', 'Igor', 'Renato', 'Vitor'
  ];
  
  const firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
  
  return firstName.substring(0, 3).toLowerCase() + '***';
};

// Gera um horário recente (últimos 5 minutos)
const generateRecentTime = () => {
  const now = new Date();
  const minutesAgo = Math.floor(Math.random() * 5);
  const secondsAgo = Math.floor(Math.random() * 60);
  now.setMinutes(now.getMinutes() - minutesAgo);
  now.setSeconds(now.getSeconds() - secondsAgo);
  return now.toLocaleTimeString('pt-BR', { 
    hour: '2-digit', 
    minute: '2-digit'
  });
};

// Gera uma aposta realista baseada no jogo
const generateBet = () => {
  const game = games[Math.floor(Math.random() * games.length)];
  const isWin = Math.random() < 0.52; // 52% de chance de vitória
  
  // Gera valor da aposta baseado nos limites do jogo
  const amount = Number((Math.random() * (game.maxBet - game.minBet) + game.minBet).toFixed(2));
  
  let multiplier;
  if (isWin) {
    // Vitórias mais comuns têm multiplicadores menores
    const winChance = Math.random();
    if (winChance < 0.7) { // 70% das vitórias são pequenas
      multiplier = Number((Math.random() * 2 + 1.1).toFixed(2)); // 1.1x - 3.1x
    } else if (winChance < 0.95) { // 25% são médias
      multiplier = Number((Math.random() * 5 + 3.1).toFixed(2)); // 3.1x - 8.1x
    } else { // 5% são grandes
      multiplier = Number((Math.random() * (game.maxMultiplier - 8.1) + 8.1).toFixed(2));
    }
  } else {
    // Perdas geralmente são totais ou quase
    multiplier = Number((Math.random() * 0.2).toFixed(2)); // 0x - 0.2x
  }

  const prize = Number((amount * multiplier).toFixed(2));

  return {
    id: Math.random(),
    time: generateRecentTime(),
    game: game.name,
    user: generateUsername(),
    amount,
    multiplier,
    prize,
    isWin
  };
};

// Gera o conjunto inicial de apostas
const generateInitialBets = () => {
  const bets = [];
  for (let i = 0; i < 6; i++) {
    bets.push(generateBet());
  }
  return bets.sort((a, b) => new Date('1970/01/01 ' + b.time) - new Date('1970/01/01 ' + a.time));
};

// Atualiza as apostas periodicamente
const updateBets = () => {
  // Intervalo aleatório entre 3-7 segundos
  const interval = Math.floor(Math.random() * 4000) + 3000;
  
  updateInterval.value = setTimeout(() => {
    // Gera nova aposta
    const newBet = generateBet();
    
    // Move todas as apostas uma posição para baixo
    latestBets.value = [
      newBet,
      ...latestBets.value.slice(0, 5) // Mantém apenas as 5 primeiras apostas anteriores
    ];
    
    // Continua o ciclo
    updateBets();
  }, interval);
};

onMounted(() => {
  latestBets.value = generateInitialBets();
  updateBets();
});

onUnmounted(() => {
  if (updateInterval.value) {
    clearTimeout(updateInterval.value);
  }
});
</script>

<style scoped>
.latest-bets-container {
  width: 100%;
  margin: 2rem auto;
  padding: 0 1rem;
  max-width: 1400px;
  position: relative;
  overflow: hidden;
}

.latest-bets-wrapper {
  background: linear-gradient(180deg, 
    rgba(37, 99, 235, 0.1) 0%,
    rgba(29, 78, 216, 0.05) 100%
  );
  border-radius: 16px 16px 0 0;
  overflow: hidden;
  box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
  position: relative;
}

.latest-bets-header {
  padding: 1.25rem 1.5rem;
  background: linear-gradient(90deg,
    rgba(37, 99, 235, 0.1) 0%,
    rgba(29, 78, 216, 0.15) 100%
  );
  border-bottom: 1px solid rgba(37, 99, 235, 0.2);
}

.header-content {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.header-content i {
  font-size: 1.25rem;
  color: #3b82f6;
  opacity: 0.9;
}

.header-content h2 {
  font-size: 1.25rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.95);
  letter-spacing: 0.01em;
  margin: 0;
}

.table-scroll-container {
  overflow-x: auto;
  padding: 0.5rem 0.5rem 0;
  position: relative;
}

.table-scroll-container::after {
  content: '';
  position: absolute;
  left: -1px;
  right: -1px;
  bottom: -2px;
  height: 200px;
  z-index: 1;
  pointer-events: none;
  background: linear-gradient(
    to bottom,
    transparent 0%,
    rgba(18, 18, 18, 0.95) 60%,
    rgb(18, 18, 18) 85%,
    rgb(18, 18, 18) 100%
  );
}

.latest-bets-table {
  width: 100%;
  min-width: 800px;
  position: relative;
  z-index: 0;
  padding-bottom: 100px;
}

.table-header {
  display: grid;
  grid-template-columns: 0.8fr 1fr 1fr 1fr 1fr 1fr;
  padding: 1rem 1.25rem;
  background: rgba(37, 99, 235, 0.05);
}

.header-cell {
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.875rem;
  font-weight: 500;
  letter-spacing: 0.02em;
}

.table-body {
  padding: 0.5rem 0;
  max-height: 380px;
  overflow: hidden;
  position: relative;
  transition: all 0.3s ease;
}

.table-row {
  display: grid;
  grid-template-columns: 0.8fr 1fr 1fr 1fr 1fr 1fr;
  padding: 0.875rem 1.25rem;
  color: rgba(255, 255, 255, 0.8);
  transition: all 0.3s ease;
  margin: 2px 0;
  position: relative;
}

.table-row:hover {
  background: linear-gradient(90deg,
    rgba(37, 99, 235, 0.05) 0%,
    rgba(29, 78, 216, 0.08) 100%
  );
  transform: translateX(2px);
}

.cell {
  display: flex;
  align-items: center;
  font-size: 0.875rem;
  gap: 0.5rem;
}

.cell i {
  opacity: 0.5;
  font-size: 0.875rem;
  width: 16px;
  text-align: center;
}

/* Células específicas */
.time-cell, .user-cell {
  color: rgba(255, 255, 255, 0.7);
}

.game-cell {
  font-weight: 500;
}

.amount-cell {
  color: rgba(255, 255, 255, 0.85);
}

/* Estados de vitória/derrota */
.win .multiplier-cell,
.win .prize-cell {
  color: #3b82f6;
  font-weight: 500;
  text-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
}

.loss .multiplier-cell,
.loss .prize-cell {
  color: #ef4444;
  font-weight: 500;
  text-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
}

/* Scrollbar personalizada */
.table-scroll-container::-webkit-scrollbar {
  display: none;
}

.table-scroll-container {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}

/* Animação para nova aposta */
.table-row:first-child {
  animation: newBetSlideIn 0.3s ease-out;
}

@keyframes newBetSlideIn {
  from {
    opacity: 0;
    transform: translateY(-100%);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Transição suave para as apostas existentes */
.table-body {
  transition: all 0.3s ease;
}

.table-row {
  transition: all 0.3s ease;
}

@media (max-width: 768px) {
  .latest-bets-container {
    margin: 1rem auto;
    padding: 0 0.75rem;
  }

  .latest-bets-header {
    padding: 1rem;
  }

  .header-content h2 {
    font-size: 1.125rem;
  }

  .table-header, 
  .table-row {
    padding: 0.75rem 1rem;
  }

  .cell {
    font-size: 0.813rem;
  }

  .cell i {
    font-size: 0.813rem;
  }
}
</style> 