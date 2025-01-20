<template>
    <div class="z-50 hidden text-left list-none bg-[white] rounded shadow" id="dropdown-user2" style="background-color: white;">
        <ul class="py-1 px-5 mt-3" role="none">
            <li class="hover-menu">
                <RouterLink to="{ name: 'profileWallet' }" 
                           active-class="profile-menu-active" 
                           class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300">
                    <span class="">
                        <i class="fa-duotone fa-wallet pr-3"></i>
                    </span>
                    <p style="font-weight: bold">Carteira</p>
                </RouterLink>
            </li>
            <!-- Outros itens do menu -->
            <div class="divider"></div>
            <li class="sair-menu mb-3">
                <a href="#" 
                   @click.prevent="$emit('logout')"
                   class="flex items-center block px-4 py-2 text-sm">
                    <span class="">
                        <i class="fa-duotone fa-right-from-bracket pr-3"></i>
                    </span>
                    <p>Sair</p>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'UserDropdownMenu',
    emits: ['logout']
}
</script> 