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
										<h5>{{ this.listBenXe.DiaDiem1 }} - {{ this.listBenXe.DiaDiem2 }}: Bến {{ this.listBenXe.Ten }}</h5>
									</div>
								</div>
								<table class="table table-striped table-hover" >
									<thead>
										<tr align="left">
											<th>Thông tin nhà xe</th>
											<th>Số điện thoại</th>
											<th>Giờ khởi hành</th>
											<th>Loại xe</th>
											<th>Giá vé</th>
											<th>Chỗ trống</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="chuyenxe in listChuyenXes.data" :key="chuyenxe.id" class="odd gradeX" align="left">
											<td>{{ chuyenxe.ChuXe }}</td>
											<td>{{ chuyenxe.SDT }}</td>
											<td>{{ chuyenxe.Gio }}</td>
											<td>{{ chuyenxe.LoaiXe }} {{ chuyenxe.SoGhe }} chỗ</td>
											<td>{{ chuyenxe.GiaVe }}</td>
											<td>{{ chuyenxe.ConLai }} chỗ trống</td>
											<td>
												<router-link :to = "{ path: '/user-datve', query: {id_Chuyen: chuyenxe.id}} ">
													Đặt ngay
												</router-link>
											</td>
										</tr>
									</tbody>
								</table>
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
	name: "User-ChuyenXe",
	data() {
    return {
		chuyenxe: {
			Ten: '',
			LoaiXe: '',
			SoGhe: 0
		},
		listBenXe: null,
		listChuyenXes: null,
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	},
	created() {
		this.getListChuyenXes()
		this.getListBenXe()
	},
	methods: {
		async getListBenXe() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'benxe/' + this.$route.query.id_BenXe)
				this.listBenXe = response.data.data
			} catch (error) {
				this.error = error.response.data
			}
        },
		async getListChuyenXes() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'chuyenxe', {
					params: {
						id_BenXe: this.$route.query.id_BenXe,
						Ngay: this.$route.query.Ngay
					}
				})
				this.listChuyenXes = response.data
			} catch (error) {
				this.error = error.response.data
			}
        }
	}
};
</script>
