<template>
    <div class="promo-bar">
        <div class="promo-content">
            <p class="promo-text">
                <span class="emoji">💥</span>
                <span class="text">Indique um amigo e ganhe R$ 5,00 de saldo REAL para cada amigo que convidar!</span>
            </p>
            <router-link 
                to="/profile/affiliate" 
                class="promo-button"
            >
                Resgatar
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PromoBar'
}
</script>

<style scoped>
.promo-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: var(--ci-primary-color);
    z-index: 51;
}

.promo-content {
    height: 100%;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    padding: 0 1rem;
}

.promo-text {
    color: white;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.emoji {
    flex-shrink: 0;
    font-size: 1.25rem;
}

.text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.promo-button {
    flex-shrink: 0;
    padding: 0.375rem 1rem;
    border-radius: 5px;
    background-color: #fff;
    color: var(--ci-primary-color);
    text-decoration: none;
    font-weight: 500;
    white-space: nowrap;
    font-size: 0.875rem;
    transition: all 0.3s ease;
}

.promo-button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

/* Mobile Styles */
@media (max-width: 768px) {
    .promo-content {
        gap: 0.75rem;
        padding: 0 0.75rem;
    }

    .promo-text {
        font-size: 0.75rem;
        max-width: calc(100% - 100px); /* Espaço para o botão */
    }

    .emoji {
        font-size: 1rem;
    }

    .promo-button {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
    }
}

/* Ajuste para telas muito pequenas */
@media (max-width: 360px) {
    .promo-content {
        gap: 0.5rem;
        padding: 0 0.5rem;
    }

    .promo-text {
        font-size: 0.7rem;
        max-width: calc(100% - 80px); /* Ajuste para telas menores */
    }
}
</style> 