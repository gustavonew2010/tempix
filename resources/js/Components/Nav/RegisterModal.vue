<template>
    <div style="z-index: 999;" 
         id="modalElRegister" 
         tabindex="-1" 
         aria-hidden="true" 
         :class="['fixed inset-0 w-full overflow-x-hidden overflow-y-auto flex items-center justify-center',
                 { 'hidden': !modelValue }]">
        <!-- Usar a mesma estrutura do AuthModal, apenas mudando o conteúdo interno -->
        <div class="fixed inset-0 bg-black/90"></div>

        <div class="relative w-full max-w-[520px] max-h-full mx-auto px-4 z-10">
            <div class="flex items-center justify-center min-h-screen">
                <div class="w-full relative login-register-100vh">
                    <!-- Header com tabs -->
                    <div class="auth-header">
                        <!-- Botão X estilizado -->
                        <button @click="$emit('close')" class="close-button absolute right-6 top-6">
                            <div class="close-icon-wrapper">
                                <span>✕</span>
                            </div>
                        </button>

                        <!-- Tabs centralizados -->
                        <div class="flex justify-center pt-6 pb-4">
                            <div class="tabs-wrapper">
                                <button 
                                    class="tab-button"
                                    @click="$emit('show-login')"
                                >
                                    <span class="tab-text">Conecte-se</span>
                                </button>
                                <button 
                                    class="tab-button active"
                                >
                                    <span class="tab-text">Inscrever-se</span>
                                </button>
                            </div>
                        </div>

                        <!-- Divisória com gradiente -->
                        <div class="header-divider"></div>
                    </div>

                    <div v-if="isLoadingRegister" class="absolute inset-0 z-[999] flex items-center justify-center">
                        <div role="status">
                            <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <div class="flex md:justify-between">
                        <div class="w-full relative p-5 login-register-100vh">
                            <form @submit.prevent="registerSubmit" method="post" action="" class="padding-register">
                                <div style="display: flex;align-items: center;justify-content: space-between;padding-bottom: 20px;">
                                    <div style="display: flex;align-items: center;margin: 0 auto;text-align:center;gap:20px;">
                                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="margin-left: 35px;">
                                            <a style="color: white" href="" @click.prevent="$emit('show-login')">
                                                <strong style="font-weight: 500;">Entrar</strong>
                                            </a>
                                        </p>
                                        
                                        <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div">
                                            <a style="color: var(--ci-primary-color)">
                                                <strong style="color: white;font-weight: 500;color: var(--ci-primary-color)">Registrar</strong>
                                            </a>
                                        </p>
                                    </div>
                                    
                                    <a class="login-register-x" @click.prevent="$emit('close')" href="">
                                        <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px">
                                            <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="tirar-div" style="width: 100%;height: 1px;background-color: #383A3B;margin-bottom: 20px;"></div>

                                <div style="display: flex;justify-content: center;margin: 0 auto;margin-bottom: 20px">
                                    <a v-if="setting" class="flex md:ml-2 ml:1 md:mr-24 items-center" style="display: flex;justify-content: center;margin: 0 auto;">
                                        <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden" />
                                        <img :src="`/storage/`+setting.software_logo_white" alt="" class="md:max-h-[35px] max-h-[30px] hidden dark:block" />
                                    </a>
                                </div>

                                <div class="relative mb-3">
                                    <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" 
                                           type="text"
                                           name="name"
                                           v-model="form.name"
                                           class="input-group"
                                           :placeholder="$t('Nome')"
                                           required>
                                </div>

                                <div class="relative mb-3">
                                    <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" 
                                           type="email"
                                           name="email"
                                           v-model="form.email"
                                           class="input-group"
                                           :placeholder="$t('E-mail')"
                                           required>
                                </div>

                                <div class="relative mb-3">
                                    <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" 
                                           :type="typeInputPassword"
                                           name="password"
                                           v-model="form.password"
                                           class="input-group pr-[40px]"
                                           :placeholder="$t('Senha')"
                                           required>
                                    <button type="button" @click="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5">
                                        <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                                    </button>
                                </div>

                                <div class="mb-3 mt-5">
                                    <button @click.prevent="isReferral = !isReferral" type="button" class="flex justify-center w-full">
                                        <p style="color:white;font-size: 12px">{{ $t('Código de referência') }}</p>
                                    </button>

                                    <div v-if="isReferral" class="relative mb-3 mt-1">
                                        <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" 
                                               type="text" 
                                               name="reference_code"
                                               v-model="form.reference_code" 
                                               class="input-group" 
                                               :placeholder="$t('Code')">
                                    </div>
                                </div>

                                <p style="text-align: center;font-size: 10px;color: white;font-weight: lighter;margin-bottom: -14px" 
                                   class="text-sm text-gray-500 dark:text-gray-300 mb-6">
                                    <a @click="$router.push('/terms/service')" href="">
                                        Ao se registrar <strong style="color:var(--ci-primary-color);font-weight: lighter;">você concorda com nossos termos e condições</strong>
                                    </a>
                                </p>

                                <div class="mt-5 w-full flex flex-col items-center">
                                    <button style="color: var(--title-color);font-size: 17px;font-weight: 600;padding: 12px;width: 100%;margin: 0 auto;color: var(--title-color);" 
                                            type="submit" 
                                            class="ui-button-blue w-full mb-3">
                                        Criar conta <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                    
                                    <p style="text-align: center;padding-top: 20px;font-size: 12px;color: white;font-weight: 500;" 
                                       class="text-sm text-gray-500 dark:text-gray-300 mb-6">
                                        <a href="" @click.prevent="$emit('show-login')">
                                            Já tem uma conta? <strong style="color:var(--ci-primary-color);font-weight: 500;">Entrar</strong>
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAuthStore } from '@/Stores/Auth.js'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { useSettingStore } from '@/Stores/SettingStore.js'
import HttpApi from '@/Services/HttpApi.js'

