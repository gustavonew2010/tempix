<style>

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

/* Animações para o avatar */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.animate-pulse {
    animation: pulse 2s infinite;
}

 .pad-modal-profile {
        padding: 0px 4%;
    } 
    .hover-menu:hover {
        background-color: #0F2B39;
        border-radius: 10px;
    }
    .sair-menu:hover {
        background-color: #27171A;
        border-radius: 10px;
        color: #D3345D; 
    }
    .sairp-menu:hover {
        color: #D3345D;
    }
    .notificacao-sino {
        font-size: 20px;
        color: gold;
    }
    .tirar-div {
        display: none;
    }
    .padding-register {
        padding: 0px 8%;
    }
    .nav-indexx {
        z-index: 999;
    }
    .login-register-x {
        margin-top: -20px;
        margin-right: -55px;
    }
    .login-register-100vh {
        background-color: var(--carousel-banners-dark);
        border-radius: 20px;
        max-width: 450px;
        margin: 0 auto;
        border-radius: 8px;
    }
    .x-mark-scale {
        transition: .3s;
    }
    .x-mark-scale:hover {
        transform: scale(.9);
    }
    .msg-alerta {
        background-color: #0474CC;height: 30px;width: 100%;position: fixed;top: 0;display: flex;justify-content: center;
    }
    .msg-alerta-text {
        color: white;font-weight: 400;font-size: 14px;
        text-align: center;
        overflow: hidden;
    }
   .texto-esportes {
    opacity: .5;
    transition: .3s;
   }

   .texto-esportes:hover {
    opacity: 1;
   }
@media (max-width:1025px) {
    #open-side-nav {
        display: none;
    }
    .tirar-esporte {
        display: none;
    }
   }
@media (max-width:768px) {
    .texto-indique {
        font-size: 14px;
        padding-top: 5px;
    }
    .texto-indique-pad {
        padding: 0 2%;
        text-align: center
    }
    .pad-modal-profile {
        padding: 0px 0px;
    }
    .por-height-alto {
        height: 100vh;
        border-radius: 0px;
    }
    .notificacao-sino {
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.25rem;
        padding: 0px 8px;
    }
    .search-menu  {
        top: 0;
        min-height: 100vh;
    }
    .imagem-logo {
        max-width: 140px
    }
    .botao-entrar-mobile {
        padding: 3px 10px;
    }
    .nav-indexx {
     z-index: 999;
}
.botao-mobile-register-login {
        padding: 2px 12px;
        height: auto;
    }
    .login-register-100vh {
        height: 100vh;
        border-radius:0px;
        max-width: 1000px;
        width: 100%;
    }
    .login-register-x {
        margin-top: -10px;
        margin-right: -25px;
    }
    .padding-register {
        padding: 0px 4%;
    }
}
@media(max-width:600px) {
    .margin-teste {
        margin-left: 8px
    }
    .tirar-div {
        display: block;
    }
    
    .pulse2 {
        width: 2px;
        height: 2px;
        margin-left: 15px;
        bottom: 0;
    }

@media(max-width:500px) {
    .texto-indique {
        font-size: 12px;
        padding-top: 5px;
    }
}

}
</style>
<template>
   
    <nav 
    :class="[
        sidebar === true ? 'w-full' : 'w-full',
    ]"
    
    class="fixed top-10 navtop-color nav-indexx">
    <div class="fixed top-0 z-30 texto-indique-pad" style="background-color:var(--ci-primary-color);height: 50px;width:100%;display: flex;align-items: center;justify-content: center;margin-top: -5px">
        <p class="texto-indique" style="color: white; margin-right: 5px;">💥 Indique um amigo e ganhe R$ 5,00 de saldo REAL para cada amigo que convidar! </p> <a href="../profile/affiliate" style="padding: 3px 10px;border-radius: 5px;background-color: #fff;color: var(--ci-primary-color);text-decoration: none;">Resgatar</a>
    </div>
        <div class="px-3 lg:px-5 lg:pl-3 nav-menu relative" style="background-color: var(--navtop-color-dark);">

            <div class="absolute top-0 left-5 hidden lg:block">
                <div class="flex items-center justify-center h-full" style="align-items: center;">
                    <div
                        class="flex-row w-[100%] cursor-pointer items-center px-2 py-3 border-primary flex justify-center tirar-esporte" style="border-bottom: 3px solid;margin-left: 10px;margin-top:10px;padding-left: 10px;padding-right: 10px;padding-bottom: 1em;">
                        <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M220.7 7.468C247.3-7.906 281.4 1.218 296.8 27.85L463.8 317.1C479.1 343.8 470 377.8 443.4 393.2L250.5 504.5C223.9 519.9 189.9 510.8 174.5 484.2L7.468 194.9C-7.906 168.2 1.218 134.2 27.85 118.8L220.7 7.468zM143.8 277.3C136.9 303.2 152.3 329.1 178.3 336.9C204.3 343.9 230.1 328.5 237.9 302.5L240.3 293.6C240.4 293.3 240.5 292.9 240.6 292.5L258.4 323.2L246.3 330.2C239.6 334 237.4 342.5 241.2 349.2C245.1 355.9 253.6 358.1 260.2 354.3L308.4 326.5C315.1 322.6 317.4 314.1 313.5 307.4C309.7 300.8 301.2 298.5 294.5 302.3L282.5 309.3L264.7 278.6C265.1 278.7 265.5 278.8 265.9 278.9L274.7 281.2C300.7 288.2 327.4 272.8 334.4 246.8C341.3 220.8 325.9 194.1 299.9 187.1L196.1 159.6C185.8 156.6 174.4 163.2 171.4 174.3L143.8 277.3z" fill="currentColor"></path><path d="M324.1 499L459.4 420.9C501.3 396.7 515.7 343.1 491.5 301.1L354.7 64.25C356.5 64.08 358.2 64 360 64H584C614.9 64 640 89.07 640 120V456C640 486.9 614.9 512 584 512H360C346.4 512 333.8 507.1 324.1 499V499zM579.8 135.7C565.8 123.9 545.3 126.2 532.9 138.9L528.1 144.2L523.1 138.9C510.6 126.2 489.9 123.9 476.4 135.7C460.7 149.2 459.9 173.1 473.9 187.6L522.4 237.6C525.4 240.8 530.6 240.8 533.9 237.6L582 187.6C596 173.1 595.3 149.2 579.8 135.7H579.8z" fill="currentColor" opacity="0.4"></path></svg>
                        <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;color: white"> CASSINO</p>
                    </div>
                    <div
                    
                        class="flex-row w-[100%] items-center px-2 py-3 gap-2 flex justify-center texto-esportes tirar-esporte">
                        <a  v-if="custom.esportes" :href="custom.esportes" style="display: flex;align-items: center" >
                        <svg height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M355.5 45.53L342.4 14.98c-27.95-9.983-57.18-14.98-86.42-14.98c-29.25 0-58.51 4.992-86.46 14.97L156.5 45.53l99.5 55.13L355.5 45.53zM86.78 96.15L53.67 99.09c-34.79 44.75-53.67 99.8-53.67 156.5L.0001 256c0 2.694 .0519 5.379 .1352 8.063l24.95 21.76l83.2-77.67L86.78 96.15zM318.8 336L357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336zM512 255.6c0-56.7-18.9-111.8-53.72-156.5L425.6 96.16L403.7 208.2l83.21 77.67l24.92-21.79C511.1 260.1 512 258.1 512 255.6zM51.77 367.7l-7.39 32.46c33.48 49.11 82.96 85.07 140 101.7l28.6-16.99l-48.19-103.3L51.77 367.7zM347.2 381.5l-48.19 103.3l28.57 17c57.05-16.66 106.5-52.62 140-101.7l-7.38-32.46L347.2 381.5z" fill="currentColor"></path><path d="M458.3 99.08L458.3 99.08L458.3 99.08zM511.8 264c-1.442 48.66-16.82 95.87-44.28 136.1l-7.38-32.46l-113 13.86l-48.19 103.3l28.22 16.84c-23.48 6.78-47.67 10.2-71.85 10.2c-23.76 0-47.51-3.302-70.58-9.962l28.23-17.06l-48.19-103.3l-113-13.88l-7.39 32.46c-27.45-40.19-42.8-87.41-44.25-136.1l24.95 21.76l83.2-77.67L86.78 96.15L53.67 99.09c29.72-38.29 69.67-67.37 115.2-83.88l.3613 .2684L156.5 45.53l99.5 55.13l99.5-55.13L342.4 14.98c45.82 16.48 86 45.64 115.9 84.11L425.6 96.16L403.7 208.2l83.21 77.67L511.8 264zM357.3 217.4L255.1 144L154.7 217.4l38.82 118.6L318.8 336L357.3 217.4z" fill="currentColor" opacity="0.4"></path></svg>
                        <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;"> ESPORTES</p>
                    </a>
                   

                    <div v-else style="margin-top: -5px;margin-bottom:-5px;"
                    
                    class="flex-row w-[100%] items-center px-2 flex justify-center texto-esportes tirar-esporte cursor-not-allowed">
                    <a class="cursor-not-allowed" style="display: flex;align-items: center" >
                        <svg style="margin-top: -3px;" height="1em" viewBox="0 0 448 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M384 192C419.3 192 448 220.7 448 256V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V256C0 220.7 28.65 192 64 192H384zM256 320C256 302.3 241.7 288 224 288C206.3 288 192 302.3 192 320V384C192 401.7 206.3 416 224 416C241.7 416 256 401.7 256 384V320z" fill="currentColor"></path><path d="M224 64C179.8 64 144 99.82 144 144V192H80V144C80 64.47 144.5 0 224 0C303.5 0 368 64.47 368 144V192H304V144C304 99.82 268.2 64 224 64z" fill="currentColor" opacity="0.4"></path></svg>
                    <p class="text-[16px] font-bold" style="font-size: .875rem;font-weight: 700;padding-left: 8px;"> ESPORTES</p>
                </a>
                </div>
                
            </div>
                </div>
            </div>
            

            <div
            :class="[
                sidebar === true ? 'lg:ml-[65px]' : 'lg:ml-[280px]',
            ]">
                <div class="mx-auto w-full" 
                style="max-width: 1110px">
                    <div class="flex items-center justify-between" style="align-items: center">
                        <div class="flex items-center justify-start" style="align-items: center">

                            

                        
                            <button id="open-side-nav" @click.prevent="toggleMenu" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg" style="margin: 0 auto ">
                                <span class="sr-only">Open sidebar</span>
                                <!-- <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                                </svg> -->
                                <svg height="22px" viewBox="0 0 448 512" width="22px" xmlns="http://www.w3.org/2000/svg"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" fill="#fff"></path></svg>
                            </button>

                            <a v-if="setting" href="/" class="flex md:ml-2 ml:1 md:mr-24 align-items">
                                <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden imagem-logo" />
                                <img :src="`/storage/`+setting.software_logo_white" alt=""  class="md:max-h-[35px] max-h-[30px] hidden dark:block imagem-logo" />
                                <a style="padding:3px;margin-left: 10px;padding-top:0px;max-height: 23px; border-radius: 3px;background-color: #BB7C1D;" href="">
                                    <i style="box-shadow: -1px 3px 11px 0px rgba(0,0,0,0.75);
