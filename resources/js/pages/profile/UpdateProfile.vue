<script setup>
import { onMounted, reactive, ref } from 'vue';
import { useToastr } from '@/toastr';

const toastr = useToastr();

const form = ref({
    name: '',
    email: '',
    role: '',
});

const getUser = () => {
    axios.get('/api/profile')
    .then((response) => {
        form.value = response.data;
    });
};

const errors = ref([]);
const updateProfile = () => {
    axios.put('/api/profile', form.value)
    .then((response) => {
        toastr.success('Profile updated successfully!');
    })
    .catch((error) => {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    });
};

const changePasswordForm = reactive({
    currentPassword: '',
    password: '',
    passwordConfirmation: '',
});

const handleChangePassword = () => {
    errors.value = '';
    axios.post('/api/change-user-password', changePasswordForm)
    .then((response) => {
        toastr.success(response.data.message);
        for (const field in changePasswordForm) {
            changePasswordForm[field] = '';
        }
    })
    .catch((error) => {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    });
};

const fileInput = ref(null);

const openFileInput = () => {
    fileInput.value.click();
};

const profilePictureUrl = ref(null);

const handleFileChange = (event) => {
    const file = event.target.files[0];
    profilePictureUrl.value = URL.createObjectURL(file);

    const formData = new FormData();
    formData.append('profile_picture', file);

    axios.post('/api/upload-profile-image', formData)
    .then((response) => {
        toastr.success('Image uploaded successfully!');
    });
};

onMounted(() => {
    getUser();
});
</script>
<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <input @change="handleFileChange" ref="fileInput" type="file" class="d-none">
                                <img @click="openFileInput" class="profile-user-img img-circle" :src="profilePictureUrl ? profilePictureUrl : form.avatar" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ form.name }}</h3>

                            <p class="text-muted text-center">{{ form.role }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab"><i
                                            class="fa fa-user mr-1"></i> Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab"><i
                                            class="fa fa-key mr-1"></i> Change
                                        Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <form @submit.prevent="updateProfile()" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input v-model="form.name" type="text" class="form-control" id="inputName" placeholder="Name">
                                                <span class="text-danger text-sm" v-if="errors && errors.name">{{ errors.name[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input v-model="form.email" type="email" class="form-control " id="inputEmail"
                                                    placeholder="Email">
                                                <span class="text-danger text-sm" v-if="errors && errors.email">{{ errors.email[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fa fa-save mr-1"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword">
                                    <form @submit.prevent="handleChangePassword" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="currentPassword" class="col-sm-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input v-model="changePasswordForm.currentPassword" type="password" class="form-control " id="currentPassword"
                                                    placeholder="Current Password">
                                                    <span class="text-danger text-sm" v-if="errors && errors.current_password">{{ errors.current_password[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-3 col-form-label">New
                                                Password</label>
                                            <div class="col-sm-9">
                                                <input v-model="changePasswordForm.password" type="password" class="form-control " id="newPassword"
                                                    placeholder="New Password">
                                                <span class="text-danger text-sm" v-if="errors && errors.password">{{ errors.password[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm
                                                New Password</label>
                                            <div class="col-sm-9">
                                                <input v-model="changePasswordForm.passwordConfirmation" type="password" class="form-control " id="passwordConfirmation"
                                                    placeholder="Confirm New Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fa fa-save mr-1"></i> Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

    </div>
</div>
</template>

<style>
    .profile-user-img:hover {
        background-color: blue;
        cursor: pointer;
    }
</style>
