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
											data-bs-toggle="tab" data-bs-target="#files-list">
											<i class="ri-file-list-2-fill me-2"></i> Files List
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

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Website Status</div>
													<div v-if="isEmpty(this.clientInfo.website_status)">&mdash;</div>
													<div v-else>{{ this.clientInfo.website_status }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Date Added</div>
													<div v-if="isEmpty(this.clientInfo.date_added)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_added }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Sales Details</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Opened By</div>
													<div v-if="isEmpty(this.clientInfo.opened_by)">&mdash;</div>
													<div v-else>{{ this.clientInfo.opened_by }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Date Opened</div>
													<div v-if="isEmpty(this.clientInfo.date_added)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_added }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Closed By</div>
													<div v-if="isEmpty(this.clientInfo.closed_by)">&mdash;</div>
													<div v-else>{{ this.clientInfo.closed_by }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Date Closed</div>
													<div v-if="isEmpty(this.clientInfo.date_closed)">&mdash;</div>
													<div v-else>{{ this.clientInfo.date_closed }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Level of Interest</div>
													<div v-if="isEmpty(this.clientInfo.interest)">&mdash;</div>
													<div v-else>{{ this.clientInfo.interest }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Quoted Fee</div>
													<div v-if="isEmpty(this.clientInfo.sales)">&mdash;</div>
													<div v-else>{{ this.clientInfo.sales }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Contact Information</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Company Name</div>
													<div v-if="isEmpty(this.clientInfo.company)">&mdash;</div>
													<div v-else>{{ this.clientInfo.company }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Is this the final company name format?</div>
													<div v-if="this.clientInfo.final_comp_name_format == 1">Yes</div>
													<div v-if="this.clientInfo.final_comp_name_format == 0">No</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Contact Person</div>
													<div v-if="isEmpty(this.clientInfo.contact_person)">&mdash;</div>
													<div v-else>{{ this.clientInfo.contact_person }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Address</div>
													<div v-if="isEmpty(this.clientInfo.address)">&mdash;</div>
													<div v-else>{{ this.clientInfo.address }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Phone</div>
													<div v-if="isEmpty(this.clientInfo.phone)">&mdash;</div>
													<div v-else>{{ this.clientInfo.phone }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">City</div>
													<div v-if="isEmpty(this.clientInfo.city)">&mdash;</div>
													<div v-else>{{ this.clientInfo.city }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Fax</div>
													<div v-if="isEmpty(this.clientInfo.fax)">&mdash;</div>
													<div v-else>{{ this.clientInfo.fax }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Country</div>
													<div v-if="isEmpty(this.clientInfo.country)">&mdash;</div>
													<div v-else>{{ this.clientInfo.country }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Mobile</div>
													<div v-if="isEmpty(this.clientInfo.mobile)">&mdash;</div>
													<div v-else>{{ this.clientInfo.mobile }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">State</div>
													<div v-if="isEmpty(this.clientInfo.state)">&mdash;</div>
													<div v-else>{{ this.clientInfo.state }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Email</div>
													<div v-if="isEmpty(this.clientInfo.email)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Zip</div>
													<div v-if="isEmpty(this.clientInfo.zip)">&mdash;</div>
													<div v-else>{{ this.clientInfo.zip }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Email Address for Updates</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">To</div>
													<div v-if="isEmpty(this.clientInfo.email_updates)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email_updates }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Cc</div>
													<div v-if="isEmpty(this.clientInfo.email_updates_cc)">&mdash;</div>
													<div v-else>{{ this.clientInfo.email_updates_cc }}</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Project Specifications</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Nature of Business</div>
													<div v-if="isEmpty(this.clientInfo.nature_of_business)">&mdash;</div>
													<div v-else>{{ this.clientInfo.nature_of_business }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Lead Source</div>
													<div v-if="isEmpty(this.clientInfo.lead_source)">&mdash;</div>
													<div v-else>{{ this.clientInfo.lead_source }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Additional Information</div>
													<div v-if="isEmpty(this.clientInfo.additional_info)">&mdash;</div>
													<div v-else><p class="text-pre-line m-0">{{ this.clientInfo.additional_info }}</p></div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Client's Current Website</div>
													<div v-if="isEmpty(this.clientInfo.domain)">&mdash;</div>
													<div v-else>{{ this.clientInfo.domain }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Quoted Fee</div>
													<div v-if="isEmpty(this.clientInfo.sales)">&mdash;</div>
													<div v-else>{{ this.clientInfo.sales }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Commitment fee is paid</div>
													<div v-if="isEmpty(this.clientInfo.commitment_fee_is_paid)">&mdash;</div>
													<div v-else>{{ this.clientInfo.commitment_fee_is_paid }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Logo</div>
													<div v-if="isEmpty(this.clientInfo.logo)">&mdash;</div>
													<div v-else>{{ this.clientInfo.logo }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Color Scheme</div>
													<div v-if="isEmpty(this.clientInfo.color_scheme)">&mdash;</div>
													<div v-else>{{ this.clientInfo.color_scheme }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Slogan</div>
													<div v-if="isEmpty(this.clientInfo.slogan)">&mdash;</div>
													<div v-else>{{ this.clientInfo.slogan }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Type of Pictures to Use</div>
													<div v-if="isEmpty(this.clientInfo.pictures)">&mdash;</div>
													<div v-else>{{ this.clientInfo.pictures }}</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Do you have any reference website(s)?</div>
													<div v-if="isEmpty(this.clientInfo.reference)">No</div>
													<div v-else>Yes</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Reference Sites</div>
													<div v-if="isEmpty(this.clientInfo.reference)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.reference.sites)">&mdash;</div>
														<div>{{ this.clientInfo.reference.sites }}</div>
													</div>
												</div>
											</div>
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">What do you like about the reference site?</div>
													<div v-if="isEmpty(this.clientInfo.reference)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.reference.like_about_reference)">&mdash;</div>
														<ul v-else>
															<li v-for="item in this.clientInfo.reference.like_about_reference">{{ item }}</li>
														</ul>
													</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Do you have the right to copy?</div>
													<div v-if="isEmpty(this.clientInfo.reference)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.reference.right_to_copy)">&mdash;</div>
														<div v-else>Yes</div>
													</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">About the Company</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">List of Services</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.about_company.services)">&mdash;</div>
														<div v-else>{{ this.clientInfo.about_company.services }}</div>
													</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Website(s) of Competitor Companies</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.about_company.competitor)">&mdash;</div>
														<ul v-else>
															<li v-for="item in this.clientInfo.about_company.competitor">{{ item }}</li>
														</ul>
													</div>
												</div>
											</div>
										</div>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Who are the company's customers/clients/patients?</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.about_company.customers)">&mdash;</div>
														<div v-else>{{ this.clientInfo.about_company.customers }}</div>
													</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">What is the age range of your target audience?</div>
													<div v-if="isEmpty(this.clientInfo.about_company)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.about_company.targetage)">&mdash;</div>
														<ul v-else>
															<li class="p-2" v-for="item in this.clientInfo.about_company.targetage">{{ item }}</li>
														</ul>
													</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">DSN</h5>

										<div class="container mw-100 mb-3 mb-sm-0 px-3">
											<div class="row mb-0 mb-sm-3 pb-0 pb-sm-3">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Chosen Layout DSN</div>
													<div v-if="isEmpty(this.clientInfo.chosen_dsn)">&mdash;</div>
													<div v-else>{{ this.clientInfo.chosen_dsn }}</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Website DSN</div>
													<div v-if="isEmpty(this.clientInfo.website_dsn)">&mdash;</div>
													<div v-else>{{ this.clientInfo.website_dsn }}</div>
												</div>
											</div>
										</div>

									</div>

									<div class="tab-pane fade website-information" id="website-information">

										<h5 class="card-title d-flex align-items-center">Website Information</h5>

										<div class="container mw-100 mb-0 mb-sm-3 p-3 border font-monospace">
											<div class="row">
												<div class="col-12 col-sm-6 mb-3">
													<div class="label mb-2">Website Link</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																<a :href="this.clientInfo.website_info.value.Website_Link" target="_blank">{{ this.clientInfo.website_info.value.Website_Link }}</a>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-sm-6 mb-3">
													<div class="label mb-2">phpMyAdmin</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																{{ this.clientInfo.website_info.value.phpmyadmin }}
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-12 col-sm-6">
													<div class="label mb-2">Database Information</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Name: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Name)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Name }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Host: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Host)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Host }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Username: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Username)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Username }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Password: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Password)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Password }}</label>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-sm-6">
													<div class="label mb-2">cPanel Information</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Login Link: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Cpanel_Information.Login_Link)">***************</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Cpanel_Information.Login_Link }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder" v-if="isEmpty(this.clientInfo.website_info.value.Cpanel_Information.Login_Link)">Username: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Cpanel_Information.Username)">***************</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Cpanel_Information.Username }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder" v-if="isEmpty(this.clientInfo.website_info.value.Cpanel_Information.Login_Link)">Password: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Cpanel_Information.Password)">***************</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Cpanel_Information.Password }}</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Website Access</h5>

										<div class="container mw-100 mb-0 mb-sm-3 p-3 border font-monospace">
											<div class="row">
												<div v-if="isEmpty(this.clientInfo.panel_info)">&mdash;</div>
												<div class="lh-base panel-info" v-else v-html="this.$userStore.client.panel_info.value"></div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">FTP and Database Access</h5>

										<div class="container mw-100 mb-0 mb-sm-3 p-3 border font-monospace">
											<div class="row">
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">FTP Access</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Host: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.FTP_Access.Hostname)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.FTP_Access.Hostname }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Username: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.FTP_Access.Username)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.FTP_Access.Username }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Password: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.FTP_Access.Password)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.FTP_Access.Password }}</label>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12 col-sm-6 mb-3 mb-md-0">
													<div class="label mb-2">Database Access</div>
													<div v-if="isEmpty(this.clientInfo.languages)">&mdash;</div>
													<div v-else>
														<div v-if="isEmpty(this.clientInfo.website_info)">&mdash;</div>
														<div v-else>
															<div v-if="isEmpty(this.clientInfo.website_info.value)">&mdash;</div>
															<div v-else>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Name: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Name)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Name }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Username: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Username)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Username }}</label>
																</div>
																<div class="mb-2">
																	<span class="text-secondary fw-bolder">Password: </span>
																	<label v-if="isEmpty(this.clientInfo.website_info.value.Database_Information.Database_Password)">&mdash;</label>
																	<label class="text-default fw-normal" v-else>{{ this.clientInfo.website_info.value.Database_Information.Database_Password }}</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<h5 class="card-title d-flex align-items-center">Other Access</h5>

										<div class="container mw-100 mb-0 mb-sm-3 p-3 border font-monospace">
											<div class="row">
												<div v-if="isEmpty(this.clientInfo.other_info)">&mdash;</div>
												<div class="lh-base panel-info" v-else v-html="this.$userStore.client.other_info.value"></div>
											</div>
										</div>

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
	async mounted() {
		if (isEmpty(this.$userStore.client)) this.$router.push('/clients');

		delay(0)
			.then(async () => {
				this.clientInfo = await this.$userStore.client;
			})
			.then(() => {
				if (isEmpty(this.clientInfo)) return;
				if (!isEmpty(this.clientInfo.date_added)) this.clientInfo.date_added = formatDate(this.clientInfo.date_added);
				if (!isEmpty(this.clientInfo.date_closed)) this.clientInfo.date_closed = formatDate(this.clientInfo.date_closed);
				if (!isEmpty(this.clientInfo.about_company)) this.clientInfo.about_company = JSON.parse(this.clientInfo.about_company);
				if (!isEmpty(this.clientInfo.reference)) this.clientInfo.reference = JSON.parse(this.clientInfo.reference);
				if (!isEmpty(this.clientInfo.languages)) this.$userStore.client.website_info = this.clientInfo.languages.find(client => client.name === 'Website Information');
				if (!isEmpty(this.clientInfo.languages)) this.$userStore.client.panel_info = this.clientInfo.languages.find(client => client.name === 'Panel Info');
				if (!isEmpty(this.clientInfo.languages)) this.$userStore.client.other_info = this.clientInfo.languages.find(client => client.name === 'Other Access');
				if (!isEmpty(this.$userStore.client.website_info.value)) this.$userStore.client.website_info.value = JSON.parse(this.$userStore.client.website_info.value);
			});
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