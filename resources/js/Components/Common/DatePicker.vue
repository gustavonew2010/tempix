<template>
  <div class="date-picker-wrapper">
    <input
      type="text"
      :value="formattedDate"
      readonly
      class="date-input"
      @click="toggleCalendar"
      :placeholder="placeholder"
    />
    <div v-if="isOpen" class="calendar-wrapper">
      <v-date-picker
        v-model="selectedDate"
        mode="single"
        :masks="masks"
        :max-date="maxDate"
        :locale="ptBR"
        class="custom-calendar"
        @dayclick="handleDateSelect"
        @click-outside="closeCalendar"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { DatePicker as VDatePicker } from 'v-calendar'
import 'v-calendar/dist/style.css'

const isOpen = ref(false)

const props = defineProps({
  modelValue: String,
  placeholder: {
    type: String,
    default: 'Selecione uma data'
  }
})

const emit = defineEmits(['update:modelValue'])

const toggleCalendar = () => {
  isOpen.value = !isOpen.value
}

const closeCalendar = () => {
  isOpen.value = false
}

const handleDateSelect = () => {
  closeCalendar()
}

const selectedDate = computed({
  get: () => props.modelValue ? new Date(props.modelValue) : null,
  set: (value) => emit('update:modelValue', value ? formatDate(value) : null)
})

const maxDate = new Date() // Data máxima é hoje

const masks = {
  input: 'DD/MM/YYYY'
}

const ptBR = {
  firstDayOfWeek: 2,
  masks: {
    L: 'DD/MM/YYYY'
  },
  dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
  dayShortNames: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
  monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
  monthShortNames: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
}

const formattedDate = computed(() => {
  if (!selectedDate.value) return ''
  const date = new Date(selectedDate.value)
  return date.toLocaleDateString('pt-BR')
})

const formatDate = (date) => {
  return date.toISOString().split('T')[0]
}
</script>

<style scoped>
.date-picker-wrapper {
  position: relative;
  width: 100%;
}

.date-input {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid #444;
  border-radius: 4px;
  background-color: #222;
  color: #eee;
  cursor: pointer;
  user-select: none;
}

.date-input::-webkit-calendar-picker-indicator {
  display: none;
}

.calendar-wrapper {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  margin-top: 4px;
}

/* Estilos do calendário customizado com tema dark */
:deep(.custom-calendar) {
  background: linear-gradient(180deg, #1a1a1a, #121212);
  border: 1px solid #333;
  border-radius: 4px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  font-size: 0.8rem; /* fonte reduzida */
  
  /* Variáveis e cores utilizadas pelo VCalendar – paleta escura */
  --vc-text-color: #eeeeee;
  --vc-text-gray-400: #bbbbbb;
  --vc-text-gray-500: #999999;
  --vc-accent: #444444;  /* destaque em tom neutro */
}

/* Ajustes para o cabeçalho, título, ícones e dias – fonte branca e ajustada */
:deep(.custom-calendar .vc-header) {
  color: #eee;
  padding-bottom: 40px;
  margin-bottom: 8px;
  border-bottom: 1px solid #333;
}

:deep(.custom-calendar .vc-title) {
  color: #eee;
  font-weight: bold;
  padding: 0 8px;
}

:deep(.custom-calendar .vc-arrow) {
  color: #eee;
  padding: 4px;
  margin: 0 4px;
}

/* Ajuste para os dias da semana (S, T, Q...) */
:deep(.custom-calendar .vc-weeks) {
  padding: 0 8px;
}

:deep(.custom-calendar .vc-weekdays) {
  padding: 8px 0;
}

:deep(.custom-calendar .vc-weekday) {
  color: #eee;
  font-weight: bold;
  padding: 4px 0;
}

:deep(.custom-calendar .vc-nav-container) {
  background-color: #1a1a1a;
  color: #eee;
}

:deep(.custom-calendar .vc-nav-title) {
  color: #eee !important;
  font-weight: bold;
  font-size: 0.8rem; /* Reduz o tamanho do texto do mês e ano */
}

/* Responsividade: diminuir fonte em telas menores */
@media (max-width: 600px) {
  :deep(.custom-calendar) {
    font-size: 0.7rem;
  }
  :deep(.custom-calendar .vc-header),
  :deep(.custom-calendar .vc-title),
  :deep(.custom-calendar .vc-nav-title),
  :deep(.custom-calendar .vc-weekday) {
    font-size: 0.8rem;
  }
  :deep(.custom-calendar .vc-nav-title) {
    font-size: 0.7rem; /* Reduz ainda mais o texto em telas menores, se necessário */
  }
}

:deep(.custom-calendar .vc-nav-arrow) {
  color: #eee !important;
}

:deep(.custom-calendar .vc-nav-item) {
  color: #eee;
}

:deep(.custom-calendar .vc-nav-item:hover) {
  background-color: #333;
}

:deep(.custom-calendar .vc-nav-item.is-active) {
  background-color: #444444;
  color: #eee;
}

:deep(.custom-calendar .vc-nav-item.is-disabled) {
  color: #666;
}

/* Ajustes para os dias */
:deep(.custom-calendar .vc-day) {
  color: #eee;
  margin: 2px; /* acrescenta margem entre os dias */
}

:deep(.custom-calendar .vc-day-content) {
  color: #eee !important;
  padding: 6px 8px; /* padding interno para espaçar o conteúdo */
  margin: 2px;       /* margem extra para separar visualmente os dias */
}

:deep(.custom-calendar .vc-day-content:hover) {
  background-color: #333;
  color: #eee !important;
}

:deep(.custom-calendar .vc-highlight) {
  background-color: #444444;
  color: #eee !important;
}
</style> 