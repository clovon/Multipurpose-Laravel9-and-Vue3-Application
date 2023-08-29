<script setup>
import { ref, onMounted } from 'vue';
import AppNavbar from './components/AppNavbar.vue';
import SidebarLeft from './components/SidebarLeft.vue';
import SidebarRight from './components/SidebarRight.vue';
import AppFooter from './components/AppFooter.vue';
import { useAuthUserStore } from './stores/AuthUserStore';

const authUserStore = useAuthUserStore();
</script>

<template>
    <div v-if="authUserStore.user.name !== ''" class="wrapper" id="app">
        <AppNavbar />
        <SidebarLeft/>
        <div class="content-wrapper">
            <router-view></router-view>
        </div>
        <SidebarRight />
        <AppFooter />
</div>
<div v-else class="login-page">
    <router-view></router-view>
</div>
</template>
