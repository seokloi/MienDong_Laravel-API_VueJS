<template>
	<div id="app wrapper">
		<!-- Preloader Start -->
		<div id="preloader">
			<div class="jumper">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
		<!-- Preloader End -->
		
		<!-- Header !User -->
		<div class="sub-header" v-if="!user">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-xs-12">
						<ul class="left-info">
							<li>
								<a href="/">
									<i class="fa fa-home"></i>Trang chủ
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-phone"></i>Hotline: 1900 571292
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="left-info">
							<li>
								<a href="login">Đăng nhập</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Header !User End -->
		
		<!-- Header User !Admin -->
		<div class="sub-header" v-else-if="user.id_ChucVu == 4">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-xs-12">
						<ul class="left-info">
							<li>
								<a href="/">
									<i class="fa fa-home"></i>Trang chủ
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-phone"></i>Hotline: 1900 571292
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-4">
						<ul class="left-info">
							<li>
								<router-link :to = "{ path: '/user-ve', query: {id_User: user.id}} ">
									<i class="fa fa-user fa-fw"></i>{{ user.name }}
								</router-link>
							</li>
							<li>
								<router-link :to = "{ path: '/password', query: {id_User: user.id}} ">
									<i class="fa fa-gear fa-fw"></i>
								</router-link>
								<a href="#" @click="logout">
									<i class="fa fa-sign-out fa-fw"> </i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Header User !Admin End -->
		
		<!-- Header User Admin -->
		<div class="sub-header" v-else="">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-xs-12">
						<ul class="left-info" v-if="user.id_ChucVu == 3">
							<li>
								<a href="/">
									<i class="fa fa-home"></i>Trang chủ
								</a>
							</li>
							<li>
								<router-link :to = "{ path: '/nhaxe-xe', query: {id_User: user.id}} ">
									<i class="fa fa-bus fa-fw"></i> Xe
								</router-link>
							</li>
							<li>
								<router-link :to = "{ path: '/nhaxe-chuyenxe', query: {id_User: user.id}} ">
									<i class="fa fa-paper-plane fa-fw"></i> Chuyến Xe
								</router-link>
							</li>
							<li>
								<router-link :to = "{ path: '/nhaxe-chuyenxethang', query: {id_User: user.id}} ">
									<i class="fa fa-spinner fa-fw"></i> Chu Kỳ
								</router-link>
							</li>
							<li>
								<router-link :to = "{ path: '/nhaxe-hoadon', query: {id_User: user.id}} ">
									<i class="fa fa-file-text fa-fw"></i> Hóa Đơn
								</router-link>
							</li>
						</ul>
						<ul class="left-info" v-if="user.id_ChucVu == 2">
							<li>
								<a href="/">
									<i class="fa fa-home"></i>Trang chủ
								</a>
							</li>
							<li>
								<router-link :to = "{ path: '/nhanvien-chuxe', query: {id_User: user.id}} ">
									<i class="fa fa-ticket fa-fw"></i> Bán Vé
								</router-link>
							</li>
						</ul>
						<ul class="left-info" v-if="user.id_ChucVu == 1">
							<li>
								<a href="/">
									<i class="fa fa-home"></i>Trang chủ
								</a>
							</li>
							<li>
								<router-link to="/admin-tuyen">
									<i class="fa fa-road fa-fw"></i> Tuyến
								</router-link>
							</li>
							<li>
								<router-link to="/admin-chuxe">
									<i class="fa fa-home fa-fw"></i> N Xe
								</router-link>
							</li>
							<li>
								<router-link to="/admin-nhanvien">
									<i class="fa fa-users fa-fw"></i> N Viên
								</router-link>
							</li>
							<li>
								<router-link to="/admin-khachhang">
									<i class="fa fa-users fa-fw"></i> K Hàng
								</router-link>
							</li>
							<li>
								<router-link to="/admin-donggop">
									<i class="fa fa-comments fa-fw"></i> Đ Góp
								</router-link>
							</li>
							<li>
								<router-link to="/admin-blog">
									<i class="fa fa-book fa-fw"></i> B Viết
								</router-link>
							</li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="left-info">
							<li>
								<router-link :to = "{ path: '/password', query: {id_User: user.id}} ">
									<i class="fa fa-gear fa-fw"></i>
								</router-link>
								<a href="#" @click="logout">
									<i class="fa fa-sign-out fa-fw"> </i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Header User Admin End -->
		<main>
			<router-view />
		</main>
	</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters("auth", ["user"])
  },

  mounted() {
    if (localStorage.getItem("authToken")) {
      this.getUserData();
    }
  },

  methods: {
    ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),

    logout() {
      this.sendLogoutRequest();
      this.$router.push("/login");
    }
  }
};
</script>
