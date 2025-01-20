<template>
    <div class="fixed left-0 right-0 bottom-0 flex items-center justify-center mx-auto w-full"
         style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);backdrop-filter: none;height: 100vh;">
        <div @click="$emit('close')" class="absolute inset-0 opacity-50 cursor-pointer"></div>
        
        <div class="search-menu mx-auto w-full p-4">
            <div class="mb-5 w-full mx-auto p-4">
                <div class="mx-auto">
                    <div class="flex flex-col">
                        <div class="relative w-full">
                            <input v-model="localSearchTerm"
                                   type="search"
                                   class="block p-2.5 w-full z-20 text-sm text-gray-900 dark:placeholder-gray-400 dark:text-white placeholder-search p-2.5 lg:p-0 search-mobile"
                                   placeholder="Pesquise um nome de cassino..."
                                   style="background-color: var(--ci-gray-dark);border-radius: 3px;font-size: 14px;padding-left: 40px;padding-top: 5px;padding-bottom: 5px;"
                                   required>
                        </div>
                        
                        <div v-if="!isLoading" class="mt-8 grid grid-cols-4 md:grid-cols-12 gap-4 py-5">
                            <slot name="games" :games="games"></slot>
                        </div>
                        <div v-else class="loading-indicator">
                            <!-- Adicione seu indicador de loading aqui -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SearchModal',
    props: {
        searchTerm: {
            type: String,
            required: true
        },
        games: {
            type: Array,
            default: () => []
        },
        isLoading: {
            type: Boolean,
            default: false
        }
    },
    emits: ['close', 'update:searchTerm'],
    computed: {
        localSearchTerm: {
            get() {
                return this.searchTerm
            },
            set(value) {
                this.$emit('update:searchTerm', value)
            }
        }
    }
}
</script> 