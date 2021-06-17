import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);


const guest = (to, from, next) => {
  if (!localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};
const admin = (to, from, next) => {
  if (localStorage.getItem("authToken")) {
    return next();
  } else {
    return next("/");
  }
};

const routes = [
  /* User */
  {
    path: "/",
    name: "Home",
    component: () => import(/* webpackChunkName: "home" */ "../views/Home.vue")
  },
  {
    path: "/user-benxe",
    name: "User-BenXe",
    props: true,
    component: () => import(/* webpackChunkName: "user-benxe" */ "../views/User/BenXeComponent.vue")
  },
  {
    path: "/user-chuyenxe",
    name: "User-ChuyenXe",
    props: true,
    component: () => import(/* webpackChunkName: "user-chuyenxe" */ "../views/User/ChuyenXeComponent.vue")
  },
  {
    path: "/user-datve",
    name: "User-DatVe",
    props: true,
    component: () => import(/* webpackChunkName: "user-datve" */ "../views/User/DatVeComponent.vue")
  },
  {
    path: "/user-ve",
    name: "User-Ve",
    props: true,
    component: () => import(/* webpackChunkName: "user-ve" */ "../views/User/VeComponent.vue")
  },
  {
    path: "/user-payment-success",
    name: "User-Payment-Success",
    props: true,
    component: () => import(/* webpackChunkName: "user-payment-success" */ "../views/User/PaymentSuccessComponent.vue")
  },
  {
    path: "/user-payment-fail",
    name: "User-Payment-Fail",
    props: true,
    component: () => import(/* webpackChunkName: "user-payment-fail" */ "../views/User/PaymentFailComponent.vue")
  },
  {
    path: "/user-blog",
    name: "User-Blog",
    component: () => import(/* webpackChunkName: "user-blog" */ "../views/User/BlogComponent.vue")
  },
  {
    path: "/user-blog-detail",
    name: "User-Blog-Detail",
    component: () => import(/* webpackChunkName: "user-blog-detail" */ "../views/User/BlogDetailComponent.vue")
  },
  {
    path: "/user-contact",
    name: "User-Contact",
    component: () => import(/* webpackChunkName: "user-contact" */ "../views/User/ContactComponent.vue")
  },
  {
    path: "/user-gioithieu",
    name: "User-GioiThieu",
    component: () => import(/* webpackChunkName: "user-gioithieu" */ "../views/User/GioiThieuComponent.vue")
  },
  /* Auth */
  {
    path: "/login",
    name: "Login",
    beforeEnter: guest,
    component: () =>
      import(/* webpackChunkName: "login" */ "../views/Auth/Login.vue")
  },
  {
    path: "/password",
    name: "Password",
    beforeEnter: admin,
    component: () =>
      import(/* webpackChunkName: "password" */ "../views/Auth/Password.vue")
  },
  {
    path: "/register",
    name: "Register",
    beforeEnter: guest,
    component: () =>
      import(/* webpackChunkName: "register" */ "../views/Auth/Register.vue")
  },
  /* Admin */
  {
    path: "/admin-tuyen",
    name: "Admin-Tuyen",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-tuyen" */ "../views/Admin/TuyenComponent.vue")
  },
  {
    path: "/admin-benxe",
    name: "Admin-BenXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "admin-benxe" */ "../views/Admin/BenXeComponent.vue")
  },
  {
    path: "/admin-chuxe",
    name: "Admin-ChuXe",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-chuxe" */ "../views/Admin/ChuXeComponent.vue")
  },
  {
    path: "/admin-chuxe_benxe",
    name: "Admin-ChuXe_BenXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "admin-chuxe_benxe" */ "../views/Admin/ChuXe_BenXeComponent.vue")
  },
  {
    path: "/admin-khachhang",
    name: "Admin-KhachHang",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-khachhang" */ "../views/Admin/KhachHangComponent.vue")
  },
  {
    path: "/admin-nhanvien",
    name: "Admin-NhanVien",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-nhanvien" */ "../views/Admin/NhanVienComponent.vue")
  },
  {
    path: "/admin-donggop",
    name: "Admin-DongGop",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-donggop" */ "../views/Admin/DongGopComponent.vue")
  },
  {
    path: "/admin-blog",
    name: "Admin-BLog",
    beforeEnter: admin,
    component: () => import(/* webpackChunkName: "admin-blog" */ "../views/Admin/BlogComponent.vue")
  },
  /* Nha Xe */
  {
    path: "/nhaxe-chuyenxe",
    name: "ChuXe-ChuyenXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "chuxe-chuyenxe" */ "../views/ChuXe/ChuyenXeComponent.vue")
  },
  {
    path: "/nhaxe-chuyenxethang",
    name: "ChuXe-ChuyenXeThang",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "chuxe-chuyenxethang" */ "../views/ChuXe/ChuyenXeThangComponent.vue")
  },
  {
    path: "/nhaxe-xe",
    name: "ChuXe-Xe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "chuxe-xe" */ "../views/ChuXe/XeComponent.vue")
  },
  {
    path: "/nhaxe-ve",
    name: "ChuXe-Ve",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "chuxe-ve" */ "../views/ChuXe/VeComponent.vue")
  },
  {
    path: "/nhaxe-hoadon",
    name: "ChuXe-HoaDon",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "chuxe-hoadon" */ "../views/ChuXe/HoaDonComponent.vue")
  },
  /* Nhan Vien */
  {
    path: "/nhanvien-chuxe",
    name: "NhanVien-ChuXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "nhanvien-chuxe" */ "../views/NhanVien/ChuXeComponent.vue")
  },
  {
    path: "/nhanvien-tuyen",
    name: "NhanVien-Tuyen",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "nhanvien-tuyen" */ "../views/NhanVien/TuyenComponent.vue")
  },
  {
    path: "/nhanvien-benxe",
    name: "NhanVien-BenXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "nhanvien-benxe" */ "../views/NhanVien/BenXeComponent.vue")
  },
  {
    path: "/nhanvien-chuyenxe",
    name: "NhanVien-ChuyenXe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "nhanvien-chuyenxe" */ "../views/NhanVien/ChuyenXeComponent.vue")
  },
  {
    path: "/nhanvien-banve",
    name: "NhanVien-BanVe",
    beforeEnter: admin,
    props: true,
    component: () => import(/* webpackChunkName: "nhanvien-banve" */ "../views/NhanVien/BanVeComponent.vue")
  }
];
Vue.component('header-component', require('../views/Layout/Header.vue').default);

Vue.component('footer-component', require('../views/Layout/Footer.vue').default);

import moment from 'moment';
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('hh:mm DD/MM/YYYY');
  }
});
Vue.filter('formatDay', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY');
  }
});

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
