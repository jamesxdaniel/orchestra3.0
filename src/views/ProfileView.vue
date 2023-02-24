<template>
    <Transition class="animate__animated animate__fadeIn">
        <div>
            <HeaderView />
            <SidebarView />
            <main id="main" class="main" v-if="this.$userStore.isLoggedIn">

                <div class="pagetitle">
                    <h1>Profile</h1>
                </div><!-- End Page Title -->

                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo" alt="Profile" class="rounded-circle" v-if="this.$userStore.isLoggedIn && this.$userStore.user.user_photo.includes('assets/profile')">
                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo" alt="Profile" class="rounded-circle" v-else-if="this.$userStore.isLoggedIn">
                                    <h2>{{ this.$userStore.user.alias_name }}</h2>
                                    <h3>{{ this.$userStore.user.team_name }}</h3>
                                    <ul class="list-group list-group-flush bg-transparent w-100 mt-3">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            QA Error <span class="badge bg-primary rounded-pill">14</span></li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Tasks <span class="badge bg-primary rounded-pill">2</span></li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Pending Tasks <span class="badge bg-primary rounded-pill">1</span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link  bg-transparent active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview" @click="updateData">Overview</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link bg-transparent" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link bg-transparent" data-bs-toggle="tab"
                                                data-bs-target="#profile-settings">Teammates</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <h5 class="card-title">Profile Details</h5>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-team-fill me-3 fs-5"></i> Team Name</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.team_name }}</div>
                                            </div>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-mail-fill me-3 fs-5"></i> Email</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.user_email }}</div>
                                            </div>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-phone-fill me-3 fs-5"></i> Contact Number</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.user_phone }}</div>
                                            </div>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-mail-fill me-3 fs-5"></i> Zimbra Email</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.user_zimbra_email }}
                                                </div>
                                            </div>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-google-fill me-3 fs-5"></i> Gmail Email</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.user_gmail_email }}
                                                </div>
                                            </div>

                                            <div class="row border-bottom pb-3">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-skype-fill me-3 fs-5"></i> Skype Name</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.user_skype_name }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center"><i
                                                        class="ri-mail-fill me-3 fs-5"></i> Web Mail</div>
                                                <div class="col-lg-9 col-md-8">{{ this.$userStore.user.security_email }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                            <!-- Profile Edit Form -->
                                            <form>
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo" alt="Profile" v-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('assets/profile')">
                                                        <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo" alt="Profile" class="rounded-circle" v-else-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('filesystem')">
                                                        <img :src="this.imageUrl" alt="Profile" v-else>
                                                        <div class="pt-2">
                                                            <input type="file" id="openFile" hidden @change="onImageChange">
                                                            <label for="openFile"><a class="btn btn-sm btn-primary"><i
                                                                        class="bi bi-upload"></i></a></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                        Name</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="fullName" type="text" class="form-control"
                                                            id="full_name"
                                                            :placeholder="this.$userStore.user.user_full_name" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="fullName"
                                                        class="col-md-4 col-lg-3 col-form-label">A.K.A</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="fullName" type="text" class="form-control"
                                                            id="alias_name"
                                                            :placeholder="this.$userStore.user.user_alias_name" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Email
                                                        Address</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="fullName" type="text" class="form-control"
                                                            id="emailer_email"
                                                            :placeholder="this.$userStore.user.user_email" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Contact
                                                        Number</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="text" class="form-control"
                                                            id="contact_number" v-model="user.contact_number"
                                                            :placeholder="this.$userStore.user.user_phone">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="company"
                                                        class="col-md-4 col-lg-3 col-form-label">Password</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="password" class="form-control"
                                                            id="password" v-model="user.password" placeholder="********">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Confirm
                                                        Password</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="password" class="form-control"
                                                            id="confirm_password" v-model="user.confirm_password"
                                                            placeholder="********">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Zimbra
                                                        Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="text" class="form-control"
                                                            id="zimbra_email" v-model="user.zimbra_email"
                                                            :placeholder="this.$userStore.user.user_zimbra_email">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Gmail
                                                        Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="text" class="form-control"
                                                            id="zimbra_email" v-model="user.gmail_email"
                                                            :placeholder="this.$userStore.user.user_gmail_email">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Skype
                                                        Name</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="company" type="text" class="form-control"
                                                            id="zimbra_email" v-model="user.skype_name"
                                                            :placeholder="this.$userStore.user.user_skype_name">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Emailer
                                                        Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="email" type="email" class="form-control" id="Email"
                                                            v-model="user.emailer_email"
                                                            :placeholder="this.$userStore.user.user_emailer_email">
                                                    </div>
                                                </div>

                                                <div class="text-end">
                                                    <a href="#" type="submit" class="btn btn-primary"
                                                        @click="updateProfile">Save Changes</a>
                                                </div>
                                            </form><!-- End Profile Edit Form -->

                                        </div>

                                        <div class="tab-pane fade pt-3" id="profile-settings">

                                            <div class="container text-center">
                                                <div class="row align-items-start">
                                                    <div class="col" v-for="(teammates, index) in this.teammates" :key="index">
                                                    {{ teammates.team_name }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </main>
        </div>
    </Transition>
</template>

<script>
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';
import { useUserStore } from '@/store';
import { lStore, delay, showAlert } from '@/controller';
import axios from 'axios';

export default {
    components: { HeaderView, SidebarView },
    data() {
        return {
            loading: false,
            user: {},
            path: '',
            chosenFile: [],
            imageUrl: null,
            selectedImage: null,
            teammates: {}
        }
    },
    mounted() {
        this.user.password = '';
        this.user.confirm_password = '';
        this.user.contact_number = this.$userStore.user.user_phone;
        this.user.zimbra_email = this.$userStore.user.user_zimbra_email;
        this.user.gmail_email = this.$userStore.user.user_gmail_email;
        this.user.skype_name = this.$userStore.user.user_skype_name;
        this.user.emailer_email = this.$userStore.user.emailer_email;
        this.user.profilepicture = this.selectedImage;
        console.log(this.user);

        axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showteam?teamid=${this.$userStore.user.team_id}`).then((res) => {
            if (res.data.result == null) return;
            this.teammates = res.data.result;
            console.log(this.teammates);
        });
    },
    methods: {
        updateProfile() {
            if (this.selectedImage == null) {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/editUser?userid=${this.$userStore.user.user_id}&password=${this.user.password}&confirmpassword=${this.user.confirm_password}&zimbraemail=${this.user.zimbra_email}&gmailemail=${this.user.gmail_email}&skypename=${this.user.skype_name}&webmail=${this.user.emailer_email}&emaileremail=${this.user.emailer_email}&contactnumber=${this.user.contact_number}`).then((res) => {
                    console.log(res);
                    if (res.data.success) {
                        delay(0).then(() => {
                            const userStore = useUserStore();
                            userStore.setUser(res.data.result);
                            lStore.setObject('user_information', res.data.result);
                        }).then(() => {
                            this.user.password = '';
                            this.user.confirm_password = '';
                            showAlert('alert-success', 'Updated Successful!', 'bi-check-circle-fill');
                        });
                    } else {
                        showAlert('alert-danger', res.data.msg, 'bi-exclamation-circle-fill');
                    }
                });
            }
            else {
                let file = this.selectedImage;
                let formData = new FormData();
                formData.append('file',file);
                formData.append('userid',this.$userStore.user.user_id);
                axios.post('http://ns.proweaver.host/nsorchestra/api/Usercontroller/uploadfile?' + '&type=' + this.fileType(file.name),formData).then(res => {
                    if (res.data.success === false) alert(res.data.msg);
                    console.log(res);
                }).then(() => {
                    axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/editUser?userid=${this.$userStore.user.user_id}&password=${this.user.password}&confirmpassword=${this.user.confirm_password}&zimbraemail=${this.user.zimbra_email}&gmailemail=${this.user.gmail_email}&skypename=${this.user.skype_name}&webmail=${this.user.emailer_email}&emaileremail=${this.user.emailer_email}&contactnumber=${this.user.contact_number}`).then((res) => {
                        console.log(res);
                        if (res.data.success) {
                            delay(0).then(() => {
                                const userStore = useUserStore();
                                userStore.setUser(res.data.result);
                                lStore.setObject('user_information', res.data.result);
                            }).then(() => {
                                this.user.password = '';
                                this.user.confirm_password = '';
                                showAlert('alert-success', 'Updated Successful!', 'bi-check-circle-fill');
                            });
                        } else {
                            showAlert('alert-danger', res.data.msg, 'bi-exclamation-circle-fill');
                        }
                    });
                });                
            }
        },
        onImageChange(e) {
            const selectedFile = e.target.files[0];
            this.imageUrl = URL.createObjectURL(selectedFile);
            this.selectedImage = e.target.files[0];
            console.log(this.imageUrl, this.selectedImage);
        },
        fileType(filename) {
            if (typeof filename != 'string') return;
            let fileSplit = filename.toLowerCase().split('.');
            let ext = fileSplit[fileSplit.length - 1];
            let image = ['gif', 'png', 'jpg', 'jpeg'];
            let video = ['mp4', 'webm', 'ogv'];
            let doc = ['doc', 'docx', 'xls', 'xlsx', 'csv', 'pdf'];
            if (image.includes(ext)) return 'image';
            if (video.includes(ext)) return 'video';
            if (doc.includes(ext)) return 'document';
            return '';
        },
    }
};
</script>

<style scoped>
.profile-card img, form img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
}
</style>