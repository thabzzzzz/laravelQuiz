<template>
   <div>
       <nav>
           <router-link to="/" class="nav-link">Home</router-link>
           <router-link to="/about" class="nav-link">Highscores</router-link>
       </nav>
       <main>
           <router-view></router-view>
       </main>
   </div>
</template>

<style scoped>
nav a {
    text-decoration: none;
    color: black;
    padding: 10px;
    border-bottom: 2px solid transparent;
    transition: color 0.3s ease, border-color 0.3s ease;
}

nav a:hover {
    color: rgb(255, 184, 97); /* Highlight text color */
    border-bottom: 2px solid rgb(255, 184, 97); /* Bottom border color */
}
</style>
