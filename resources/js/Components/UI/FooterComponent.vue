<template>
  <footer class="footer-component relative z-10 bg-[#0F0F11] mt-16 w-full">
        <div class="footer-container container mx-auto px-4 pt-12 pb-6">
            <!-- Seção Superior -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Logo e Descrição -->
                <div class="col-span-1 md:col-span-2 lg:col-span-1">
                    <!-- Logo -->
                    <div class="mb-6">
                        <i class="fas fa-dice text-[#00A6FF] text-4xl"></i>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Sua plataforma confiável para apostas esportivas e jogos online. Oferecemos uma experiência segura e emocionante.
                    </p>
                </div>

                <!-- Links Rápidos -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">Links Rápidos</h3>
                    <div class="flex flex-col space-y-3">
                        <a href="#" class="text-gray-400 hover:text-[#00A6FF] transition-colors duration-200 text-sm">Betting terms</a>
                        <a href="#" class="text-gray-400 hover:text-[#00A6FF] transition-colors duration-200 text-sm">Terms and conditions</a>
                        <a href="#" class="text-gray-400 hover:text-[#00A6FF] transition-colors duration-200 text-sm">Privacy policy</a>
                        <a href="#" class="text-gray-400 hover:text-[#00A6FF] transition-colors duration-200 text-sm">Responsible gaming</a>
                        <a href="#" class="text-gray-400 hover:text-[#00A6FF] transition-colors duration-200 text-sm">AML Policy</a>
                    </div>
                </div>

                <!-- Pagamento -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">Pagamento</h3>
                    <div class="bg-[#252528] rounded-lg p-4 inline-block">
                        <i class="fas fa-qrcode text-3xl text-green-500"></i>
                    </div>
                </div>

                <!-- Redes Sociais -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">Siga-nos</h3>
                    <div class="flex gap-4">
                        <a href="#" class="bg-[#252528] p-3 rounded-lg hover:bg-[#2F2F33] transition-colors duration-200">
                            <i class="fab fa-instagram text-gray-400 hover:text-[#00A6FF]"></i>
                        </a>
                        <a href="#" class="bg-[#252528] p-3 rounded-lg hover:bg-[#2F2F33] transition-colors duration-200">
                            <i class="fab fa-telegram text-gray-400 hover:text-[#00A6FF]"></i>
                        </a>
                        <a href="#" class="bg-[#252528] p-3 rounded-lg hover:bg-[#2F2F33] transition-colors duration-200">
                            <i class="fab fa-facebook text-gray-400 hover:text-[#00A6FF]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Texto Descritivo -->
            <div class="border-t border-b border-[#2F2F33] py-8 mb-8">
                <h2 class="text-white text-xl font-semibold mb-4">Apostas Online: Uma Experiência Emocionante e Segura</h2>
                <p class="text-gray-400 leading-relaxed mb-4">
                    Descubra a emoção das apostas online no Onepix! Oferecemos uma plataforma confiável e segura para entusiastas de jogos de aposta explorarem suas habilidades. Com uma ampla variedade de opções de apostas, desde esportes a jogos de cassino, você encontrará tudo o que precisa em um só lugar. Nossa equipe dedicada está pronta para auxiliá-lo em todas as etapas, desde o registro até o saque dos seus ganhos. Aproveite a facilidade de apostar online e mergulhe na emoção dos jogos.
                </p>
            </div>

            <!-- Informações Legais -->
            <div class="text-gray-500 text-sm leading-relaxed mb-12 bg-[#252528] p-6 rounded-lg">
                TemPix is an online entertainment website that offers its users a unique sports betting experience. This website is operated by NovaWave Technology N.V., a company registered in Curaçao, under number 1737149321, with registered office in Schottegatweg Oost 10, Unit 1-9, Bon Bini Business Center, Willemstad, Curaçao, Dutch Caribbean, an entity duly authorized and licensed by the Government of Curaçao.
            </div>

            <!-- Certificações -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-12">
                <div v-for="(icon, i) in ['shield-check', 'certificate', 'award', 'badge-check', 'shield-alt', 'star']" :key="i" 
                     class="bg-[#252528] p-4 rounded-lg flex items-center justify-center hover:bg-[#2F2F33] transition-colors duration-200">
                    <i :class="`fas fa-${icon} text-2xl text-gray-400`"></i>
                </div>
            </div>

            <!-- Contatos -->
            <div class="flex flex-col md:flex-row justify-center gap-6 text-gray-400 text-sm border-t border-[#2F2F33] pt-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-headset"></i>
                    <span>Suporte: support@tempix.co</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-gavel"></i>
                    <span>Jurídico: legal@tempix.co</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-handshake"></i>
                    <span>Parcerias: partners@tempix.co</span>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer'
}
</script>

<style>
.footer-component {
    background-color: #0F0F11 !important;
    position: relative;
    z-index: 10;
}

.footer-container {
    max-width: 1210px;
    position: relative;
    z-index: 11;
}

/* Remover transições dos links */
a {
    transition: none !important;
}

/* Remover hover effects */
a:hover {
    transform: none !important;
}

/* Remover transições dos ícones sociais */
.fab {
    transition: none !important;
}


/* Remover animações de certificações */
.grid-cols-2 > div {
    transition: none !important;
}

.grid-cols-2 > div:hover {
    transform: none !important;
}

/* Remover transições de cores */
.hover\:text-\[\#00A6FF\]:hover {
    transition: none !important;
}

.hover\:bg-\[\#2F2F33\]:hover {
    transition: none !important;
}

/* Remover efeito de fundo */
.footer-component::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #0F0F11;
    z-index: -1;
}
</style>