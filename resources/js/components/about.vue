<template>
    <div class="container">
      <header>
        <h1>Quizzy</h1>
      </header>
  
      <div class="highscorePage">
        <h2>High Scores</h2>
        <div v-for="(score, index) in topScores" :key="index" class="user-score" ref="scoreRefs">
          <h3>{{ index + 1 }}. {{ score.username }} - Score: {{ score.total_score }}</h3>
          <p v-if="score.quiz">{{ score.quiz.name }}</p>
          <p v-else>No quiz data available</p>
        </div>
      </div>
    </div>
  </template>
  
  
  <script setup>
  import { ref, onMounted, nextTick } from 'vue';
  import axios from 'axios';
  import gsap from 'gsap';
  
  const topScores = ref([]);
  
  // Fetch top scores from API
  const fetchTopScores = async () => {
    try {
      const response = await axios.get('/api/top-highscores');
      topScores.value = response.data;
  
      // Wait until the DOM is updated before applying animations
      await nextTick();
      animateScores();
    } catch (error) {
      console.error('Error fetching top scores:', error);
    }
  };
  
  // Function to animate scores with GSAP
  const animateScores = () => {
    const scoreElements = document.querySelectorAll('.user-score');
    gsap.fromTo(
      scoreElements,
      { opacity: 0, y: 20 },  // Starting from transparent and slightly below
      { opacity: 1, y: 0, duration: 0.5, stagger: 0.2 }  // Fade in and move up with staggered timing
    );
  };
  
  // Fetch top scores on component mount
  onMounted(() => {
    fetchTopScores();
  });
  </script>
  
  <style scoped>
  .container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
  }
  
  header {
    margin-bottom: 10px;
    margin-top: 30px;
    display: flex;
    align-items: center;
  }
  
  header h1 {
    font-weight: bold;
    margin-right: 30px;
  }
  
  .highscorePage {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-top: 30px;
  }
  
  .user-score {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    width: 100%;
    max-width: 600px;
  }
  </style>
  