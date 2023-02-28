<template>
    <HeaderView />
    <Transition class="animate__animated animate__fadeIn">
        <div>
            <SidebarView />
            <main id="main" class="main" v-if="this.$userStore.isLoggedIn">

                <div class="pagetitle">
                    <h1>My Profile</h1>
                </div><!-- End Page Title -->

                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card border-3 border-top border-primary">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo"
                                        alt="Profile" class="rounded-circle float-start me-3 p-1 border border-3 border-primary"
                                        v-if="this.$userStore.isLoggedIn && this.$userStore.user.user_photo.includes('assets/profile')">
                                    <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo"
                                        alt="Profile" class="rounded-circle float-start me-3 p-1 border border-3 border-primary" v-else-if="this.$userStore.isLoggedIn">
                                    <h2>{{ this.$userStore.user.user_alias_name }}</h2>
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
                                            <button class="nav-link d-flex align-items-center bg-transparent active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview"><i class="ri-profile-fill me-2"></i> Overview</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link d-flex align-items-center bg-transparent" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit"><i class="ri-edit-box-fill me-2"></i> Edit Profile</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link d-flex align-items-center bg-transparent" data-bs-toggle="tab" 
                                                data-bs-target="#profile-teammates" @click="loadTeammates"><i class="ri-team-fill me-2"></i> Teammates</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link d-flex align-items-center bg-transparent" data-bs-toggle="tab" 
                                                data-bs-target="#profile-kudos"><i class="ri-thumb-up-fill me-2"></i> Kudos</button>
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
                                            <div>
                                                <div class="row mb-3">
                                                    <label for="profileImage"
                                                        class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo"
                                                            alt="Profile"
                                                            v-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('assets/profile')">
                                                        <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo"
                                                            alt="Profile" class="rounded-circle"
                                                            v-else-if="this.imageUrl == null && this.$userStore.user.user_photo.includes('filesystem')">
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

                                        <div class="tab-pane fade pt-3" id="profile-teammates">

                                            <div class="profile-teammates container">
                                                <div class="row mb-5" v-for="(team, teamName) in groupedUsers" :key="teamName">
                                                    <h2 class="p-3 mt-0 mb-3 bg-primary text-white fs-6 fw-bold d-flex align-items-center"><i class="ri-group-fill fs-4 me-3"></i> {{ teamName }}</h2>
                                                    <div class="col-4 p-3 d-flex align-items-center" v-for="user in team" :key="user.user_full_name" @click="viewProfile(user)">
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
import { lStore, delay, showAlert, scrollToTop } from '@/controller';
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
            users: {},
            groupedUsers: {}
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

        this.loadTeammates();
    },
    methods: {
        updateProfile() {
            this.loading = true;

            if (this.selectedImage == null) {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/editUser?userid=${this.$userStore.user.user_id}&password=${this.user.password}&confirmpassword=${this.user.confirm_password}&zimbraemail=${this.user.zimbra_email}&gmailemail=${this.user.gmail_email}&skypename=${this.user.skype_name}&webmail=${this.user.emailer_email}&emaileremail=${this.user.emailer_email}&contactnumber=${this.user.contact_number}`).then((res) => {
                    console.log(res);
                    if (res.data.success) {
                        delay(0).then(() => {
                            const userStore = useUserStore();
                            userStore.setUser(res.data.result);
                            lStore.setObject('user_information', res.data.result);
                        }).then(() => {
                            delay(0)
                                .then(() => showAlert('alert-success', 'Updated Successful!', 'bi-check-circle-fill'))
                                .then(() => this.loading = false)
                                .then(() => {
                                    this.user.password = '';
                                    this.user.confirm_password = '';
                                    scrollToTop();
                                });
                        });
                    } else {
                        delay(0)
                            .then(() => showAlert('alert-danger', res.data.msg, 'bi-exclamation-circle-fill'))
                            .then(() => this.loading = false);
                    }
                });
            } else {
                let file = this.selectedImage;
                let formData = new FormData();
                formData.append('file', file);
                formData.append('userid', this.$userStore.user.user_id);
                axios.post('http://ns.proweaver.host/nsorchestra/api/Usercontroller/uploadfile?' + '&type=' + this.fileType(file.name), formData).then(res => {
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
                                delay(0)
                                    .then(() => showAlert('alert-success', 'Updated Successful!', 'bi-check-circle-fill'))
                                    .then(() => this.loading = false)
                                    .then(() => {
                                        this.user.password = '';
                                        this.user.confirm_password = '';
                                        scrollToTop();
                                    });
                            });
                        } else {
                            delay(0)
                                .then(() => showAlert('alert-danger', res.data.msg, 'bi-exclamation-circle-fill'))
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
        loadTeammates() {
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showteam?teamid=${this.$userStore.user.team_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            reject(new Error('No data received from server'));
                            return;
                        }
                        this.users = res.data.result;
                        console.log(this.users);
                        this.groupedUsers = this.groupByTeam(this.users);
                        resolve(this.groupedUsers);
                    }).catch(error => {
                        reject(error);
                    });
            });
        },
        groupByTeam(users) {
            return users.reduce((acc, user) => {
                if (!acc[user.team_name]) {
                    acc[user.team_name] = []
                }
                acc[user.team_name].push(user)
                return acc
            }, {});
        },
        viewProfile(user) {
            delay(0)
                .then(() => lStore.setObject('view_profile', user))
                .then(() => {
                    if (user.user_id == this.$userStore.user.user_id) this.$router.push('/profile').then(() => delay(500).then(() => scrollToTop()));
                    else this.$router.push('/userprofile');
                });
        }
    }
};
</script>

<style scoped>
.profile-card img, .profile .profile-edit img,
form img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    color: transparent;
}

.profile-teammates > *:hover {
    cursor: pointer;
}

.profile-teammates > div > div:hover h6 {
    opacity: 0.6;
    color: var(--text-color-link);
}

.profile-teammates > div > div:hover img {
    opacity: 0.6;
}

.profile-teammates img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    color: transparent;
}
</style>