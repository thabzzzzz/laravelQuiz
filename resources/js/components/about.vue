<template>
    <div class="container">
        <header>
            <h1>Quizzy</h1>

        </header>

        <div class="highscorePage">

            <h2>High Scores</h2>
      <div v-for="(score, index) in topScores" :key="index" class="user-score">
        <h3>{{ index + 1 }}. {{ score.username }} - Score: {{ score.score }}</h3>
        <p v-if="score.quiz">{{ score.quiz.name }}</p>
        <p v-else>No quiz data available</p>
      </div>

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
  .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 0 20px; /* Added padding for spacing */
  }
  
  header {
      margin-bottom: 10px;
      margin-top: 30px;
      display: flex;
      align-items: center;
      /* Removed justify-content: center; to keep header left-aligned */
  }
  
  header h1 {
      font-weight: bold;
      margin-right: 30px;
  }
  
  .highscorePage {
      display: flex;
      flex-direction: column;
      align-items: center; /* Center content horizontally */
      justify-content: center; /* Center content vertically */
      text-align: center; /* Center text */
      margin-top: 30px; /* Added margin for spacing from the header */
  }
  
  .user-score {
      margin-bottom: 20px;
      padding: 10px; /* Added padding for spacing */
      border: 1px solid #ddd; /* Added border for better visibility */
      border-radius: 8px; /* Rounded corners */
      background-color: #f9f9f9; /* Background color for each score entry */
      width: 100%; /* Full width for responsive design */
      max-width: 600px; /* Max width for larger screens */
  }
  </style>
  

  