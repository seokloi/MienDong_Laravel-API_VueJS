<template>
	<div>
		<header-component></header-component>
		
		<!-- Page Content -->
		<div class="page-heading header-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>{{ this.listProduct.Ten }}</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="more-info about-info">
		  <div class="container">
			<div class="row">
			  <div class="col-md-12">
				<div class="more-info-content">
				  <div class="row">
					<div class="col-md-12 align-self-center">
					  <div class="right-content">
						<p>
							{{ this.listProduct.NoiDung }}
						</p>
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
	name: "User-Blog-Detail",
	data() {
    return {
		blog: {
			Ten: '',
			NoiDungTomTat: '',
			NoiDung: '',
			created_at: ''
		},
		listProduct: null,
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	},
	created() {
		this.getListBlog()
	},
	methods: {
		async getListBlog() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'blog/' + this.$route.query.id_Blog)
				this.listProduct = response.data.data
			} catch (error) {
				this.error = error.response.data
			}
        }
	}
};
</script>
