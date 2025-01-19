<template>
    <div class="game-loader-container">
        <!-- Background com efeito de blur -->
        <div class="game-background-overlay"></div>

        <!-- Container principal -->
        <div class="game-content">
            <!-- Header com informações do jogo -->
            <div class="game-header">
                <div class="header-left">
                    <button @click="goBack" class="action-button back-button">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </button>
                </div>
                <div class="game-info">
                    <h1>{{ gameName }}</h1>
                    <div class="game-message-container">
                        <transition name="fade" mode="out-in">
                            <div :key="currentTip" class="game-message">{{ currentTip }}</div>
                        </transition>
                    </div>
                </div>
                <div class="header-right">
                    <button @click="toggleFullscreen" class="action-button fullscreen-button">
                        <i :class="isFullscreen ? 'fas fa-compress' : 'fas fa-expand'"></i>
                        {{ isFullscreen ? 'Sair da Tela Cheia' : 'Tela Cheia' }}
                    </button>
                </div>
            </div>

            <!-- Container principal do jogo -->
            <div class="game-main-content">
                <!-- Sidebar esquerda -->
                <div class="game-sidebar left-sidebar">
                    <div class="sidebar-section">
                        <h3>Estatísticas do Jogo</h3>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <i class="fas fa-users"></i>
                                <span class="stat-value">{{ onlinePlayers }}</span>
                                <span class="stat-label">Jogadores Online</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-trophy"></i>
                                <span class="stat-value">R$ {{ biggestWin }}</span>
                                <span class="stat-label">Maior Vitória</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container central do jogo -->
                <div class="game-container">
                    <!-- Loading animation -->
                    <div v-if="loading" class="loading-container">
                        <div class="loading-content">
                            <div class="spinner"></div>
                            <p>Carregando seu jogo...</p>
                            <div class="loading-tips">
                                <span>Dica: {{ currentTip }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Game iframe -->
                    <iframe
                        v-show="!loading"
                        :src="gameUrl"
                        class="game-frame"
                        @load="handleIframeLoad"
                        allowfullscreen
                    ></iframe>
                </div>

                <!-- Sidebar direita -->
                <div class="game-sidebar right-sidebar">
                    <div class="sidebar-section wins-section">
                        <h3>Últimas Jogadas</h3>
                        <div class="recent-wins">
                            <div v-for="win in recentWins" :key="win.id" class="win-item">
                                <img :src="win.userAvatar" :alt="win.username" class="user-avatar">
                                <span class="username">{{ win.username }}</span>
                                <span class="final-amount" :class="{ 'win': win.multiplier > 1, 'loss': win.multiplier < 1 }">
                                    R$ {{ win.finalAmount }}
                                </span>
                                <span class="win-time">{{ win.time }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import HttpApi from "@/Services/HttpApi.js";
import { useAuthStore } from "@/Stores/Auth.js";

export default {
    setup() {
        const loading = ref(true);
        const gameUrl = ref('');
        const gameName = ref('');
        const gameProvider = ref('');
        const gameCategory = ref('');
        const isFullscreen = ref(false);
        const route = useRoute();
        const router = useRouter();

        // Dados simulados
        const onlinePlayers = ref(Math.floor(Math.random() * 500) + 100);
        const biggestWin = ref((Math.random() * 50000 + 10000).toFixed(2));
        const currentTip = ref('Jogue com responsabilidade e estabeleça limites');
        const recentWins = ref([]);
        const relatedGames = ref([]);

        // Nomes para gerar usernames aleatórios
        const firstNames = ['João', 'Maria', 'Pedro', 'Ana', 'Lucas', 'Julia', 'Carlos', 'Paula'];
        const lastNames = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Ferreira', 'Costa'];

        // Função para gerar username mascarado
        const generateMaskedUsername = () => {
            const firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
            const lastName = lastNames[Math.floor(Math.random() * lastNames.length)];
            const maskedName = `${firstName.charAt(0)}***${lastName.charAt(0)}***`;
            return maskedName;
        };

        // Função para gerar valor de aposta com valor padrão
        const generateBetAmount = () => {
            return Number((Math.random() * 995 + 5).toFixed(2)); // Valores entre 5 e 1000
        };

        // Função para gerar multiplicador com valor padrão
        const generateMultiplier = () => {
            const isWin = Math.random() < 0.6;
            if (isWin) {
                return Number((Math.random() * 2 + 1.1).toFixed(2)); // Multiplicador entre 1.1 e 3.1
            } else {
                return Number((Math.random() * 0.5 + 0.1).toFixed(2)); // Multiplicador entre 0.1 e 0.6
            }
        };

        // Função para gerar uma nova aposta
        const generateNewBet = (isPlayer = false) => {
            const betAmount = generateBetAmount();
            const multiplier = generateMultiplier();
            const finalAmount = (betAmount * multiplier).toFixed(2);
            
            return {
                id: Date.now() + Math.random(),
                username: isPlayer ? 'Você' : generateMaskedUsername(),
                userAvatar: `https://api.dicebear.com/7.x/avataaars/svg?seed=${Math.random()}`,
                betAmount: betAmount,
                multiplier: multiplier,
                finalAmount: finalAmount, // Adicionando o valor final calculado
                time: new Date().toLocaleTimeString('pt-BR', { 
                    hour: '2-digit', 
                    minute: '2-digit'
                }),
                isPlayer: isPlayer
            };
        };

        // Atualizar jogadores online
        const updateOnlinePlayers = () => {
            const variation = Math.floor(Math.random() * 11) - 5; // Variação de -5 a +5
            onlinePlayers.value = Math.max(50, Math.min(1000, onlinePlayers.value + variation));
        };

        // Adicionar nova aposta com verificação
        const addNewBet = (isPlayer = false) => {
            const newBet = generateNewBet(isPlayer);
            if (recentWins.value) {
                recentWins.value.unshift(newBet);
                recentWins.value = recentWins.value.slice(0, 50);
            } else {
                recentWins.value = [newBet];
            }
        };

        // Inicializar dados com verificação
        onMounted(() => {
            // Garantir que recentWins seja inicializado como array
            if (!recentWins.value) {
                recentWins.value = [];
            }

            // Atualizar jogadores online a cada 3 segundos
            setInterval(updateOnlinePlayers, 3000);

            // Adicionar novas apostas periodicamente
            setInterval(() => addNewBet(), 2000);
        });

        // Função para registrar aposta do jogador
        const registerPlayerBet = (betAmount, multiplier) => {
            addNewBet(true);
        };

        const messages = [
            "🎮 Bem-vindo ao nosso cassino! Divirta-se com responsabilidade.",
            "💰 Nova rodada de bônus disponível! Verifique suas promoções.",
            "🌟 Parabéns aos últimos ganhadores!",
            "🎲 Mantenha o controle do seu tempo de jogo.",
            "💎 Novo jackpot progressivo atingiu R$ 100.000!",
            "🎯 Estabeleça limites antes de começar a jogar.",
            "🌈 Já experimentou nossos novos jogos?",
            "🎪 Torneio especial começando em breve!",
            "🎁 Bônus de recarga disponível agora!",
            "🔥 Hot Games da semana atualizados!",
            "🏆 Novo recorde de vitória estabelecido!",
            "🎨 Personalize seu perfil para mais vantagens.",
            "📱 Jogue também em seu dispositivo móvel!",
            "🎯 Defina suas metas de jogo com sabedoria.",
            "💫 Multiplique seus ganhos!",
            "🎲 Mantenha suas sessões de jogo equilibradas.",
            "🎮 Novos títulos adicionados esta semana!",
            "🎪 Eventos especiais todo fim de semana!",
            "⚡ Aproveite nossas promoções relâmpago!",
            "🌈 Diversifique seus jogos favoritos!",
            "💫 Bônus especial para jogadores fiéis!",
            "🎯 Mantenha o foco e jogue com estratégia.",
            "🌟 Programa de fidelidade renovado!",
            "⭐ Aproveite nosso suporte 24/7 por e-mail!"
        ];

        // Atualizar mensagem atual
        const updateMessage = () => {
            let newIndex;
            do {
                newIndex = Math.floor(Math.random() * messages.length);
            } while (messages[newIndex] === currentTip.value);
            
            currentTip.value = messages[newIndex];
        };

        onMounted(() => {
            // Iniciar com uma mensagem aleatória
            updateMessage();
            
            // Configurar o intervalo para atualizar as mensagens
            const messageInterval = setInterval(updateMessage, 10000);
            
            // Limpar intervalo ao desmontar
            onUnmounted(() => {
                if (messageInterval) clearInterval(messageInterval);
            });
        });

        const loadRelatedGames = async () => {
            try {
                // Simular carregamento de jogos relacionados
                const games = [];
                for (let i = 0; i < 4; i++) {
                    games.push({
                        id: i,
                        name: `Slot Game ${i + 1}`,
                        thumbnail: `https://picsum.photos/200/150?random=${i}`,
                    });
                }
                relatedGames.value = games;
            } catch (error) {
                console.error('Error loading related games:', error);
            }
        };

        onMounted(async () => {
            const authStore = useAuthStore();
            if (!authStore.isAuth) {
                router.push('/login');
                return;
            }

            try {
                const response = await HttpApi.get(`games/single/${route.params.slug}`);
                if (response.data && response.data.gameUrl) {
                    gameUrl.value = response.data.gameUrl;
                    gameName.value = response.data.gameName || "";
                    gameProvider.value = response.data.provider || "";
                    gameCategory.value = response.data.category || "";
                }
            } catch (error) {
                console.error('Error loading game:', error);
                router.push('/');
            }

            // Iniciar com uma mensagem aleatória
            updateMessage();
            
            // Configurar o intervalo para atualizar as mensagens
            const messageInterval = setInterval(updateMessage, 10000);
            
            // Limpar intervalo ao desmontar
            onUnmounted(() => {
                clearInterval(messageInterval);
            });
        });

        const handleIframeLoad = () => {
            loading.value = false;
        };

        const goBack = () => {
            router.back();
        };

        const closeGame = () => {
            router.push('/');
        };

        const toggleFullscreen = () => {
            const elem = document.documentElement;
            if (!document.fullscreenElement) {
                elem.requestFullscreen();
                isFullscreen.value = true;
            } else {
                document.exitFullscreen();
                isFullscreen.value = false;
            }
        };

        const loadGame = (game) => {
            // Implementar lógica para carregar novo jogo
            loading.value = true;
            gameUrl.value = ''; // Reset URL
            // ... lógica para carregar novo jogo
        };

        return {
            loading,
            gameUrl,
            gameName,
            gameProvider,
            gameCategory,
            isFullscreen,
            onlinePlayers,
            biggestWin,
            currentTip,
            recentWins,
            relatedGames,
            handleIframeLoad,
            goBack,
            closeGame,
            toggleFullscreen,
            loadGame,
            registerPlayerBet
        };
    }
};
</script>

<style scoped>
.game-loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 9999;
    background: #0f172a;
}

.game-background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        rgba(15, 23, 42, 0.9),
        rgba(15, 23, 42, 0.95)
    );
    backdrop-filter: blur(10px);
}

