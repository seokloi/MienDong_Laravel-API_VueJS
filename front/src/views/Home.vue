<template>
	<div class="callback-form contact-us" v-if="user && user.id_ChucVu != 4">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							Welcome to <em>Mien Dong Station</em>
						</h2>
						<span>{{ user.name }}</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div v-else="">
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
										<router-link :to = "{ path: '/user-benxe', query: {id_Tuyen: this.TuyenInput, Ngay: this.DayInput}} ">
											<button class="btn btn-primary">
												<i class="fa fa-search"></i>
											</button>
										</router-link>
									</div>
									<div class="col-md-6" align="left" v-else="">
										<button class="btn btn-primary" disabled="" style="background-color: gray;">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="more-info">
			<div class="container">
				<div class="section-heading">
					<h2>
						<em>Tin mới</em>
					</h2>
				</div>
				<div class="row" id="tabs">
					<div class="col-md-3" v-for="product in listBlogs.data" :key="product.id">
						<ul>
							<li>
								<router-link :to = "{ path: '/user-blog-detail', query: {id_Blog: product.id}} ">
									{{ product.NoiDungTomTat }}<br />
									<small>{{ product.created_at | formatDay }}</small>
								</router-link>
							</li>
						</ul>
						<br />
					</div>
					<br />
					<div class="text-center col-lg-12">
						<a href="user-blog" class="filled-button">Xem thêm</a>
					</div>
				</div>
				<hr/>
			</div>
		</div>

		<div class="callback-form">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="section-heading">
							<h2>
								Ý kiến <em>Khách hàng</em>
							</h2>
							<span>Chúng tôi tiếp nhận tất cả đóng góp, ý kiến, phản ảnh của khách hàng.
							<br/>Nếu bạn có bất kỳ thông tin gì cần giải đáp hãy gửi ngay cho chúng tôi.
							</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="contact-form">
							<div class="contact footer-contact">
								<div class="row">
									<div class="col-lg-4 col-md-12 col-sm-12">
										<input name="name" type="text" class="form-control" v-model="donggop.name" placeholder="Họ tên (*)" required="" />
									</div>
									<div class="invalid-feedback" v-if="errors.name">
										{{ errors.name[0] }}
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<input name="email" type="text" class="form-control" v-model="donggop.email" pattern="[^ @]*@[^ @]*" placeholder="Email (*)" required="" />
									</div>
									<div class="invalid-feedback" v-if="errors.email">
										{{ errors.email[0] }}
									</div>
									<div class="col-lg-4 col-md-12 col-sm-12">
										<input name="sdt" type="number" class="form-control" v-model="donggop.sdt" placeholder="Số điện thoại (*)" required="" />
									</div>
									<div class="invalid-feedback" v-if="errors.sdt">
										{{ errors.sdt[0] }}
									</div>
									<div class="col-lg-12">
										<textarea name="noidung" rows="6" class="form-control" v-model="donggop.noidung" placeholder="Nội dung đóng góp, phản ảnh (*)" required=""></textarea>
									</div>
									<div class="invalid-feedback" v-if="errors.noidung">
										{{ errors.noidung[0] }}
									</div>
									<div class="col-lg-12">
										<button @click="createDongGop" class="border-button">Gửi ý kiến</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br />
				<br />
				<br />
				<br />
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
		donggop: {
			name: '',
			email: '',
			sdt: '',
			noidung: ''
		},
		blog: {
			Ten: '',
			NoiDungTomTat: '',
			NoiDung: '',
			created_at: ''
		},
		listBlogs: null,
		listTuyens1: null,
		listTuyens2: null,
		TuyenInput: null,
		DayInput: null,
		SelectTuyen: 1,
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
		this.getListBlogs()
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
		async createDongGop() {
			try {
				await axios.post(process.env.VUE_APP_API_URL + 'donggop', {
					name: this.donggop.name,
					email: this.donggop.email,
					sdt: this.donggop.sdt,
					noidung: this.donggop.noidung
				})
				this.$router.go(0)
			} catch (error) {
				this.error = error.response.data
			}
		},
		async getListBlogs() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'blog')
				this.listBlogs = response.data
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
        }
	}
};
</script>
