<template>
	<Transition class="animate__animated animate__fadeIn">
		<main class="main" v-if="this.$userStore.isLoggedIn && this.$userStore.client !== null">

			<div class="pagetitle">
				<h1>{{ this.$userStore.client.company }}</h1>
			</div>

			<section class="section default-tab">
				<div class="row">

					<div class="col-xl-4">

						<div class="card border-3 border-top border-primary">
							<div class="card-body">
								<h5 class="card-title">Quick Links</h5>
								<ul class="list-group list-group-flush bg-transparent w-100">
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

					<div class="col-lg-8">

						<div class="card">
							<div class="card-body pt-3">
								
								<!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

									<li class="nav-item">
										<button class="nav-link d-flex align-items-center bg-transparent active"
											data-bs-toggle="tab" data-bs-target="#company-overview">
											<i class="ri-profile-fill me-2"></i> Overview
										</button>
									</li>

									<li class="nav-item">
										<button class="nav-link d-flex align-items-center bg-transparent"
											data-bs-toggle="tab" data-bs-target="#website-information">
											<i class="ri-earth-fill me-2"></i> Website Information
										</button>
									</li>

									<li class="nav-item">
										<button class="nav-link d-flex align-items-center bg-transparent"
											data-bs-toggle="tab" data-bs-target="#website-access">
											<i class="ri-lock-fill me-2"></i> Website Access
										</button>
									</li>

									<li class="nav-item">
										<button class="nav-link d-flex align-items-center bg-transparent"
											data-bs-toggle="tab" data-bs-target="#events-list">
											<i class="ri-list-check me-2"></i> Events List
										</button>
									</li>

								</ul>

								<div class="tab-content pt-2">

									<div class="tab-pane fade company-overview show active" id="company-overview">
										<h5 class="card-title">Company Details</h5>
									</div>

								</div>

							</div>
						</div>
						
					</div>

				</div>
			</section>

		</main>
	</Transition>
</template>
  
<script>
export default {
	created() {
		if (this.$userStore.client == null) this.$router.go(-1);
	},
	methods: {
		getClientInfo() {
			
		}
	}
};
</script>

<style scoped></style>