<template>
    <div>
      <!-- Render Quiz Header and Questions -->
      <quizHeader :questionStatus="questionStatus" :barPercentage="barPercentage" />
      <question v-if="!showResult" :question="quiz.questions[currentQuestionIndex]" @SelectedOption="onOptionSelected" />
      <!-- Pass both quizID and numOfCorrectQuestions as props to the result component -->
      <result 
        v-else 
        :numOfCorrectQuestions="numOfCorrectQuestions" 
        :quizQuestionLength="quiz.questions.length" 
        :quizID="quizID"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import question from '../components/question.vue';
  import quizHeader from '../components/quizHeader.vue';
  import result from '../components/result.vue';
  import { useRoute } from 'vue-router';
  import quizes from '../data/quizes.json';
  
  const route = useRoute();
  const quizID = parseInt(route.params.id);  // Dynamically fetch the quiz ID from route params
  const quiz = quizes.find(q => q.id === quizID);
  const currentQuestionIndex = ref(0);
  const numOfCorrectQuestions = ref(0); // Correct answers count
  const showResult = ref(false);
  
  const questionStatus = computed(() => `${currentQuestionIndex.value}/${quiz.questions.length}`);
  const barPercentage = computed(() => `${Math.floor((currentQuestionIndex.value / quiz.questions.length) * 100)}%`);
  
  const onOptionSelected = (isCorrect) => {
    if (isCorrect) {
      numOfCorrectQuestions.value++;
    }
    if (quiz.questions.length - 1 === currentQuestionIndex.value) {
      showResult.value = true; // Show result when all questions are answered
    }
    currentQuestionIndex.value++;
  };
  </script>
  