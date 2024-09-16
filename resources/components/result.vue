<template>
    <div class="result-container">
      <!-- Display the score -->
      <p>Your Score: {{ numOfCorrectQuestions }} / {{ quizQuestionLength }}</p>
      
      <!-- Form for uploading the high score -->
      <div class="upload-form">
        <input v-model="username" placeholder="Enter your username" />
        <button class="uploadscore" @click="uploadHighScore">Upload Highscore</button>
        <p v-if="uploadSuccessMessage">{{ uploadSuccessMessage }}</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  
  // Receive the quizID, numOfCorrectQuestions, and quizQuestionLength as props
  const props = defineProps({
    numOfCorrectQuestions: Number,
    quizQuestionLength: Number,
    quizID: Number
  });
  
  const username = ref('');
  const uploadSuccessMessage = ref('');
  
  const uploadHighScore = async () => {
    console.log('Upload Highscore button clicked');
    console.log('Username:', username.value);
    console.log('Quiz ID:', props.quizID);
    console.log('Score:', props.numOfCorrectQuestions);
  
    try {
      const response = await axios.post('/highscores', {
        username: username.value,
        quiz_id: props.quizID,
        score: props.numOfCorrectQuestions,
      });
  
      console.log('Response:', response.data);
      uploadSuccessMessage.value = 'Highscore uploaded successfully!';
    } catch (error) {
      if (error.response) {
        console.error('Error uploading highscore:', error.response.data);
        alert(`Failed to save high score: ${error.response.data.message}`);
      } else {
        console.error('Error uploading highscore:', error.message);
        alert('Failed to save high score');
      }
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
    background-color: bisque;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  .upload-form button:hover {
    background-color: rgb(255, 184, 97);
  }
  
  .upload-form p {
    margin-top: 10px;
    font-size: 18px;
  }

  .uploadscore{
    color: black;
  }
  </style>
  