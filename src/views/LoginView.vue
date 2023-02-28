<template>
	<div class="wrapper vh-100 d-flex flex-column justify-content-center align-items-center">
		<div class="d-flex w-100">
			<div class="card border-3 border-top border-primary w-100 m-auto">
				<div class="card-body py-5 px-4">
					<h1 class="card-title text-primary text-center fs-3 p-0 mb-4">Orchestra 3.0</h1>
					<div class="form-input">
						<div class="col">
							<div class="form-floating mb-3">
								<input type="email" class="form-control" id="floatingInput" placeholder="" v-model="email" v-on:keyup.enter="login">
								<label for="floatingInput">Email address</label>
								<i class="ri-mail-fill position-absolute top-50 end-0 pe-1 translate-middle"></i>
							</div>
							<div class="form-floating mb-3">
								<input type="password" class="form-control" id="floatingInput" placeholder="" v-model="password" v-on:keyup.enter="login">
								<label for="floatingInput">Password</label>
								<i class="ri-lock-fill position-absolute top-50 end-0 pe-1 translate-middle"></i>
							</div>
							<div class="form-floating mb-3">
								<button type="submit" class="btn btn-primary w-100 p-2" @click="login" :disabled="loading">
									<span v-if="!this.loading">Sign In</span>
									<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" v-if="this.loading"></span>
									<span v-if="this.loading">Signing In</span>
								</button>
							</div>
						</div>
					</div>
					<div class="container pt-3 border-top fs-6 fst-italic text-muted">
						<p class="m-0">The Proweaver Orchestra is an exclusive tool for use by Proweaver employees only.
							Please do not disclose any information to third parties such as clients or potential clients.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios';
import { lStore, delay, showAlert } from '@/controller';
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

			axios.get(`http://ns.proweaver.host/nsorchestra/api/Usercontroller/AuthUser?email=${this.email}&password=${this.password}`).then(({ data }) => {
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
						.then(() => showAlert('alert-success', 'Login Successful!', 'bi-check-circle-fill'))
						.then(() => this.$router.push('/home'))
						.then(() => this.loading = false);
					});
				} else {
					delay(0)
					.then(() => showAlert('alert-danger', data.msg, 'bi-exclamation-circle-fill'))
					.then(() => this.loading = false);
				}
			}).catch((err)=>{
				delay(0)
					.then(() => showAlert('alert-danger', err.message, 'bi-exclamation-circle-fill'))
					.then(() => this.loading = false);
			});
		}
	}
};
</script>

<style scoped>
.card {
	max-width: 400px;
}

.card img {
	height: 200px;
	object-fit: cover;
	object-position: 0 60%;
}

.loginError,
.loginSuccess {
	display: none;
}

.show {
	display: block;
}
</style>