.game-content {
    position: relative;
    z-index: 1;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.98) 100%);
}

.game-header {
    padding: 1.25rem 2.5rem;
    background: rgba(30, 41, 59, 0.95);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(148, 163, 184, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: 200px 1fr 200px;
    align-items: center;
    gap: 1rem;
}

.game-info {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.game-info h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.game-message-container {
    width: 100%;
    min-height: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.game-message {
    color: #60a5fa;
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
    width: 100%;
    max-width: 600px;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}

.header-left {
    justify-self: start;
    width: 200px;
}

.header-right {
    justify-self: end;
    width: 200px;
}

.header-left, .header-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.game-info {
    margin-left: 1rem;
}

.game-info h1 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.game-meta {
    display: flex;
    gap: 1rem;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1.25rem;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: rgba(30, 41, 59, 0.95);
    color: white;
    border: 1px solid rgba(148, 163, 184, 0.2);
    cursor: pointer;
    font-weight: 500;
    letter-spacing: 0.3px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.action-button:hover {
    background: rgba(51, 65, 85, 0.95);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.back-button {
    color: #60a5fa;
}

.close-button {
    color: #f87171;
}

.game-main-content {
    flex: 1;
    display: flex;
    gap: 1rem;
    padding: 1rem;
    height: calc(100vh - 80px);
}

.game-sidebar {
    width: 320px;
    background: rgba(30, 41, 59, 0.95);
    backdrop-filter: blur(16px);
    border-radius: 1.5rem;
    padding: 1.25rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.sidebar-section {
    background: rgba(51, 65, 85, 0.6);
    border-radius: 1.25rem;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.03);
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

.sidebar-section h3 {
    color: #f8fafc;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    letter-spacing: 0.5px;
    position: relative;
    padding-bottom: 0.75rem;
}

.sidebar-section h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: #60a5fa;
    border-radius: 2px;
}

.stats-grid {
    display: grid;
    gap: 1rem;
}

.stat-item {
    background: rgba(51, 65, 85, 0.8);
    padding: 1.5rem;
    border-radius: 1.25rem;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.stat-item:hover {
    transform: translateY(-3px);
    background: rgba(71, 85, 105, 0.8);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-item i {
    font-size: 1.5rem;
    color: #60a5fa;
    margin-bottom: 0.75rem;
    opacity: 0.9;
}

.stat-value {
    display: block;
    color: #f8fafc;
    font-size: 1.35rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
}

.stat-label {
    color: #cbd5e1;
    font-size: 0.875rem;
    font-weight: 500;
}

.game-container {
    flex: 1;
    background: rgba(30, 41, 59, 0.95);
    border-radius: 1.5rem;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.08);
    margin: 0 1rem;
    overflow: hidden;
    position: relative;
}

.loading-container {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(15, 23, 42, 0.95);
}

.loading-content {
    text-align: center;
    color: white;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 3px solid rgba(96, 165, 250, 0.1);
    border-radius: 50%;
    border-top-color: #60a5fa;
    animation: spin 1s linear infinite;
    margin: 0 auto 1rem;
}

.loading-tips {
    margin-top: 1rem;
    color: #94a3b8;
    font-style: italic;
}

.game-frame {
    width: 100%;
    height: 100%;
    border: none;
}

.recent-wins {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.win-item {
    position: relative;
    padding: 1rem;
    background: rgba(30, 41, 59, 0.95);
    border-radius: 0.75rem;
    display: grid;
    grid-template-columns: auto 1fr;
    grid-template-areas: 
        "avatar username"
        "avatar amount";
    gap: 0.25rem;
    margin-bottom: 0.5rem;
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.3s ease;
}

.user-avatar {
    grid-area: avatar;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    margin-right: 0.75rem;
}

.username {
    grid-area: username;
    color: #94a3b8;
    font-size: 0.875rem;
    font-weight: 500;
}

.final-amount {
    grid-area: amount;
    font-weight: 600;
    font-size: 0.875rem;
    color: #22c55e;
}

.final-amount.loss {
    color: #ef4444;
}

.win-time {
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: #64748b;
    font-size: 0.75rem;
}

/* Remover estilos não utilizados */
.win-info,
.bet-details,
.bet-amount {
    display: none;
}

/* Melhorias na scrollbar */
.wins-section::-webkit-scrollbar {
    width: 6px;
}

.wins-section::-webkit-scrollbar-track {
    background: rgba(148, 163, 184, 0.1);
    border-radius: 3px;
}

.wins-section::-webkit-scrollbar-thumb {
    background: rgba(148, 163, 184, 0.3);
    border-radius: 3px;
}

.wins-section::-webkit-scrollbar-thumb:hover {
    background: rgba(148, 163, 184, 0.5);
}

/* Responsividade ajustada */
@media (max-width: 1440px) {
    .right-sidebar {
        width: 320px;
    }
}

@media (max-width: 1280px) {
    .right-sidebar {
        width: 300px;
    }
}

@media (max-width: 1024px) {
    .game-sidebar {
        display: none;
    }
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 2px solid rgba(255, 255, 255, 0.1);
}

.game-message {
    color: #60a5fa;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    opacity: 0.9;
    transition: all 0.3s ease;
    animation: fadeInOut 10s infinite;
}

@keyframes fadeInOut {
    0% { opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { opacity: 0; }
}
</style> 