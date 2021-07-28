<template>
	<div>
		<header-component></header-component>

		<div class="page-heading header-text" v-if="PaymentSuccess == 0">
			<div class="section-center">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="booking-form">
								<div class="row" v-if="ThanhToan == 0">
									<div class="col-md-12">
										<h3 class="lable-h">Mien Dong Station</h3>
										<h5> {{ this.listChuyen.DiaDiem1 }} - {{ this.listChuyen.DiaDiem2 }}: Bến {{ this.listChuyen.BenXe }} </h5>
										<h6> {{ this.listChuyen.ChuXe }} - {{ this.listChuyen.SDT }} - {{ this.listChuyen.Ngay | formatDay }} - {{ this.listChuyen.Gio }} - {{ this.listChuyen.GiaVe }} đ</h6>
									</div>
								</div>
								<div class="row" v-else="">
									<div class="col-md-12">
										<h3 class="lable-h">Mien Dong Station</h3>
									</div>
								</div>
								<div class="row" v-if="NhapThongTin == 0 && ThanhToan == 0">
									<div class="So-do-xe col-md-12" v-if="this.listChuyen.id_Loai == 1">
										<div class="col-md-1">
										</div>
										<div class="col-md-3" align="left">
											<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
											<h6>- Chú thích -</h6>
											<button class="Ghe-xe" disabled=""></button> Còn trống
											<br/>
											<button class="Ghe-xe-dadat" disabled=""></button> Đã đặt
											<br/>
											<button class="Ghe-xe-dangchon" disabled=""></button> Đang chọn
										</div>
										<div class="Tang-xe col-md-3">
											<span class="Ten-tang">Tầng 1</span>
											<hr/>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[0].TenKhachHang & !ListVes.data[0].isSelect & !ListVes.data[0].paymenting, 'Ghe-xe-dangchon': ListVes.data[0].isSelect, 'Ghe-xe-dadat': ListVes.data[0].TenKhachHang || ListVes.data[0].paymenting }" v-on:click="Select(ListVes.data[0])">
												{{ ListVes.data[0].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[1].TenKhachHang & !ListVes.data[1].isSelect & !ListVes.data[1].paymenting, 'Ghe-xe-dangchon': ListVes.data[1].isSelect, 'Ghe-xe-dadat': ListVes.data[1].TenKhachHang || ListVes.data[1].paymenting }" v-on:click="Select(ListVes.data[1])">
												{{ ListVes.data[1].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[2].TenKhachHang & !ListVes.data[2].isSelect & !ListVes.data[2].paymenting, 'Ghe-xe-dangchon': ListVes.data[2].isSelect, 'Ghe-xe-dadat': ListVes.data[2].TenKhachHang || ListVes.data[2].paymenting }" v-on:click="Select(ListVes.data[2])">
												{{ ListVes.data[2].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[3].TenKhachHang & !ListVes.data[3].isSelect & !ListVes.data[3].paymenting, 'Ghe-xe-dangchon': ListVes.data[3].isSelect, 'Ghe-xe-dadat': ListVes.data[3].TenKhachHang || ListVes.data[3].paymenting }" v-on:click="Select(ListVes.data[3])">
												{{ ListVes.data[3].Ghe }}
											</button>
										
											<button v-bind:class="{'Ghe-xe': !ListVes.data[4].TenKhachHang & !ListVes.data[4].isSelect & !ListVes.data[4].paymenting, 'Ghe-xe-dangchon': ListVes.data[4].isSelect, 'Ghe-xe-dadat': ListVes.data[4].TenKhachHang || ListVes.data[4].paymenting }" v-on:click="Select(ListVes.data[4])">
												{{ ListVes.data[4].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[5].TenKhachHang & !ListVes.data[5].isSelect & !ListVes.data[5].paymenting, 'Ghe-xe-dangchon': ListVes.data[5].isSelect, 'Ghe-xe-dadat': ListVes.data[5].TenKhachHang || ListVes.data[5].paymenting }" v-on:click="Select(ListVes.data[5])">
												{{ ListVes.data[5].Ghe }}
											</button>
									
											<button v-bind:class="{'Ghe-xe': !ListVes.data[6].TenKhachHang & !ListVes.data[6].isSelect & !ListVes.data[6].paymenting, 'Ghe-xe-dangchon': ListVes.data[6].isSelect, 'Ghe-xe-dadat': ListVes.data[6].TenKhachHang || ListVes.data[6].paymenting }" v-on:click="Select(ListVes.data[6])">
												{{ ListVes.data[6].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[7].TenKhachHang & !ListVes.data[7].isSelect & !ListVes.data[7].paymenting, 'Ghe-xe-dangchon': ListVes.data[7].isSelect, 'Ghe-xe-dadat': ListVes.data[7].TenKhachHang || ListVes.data[7].paymenting }" v-on:click="Select(ListVes.data[7])">
												{{ ListVes.data[7].Ghe }}
											</button>
									
											<button v-bind:class="{'Ghe-xe': !ListVes.data[8].TenKhachHang & !ListVes.data[8].isSelect & !ListVes.data[8].paymenting, 'Ghe-xe-dangchon': ListVes.data[8].isSelect, 'Ghe-xe-dadat': ListVes.data[8].TenKhachHang || ListVes.data[8].paymenting }" v-on:click="Select(ListVes.data[8])">
												{{ ListVes.data[8].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[9].TenKhachHang & !ListVes.data[9].isSelect & !ListVes.data[9].paymenting, 'Ghe-xe-dangchon': ListVes.data[9].isSelect, 'Ghe-xe-dadat': ListVes.data[9].TenKhachHang || ListVes.data[9].paymenting }" v-on:click="Select(ListVes.data[9])">
												{{ ListVes.data[9].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[10].TenKhachHang & !ListVes.data[10].isSelect & !ListVes.data[10].paymenting, 'Ghe-xe-dangchon': ListVes.data[10].isSelect, 'Ghe-xe-dadat': ListVes.data[10].TenKhachHang || ListVes.data[10].paymenting }" v-on:click="Select(ListVes.data[10])">
												{{ ListVes.data[10].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[11].TenKhachHang & !ListVes.data[11].isSelect & !ListVes.data[11].paymenting, 'Ghe-xe-dangchon': ListVes.data[11].isSelect, 'Ghe-xe-dadat': ListVes.data[11].TenKhachHang || ListVes.data[11].paymenting }" v-on:click="Select(ListVes.data[11])">
												{{ ListVes.data[11].Ghe }}
											</button>
										</div>
										<div class="Tang-xe col-md-3">
											<span class="Ten-tang">Tầng 2</span>
											<hr/>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[12].TenKhachHang & !ListVes.data[12].isSelect & !ListVes.data[12].paymenting, 'Ghe-xe-dangchon': ListVes.data[12].isSelect, 'Ghe-xe-dadat': ListVes.data[12].TenKhachHang || ListVes.data[12].paymenting }" v-on:click="Select(ListVes.data[12])">
												{{ ListVes.data[12].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[13].TenKhachHang & !ListVes.data[13].isSelect & !ListVes.data[13].paymenting, 'Ghe-xe-dangchon': ListVes.data[13].isSelect, 'Ghe-xe-dadat': ListVes.data[13].TenKhachHang || ListVes.data[13].paymenting }" v-on:click="Select(ListVes.data[13])">
												{{ ListVes.data[13].Ghe }}
											</button>
													
											<button v-bind:class="{'Ghe-xe': !ListVes.data[14].TenKhachHang & !ListVes.data[14].isSelect & !ListVes.data[14].paymenting, 'Ghe-xe-dangchon': ListVes.data[14].isSelect, 'Ghe-xe-dadat': ListVes.data[14].TenKhachHang || ListVes.data[14].paymenting }" v-on:click="Select(ListVes.data[14])">
												{{ ListVes.data[14].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[15].TenKhachHang & !ListVes.data[15].isSelect & !ListVes.data[15].paymenting, 'Ghe-xe-dangchon': ListVes.data[15].isSelect, 'Ghe-xe-dadat': ListVes.data[15].TenKhachHang || ListVes.data[15].paymenting }" v-on:click="Select(ListVes.data[15])">
												{{ ListVes.data[15].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[16].TenKhachHang & !ListVes.data[16].isSelect & !ListVes.data[16].paymenting, 'Ghe-xe-dangchon': ListVes.data[16].isSelect, 'Ghe-xe-dadat': ListVes.data[16].TenKhachHang || ListVes.data[16].paymenting }" v-on:click="Select(ListVes.data[16])">
												{{ ListVes.data[16].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[17].TenKhachHang & !ListVes.data[17].isSelect & !ListVes.data[17].paymenting, 'Ghe-xe-dangchon': ListVes.data[17].isSelect, 'Ghe-xe-dadat': ListVes.data[17].TenKhachHang || ListVes.data[17].paymenting }" v-on:click="Select(ListVes.data[17])">
												{{ ListVes.data[17].Ghe }}
											</button>
												
											<button v-bind:class="{'Ghe-xe': !ListVes.data[18].TenKhachHang & !ListVes.data[18].isSelect & !ListVes.data[18].paymenting, 'Ghe-xe-dangchon': ListVes.data[18].isSelect, 'Ghe-xe-dadat': ListVes.data[18].TenKhachHang || ListVes.data[18].paymenting }" v-on:click="Select(ListVes.data[18])">
												{{ ListVes.data[18].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[19].TenKhachHang & !ListVes.data[19].isSelect & !ListVes.data[19].paymenting, 'Ghe-xe-dangchon': ListVes.data[19].isSelect, 'Ghe-xe-dadat': ListVes.data[19].TenKhachHang || ListVes.data[19].paymenting }" v-on:click="Select(ListVes.data[19])">
												{{ ListVes.data[19].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[20].TenKhachHang & !ListVes.data[20].isSelect & !ListVes.data[20].paymenting, 'Ghe-xe-dangchon': ListVes.data[20].isSelect, 'Ghe-xe-dadat': ListVes.data[20].TenKhachHang || ListVes.data[20].paymenting }" v-on:click="Select(ListVes.data[20])">
												{{ ListVes.data[20].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[21].TenKhachHang & !ListVes.data[21].isSelect & !ListVes.data[21].paymenting, 'Ghe-xe-dangchon': ListVes.data[21].isSelect, 'Ghe-xe-dadat': ListVes.data[21].TenKhachHang || ListVes.data[21].paymenting }" v-on:click="Select(ListVes.data[21])">
												{{ ListVes.data[21].Ghe }}
											</button>
													
											<button v-bind:class="{'Ghe-xe': !ListVes.data[22].TenKhachHang & !ListVes.data[22].isSelect & !ListVes.data[22].paymenting, 'Ghe-xe-dangchon': ListVes.data[22].isSelect, 'Ghe-xe-dadat': ListVes.data[22].TenKhachHang || ListVes.data[22].paymenting }" v-on:click="Select(ListVes.data[22])">
												{{ ListVes.data[22].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[23].TenKhachHang & !ListVes.data[23].isSelect & !ListVes.data[23].paymenting, 'Ghe-xe-dangchon': ListVes.data[23].isSelect, 'Ghe-xe-dadat': ListVes.data[23].TenKhachHang || ListVes.data[23].paymenting }" v-on:click="Select(ListVes.data[23])">
												{{ ListVes.data[23].Ghe }}
											</button>
										</div>
									</div>
									<div class="So-do-xe col-md-12" v-else="">
										<div class="col-md-1">
										</div>
										<div class="col-md-3" align="left">
											<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
											<h6>- Chú thích -</h6>
											<button class="Ghe-xe" disabled=""></button> Còn trống
											<br/>
											<button class="Ghe-xe-dadat" disabled=""></button> Đã đặt
											<br/>
											<button class="Ghe-xe-dangchon" disabled=""></button> Đang chọn
										</div>
										<div class="Tang-xe col-md-3">
											<span class="Ten-tang">Tầng 1</span>
											<hr/>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[0].TenKhachHang & !ListVes.data[0].isSelect & !ListVes.data[0].paymenting, 'Ghe-xe-dangchon': ListVes.data[0].isSelect, 'Ghe-xe-dadat': ListVes.data[0].TenKhachHang || ListVes.data[0].paymenting }" v-on:click="Select(ListVes.data[0])">
												{{ ListVes.data[0].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[1].TenKhachHang & !ListVes.data[1].isSelect & !ListVes.data[1].paymenting, 'Ghe-xe-dangchon': ListVes.data[1].isSelect, 'Ghe-xe-dadat': ListVes.data[1].TenKhachHang || ListVes.data[1].paymenting }" v-on:click="Select(ListVes.data[1])">
												{{ ListVes.data[1].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[2].TenKhachHang & !ListVes.data[2].isSelect & !ListVes.data[2].paymenting, 'Ghe-xe-dangchon': ListVes.data[2].isSelect, 'Ghe-xe-dadat': ListVes.data[2].TenKhachHang || ListVes.data[2].paymenting }" v-on:click="Select(ListVes.data[2])">
												{{ ListVes.data[2].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[3].TenKhachHang & !ListVes.data[3].isSelect & !ListVes.data[3].paymenting, 'Ghe-xe-dangchon': ListVes.data[3].isSelect, 'Ghe-xe-dadat': ListVes.data[3].TenKhachHang || ListVes.data[3].paymenting }" v-on:click="Select(ListVes.data[3])">
												{{ ListVes.data[3].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[4].TenKhachHang & !ListVes.data[4].isSelect & !ListVes.data[4].paymenting, 'Ghe-xe-dangchon': ListVes.data[4].isSelect, 'Ghe-xe-dadat': ListVes.data[4].TenKhachHang || ListVes.data[4].paymenting }" v-on:click="Select(ListVes.data[4])">
												{{ ListVes.data[4].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[5].TenKhachHang & !ListVes.data[5].isSelect & !ListVes.data[5].paymenting, 'Ghe-xe-dangchon': ListVes.data[5].isSelect, 'Ghe-xe-dadat': ListVes.data[5].TenKhachHang || ListVes.data[5].paymenting }" v-on:click="Select(ListVes.data[5])">
												{{ ListVes.data[5].Ghe }}
											</button>
									
											<button v-bind:class="{'Ghe-xe': !ListVes.data[6].TenKhachHang & !ListVes.data[6].isSelect & !ListVes.data[6].paymenting, 'Ghe-xe-dangchon': ListVes.data[6].isSelect, 'Ghe-xe-dadat': ListVes.data[6].TenKhachHang || ListVes.data[6].paymenting }" v-on:click="Select(ListVes.data[6])">
												{{ ListVes.data[6].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[7].TenKhachHang & !ListVes.data[7].isSelect & !ListVes.data[7].paymenting, 'Ghe-xe-dangchon': ListVes.data[7].isSelect, 'Ghe-xe-dadat': ListVes.data[7].TenKhachHang || ListVes.data[7].paymenting }" v-on:click="Select(ListVes.data[7])">
												{{ ListVes.data[7].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[8].TenKhachHang & !ListVes.data[8].isSelect & !ListVes.data[8].paymenting, 'Ghe-xe-dangchon': ListVes.data[8].isSelect, 'Ghe-xe-dadat': ListVes.data[8].TenKhachHang || ListVes.data[8].paymenting }" v-on:click="Select(ListVes.data[8])">
												{{ ListVes.data[8].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[9].TenKhachHang & !ListVes.data[9].isSelect & !ListVes.data[9].paymenting, 'Ghe-xe-dangchon': ListVes.data[9].isSelect, 'Ghe-xe-dadat': ListVes.data[9].TenKhachHang || ListVes.data[9].paymenting }" v-on:click="Select(ListVes.data[9])">
												{{ ListVes.data[9].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[10].TenKhachHang & !ListVes.data[10].isSelect & !ListVes.data[10].paymenting, 'Ghe-xe-dangchon': ListVes.data[10].isSelect, 'Ghe-xe-dadat': ListVes.data[10].TenKhachHang || ListVes.data[10].paymenting }" v-on:click="Select(ListVes.data[10])">
												{{ ListVes.data[10].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[11].TenKhachHang & !ListVes.data[11].isSelect & !ListVes.data[11].paymenting, 'Ghe-xe-dangchon': ListVes.data[11].isSelect, 'Ghe-xe-dadat': ListVes.data[11].TenKhachHang || ListVes.data[11].paymenting }" v-on:click="Select(ListVes.data[11])">
												{{ ListVes.data[11].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[12].TenKhachHang & !ListVes.data[12].isSelect & !ListVes.data[12].paymenting, 'Ghe-xe-dangchon': ListVes.data[12].isSelect, 'Ghe-xe-dadat': ListVes.data[12].TenKhachHang || ListVes.data[12].paymenting }" v-on:click="Select(ListVes.data[12])">
												{{ ListVes.data[12].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[13].TenKhachHang & !ListVes.data[13].isSelect & !ListVes.data[13].paymenting, 'Ghe-xe-dangchon': ListVes.data[13].isSelect, 'Ghe-xe-dadat': ListVes.data[13].TenKhachHang || ListVes.data[13].paymenting }" v-on:click="Select(ListVes.data[13])">
												{{ ListVes.data[13].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[14].TenKhachHang & !ListVes.data[14].isSelect & !ListVes.data[14].paymenting, 'Ghe-xe-dangchon': ListVes.data[14].isSelect, 'Ghe-xe-dadat': ListVes.data[14].TenKhachHang || ListVes.data[14].paymenting }" v-on:click="Select(ListVes.data[14])">
												{{ ListVes.data[14].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[15].TenKhachHang & !ListVes.data[15].isSelect & !ListVes.data[15].paymenting, 'Ghe-xe-dangchon': ListVes.data[15].isSelect, 'Ghe-xe-dadat': ListVes.data[15].TenKhachHang || ListVes.data[15].paymenting }" v-on:click="Select(ListVes.data[15])">
												{{ ListVes.data[15].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[16].TenKhachHang & !ListVes.data[16].isSelect & !ListVes.data[16].paymenting, 'Ghe-xe-dangchon': ListVes.data[16].isSelect, 'Ghe-xe-dadat': ListVes.data[16].TenKhachHang || ListVes.data[16].paymenting }" v-on:click="Select(ListVes.data[16])">
												{{ ListVes.data[16].Ghe }}
											</button>
										</div>
										<div class="Tang-xe col-md-3">
											<span class="Ten-tang">Tầng 2</span>
											<hr/>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[17].TenKhachHang & !ListVes.data[17].isSelect & !ListVes.data[17].paymenting, 'Ghe-xe-dangchon': ListVes.data[17].isSelect, 'Ghe-xe-dadat': ListVes.data[17].TenKhachHang || ListVes.data[17].paymenting }" v-on:click="Select(ListVes.data[17])">
												{{ ListVes.data[17].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[18].TenKhachHang & !ListVes.data[18].isSelect & !ListVes.data[18].paymenting, 'Ghe-xe-dangchon': ListVes.data[18].isSelect, 'Ghe-xe-dadat': ListVes.data[18].TenKhachHang || ListVes.data[18].paymenting }" v-on:click="Select(ListVes.data[18])">
												{{ ListVes.data[18].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[19].TenKhachHang & !ListVes.data[19].isSelect & !ListVes.data[19].paymenting, 'Ghe-xe-dangchon': ListVes.data[19].isSelect, 'Ghe-xe-dadat': ListVes.data[19].TenKhachHang || ListVes.data[19].paymenting }" v-on:click="Select(ListVes.data[19])">
												{{ ListVes.data[19].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[20].TenKhachHang & !ListVes.data[20].isSelect & !ListVes.data[20].paymenting, 'Ghe-xe-dangchon': ListVes.data[20].isSelect, 'Ghe-xe-dadat': ListVes.data[20].TenKhachHang || ListVes.data[20].paymenting }" v-on:click="Select(ListVes.data[20])">
												{{ ListVes.data[20].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[21].TenKhachHang & !ListVes.data[21].isSelect & !ListVes.data[21].paymenting, 'Ghe-xe-dangchon': ListVes.data[21].isSelect, 'Ghe-xe-dadat': ListVes.data[21].TenKhachHang || ListVes.data[21].paymenting }" v-on:click="Select(ListVes.data[21])">
												{{ ListVes.data[21].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[22].TenKhachHang & !ListVes.data[22].isSelect & !ListVes.data[22].paymenting, 'Ghe-xe-dangchon': ListVes.data[22].isSelect, 'Ghe-xe-dadat': ListVes.data[22].TenKhachHang || ListVes.data[22].paymenting }" v-on:click="Select(ListVes.data[22])">
												{{ ListVes.data[22].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[23].TenKhachHang & !ListVes.data[23].isSelect & !ListVes.data[23].paymenting, 'Ghe-xe-dangchon': ListVes.data[23].isSelect, 'Ghe-xe-dadat': ListVes.data[23].TenKhachHang || ListVes.data[23].paymenting }" v-on:click="Select(ListVes.data[23])">
												{{ ListVes.data[23].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[24].TenKhachHang & !ListVes.data[24].isSelect & !ListVes.data[24].paymenting, 'Ghe-xe-dangchon': ListVes.data[24].isSelect, 'Ghe-xe-dadat': ListVes.data[24].TenKhachHang || ListVes.data[24].paymenting }" v-on:click="Select(ListVes.data[24])">
												{{ ListVes.data[24].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[25].TenKhachHang & !ListVes.data[25].isSelect & !ListVes.data[25].paymenting, 'Ghe-xe-dangchon': ListVes.data[25].isSelect, 'Ghe-xe-dadat': ListVes.data[25].TenKhachHang || ListVes.data[25].paymenting }" v-on:click="Select(ListVes.data[25])">
												{{ ListVes.data[25].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[26].TenKhachHang & !ListVes.data[26].isSelect & !ListVes.data[26].paymenting, 'Ghe-xe-dangchon': ListVes.data[26].isSelect, 'Ghe-xe-dadat': ListVes.data[26].TenKhachHang || ListVes.data[26].paymenting }" v-on:click="Select(ListVes.data[26])">
												{{ ListVes.data[26].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[27].TenKhachHang & !ListVes.data[27].isSelect & !ListVes.data[27].paymenting, 'Ghe-xe-dangchon': ListVes.data[27].isSelect, 'Ghe-xe-dadat': ListVes.data[27].TenKhachHang || ListVes.data[27].paymenting }" v-on:click="Select(ListVes.data[27])">
												{{ ListVes.data[27].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[28].TenKhachHang & !ListVes.data[28].isSelect & !ListVes.data[28].paymenting, 'Ghe-xe-dangchon': ListVes.data[28].isSelect, 'Ghe-xe-dadat': ListVes.data[28].TenKhachHang || ListVes.data[28].paymenting }" v-on:click="Select(ListVes.data[28])">
												{{ ListVes.data[28].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[29].TenKhachHang & !ListVes.data[29].isSelect & !ListVes.data[29].paymenting, 'Ghe-xe-dangchon': ListVes.data[29].isSelect, 'Ghe-xe-dadat': ListVes.data[29].TenKhachHang || ListVes.data[29].paymenting }" v-on:click="Select(ListVes.data[29])">
												{{ ListVes.data[29].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[30].TenKhachHang & !ListVes.data[30].isSelect & !ListVes.data[30].paymenting, 'Ghe-xe-dangchon': ListVes.data[30].isSelect, 'Ghe-xe-dadat': ListVes.data[30].TenKhachHang || ListVes.data[30].paymenting }" v-on:click="Select(ListVes.data[30])">
												{{ ListVes.data[30].Ghe }}
											</button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[31].TenKhachHang & !ListVes.data[31].isSelect & !ListVes.data[31].paymenting, 'Ghe-xe-dangchon': ListVes.data[31].isSelect, 'Ghe-xe-dadat': ListVes.data[31].TenKhachHang || ListVes.data[31].paymenting }" v-on:click="Select(ListVes.data[31])">
												{{ ListVes.data[31].Ghe }}
											</button>
											
											<button v-bind:class="{'Ghe-xe': !ListVes.data[32].TenKhachHang & !ListVes.data[32].isSelect & !ListVes.data[32].paymenting, 'Ghe-xe-dangchon': ListVes.data[32].isSelect, 'Ghe-xe-dadat': ListVes.data[32].TenKhachHang || ListVes.data[32].paymenting }" v-on:click="Select(ListVes.data[32])">
												{{ ListVes.data[32].Ghe }}
											</button>
											<button class="Ghe-xe-rong" disabled=""> _ </button>
											<button v-bind:class="{'Ghe-xe': !ListVes.data[33].TenKhachHang & !ListVes.data[33].isSelect & !ListVes.data[33].paymenting, 'Ghe-xe-dangchon': ListVes.data[33].isSelect, 'Ghe-xe-dadat': ListVes.data[33].TenKhachHang || ListVes.data[33].paymenting }" v-on:click="Select(ListVes.data[33])">
												{{ ListVes.data[33].Ghe }}
											</button>
										</div>
									</div>
								</div>
								<div class="row" v-else-if="NhapThongTin == 1 && ThanhToan == 0">
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Họ và tên *</span>
											<input v-model="khachhang.name" class="form-control" name="name" required=""/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Số điện thoại *</span>
											<input v-model="khachhang.sdt" type="number" class="form-control" name="sdt" required=""/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Email *</span>
											<input v-model="khachhang.EmailNhap" class="form-control" name="email" required=""/>
										</div>
									</div>
								</div>
								<div class="row" v-else="">
									<table class="table table-striped table-hover" >
										<tbody>
											<tr class="odd gradeX" align="left">
												<td class="col-md-8">
													Phương thức thanh toán
													<hr/>
													<ul class="list-content">
														<li>
															<label><input type="radio" value="Cash" v-model="option_payment" name="option_payment" checked="checked">Thanh toán tiền mặt</label>
															<div class="boxContent" v-if="option_payment == 'Cash'">
																<p>
																	Nếu quý khách chọn hình thức thanh toán này, quý khách sẽ thanh toán và lấy vé tại Bến xe. Quý khách vui lòng đến bến trước giờ khởi hành 30 phút để bến sắp xếp ổn định cho quý khách.
																	Trường hợp đến sau 30 phút, bên Bến sẽ gọi điện cho quý khách để xác nhận và có thể huỷ vé của quý khách, xin cảm ơn.	
																</p>
															</div>
														</li>
														<li>
															<label><input type="radio" value="NL" v-model="option_payment" name="option_payment" selected="true">Thanh toán bằng Ví điện tử Ngân Lượng</label>
															<div class="boxContent" v-if="option_payment == 'NL'">
																<p>
																Thanh toán trực tuyến AN TOÀN và ĐƯỢC BẢO VỆ, sử dụng thẻ ngân hàng trong và ngoài nước hoặc nhiều hình thức tiện lợi khác.
																Được bảo hộ & cấp phép bởi NGÂN HÀNG NHÀ NƯỚC, ví điện tử duy nhất được cộng đồng ƯA THÍCH NHẤT 2 năm liên tiếp, Bộ Thông tin Truyền thông trao giải thưởng Sao Khuê
																Giao dịch. Đăng ký ví NgânLượng.vn miễn phí <a href="https://www.nganluong.vn/?portal=nganluong&amp;page=user_register" target="_blank">tại đây</a></p>
															</div>
														</li>
														<li>
															<label><input type="radio" value="ATM_ONLINE" v-model="option_payment" name="option_payment">Thanh toán online bằng thẻ ngân hàng nội địa</label>
															<div class="boxContent" v-if="option_payment == 'ATM_ONLINE'">
																<ul class="cardList clearfix">
																	<li class="bank-online-methods ">
																		<label for="vcb_ck_on">
																			<i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
																			<input type="radio" value="BIDV" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="vcb_ck_on">
																			<i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
																			<input type="radio" value="VCB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="vnbc_ck_on">
																			<i class="DAB" title="Ngân hàng Đông Á"></i>
																			<input type="radio" value="DAB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="tcb_ck_on">
																			<i class="TCB" title="Ngân hàng Kỹ Thương"></i>
																			<input type="radio" value="TCB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_mb_ck_on">
																			<i class="MB" title="Ngân hàng Quân Đội"></i>
																			<input type="radio" value="MB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_vib_ck_on">
																			<i class="VIB" title="Ngân hàng Quốc tế"></i>
																			<input type="radio" value="VIB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_vtb_ck_on">
																			<i class="ICB" title="Ngân hàng Công Thương Việt Nam"></i>
																			<input type="radio" value="ICB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_exb_ck_on">
																			<i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
																			<input type="radio" value="EXB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_acb_ck_on">
																			<i class="ACB" title="Ngân hàng Á Châu"></i>
																			<input type="radio" value="ACB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_hdb_ck_on">
																			<i class="HDB" title="Ngân hàng Phát triển Nhà TPHCM"></i>
																			<input type="radio" value="HDB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_msb_ck_on">
																			<i class="MSB" title="Ngân hàng Hàng Hải"></i>
																			<input type="radio" value="MSB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_nvb_ck_on">
																			<i class="NVB" title="Ngân hàng Nam Việt"></i>
																			<input type="radio" value="NVB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_vab_ck_on">
																			<i class="VAB" title="Ngân hàng Việt Á"></i>
																			<input type="radio" value="VAB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_vpb_ck_on">
																			<i class="VPB" title="Ngân Hàng Việt Nam Thịnh Vượng"></i>
																			<input type="radio" value="VPB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_scb_ck_on">
																			<i class="SCB" title="Ngân hàng Sài Gòn Thương tín"></i>
																			<input type="radio" value="SCB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="bnt_atm_pgb_ck_on">
																			<i class="PGB" title="Ngân hàng Xăng dầu Petrolimex"></i>
																			<input type="radio" value="PGB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="bnt_atm_gpb_ck_on">
																			<i class="GPB" title="Ngân hàng TMCP Dầu khí Toàn Cầu"></i>
																			<input type="radio" value="GPB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="bnt_atm_agb_ck_on">
																			<i class="AGB" title="Ngân hàng Nông nghiệp &amp; Phát triển nông thôn"></i>
																			<input type="radio" value="AGB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="bnt_atm_sgb_ck_on">
																			<i class="SGB" title="Ngân hàng Sài Gòn Công Thương"></i>
																			<input type="radio" value="SGB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>	
																	<li class="bank-online-methods ">
																		<label for="sml_atm_bab_ck_on">
																			<i class="BAB" title="Ngân hàng Bắc Á"></i>
																			<input type="radio" value="BAB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_bab_ck_on">
																			<i class="TPB" title="Tền phong bank"></i>
																			<input type="radio" value="TPB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_bab_ck_on">
																			<i class="NAB" title="Ngân hàng Nam Á"></i>
																			<input type="radio" value="NAB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_bab_ck_on">
																			<i class="SHB" title="Ngân hàng TMCP Sài Gòn - Hà Nội (SHB)"></i>
																			<input type="radio" value="SHB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																	<li class="bank-online-methods ">
																		<label for="sml_atm_bab_ck_on">
																			<i class="OJB" title="Ngân hàng TMCP Đại Dương (OceanBank)"></i>
																			<input type="radio" value="OJB" v-model="bankcode" name="bankcode" >
																		</label>
																	</li>
																</ul>
															</div>
														</li>
													</ul>
												</td>
												<td class="col-md-4">
													Thông tin chuyến đi
													<hr/>
													Hành khách: {{ this.khachhang.name }}<br/>
													Số điện thoại: {{ this.khachhang.sdt }}<br/>
													Email: {{ this.khachhang.EmailNhap }}<br/>
													<hr/>
													Nhà xe: {{ this.listChuyen.ChuXe }}<br/>
													Điểm khởi hành: {{ this.listChuyen.DiaDiem1 }}<br/>
													Điểm đến: {{ this.listChuyen.DiaDiem2 }}<br/>
													Ngày khởi hành: {{ this.listChuyen.Ngay | formatDay }}<br/>
													Giờ khởi hành: {{ this.listChuyen.Gio }}
													<hr/>
													<h7 v-if="user && this.option_payment == 'Cash'">
														Thành tiền: {{ this.TongTien }} đ
													</h7>
													<h7 v-else-if="user">
														Tổng tiền: {{ this.TongTien }} đ<br/>
														Giảm giá: {{ this.discount }} %<br/>
														Thành tiền: {{ this.TongTienDiscout }} đ
													</h7>
													<h7 v-else="">
														Thành tiền: {{ this.TongTien }} đ
													</h7>
												</td>
											</tr>
											<tr>
												<td>
													<button class="btn btn-lg btn-primary btn-block" style="background-color: gray;" v-on:click="ThanhToan = 0">Quay Lại</button>
												</td>
												<td v-if="option_payment == 'Cash'">
													<button class="btn btn-lg btn-primary btn-block" v-on:click="PaymentAll('Cash')">Thanh Toán</button>
												</td>
												<td v-else-if="user">
													<button class="btn btn-lg btn-primary btn-block" v-on:click="PaymentAll('User')">Thanh Toán</button>
												</td>
												<td v-else="">
													<button class="btn btn-lg btn-primary btn-block" v-on:click="PaymentAll('NotUser')">Thanh Toán</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
									
								<div class="row" v-if="NhapThongTin == 0 && ThanhToan == 0">
									<div class="col-md-2"></div>
									<div class="col-md-4" align="left">
										Số Lượng: {{ this.CountVe }} <br/>
										Ghế: <span v-for="ve in TongVe" :key="ve.id">{{ ve.Ghe }}</span>
									</div>
									<div class="col-md-3" align="right">
										Tổng cộng: {{ this.TongTien }} đ
									</div>
									<div class="col-md-2">
										<button class="btn btn-lg btn-primary btn-block" v-if="TongTien != 0" v-on:click="NhapThongTin = 1">Tiếp tục</button>
										<button class="btn btn-lg btn-primary btn-block" disabled="" style="background-color: gray;" v-else="">Tiếp tục</button>
									</div>
								</div>
								<div class="row" v-else-if="NhapThongTin == 1 && ThanhToan == 0">
									<div class="col-md-1"></div>
									<div class="col-md-2">
										<button class="btn btn-lg btn-primary btn-block" style="background-color: gray;" v-on:click="NhapThongTin = 0">Quay Lại</button>
									</div>
									<div class="col-md-3"></div>
									<div class="col-md-3" align="right">
										Tổng cộng: {{ this.TongTien }} đ
									</div>
									<div class="col-md-2">
										<button class="btn btn-lg btn-primary btn-block" v-on:click="ThanhToanBegin(user.id)" v-if="khachhang.name && khachhang.sdt && user && khachhang.EmailNhap">Tiếp tục</button>
										<button class="btn btn-lg btn-primary btn-block" v-on:click="ThanhToan = 1" v-else-if="khachhang.name && khachhang.sdt && khachhang.EmailNhap">Tiếp tục</button>
										<button class="btn btn-lg btn-primary btn-block" disabled="" style="background-color: gray;" v-else="">Tiếp tục</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="page-heading header-text" v-else="">
			<div class="section-center">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="booking-form">
								<div class="row">
									<div class="col-md-12">
										<h3 class="lable-h">Kết quả giao dịch</h3>
                                    </div>
									<hr width="500px"/>
									<div id="timer" class="col-md-12" v-if="CheckFinal == 0">
										<span>Sau {{ minutes }}:{{ seconds }} sẽ huỷ vé. Vui lòng không đóng cửa sổ này.</span>
									</div>
                                    <div class="col-md-12" v-if="CheckFinal == 0">
										<h5 v-if="this.option_payment == 'Cash'">
											Cảm ơn bạn đã đặt vé. Hãy xác nhận đặt vé để hoàn tất. <br/> ... <br/>
											<button class="btn btn-lg btn-primary" v-on:click="ThanhToanUser" v-if="user">Xác nhận đặt vé</button>
											<button class="btn btn-lg btn-primary" v-on:click="ThanhToanNotUser" v-else="">Xác nhận đặt vé</button>
										</h5>
										<h5 v-else="">
											{{ this.Mess }} <br/> ... <br/>
											<button class="btn btn-lg btn-primary" v-on:click="CheckPayment" v-if="this.Mess != 'Đơn hàng đã thanh toán thành công. Hãy xác nhận thanh toán để hoàn tất.'">Kiểm tra thanh toán</button>
											<button class="btn btn-lg btn-primary" v-on:click="ThanhToanUser" v-else-if="user">Xác nhận thanh toán</button>
											<button class="btn btn-lg btn-primary" v-on:click="ThanhToanNotUser" v-else="">Xác nhận thanh toán</button>
										</h5>
                                    </div>
									<div class="col-md-12" v-else="">
										<h5>
											Hoàn tất thủ tục. Thông tin chi tiết vé đã gửi qua gmail.
										</h5>
										<table style="background-color:white; color: black">
											<tr style="color:blue">
												<td style="text-align:center">CÔNG TY TNHH MỘT THÀNH VIÊN<br/> BẾN XE MIỀN ĐÔNG</td>
												<td colspan="2"></td>
											</tr>
											<tr style="color:blue">
												<td style="text-align:center">292 Đinh Bộ Lĩnh, P.26, Q.Bình Thạnh<br/>Điện thoại: 35116858 - Fax: 38992094<br/>Mã số thuế: 0301092597</td>
												<td style="text-align:center">Số vé 0{{ this.CountVe }}</td>
												<td></td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:center; color:red"><h4>PHIẾU ĐẶT CHỖ</h4></td>
											</tr>
											<tr>
												<td></td>
												<td v-if="this.option_payment == 'Cash'">(Chưa thanh toán)</td>
												<td v-else="">(Đã thanh toán)</td>
												<td>VX260002 0620201114</td>
											</tr>
											<tr>
												<td colspan="3">Đơn vị vân tải: {{ this.listChuyen.ChuXe }}</td>
											</tr>
											<tr>
												<td  v-if="user">
													Số Xe: {{ this.listChuyen.BienSo }} <br/>
													Loại Xe: {{ this.listChuyen.LoaiXe }} - {{ this.listChuyen.SoGhe }} Ghế<br/>
													Ngày Đi: {{ this.listChuyen.Ngay }} <br/>
													Giá Vé: {{ this.TongTienDiscount }} <br/>
													Địa Điểm Đi: {{ this.listChuyen.DiaDiem1 }}
												</td>
												<td  v-else="">
													Số Xe: {{ this.listChuyen.BienSo }} <br/>
													Loại Xe: {{ this.listChuyen.LoaiXe }} - {{ this.listChuyen.SoGhe }} Ghế<br/>
													Ngày Đi: {{ this.listChuyen.Ngay | formatDay }} <br/>
													Giá Vé: {{ this.TongTien }} <br/>
													Địa Điểm Đi: {{ this.listChuyen.DiaDiem1 }}
												</td>
												<td>
													Số Chỗ: {{ this.CountVe }} <br/> <br/>
													Giờ Đi: {{ this.listChuyen.Gio }} <br/> <br/>
													Địa Điểm Trả: {{ this.listChuyen.DiaDiem2 }}
												</td>
												<td></td>
											</tr>
											<tr>
												<td>(Bao gồm thuế GTVT và BHHK)</td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="3">
												+Thanh toán tối thiểu 90% tiền vé cho hành khách đã mua vé nhưng từ chối chuyến đi trước ki xe khởi hành ít nhất 02 giờ đối với tuyến cố định có cự ly từ 300km trở xuống và ít nhất 04 giờ đối với tuyến cố định có cự ly trên 300km.
												<br/>+Thanh toán tối thiểu 70% tiền vé cho hành khách đã mua vé nhưng từ chối chuyến đi trước khi xe khởi hành ít nhất 01 giờ đối với tuyến cố định có cự ly từ 300km trở xuống và ít nhất 02 giờ đối với tuyến cố định có cự ly trên 300km.
												</td>
											</tr>
										</table>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer-component></footer-component>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import axios from "axios"
import vue from "vue"
export default {
	name: "User-DatVe",
	data() {
    return {
		ve: {
			id: 0,
			Ghe: '',
			GiaVe: 0,
			paymenting: 0
		},
		khachhang:{
			name: '',
			sdt: '',
			EmailNhap: ''
		},
		ListLogin: null,
		NhapThongTin: 0,
		ThanhToan: 0,
		option_payment: 'Cash',
		bankcode: '',
		discount: 0,
		PaymentSuccess: 0,
		Mess: 'Đang chờ thanh toán, Loading...',
		CheckFinal: '',
		token: '',
		TongTien: 0,
		TongTienDiscount: 0,
		GiaVeDiscount: 0,
		TongVe: [],
		CountVe: 0,
		Listid: [],
		listChuyen: null,
		ListVes: null,
		success: null,
		error: null,
		timer: null,
		totalTime: (10 * 60),
		ispaymenting: 0
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"]),
		minutes: function() {
			return this.padTime(Math.floor(this.totalTime / 60))
		},
		seconds: function() {
			return this.padTime(this.totalTime - (this.minutes * 60))
		}
	},
	created() {
		this.getListChuyen()
		this.getListVes()
	},
	methods: {
		padTime: function(time) {
			return (time < 10 ? '0' : '') + time
		},
		countdown: function() {
			this.totalTime--
			if(this.totalTime < 0)
			{
				this.TongVe.forEach(ve => {
					axios.delete(process.env.VUE_APP_API_URL + 'nv_banve/' + ve.id)
				})
                this.$router.push('User-Payment-Fail')
			}
		},
		async CheckPayment(){
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'thanhtoan', {
					params: {
						token: this.token,
						buyer_mobile: this.khachhang.sdt,
						param1: this.listChuyen.DiaDiem1,
						param2: this.listChuyen.DiaDiem2,
						param4: this.listChuyen.Ngay

					}
				})
				this.Mess = response.data
			} catch (error) {
				this.error = error.response.data
			}
		},
		async PaymentAll(way) {
			const response = await axios.get(process.env.VUE_APP_API_URL + 'thanhtoan', {
				params: {
					ids: this.Listid
				}
			})
			this.ispaymenting = response.data
			if(response.data == "fail")
			{
				this.$router.push('User-Payment-Fail')
			}
			else
			{
				if(way == "User")
				{
					this.PaymentUser()
				}
				else if(way =="NotUser")
				{
					this.PaymentNotUser()
				}
				else
				{
					this.PaymentCash()
				}
			}
		},
		async PaymentCash(){
			try {
				this.PaymentSuccess = 1
				this.totalTime = (2 * 60)
				this.timer = setInterval(()=>this.countdown(), 1000)
			} catch (error) {
				this.error = error.response.data
			}
		},
		async PaymentUser(){
			try {
				const response = await axios.post(process.env.VUE_APP_API_URL + 'thanhtoan', {
					id_Chuyen: this.$route.query.id_Chuyen,
					buyer_fullname: this.khachhang.name,
					buyer_email: this.khachhang.EmailNhap,
					buyer_mobile: this.khachhang.sdt,
					total_amount: this.TongTienDiscout,
					option_payment: this.option_payment,
					bankcode: this.bankcode,
					param1: this.listChuyen.DiaDiem1,
					param2: this.listChuyen.DiaDiem2,
					param4: this.listChuyen.Ngay
				})
				this.token = response.data.token
				this.PaymentSuccess = 1
				this.timer = setInterval(()=>this.countdown(), 1000)
				window.open(response.data.checkout_url, '_blank')
			} catch (error) {
				this.error = error.response.data
			}
		},
		async PaymentNotUser(){
			try {
				const response = await axios.post(process.env.VUE_APP_API_URL + 'thanhtoan', {
					id_Chuyen: this.$route.query.id_Chuyen,
					buyer_fullname: this.khachhang.name,
					buyer_email: this.khachhang.EmailNhap,
					buyer_mobile: this.khachhang.sdt,
					total_amount: this.TongTien,
					option_payment: this.option_payment,
					bankcode: this.bankcode,
					param1: this.listChuyen.DiaDiem1,
					param2: this.listChuyen.DiaDiem2,
					param4: this.listChuyen.Ngay
				})
				this.token = response.data.token
				this.PaymentSuccess = 1
				this.timer = setInterval(()=>this.countdown(), 1000)
				window.open(response.data.checkout_url, '_blank')
			} catch (error) {
				this.error = error.response.data
			}
		},
		async ThanhToanBegin(id){
			try {
                const response = await axios.get(process.env.VUE_APP_API_URL + 'khachhang/' + id)
                this.ListLogin = response.data.data
            } catch (error) {
                this.error = error.response.data
            }
			this.discount = this.ListLogin.GiamGia
			this.TongTienDiscout = this.TongTien
			this.TongTienDiscout = this.TongTienDiscout - this.TongTienDiscout*this.discount/100
			this.GiaVeDiscount = this.listChuyen.GiaVe
			this.GiaVeDiscount = this.GiaVeDiscount - this.GiaVeDiscount*this.discount/100
			this.ThanhToan = 1
		},
		async ThanhToanUser(){
			try {
				this.TongVe.forEach(ve => {
						axios.put(process.env.VUE_APP_API_URL + 'nv_banve/' + ve.id, {
						TenKhachHang: this.khachhang.name,
						SDT: this.khachhang.sdt,
						email: this.ListLogin.email,
						EmailNhap: this.khachhang.EmailNhap,
						GiaVe: this.listChuyen.GiaVe,
						TienCoc: this.GiaVeDiscount,
						option_payment: this.option_payment,
						CountVe: this.CountVe
					})
				})
			} catch (error) {
				this.error = error.response.data
			}
			this.CheckFinal = 1
			this.totalTime = (100 * 60)
		},
		async ThanhToanNotUser(){
			try {
				this.TongVe.forEach(ve => {
					axios.put(process.env.VUE_APP_API_URL + 'nv_banve/' + ve.id, {
						TenKhachHang: this.khachhang.name,
						SDT: this.khachhang.sdt,
						EmailNhap: this.khachhang.EmailNhap,
						GiaVe: this.listChuyen.GiaVe,
						TienCoc: this.listChuyen.GiaVe,
						option_payment: this.option_payment,
						CountVe: this.CountVe
					})
				})
			} catch (error) {
				this.error = error.response.data
			}
			this.CheckFinal = 1
			this.totalTime = (100 * 60)
		},
		async Select(ve) {
			if(ve.isSelect)
			{
				this.UnSelect(ve)
			}
			else if(!ve.TenKhachHang && ve.paymenting == 0)
			{
				this.InSelect(ve)
			}
        },
		async InSelect(ve) {
			ve.isSelect = true
			this.TongTien += this.listChuyen.GiaVe
			this.TongVe.push(ve)
			this.Listid.push(ve.id)
			this.CountVe++
        },
		async UnSelect(ve) {
			ve.isSelect = false
			this.TongTien -= this.listChuyen.GiaVe
			this.TongVe.splice(this.TongVe.indexOf(ve), 1)
			this.Listid.splice(this.TongVe.indexOf(ve.id), 1)
			this.CountVe--
        },
		async getListChuyen() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'chuyenxe/' + this.$route.query.id_Chuyen)
				this.listChuyen = response.data.data
			} catch (error) {
				this.error = error.response.data
			}
        },
		async getListVes() {
			try {
				const response = await axios.get(process.env.VUE_APP_API_URL + 'nv_banve', {
					params: {
						id_Chuyen: this.$route.query.id_Chuyen
					}
				})
				this.ListVes = response.data
				this.ListVes.forEach(ve => {
					vue.set(ve, 'isSelect', false)
				})
			} catch (error) {
				this.error = error.response.data
			}
        }
	}
};
</script>
