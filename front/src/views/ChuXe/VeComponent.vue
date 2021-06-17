<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 3 && user.id == this.$route.query.id_User">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2><em>Quản Lý Vé</em></h2>
						<span> {{ this.listChuyen.DiaDiem1 }} - {{ this.listChuyen.DiaDiem2 }}: Bến {{ this.listChuyen.BenXe }} <br/>
							{{ this.listChuyen.Ngay | formatDay }} - {{ this.listChuyen.Gio }} - {{ this.listChuyen.GiaVe }} VNĐ
						</span>
						<vue-excel-xlsx class="btn btn-primary"
							:data="listFull.data"
							:columns="columns"
							:filename="'DanhSachVe_ID_Chuyen'+this.listChuyen.id"
							:sheetname="'sheetname'"
							>
							Dowload File Excel
						</vue-excel-xlsx>
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
						</tr>
					</thead>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="product in listProducts.data" :key="product.id" class="odd gradeX" align="center">
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
import VueExcelXlsx from "vue-excel-xlsx";
import Vue from "vue";
Vue.use(VueExcelXlsx);

export default {
    name: "NhanVien-BanVe",
       data() {
           return {
			   columns : [
                    {
                        label: "Ghế",
                        field: "Ghe",
                    },
                    {
                        label: "Nhân Viên",
                        field: "NhanVien",
                    },
                    {
                        label: "Tên Khách Hàng",
                        field: "TenKhachHang",
                    },
                    {
                        label: "Số Điện Thoại",
                        field: "SDT",
                    },
                    {
                        label: "Code",
                        field: "Code",
                    },
                    {
                        label: "Giá Vé",
                        field: "GiaVe",
                    },
                    {
                        label: "Tiền Cọc",
                        field: "TienCoc",
                    },
                ],
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
			   listChuyen: null,
               listProducts: {},
			   listFull: {},
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
			this.getListChuyen()
			this.getListProducts()
			this.getListFull()
       },
       methods: {
			async getListChuyen() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'chuyenxe/' + this.$route.query.id_Chuyen)
                   this.listChuyen = response.data.data
               } catch (error) {
                   this.error = error.response.data
               }
			},
			async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'nv_banve', {
                       params: {
						   id_User: this.$route.query.id_User,
					       id_Chuyen: this.$route.query.id_Chuyen,
                           page: page
                       }
                   })
                   this.listProducts = response.data
               } catch (error) {
                   this.error = error.response.data
               }
            },
			async getListFull() {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'nv_banve', {
                       params: {
						   id_User: this.$route.query.id_User,
					       id_Chuyen: this.$route.query.id_Chuyen,
						   Full: true
                       }
                   })
                   this.listFull = response.data
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
