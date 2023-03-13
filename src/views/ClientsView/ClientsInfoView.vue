<template>
	<Transition class="animate__animated animate__fadeIn">
		<main class="main" v-if="this.$userStore.isLoggedIn && this.$userStore.client !== null">

			<div class="pagetitle">
				<h1>{{ this.$userStore.client.company }}</h1>
			</div>

			<section class="section default-tab">
				<div class="row">

					<div class="col-xl-3">

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

					<div class="col-xl-9">

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

								<div class="tab-content pt-4">

									<div class="tab-pane fade company-overview show active" id="company-overview">

										<h5 class="card-title d-flex align-items-center">Account Status</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Website Status</div>
													<div v-if="isEmpty(this.clientInfo.website_status)">&mdash;</div>
													<div v-else>{{ this.clientInfo.website_status }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Date Added</div>
													<div v-if="isEmpty(this.clientInfo.date_added)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_added }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Sales Details</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Opened By</div>
													<div v-if="isEmpty(this.clientInfo.opened_by)">&mdash;</div>
													<div v-else>{{ this.clientInfo.opened_by }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Date Opened</div>
													<div v-if="isEmpty(this.clientInfo.date_added)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_added }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Closed By</div>
													<div v-if="isEmpty(this.clientInfo.closed_by)">&mdash;</div>
													<div v-else>{{ this.clientInfo.closed_by }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Date Closed</div>
													<div v-if="isEmpty(this.clientInfo.date_closed)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_closed }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Level of Interest</div>
													<div v-if="isEmpty(this.clientInfo.interest)">&mdash;</div>
													<div v-else>{{ this.clientInfo.interest }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Quoted Fee</div>
													<div v-if="isEmpty(this.clientInfo.sales)">&mdash;</div>
													<div v-else>{{ this.clientInfo.sales }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Contact Information</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Company Name</div>
													<div v-if="isEmpty(this.clientInfo.company)">&mdash;</div>
													<div v-else>{{ this.clientInfo.company }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Is this the final company name format?</div>
													<div v-if="this.clientInfo.final_comp_name_format == 1">Yes</div>
													<div v-if="this.clientInfo.final_comp_name_format == 0">No</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Contact Person</div>
													<div v-if="isEmpty(this.clientInfo.contact_person)">&mdash;</div>
													<div v-else>{{ this.clientInfo.contact_person }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Address</div>
													<div v-if="isEmpty(this.clientInfo.address)">&mdash;</div>
													<div v-else>{{ this.clientInfo.address }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Phone</div>
													<div v-if="isEmpty(this.clientInfo.phone)">&mdash;</div>
													<div v-else>{{ this.clientInfo.phone }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">City</div>
													<div v-if="isEmpty(this.clientInfo.city)">&mdash;</div>
													<div v-else>{{ this.clientInfo.city }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Fax</div>
													<div v-if="isEmpty(this.clientInfo.fax)">&mdash;</div>
													<div v-else>{{ this.clientInfo.fax }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Country</div>
													<div v-if="isEmpty(this.clientInfo.country)">&mdash;</div>
													<div v-else>{{ this.clientInfo.country }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Mobile</div>
													<div v-if="isEmpty(this.clientInfo.mobile)">&mdash;</div>
													<div v-else>{{ this.clientInfo.mobile }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">State</div>
													<div v-if="isEmpty(this.clientInfo.state)">&mdash;</div>
													<div v-else>{{ this.clientInfo.state }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Email</div>
													<div v-if="isEmpty(this.clientInfo.email)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Zip</div>
													<div v-if="isEmpty(this.clientInfo.zip)">&mdash;</div>
													<div v-else>{{ this.clientInfo.zip }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Email Address for Updates</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">To</div>
													<div v-if="isEmpty(this.clientInfo.email_updates)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email_updates }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Cc</div>
													<div v-if="isEmpty(this.clientInfo.email_updates_cc)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email_updates_cc }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Project Specifications</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Nature of Business</div>
													<div v-if="isEmpty(this.clientInfo.nature_of_business)">&mdash;</div>
													<div v-else>{{ this.clientInfo.nature_of_business }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Lead Source</div>
													<div v-if="isEmpty(this.clientInfo.lead_source)">&mdash;</div>
													<div v-else>{{ this.clientInfo.lead_source }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Additional Information</div>
													<div v-if="isEmpty(this.clientInfo.additional_info)">&mdash;</div>
													<div v-else>{{ this.clientInfo.additional_info }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Client's Current Website</div>
													<div v-if="isEmpty(this.clientInfo.domain)">&mdash;</div>
													<div v-else>{{ this.clientInfo.domain }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Quoted Fee</div>
													<div v-if="isEmpty(this.clientInfo.sales)">&mdash;</div>
													<div v-else>{{ this.clientInfo.sales }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Commitment fee is paid</div>
													<div v-if="isEmpty(this.clientInfo.commitment_fee_is_paid)">&mdash;</div>
													<div v-else>{{ this.clientInfo.commitment_fee_is_paid }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Logo</div>
													<div v-if="isEmpty(this.clientInfo.logo)">&mdash;</div>
													<div v-else>{{ this.clientInfo.logo }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Color Scheme</div>
													<div v-if="isEmpty(this.clientInfo.color_scheme)">&mdash;</div>
													<div v-else>{{ this.clientInfo.color_scheme }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Slogan</div>
													<div v-if="isEmpty(this.clientInfo.slogan)">&mdash;</div>
													<div v-else>{{ this.clientInfo.slogan }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Type of Pictures to Use</div>
													<div v-if="isEmpty(this.clientInfo.pictures)">&mdash;</div>
													<div v-else>{{ this.clientInfo.pictures }}</div>
												</div>
											</div>
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">Do you have any reference website(s)?</div>
													<div v-if="isEmpty(this.clientInfo.reference)">No</div>
													<div v-else>Yes</div>
												</div>
												<div class="col">
													<div class="label mb-2">Reference Sites</div>
													<div v-if="isEmpty(this.clientInfo.reference)">&mdash;</div>
													<div v-else>{{ this.clientInfo.reference }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">About the Company</h5>

										<div class="container px-3">
											<div class="row pb-3">
												<div class="col">
													<div class="label mb-2">List of Services</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>{{ this.clientInfo.about_company.services }}</div>
												</div>
												<div class="col">
													<div class="label mb-2">Who are the company's customers/clients/patients?</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>
														<ul>
															<li v-for="item in this.clientInfo.about_company.targetage">{{ item }}</li>
														</ul>
													</div>
												</div>
											</div>
										</div>

									</div>

									<div class="tab-pane fade website-information" id="website-information">

										

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
import { delay, formatDate, isEmpty } from '@/controller';

export default {
	data() {
		return {
			isEmpty,
			clientInfo: {}
		}
	},
	mounted() {
		if (this.$userStore.client == null) this.$router.push('/clients');

		delay(0)
			.then(() => this.clientInfo = this.$userStore.client)
			.then(() => this.clientInfo.date_added = formatDate(this.clientInfo.date_added))
			.then(() => this.clientInfo.date_closed = formatDate(this.clientInfo.date_closed))
			.then(() => this.clientInfo.about_company = JSON.parse(this.clientInfo.about_company));
	}
};
</script>

<style scoped>
.tab-content .card-title {
	background: var(--bs-gray-200);
	padding: 15px;
	margin-bottom: 15px;
}
</style>