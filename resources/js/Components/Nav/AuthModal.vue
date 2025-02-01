<template>
    <div v-if="modelValue" class="auth-modal-wrapper">
        <!-- Backdrop Principal -->
        <div class="fixed inset-0 bg-black bg-opacity-90" 
             style="z-index: 999;"
             @click="handleClose"></div>

        <!-- Container Principal do Modal -->
        <div class="fixed inset-0 w-full h-full flex items-center justify-center"
             style="z-index: 1000;">
            <!-- Mobile Layout -->
            <div v-if="isMobile" 
                 class="mobile-layout"
                 :class="{'small-screen': isSmallScreen}">
                <div class="mobile-header">
                    <button @click="handleClose" class="mobile-back">
                        <i class="fa-light fa-arrow-left"></i>
                    </button>
                    <h3 class="mobile-title">{{ activeTab === 'login' ? 'Entrar' : 'Criar Conta' }}</h3>
                    <div class="w-10"></div>
                </div>

                <div class="mobile-content">
                    <img v-if="setting" 
                         :src="`/storage/${setting.software_logo_white}`" 
                         alt="Logo" 
                         class="mobile-logo">

                    <div class="mobile-tabs">
                        <button 
                            v-for="tab in ['login', 'register']"
                            :key="tab"
                            @click="switchTab(tab)"
                            :class="['mobile-tab-btn', { active: activeTab === tab }]"
                        >
                            {{ tab === 'login' ? 'Entrar' : 'Criar Conta' }}
                        </button>
                    </div>

                    <!-- Login Form -->
                    <form v-if="activeTab === 'login'" @submit.prevent="loginSubmit" class="mobile-form">
                        <div class="mobile-input-group">
                            <input 
                                type="email"
                                v-model="form.email"
                                placeholder="E-mail"
                                class="mobile-input"
                            >
                            <div class="mobile-password-wrapper">
                                <input 
                                    :type="typeInputPassword"
                                    v-model="form.password"
                                    placeholder="Senha"
                                    class="mobile-input"
                                >
                                <button type="button" 
                                        @click="togglePassword"
                                        class="mobile-eye-btn">
                                    <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                </button>
                            </div>
                        </div>

                        <a href="/forgot-password" class="mobile-forgot-link">
                            Esqueceu sua senha?
                        </a>

                        <div class="cf-turnstile-wrapper flex justify-center my-4">
                            <div class="cf-turnstile" 
                                 :data-sitekey="turnstileSiteKey"
                                 data-theme="dark"></div>
                        </div>

                        <button type="submit" 
                                :disabled="!turnstileToken || isLoadingLogin"
                                class="mobile-submit-btn">
                            <span v-if="!isLoadingLogin">Entrar</span>
                            <i v-else class="fa-duotone fa-spinner-third fa-spin"></i>
                        </button>
                    </form>

                    <!-- Register Form -->
                    <form v-else @submit.prevent="registerSubmit" class="mobile-form">
                        <div class="mobile-input-group">
                            <input 
                                type="text"
                                v-model="registerForm.name"
                                placeholder="Nome completo"
                                class="mobile-input"
                            >
                            <input 
                                type="email"
                                v-model="registerForm.email"
                                placeholder="E-mail"
                                class="mobile-input"
                            >
                            <div class="mobile-password-wrapper">
                                <input 
                                    :type="typeInputPassword"
                                    v-model="registerForm.password"
                                    placeholder="Senha"
                                    class="mobile-input"
                                >
                                <button type="button" 
                                        @click="togglePassword"
                                        class="mobile-eye-btn">
                                    <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                </button>
                            </div>
                        </div>

                        <button @click.prevent="isReferral = !isReferral" 
                                class="mobile-referral-btn">
                            Tenho um código de referência
                        </button>

                        <div v-if="isReferral" class="mobile-referral-input">
                            <input 
                                type="text"
                                v-model="registerForm.reference_code"
                                placeholder="Código de referência"
                                class="mobile-input"
                            >
                        </div>

                        <div class="mobile-terms">
                            Ao criar sua conta, você concorda com nossos
                            <a @click="$router.push('/terms/service')" class="mobile-terms-link">
                                termos e condições
                            </a>
                        </div>

                        <div class="cf-turnstile-wrapper flex justify-center my-4">
                            <div class="cf-turnstile" 
                                 :data-sitekey="turnstileSiteKey"
                                 data-theme="dark"></div>
                        </div>

                        <button type="submit" 
                                :disabled="!turnstileToken || isLoadingRegister"
                                class="mobile-submit-btn">
                            <span v-if="!isLoadingRegister">Criar conta</span>
                            <i v-else class="fa-duotone fa-spinner-third fa-spin"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Desktop Layout -->
            <div v-else class="login-register-100vh">
                    <!-- Header com tabs -->
                    <div class="auth-header">
                        <!-- Botão X estilizado -->
                    <button @click="handleClose" 
                            class="close-button absolute right-6 top-6">
                            <div class="close-icon-wrapper">
                                <span>✕</span>
                            </div>
                        </button>

                        <!-- Tabs centralizados -->
                        <div class="flex justify-center pt-6 pb-4">
                            <div class="tabs-wrapper">
                                <button 
                                    class="tab-button"
                                    :class="{ 'active': activeTab === 'login' }"
                                @click="switchTab('login')"
                                >
                                    <span class="tab-text">Conecte-se</span>
                                </button>
                                <button 
                                    class="tab-button"
                                    :class="{ 'active': activeTab === 'register' }"
                                @click="switchTab('register')"
                                >
                                    <span class="tab-text">Inscrever-se</span>
                                </button>
                            </div>
                        </div>

                        <!-- Divisória com gradiente -->
                        <div class="header-divider"></div>
                    </div>

                    <div class="px-8 pb-8">
                        <!-- Logo -->
                        <div class="flex justify-center mb-8 pt-4">
                            <img v-if="setting" 
                                 :src="`/storage/${setting.software_logo_white}`" 
                                 alt="Logo" 
                                 class="h-10">
                        </div>

                        <!-- Subtítulo dinâmico -->
                        <h2 class="text-gray-400 text-center mb-8 text-lg">
                            {{ activeTab === 'login' ? 'Faça login com suas credenciais' : 'Crie sua conta gratuitamente' }}
                        </h2>

                    <!-- Formulários -->
                    <div class="auth-forms">
                        <!-- Login Form -->
                        <form v-if="activeTab === 'login'" @submit.prevent="loginSubmit" class="space-y-6">
                            <div class="space-y-4">
                                <input 
                                    type="email"
                                    v-model="form.email"
                                    placeholder="E-mail"
                                    class="auth-input"
                                >
                                <div class="relative">
                                    <input 
                                        :type="typeInputPassword"
                                        v-model="form.password"
                                        placeholder="Senha"
                                        class="auth-input"
                                    >
                                    <button type="button" 
                                            @click="togglePassword"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 
                                                   hover:text-gray-300 transition-colors">
                                        <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="text-right">
                                <a href="/forgot-password" class="text-sm text-gray-400">
                                    Esqueceu sua senha?
                                </a>
                            </div>

                            <div class="cf-turnstile-wrapper flex justify-center my-4">
                                <div class="cf-turnstile" 
                                     :data-sitekey="turnstileSiteKey"
                                     data-theme="dark"></div>
                            </div>

                            <button type="submit"
                                    :disabled="!turnstileToken || isLoadingLogin"
                                    class="w-full bg-[#00A2D4] hover:bg-[#0077FF] text-white py-3.5 rounded-lg font-medium transition-all flex items-center justify-center">
                                <span v-if="!isLoadingLogin">Entrar</span>
                                <i v-else class="fa-duotone fa-spinner-third fa-spin"></i>
                            </button>
                        </form>

                        <!-- Register Form -->
                        <form v-else @submit.prevent="registerSubmit" class="space-y-4">
                            <div class="space-y-4">
                                <input 
                                    type="text"
                                    v-model="registerForm.name"
                                    placeholder="Nome completo"
                                    class="auth-input"
                                >
                                <input 
                                    type="email"
                                    v-model="registerForm.email"
                                    placeholder="E-mail"
                                    class="auth-input"
                                >
                                <div class="relative">
                                    <input 
                                        :type="typeInputPassword"
                                        v-model="registerForm.password"
                                        placeholder="Senha"
                                        class="auth-input"
                                    >
                                    <button type="button" 
                                            @click="togglePassword"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 
                                                   hover:text-gray-300 transition-colors">
                                        <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                    </button>
                                </div>
                            </div>

                                <button @click.prevent="isReferral = !isReferral" 
                                    class="w-full text-center text-sm text-gray-400 py-2">
                                Tenho um código de referência
                                </button>

                            <div v-if="isReferral" class="space-y-4">
                                    <input 
                                        type="text" 
                                        v-model="registerForm.reference_code"
                                    placeholder="Código de referência"
                                        class="auth-input"
                                    >
                            </div>

                            <div class="text-xs text-gray-400 text-center">
                                Ao criar sua conta, você concorda com nossos
                                <a @click="$router.push('/terms/service')" class="text-[#00A2D4]">
                                    termos e condições
                                </a>
                            </div>

                            <div class="cf-turnstile-wrapper flex justify-center my-4">
                                <div class="cf-turnstile" 
                                     :data-sitekey="turnstileSiteKey"
                                     data-theme="dark"></div>
                            </div>

                            <button type="submit"
                                    :disabled="!turnstileToken || isLoadingRegister"
                                    class="w-full bg-[#00A2D4] hover:bg-[#0077FF] text-white py-3.5 rounded-lg font-medium transition-all flex items-center justify-center">
                                <span v-if="!isLoadingRegister">Criar conta</span>
                                <i v-else class="fa-duotone fa-spinner-third fa-spin"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação -->
        <Transition 
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-150"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div v-if="showConfirmClose" 
                 class="confirmation-overlay"
                 @click="confirmClose">
                <div class="confirmation-modal" 
                     @click.stop>
                    <div class="confirmation-content">
                        <h3 class="confirmation-title">
                            Tem certeza que deseja cancelar seu registro?
                        </h3>
                        <p class="confirmation-text">
                            Cadastre-se agora e garanta prêmios de até R$1.000!
                        </p>
                        <div class="confirmation-buttons">
                            <button @click="continueRegistration" 
                                    class="continue-button">
                                Continuar
                            </button>
                            <button @click="confirmClose" 
                                    class="cancel-button">
                                Sim quero cancelar
                            </button>
                    </div>
                </div>
            </div>
        </div>
        </Transition>

        <!-- Footer -->
        <div class="border-t border-[#363A3F] py-4 px-6 flex items-center justify-center gap-2">
            <span class="text-gray-400">Não tem uma conta?</span>
            <a @click="switchTab('register')" 
               class="text-[#92C83E] hover:text-[#83B437] cursor-pointer">
                Crie uma conta aqui
            </a>
        </div>
    </div>