-webkit-box-shadow: -1px 3px 11px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 3px 11px 0px rgba(0,0,0,0.75);" class="fa-duotone fa-gift fa-shake"></i>
                                </a>
                                <div>
                                  
                                </div>
                            </a>
                        </div>

                        <div v-if="!simple" class="flex items-center py-3">

                            <div v-if="!isAuthenticated" class="flex ml-5">
                                <button @click.prevent="registerToggle" style="color: #ACAFA7">
                                    Registre-se
                                </button>
                                <button @click.prevent="loginToggle" class="ui-button-blue ml-4 rounded flex flex-row items-center botao-entrar-mobile">
                                    <svg data-v-2b009606=""
                                    class="mr-2" height="1em" viewBox="0 0 512 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M344.7 273.5l-144.1 136c-6.975 6.578-17.2 8.375-26 4.594C165.8 410.3 160.1 401.6 160.1 392V320H32.02C14.33 320 0 305.7 0 288V224c0-17.67 14.33-32 32.02-32h128.1V120c0-9.578 5.707-18.25 14.51-22.05c8.803-3.781 19.03-1.984 26 4.594l144.1 136C354.3 247.6 354.3 264.4 344.7 273.5z" fill="currentColor"></path><path d="M416 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c17.67 0 32 14.33 32 32v256c0 17.67-14.33 32-32 32h-64c-17.67 0-32 14.33-32 32s14.33 32 32 32h64c53.02 0 96-42.98 96-96V128C512 74.98 469 32 416 32z" fill="currentColor" opacity="0.4"></path></svg>
                                    Entrar
                                </button>
                            </div>


                            <div v-if="isAuthenticated" class="flex items-center">
                                <MakeDeposit :showMobile="false" :title="$t('Depositar')" />
                                <WalletBalance />
                                
                                <!-- <LanguageSelector />
                                <DropdownDarkLight/> -->

                                <div class="flex items-center ml-3 margin-teste" >
                                    <div>
                                        <button type="button" class="flex text-sm bg-[white] rounded-full ui-button-blue3" aria-expanded="false" data-dropdown-toggle="dropdown-user2">
                                            <span class="sr-only">Open user menu</span>
                                            <img 
                                                :src="userData?.avatar ? `/storage/${userData.avatar}` : `/assets/images/profile.jpg`" 
                                                alt="avatar" 
                                                class="w-5 h-5 rounded-full"
                                            >
                                        </button>
                                
                                    
                                    
                                    </div>
                                    <div class="z-50 hidden text-left list-none bg-[white] rounded shadow" id="dropdown-user2" style="background-color: white;">
                                        
                                        <ul class="py-1 px-5 mt-3" role="none" >
                                            <li class="hover-menu">
                                                <RouterLink style="color: var(--title-color);" :to="{ name: 'profileWallet' }" active-class="profile-menu-active" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                                    <span class="">
                                                    <i class="fa-duotone fa-wallet pr-3"></i>
                                                    </span>
                                                   <p style="font-weight: bold"> Carteira</p> 
                                                </RouterLink>
                                            </li>
                                            <li class="hover-menu">
                                                <RouterLink style="color: var(--title-color);" :to="{ name: 'profileAffiliate' }" active-class="profile-menu-active" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                                                    <span class="pr-3">
                                                        <svg height="1em" viewBox="0 0 576 512" width="1em" xmlns="http://www.w3.org/2000/svg" active="true" aria-hidden="true" class="I9SFw"><path d="M444.4 310.4l-72.12 68.07c-3.49 3.291-8.607 4.191-13.01 2.299C354.9 378.9 352 374.6 352 369.8v-36.14H224v36.14c0 4.795-2.857 9.135-7.262 11.03c-4.406 1.895-9.523 .9941-13.01-2.297L131.6 310.4c-4.805-4.535-4.805-12.94 0-17.47L203.7 224.9C207.2 221.6 212.3 220.7 216.7 222.6C221.1 224.5 224 228.8 224 233.6v35.99h128V233.6c0-4.793 2.857-9.135 7.262-11.03c4.406-1.895 9.523-.9941 13.01 2.299l72.12 68.07C449.2 297.5 449.2 305.9 444.4 310.4z" fill="currentColor"></path><path d="M96 128c35.38 0 64-28.62 64-64S131.4 0 96 0S32 28.62 32 64S60.63 128 96 128zM128 160H64C28.65 160 0 188.7 0 224v96c0 17.67 14.33 32 31.1 32L32 480c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-96.39l-50.36-47.53C100.1 327.9 96 316.2 96 304.1c0-12.16 4.971-23.83 13.64-32.01l72.13-68.08c1.65-1.555 3.773-2.311 5.611-3.578C177.1 176.8 155 160 128 160zM480 128c35.38 0 64-28.62 64-64s-28.62-64-64-64s-64 28.62-64 64S444.6 128 480 128zM512 160h-64c-26.1 0-49.98 16.77-59.38 40.42c1.842 1.271 3.969 2.027 5.623 3.588l72.12 68.06C475 280.2 480 291.9 480 304.1c.002 12.16-4.969 23.83-13.64 32.01L416 383.6V480c0 17.67 14.33 32 32 32h64c17.67 0 32-14.33 32-32v-128c17.67 0 32-14.33 32-32V224C576 188.7 547.3 160 512 160z" fill="currentColor" opacity="0.4"></path></svg>
                                                    </span>
                                                   <p style="font-weight: bold"> {{ $t('Painel Afiliado') }}</p> 
                                                </RouterLink>
                                            </li>
                                            <li class="hover-menu">
                                                <a style="color: var(--title-color);" href="#" @click.prevent="profileToggle" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300" role="menuitem">
                                                    <span class="pr-3">
                                                        <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg" active="true" aria-hidden="true" class="I9SFw"><path d="M610.5 373.3c2.625-14 2.625-28.5 0-42.5l25.75-15c3-1.625 4.375-5.125 3.375-8.5c-6.75-21.5-18.25-41.13-33.25-57.38c-2.25-2.5-6-3.125-9-1.375l-25.75 14.88c-10.88-9.25-23.38-16.5-36.88-21.25V212.3c0-3.375-2.5-6.375-5.75-7c-22.25-5-45-4.875-66.25 0c-3.25 .625-5.625 3.625-5.625 7v29.88c-13.5 4.75-26 12-36.88 21.25L394.4 248.5c-2.875-1.75-6.625-1.125-9 1.375c-15 16.25-26.5 35.88-33.13 57.38c-1 3.375 .3751 6.875 3.25 8.5l25.75 15c-2.5 14-2.5 28.5 0 42.5l-25.75 15c-3 1.625-4.25 5.125-3.25 8.5c6.625 21.5 18.13 41 33.13 57.38c2.375 2.5 6 3.125 9 1.375l25.88-14.88c10.88 9.25 23.38 16.5 36.88 21.25v29.88c0 3.375 2.375 6.375 5.625 7c22.38 5 45 4.875 66.25 0c3.25-.625 5.75-3.625 5.75-7v-29.88c13.5-4.75 26-12 36.88-21.25l25.75 14.88c2.875 1.75 6.75 1.125 9-1.375c15-16.25 26.5-35.88 33.25-57.38c1-3.375-.3751-6.875-3.375-8.5L610.5 373.3zM496 400.5c-26.75 0-48.5-21.75-48.5-48.5s21.75-48.5 48.5-48.5c26.75 0 48.5 21.75 48.5 48.5S522.8 400.5 496 400.5z" fill="currentColor"></path><path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM425.1 491.8v-9.172c-2.303-1.25-4.572-2.559-6.809-3.93l-7.818 4.493c-6.002 3.504-12.83 5.352-19.75 5.352c-10.71 0-21.13-4.492-28.97-12.75c-18.41-20.09-32.29-44.15-40.22-69.9c-5.352-18.06 2.343-36.87 17.83-45.24l8.018-4.669c-.0664-2.621-.0664-5.242 0-7.859l-7.655-4.461c-12.3-6.953-19.4-19.66-19.64-33.38C305.6 306.3 290.4 304 274.7 304H173.3C77.61 304 0 381.7 0 477.4C0 496.5 15.52 512 34.66 512H413.3c5.727 0 10.9-1.727 15.66-4.188C426.7 502.8 425.1 497.5 425.1 491.8z" fill="currentColor" opacity="0.4"></path></svg>
                                                    </span>
                                                   <p style="font-weight: bold"> {{ $t('Dados da conta') }}</p> 
                                                </a>
                                            </li>

                                            <!--
                                            <li class="hover-menu">
                                                <a style="color: var(--title-color);" href="#" @click.prevent="profileToggle" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300" role="menuitem">
                                                    <span class="pr-3" >
                                                        <svg height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg" active="false" aria-hidden="true" class="I9SFw"><path d="M640 191.1v191.1c0 35.25-28.75 63.1-64 63.1h-32v54.24c0 7.998-9.125 12.62-15.5 7.873l-82.75-62.12L319.1 447.1C284.7 447.1 256 419.2 256 383.1v-31.98l96-.002c52.88 0 96-43.12 96-95.99V128h128C611.3 128 640 156.7 640 191.1z" fill="currentColor"></path><path d="M352 0H64C28.75 0 0 28.75 0 63.1V256C0 291.2 28.75 320 64 320l32 .0098v54.25c0 7.998 9.125 12.62 15.5 7.875l82.75-62.12L352 319.9c35.25 .125 64-28.68 64-63.92V63.1C416 28.75 387.3 0 352 0z" fill="currentColor" opacity="0.4"></path></svg>
                                                    </span>
                                                    <p style="font-weight: bold"> {{ $t('Suporte Ao Vivo') }}</p>
                                                </a>
                                            </li>
