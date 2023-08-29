import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useSettingStore = defineStore('SettingStore', () => {
    const setting = ref({
        app_name: '',
    });

    const getSetting = () => {
        axios.get('/api/settings')
            .then((response) => {
                setting.value = response.data;
            });
    };

    return { setting, getSetting };
});
