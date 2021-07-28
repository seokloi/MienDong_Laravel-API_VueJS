<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Khách Hàng</em>
						</h2>
					</div>
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.Ten">
					{{ errors.Ten[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.email">
					{{ errors.email[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.password">
					{{ errors.password[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.NgaySinh">
					{{ errors.NgaySinh[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.DiaChi">
					{{ errors.DiaChi[0] }}
				</div>
				<div class="alert alert-danger" role="alert" v-if="errors.SDT">
					{{ errors.SDT[0] }}
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Tên</th>
							<th>Email</th>
							<th>Password</th>
							<th>Ngày Sinh</th>
							<th>Địa Chỉ</th>
							<th>Số Điện Thoại</th>
							<th>Số Lần Mua</th>
							<th width="180px"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX" align="center">
							<td v-if="!selectedProduct">
								<input v-model="product.Ten" class="form-control" name="Ten" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.Ten" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.email" class="form-control" name="email" type="email" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.email" class="form-control" type="email" disabled=""/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.password" class="form-control" name="password" type="password" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.password" class="form-control" type="password"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.NgaySinh" type="date" class="form-control" name="NgaySinh" />
							</td>
							<td v-else="">
								<input type="date" v-model="selectedProduct.NgaySinh" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.DiaChi" class="form-control" name="DiaChi" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.DiaChi" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.SDT" class="form-control" name="SDT" />
							</td>
							<td v-else="">
								<input v-model="selectedProduct.SDT" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.SoLanMua" type="number" class="form-control" name="SoLanMua"  disabled=""/>
							</td>
							<td v-else="">
								<input type="number" v-model="selectedProduct.SoLanMua" class="form-control" disabled=""/>
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
							<td>
								{{ product.Ten }}
								<p v-if="product.Loai"> {{ product.Loai }}</p>
							</td>
							<td>{{ product.email }}</td>
							<td> Hidden </td>
							<td>{{ product.NgaySinh | formatDay }}</td>
							<td>{{ product.DiaChi }}</td>
							<td>{{ product.SDT }}</td>
							<td>{{ product.SoLanMua }}</td>
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
       data() {
           return {
               product: {
                   Ten: '',
                   email: '',
                   NgaySinh: '',
                   DiaChi: '',
                   SDT: '',
                   SoLanMua: 0,
                   password: '',
                   id_Loai: 0,
                   Loai: ''
               },
               listProducts: {},
			   success: null,
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
           async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'khachhang', {
                       params: {
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
                   await axios.post(process.env.VUE_APP_API_URL + 'khachhang', {
                       Ten: this.product.Ten,
                       email: this.product.email,
                       NgaySinh: this.product.NgaySinh,
                       DiaChi: this.product.DiaChi,
                       SDT: this.product.SDT,
                       SoLanMua: this.product.SoLanMua,
                       password: this.product.password,
                       id_Loai: this.product.id_Loai
                   })
                   location.reload()
               } catch (error) {
                   this.error = error.response.data
               }
            },
			async updateProduct() {
                try {
                    await axios.put(process.env.VUE_APP_API_URL + 'khachhang/' + this.selectedProduct.id, {
                       Ten: this.selectedProduct.Ten,
                       NgaySinh: this.selectedProduct.NgaySinh,
                       DiaChi: this.selectedProduct.DiaChi,
                       SDT: this.selectedProduct.SDT,
                       SoLanMua: this.selectedProduct.SoLanMua,
                       password: this.selectedProduct.password,
                       id_Loai: this.selectedProduct.id_Loai
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
			},
            async deleteProduct(product, index) {
                try {
                    await axios.delete(process.env.VUE_APP_API_URL + 'khachhang/' + product.id)
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
