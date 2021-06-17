<template>
	<div>
		<header-component></header-component>
		
		<div class="page-heading header-text">
			<div class="section-center">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="booking-form">
								<div class="row">
									<div class="col-md-12">
										<h3 class="lable-h">Miền Đông Station</h3>
										<span></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Điểm Khởi Hành</span>
											<select class="form-control" disabled="" style="background-color: gray;" v-if="SelectTuyen == 1">
												<option selected="selected">Bến xe Miền Đông</option>
											</select>
											<select v-model="TuyenInput" name="id" class="form-control" v-else="">
												<option value="" selected="">Chọn điểm Khởi hành</option>
												<option v-for="tuyen in listTuyens2.data" :key="tuyen.id" :value="tuyen.id">{{ tuyen.DiaDiem1 }}</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Điểm Đến</span>
											<select class="form-control" disabled="" style="background-color: gray;" v-if="SelectTuyen == 2">
												<option selected="selected">Bến xe Miền Đông</option>
											</select>
											<select v-model="TuyenInput" name="id" class="form-control" v-else="">
												<option value="" selected="">Chọn điểm Đến</option>
												<option v-for="tuyen in listTuyens1.data" :key="tuyen.id" :value="tuyen.id">{{ tuyen.DiaDiem2 }}</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Ngày đi</span>
											<input v-model="DayInput" type="date" class="form-control" name="Date" required=""/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6" align="right">
										<button class="btn btn-primary" @click="this.ChangeSelectTuyen1" v-if="SelectTuyen == 1">
											<i class="fa fa-exchange"></i>
										</button>
										<button class="btn btn-primary" @click="this.ChangeSelectTuyen2" v-else="">
											<i class="fa fa-exchange"></i>
										</button>
									</div>
									<div class="col-md-6" align="left" v-if="this.TuyenInput && this.DayInput">
										<a :href="$router.resolve({ name:'User-BenXe', query: {id_Tuyen: this.TuyenInput, Ngay: this.DayInput}}).href">
											<button class="btn btn-primary">
												<i class="fa fa-search"></i>
											</button>
										</a>
									</div>
									<div class="col-md-6" align="left" v-else="">
										<button class="btn btn-primary" disabled="" style="background-color: gray;">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div>
											<span class="DSTX">Danh Sách Tuyến Xe</span>
											<hr />
											<span class="DSTX">{{ this.listTuyen.DiaDiem1 }} - {{ this.listTuyen.DiaDiem2 }}</span>
										</div>
									</div>
									<div class="col-md-3">
									</div>
									<div class="col-md-4" v-for="benxe in listBenXes.data" :key="benxe.id">
										<router-link :to = "{ path: '/user-chuyenxe', query: {id_BenXe: benxe.id, Ngay: $route.query.Ngay}} ">
											<div class="form-btn">
												<button class="TX-btn">{{ benxe.Ten }}</button>
											</div>
										</router-link>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer-component></footer-component>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios"
export default {
	name: "Home",
	data() {
    return {
		tuyen: {
			DiaDiem1: '',
			DiaDiem2: ''
		},
		listTuyen: null,
		listBenXes: null,
		listTuyens1: null,
		listTuyens2: null,
		TuyenInput: this.$route.query.id_Tuyen,
		SelectTuyen: 1,
		DayInput: this.$route.query.Ngay,
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	},
	created() {
		this.getListTuyens1()
		this.getListTuyens2()
		this.getListTuyen()
		this.getListBenXes()
	},
	methods: {
		async ChangeSelectTuyen1() {
			this.SelectTuyen = 2
			this.TuyenInput = null
        },
		async ChangeSelectTuyen2() {
			this.SelectTuyen = 1
			this.TuyenInput = null
        },
		async getListTuyen() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'tuyen/' + this.$route.query.id_Tuyen)
                   this.listTuyen = response.data.data
               } catch (error) {
                   this.error = error.response.data
               }
        },
		async getListTuyens1() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'tuyen', {
                       params: {
					       Tuyen1: true
                       }
                   })
                   this.listTuyens1 = response.data
               } catch (error) {
                   this.error = error.response.data
               }
        },
		async getListTuyens2() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'tuyen', {
                       params: {
					       Tuyen2: true
                       }
                   })
                   this.listTuyens2 = response.data
               } catch (error) {
                   this.error = error.response.data
               }
        },
		async getListBenXes() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'benxe', {
                       params: {
					       id_Tuyen: this.$route.query.id_Tuyen
                       }
                   })
                   this.listBenXes = response.data
               } catch (error) {
                   this.error = error.response.data
               }
        }
	}
};
</script>
