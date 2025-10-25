<template>
  <div class="app-container">
    <header class="app-header">
      <h1>📝 Mi App de Tareas</h1>
      <nav>
        <a href="/">Inicio</a>
        <a href="#">Login</a>
        <a href="#">Tareas</a>
      </nav>
    </header>

    <main class="app-main">
      <h2>Bienvenido a Vue.js</h2>
      <p>Organiza tus tareas y mantente productivo 💪</p>

      <div class="counter-section">
        <p>Has hecho clic {{ count }} veces</p>
        <button @click="increment">Haz clic aquí</button>
      </div>

      <div class="api-section">
        <button @click="probarApi" :disabled="loading">
          {{ loading ? 'Cargando...' : 'Probar conexión con API' }}
        </button>
        <p v-if="mensaje" :class="{ error: esError }">{{ mensaje }}</p>
      </div>

      <div class="info-section">
        <h3>Información del proyecto</h3>
        <ul>
          <li>✅ Vue.js {{ version }} instalado</li>
          <li>✅ Laravel funcionando</li>
          <li>✅ Vite configurado</li>
        </ul>
      </div>
    </main>

    <footer class="app-footer">
      Desarrollado por Almejoo UwU 💻
    </footer>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'App',
  setup() {
    const count = ref(0);
    const mensaje = ref('');
    const loading = ref(false);
    const esError = ref(false);
    const version = ref('3.4');

    const increment = () => {
      count.value++;
    };

    const probarApi = async () => {
      loading.value = true;
      mensaje.value = '';
      esError.value = false;

      try {
        const res = await fetch('/api/saludo');
        const data = await res.json();
        mensaje.value = data.mensaje;
      } catch (error) {
        mensaje.value = 'Error al conectar con la API';
        esError.value = true;
      } finally {
        loading.value = false;
      }
    };

    return {
      count,
      mensaje,
      loading,
      esError,
      version,
      increment,
      probarApi
    };
  }
};
</script>

<style scoped>
.app-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.app-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 1.5rem 2rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.app-header h1 {
  margin: 0 0 1rem 0;
  font-size: 2rem;
}

.app-header nav {
  display: flex;
  gap: 1.5rem;
}

.app-header nav a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: opacity 0.3s;
}

.app-header nav a:hover {
  opacity: 0.8;
}

.app-main {
  flex: 1;
  padding: 2rem;
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
}

.app-main h2 {
  color: #333;
  margin-bottom: 0.5rem;
}

.app-main > p {
  color: #666;
  margin-bottom: 2rem;
}

.counter-section,
.api-section,
.info-section {
  background: white;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 1.5rem;
}

.counter-section p {
  font-size: 1.2rem;
  color: #667eea;
  font-weight: 600;
  margin-bottom: 1rem;
}

button {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}

button:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.api-section p {
  margin-top: 1rem;
  padding: 0.75rem;
  border-radius: 6px;
  background: #f0f9ff;
  color: #0369a1;
}

.api-section p.error {
  background: #fef2f2;
  color: #dc2626;
}

.info-section h3 {
  margin-top: 0;
  color: #333;
}

.info-section ul {
  list-style: none;
  padding: 0;
}

.info-section li {
  padding: 0.5rem 0;
  color: #666;
}

.app-footer {
  background: #f3f4f6;
  padding: 1.5rem;
  text-align: center;
  color: #666;
  margin-top: auto;
}
</style>

