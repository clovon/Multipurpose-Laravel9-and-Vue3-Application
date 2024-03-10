<script setup>
defineProps({
    loading: {
        type: Boolean,
        default: false,
        required: true,
    }
});
</script>

<template>
    <div v-if="loading" class="preloader flex-column justify-content-center align-items-center">
        <span class="loader"></span>
        <!-- <img class="animation__shake" src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
    </div>
</template>

<style>
.preloader {
    background-color: black;
    opacity: 95%;
}

.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: #007bff;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
</style>
