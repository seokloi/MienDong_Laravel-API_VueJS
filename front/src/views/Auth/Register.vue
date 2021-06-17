<template>
	<div class="callback-form contact-us">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Miền Đông Station</em>
						</h2>
					</div>
				</div>
				<div class="col-md-3">
				</div>
				<div class="panel-body col-md-6">
					<form role="form">
						<div class="form-group">
							<input type="text" class="form-control" :class="{ 'is-invalid': errors.name }" id="name" v-model="details.name" placeholder="Họ và tên" />
							<div class="invalid-feedback" v-if="errors.name">
								{{ errors.name[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" id="email" v-model="details.email" placeholder="Email" />
							<div class="invalid-feedback" v-if="errors.email">
								{{ errors.email[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" id="password" v-model="details.password" placeholder="Mật khẩu" />
							<div class="invalid-feedback" v-if="errors.password">
								{{ errors.password[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="password_confirmation" v-model="details.password_confirmation" placeholder="Nhập lại mật khẩu" />
						</div>
						<div class="form-group">
							<input type="date" class="form-control" :class="{ 'is-invalid': errors.NgaySinh }" id="NgaySinh" v-model="details.NgaySinh" placeholder="Ngày Sinh" />
							<div class="invalid-feedback" v-if="errors.NgaySinh">
								{{ errors.NgaySinh[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" :class="{ 'is-invalid': errors.DiaChi }" id="DiaChi" v-model="details.DiaChi" placeholder="Địa chỉ" />
							<div class="invalid-feedback" v-if="errors.DiaChi">
								{{ errors.DiaChi[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" :class="{ 'is-invalid': errors.SDT }" id="SDT" v-model="details.SDT" placeholder="Số điện thoại" />
							<div class="invalid-feedback" v-if="errors.SDT">
								{{ errors.SDT[0] }}
							</div>
						</div>
						<button type="button" @click="register" class="btn btn-lg btn-primary btn-block">Đăng ký</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Home",

  data: function() {
    return {
      details: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
		NgaySinh: '',
		DiaChi: '',
		SDT: ''
      }
    };
  },

  computed: {
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
  },

  methods: {
    ...mapActions("auth", ["sendRegisterRequest"]),

    register: function() {
      this.sendRegisterRequest(this.details).then(() => {
      });
	  this.$router.push({ name: "Home" });
    }
  }
};
</script>
