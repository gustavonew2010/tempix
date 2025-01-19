<style>
@media(max-width:1025px) {
    .aparecer-menu {
        display: block;
        z-index: 999;
    }
}
</style>
<template>
    <div class="mobile-menu-wrapper aparecer-menu" style="background-color: var(--navtop-color-dark);">
        <div class="mobile-menu">
            <button @click.prevent="toggleMenu" class="btn">
                <svg
                    height="1em" viewBox="0 0 448 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                        fill="currentColor"></path>
                </svg> 
                Menu
            </button>

            <div v-if="custom.esportes" @click="handleCategoryClick({name: 'Esportes', type: 'esportes'})" class="btn cursor-pointer">
                <svg height="1em"
                    viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M355.5 45.53L342.4 14.98c-27.95-9.983-57.18-14.98-86.42-14.98c-29.25 0-58.51 4.992-86.46 14.97L156.5 45.53l99.5 55.13L355.5 45.53zM86.78 96.15L53.67 99.09c-34.79 44.75-53.67 99.8-53.67 156.5L.0001 256c0 2.694 .0519 5.379 .1352 8.063l24.95 21.76l83.2-77.67L86.78 96.15zM318.8 336L357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336zM512 255.6c0-56.7-18.9-111.8-53.72-156.5L425.6 96.16L403.7 208.2l83.21 77.67l24.92-21.79C511.1 260.1 512 258.1 512 255.6zM51.77 367.7l-7.39 32.46c33.48 49.11 82.96 85.07 140 101.7l28.6-16.99l-48.19-103.3L51.77 367.7zM347.2 381.5l-48.19 103.3l28.57 17c57.05-16.66 106.5-52.62 140-101.7l-7.38-32.46L347.2 381.5z"
                        fill="currentColor"></path>
                    <path
                        d="M458.3 99.08L458.3 99.08L458.3 99.08zM511.8 264c-1.442 48.66-16.82 95.87-44.28 136.1l-7.38-32.46l-113 13.86l-48.19 103.3l28.22 16.84c-23.48 6.78-47.67 10.2-71.85 10.2c-23.76 0-47.51-3.302-70.58-9.962l28.23-17.06l-48.19-103.3l-113-13.88l-7.39 32.46c-27.45-40.19-42.8-87.41-44.25-136.1l24.95 21.76l83.2-77.67L86.78 96.15L53.67 99.09c29.72-38.29 69.67-67.37 115.2-83.88l.3613 .2684L156.5 45.53l99.5 55.13l99.5-55.13L342.4 14.98c45.82 16.48 86 45.64 115.9 84.11L425.6 96.16L403.7 208.2l83.21 77.67L511.8 264zM357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336L357.3 217.4z"
                        fill="currentColor" opacity="0.4"></path>
                </svg> 
                <span>Esportes</span>
            </div>
        
            <div v-if="custom.apostasaovivo" @click="handleCategoryClick({name: 'Ao vivo', type: 'apostasaovivo'})" class="btn cursor-pointer">
                <span class="badge-live dot"></span>
                <svg height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path class="primary"
                        d="M201.9 32l-128 128h92.13l128-128H201.9zM64 32C28.65 32 0 60.65 0 96v64h6.062l128-128H64zM326.1 160l127.4-127.4C451.7 32.39 449.9 32 448 32h-86.06l-128 128H326.1zM497.7 56.19L393.9 160H512V96C512 80.87 506.5 67.15 497.7 56.19zM224.3 241.7C221.1 239.5 216.9 239.5 213.5 241.4C210.1 243.3 208 247 208 251v137.9c0 4.008 2.104 7.705 5.5 9.656C215.1 399.5 216.9 400 218.7 400c1.959 0 3.938-.5605 5.646-1.682l106.7-68.97C334.1 327.3 336 323.8 336 319.1s-1.896-7.34-5.021-9.354L224.3 241.7z"
                        fill="currentColor"></path>
                    <path class="secondary"
                        d="M0 160v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V160H0zM330.1 329.3l-106.7 68.97C222.6 399.4 220.6 400 218.7 400c-1.77 0-3.562-.4648-5.166-1.379C210.1 396.7 208 392.1 208 388.1V251c0-4.01 2.104-7.705 5.5-9.656c3.375-1.918 7.562-1.832 10.81 .3027l106.7 68.97C334.1 312.7 336 316.2 336 319.1S334.1 327.3 330.1 329.3z"
                        fill="currentColor" opacity="0.4"></path>
                </svg>
                <span>Ao vivo</span>
            </div>

            <div v-if="custom.cassino" @click="handleCategoryClick({name: 'Cassino', type: 'cassino'})" class="btn cursor-pointer">
                <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM143.8 277.3C136.9 303.2 152.3 329.1 178.3 336.9C204.3 343.9 230.1 328.5 237.9 302.5L240.3 293.6C240.4 293.3 240.5 292.9 240.6 292.5L258.4 323.2L246.3 330.2C239.6 334 237.4 342.5 241.2 349.2C245.1 355.9 253.6 358.1 260.2 354.3L308.4 326.5C315.1 322.6 317.4 314.1 313.5 307.4C309.7 300.8 301.2 298.5 294.5 302.3L282.5 309.3L264.7 278.6C265.1 278.7 265.5 278.8 265.9 278.9L274.7 281.2C300.7 288.2 327.4 272.8 334.4 246.8C341.3 220.8 325.9 194.1 299.9 187.1L196.1 159.6C185.8 156.6 174.4 163.2 171.4 174.3L143.8 277.3z"
                        fill="currentColor"></path>
                    <path
                        d="M324.1 499L459.4 420.9C501.3 396.7 515.7 343.1 491.5 301.1L354.7 64.25C356.5 64.08 358.2 64 360 64H584C614.9 64 640 89.07 640 120V456C640 486.9 614.9 512 584 512H360C346.4 512 333.8 507.1 324.1 499V499zM579.8 135.7C565.8 123.9 545.3 126.2 532.9 138.9L528.1 144.2L523.1 138.9C510.6 126.2 489.9 123.9 476.4 135.7C460.7 149.2 459.9 173.1 473.9 187.6L522.4 237.6C525.4 240.8 530.6 240.8 533.9 237.6L582 187.6C596 173.1 595.3 149.2 579.8 135.7H579.8z"
                        fill="currentColor" opacity="0.4"></path>
                </svg> 
                <span>Cassino</span>
            </div>

            <div v-if="custom.cassinoaovivo" @click="handleCategoryClick({name: 'Cassino ao vivo', type: 'cassinoaovivo'})" class="btn cursor-pointer">
                <span class="badge-live dot"></span>
                <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M591.1 192l-118.7 0c4.418 10.27 6.604 21.25 6.604 32.23c0 20.7-7.865 41.38-23.63 57.14l-136.2 136.2v46.37C320 490.5 341.5 512 368 512h223.1c26.5 0 47.1-21.5 47.1-47.1V240C639.1 213.5 618.5 192 591.1 192zM479.1 376c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S493.2 376 479.1 376zM96 200c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1s23.1-10.75 23.1-23.1S109.3 200 96 200zM352 248c13.25 0 23.1-10.75 23.1-23.1s-10.75-23.1-23.1-23.1S328 210.8 328 224S338.8 248 352 248zM224 328c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1c13.25 0 23.1-10.75 23.1-23.1S237.3 328 224 328zM224 200c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1s23.1-10.75 23.1-23.1S237.3 200 224 200zM224 72c-13.25 0-23.1 10.75-23.1 23.1s10.75 23.1 23.1 23.1c13.25 0 23.1-10.75 23.1-23.1S237.3 72 224 72z"
                        fill="currentColor"></path>
                    <path
                        d="M447.1 224c0-12.56-4.782-25.13-14.35-34.76l-174.9-174.9C249.1 4.784 236.5 0 223.1 0C211.4 0 198.9 4.784 189.2 14.35L14.35 189.2C4.784 198.9-.0011 211.4-.0011 223.1c0 12.56 4.786 25.18 14.35 34.8l174.9 174.9c9.626 9.563 22.19 14.35 34.75 14.35c12.56 0 25.13-4.782 34.75-14.35l174.9-174.9C443.2 249.1 447.1 236.6 447.1 224zM96 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S109.3 248 96 248zM224 376c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1c13.25 0 23.1 10.75 23.1 23.1S237.3 376 224 376zM224 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S237.3 248 224 248zM224 120c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1c13.25 0 23.1 10.75 23.1 23.1S237.3 120 224 120zM352 248c-13.25 0-23.1-10.75-23.1-23.1s10.75-23.1 23.1-23.1s23.1 10.75 23.1 23.1S365.3 248 352 248z"
                        fill="currentColor" opacity="0.4"></path>
                </svg>
                <span>Ao vivo</span>
            </div>

            <div v-for="(category, index) in categories" 
                :key="index"
                @click="handleCategoryClick(category)"
                class="btn cursor-pointer">
                <img :src="`/storage/`+category.image" alt="" width="21" class="mr-3">
                <span>{{ $t(category.name) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { sidebarStore } from "@/Stores/SideBarStore.js";
    import { useSettingStore } from '@/Stores/SettingStore.js';
    import { useAuthStore } from "@/Stores/Auth.js";
    import { inject } from 'vue';
    import { emitter } from '@/Pages/Home/HomePage.vue';

    export default {
        props: {
            categories: {
                type: Array,
                required: true
            }
        },
        setup() {
            const filterGamesByCategory = inject('filterGamesByCategory', () => {});
            const openGameModal = inject('openGameModal', () => {});
            
            return {
                filterGamesByCategory,
                openGameModal
            };
        },
        data() {
            return {
                isLoading: false,
                custom: null,
            }
        },
        computed: {
            sidebarMenuStore() {
                return sidebarStore();
            },
            sidebarMenu() {
                const sidebar = sidebarStore()
                return sidebar.getSidebarStatus;
            }
        },
        methods: {
            getSetting() {
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;
                if(settingData) {
                    this.setting = settingData;
                }
            },
            toggleMenu() {
                this.sidebarMenuStore.setSidebarToogle();
            },
            async handleCategoryClick(category) {
                event?.preventDefault();
                
                try {
                    console.log('Categoria clicada no BottomNav:', category);
                    
                    const categoryData = {
                        id: category.id || category.type,
                        name: category.name,
                        type: category.type
                    };
                    
                    emitter.emit('filter-category', categoryData);
                    console.log('Evento de filtro emitido:', categoryData);
                    
                    // Fecha o menu lateral se estiver aberto
                    if (this.sidebarMenu) {
                        this.toggleMenu();
                    }
                    
                    // Rola até a seção de jogos
                    const gamesSection = document.querySelector('.featured-games-section');
                    if (gamesSection) {
                        gamesSection.scrollIntoView({ behavior: 'smooth' });
                    }
                } catch (error) {
                    console.error('Erro ao processar categoria:', error);
                }
            }
        },
        created() {
            this.getSetting();
            this.custom = custom;
        }
    };
</script>

<style scoped>

</style>
