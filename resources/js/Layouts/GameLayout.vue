<template>

  <NavTopComponent :style="{ visibility: NavTopComponent ? 'visible' : 'hidden' }" />

  <div class="page-container " >
    <div class="content flex items-center justify-between navtop-color" style="width: 100%;margin-top: -5px;padding: 5px 2%;">
       
      <div class="buttons-container" >
         <router-link to="/" class="other-button">
          <i class="fas fa-arrow-left"></i>
          </router-link>
      </div>

      <div>
        <a v-if="setting" href="/" class="flex lg:ml-2 ml:2 ">
                        <img :src="`/storage/`+setting.software_logo_black" alt="" class="h-8 block dark:hidden " />
                        <img :src="`/storage/`+setting.software_logo_white" alt=""  class="lg:max-h-[20px] max-h-[20px] hidden dark:block" />
                    </a>
      </div>
      
      <div>
        <a aria-current="page" href="/profile/deposit" style="font-size: 12px;color: var(--title-color);background-color: var(--ci-primary-color);border: none;border-radius: 5px;padding: 1px 7px;cursor: pointer;display: flex;align-items: center;" class=""><span class=""></span><i class="fa-duotone fa-money-bill" style="padding-right: 3px;"></i> Depositar</a>
      </div>
    </div>
    <div class="slot-overlay"></div>
    <slot></slot>
  </div>
</template>

<script>
import { initFlowbite } from 'flowbite';
import { onMounted } from "vue";
import FooterComponent from "@/Components/UI/FooterComponent.vue";
import BottomNavComponent from "@/Components/Nav/BottomNavComponent.vue";
import { useSettingStore } from "@/Stores/SettingStore.js";

export default {
  props: [],
  components: { 
    BottomNavComponent, 
    FooterComponent 
  },
  data() {
    return {
      logo: '/assets/images/logo_verde.png',
      isLoading: false,
      setting: null,
      custom: null
    }
  },
  setup(props) {
    onMounted(() => {
      initFlowbite();
    });

    return {
      NavTopComponent: false,
    };
  },
  computed: {
    setting() {
      const authStore = useSettingStore();
      return authStore.setting;
    }
  },
  mounted() {
    window.scrollTo(0, 0);
  },
  methods: {
    getSetting() {
      const settingStore = useSettingStore();
      const settingData = settingStore.setting;

      if(settingData) {
        this.setting = settingData;
      }
    },
    // Add getCasinoCategories method if needed
    getCasinoCategories() {
      // Implementation here if needed
      console.log('getCasinoCategories called');
    }
  },
  created() {
    if (typeof custom !== 'undefined') {
      this.custom = custom;
    }
    this.getCasinoCategories();
    this.getSetting();
  },
  watch: {}
};
</script>

<style scoped>
.page-container {
  position: relative;
  width: 100%;
  height: 100vh;
}

.content {
  position: fixed;
  top: 5px; /* Movendo a barra para baixo em 5px */
  left: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 1;
}

.logo-container {
  display: flex;
  align-items: center;
}

.buttons-container {
  display: flex;
}

.back-button,
.other-button {
  color: var(--title-color);
  background-color: var(--ci-primary-color);
  border: none;
  border-radius: 5px;
  padding: 3px 10px;
  margin-left: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  font-size: 12px;
}

.back-button:hover,
.other-button:hover {
  background-color: var(--ci-primary-opacity-color);
}

.back-button i,
.other-button i {
  margin-right: 2px;
  margin-left: 2px;
}

.back-button span,
.other-button span {
  font-weight: light;
  font-family: 'Poppins', sans-serif;
  font-size: 12px;
}

.slot-overlay {
  position: absolute;
  top: 60px;
  left: 0;
  width: 100%;
  height: calc(90% - 60px);
  background-color: rgba(255, 255, 255, 0.5);
  z-index: 0;
}
</style>
