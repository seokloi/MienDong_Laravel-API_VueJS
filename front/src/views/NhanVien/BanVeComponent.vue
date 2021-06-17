<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 2 && user.id == this.$route.query.id_User">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
					  <h2><em>Quản Lý Bán Vé</em></h2>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Ghế</th>
							<th>Nhân Viên Bán</th>
							<th>Tên Khách Hàng</th>
							<th>Số Điện Thoại</th>
							<th>Code</th>
							<th>Giá Vé</th>
							<th>Tiền Cọc</th>
							<th>Ngày Lập</th>
							<th width="180px"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX" align="center">
							<td v-if="!selectedProduct">
								<input v-model="product.Ghe" class="form-control" name="Ghe" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.Ghe" class="form-control" disabled=""/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.NhanVien" class="form-control" name="NhanVien" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.NhanVien" class="form-control" disabled=""/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.TenKhachHang" class="form-control" name="TenKhachHang" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.TenKhachHang" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.SDT" class="form-control" name="SDT" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.SDT" class="form-control"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.Code" class="form-control" name="Code" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.Code" class="form-control" disabled=""/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.GiaVe" class="form-control" name="GiaVe" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.GiaVe" class="form-control" disabled=""/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.TienCoc" class="form-control" type="number" name="TienCoc" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.TienCoc" class="form-control" type="number"/>
							</td>

							<td v-if="!selectedProduct">
								<input v-model="product.created_at" class="form-control" name="created_at" disabled=""/>
							</td>
							<td v-else="">
								<input v-model="selectedProduct.created_at" class="form-control" disabled=""/>
							</td>

							<td v-if="selectedProduct">
								<button class="btn btn-primary" @click="updateProduct()">Save</button>
								<button class="btn btn-danger" @click="selectedProduct = null">Cancel</button>
							</td>
							<td v-else=""></td>
						</tr>
					</tbody>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="(product, index) in listProducts.data" :key="product.id" class="odd gradeX" align="center">
							<td>{{ product.Ghe }}</td>
							<td>{{ product.NhanVien }}</td>
							<td>{{ product.TenKhachHang }} 
								<p v-if="product.Email"> {{ product.Email }}</p>
								<p v-if="product.LoaiKH"> {{ product.LoaiKH }}</p>
							</td>
							<td>{{ product.SDT }}</td>
							<td>{{ product.Code }}</td>
							<td>{{ product.GiaVe }}</td>
							<td>{{ product.TienCoc }}</td>
							<td>{{ product.updated_at | formatDate }}</td>
							<td>
								<button class="btn btn-primary" @click="selecteProduct(product,index)">Edit</button>
								<button class="btn btn-danger" @click="deleteProduct(product)">Delete</button>
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
    name: "NhanVien-BanVe",
       data() {
           return {
               product: {
                   Ghe: '',
                   id_NhanVien: 0,
                   NhanVien: '',
                   TenKhachHang: '',
                   SDT: '',
                   Code: '',
                   GiaVe: '',
                   TienCoc: 0,
                   updated_at: ''
               },
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
       },
       methods: {
			async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'nv_banve', {
                       params: {
						   id_User: this.$route.query.id_User,
					       id_Chuyen: this.$route.query.id_Chuyen,
						   id_ChuXe: this.$route.query.id_ChuXe,
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
			},
			async updateProduct() {
                try {
                    await axios.put(process.env.VUE_APP_API_URL + 'nv_banve/' + this.selectedProduct.id, {
						id_User: this.$route.query.id_User,
                        TenKhachHang: this.selectedProduct.TenKhachHang,
                        SDT: this.selectedProduct.SDT,
						GiaVe: this.selectedProduct.GiaVe,
                        TienCoc: this.selectedProduct.TienCoc
                    })
                    location.reload()
                } catch (error) {
                    this.error = error.response.data
                }
			},
            async deleteProduct(product) {
                try {
                    await axios.delete(process.env.VUE_APP_API_URL + 'nv_banve/' + product.id)
                    location.reload()
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
