import axios from 'axios';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const user = ref({
        name: '',
        email: '',
        role: '',
        avatar: '',
    });

    const getAuthUser = () => {
        axios.get('/api/profile')
            .then((response) => {
                user.value = response.data;
            });
    };

    return { user, getAuthUser };
});
