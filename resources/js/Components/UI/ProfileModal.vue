<template>
    <div id="modalProfileEl" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl md:max-w-lg max-h-full rounded-lg shadow-2xl transform transition-all duration-300 ease-in-out">
            <!-- Loading Overlay -->
            <div v-if="isLoading" class="absolute inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center rounded-lg">
                <div class="animate-pulse">
                    <i class="fa-duotone fa-spinner-third fa-spin text-5xl text-primary"></i>
                </div>
            </div>

            <!-- Profile Content -->
            <div v-else class="bg-gradient-to-b from-gray-900 to-gray-800 rounded-lg">
                <!-- Header -->
                <div class="relative h-32 bg-gradient-to-r from-primary/80 to-primary rounded-t-lg">
                    <button @click="$emit('close')" class="absolute top-4 right-4 p-2 rounded-full bg-black/20 hover:bg-black/40 transition-colors">
                        <i class="fa-light fa-x text-white"></i>
                    </button>
                </div>

                <!-- Avatar Section -->
                <div class="relative -mt-16 px-6">
                    <div class="flex justify-center">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-full border-4 border-gray-800 overflow-hidden">
                                <img 
                                    :src="userData?.avatar ? `/storage/${userData.avatar}` : '/assets/images/profile.jpg'" 
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div @click="$emit('update-avatar')" class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                                <i class="fa-duotone fa-camera-retro text-2xl text-white"></i>
                            </div>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="mt-4 text-center">
                        <div class="relative inline-block">
                            <input 
                                v-model="userName"
                                @blur="$emit('update-name', userName)"
                                :readonly="!isEditing"
                                class="text-2xl font-bold bg-transparent text-center border-b-2 border-transparent focus:border-primary outline-none"
                            >
                            <button 
                                @click="isEditing = !isEditing"
                                class="ml-2 p-2 rounded-full hover:bg-gray-700/50"
                            >
                                <i :class="isEditing ? 'fa-solid fa-check text-green-500' : 'fa-light fa-pen text-gray-400'"></i>
                            </button>
                        </div>
                        <p class="text-gray-400 mt-1">{{ userData?.email }}</p>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fa-duotone fa-trophy-star text-yellow-500"></i>
                            </div>
                            <p class="stats-label">{{ $t('Total winnings') }}</p>
                            <p class="stats-value">{{ stats.totalEarnings }}</p>
                        </div>
                        
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fa-duotone fa-dice text-blue-500"></i>
                            </div>
                            <p class="stats-label">{{ $t('Total bets') }}</p>
                            <p class="stats-value">{{ stats.totalBets }}</p>
                        </div>
                        
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fa-duotone fa-coins text-green-500"></i>
                            </div>
                            <p class="stats-label">{{ $t('Total bet') }}</p>
                            <p class="stats-value">{{ stats.sumBets }}</p>
                        </div>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="p-6 border-t border-gray-700">
                    <p class="text-center text-gray-400">
                        <i class="fa-regular fa-clock mr-2"></i>
                        {{ $t('Account created') }} {{ userData?.dateHumanReadable }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProfileModal',
    props: {
        userData: {
            type: Object,
            required: true
        },
        stats: {
            type: Object,
            default: () => ({
                totalEarnings: 0,
                totalBets: 0,
                sumBets: 0
            })
        },
        isLoading: {
            type: Boolean,
            default: false
        },
        profileUser: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            isEditing: false,
            userName: ''
        }
    },
    created() {
        this.userName = this.userData?.name || ''
    },
    watch: {
        'userData.name'(newVal) {
            this.userName = newVal
        }
    },
    emits: ['close', 'update-name', 'update-avatar']
}
</script>

<style scoped>
.stats-card {
    @apply bg-gray-800 rounded-lg p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg;
}

.stats-icon {
    @apply text-2xl mb-2 flex justify-center;
}

.stats-label {
    @apply text-xs text-gray-400 text-center;
}

.stats-value {
    @apply text-xl font-bold text-center mt-1;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.animate-pulse {
    animation: pulse 2s infinite;
}
</style> 