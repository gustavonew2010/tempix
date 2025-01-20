<template>
    <div class="absolute top-0 left-5 hidden lg:block">
        <div class="flex items-center justify-center h-full" style="align-items: center;">
            <div class="flex-row w-[100%] cursor-pointer items-center px-2 py-3 border-primary flex justify-center tirar-esporte" 
                 style="border-bottom: 3px solid;margin-left: 10px;margin-top:10px;padding-left: 10px;padding-right: 10px;padding-bottom: 1em;">
                <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM143.8 277.3C136.9 303.2 152.3 329.1 178.3 336.9C204.3 343.9 230.1 328.5 237.9 302.5L240.3 293.6C240.4 293.3 240.5 292.9 240.6 292.5L258.4 323.2L246.3 330.2C239.6 334 237.4 342.5 241.2 349.2C245.1 355.9 253.6 358.1 260.2 354.3L308.4 326.5C315.1 322.6 317.4 314.1 313.5 307.4C309.7 300.8 301.2 298.5 294.5 302.3L282.5 309.3L264.7 278.6C265.1 278.7 265.5 278.8 265.9 278.9L274.7 281.2C300.7 288.2 327.4 272.8 334.4 246.8C341.3 220.8 325.9 194.1 299.9 187.1L196.1 159.6C185.8 156.6 174.4 163.2 171.4 174.3L143.8 277.3z" fill="currentColor"/>
                </svg>
                <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;color: white">
                    CASSINO
                </p>
            </div>
            
            <div v-if="custom?.esportes" class="flex-row w-[100%] items-center px-2 py-3 gap-2 flex justify-center texto-esportes tirar-esporte">
                <a :href="custom.esportes" style="display: flex;align-items: center">
                    <svg height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path d="M177.1 228.6L207.9 320l96.2-96.2-81.4-30.7c-8.4-3.2-17.9-.6-23 6.3-5.1 6.9-5.8 16.3-1.8 24zm-25.8 89.5c-3.5 9.4-.3 19.9 7.9 25.7l233.3 171.6c12.1 8.9 28.8 6.3 37.7-5.8 8.9-12.1 6.3-28.8-5.8-37.7l-233.3-171.6c-9.4-6.9-22.8-5.3-30.1 4-5.1 6.9-7.1 12.8-9.7 13.8z" fill="currentColor"/>
                    </svg>
                    <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;">
                        ESPORTES
                    </p>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'NavCategories',
    data() {
        return {
            custom: window.custom || {} // Assumindo que custom é uma variável global
        }
    }
}
</script> 