<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 3 && user.id == this.$route.query.id_User">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
						<h2>
							<em>Hóa Đơn</em>
						</h2>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Xe</th>
							<th>Bến</th>
							<th>Ngày</th>
							<th>Giờ</th>
							<th>Giá Vé</th>
							<th>Số Lượng</th>
							<th>Còn Lại</th>
							<th>Thành Tiền</th>
						</tr>
					</thead>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="product in listProducts.data" :key="product.id" class="odd gradeX" align="center">
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
							<td>{{ product.SoGhe }}</td>
							<td>{{ product.ConLai }}</td>
							<td>{{ product.ThanhTien }}</td>
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
    name: "ChuXe-HoaDon",
       data() {
           return {
               listProducts: {},
               error: null,
           }
       },
	   computed: {
		 ...mapGetters("auth", ["user"])
       },
       created() {
           this.getListProducts()
       },
       methods: {
			async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'chuyenxe', {
                       params: {
						   HoaDon: true,
					       id_User: this.$route.query.id_User,
                           page: page
                       }
                   })
                   this.listProducts = response.data
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
