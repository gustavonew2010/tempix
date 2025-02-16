export const getRequirementLabel = (key) => {
  const labels = {
    'account_created': 'Conta criada',
    'email_verified': 'E-mail verificado',
    'phone_verified': 'Telefone verificado',
    'cpf_verified': 'CPF verificado',
    'document_verified': 'RG/CNH verificado',
    'selfie_verified': 'Selfie verificada'
  }
  return labels[key] || key
}

export const formatCurrency = (value) => {
  return new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
  }).format(value)
} 