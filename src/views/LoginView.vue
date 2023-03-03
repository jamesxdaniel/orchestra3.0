<template>
		<div class="login wrapper vh-100 d-flex flex-column justify-content-center align-items-center overflow-hidden">
		<Transition class="animate__animated animate__slideInDown">
			<div class="d-flex flex-column w-100">
				<img src="@/assets/img/logo.svg" alt="Proweaver" class="logo mx-auto mb-5">
				<div class="main-card">
					<h1 class="text-light text-center fs-2 fw-bolder p-0 mb-4">Orchestra <span class="text-secondary">3.0</span></h1>
					<div class="card w-100 m-auto mb-4">
						<div class="card-body px-4">
							<span class="d-block text-primary text-center fw-bold py-3 py-md-4">Sign in to start your session</span>
							<div class="form-input">
								<div class="col">
									<div class="form-floating mb-3">
										<input type="email" class="form-control" id="floatingInput" placeholder="" v-model="email" v-on:keyup.enter="login">
										<label for="floatingInput">Email address</label>
										<i class="ri-mail-fill text-primary position-absolute top-50 end-0 pe-1 translate-middle"></i>
									</div>
									<div class="form-floating">
										<input type="password" class="form-control" id="floatingInput" placeholder="" v-model="password" v-on:keyup.enter="login">
										<label for="floatingInput">Password</label>
										<i class="ri-lock-fill text-primary position-absolute top-50 end-0 pe-1 translate-middle"></i>
									</div>
								</div>
							</div>
							<button type="submit" class="d-flex justify-content-center align-items-center btn bg-gradient fw-bolder" @click="login" :disabled="loading">
								<span v-if="!this.loading">Sign In</span>
								<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" v-if="this.loading"></span>
								<span v-if="this.loading">Signing In</span>
							</button>
						</div>
					</div>
					<div class="note text-center p-0 text-muted">
						<p class="m-0">The Proweaver Orchestra is an exclusive tool for use by Proweaver employees only.
							Please do not disclose any information to third parties such as clients or potential clients.
						</p>
					</div>
				</div>
			</div>
		</Transition>
		</div>
</template>

<script>
import axios from 'axios';
import { lStore, delay, showToast } from '@/controller';
import { useUserStore } from '@/store.js';

export default {
	data() {
		return {
			email: '',
			password: '',
			loading: false
		};
	},
	methods: {
		login() {
			this.loading = true;

			axios.get(`http://ns.proweaver.host/nsorchestra/api/usercontroller/AuthUser?email=${this.email}&password=${this.password}`).then(({ data }) => {
				if (data.msg == null) return;
				else if (data.success == true) {
					console.log(data.result);
					delay(0)
					.then(() => {
						const userStore = useUserStore();
						userStore.setUser(data.result[0]);
						lStore.setObject('user_information', data.result[0]);
					})
					.then(() => {
						delay(0)
						.then(() => showToast('You have successfully logged in', 'alert-success'))
						.then(() => this.loading = false)
						.then(() => this.$router.push('/home'));
					});
				} else {
					delay(0)
					.then(() => showToast(data.msg, 'alert-danger'))
					.then(() => this.loading = false);
				}
			}).catch((err)=>{
				delay(0)
					.then(() => showToast(err.msg, 'alert-danger'))
					.then(() => this.loading = false);
			});
		}
	}
};
</script>

<style scoped>
.login {
	background: url('@/assets/img/background.jpg') center no-repeat;
	margin: 0 calc(-100vw / 2 + 100% / 2) !important;
}

.main-card {
	position: relative;
	width: 100%;
	max-width: 435px;
	background-color: #fff;
	margin: auto;
	padding: 2em;
}

.main-card::before {
	content: '';
	display: block;
	width: 100%;
	min-height: 230px;
	background: linear-gradient(90deg, rgba(127,90,203,1) 50%, rgba(203,93,209,1) 100%) !important;
	position: absolute;
	top: 0;
	left: 0;
}

.main-card h1 {
	text-shadow: 2px 2px 2px rgba(0,0,0,0.3);
	position: relative;
	z-index: 123;
}

.main-card button {
	font-size: 16px;
	text-transform: uppercase;
	width: 100%;
	max-width: 100%;
	height: 40px;
	margin: 20px auto 0;
	transition: all 500ms ease-in-out;
	border: none;
}

.main-card button:hover {
	background: linear-gradient(90deg, rgba(203,93,209,1) 100%, rgba(203,93,209,1) 100%) !important;
}

.logo {
	width: 100%;
	max-width: 300px;
}

.card {
	max-width: 400px;
	border-radius: 20px;
	box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}

.card-body {
	padding: 0 0 30px;
}

.card img {
	height: 200px;
	object-fit: cover;
	object-position: 0 60%;
}

.note {
	font-size: 10px;
}

.form-floating > label {
	font-size: 12px;
	color: var(--bs-primary);
}

.loginError,
.loginSuccess {
	display: none;
}

.show {
	display: block;
}

@media only screen and (max-width: 600px) {
	.main-card {
		max-width: 95%;
		padding: 2em 1em;
	}

	.card {
		border-radius: 8px;
	}

	.card-body {
		padding: 20px;
	}

	.logo {
		max-width: 200px;
		margin-bottom: 30px !important;
	}

	.form-floating > label {
		font-size: 12px;
	}

	.form-floating > .form-control, .form-floating > .form-control-plaintext, .form-floating > .form-select {
		font-size: 12px;
		height: calc(2.5rem + 2px);
	}
}
</style>