-->
                                            

                                            <div class="" style="height: 1px;background-color: #27292A;width: 100%;margin-top: 10px;margin-bottom: 10px"></div>
                                           
                                            <li class="sair-menu mb-3">
                                                <a style="color: var(--title-color);"  @click.prevent="logoutAccount" href="#" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300" role="menuitem">
                                                    <span class="">
                                                    <i class="fa-duotone fa-right-from-bracket pr-3"></i>
                                                    </span>
                                                    <p> Sair</p> 
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
        <transition name="fade">
            <div style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);
  backdrop-filter: none;height: 100vh;" v-if="showSearchMenu" class="fixed left-0 right-0 bottom-0 flex items-center justify-center mx-auto w-full">
                <div @click="toggleSearch" class="absolute inset-0 opacity-50 cursor-pointer" ></div>

                <!-- Start searchbar action -->
                
                <div class="search-menu mx-auto w-full p-4">
                    <a class="login-register-x" @click.prevent="toggleSearch" href="">
                                <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px;max-width: 40px">
                                <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                </div>
                            </a>
                    <div class="mb-5 w-full mx-auto w-full p-4">
                       
                        <div class=" mx-auto">
                            <div class="flex flex-col">
                               
                                <div class="relative w-full">
                                    <input style="-webkit-box-shadow: 0px 0px 14px -22px rgba(43,43,43,1);-moz-box-shadow: 0px 0px 14px -22px rgba(43,43,43,1);box-shadow: 0px 0px 14px -22px rgba(43,43,43,1);background-color: var(--ci-gray-dark);border-radius: 3px;font-size: 14px;padding-left: 40px;padding-top: 5px;padding-bottom: 5px;"  type="search"
                                           v-model.lazy="searchTerm"
                                           class="block p-2.5 w-full z-20 text-sm text-gray-900 dark:placeholder-gray-400 dark:text-white placeholder-search p-2.5 lg:p-0 search-mobile"
                                           placeholder="Pesquise um nome de cassino..."
                                           required>

                                    <button v-if="searchTerm.length > 0" @click.prevent="clearData" type="button" class="absolute end-0 h-full p-2.5 text-sm font-medium text-white">
                                    
                                    </button>
                                </div>
                                <div class="text-center mt-4 justify-center p-2" style="background-color: #383028;border-radius: 5px;">
                                    
                    <h3 style="color: #FF9F43;font-size: .75rem;">Mínimo 3 caracteres</h3>
               
                                </div>
                            </div>

                            <div v-if="!isLoadingSearch" class="mt-8 grid grid-cols-4 md:grid-cols-12 gap-4 py-5">
                                <CassinoGameCard
                                    v-if="games"
                                    v-for="(game, index) in games?.data"
                                    :index="index"
                                    :title="game.game_name"
                                    :cover="game.cover"
                                    :gamecode="game.game_code"
                                    :type="game.distribution"
                                    :game="game"
                                />
                            </div>
                            <div v-else class="relative items-center block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white opacity-20">Noteworthy technology acquisitions 2021</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400 opacity-20">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
                                <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                    <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End searchbar action -->


            </div>
        </transition>

    </nav>

    <div style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);
  backdrop-filter: none;height: 100vh;" id="modalElAuth" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 hidden w-full overflow-x-hidden overflow-y-auto  h-screen md:h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full rounded-lg" style="background-color: none;border-radius: 5px;">
            <div class="flex md:justify-between" >
     
            
                </div>
                <div class="w-full relative p-5 login-register-100vh" >
                    <div v-if="isLoadingLogin" class="absolute top-0 left-0 right-0 bottom-0 z-[999]">
                        <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                            <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <form @submit.prevent="loginSubmit" method="post" action="" class="padding-register" style="padding-top: 15px;">

                        
                        <div style="display: flex;align-items: center;justify-content: space-between;margin-top: -17px;padding-bottom: 20px;">
                            <div style="display: flex;align-items: center;margin: 0 auto;text-align:center;gap:20px;">
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="margin-left: 35px;"><a style="color: var(--ci-primary-color)" href="" @click.prevent=""><strong style="font-weight: 500;">Entrar</strong></a></p>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style=""><a style="color: white" href="" @click.prevent="hideLoginShowRegisterToggle"><strong style="color: white;font-weight: 500;">Registrar</strong></a></p>
                    </div>
                
                        
                            <h5 class="font-bold text-xl"></h5>
                            <a class="login-register-x" @click.prevent="loginToggle" href="">
                                <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px">
                                <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                </div>
                            </a>
                        
                   
                    </div>
                    <div class="tirar-div" style="width: 100%;height: 1px;background-color: #383A3B;margin-bottom: 20px;"></div>

                    <div style="display: flex;justify-content: center;margin: 0 auto;margin-bottom: 20px">
                    <a v-if="setting" class="flex md:ml-2 ml:1 md:mr-24" style="display: flex;justify-content: center;margin: 0 auto;">
                        <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden " />
                        <img :src="`/storage/`+setting.software_logo_white" alt=""  class="md:max-h-[35px] max-h-[30px] hidden dark:block" />
                    </a>
                </div>

                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                
                            </div>
                            <input style="padding: 17px 0px;padding-left: 20px;outline: none;border: none;background-color: var(--input-primary);" required type="text" v-model="loginForm.email" name="email" class="input-group" :placeholder="$t('E-mail')">
                        </div>

                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                              
                            </div>
                            <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" required :type="typeInputPassword"
                                   v-model="loginForm.password"
                                   name="password"
                                   class="input-group pr-[40px]"
                                   :placeholder="$t('Senha')">
                            <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5 ">
                                

                                <svg v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"  data-v-9b35dc4c="" height="1em" viewBox="0 0 576 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256z" fill="currentColor"></path><path d="M95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400z" fill="currentColor" opacity="0.4"></path></svg>
                              


                                <svg v-if="typeInputPassword === 'password'" class="fa-regular fa-eye" data-v-9b35dc4c="" height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M5.112 9.196C13.29-1.236 28.37-3.065 38.81 5.112L630.8 469.1C641.2 477.3 643.1 492.4 634.9 502.8C626.7 513.2 611.6 515.1 601.2 506.9L9.196 42.89C-1.236 34.71-3.065 19.63 5.112 9.196V9.196z" fill="currentColor"></path><path d="M446.6 324.7C457.7 304.3 464 280.9 464 256C464 176.5 399.5 112 320 112C282.7 112 248.6 126.2 223.1 149.5L150.7 92.77C195 58.27 251.8 32 320 32C400.8 32 465.5 68.84 512.6 112.6C559.4 156 590.7 207.1 605.5 243.7C608.8 251.6 608.8 260.4 605.5 268.3C592.1 300.6 565.2 346.1 525.6 386.7L446.6 324.7zM313.4 220.3C317.6 211.8 320 202.2 320 192C320 180.5 316.1 169.7 311.6 160.4C314.4 160.1 317.2 160 320 160C373 160 416 202.1 416 256C416 269.7 413.1 282.7 407.1 294.5L313.4 220.3zM320 480C239.2 480 174.5 443.2 127.4 399.4C80.62 355.1 49.34 304 34.46 268.3C31.18 260.4 31.18 251.6 34.46 243.7C44 220.8 60.29 191.2 83.09 161.5L177.4 235.8C176.5 242.4 176 249.1 176 256C176 335.5 240.5 400 320 400C338.7 400 356.6 396.4 373 389.9L446.2 447.5C409.9 467.1 367.8 480 320 480H320z" fill="currentColor" opacity="0.4"></path></svg>
                            </button>
                        </div>
                        <div style="display: flex;justify-content: flex-end;">
                        <a style="color:var(--ci-primary-color);color: #97999A;font-size: 12px;margin-top: -15px;font-weight: 500" href="/forgot-password" class="text-white text-sm">{{ $t('Esqueceu sua senha?') }}</a>
                    </div>
                    
                        <div class="mt-3 w-full flex items-center">
                            <button style="font-size: 17px;color: var(--title-color);font-weight: 600;padding: 12px;width: 100%;margin: 0 auto;margin-top:20px;color: var(--title-color);" type="submit" class="ui-button-blue w-full mb-3">
                                {{ $t('Log in') }}
                            </button>
                        </div>
                        <div></div>

                        <p style="text-align: center;padding-top: 20px;font-size: 12px;color: white;font-weight: 500;" class="text-sm text-gray-500 dark:text-gray-300 mb-6"><a  href="" @click.prevent="hideLoginShowRegisterToggle">Ainda não tem uma conta? <strong style="color:var(--ci-primary-color);font-weight: 500;">Criar uma conta grátis</strong></a></p>
                    </form>

                  

                      
                 
                </div>
            </div>
        </div>

        <div style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);
  backdrop-filter: none;height: 100vh;" id="modalElRegister" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full">
            <div v-if="isLoadingRegister" class="absolute top-0 left-0 right-0 bottom-0 z-[999]">
                <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                    <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="flex md:justify-between h-full">
            
                <div class="w-full relative p-5 m-auto login-register-100vh">
                    <form @submit.prevent="registerSubmit" method="post" action="" class="padding-register">

                        
                        <div style="display: flex;align-items: center;justify-content: space-between;padding-bottom: 20px;">
                            <div style="display: flex;align-items: center;margin: 0 auto;text-align:center;gap:20px;">
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="margin-left: 35px;"><a style="color: white" href="" @click.prevent="hideLoginShowRegisterToggle"><strong style="font-weight: 500;">Entrar</strong></a></p>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style=""><a style="color: var(--ci-primary-color)" ><strong style="color: white;font-weight: 500;color: var(--ci-primary-color)">Registrar</strong></a></p>
                    </div>
                
                  
                  
                    <!--copiar para fechar modal-->
                            <a class="login-register-x" @click.prevent="hideRegisterShowCupomToggle" href="">
                                <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px">
                                <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                </div>
                            </a>
                    <!--fim copiar para fechar modal-->
                   
                    </div>
                    <div class="tirar-div" style="width: 100%;height: 1px;background-color: #383A3B;margin-bottom: 20px;"></div>

                    <div style="display: flex;justify-content: center;margin: 0 auto;margin-bottom: 20px">
                    <a v-if="setting" class="flex md:ml-2 ml:1 md:mr-24 items-center" style="display: flex;justify-content: center;margin: 0 auto;">
                        <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden " />
                        <img :src="`/storage/`+setting.software_logo_white" alt=""  class="md:max-h-[35px] max-h-[30px] hidden dark:block" />
                    </a>
                </div>

                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            
                            </div>
                            <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" type="text"
                                   name="name"
                                   v-model="registerForm.name"
                                   class="input-group"
                                   :placeholder="$t('Nome')"
                                   required
                            >
                        </div>

                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        
                            </div>
                            <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" type="email"
                                   name="email"
                                   v-model="registerForm.email"
                                   class="input-group"
                                   :placeholder="$t('E-mail')"
                                   required
                            >
                        </div>

                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                
                            </div>
                            <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" :type="typeInputPassword"
                                   name="password"
                                   v-model="registerForm.password"
                                   class="input-group pr-[40px]"
                                   :placeholder="$t('Senha')"
                                   required
                            >
                            <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5 ">
                                <svg v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"  data-v-9b35dc4c="" height="1em" viewBox="0 0 576 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256z" fill="currentColor"></path><path d="M95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400z" fill="currentColor" opacity="0.4"></path></svg>
                              


                              <svg v-if="typeInputPassword === 'password'" class="fa-regular fa-eye" data-v-9b35dc4c="" height="1em" viewBox="0 0 640 512" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M5.112 9.196C13.29-1.236 28.37-3.065 38.81 5.112L630.8 469.1C641.2 477.3 643.1 492.4 634.9 502.8C626.7 513.2 611.6 515.1 601.2 506.9L9.196 42.89C-1.236 34.71-3.065 19.63 5.112 9.196V9.196z" fill="currentColor"></path><path d="M446.6 324.7C457.7 304.3 464 280.9 464 256C464 176.5 399.5 112 320 112C282.7 112 248.6 126.2 223.1 149.5L150.7 92.77C195 58.27 251.8 32 320 32C400.8 32 465.5 68.84 512.6 112.6C559.4 156 590.7 207.1 605.5 243.7C608.8 251.6 608.8 260.4 605.5 268.3C592.1 300.6 565.2 346.1 525.6 386.7L446.6 324.7zM313.4 220.3C317.6 211.8 320 202.2 320 192C320 180.5 316.1 169.7 311.6 160.4C314.4 160.1 317.2 160 320 160C373 160 416 202.1 416 256C416 269.7 413.1 282.7 407.1 294.5L313.4 220.3zM320 480C239.2 480 174.5 443.2 127.4 399.4C80.62 355.1 49.34 304 34.46 268.3C31.18 260.4 31.18 251.6 34.46 243.7C44 220.8 60.29 191.2 83.09 161.5L177.4 235.8C176.5 242.4 176 249.1 176 256C176 335.5 240.5 400 320 400C338.7 400 356.6 396.4 373 389.9L446.2 447.5C409.9 467.1 367.8 480 320 480H320z" fill="currentColor" opacity="0.4"></path></svg>
                            </button>
                        </div>


                        <div class="mb-3 mt-5">
                            <button @click.prevent="isReferral = !isReferral" type="button" class="flex justify-center w-full">
                                <p style="color:white;font-size: 12px">{{ $t('Código de referência') }}</p>
                                <div class="">
                             
                                </div>
                            </button>

                            <div v-if="isReferral" class="relative mb-3 mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                 
                                </div>
                                <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" type="text" name="name" v-model="registerForm.reference_code" class="input-group" :placeholder="$t('Code')">
                            </div>
                        </div>

    

                     
                        <p style="text-align: center;font-size: 10px;color: white;font-weight: lighter;margin-bottom: -14px" class="text-sm text-gray-500 dark:text-gray-300 mb-6"><a @click="$router.push('/terms/service')" href="" >Ao se registrar <strong style="color:var(--ci-primary-color);font-weight: lighter;">você concorda com nossos termos e condições</strong></a></p>
            
                        <div class="mt-5 w-full flex flex-col items-center">
                            <button style="color: var(--title-color);font-size: 17px;font-weight: 600;padding: 12px;width: 100%;margin: 0 auto;color: var(--title-color);" type="submit" class="ui-button-blue w-full mb-3">
                               Criar conta <i class="fa-solid fa-arrow-right"></i>
                            </button>
                            <p style="text-align: center;padding-top: 20px;font-size: 12px;color: white;font-weight: 500;" class="text-sm text-gray-500 dark:text-gray-300 mb-6"><a  href="" @click.prevent="hideLoginShowRegisterToggle">Já uma conta? <strong style="color:var(--ci-primary-color);font-weight: 500;">Entrar</strong></a></p>
                

                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </div>

    <div style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);
  backdrop-filter: none;height: 100vh;" id="modalcupom" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-3xl max-h-full">
            <div v-if="isLoadingRegister" class="absolute top-0 left-0 right-0 bottom-0 z-[999]">
                <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                    <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="flex md:justify-between h-full">
            
                <div class="w-full relative p-5 m-auto login-register-100vh">
                    <form @submit.prevent="registerSubmit" method="post" action="" class="padding-register">

                        
                        <div style="display: flex;align-items: center;justify-content: space-between;padding-bottom: 20px;">
                            <div style="display: flex;align-items: center;margin: 0 auto;text-align:center;gap:20px;">
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="margin-left: 35px;"><a style="color: white" href="" @click.prevent="hideLoginShowRegisterToggle"><strong style="font-weight: 500;">Entrar</strong></a></p>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style=""><a style="color: var(--ci-primary-color)" ><strong style="color: white;font-weight: 500;color: var(--ci-primary-color)">Registrar</strong></a></p>
                    </div>
                
                  
                  
                    <!--copiar para fechar modal-->
                            <a class="login-register-x" @click.prevent="modalcupomToggle" href="">
                                <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px">
                                <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                </div>
                            </a>
                    <!--fim copiar para fechar modal-->
                   
                    </div>
                   
                    
                    <p style="text-align: center;font-size: 30px;padding-bottom: 30px">Tem certeza que deseja cancelar seu registro?</p>

                    <p style="text-align: center;font-size: 14px;padding-bottom: 30px">100% em bônus de depósito esperam por você.</p>
                    <div style="display: flex;flex-direction: column;justify-content: center;gap: 10px;align-items: center;width: 100%;">

                    <button style="color: white;color: var(--title-color);padding-bottom: 30px;font-size: 18px;width: 100%;;padding: 12px;border-radius: 3px;background-color: var(--ci-primary-color);" href="" @click.prevent="hideCupomShowRegisterToggle">Continuar</button>
                     
                    <a style="color: white;opacity: .5;padding-top: 20px" href="" @click.prevent="modalcupomToggle"><strong style="font-weight: 500;">Sim, quero cancelar</strong></a>
                </div>
                      
                        

                      



    

                     
            
                    </form>

                   
                </div>
            </div>
        </div>
    </div>

    <div id="modalProfileEl" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-screen md:h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl md:max-w-lg max-h-full rounded-lg shadow-2xl transform transition-all duration-300 ease-in-out">
        <!-- Loading Overlay -->
        <div v-if="isLoadingProfile" class="absolute inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center rounded-lg">
            <div class="animate-pulse">
                <i class="fa-duotone fa-spinner-third fa-spin text-5xl text-primary"></i>
            </div>
        </div>

        <!-- Profile Content -->
        <div v-else class="bg-gradient-to-b from-gray-900 to-gray-800 rounded-lg">
            <!-- Header -->
            <div class="relative h-32 bg-gradient-to-r from-primary/80 to-primary rounded-t-lg">
                <button @click="profileToggle" class="absolute top-4 right-4 p-2 rounded-full bg-black/20 hover:bg-black/40 transition-colors">
                    <i class="fa-light fa-x text-white"></i>
                </button>
            </div>

            <!-- Avatar Section -->
            <div class="relative -mt-16 px-6">
                <div class="flex justify-center">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-full border-4 border-gray-800 overflow-hidden transition-transform duration-300 ease-in-out transform group-hover:scale-105">
                            <img 
                                :src="avatarPreview || (userData?.avatar ? '/storage/'+userData.avatar : '/assets/images/profile.jpg')" 
                                class="w-full h-full object-cover"
                                :class="{'animate-pulse': isUploadingAvatar}"
                            >
                        </div>
                        <div @click="openFileInput" class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center cursor-pointer">
                            <i class="fa-duotone fa-camera-retro text-2xl text-white"></i>
                        </div>
                        <input 
                            ref="fileInput" 
                            type="file" 
                            accept="image/*" 
                            class="hidden" 
                            @change="handleFileChange"
                        >
                    </div>
                </div>

                <!-- Name Edit -->
                <div class="mt-4 text-center">
                    <div class="relative inline-block">
                        <input 
                            v-model="profileName"
                            @blur="updateName"
                            :readonly="!readonly"
                            class="text-2xl font-bold bg-transparent text-center border-b-2 border-transparent focus:border-primary outline-none transition-all duration-300"
                            :class="{'hover:border-gray-600': !readonly}"
                        >
                        <button 
                            @click="readonly = !readonly"
                            class="ml-2 p-2 rounded-full hover:bg-gray-700/50 transition-colors"
                        >
                            <i :class="readonly ? 'fa-solid fa-check text-green-500' : 'fa-light fa-pen text-gray-400'"></i>
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
                        <p class="stats-value">{{ totalEarnings }}</p>
                    </div>
                    
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fa-duotone fa-dice text-blue-500"></i>
                        </div>
                        <p class="stats-label">{{ $t('Total bets') }}</p>
                        <p class="stats-value">{{ totalBets }}</p>
                    </div>
                    
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fa-duotone fa-coins text-green-500"></i>
                        </div>
                        <p class="stats-label">{{ $t('Total bet') }}</p>
                        <p class="stats-value">{{ sumBets }}</p>
                    </div>
                </div>
            </div>

            <!-- Account Info -->
            <div class="p-6 border-t border-gray-700">
                <p class="text-center text-gray-400">
                    <i class="fa-regular fa-clock mr-2"></i>
                    {{ $t('Account created') }} {{ profileUser.dateHumanReadable }}
                </p>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import { RouterLink, useRoute } from "vue-router";
