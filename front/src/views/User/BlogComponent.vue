<template>
	<div>
		<header-component></header-component>
		
		<!-- Page Content -->
		<div class="page-heading header-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Bài Viết</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="single-services">
			<div class="container">
				<div class="row">
					<div class="col-md-6" v-for="product in listProducts.data" :key="product.id">
						<section class='tabs-content'>
							<article id='tabs-1'>
								<h4>
									<router-link :to = "{ path: '/user-blog-detail', query: {id_Blog: product.id}} ">
										{{ product.Ten }}
									</router-link>
								</h4>
								<div style="margin-bottom:10px;">
									<span>{{ product.created_at | formatDay }}</span>
								</div>
								<br>
							</article>
							<br>
						</section>
					</div>
				</div>
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link">{{ listProducts.meta.from }} - {{ listProducts.meta.to }} of {{ listProducts.meta.total }}</a>
					</li>
					<li class="page-item" :class="{ 'disabled': listProducts.links.prev === null }" @click="listProducts.links.prev && getListProducts(listProducts.meta.current_page - 1)">
						<a class="page-link" >Previous</a>
					</li>
					<li class="page-item" v-if="listProducts.links.prev" @click="getListProducts(listProducts.meta.current_page - 1)">
						<a class="page-link" >{{ listProducts.meta.current_page - 1 }}</a>
					</li>
					<li class="page-item active">
						<a class="page-link" >{{ listProducts.meta.current_page }}</a>
					</li>
					<li class="page-item" v-if="listProducts.links.next" @click="getListProducts(listProducts.meta.current_page + 1)">
						<a class="page-link" >{{ listProducts.meta.current_page + 1 }}</a>
					</li>
					<li class="page-item" :class="{ 'disabled': listProducts.links.next === null }" @click="listProducts.links.next && getListProducts(listProducts.meta.current_page + 1)">
						<a class="page-link" >Next</a>
					</li>
				</ul>
			</div>
		</div>
		<br>
		<footer-component></footer-component>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios"
export default {
	name: "User-Blog",
	data() {
    return {
		blog: {
			Ten: '',
			NoiDungTomTat: '',
			NoiDung: '',
			created_at: ''
		},
		listProducts: null,
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	},
	created() {
		this.getListBlogs()
	},
	methods: {
		async getListBlogs() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'blog')
				this.listProducts = response.data
			} catch (error) {
				this.error = error.response.data
			}
        }
	}
};
</script>