</template>

<script>
import { useSettingStore } from '@/Stores/SettingStore.js'
import { useAuthStore } from '@/Stores/Auth.js'
import { useToast } from 'vue-toastification'
import HttpApi from '@/Services/HttpApi.js'
import { useCacheStore } from '@/Stores/CacheStore.js'

export default {
    name: 'AuthModal',
    
    props: {
        modelValue: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            isLoadingLogin: false,
            typeInputPassword: 'password',
            form: {
                email: '',
                password: ''
            },
            turnstileSiteKey: import.meta.env.VITE_TURNSTILE_SITE_KEY,
            turnstileToken: null,
            loginMethod: 'email',
            activeTab: 'login',
            isLoadingRegister: false,
            isReferral: false,
            registerForm: {
                name: '',
                email: '',
                password: '',
                reference_code: '',
                term_a: false,
                agreement: false
            },
            errors: {
                login: {},
                register: {}
            },
            validations: {
                email: {
                    pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                    message: 'Digite um e-mail válido'
                },
                password: {
                    minLength: 6,
                    message: 'A senha deve ter no mínimo 6 caracteres'
                },
                name: {
                    minLength: 3,
                    message: 'O nome deve ter no mínimo 3 caracteres'
                }
            },
            showConfirmClose: false,
            tempModelValue: false, // Para guardar o estado do modal principal
            screenSize: 'mobile'
        }
    },

    computed: {
        setting() {
            const settingStore = useSettingStore()
            return settingStore.setting
        },
        isMobile() {
            return window.innerWidth < 768
        },
        isSmallScreen() {
            return window.innerWidth < 375
        }
    },

    watch: {
        modelValue(newVal, oldVal) {
            if (newVal) {
                this.clearTurnstileWidgets()
                this.$nextTick(() => {
                    this.initTurnstile()
                })
            } else {
                this.clearTurnstileWidgets()
            }
            if (!newVal && this.showConfirmClose) {
                this.showConfirmClose = false
            }
        },
        activeTab(newTab) {
            // Reset do estado de confirmação ao trocar de aba
            this.showConfirmClose = false
        }
    },

    mounted() {
        // Carrega o script do Turnstile apenas se tivermos uma sitekey
        if (this.turnstileSiteKey) {
            const script = document.createElement('script')
            script.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit'
            script.async = true
            script.defer = true
            
            script.onload = () => {
                console.log('Script Turnstile carregado')
                if (this.modelValue) {
                    this.initTurnstile()
                }
            }
            
            document.head.appendChild(script)
        } else {
            console.error('VITE_TURNSTILE_SITE_KEY não está definida no arquivo .env')
        }

        this.checkScreenSize()
        window.addEventListener('resize', this.checkScreenSize)
    },

    beforeUnmount() {
        this.clearTurnstileWidgets()
        window.removeEventListener('resize', this.checkScreenSize)
    },

    methods: {
        togglePassword() {
            this.typeInputPassword = this.typeInputPassword === 'password' ? 'text' : 'password'
        },

        validateLoginForm() {
            this.errors.login = {}
            let isValid = true

            // Validação do email/telefone
            if (this.loginMethod === 'email') {
                if (!this.form.email) {
                    this.errors.login.email = 'O e-mail é obrigatório'
                    isValid = false
                } else if (!this.validations.email.pattern.test(this.form.email)) {
                    this.errors.login.email = this.validations.email.message
                    isValid = false
                }
            } else {
                if (!this.form.email) {
                    this.errors.login.email = 'O telefone é obrigatório'
                    isValid = false
                } else if (!/^\d{10,11}$/.test(this.form.email)) {
                    this.errors.login.email = 'Digite um telefone válido'
                    isValid = false
                }
            }

            // Validação da senha
            if (!this.form.password) {
                this.errors.login.password = 'A senha é obrigatória'
                isValid = false
            } else if (this.form.password.length < this.validations.password.minLength) {
                this.errors.login.password = this.validations.password.message
                isValid = false
            }

            return isValid
        },

        validateRegisterForm() {
            this.errors.register = {}
            let isValid = true

            // Validação do nome
            if (!this.registerForm.name) {
                this.errors.register.name = 'O nome é obrigatório'
                isValid = false
            } else if (this.registerForm.name.length < this.validations.name.minLength) {
                this.errors.register.name = this.validations.name.message
                isValid = false
            }

            // Validação do email
            if (!this.registerForm.email) {
                this.errors.register.email = 'O e-mail é obrigatório'
                isValid = false
            } else if (!this.validations.email.pattern.test(this.registerForm.email)) {
                this.errors.register.email = this.validations.email.message
                isValid = false
            }

            // Validação da senha
            if (!this.registerForm.password) {
                this.errors.register.password = 'A senha é obrigatória'
                isValid = false
            } else if (this.registerForm.password.length < this.validations.password.minLength) {
                this.errors.register.password = this.validations.password.message
                isValid = false
            }

            return isValid
        },

        async loginSubmit() {
            if (!this.validateLoginForm()) {
                const toast = useToast()
                Object.values(this.errors.login).forEach(error => {
                    toast.error(error)
                })
                return
            }

            if (!this.turnstileToken) {
                const toast = useToast()
                toast.error('Por favor, complete a verificação de segurança')
                return
            }

            this.isLoadingLogin = true
            const authStore = useAuthStore()
            const toast = useToast()
            const cacheStore = useCacheStore()

            try {
                const response = await HttpApi.post('auth/login', {
                    ...this.form,
                    'cf-turnstile-response': this.turnstileToken
                })
                
                await new Promise(r => setTimeout(r, 1000))
                
                if (response.data.access_token) {
                    authStore.setToken(response.data.access_token)
                    authStore.setUser(response.data.user)
                    authStore.setIsAuth(true)

                    this.form = { email: '', password: '' }
                    this.turnstileToken = null // Reset do token
                    
                    await this.handleLogin()
                    toast.success(this.$t('You have been authenticated, welcome!'))
                    
                    if (this.isCasinoPlayPage) {
                        location.reload()
                    }
                } else {
                    throw new Error('Token não recebido')
                }
            } catch (error) {
                console.error('Erro no login:', error)
                if (error.response) {
                    const errors = error.response.data
                    if (typeof errors === 'object') {
                        Object.values(errors).forEach(error => {
                            toast.error(error)
                        })
                    } else {
                        toast.error('Credenciais inválidas')
                    }
                } else {
                    toast.error('Erro ao fazer login. Tente novamente.')
                }
            } finally {
                this.isLoadingLogin = false
            }
        },

        async registerSubmit() {
            if (!this.validateRegisterForm()) {
                const toast = useToast()
                Object.values(this.errors.register).forEach(error => {
                    toast.error(error)
                })
                return
            }

            this.isLoadingRegister = true
            const authStore = useAuthStore()
            const toast = useToast()
            const cacheStore = useCacheStore()

            try {
                const response = await HttpApi.post('auth/register', {
                    ...this.registerForm,
                    'cf-turnstile-response': this.turnstileToken
                })
                
                if (response.data.access_token) {
                    authStore.setToken(response.data.access_token)
                    authStore.setUser(response.data.user)
                    authStore.setIsAuth(true)

                    this.registerForm = {
                        name: '',
                        email: '',
                        password: '',
                        reference_code: '',
                        term_a: false,
                        agreement: false
                    }

                    await this.handleLogin()
                    toast.success(this.$t('Your account has been created successfully'))
                }
            } catch (error) {
                if (error.response) {
                    const errors = error.response.data
                    if (typeof errors === 'object') {
                        Object.values(errors).forEach(error => {
                            toast.error(error)
                        })
                    } else {
                        toast.error('Erro ao registrar')
                    }
                } else {
                    toast.error('Erro ao registrar')
                }
            } finally {
                this.isLoadingRegister = false
            }
        },

        switchTab(tab) {
            this.activeTab = tab
            // Limpa o token atual
            this.turnstileToken = null
            // Limpa os widgets existentes e reinicializa
            this.$nextTick(() => {
                this.clearTurnstileWidgets()
                this.initTurnstile()
            })
        },

        clearTurnstileWidgets() {
            try {
                const containers = document.querySelectorAll('.cf-turnstile')
                containers.forEach(container => {
                    while (container.firstChild) {
                        container.removeChild(container.firstChild)
                    }
                })
                
                if (window.turnstile) {
                    window.turnstile.reset()
                }
            } catch (error) {
                console.error('Erro ao limpar widgets:', error)
            }
        },

        initTurnstile() {
            if (!this.turnstileSiteKey) {
                console.error('Turnstile sitekey não está definida')
                return
            }

            try {
                const containers = document.querySelectorAll('.cf-turnstile')
                containers.forEach(container => {
                    if (!container.hasChildNodes() && window.turnstile) {
                        window.turnstile.render(container, {
                            sitekey: this.turnstileSiteKey,
                            theme: 'dark',
                            callback: (token) => {
                                console.log('Token gerado:', token)
                                this.turnstileToken = token
                            },
                            'refresh-expired': 'auto'
                        })
                    }
                })
            } catch (error) {
                console.error('Erro ao inicializar Turnstile:', error)
            }
        },

        clearErrors() {
            this.errors = {
                login: {},
                register: {}
            }
        },

        handleClose() {
            // Se estiver na aba de registro, mostra o modal de confirmação
            if (this.activeTab === 'register') {
                this.showConfirmClose = true
            } else {
                this.$emit('close')
            }
        },
        
        continueRegistration() {
            this.showConfirmClose = false
        },
        
        confirmClose() {
            this.showConfirmClose = false
            this.activeTab = 'login' // Reset para a aba de login
            this.$emit('close')
        },

        checkScreenSize() {
            const width = window.innerWidth
            if (width < 768) {
                this.screenSize = 'mobile'
            } else if (width < 1440) {
                this.screenSize = 'desktop'
            } else {
                this.screenSize = 'fullscreen'
            }
        },

        async handleLogin() {
            const cacheStore = useCacheStore()
            
            try {
                await this.loginSubmit()
                // Limpa o cache antigo após login
                cacheStore.clearCache()
                this.$emit('login-success')
                this.$emit('close')
                this.router.push({ name: 'home' })
            } catch (error) {
                console.error('Login error:', error)
            }
        }
    },

    emits: ['update:modelValue', 'close', 'show-register']
}
</script>

