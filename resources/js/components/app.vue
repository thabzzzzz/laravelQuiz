<template>
    <div>
     <nav>
        <router-link to="/">Home</router-link>

        <router-link to="/about">Highscores</router-link>
     </nav>
     <main>
        <router-view></router-view>
     </main>
    </div>
</template>