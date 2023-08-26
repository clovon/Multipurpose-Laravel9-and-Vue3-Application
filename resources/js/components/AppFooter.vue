<script setup>
import { useAuthUserStore } from '../stores/AuthUserStore';
const authUserStore = useAuthUserStore();

defineProps({
    settings: Object,
});
</script>

<template>
    <footer class="main-footer">

        <div class="float-right d-none d-sm-inline">
            {{ authUserStore.user.name }}
        </div>

        <strong>Copyright &copy; 2023 <a href="#">{{ settings?.app_name }}</a>.</strong> All rights
        reserved.
    </footer>
</template>
