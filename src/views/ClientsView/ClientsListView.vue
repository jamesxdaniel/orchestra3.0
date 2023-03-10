<template>
	<Transition class="animate__animated animate__fadeIn">
		<main class="main" v-if="this.$userStore.isLoggedIn">

			<div class="pagetitle">
				<h1>Clients</h1>
			</div>

			<section class="section">
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
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center my-3">
									<h5 class="card-title p-0 m-0">Client List</h5>
									<div class="table-search d-flex justify-content-end align-items-center">
										<span class="me-3" v-if="this.$userStore.searchedClient !== null">Reset</span>
										<input class="form-control me-2" placeholder="Search..." type="search" v-model="searchCriteria">
										<button type="button" class="btn btn-primary" @click="searchClient($event)"><i class="bi bi-search"></i></button>
									</div>
								</div>

								<!-- Start Table -->
								<div class="table-responsive">
									<table id="datatable" class="table table-striped table-hover">
										<thead class="table-primary">
											<tr>
												<th scope="col" class="py-3">Company Name</th>
												<th scope="col" class="py-3">Opened By</th>
												<th scope="col" class="py-3">Date</th>
												<th scope="col" class="py-3">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="client in this.$userStore.clientList" :key="client.acc_id">
												<td class="align-middle"><a href="#" @click.prevent="viewClient(client)">{{ client.company }}</a></td>
												<td class="align-middle">{{ client.user_alias_name }}</td>
												<td class="align-middle">{{ client.date_added }}</td>
												<td class="align-middle">
													<button
														type="button"
														class="d-inline-flex justify-content-center align-items-center btn btn-sm btn-warning me-1"
														data-bs-toggle="tooltip"
														data-bs-title="Tickets"><i class="ri-ticket-fill"></i></button>
													<button
														type="button"
														class="d-inline-flex justify-content-center align-items-center btn btn-sm btn-primary me-1"
														data-bs-toggle="tooltip"
														data-bs-title="Tasks"><i class="ri-window-fill"></i></button>
													<button
														type="button"
														class="d-inline-flex justify-content-center align-items-center btn btn-sm btn-success" 
														data-bs-toggle="tooltip"
														data-bs-title="Events List"><i class="ri-calendar-event-fill"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								
								<ul class="pagination" v-if="this.$userStore.clientList.length > 0 && this.$userStore.searchedClient == null">
									<li class="page-item" :class="{ 'disabled': this.$userStore.currentClientListPage <= 1 }">
										<a class="page-link" href="#" @click.prevent="previousPage">&laquo; Previous</a>
									</li>
									<li v-for="page in displayedPages" :key="page" class="page-item"
										:class="{ 'active': this.$userStore.currentClientListPage === page }">
										<a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
									</li>
									<li class="page-item" :class="{ 'disabled': this.$userStore.currentClientListPage >= pageCount }">
										<a class="page-link" href="#" @click.prevent="nextPage">Next &raquo;</a>
									</li>
								</ul>

								<ul class="pagination" v-else>
									<li class="page-item" :class="{ 'disabled': this.$userStore.currentSearchedClientListPage <= 1 }">
										<a class="page-link" href="#" @click.prevent="previousPage">&laquo; Previous</a>
									</li>
									<li v-for="page in displayedPages" :key="page" class="page-item"
										:class="{ 'active': this.$userStore.currentSearchedClientListPage === page }">
										<a class="page-link" href="#" @click.prevent="goToPage(page)">{{ page }}</a>
									</li>
									<li class="page-item" :class="{ 'disabled': this.$userStore.currentSearchedClientListPage >= pageCount }">
										<a class="page-link" href="#" @click.prevent="nextPage">Next &raquo;</a>
									</li>
								</ul>
								<!-- End Table -->

							</div>
						</div>
					</div>

				</div>
			</section>

		</main>
	</Transition>
</template>

<script>
import { scrollToTop, delay, formatDate, showToast, tooltipConfig } from '@/controller';
import { useUserStore } from '@/store/store';
import axios from 'axios';

