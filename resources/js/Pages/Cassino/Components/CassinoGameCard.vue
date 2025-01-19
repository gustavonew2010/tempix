<style>
.game-card {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    cursor: pointer;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.game-card img {
    transition: none;
}

.game-card:hover img {
    transform: none;
}

.game-info-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;  
}

.game-card:hover .game-info-overlay {
    opacity: 1;
    animation: none;
}

.play-button {
    background: var(--ci-primary-color);
    padding: 8px 20px;
    border-radius: 25px;
    transform: none;
    opacity: 0;
    transition: none;
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.game-card:hover .play-button {
    transform: none;
    opacity: 1;
}

/* Remover efeito de brilho */
.play-button::before {
    display: none;
}

.play-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 10px;
    height: 12px;
    line-height: 0;
    color: #FFFFFF;
}

.play-icon svg {
    width: 100%;
    height: 100%;
}

.play-button span {
    display: flex;
    align-items: center;
    line-height: 1;
    margin-top: 1px;
}

/* Remover partículas */
.particles {
    display: none;
}

.particle {
    display: none;
}

.game-container {
    height: 100%;
}

.game-image {
    aspect-ratio: 3/4;
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.game-title {
    font-size: 14px;
    font-weight: 500;
    color: white;
    margin-bottom: 4px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
}

/* Ajustes específicos para mobile */
@media (max-width: 768px) {
    .game-card {
        margin: 0 4px; /* Adiciona margem lateral apenas em mobile */
        padding: 2px; /* Adiciona padding apenas em mobile */
    }

    .game-container {
        aspect-ratio: 3/4;
        max-height: 200px; /* Limita altura em mobile */
    }

    .game-info-overlay {
        padding: 8px;
    }

    .text-lg{
        margin-left: 15px;
    }

    .game-title {
        font-size: 12px;
    }

    .play-button {
        padding: 6px 16px;
        font-size: 12px;
    }

    .play-icon {
        width: 8px;
        height: 10px;
    }
}
</style>

<template>
    <div class="game-card" @click="handleGameClick">
        <div class="game-container overflow-hidden relative rounded-lg text-gray-700 w-full cursor-pointer">
            <picture>
                <source
                    :srcset="`${webpImageUrl} 1x, ${webpImageUrl}&dpr=2 2x`"
                    type="image/webp"
                >
                <img 
                    :src="optimizedImageUrl"
                    :alt="game.game_name"
                    loading="lazy"
                    class="game-image object-cover w-full h-full"
                    :srcset="`${optimizedImageUrl} 1x, ${optimizedImageUrl}&dpr=2 2x`"
                    sizes="(max-width: 640px) 200px, 400px"
                    decoding="async"
                >
            </picture>

            <div class="game-info-overlay">
                <div class="particles">
                    <div v-for="n in 5" :key="n" 
                         class="particle"
                         :style="{
                             left: Math.random() * 100 + '%',
                             animationDelay: Math.random() * 1000 + 'ms'
                         }">
                    </div>
                </div>
                
                <button class="play-button">
                    <div class="play-icon">
                        <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 5.13397C10.1667 5.51888 10.1667 6.48112 9.5 6.86603L1.75 11.2631C1.08333 11.648 0.25 11.1669 0.25 10.397L0.25 1.60302C0.25 0.833089 1.08333 0.351996 1.75 0.736907L9.5 5.13397Z" 
                                  fill="#FFFFFF"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold text-sm">JOGAR</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from "@/Stores/Auth.js";
import { useRouter } from "vue-router";

export default {
    props: {
        game: {
            type: Object,
            required: true,
            validator(game) {
                return game.hasOwnProperty('game_name') && 
                       game.hasOwnProperty('cover')
            }
        }
    },
    
    computed: {
        webpImageUrl() {
            const baseUrl = this.game.distribution === 'kagaming' 
                ? this.game.cover 
                : '/storage/' + this.game.cover;
            return `${baseUrl}?format=webp&quality=80&width=400`;
        },
        
        optimizedImageUrl() {
            const baseUrl = this.game.distribution === 'kagaming' 
                ? this.game.cover 
                : '/storage/' + this.game.cover;
            return `${baseUrl}?quality=80&width=400`;
        }
    },
    
    setup(props, { emit }) {
        const authStore = useAuthStore();
        const router = useRouter();

        const handleGameClick = () => {
            if (!authStore.isAuth) {
                window.modalAuth?.show();
                return;
            }

            emit('open-game', props.game);
        };

        return {
            handleGameClick
        };
    }
};
</script>

<style scoped>

</style>
