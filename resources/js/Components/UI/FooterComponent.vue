<template>
  <footer class="footer-component bg-gray-800 py-8 md:py-12">
    <div class="container mx-auto px-4">
      <!-- Selo Ministério da Fazenda -->
      <div class="flex justify-center mb-8 md:mb-16">
        <div class="relative group">
          <div class="absolute -inset-1 bg-gradient-to-r from-yellow-400/20 to-green-500/20 rounded-lg blur opacity-20 group-hover:opacity-40 transition duration-700"></div>
          <img
            :src="sealImage"
            alt="Aprovado pelo Ministério da Fazenda"
            class="relative h-16 md:h-20 w-auto object-contain transform group-hover:scale-105 transition-transform duration-300"
            loading="lazy"
          />
        </div>
      </div>

      <!-- Grid de Links -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 mb-8 md:mb-12">
        <!-- Coluna Aposte -->
        <div class="p-4 md:p-6 rounded-lg bg-gray-900/30 hover:bg-gray-900/50 transition-colors duration-300">
          <h3 class="text-white font-bold mb-3 md:mb-4 border-b border-gray-700 pb-2">Aposte</h3>
          <ul class="space-y-1.5 md:space-y-2">
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Jogos Slots</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Jogos ao Vivo</a></li>
          </ul>
        </div>

        <!-- Coluna Comunidade -->
        <div class="p-4 md:p-6 rounded-lg bg-gray-900/30 hover:bg-gray-900/50 transition-colors duration-300">
          <h3 class="text-white font-bold mb-3 md:mb-4 border-b border-gray-700 pb-2">Comunidade</h3>
          <ul class="space-y-1.5 md:space-y-2">
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Central de Ajuda</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Aplicativo móvel</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Acesse Nosso Telegram</a></li>
          </ul>
        </div>

        <!-- Coluna Regras -->
        <div class="p-4 md:p-6 rounded-lg bg-gray-900/30 hover:bg-gray-900/50 transition-colors duration-300">
          <h3 class="text-white font-bold mb-3 md:mb-4 border-b border-gray-700 pb-2">Regras</h3>
          <ul class="space-y-1.5 md:space-y-2">
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Termos e Condições</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Política de Privacidade</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">LGPD</a></li>
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Jogo responsável</a></li>
          </ul>
        </div>

        <!-- Coluna Links Úteis com Certificações -->
        <div class="p-4 md:p-6 rounded-lg bg-gray-900/30 hover:bg-gray-900/50 transition-colors duration-300">
          <h3 class="text-white font-bold mb-3 md:mb-4 border-b border-gray-700 pb-2">Links Úteis</h3>
          <ul class="space-y-1.5 md:space-y-2 mb-4 md:mb-6">
            <li><a href="#" class="text-sm md:text-base text-gray-300 hover:text-white transition-colors duration-200">Contate-nos</a></li>
          </ul>

          <!-- Certificações -->
          <div class="grid grid-cols-2 sm:grid-cols-1 gap-2 mt-4">
            <div v-for="(cert, index) in certifications" :key="index" 
                 class="bg-white p-2 rounded-lg hover:bg-gray-100 transition-colors duration-300 flex items-center justify-center">
              <img
                :src="cert.src"
                :alt="cert.alt"
                class="h-6 md:h-8 w-auto object-contain hover:scale-105 transition-transform duration-300"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Texto Descritivo -->
      <div class="p-4 md:p-8 rounded-xl bg-gray-900/30 mb-8 md:mb-12">
        <p class="text-sm md:text-base text-gray-300 leading-relaxed mb-4">
          A TemPix é mais do que uma plataforma de apostas, é um símbolo de confiança e pioneirismo no mercado brasileiro. Como uma das primeiras bets a ser regulamentada no país, a TemPix orgulha-se de ter sido desenvolvida especialmente para você, brasileiro. Aqui, o apostador encontra um ambiente seguro, transparente e totalmente em conformidade com as normas legais, proporcionando não apenas entretenimento, mas também a garantia de que cada aposta é realizada com responsabilidade e ética.
        </p>
        <button class="text-sm md:text-base text-white hover:text-gray-300 transition-colors duration-200 flex items-center gap-2">
          Ver mais
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

      <!-- Footer Bottom -->
      <div class="flex items-center justify-center gap-2 md:gap-3 text-white">
        <img
          src="https://static.vecteezy.com/system/resources/previews/018/923/995/original/brazil-flag-icons-png.png"
          alt="Bandeira do Brasil"
          class="h-4 md:h-5 w-auto object-contain"
        />
        <span class="text-sm md:text-lg">Feito com <span class="text-red-500">❤️</span> para brasileiros!</span>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterComponent',
  data() {
    return {
      sealImage: 'https://static.vera.bet.br/deploy-ed77068f46e6aace75a271a79321ce4f1a768c05-fae42819febff8c9a50a/assets/seals/autorizado.png',
      certifications: [
        {
          src: 'https://ebacbrasil.com.br/wp-content/uploads/2023/01/logo-EBAC.png',
          alt: 'EBAC Logo'
        },
        {
          src: 'https://www.treacle.me/wp-content/uploads/2023/09/Be-Gamble-Aware-01-800x227.png',
          alt: 'BeGambleAware'
        },
        {
          src: 'https://www.pikpng.com/pngl/m/366-3664695_the-gt-app-gambling-therapy-logo-clipart.png',
          alt: 'Gambling Therapy'
        },
        {
          src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTorQdzlkt2XgXIKsg8Jn00xFA2F7Tzst3ENw&s',
          alt: 'Certification'
        }
      ]
    }
  }
}
</script>

<style scoped>
.footer-component {
  position: relative;
  contain: content; /* Otimização de performance */
}

.footer-component::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
}
</style>