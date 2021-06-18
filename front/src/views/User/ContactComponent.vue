<template>
	<div>
		<header-component></header-component>
		
		<!-- Page Content -->
		<div class="page-heading header-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>THÔNG TIN LIÊN HỆ</h1>
						<span>CÔNG TY TNHH Mien Dong Station</span>
					</div>
				</div>
			</div>
		</div>

		<div class="contact-information">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="contact-item">
							<i class="fa fa-phone"></i>
							<h4>Điện thoại</h4>
							<p>Phone: (08) 4760 3779</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact-item">
							<i class="fa fa-envelope"></i>
							<h4>Email</h4>
							<p>webmaster@miendongstation.com.vn</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact-item">
							<i class="fa fa-map-marker"></i>
							<h4>Địa chỉ</h4>
							<p>___ Đinh Bộ Lĩnh, phường __, Bình Thạnh</p>
						</div>
					</div>
				</div>
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
							<span>
								Chúng tôi tiếp nhận tất cả đóng góp, ý kiến, phản ảnh của khách hàng.
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

		<div id="map" class="col-md-12">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.2323596337856!2d106.8016194147223!3d10.869923660433418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527587e9ad5bf%3A0xafa66f9c8be3c91!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiDEkEhRRyBUUC5IQ00!5e0!3m2!1svi!2s!4v1620216943223!5m2!1svi!2s" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
		</div>

		<footer-component></footer-component>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios"
export default {
	name: "User-Contact",
	data() {
    return {
		donggop: {
			name: '',
			email: '',
			sdt: '',
			noidung: ''
		},
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	},
	created() {
	},
	methods: {
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
		}
	}
};
</script>
