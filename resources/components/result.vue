<template>
    <div class="result-container">
      <h2>Quiz Results</h2>
      <p>Score: {{ numOfCorrectQuestions }} / {{ quizQuestionLength }}</p>
  
      <div class="upload-form">
        <input v-model="username" placeholder="Enter your username" />
        <button @click="uploadHighScore">Upload Highscore</button>
        <div v-if="numOfCorrectQuestions !== undefined">
          <p>Current Score: {{ numOfCorrectQuestions }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps } from 'vue';
  import axios from 'axios';
  
  // Define reactive variables and props
  const props = defineProps(['numOfCorrectQuestions', 'quizQuestionLength']);
  const username = ref('');
  const numOfCorrectQuestions = ref(props.numOfCorrectQuestions || 0); // Default value for testing
  
  const uploadHighScore = async () => {
    console.log('Upload Highscore button clicked');
    console.log('Username:', username.value);
    console.log('Score:', numOfCorrectQuestions.value);
  
    try {
      const response = await axios.post('/highscores', {
        username: username.value,
        quiz_id: props.quizID, // Ensure this prop is correctly passed
        score: numOfCorrectQuestions.value,
      });
  
      console.log('Response:', response.data);
      alert('Highscore uploaded successfully');
    } catch (error) {
      console.error('Error uploading highscore:', error);
      alert('Failed to save high score');
    }
  };
  </script>
  
  <style scoped>
  .result-container {
    padding: 20px;
    text-align: center;
  }
  
  .upload-form {
    margin-top: 20px;
  }
  
  .upload-form input {
    padding: 10px;
    font-size: 16px;
    width: 80%;
    max-width: 300px;
    margin-right: 10px;
  }
  
  .upload-form button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  .upload-form button:hover {
    background-color: #0056b3;
  }
  
  .upload-form p {
    margin-top: 10px;
    font-size: 18px;
  }
  </style>
  