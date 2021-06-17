<template>
	<div>
		<header-component></header-component>
		
		<div class="page-heading header-text">
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
                                    <div class="col-md-12">
										<h5>Thanh toán thất bại</h5>
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
import { mapGetters } from "vuex"
export default {
	name: "User-Payment-Success",
	data() {
    return {
		success: null,
		error: null
		};
	},
	computed: {
		...mapGetters(["errors"]),
		...mapGetters("auth", ["user"])
	}
};
</script>
