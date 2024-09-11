<template>
    <div>
      <quizHeader :questionStatus="questionStatus" :barPercentage="barPercentage" />
      <question v-if="!showResult" :question="quiz.questions[currentQuestionIndex]" @SelectedOption="onOptionSelected" />
      <result
        v-else
        :numOfCorrectQuestions="numOfCorrectQuestions"
        :quizQuestionLength="quiz.questions.length"
        :quizID="quizID"
      />
    </div>
  </template>
  
  <script setup>
  import quizHeader from '../components/quizHeader.vue';
  import question from '../components/question.vue';
  import result from '../components/result.vue';
  import { ref, computed } from 'vue';
  import { useRoute } from 'vue-router';
  import quizes from '../data/quizes.json';
  
  // Get the quiz ID from route parameters
  const route = useRoute();
  const quizID = ref(parseInt(route.params.id));
  
  // Find the quiz data based on the quiz ID
  const quiz = quizes.find(q => q.id === quizID.value);
  
  const currentQuestionIndex = ref(0);
  const showResult = ref(false);
  
  const questionStatus = computed(() => `${currentQuestionIndex.value}/${quiz.questions.length}`);
  const barPercentage = computed(() => `${Math.floor((currentQuestionIndex.value / quiz.questions.length) * 100)}%`);
  
  const numOfCorrectQuestions = ref(0);
  
  const onOptionSelected = (isCorrect) => {
    if (isCorrect) {
      numOfCorrectQuestions.value++;
    }
    if (quiz.questions.length - 1 === currentQuestionIndex.value) {
      showResult.value = true;
    }
    currentQuestionIndex.value++;
  };
  </script>
  

<style scoped></style>