export default {
    name: 'RegisterModal',
    
    props: {
        modelValue: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            isLoadingRegister: false,
            isReferral: false,
            typeInputPassword: 'password',
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                reference_code: '',
                term_a: false,
                agreement: false
            }
        }
    },

    computed: {
        setting() {
            const settingStore = useSettingStore()
            return settingStore.setting
        }
    },

    methods: {
        togglePassword() {
            this.typeInputPassword = this.typeInputPassword === 'password' ? 'text' : 'password'
        },

        async registerSubmit() {
            this.isLoadingRegister = true
            const authStore = useAuthStore()
            const toast = useToast()
            const router = useRouter()

            try {
                const response = await HttpApi.post('auth/register', this.form)
                
                if (response.data.access_token) {
                    authStore.setToken(response.data.access_token)
                    authStore.setUser(response.data.user)
                    authStore.setIsAuth(true)

                    this.form = {
                        name: '',
                        email: '',
                        password: '',
                        password_confirmation: '',
                        reference_code: '',
                        term_a: false,
                        agreement: false
                    }

                    this.$emit('update:modelValue', false)
                    router.push({ name: 'home' })
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
        }
    },

    emits: ['update:modelValue', 'close', 'show-login']
}
</script>

<style scoped>
@import './styles/nav.css';

.login-register-100vh {
    background-color: var(--carousel-banners-dark);
    border-radius: 8px;
    max-width: 450px;
    margin: 0 auto;
    width: 100%;
}

.x-mark-scale {
    transition: .3s;
}

.x-mark-scale:hover {
    transform: scale(.9);
}

@media (max-width: 768px) {
    .login-register-100vh {
        min-height: 100vh;
        border-radius: 0;
        max-width: none;
    }
    
    #modalElRegister {
        padding: 0;
    }
    
    .login-register-x {
        margin-top: -10px;
        margin-right: -25px;
    }
    
    .padding-register {
        padding: 0 4%;
    }
}

@media (max-width: 600px) {
    .margin-teste {
        margin-left: 8px;
    }
    
    .tirar-div {
        display: block;
    }
}
</style> 