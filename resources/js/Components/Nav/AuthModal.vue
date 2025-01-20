<template>
    <div style="z-index: 999;background-color:rgba(0, 0, 0, 0.47);backdrop-filter: none;height: 100vh;" 
         id="modalElAuth" 
         tabindex="-1" 
         aria-hidden="true" 
         :class="['fixed inset-0 w-full overflow-x-hidden overflow-y-auto flex items-center justify-center',
                 { 'hidden': !modelValue }]">
        <div class="relative w-full max-w-3xl max-h-full mx-auto px-4">
            <div class="flex items-center justify-center min-h-screen">
                <div class="w-full relative p-5 login-register-100vh">
                    <div v-if="isLoadingLogin" class="absolute top-0 left-0 right-0 bottom-0 z-[999]">
                        <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                            <i class="fa-duotone fa-spinner-third fa-spin" style="font-size: 45px;--fa-primary-color: var(--ci-primary-color); --fa-secondary-color: #000000;"></i>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>

                    <form @submit.prevent="loginSubmit" method="post" action="" class="padding-register" style="padding-top: 15px;">
                        <div style="display: flex;align-items: center;justify-content: space-between;margin-top: -17px;padding-bottom: 20px;">
                            <div style="display: flex;align-items: center;margin: 0 auto;text-align:center;gap:20px;">
                                <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="margin-left: 35px;">
                                    <a style="color: var(--ci-primary-color)" href="" @click.prevent="">
                                        <strong style="font-weight: 500;">Entrar</strong>
                                    </a>
                                </p>
                                
                                <p class="text-sm text-gray-500 dark:text-gray-300 tirar-div" style="">
                                    <a style="color: white" href="" @click.prevent="$emit('show-register')">
                                        <strong style="color: white;font-weight: 500;">Registrar</strong>
                                    </a>
                                </p>
                            </div>
                            
                            <h5 class="font-bold text-xl"></h5>
                            <a class="login-register-x" @click.prevent="$emit('close')" href="">
                                <div class="x-mark-scale" style="box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.50);background-color: var(--carousel-banners-dark);padding: 7px 13px;border-radius: 5px">
                                    <i style="color: var(--ci-primary-color);font-weight: bold" class="fa-light fa-x"></i>
                                </div>
                            </a>
                        </div>

                        <div class="tirar-div" style="width: 100%;height: 1px;background-color: #383A3B;margin-bottom: 20px;"></div>

                        <div style="display: flex;justify-content: center;margin: 0 auto;margin-bottom: 20px">
                            <a v-if="setting" class="flex md:ml-2 ml:1 md:mr-24" style="display: flex;justify-content: center;margin: 0 auto;">
                                <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden" />
                                <img :src="`/storage/`+setting.software_logo_white" alt="" class="md:max-h-[35px] max-h-[30px] hidden dark:block" />
                            </a>
                        </div>

                        <div class="relative mb-3">
                            <input style="padding: 17px 0px;padding-left: 20px;outline: none;border: none;background-color: var(--input-primary);" 
                                   required 
                                   type="text" 
                                   v-model="form.email" 
                                   name="email" 
                                   class="input-group" 
                                   :placeholder="$t('E-mail')">
                        </div>

                        <div class="relative mb-6">
                            <input style="padding: 17px 0px;padding-left: 20px;background-color: var(--input-primary);" 
                                   required 
                                   :type="typeInputPassword"
                                   v-model="form.password"
                                   name="password"
                                   class="input-group pr-[40px]"
                                   :placeholder="$t('Senha')">
                            <button type="button" @click="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5">
                                <i :class="typeInputPassword === 'text' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash'"></i>
                            </button>
                        </div>

                        <div style="display: flex;justify-content: flex-end;">
                            <a style="color:var(--ci-primary-color);color: #97999A;font-size: 12px;margin-top: -15px;font-weight: 500" 
                               href="/forgot-password" 
                               class="text-white text-sm">
                                {{ $t('Esqueceu sua senha?') }}
                            </a>
                        </div>
                        
                        <div class="mt-3 w-full flex items-center">
                            <button style="font-size: 17px;color: var(--title-color);font-weight: 600;padding: 12px;width: 100%;margin: 0 auto;margin-top:20px;color: var(--title-color);" 
                                    type="submit" 
                                    class="ui-button-blue w-full mb-3">
                                {{ $t('Log in') }}
                            </button>
                        </div>

                        <p style="text-align: center;padding-top: 20px;font-size: 12px;color: white;font-weight: 500;" 
                           class="text-sm text-gray-500 dark:text-gray-300 mb-6">
                            <a href="" @click.prevent="$emit('show-register')">
                                Ainda não tem uma conta? 
                                <strong style="color:var(--ci-primary-color);font-weight: 500;">
                                    Criar uma conta grátis
                                </strong>
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useSettingStore } from '@/Stores/SettingStore.js'
import { useAuthStore } from '@/Stores/Auth.js'
import { useToast } from 'vue-toastification'
import HttpApi from '@/Services/HttpApi.js'

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

        async loginSubmit() {
            this.isLoadingLogin = true
            const authStore = useAuthStore()
            const toast = useToast()

            try {
                const response = await HttpApi.post('auth/login', this.form)
                
                await new Promise(r => setTimeout(r, 1000))
                
                authStore.setToken(response.data.access_token)
                authStore.setUser(response.data.user)
                authStore.setIsAuth(true)

                this.form = { email: '', password: '' }
                
                this.$emit('close')
                toast.success(this.$t('You have been authenticated, welcome!'))
                
                if (this.isCasinoPlayPage) {
                    location.reload()
                }
            } catch (error) {
                if (error.response) {
                    const errors = error.response.data
                    if (typeof errors === 'object') {
                        Object.values(errors).forEach(error => {
                            toast.error(error)
                        })
                    } else {
                        toast.error('Erro ao fazer login')
                    }
                } else {
                    toast.error('Erro ao fazer login')
                }
            } finally {
                this.isLoadingLogin = false
            }
        }
    },

    emits: ['update:modelValue', 'close', 'show-register']
}
</script>

<style scoped>
@import './styles/nav.css';

.login-register-100vh {
    background-color: var(--carousel-banners-dark);
    border-radius: 20px;
    max-width: 450px;
    margin: 0 auto;
    width: 100%;
}

@media (max-width: 768px) {
    .login-register-100vh {
        height: 100vh;
        border-radius: 0;
        max-width: none;
    }
}
</style> 