import { sidebarStore } from "@/Stores/SideBarStore.js";
import { Modal } from 'flowbite';
import { useAuthStore } from "@/Stores/Auth.js";
import { useToast } from "vue-toastification";
import { useRouter } from 'vue-router';
import { onMounted, ref, watch, watchEffect } from "vue";
import { storeToRefs } from 'pinia'

import DropdownDarkLight from "@/Components/UI/DropdownDarkLight.vue";
import LanguageSelector from "@/Components/UI/LanguageSelector.vue";
import WalletBalance from "@/Components/UI/WalletBalance.vue";
import HttpApi from "@/Services/HttpApi.js";
import MakeDeposit from "@/Components/UI/MakeDeposit.vue";
import {useSettingStore} from "@/Stores/SettingStore.js";
import {searchGameStore} from "@/Stores/SearchGameStore.js";
import CassinoGameCard from "@/Pages/Cassino/Components/CassinoGameCard.vue";

export default {
    props: ['simple'],
    components: {CassinoGameCard, MakeDeposit, WalletBalance, LanguageSelector, DropdownDarkLight, RouterLink },
    data() {
        return {
            sidebar:  /iPhone|iPad|iPod|Android/i.test(navigator.userAgent) ? false : (localStorage.getItem('sidebarStatus') ? JSON.parse(localStorage.getItem('sidebarStatus')) : false),
            showNavtop:  true,
            isLoadingLogin: false,
            isLoadingRegister: false,
            isReferral: false,
            modalAuth: null,
            modalRegister: null,
            modalProfile: null,
            modalcupom: null,
            typeInputPassword: 'password',
            readonly: false,
            profileUser: null,
            custom: null,
            modalDepositNav: null,
            loginForm: {
                email: '',
                password: '',
            },
            registerForm: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                reference_code: '',
                term_a: false,
                agreement: false,
            },
            avatarUrl: '/assets/images/profile.jpg',
            isLoadingProfile: false,
            profileName: '',
            sumBets: 0,
            totalBets: 0,
            totalEarnings: 0,
            showSearchMenu: false,
            games: null,
            searchTerm: '',
            isLoadingSearch: true,
            avatarPreview: null,
            isUploadingAvatar: false,
        }
    },
    setup() {
        const authStore = useAuthStore()
        const { user: userData } = storeToRefs(authStore)
        return { authStore, userData }
    },
    computed: {
        searchGameDataStore() {
            return searchGameStore();
        },
        searchGameMenu() {
            const search = searchGameStore();
            return search.getSearchGameStatus;
        },
        sidebarMenuStore() {
            return sidebarStore();
        },
        sidebarMenu() {
            const sidebar = sidebarStore()
            return sidebar.getSidebarStatus;
        },
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        setting() {
            const authStore = useSettingStore();
            return authStore.setting;
        }
    },
    unmounted() {

    },
    mounted() {
        
        /*
        * $targetEl: required
        * options: optional
        */
        this.modalProfile = new Modal(document.getElementById('modalProfileEl'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
            closable: false,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            }
        });

        /*
        * $targetEl: required
        * options: optional
        */
        this.modalAuth = new Modal(document.getElementById('modalElAuth'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
            closable: false,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            }
        });

        /*
       * $targetEl: required
       * options: optional
       */
        this.modalRegister = new Modal(document.getElementById('modalElRegister'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
            closable: false,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            }
        });
    this.modalcupom = new Modal(document.getElementById('modalcupom'), {
            placement: 'center',
            backdrop: 'dynamic',
            backdropClasses: 'bg-black/80 fixed inset-0 z-40 backdrop-blur-md',
            closable: false,
            onHide: () => {

            },
            onShow: () => {

            },
            onToggle: () => {

            }
        });
    },
    methods: {
        getSetting: function() {
                const _this = this;
                const settingStore = useSettingStore();
                const settingData = settingStore.setting;

                if(settingData) {
                    _this.setting = settingData;
                }
            },
        toggleSearch: function() {
            this.searchGameDataStore.setSearchGameToogle();
        },
        redirectSocialTo: function() {
            return '/auth/redirect/google'
        },
        like: async function(id) {
            const _this = this;
            const _toast = useToast();
            await HttpApi.post('/profile/like/' + id, {})
                .then(response => {

                    _this.getProfile();
                    _toast.success(_this.$t(response.data.message));
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                });
        },
        updateName: async function(event) {
            const _this = this;
            _this.isLoadingProfile = true;

            await HttpApi.post('/profile/updateName', { name: _this.profileName })
                .then(response => {
                    _this.isLoadingProfile = false;
                })
                .catch(error => {
                    const _this = this;
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {

                    });
                    _this.isLoadingProfile = false;
                });
        },
        togglePassword: function() {
            if(this.typeInputPassword === 'password') {
                this.typeInputPassword = 'text';
            }else{
                this.typeInputPassword = 'password';
            }
        },
        loginSubmit: function(event) {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingLogin = true;
            const authStore = useAuthStore();

            HttpApi.post('auth/login', _this.loginForm)
                .then(async response => {
                    await new Promise(r => {
                        setTimeout(() => {
                            authStore.setToken(response.data.access_token);
                            authStore.setUser(response.data.user);
                            authStore.setIsAuth(true);

                            _this.loginForm = {
                                email: '',
                                password: '',
                            }

                            _this.modalAuth.toggle();
                            _toast.success(_this.$t('You have been authenticated, welcome!'));

                            _this.isLoadingLogin = false;

                            if(_this.isCasinoPlayPage) {
                                location.reload();
                            }
                        }, 1000)
                    });
                })
                .catch(error => {
                    const _this = this;
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingLogin = false;
                });
        },
        registerSubmit: async function(event) {
            const _this = this;
            const _toast = useToast();
            _this.isLoadingRegister = true;

            const authStore = useAuthStore();
            await HttpApi.post('auth/register', _this.registerForm)
                .then(response => {
                    if(response.data.access_token !== undefined) {
                        authStore.setToken(response.data.access_token);
                        authStore.setUser(response.data.user);
                        authStore.setIsAuth(true);

                        _this.registerForm = {
                            name: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                            reference_code: '',
                            term_a: false,
                            agreement: false,
                        }

                        _this.modalRegister.toggle();
                        _this.router.push({ name: 'home' });
                        _toast.success(_this.$t('Your account has been created successfully'));

                        if(_this.isCasinoPlayPage){
                            location.reload();
                        }else{
                            setTimeout(() => {

                                this.modalDepositNav = new Modal(document.getElementById('modalElDeposit'), {
                                    placement: 'center',
                                    backdrop: 'dynamic',
                                    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-1 backmodaldeposit', 
                                    closable: true,
                                    onHide: () => {
                                        this.paymentType = null;
                                        const divsToDelete = document.querySelectorAll('.backmodaldeposit');
                                        if (divsToDelete.length > 0) {
                                            divsToDelete.forEach(div => {
                                            div.remove();
                                            });
                                        }
                                    },
                                    onShow: () => {

                                    },
                                    onToggle: () => {
                                    },
                                });

                                this.modalDepositNav.toggle();
                                
                            }, 2000);
                        }

                    }

                    _this.isLoadingRegister = false;
                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        _toast.error(`${value}`);
                    });
                    _this.isLoadingRegister = false;
                });
        },
        logoutAccount: function() {
            const authStore = useAuthStore();
            const _toast = useToast();

            HttpApi.post('auth/logout', {})
                .then(response => {
                    authStore.logout();
                    this.router.push({ name: 'home' });

                    _toast.success(this.$t('You have been successfully disconnected'));

                })
                .catch(error => {
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {
                        console.log(value);
                        //_toast.error(`${value}`);
                    });
                });
        },
        hideLoginShowRegisterToggle: function() {
            this.modalAuth.toggle();
            this.modalRegister.toggle();
        },
        hideRegisterShowCupomToggle: function() {
            this.modalRegister.toggle();
            this.modalcupom.toggle();
        },
        hideCupomShowRegisterToggle: function() {
            this.modalcupom.toggle();
            this.modalRegister.toggle();
        },
        hideRegisterShowLoginToggle: function() {
            this.modalRegister.toggle();
            this.modalAuth.toggle();
        },
        toggleMenu: function() {
            this.sidebarMenuStore.setSidebarToogle();
        },
        loginToggle: function() {
            this.modalAuth.toggle();
        },
        registerToggle: function() {
            this.modalRegister.toggle();
        },
        modalcupomToggle: function() {
            this.modalcupom.toggle();
        },
        profileToggle: function() {
            this.modalProfile.toggle();
        },
        openFileInput() {
            this.$refs.fileInput.click();
        },
        async handleFileChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.isUploadingAvatar = true;

            const formData = new FormData();
            formData.append('avatar', file);

            try {
                const response = await HttpApi.post('/profile/upload-avatar', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                // Atualiza o store
                this.authStore.setUser({
                    ...this.userData,
                    avatar: response.data.avatar
                });
                    
                const toast = useToast();
                toast.success('Avatar atualizado com sucesso! Atualize a página para visualizar as alterações.');
            } catch (error) {
                console.error('Erro ao atualizar avatar:', error);
                const toast = useToast();
                toast.error('Erro ao atualizar avatar');
            } finally {
                this.isUploadingAvatar = false;
            }
        },
        async updateName() {
            if (!this.readonly || this.profileName === this.userData?.name) return;

            try {
                // Remove o /api do início já que HttpApi já inclui isso na baseURL
                const response = await HttpApi.post('/profile/updateName', {
                    name: this.profileName
                });

                // Atualiza o store com o novo nome
                this.authStore.setUser({
                    ...this.userData,
                    name: this.profileName
                });

                const toast = useToast();
                toast.success('Nome atualizado com sucesso!');
            } catch (error) {
                console.error('Erro ao atualizar nome:', error);
                const toast = useToast();
                toast.error('Erro ao atualizar nome');
                this.profileName = this.userData?.name;
            } finally {
                this.readonly = false;
            }
        },
        // Método para inicializar o nome quando o modal é aberto
        initializeProfile() {
            this.profileName = this.userData?.name || '';
            this.avatarPreview = this.userData?.avatar ? `/storage/${this.userData.avatar}` : '/assets/images/profile.jpg';
        },
        getProfile: async function() {
            const _this = this;
            _this.isLoadingProfile = true;

            await HttpApi.get('/profile/')
                .then(response => {
                    _this.sumBets = response.data.sumBets;
                    _this.totalBets = response.data.totalBets;
                    _this.totalEarnings = response.data.totalEarnings;

                    const user = response.data.user;

                    if(user?.avatar != null) {
                        _this.avatarUrl = '/storage/'+user.avatar;
                    }

                    _this.profileName = user.name;
                    _this.profileUser = user;
                    _this.isLoadingProfile = false;
                })
                .catch(error => {
                    const _this = this;
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {

                    });
                    _this.isLoadingProfile = false;
                });
        },
        getSearch: async function() {
            const _this = this;

            await HttpApi.get('/search/games?searchTerm='+this.searchTerm)
                .then(response => {
                    _this.games = response.data.games;
                    _this.isLoadingSearch = false;
                })
                .catch(error => {
                    const _this = this;
                    Object.entries(JSON.parse(error.request.responseText)).forEach(([key, value]) => {

                    });
                    _this.isLoadingSearch = false;
                });
        },
        clearData: async function() {
            this.searchTerm = '';
            await this.getSearch();
        }
    },
    async created() {
        this.getSetting();
        this.custom = custom;
        if(this.isAuthenticated) {
            await this.getProfile();
        }

        if(this.isCasinoPlayPage) {
            this.showNavtop = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent) ? false : true;
        }


    },
    watch: {
        sidebarMenu(newVal, oldVal) {
            this.sidebar = newVal;
        },
        searchTerm(newValue, oldValue) {
            this.getSearch();
        },
        async searchGameMenu(newValue, oldValue) {

            await this.getSearch();
            this.showSearchMenu = !this.showSearchMenu;
        },
        'userData': {
            handler(newValue) {
                if (newValue) {
                    this.initializeProfile();
                }
            },
            immediate: true
        }
    },
};
</script>

<style scoped>
.item-game-container {
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* Alinhamento à esquerda do contêiner da bolinha */
}

.online-indicator {
  margin-top: 5px;
  color: white;
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Alinhamento à esquerda dos itens dentro do indicador */
}

.pulse2 {
  position: absolute;
  right: 0;
  bottom: 8%;
  margin-left: 12px; /* Ajuste conforme necessário para alinhar com o card */
  width: 10px;
  height: 10px;
  background-color: #00ff00;
  border-radius: 50%;
  margin-right: 3px;
  box-shadow: 0 0 5px #00ff00, 0 0 20px #00ff00;
}

</style>
