<template>
    <HeaderView />
    <SidebarView />
    <Transition class="animate__animated animate__fadeIn">
        <main id="main" class="main" v-if="this.$userStore.isLoggedIn">

            <div class="pagetitle">
                <h1>My Profile</h1>
            </div>

            <section class="section default-tab">
                <div class="row">

                    <div class="col-xl-3">

                        <div class="card border-3 border-top border-primary">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo"
                                    alt="Profile"
                                    class="rounded-circle float-start me-3 p-1 border border-3 border-primary"
                                    v-if="this.$userStore.isLoggedIn && this.$userStore.user.user_photo.includes('assets/profile')">
                                <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo"
                                    alt="Profile"
                                    class="rounded-circle float-start me-3 p-1 border border-3 border-primary"
                                    v-else-if="this.$userStore.isLoggedIn">
                                <h2>{{ this.$userStore.user.user_full_name }}</h2>
                                <h3>{{ currentUserRole }}</h3>
                                <ul class="list-group list-group-flush bg-transparent w-100 mt-4">
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

                    <div class="col-xl-9">

                        <div class="card">
                            <div class="card-body pt-3">

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent active"
                                            data-bs-toggle="tab" data-bs-target="#profile-overview">
                                            <i class="ri-profile-fill me-2"></i> Overview
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent"
                                            data-bs-toggle="tab" data-bs-target="#profile-edit">
                                            <i class="ri-edit-box-fill me-2"></i> Edit Profile
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent"
                                            data-bs-toggle="tab" data-bs-target="#profile-teammates"
                                            @click="loadTeammates(this.$userStore.user.team_id)">
                                            <i class="ri-team-fill me-2"></i> Teammates
                                        </button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent"
                                            data-bs-toggle="tab" data-bs-target="#profile-kudos">
                                            <i class="ri-thumb-up-fill me-2"></i> Kudos
                                        </button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade profile-overview show active" id="profile-overview">
                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-team-fill me-3 fs-5"></i> Team Name
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.team_name == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.team_name }}</div>
                                        </div>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-mail-fill me-3 fs-5"></i> Email
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.user_email == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.user_email }}</div>
                                        </div>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-contacts-book-2-fill me-3 fs-5"></i> Contact Number
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.user_phone == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.user_phone }}</div>
                                        </div>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-mail-fill me-3 fs-5"></i> Zimbra Email
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.user_zimbra_email == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.user_zimbra_email }}</div>
                                        </div>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-google-fill me-3 fs-5"></i> Gmail Email
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.user_gmail_email == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.user_gmail_email }}</div>
                                        </div>

                                        <div class="row border-bottom pb-3">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-skype-fill me-3 fs-5"></i> Skype Name
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.user_skype_name == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.user_skype_name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label d-inline-flex align-items-center">
                                                <i class="ri-mail-fill me-3 fs-5"></i> Web Mail
                                            </div>
                                            <div class="col-lg-9 col-md-8" v-if="this.$userStore.user.security_email == ''">&mdash;</div>
                                            <div class="col-lg-9 col-md-8" v-else>{{ this.$userStore.user.security_email }}</div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade profile-edit" id="profile-edit">
                                        <h5 class="card-title">Profile Edit</h5>

                                        <!-- Profile Edit Form -->
                                        <div>
                                            <div class="row mb-3">
                                                <label for="profileImage"
                                                    class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                <div class="col-md-8 col-lg-9 d-flex align-items-center">
                                                    <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo"
                                                        alt="Profile"
                                                        class="rounded-circle p-1 border border-3 border-primary me-3"
                                                        v-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('assets/profile')">
                                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo"
                                                        alt="Profile"
                                                        class="rounded-circle p-1 border border-3 border-primary me-3"
                                                        v-else-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('filesystem')">
                                                    <img :src="this.imageUrl" alt="Profile"
                                                        class="rounded-circle p-1 border border-3 border-primary me-3"
                                                        v-else>
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
                                                <button type="submit" class="btn btn-primary" @click="updateProfile"
                                                    :disabled="this.loading">
                                                    <span v-if="!this.loading">Save Changes</span>
                                                    <span class="spinner-border spinner-border-sm me-2" role="status"
                                                        aria-hidden="true" v-if="this.loading"></span>
                                                    <span v-if="this.loading">Saving Changes</span>
                                                </button>
                                            </div>
                                        </div><!-- End Profile Edit Form -->

                                    </div>

                                    <div class="tab-pane fade profile-teammates" id="profile-teammates">
                                        <h5 class="card-title d-flex align-items-center" v-if="this.$userStore.user.team_name == null"><i class="ri-team-fill me-2"></i> No Team Found</h5>
                                        <h5 class="card-title d-flex align-items-center" v-else><i class="ri-team-fill me-2"></i> {{ this.$userStore.user.team_name }}</h5>

                                        <div class="profile-teammates-container px-3">
                                            <div class="row mb-5" v-for="(team, teamName) in groupedUsers"
                                                :key="teamName">
                                                <h2
                                                    class="p-3 mt-0 mb-3 bg-gradient text-white fs-6 fw-bold d-flex align-items-center">
                                                    <i class="ri-group-fill fs-4 me-3"></i> {{ teamName }}
                                                </h2>
                                                <div class="col-12 col-md-9 col-lg-4 p-3 d-flex align-items-center"
                                                    v-for="user in team" :key="user.user_full_name"
                                                    @click="viewProfile(user)">
                                                    <img :src="`https://office.orchestra.tools/` + user.user_photo"
                                                        alt="Profile"
                                                        class="rounded-circle float-start me-3 p-1 border border-2 border-primary"
                                                        v-if="user.user_photo.includes('assets/profile')">
                                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + user.user_photo"
                                                        alt="Profile"
                                                        class="rounded-circle float-start me-3 p-1 border border-2 border-primary"
                                                        v-else>
                                                    <h6 class="m-0">{{ user.user_full_name }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade profile-kudos" id="profile-kudos">
                                        <div class="container p-0 p-md-3 position-relative" v-if="this.kudosList.length > 0">
                                            <div id="carouselKudos" class="carousel slide pointer-event p-3 px-0 px-md-3" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item" v-for="(item, index) in this.kudosList" :class="{ 'active': isActive(index) }">
                                                        <div class="d-flex justify-content-center align-items-center flex-column text-center h-100 px-1 px-md-3 px-lg-5">
                                                            <div class="row justify-content-center align-items-center w-auto mb-3 mb-md-4 g-3 g-md-5 px-3 px-md-0">
                                                                <div class="col-auto d-flex flex-column justify-content-center align-items-center user-select-none"
                                                                    v-for="(user, index) in item.users" :key="index"
                                                                    @click="viewProfile(user)">
                                                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo" :alt="user.user_id"
                                                                        class="rounded-circle float-start p-1 border border-3 border-primary"
                                                                        v-if="user.user_id == this.$userStore.user.user_id">
                                                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + user.user_photo" :alt="user.user_id"
                                                                        class="rounded-circle float-start p-1 border border-3 border-primary"
                                                                        v-else-if="user.user_id != this.$userStore.user.user_id && !user.user_photo.includes('assets/profile')">
                                                                    <img :src="`https://office.orchestra.tools/` + user.user_photo" :alt="user.user_id"
                                                                        class="rounded-circle float-start p-1 border border-3 border-primary"
                                                                        v-else-if="user.user_id != this.$userStore.user.user_id && user.user_photo.includes('assets/profile')">
                                                                    <img :src="`https://office.orchestra.tools/` + user.user_photo"
                                                                        alt="Profile"
                                                                        class="rounded-circle float-start p-1 border border-3 border-primary"
                                                                        v-else>
                                                                    <span class="mt-2 text-primary">{{ user.user_alias_name }}</span>
                                                                </div>
                                                            </div>
                                                            <span class="w-auto">{{ item.message }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev text-primary d-none d-md-flex" data-bs-target="#carouselKudos" data-bs-slide="prev">
                                                <i class="ri-arrow-left-s-fill" aria-hidden="true"></i>
                                            </a>
                                            <a class="carousel-control-next text-primary d-none d-md-flex" data-bs-target="#carouselKudos" data-bs-slide="next">
                                                <i class="ri-arrow-right-s-fill" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="container py-5" v-else>
                                            <div class="d-flex justify-content-center align-items-center flex-column text-center">
                                                <span class="text-secondary">No Kudos Found</span>
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
    </Transition>
</template>

<script>
import { useUserStore } from '@/store/store';
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';
import { lStore, delay, showToast, scrollToTop, cleanText } from '@/controller';
import axios from 'axios';

export default {
    components: { HeaderView, SidebarView },
    data() {
        return {
            loading: false,
            currentUserId: this.$userStore.user.user_id,
            user: {},
            path: '',
            chosenFile: [],
            imageUrl: null,
            selectedImage: null,
            users: {},
            groupedUsers: {},
            kudosList: {},
            activeIndex: 0
        }
    },
	setup() {
		const userStore = useUserStore();
		return { userStore };
	},
    computed: {
        currentUserRole() {
            switch (this.$userStore.user.user_level) {
                case '0' : return 'Unassigned';
                case '1' : return 'Admin';
                case '2' : return 'Supervisor';
                case '3' : return 'Asst. Supervisor';
                case '4' : return 'Member';
                case '5' : return 'TSG';
                case '6' : return 'Supervisor Marketing';
                case '7' : return 'Member Marketing';
                case '8' : return 'Team Lead';
                case '9' : return 'Senior Supervisor';
                default : return 'Unknown status';
            }
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
        // console.log(this.user);

        if (this.$userStore.user.team_id == null) this.loadTeammates('0x0x0x0');
        else this.loadTeammates(this.$userStore.user.team_id);
        
        this.loadKudos().then((res) => {
            if (res.length <= 0) this.kudosList.length = 0;
            else this.kudosList.length = res.length;
        });
    },
    methods: {
        updateProfile() {
            this.loading = true;

            if (this.selectedImage == null) {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/editUser?userid=${this.$userStore.user.user_id}&password=${this.user.password}&confirmpassword=${this.user.confirm_password}&zimbraemail=${this.user.zimbra_email}&gmailemail=${this.user.gmail_email}&skypename=${this.user.skype_name}&webmail=${this.user.emailer_email}&emaileremail=${this.user.emailer_email}&contactnumber=${this.user.contact_number}`).then((res) => {
                    if (res.data.success) {
                        delay(0).then(() => {
                            this.userStore.setUser(res.data.result);
                            lStore.setObject('user_information', res.data.result);
                        }).then(() => {
                            delay(0)
                                .then(() => showToast(res.data.msg, 'alert-success'))
                                .then(() => this.loading = false)
                                .then(() => {
                                    this.user.password = '';
                                    this.user.confirm_password = '';
                                    scrollToTop();
                                });
                        });
                    } else {
                        delay(0)
                            .then(() => showToast(res.data.msg, 'alert-danger'))
                            .then(() => this.loading = false);
                    }
                });
            } else {
                let file = this.selectedImage;
                let formData = new FormData();
                formData.append('file', file);
                formData.append('userid', this.$userStore.user.user_id);
                axios.post('http://ns.proweaver.host/nsorchestra/api/Usercontroller/uploadfile?' + '&type=' + this.fileType(file.name), formData).then(res => {
                    if (res.data.success === false) showToast(res.data.msg, 'alert-danger');
                }).then(() => {
                    axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/editUser?userid=${this.$userStore.user.user_id}&password=${this.user.password}&confirmpassword=${this.user.confirm_password}&zimbraemail=${this.user.zimbra_email}&gmailemail=${this.user.gmail_email}&skypename=${this.user.skype_name}&webmail=${this.user.emailer_email}&emaileremail=${this.user.emailer_email}&contactnumber=${this.user.contact_number}`).then((res) => {
                        if (res.data.success) {
                            delay(0).then(() => {
                                this.userStore.setUser(res.data.result);
                                lStore.setObject('user_information', res.data.result);
                            }).then(() => {
                                delay(0)
                                    .then(() => showToast(res.data.msg, 'alert-success'))
                                    .then(() => this.loading = false)
                                    .then(() => {
                                        this.user.password = '';
                                        this.user.confirm_password = '';
                                        scrollToTop();
                                    });
                            });
                        } else {
                            delay(0)
                                .then(() => showToast(res.data.msg, 'alert-danger'))
                                .then(() => this.loading = false);
                        }
                    });
                });
            }
        },
        onImageChange(e) {
            const selectedFile = e.target.files[0];
            this.imageUrl = URL.createObjectURL(selectedFile);
            this.selectedImage = e.target.files[0];
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
        loadTeammates(team_id) {
            return new Promise((resolve, reject) => {
                if (team_id === '0x0x0x0') {
                    this.groupedUsers = {};
                    resolve(this.groupedUsers);
                } else {
                    axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showteam?teamid=${team_id}`)
                        .then((res) => {
                            if (res.data.result == null) {
                                resolve(res.data.msg);
                                return;
                            }
                            this.users = res.data.result;
                            this.users = this.validateUserStatus(this.users);
                            this.groupedUsers = this.groupByTeam(this.users);
                            resolve(this.groupedUsers);
                        }).catch((error) => {
                            reject(error);
                        });
                }
            });
        },
        validateUserStatus(users) {
            return users.filter(user => user.user_status !== '0');
        },
        groupByTeam(users) {
            return users.reduce((acc, user) => {
                if (user.user_status !== 0) {
                    if (!acc[user.sub_team_name]) {
                        acc[user.sub_team_name] = []
                    }
                    acc[user.sub_team_name].push(user)
                }
                return acc
            }, {});
        },
        viewProfile(user) {
            if (user.user_id == this.currentUserId) return;

            this.loading = true;
            this.kudosList = {};
            
            const toast = showToast('Loading profile', 'alert-info', true).show();
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/viewprofile?userid=${user.user_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            resolve(res.data.msg);
                            return;
                        }
                        delay(0)
                            .then(() => lStore.setObject('view_profile', res.data.result))
                            .then(() => {
                                if (user.user_id == this.currentUserId) {
                                    this.$router.push('/profile').then(() => {
                                        this.loading = false;
                                        toast.hide();
                                        delay(500).then(() => scrollToTop());
                                    });
                                } else {
                                    this.$router.push('/userprofile').then(() => {
                                        this.loading = false;
                                        toast.hide();
                                    });
                                }
                            });
                            resolve(res.data.result);
                    }).catch(error => {
                        reject(error);
                    });
            });
        },
        loadKudos() {
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showKudos?userid=${this.$userStore.user.user_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            resolve(res.data.msg);
                            return;
                        }
                        this.kudosList = res.data.result;
                        this.kudosList.forEach(kudos => {
                            kudos.message = cleanText(kudos.message);
                        });
                        resolve(this.kudosList);
                    }).catch(error => {
                        reject(error);
                    });
            });
        },
        isActive(index) {
            return index === this.activeIndex;
        }
    },
    watch: {
        kudosList: {
            handler: function() {
                // If the first item is not active, set it as active
                if (!this.isActive(0)) {
                    this.activeIndex = 0;
                }
            },
            deep: true
        }
    }
};
</script>

<style scoped>
.profile-card img, .profile-edit img, form img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    color: transparent;
}

.profile-teammates-container>*:hover, .carousel div.col-auto:hover {
    cursor: pointer;
}

.profile-teammates-container>div>div:hover h6, .carousel div.col-auto:hover span {
    opacity: 0.6;
    color: var(--text-color-link);
}

.profile-teammates-container>div>div:hover img, .carousel div.col-auto:hover img {
    opacity: 0.6;
}

.profile-teammates-container img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    color: transparent;
}

.carousel img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    color: transparent;
}
</style>