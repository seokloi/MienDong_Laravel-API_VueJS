<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 3 && user.id == this.$route.query.id_User">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Xe</em>
							<span>{{ user.name }}</span>
						</h2>
					</div>
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.BienSo">
					{{ errors.BienSo[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.id_Loai">
					{{ errors.id_Loai[0] }}
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Biển Số</th>
							<th>Số Ghế - Loại Xe</th>
							<th width="180px"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX" align="center">
							<td v-if="!selectedProduct">
								<input v-model="product.BienSo" class="form-control" name="BienSo" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.BienSo" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<select v-model="product.id_Loai" name="id_Loai" class="form-control">
									<option v-for="loai in listLoais.data" :key="loai.id" :value="loai.id">{{ loai.SoGhe }} - {{ loai.Ten }}</option>
								</select>
							</td>
							<td v-else="">
								<select v-model="selectedProduct.id_Loai" class="form-control">
									<option v-for="loai in listLoais.data" :key="loai.id" :value="loai.id">{{ loai.SoGhe }} - {{ loai.Ten }}</option>
								</select>
							</td>

							<td v-if="!selectedProduct">
								<button class="btn btn-primary" @click="createProduct">Create</button>
							</td>
							<td v-else="">
								<button class="btn btn-primary" @click="updateProduct">Save</button>
								<button class="btn btn-danger" @click="selectedProduct = null">Cancel</button>
							</td>
						</tr>
					</tbody>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="(product, index) in listProducts.data" :key="product.id" class="odd gradeX" align="center">
							<td>{{ product.BienSo }}</td>
							<td>{{ product.SoGhe }} - {{ product.Loai }}</td>
							<td>
								<button class="btn btn-primary" @click="selecteProduct(product,index)">Edit</button>
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
    name: "ChuXe-Xe",
       data() {
           return {
               product: {
                   BienSo: '',
                   id_ChuXe: 0,
                   ChuXe: '',
                   id_Loai: 0,
                   Loai: '',
				   SoGhe: 0
               },
               loai: {
                   Ten: '',
				   SoGhe: 0
               },
               listLoais: null,
               listProducts: {},
               error: null,
               selectedProduct: null,
               indexselectedProduct: null
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
           this.getListLoais()
       },
       methods: {
           async getListLoais() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'loaixe')
                   this.listLoais = response.data
               } catch (error) {
                   this.error = error.response.data
               }
           },
           async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'xe', {
                       params: {
					       id_User: this.$route.query.id_User,
                           page: page
                       }
                   })
                   this.listProducts = response.data
               } catch (error) {
                   this.error = error.response.data
               }
            },
            selecteProduct (product, index) {
				this.selectedProduct = { ...product }
                this.indexselectedProduct = index
				this.selectedProduct.password = null
			},
            async createProduct() {
               try {
                   this.error = null
                   await axios.post(process.env.VUE_APP_API_URL + 'xe', {
                       BienSo: this.product.BienSo,
					   id_User: this.$route.query.id_User,
                       id_Loai: this.product.id_Loai
                   })
                   location.reload()
               } catch (error) {
                   this.error = error.response.data
               }
            },
			async updateProduct() {
                try {
                    await axios.put(process.env.VUE_APP_API_URL + 'xe/' + this.selectedProduct.id, {
                        BienSo: this.selectedProduct.BienSo,
                        id_Loai: this.selectedProduct.id_Loai
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
			},
            async deleteProduct(product, index) {
                try {
                    await axios.delete(process.env.VUE_APP_API_URL + 'xe/' + product.id)
                    this.listProducts.data.splice(index, 1)
                } catch (error) {
                    this.error = error.response.data
                }
            }
       }
   }
</script>
<style lang="scss" scoped="">
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
