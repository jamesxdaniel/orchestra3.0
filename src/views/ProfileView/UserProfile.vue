<template>
    <HeaderView />
    <SidebarView />
    <Transition class="animate__animated animate__fadeIn">
        <main id="main" class="main" v-if="this.$userStore.isLoggedIn">

            <div class="pagetitle">
                <h1>Profile</h1>
            </div>

            <section class="section default-tab">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card border-3 border-top border-primary">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img :src="`https://office.orchestra.tools/` + this.loadedUser.user_photo" alt="Profile"
                                    class="rounded-circle float-start me-3 p-1 border border-3 border-primary"
                                    v-if="this.$userStore.isLoggedIn && this.loadedUser.user_photo.includes('assets/profile')">
                                <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.loadedUser.user_photo"
                                    alt="Profile"
                                    class="rounded-circle float-start me-3 p-1 border border-3 border-primary"
                                    v-else-if="this.$userStore.isLoggedIn">
                                <h2>{{ this.loadedUser.user_full_name }}</h2>
                                <h3>{{ loadedUserRole }}</h3>
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

                        <div class="card border-3 border-top border-primary">
                            <div class="card-body profile-details">
                                <h5 class="card-title">Profile Details</h5>
                                
                                <div class="row border-1 border-top-0 border-bottom border-start-0 border-end-0 mb-3 pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-mail-fill me-2 fs-5"></i> Email
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.user_email == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.user_email }}</div>
                                </div>

                                <div class="row border-1 border-top-0 border-bottom border-start-0 border-end-0 mb-3 pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-contacts-book-2-fill me-2 fs-5"></i> Contact Number
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.user_phone == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.user_phone }}</div>
                                </div>

                                <div class="row border-1 border-top-0 border-bottom border-start-0 border-end-0 mb-3 pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-mail-fill me-2 fs-5"></i> Zimbra Email
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.user_zimbra_email == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.user_zimbra_email }}</div>
                                </div>

                                <div class="row border-1 border-top-0 border-bottom border-start-0 border-end-0 mb-3 pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-google-fill me-2 fs-5"></i> Gmail Email
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.user_gmail_email == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.user_gmail_email }}</div>
                                </div>

                                <div class="row border-1 border-top-0 border-bottom border-start-0 border-end-0 mb-3 pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-skype-fill me-2 fs-5"></i> Skype Name
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.user_skype_name == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.user_skype_name }}</div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-12 label d-inline-flex align-items-center text-primary fw-bolder mb-3">
                                        <i class="ri-mail-fill me-2 fs-5"></i> Web Mail
                                    </div>
                                    <div class="col-12" v-if="this.loadedUser.security_email == ''">&mdash;</div>
                                    <div class="col-12">{{ this.loadedUser.security_email }}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">

                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent active"
                                            data-bs-toggle="tab" data-bs-target="#profile-teammates"
                                            @click="loadTeammates(this.loadedUser.team_id)"><i class="ri-team-fill me-2"></i> Teammates</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link d-flex align-items-center bg-transparent"
                                            data-bs-toggle="tab" data-bs-target="#profile-kudos">
                                            <i class="ri-thumb-up-fill me-2"></i> Kudos</button>
                                    </li>

                                </ul>

                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade profile-teammates show active" id="profile-teammates">
                                        <h5 class="card-title d-flex align-items-center" v-if="this.loadedUser.main_team_name == null"><i class="ri-team-fill me-2"></i> No Team Found</h5>
                                        <h5 class="card-title d-flex align-items-center" v-else><i class="ri-team-fill me-2"></i> {{ this.loadedUser.main_team_name }}</h5>

                                        <div class="profile-teammates-container px-3">
                                            <div class="row mb-5" v-for="(team, teamName) in groupedUsers"
                                                :key="teamName">
                                                <h2
                                                    class="p-3 mt-0 mb-3 bg-primary text-white fs-6 fw-bold d-flex align-items-center">
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
                                                                    <img :src="`https://office.orchestra.tools/` + user.user_photo" :alt="user.user_id"
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
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';
import { lStore, delay, scrollToTop, showToast, cleanText } from '@/controller';
import axios from 'axios';

export default {
    components: { HeaderView, SidebarView },
    data() {
        return {
            loading: false,
            loadedUser: JSON.parse(lStore.get('view_profile')),
            users: {},
            groupedUsers: {},
            kudosList: {},
            activeIndex: 0
        }
    },
    computed: {
        loadedUserRole() {
            switch (this.loadedUser.user_level) {
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
        if (this.loadedUser.team_id == null) this.loadedUser.team_id = '0x0x0x0';
        this.loadTeammates(this.loadedUser.team_id).then(() => scrollToTop());
        this.loadKudos().then((res) => {
            if (res.length <= 0) this.kudosList.length = 0;
            else this.kudosList.length = res.length;
        });
    },
    methods: {
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
            if (user.user_id == this.loadedUser.user_id) return;

            this.loading = true;
            this.kudosList = {};
            
            const toast = showToast('Loading profile', 'alert-info', true).show();
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/viewprofile?userid=${user.user_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            resolve(res.data.msg);
                            return;
                        }
                        delay(0)
                            .then(() => lStore.setObject('view_profile', res.data.result))
                            .then(() => this.loadedUser = res.data.result)
                            .then(() => {
                                if (user.user_id == this.$userStore.user.user_id) {
                                    this.$router.push('/profile').then(() => {
                                        this.loading = false;
                                        toast.hide();
                                        delay(0).then(() => scrollToTop());
                                    });
                                } else {
                                    if (this.loadedUser.team_id == null) {
                                        this.loadTeammates('0x0x0x0').then(() => {
                                            this.loadKudos().then((res) => {
                                                if (res.length <= 0) this.kudosList.length = 0;
                                                this.loading = false;
                                                toast.hide();
                                                delay(0).then(() => scrollToTop());
                                            });
                                        });
                                    } else {
                                        this.loadTeammates(this.loadedUser.team_id).then(() => {
                                            this.loadKudos().then((res) => {
                                                if (res.length <= 0) this.kudosList.length = 0;
                                                this.loading = false;
                                                toast.hide();
                                                delay(0).then(() => scrollToTop());
                                            });
                                        });
                                    }
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
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showKudos?userid=${this.loadedUser.user_id}`)
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