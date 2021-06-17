<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
					  <h2><em>Bài Viết</em></h2>
					</div>
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.Ten">
					{{ errors.Ten[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.NoiDungTomTat">
					{{ errors.NoiDungTomTat[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.NoiDung">
					{{ errors.NoiDung[0] }}
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Tên</th>
							<th>Tên tóm tắt</th>
							<th>Nội dung</th>
							<th width="180px"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX" align="center">
							<td v-if="!selectedProduct">
								<input v-model="product.Ten" class="form-control" name="Ten" />
							</td>
							<td v-else="">
								<input type="text" v-model="selectedProduct.Ten" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.NoiDungTomTat" class="form-control" name="NoiDungTomTat" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.NoiDungTomTat" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input type="text" v-model="product.NoiDung" class="form-control" name="NoiDung" />
							</td>
							<td v-else="">
								<input type="text" v-model="selectedProduct.NoiDung" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<button class="btn btn-primary" @click="createProduct">Create</button>
							</td>
							<td v-else="">
								<button class="btn btn-primary" @click="updateProduct()">Save</button>
								<button class="btn btn-danger" @click="selectedProduct = null">Cancel</button>
							</td>
						</tr>
					</tbody>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="(product, index) in listProducts.data" :key="product.id" class="odd gradeX" align="center">
							<td>{{ product.Ten }}</td>
							<td>{{ product.NoiDungTomTat }}</td>
							<td>{{ product.NoiDung }}</td>
							<td>
								<button class="btn btn-primary" @click="selecteProduct(product)">Edit</button>
								<button class="btn btn-danger" @click="deleteProduct(product, index)">Delete</button>
							</td>
						</tr>
					</transition-group>
				</table>
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
	</div>
</template>

<script>
import { mapGetters } from "vuex"
import axios from "axios"
export default {
  name: "Admin-Blog",

  data() {
     return {
          product: {
              Ten: '',
              NoiDungTomTat: '',
              NoiDung: ''
          },
          listProducts: {},
          error: null,
	      success: null,
          selectedProduct: null
     }
  },
  computed: {
	...mapGetters(["errors"]),
	...mapGetters("auth", ["user"])
  },
  mounted() {
    this.$store.commit("setErrors", {});
  },
  
  created() {
           this.getListProducts()
  },
  methods: {
            async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'blog?page=' + page)
                   this.listProducts = response.data
               } catch (error) {
                   this.error = error.response.data
               }
            },
            selecteProduct (product) {
				this.selectedProduct = { ...product }
			},
            async createProduct() {
               try {
                   this.error = null
                   await axios.post(process.env.VUE_APP_API_URL + 'blog', {
                       Ten: this.product.Ten,
                       NoiDungTomTat: this.product.NoiDungTomTat,
                       NoiDung: this.product.NoiDung
                   })
                   location.reload()
               } catch (error) {
                   this.error = error.response.data
               }
            },
			async updateProduct() {
                try {
                    await axios.put(process.env.VUE_APP_API_URL + 'blog/' + this.selectedProduct.id, {
                        Ten: this.selectedProduct.Ten,
                        NoiDungTomTat: this.selectedProduct.NoiDungTomTat,
                        NoiDung: this.selectedProduct.NoiDung
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
			},
            async deleteProduct(product, index) {
                try {
                    await axios.delete(process.env.VUE_APP_API_URL + 'blog/' + product.id)
                    this.listProducts.data.splice(index, 1)
                } catch (error) {
                    this.error = error.response.data
                }
            }
  }
};
</script>
<style lang="scss" scoped>
	.fade-enter-active, .fade-leave-active {
	transition: opacity .5s;
	}
	.fade-enter, .fade-leave-to {
	opacity: 0;
	}
	.slide-fade-enter-active {
	transition: all .3s ease;
	}
	.slide-fade-leave-active {
	transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
	}
	.slide-fade-enter, .slide-fade-leave-to {
	transform: translateX(10px);
	opacity: 0;
	}
</style>