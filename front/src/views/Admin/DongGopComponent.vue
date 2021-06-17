<template>
	<div class="callback-form contact-us" v-if="user.id_ChucVu == 1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading">
					  <h2><em>Đóng góp</em></h2>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr align="center">
							<th>Họ tên</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Nội dung</th>
							<th>Ngày</th>
						</tr>
					</thead>
					<transition-group name="slide-fade" tag="tbody">
						<tr v-for="product in listProducts.data" :key="product.id" class="odd gradeX" align="center">
							<td>{{ product.name }}</td>
							<td>{{ product.email }}</td>
							<td>{{ product.sdt }}</td>
							<td>{{ product.noidung }}</td>
							<td>{{ product.created_at | formatDate }}</td>
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
               product: {
                   name: '',
                   email: '',
                   sdt: 0,
                   created_at: '',
                   noidung: ''
               },
               listProducts: {},
               error: null
           }
       },
       created() {
           this.getListProducts()
       },
	   computed: {
		 ...mapGetters("auth", ["user"])
       },
       methods: {
            async getListProducts(page = 1) {
               try {
                   const response = await axios.get(process.env.VUE_APP_API_URL + 'donggop', {
                       params: {
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