export default {
	data() {
		return {
			tooltipConfig,
			searchCriteria: (this.$userStore.searchedClient !== null) ? this.$userStore.searchedClient : null,
			clientList: [],
			pageSize: 50
		};
	},
	setup() {
		const userStore = useUserStore();
		return { userStore };
	},
	mounted() {
		this.tooltipConfig();
		if (this.$userStore.clientList.length <= 0) this.getClients();
	},
	methods: {
		getClients() {
			const offset = (this.$userStore.currentClientListPage - 1) * this.pageSize;
			const toastAlert = showToast('Loading data', 'alert-info', true);
			toastAlert.show();

			axios.get('http://ns.proweaver.host/nsorchestra/api/Clientcontroller/getallClients', { params: { limit: this.pageSize, offset } }).then((res) => {
				if (res.data == null) return;
				this.clientList = res.data.result.data;
				this.clientList.forEach(client => {
					client.date_added = formatDate(client.date_added);
				});
				this.userStore.setClientList(this.clientList);
				this.userStore.setTotalClient(res.data.result.total);
			})
			.then(() => toastAlert.hide())
			.then(() => scrollToTop())
			.then(() => this.tooltipConfig());
		},
		searchClient(e) {
			if (this.searchCriteria == null || this.searchCriteria == '') return;

			let offset;
			if (e !== undefined && e.type === 'click') offset = 0;
			else offset = (this.$userStore.currentSearchedClientListPage - 1) * this.pageSize;

			let toastAlert = showToast('Searching client', 'alert-info', true).show();

			axios.get('http://ns.proweaver.host/nsorchestra/api/Clientcontroller/getallClients', { params: { limit: this.pageSize, offset, criteria: this.searchCriteria } }).then((res) => {
				if (res.data.result == null) {
					toastAlert.remove();
					throw new Error(res.data.msg);
				}

				this.clientList = res.data.result.data;
				this.clientList.forEach(client => {
					client.date_added = formatDate(client.date_added);
				});

				this.userStore.setClientList(this.clientList);
				this.userStore.setTotalClientSearch(res.data.result.total);
				if (e !== undefined && e.type === 'click') this.userStore.setSearchedClient(this.searchCriteria);
				if (e !== undefined && e.type === 'click') this.userStore.currentSearchedClientListPage = 1;
			})
			.then(() => toastAlert.hide())
			.then(() => this.tooltipConfig())
			.catch((err) => {
				toastAlert = showToast(err.message, 'alert-danger').show();
			});
		},
		goToPage(page) {
			if (this.$userStore.searchedClient == null) {
				this.$userStore.currentClientListPage = page;
				this.getClients();
			} else if (this.$userStore.searchedClient == this.searchCriteria) {
				this.$userStore.currentSearchedClientListPage = page;
				this.searchClient();
			} else {
				this.$userStore.currentSearchedClientListPage = page;
				this.searchCriteria = this.$userStore.searchedClient;
				this.searchClient();
			}
		},
		nextPage() {
			if (this.$userStore.searchedClient == null) {
				if (this.$userStore.currentClientListPage < this.pageCount) {
					this.$userStore.currentClientListPage++;
					this.getClients();
				}
			} else if (this.$userStore.searchedClient == this.searchCriteria) {
				if (this.$userStore.currentSearchedClientListPage < this.pageCount) {
					this.$userStore.currentSearchedClientListPage++;
					this.searchClient();
				}
			} else {
				if (this.$userStore.currentSearchedClientListPage < this.pageCount) {
					this.$userStore.currentSearchedClientListPage++;
					this.searchCriteria = this.$userStore.searchedClient;
					this.searchClient();
				}
			}
		},
		previousPage() {
			if (this.$userStore.searchedClient == null) {
				if (this.$userStore.currentClientListPage > 1) {
					this.$userStore.currentClientListPage--;
					this.getClients();
				}
			} else if (this.$userStore.searchedClient == this.searchCriteria) {
				if (this.$userStore.currentSearchedClientListPage > 1) {
					this.$userStore.currentSearchedClientListPage--;
					this.searchClient();
				}
			} else {
				if (this.$userStore.currentSearchedClientListPage > 1) {
					this.$userStore.currentSearchedClientListPage--;
					this.searchCriteria = this.$userStore.searchedClient;
					this.searchClient();
				}
			}
		},
		viewClient(company) {
			const toastAlert = showToast('Loading data', 'alert-info', true);
			toastAlert.show();

			delay(0)
				.then(() => this.userStore.viewClientInfo(company))
				.then(() => this.$router.push('/clients/info'))
				.then(() => toastAlert.hide());
		}
	},
	computed: {
		pageCount() {
			if (this.$userStore.searchedClient !== null) return Math.ceil(this.$userStore.totalClientsSearched / this.pageSize);
			else return Math.ceil(this.$userStore.totalClients / this.pageSize);
		},
		displayedPages() {
			const maxDisplayed = 6;
			if (this.$userStore.searchedClient !== null) {
				let start = Math.max(1, this.$userStore.currentSearchedClientListPage - Math.floor(maxDisplayed / 2));
				let end = Math.min(this.pageCount, start + maxDisplayed - 1);
				start = Math.max(1, end - maxDisplayed + 1);
				if (end - start + 1 > maxDisplayed) {
				end = start + maxDisplayed - 1;
				}
				return Array(end - start + 1).fill().map((_, i) => start + i);
			} else {
				let start = Math.max(1, this.$userStore.currentClientListPage - Math.floor(maxDisplayed / 2));
				let end = Math.min(this.pageCount, start + maxDisplayed - 1);
				start = Math.max(1, end - maxDisplayed + 1);
				if (end - start + 1 > maxDisplayed) {
				end = start + maxDisplayed - 1;
				}
				return Array(end - start + 1).fill().map((_, i) => start + i);
			}
		}
	}
};
</script>