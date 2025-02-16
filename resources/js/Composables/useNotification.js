import { ref } from 'vue'

export function useNotification() {
  const notification = ref({
    message: '',
    type: ''
  })

  const showNotification = (message, type = 'success') => {
    notification.value = {
      message,
      type
    }

    // Limpa a notificação após 3 segundos
    setTimeout(() => {
      notification.value = {
        message: '',
        type: ''
      }
    }, 3000)
  }

  return {
    notification,
    showNotification
  }
} 