<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 3 && user.id == this.$route.query.id_User">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Chuyến Xe</em>
						</h2>
					</div>
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.id_Xe">
					{{ errors.id_Xe[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.id_BenXe">
					{{ errors.id_BenXe[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.Ngay">
					{{ errors.Ngay[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.Gio">
					{{ errors.Gio[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.GiaVe">
					{{ errors.GiaVe[0] }}
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Xe</th>
							<th>Bến</th>
							<th>Ngày</th>
							<th>Giờ</th>
							<th>Giá Vé</th>
							<th width="100px"></th>
							<th width="245px"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX" align="center">
							<td v-if="!selectedProduct">
								<select v-model="product.id_Xe" name="id_Xe" class="form-control">
									<option v-for="xe in listXes.data" :key="xe.id" :value="xe.id">{{ xe.BienSo }}</option>
								</select>
							</td>
							<td v-else="">
								<select v-model="selectedProduct.id_Xe" class="form-control">
									<option v-for="xe in listXes.data" :key="xe.id" :value="xe.id">{{ xe.BienSo }}</option>
								</select>
							</td>

							<td v-if="!selectedProduct">
								<select v-model="product.id_BenXe" name="id_BenXe" class="form-control">
									<option v-for="benxe in listBenXes.data" :key="benxe.id" :value="benxe.id">{{ benxe.DiaDiem1 }} - {{ benxe.DiaDiem2 }}: {{ benxe.Ten }}</option>
								</select>
							</td>
							<td v-else="">
								<select v-model="selectedProduct.id_BenXe" class="form-control">
									<option v-for="benxe in listBenXes.data" :key="benxe.id" :value="benxe.id">{{ benxe.DiaDiem1 }} - {{ benxe.DiaDiem2 }}: {{ benxe.Ten }}</option>
								</select>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.Ngay" type="date" class="form-control" name="Ngay" />
							</td>
							<td v-else="">
								<input type="date" v-model="selectedProduct.Ngay" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.Gio" type="time" class="form-control" name="Gio" />
							</td>
							<td v-else="">
								<input type="time" v-model="selectedProduct.Gio" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.GiaVe" type="number" class="form-control" name="GiaVe" />
							</td>
							<td v-else="">
								<input type="number" v-model="selectedProduct.GiaVe" class="form-control"/>
							</td>

							<td>
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
							<td>
								<router-link :to = "{ path: '/nhaxe-ve', query: {id_Chuyen: product.id , id_User: user.id}} ">
									{{ product.BienSo }}
								</router-link>
							</td>
							<td>
								<router-link :to = "{ path: '/nhaxe-ve', query: {id_Chuyen: product.id , id_User: user.id}} ">
									{{ product.DiaDiem1 }} - {{ product.DiaDiem2 }}: {{ product.BenXe }}
								</router-link>
							</td>
							<td>{{ product.Ngay | formatDay }}</td>
							<td>{{ product.Gio }}</td>
							<td>{{ product.GiaVe }}</td>
							<td>
								<p v-if="product.SoGhe">Số Ghế: {{ product.SoGhe }}</p>
								<p v-if="product.ConLai">Còn lại: {{ product.ConLai }}</p>
							</td>
							<td>
								<button class="btn btn-primary" @click="selecteProduct(product,index)">Edit</button>
								<button class="btn btn-danger" @click="deleteProduct(product, index)">Delete</button>
								<button class="btn btn-primary" v-if=" product.Printed  == 0" @click="PrintTicket(product.id)">P.Ticket</button>
								<button class="btn btn-danger" v-else="" @click="XuatBen(product.id)">P.Bill</button>
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
    name: "ChuXe-ChuyenXe",
       data() {
           return {
               product: {
                   id_Xe: 0,
                   BienSo: '',
                   id_BenXe: 0,
				   DiaDiem1: '',
				   DiaDiem2: '',
                   BenXe: '',
                   Ngay: '',
                   Gio: '',
                   GiaVe: 0,
				   SoGhe: 0,
				   ConLai: 0
               },
               benxe: {
                   Ten: '',
				   DiaDiem1: '',
				   DiaDiem2: ''
               },
               xe: {
                   BienSo: ''
               },
               listXes: null,
               listBenXes: null,
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
           this.getListXes()
           this.getListBenXes()
       },
       methods: {
	      async PrintTicket(id_C) {
               try {
                   this.error = null
                   await axios.post(process.env.VUE_APP_API_URL + 'nv_banve', {
                       id_Chuyen: id_C
                   })
                   location.reload()
               } catch (error) {
                   this.error = error.response.data
               }
          },
          async XuatBen(id_C) {
               try {
                    await axios.put(process.env.VUE_APP_API_URL + 'chuyenxe/' + id_C, {
                       PBill: true
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
           },
           async getListXes() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'xe', {
                       params: {
					       id_User: this.$route.query.id_User
                       }
                   })
                   this.listXes = response.data
               } catch (error) {
                   this.error = error.response.data
               }
           },
           async getListBenXes() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'benxe', {
                       params: {
					       id_User: this.$route.query.id_User
                       }
                   })
                   this.listBenXes = response.data
               } catch (error) {
                   this.error = error.response.data
               }
           },
			async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'chuyenxe', {
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
                   await axios.post(process.env.VUE_APP_API_URL + 'chuyenxe', {
					   month: false,
                       id_Xe: this.product.id_Xe,
                       id_BenXe: this.product.id_BenXe,
                       Ngay: this.product.Ngay,
                       Gio: this.product.Gio,
                       GiaVe: this.product.GiaVe
                   })
                   location.reload()
               } catch (error) {
                   this.error = error.response.data
               }
            },
			async updateProduct() {
                try {
                    await axios.put(process.env.VUE_APP_API_URL + 'chuyenxe/' + this.selectedProduct.id, {
                       id_Xe: this.selectedProduct.id_Xe,
                       id_BenXe: this.selectedProduct.id_BenXe,
                       Ngay: this.selectedProduct.Ngay,
                       Gio: this.selectedProduct.Gio,
                       GiaVe: this.selectedProduct.GiaVe
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
			},
            async deleteProduct(product, index) {
                try {
                    await axios.delete(process.env.VUE_APP_API_URL + 'chuyenxe/' + product.id)
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
