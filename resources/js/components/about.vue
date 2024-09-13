<template>
    <div>
      <h1>Top 5 High Scores</h1>
      <div v-for="(score, index) in topScores" :key="index" class="user-score">
        <h3>{{ index + 1 }}. {{ score.username }} - Score: {{ score.score }}</h3>
        <p v-if="score.quiz">{{ score.quiz.name }}</p>
        <p v-else>No quiz data available</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const topScores = ref([]);
  
  const fetchTopScores = async () => {
    try {
      const response = await axios.get('/api/top-highscores');
      topScores.value = response.data;
    } catch (error) {
      console.error('Error fetching top scores:', error);
    }
  };
  
  onMounted(() => {
    fetchTopScores();
  });
  </script>
  
  <style scoped>
  .user-score {
    margin-bottom: 20px;
  }
  </style>
  