<style scoped>
.auth-modal-wrapper {
    @apply fixed inset-0 w-full h-full;
    z-index: 999;
}

/* Mobile Layout */
.mobile-layout {
    @apply fixed inset-0 bg-[#1A1D21] flex flex-col w-full h-full;
}

/* Desktop Layout */
.desktop-layout {
    @apply relative w-full max-w-md mx-auto bg-[#1A1D21] rounded-2xl overflow-hidden shadow-xl;
}

/* Mobile First Styles */
.auth-modal-container {
    @apply fixed inset-0 w-full h-full z-50;
}

.modal-backdrop {
    @apply fixed inset-0 bg-black/90;
}

/* Mobile Styles */
.mobile-header {
    @apply flex items-center justify-between p-4 border-b border-gray-800;
}

.mobile-back {
    @apply w-10 h-10 flex items-center justify-center rounded-full bg-gray-800/50;
}

.mobile-title {
    @apply text-lg font-medium text-white;
}

.mobile-content {
    @apply flex-1 overflow-y-auto px-6 py-4;
}

.mobile-logo {
    @apply h-8 mx-auto mb-6;
}

.mobile-tabs {
    @apply flex gap-3 mb-6;
}

.mobile-tab-btn {
    @apply flex-1 py-2.5 px-4 text-center rounded-lg bg-gray-800/50 text-gray-400 
           text-sm font-medium transition-colors;
}

.mobile-tab-btn.active {
    @apply bg-[#00A2D4] text-white;
}

.mobile-input-group {
    @apply space-y-3;
}

.mobile-input {
    @apply bg-gray-800 border border-gray-700 
           transition-all focus:border-[#00A2D4] focus:ring-1 focus:ring-[#00A2D4]/20;
}

.mobile-password-wrapper {
    @apply relative;
}

.mobile-eye-btn {
    @apply absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center 
           justify-center text-gray-400;
}

.mobile-forgot-link {
    @apply block text-right text-sm text-gray-400 mt-2 mb-4;
}

.mobile-turnstile-wrapper {
    @apply flex justify-center my-4;
}

.mobile-submit-btn {
    @apply w-full bg-gradient-to-r from-[#00A2D4] to-[#0077FF] text-white py-3 
           rounded-lg text-sm font-medium transition-all disabled:opacity-50;
}

.mobile-referral-btn {
    @apply w-full text-center text-sm text-gray-400 py-2 mt-2;
}

.mobile-terms {
    @apply text-xs text-gray-400 text-center mt-4 mb-2 px-4;
}

.mobile-terms-link {
    @apply text-[#00A2D4] hover:text-[#0077FF] transition-colors;
}

/* Small Screen Optimizations */
.small-screen {
    .mobile-content {
        @apply px-4 py-3;
    }

    .mobile-logo {
        @apply h-6 mb-4;
    }

    .mobile-tabs {
        @apply mb-4;
    }

    .mobile-tab-btn {
        @apply py-2 px-3 text-xs;
    }

    .mobile-input {
        @apply py-2.5 text-xs;
    }

    .mobile-submit-btn {
        @apply py-2.5 text-xs;
    }

    .mobile-terms {
        @apply text-[10px] px-2;
    }

    .mobile-forgot-link {
        @apply text-xs;
    }

    .mobile-turnstile-wrapper {
        @apply my-3;
        transform: scale(0.85);
        transform-origin: center;
    }
}

/* Desktop Styles */
.login-register-100vh {
    @apply relative w-full max-w-[520px] bg-[#1A1D21] rounded-2xl overflow-hidden shadow-2xl;
}

.auth-header {
    @apply relative border-b border-gray-800;
}

.tabs-wrapper {
    @apply flex gap-12 relative;
}

.tab-button {
    @apply relative text-gray-400 text-base py-1 transition-colors;
}

.tab-button.active {
    @apply text-[#00A2D4];
}

.tab-button.active::after {
    @apply bg-[#00A2D4] shadow-[0_0_10px_#00A2D4];
}

.close-button {
    @apply bg-transparent p-2 rounded-lg transition-all;
}

.close-icon-wrapper {
    @apply w-6 h-6 flex items-center justify-center rounded-md bg-white/10 transition-all;
}

.close-button:hover .close-icon-wrapper {
    @apply bg-[#00A2D4]/20;
}

.close-icon-wrapper span {
    @apply text-gray-400 text-sm;
}

.header-divider {
    @apply absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-700/40 to-transparent;
}

/* Form Styles */
.auth-input {
    @apply w-full bg-[#23272C] border border-[#2A2F35] text-white 
           transition-all focus:border-[#00A2D4] focus:ring-2 focus:ring-[#00A2D4]/20;
}

.auth-button {
    @apply w-full bg-gradient-to-r from-[#00A2D4] to-[#0077FF] text-white py-3.5 rounded-lg 
           font-semibold relative overflow-hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.auth-button:hover {
    @apply shadow-lg shadow-[#00A2D4]/30 -translate-y-0.5;
    background: linear-gradient(to right, #0077FF, #00A2D4);
}

.auth-button:disabled {
    @apply opacity-50 cursor-not-allowed transform-none shadow-none;
}

.auth-button::after {
    content: '';
    @apply absolute top-0 left-[-100%] w-[200%] h-full;
    background: linear-gradient(
        to right,
        transparent,
        rgba(0, 162, 212, 0.2),
        transparent
    );
    transition: transform 0.5s ease;
}

.auth-button:hover::after {
    @apply translate-x-full;
}

/* Animations */
@keyframes modalEnter {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.login-register-100vh {
    animation: modalEnter 0.3s ease-out;
}

/* Confirmation Modal Styles */
.confirmation-overlay {
    @apply fixed inset-0 flex items-center justify-center bg-black bg-opacity-80;
    z-index: 1001;
}

.confirmation-modal {
    @apply relative bg-[#1A1D21] rounded-2xl p-6 w-[90%] max-w-[400px] mx-4 
           transform transition-all duration-200;
}

.confirmation-content {
    @apply text-center;
}

.confirmation-title {
    @apply text-white text-xl font-semibold mb-4;
}

.confirmation-text {
    @apply text-gray-400 text-sm mb-6;
}

.confirmation-buttons {
    @apply flex flex-col gap-3;
}

.continue-button {
    @apply w-full bg-gradient-to-r from-[#00A2D4] to-[#0077FF] text-white py-3 
           rounded-lg font-semibold transition-all hover:shadow-lg 
           hover:shadow-[#00A2D4]/30 hover:-translate-y-0.5;
}

.continue-button::after {
    @apply bg-gradient-to-r from-transparent via-[#00A2D4]/20 to-transparent;
}

.cancel-button {
    @apply w-full bg-transparent text-gray-400 py-3 rounded-lg font-medium 
           transition-colors hover:bg-[#00A2D4]/10 text-[#00A2D4];
}

.cf-turnstile-wrapper {
    @apply flex justify-center items-center;
    /* Ajusta o iframe do Turnstile para centralizar */
    iframe {
        @apply mx-auto;
    }
}

/* Caso precise de ajuste adicional para telas menores */
@media (max-width: 480px) {
    .cf-turnstile-wrapper {
        transform: scale(0.9);
        transform-origin: center center;
    }
}
</style> 