<template>
	<div class="callback-form contact-us">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
					  <h2><em>Miền Đông Station</em></h2>
					</div>
				</div>
				<div class="col-md-4">
				</div>
				<div class="panel-body col-md-4">
					<form role="form">
						<div class="form-group">
							<input type="email" class="form-control" :class="{ 'is-invalid': errors.email }" id="email" v-model="details.email" placeholder="Email"/>
							<div class="invalid-feedback" v-if="errors.email">
								{{ errors.email[0] }}
							</div>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" :class="{ 'is-invalid': errors.password }" id="password" v-model="details.password" placeholder="Mặt khẩu"/>
							<div class="invalid-feedback" v-if="errors.password">
								{{ errors.password[0] }}
							</div>
						</div>
						<button type="button" @click="login" class="btn btn-lg btn-primary btn-block">Đăng nhập</button>
					</form>
					<br/>
					Bạn chưa có tài khoản? 
					<router-link :to = "{ path: '/register' } ">
						Đăng ký
					</router-link>
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
        email: null,
        password: null
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
    ...mapActions("auth", ["sendLoginRequest"]),

    login: function() {
      this.sendLoginRequest(this.details).then(() => {
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>
