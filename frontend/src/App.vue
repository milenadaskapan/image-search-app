<script setup>
import { ref } from 'vue'

const query = ref('')
const images = ref([])
const loading = ref(false)
const error = ref('')

async function searchImages() {
  if (!query.value) return

  loading.value = true
  error.value = ''

  try {
    const res = await fetch(`http://127.0.0.1:8000/api/images?query=${query.value}`)
    const data = await res.json()
    images.value = data.data
  } catch (err) {
    error.value = 'Something went wrong, please try again!'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div style="padding: 20px;">
    <h1 style="color:white; font-weight: 600; ">IMAGE SEARCH</h1>

    <div style="margin-bottom: 20px; ">
      <input v-model="query" placeholder="Search..." style="font-family: 'Poppins', sans-serif; border-radius:2px; border-color:white; "/>
      <button @click="searchImages" style="border-color:white; border-radius:2px; font-family: 'Poppins', sans-serif; background-color:white;">🔍︎</button>
    </div>

    <p style="color:white;" v-if="loading">Searching...</p>
    <p v-if="error">{{ error }}</p>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
      <div v-for="img in images" :key="img.id">
        <img :src="img.image_url" style="width: 100%; height: 500px; object-fit: cover;" />
        <p style="color:white;">{{ img.photographer }}</p>
      </div>
    </div>
  </div>
</template>