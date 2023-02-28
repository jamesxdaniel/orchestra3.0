<template>
    <HeaderView />
    <Transition class="animate__animated animate__fadeIn">
        <div>
            <SidebarView />
            <main id="main" class="main" v-if="this.$userStore.isLoggedIn">

                <div class="pagetitle">
                    <h1>Profile</h1>
                </div><!-- End Page Title -->

                <section class="section profile">
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
                                    <h3>{{ this.loadedUser.main_team_name }}</h3>
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
                                            <button class="nav-link d-flex align-items-center bg-transparent active"
                                                data-bs-toggle="tab" data-bs-target="#profile-teammates"
                                                @click="loadTeammates"><i class="ri-team-fill me-2"></i> Teammates</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link d-flex align-items-center bg-transparent"
                                                data-bs-toggle="tab" data-bs-target="#profile-kudos"><i
                                                    class="ri-thumb-up-fill me-2"></i> Kudos</button>
                                        </li>

                                    </ul>

                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade pt-3 show active" id="profile-teammates">

                                            <div class="profile-teammates container">
                                                <h3
                                                    class="d-flex justify-content-center align-items-center text-primary fw-bold mb-4">
                                                    <i class="ri-team-fill me-2"></i> {{ this.loadedUser.main_team_name }}
                                                </h3>
                                                <div class="row mb-5" v-for="(team, teamName) in groupedUsers"
                                                    :key="teamName">
                                                    <h2
                                                        class="p-3 mt-0 mb-3 bg-primary text-white fs-6 fw-bold d-flex align-items-center">
                                                        <i class="ri-group-fill fs-4 me-3"></i> {{ teamName }}
                                                    </h2>
                                                    <div class="col-12 col-md-9 col-lg-4 p-3 d-flex align-items-center"
                                                        v-for="user in team" :key="user.user_full_name"
                                                        @click="viewProfile(user)" :class="{ disabled: this.loading }">
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

                                        <div class="tab-pane fade pt-3" id="profile-kudos">
                                            <div class="container position-relative" v-if="this.kudosList.length > 0">
                                                <div id="carouselKudos" class="carousel slide pointer-event p-3 py-5" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item" v-for="(item, index) in this.kudosList" :class="{ 'active': index === 0 }">
                                                            <div class="d-flex justify-content-center align-items-center flex-column text-center h-100 px-5">
                                                                <span>{{ item.message }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev text-primary" data-bs-target="#carouselKudos" data-bs-slide="prev">
                                                    <i class="ri-arrow-left-s-fill" aria-hidden="true"></i>
                                                </a>
                                                <a class="carousel-control-next text-primary" data-bs-target="#carouselKudos" data-bs-slide="next">
                                                    <i class="ri-arrow-right-s-fill" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <div class="container" v-else>
                                                <span>No Kudos Found!</span>
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
import { lStore, delay, scrollToTop, showAlertWithSpinner, cleanText } from '@/controller';
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
        }
    },
    created() {
        this.loadTeammates().then(() => scrollToTop());
        this.loadKudos().then((res) => {
            if (res.length <= 0) this.kudosList.length = 0;
            else this.kudosList.length = res.length;
        });
    },
    methods: {
        loadTeammates() {
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showteam?teamid=${this.loadedUser.team_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            reject(new Error('No data received from server'));
                            return;
                        }
                        this.users = res.data.result;
                        this.groupedUsers = this.groupByTeam(this.users);
                        resolve(this.groupedUsers);
                    }).catch(error => {
                        reject(error);
                    });
            });
        },
        groupByTeam(users) {
            return users.reduce((acc, user) => {
                if (!acc[user.sub_team_name]) {
                    acc[user.sub_team_name] = []
                }
                acc[user.sub_team_name].push(user)
                return acc
            }, {});
        },
        viewProfile(user) {
            this.loading = true;
            const alert = showAlertWithSpinner().show();
            delay(0)
                .then(() => lStore.setObject('view_profile', user))
                .then(() => this.loadedUser = user)
                .then(() => {
                    if (user.user_id == this.$userStore.user.user_id) {
                        this.$router.push('/profile').then(() => {
                            this.loading = false;
                            alert.hide();
                            delay(0).then(() => scrollToTop());
                        });
                    } else {
                        this.loadTeammates().then(() => {
                            this.loadKudos().then((res) => {
                                if (res.length <= 0) this.kudosList.length = 0;
                                this.loading = false;
                                alert.hide();
                                delay(0).then(() => scrollToTop());
                            });
                        });
                    }
                });
        },
        loadKudos() {
            return new Promise((resolve, reject) => {
                axios.post(`http://ns.proweaver.host/nsorchestra/api/usercontroller/showKudos?userid=${this.loadedUser.user_id}`)
                    .then((res) => {
                        if (res.data.result == null) {
                            reject(new Error('No data received from server'));
                            return;
                        }
                        this.kudosList = res.data.result;
                        this.kudosList.forEach(kudos => {
                            kudos.message = cleanText(kudos.message);
                        });
                        console.log(this.kudosList);
                        resolve(this.kudosList);
                    }).catch(error => {
                        reject(error);
                    });
            });
        }
    }
};
</script>

<style scoped>
.profile-card img,
.profile .profile-edit img,
form img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    color: transparent;
}

.profile-teammates>*:hover {
    cursor: pointer;
}

.profile-teammates>div>div:hover h6 {
    opacity: 0.6;
    color: var(--text-color-link);
}

.profile-teammates>div>div:hover img {
    opacity: 0.6;
}

.profile-teammates img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    color: transparent;
}</style>