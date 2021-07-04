<template>
	<div class="callback-form contact-us">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Đổi mật khẩu</em>
						</h2>
						<span>{{ user.name }}</span>
					</div>
				</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-6" style="padding-bottom:120px">
					<form>
						<div class="form-group">
							<input v-model="user.email" class="form-control" readonly=""/>
						</div>
						<div class="form-group">
							<input type="password" class="form-control password" v-model="details.password" placeholder="Mật khẩu mới"/>
							<div class="alert alert-danger" v-if="errors.password">
								{{ errors.password[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control password" v-model="details.passwordAgain" placeholder="Nhập lại mật khẩu"/>
							<div class="alert alert-danger" v-if="errors.passwordAgain">
								{{ errors.passwordAgain[0] }}
							</div>
						</div>
						<button type="button" @click="doimatkhau" class="btn btn-lg btn-primary btn-block">Thay đổi</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios"
export default {
  name: "Password",

  data: function() {
    return {
      details: {
        password: null,
		passwordAgain: null
      },
	  success: null,
	  error: null
    };
  },

  computed: {
	...mapGetters("auth", ["user"]),
    ...mapGetters(["errors"])
  },

  mounted() {
    this.$store.commit("setErrors", {});
  },

  methods: {
	async doimatkhau() {
		try {
			this.success = await axios.post(process.env.VUE_APP_API_URL + 'password', {
				id_User: this.$route.query.id_User,
				password: this.details.password,
				passwordAgain: this.details.passwordAgain
			})
			if(this.success)
			{
				this.$router.push({ name: "Home" });
			}
		} catch (error) {
			this.error = error.response.data
		}
	},
  }
};
</script>
