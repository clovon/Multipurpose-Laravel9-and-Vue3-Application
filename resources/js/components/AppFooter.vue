<script setup>
defineProps({
    settings: Object,
});
</script>

<template>
    <footer class="main-footer">

        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>

        <strong>Copyright &copy; 2023 <a href="#">{{ settings?.app_name }}</a>.</strong> All rights
        reserved.
    </footer>
</template>
