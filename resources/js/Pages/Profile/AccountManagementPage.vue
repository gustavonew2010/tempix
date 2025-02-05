<template>
  <BaseLayout>
    <div class="account-management">
      <main class="content">
        <div class="profile-card">
          <section class="profile-header">
            <div class="avatar-container">
              <img
                :src="userData?.avatar || '/assets/images/default-avatar.png'"
                alt="Avatar"
                class="avatar-img"
              />
            </div>
            <div class="user-details">
              <h2 class="user-name">{{ userData?.name }}</h2>
              <p class="user-balance">Saldo: R$ {{ userData?.balance }}</p>
            </div>
          </section>
          <section class="profile-details">
            <h3>Dados de Acesso</h3>
            <div class="detail-field">
              <label for="email">E-mail</label>
              <input id="email" type="text" :value="userData?.email" disabled />
            </div>
            <div class="detail-field">
              <label for="displayName">Nome de Exibição</label>
              <input id="displayName" type="text" v-model="userData.displayName" />
            </div>
            <div class="detail-field">
              <label for="phone">Telefone</label>
              <input id="phone" type="text" v-model="userData.phone" />
            </div>
            <div class="detail-field">
              <label for="password">Senha Atual</label>
              <input id="password" type="password" v-model="userData.password" />
            </div>
            <div class="button-group">
              <button class="btn-save" @click="saveChanges">Salvar Alterações</button>
              <button class="btn-logout" @click="logout">Sair</button>
            </div>
          </section>
        </div>
      </main>
    </div>
  </BaseLayout>
</template>

<script setup>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import { useAuthStore } from "@/Stores/Auth.js";
import { storeToRefs } from "pinia";

// Obtém os dados do usuário a partir da store de autenticação
const authStore = useAuthStore();
const { user: userData } = storeToRefs(authStore);

const saveChanges = () => {
  // Lógica para salvar alterações
  console.log("Alterações salvas");
};

const logout = () => {
  // Lógica para logout
  console.log("Logout");
};
</script>

<style scoped>
.account-management {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f0f2f5;
  padding: 20px;
}

.content {
  width: 100%;
  max-width: 600px;
}

.profile-card {
  background: #ffffff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.profile-header {
  display: flex;
  align-items: center;
  padding: 20px;
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: #fff;
}

.avatar-container {
  flex-shrink: 0;
}

.avatar-img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  border: 3px solid rgba(255, 255, 255, 0.8);
}

.user-details {
  margin-left: 20px;
}

.user-name {
  margin: 0;
  font-size: 1.5rem;
  font-weight: bold;
}

.user-balance {
  margin-top: 5px;
  font-size: 1rem;
}

.profile-details {
  padding: 20px;
}

.profile-details h3 {
  margin-bottom: 15px;
  color: #333;
}

.detail-field {
  margin-bottom: 15px;
}

.detail-field label {
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
  color: #555;
}

.detail-field input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.detail-field input:focus {
  border-color: #007bff;
  outline: none;
}

.button-group {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.button-group button {
  flex: 1;
  padding: 12px 20px;
  font-size: 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.button-group button:first-child {
  margin-right: 10px;
}

.btn-save {
  background-color: #28a745;
  color: #fff;
}

.btn-save:hover {
  background-color: #218838;
}

.btn-logout {
  background-color: #dc3545;
  color: #fff;
}

.btn-logout:hover {
  background-color: #c82333;
}
</style> 