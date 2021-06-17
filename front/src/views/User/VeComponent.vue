<template>
	<div>
		<header-component></header-component>
		
		<div class="page-heading header-text">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1>Quản Lý Vé Khách Hàng</h1>
					</div>
				</div>
			</div>
		</div>
		
		<div class="callback-form contact-us" v-if="user.id_ChucVu == 4 && user.id == this.$route.query.id_User">
			<div class="container">
				<div class="row">
					<table class="table table-striped table-bordered table-hover" >
						<thead>
							<tr align="center">
								<th>Tuyến</th>
								<th>Ngày - Giờ</th>
								<th>Ghế</th>
								<th>Tên Khách Hàng</th>
								<th>Số Điện Thoại</th>
								<th>Code</th>
								<th>Tiền Cọc</th>
								<th width="100px"></th>
							</tr>
						</thead>
						<transition-group name="slide-fade" tag="tbody">
							<tr v-for="product in listProducts.data" :key="product.id" class="odd gradeX" align="center">
								<td>{{ product.DiaDiem1 }} - {{ product.DiaDiem2 }} </td>
								<td>{{ product.Ngay | formatDay }} <p>{{ product.Gio}}</p></td>
								<td>{{ product.Ghe }}</td>
								<td>{{ product.TenKhachHang }}</td>
								<td>{{ product.SDT }}</td>
								<td>{{ product.Code }}</td>
								<td>{{ product.TienCoc }}</td>
								<td>
									<button class="btn btn-danger" @click="deleteProduct(product)">Hủy vé</button>
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
				<p>
					*Lưu ý:<br/>
					- Quý khách trả vé mất 20% tiền cọc.<br/>
					- Quý khách đến bến trước lúc khởi hành ít nhất 20 phút.<br/>
					- Trước giờ xe khởi hành 30 phút, Công ty không chịu trách nhiệm hoàn trả số tiền đã đặt chỗ.
				</p>
			</div>
		</div>

		<footer-component></footer-component>
	</div>
</template>
<script>
import { mapGetters } from "vuex"
import axios from "axios"
export default {
    name: "User-Ve",
       data() {
           return {
               listProducts: {},
               error: null
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
                           page: page
                       }
                   })
                   this.listProducts = response.data
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
