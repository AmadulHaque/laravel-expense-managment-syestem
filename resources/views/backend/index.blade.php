@extends('backend.master')
@section('content')
	@php
	$setting =DB::table('settings')->first();
	@endphp



    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
		<!-- this top card four data start -->
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="text-primary indexTopCard font-35">
							<i class="fa-brands fa-shopify root-cc"></i>
						</div>
						<div>
							<p class="mb-0 text-secondary">Total Purchase</p>
							<h4 class="my-1">{{$setting->currency}} <span class="count">{{$pur_total_amount}}</span> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="text-primary indexTopCard font-35">
							<i class="fa-solid fa-money-bill-1 fa-xs root-cg" style="color: #45a516;"></i>
						</div>
						<div>
							<p class="mb-0 text-secondary">Today Purchase</p>
							<h4 class="my-1">{{$setting->currency}} <span class="count">{{$pur_today_amount}}</span></h4>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="text-primary indexTopCard font-35">
							<i class="fa-solid fa-money-check-dollar fa-sm root-cc"></i>
						</div>
						<div>
							<p class="mb-0 text-secondary">Total Expense</p>
							<h4 class="my-1">{{$setting->currency}} <span class="count"> {{$exp_total_amount}} </span></h4>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div class="text-primary indexTopCard font-35">
							<i class="fa-brands fa-product-hunt fa-sm root-cg"></i>
						</div>
						<div>
							<p class="mb-0 text-secondary">Today Expense</p>
							<h4 class="my-1"> <span class="count">{{$exp_today_amount}}</span></h4>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!-- this top card four data end -->
		<!-- this Bottom card four data start -->


		<div class="col">
			<div class="card radius-10 bg-gradient-deepblue">
			 <div class="card-body">
				<div class="d-flex align-items-center">
					<h5 class="mb-0 text-white">{{$users}}</h5>
					<div class="ms-auto">
                      <i class="fa-solid fa-user-group fs-3 text-white"></i>
					</div>
				</div>
				<div class="d-flex align-items-center text-white">
					<p class="mb-0">Total Users</p>
				</div>
			</div>
		  </div>
		</div>

		<div class="col">
			<div class="card radius-10 bg-gradient-ohhappiness">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$inc_total_amount}}</h5>
						<div class="ms-auto">
	                        <i class="fa-solid fa-file-lines fs-3 text-white"></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Total Income</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card radius-10 bg-gradient-ohhappiness">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<h5 class="mb-0 text-white">{{$inc_today_amount}}</h5>
						<div class="ms-auto">
	                       <i class="fa-regular fa-file fs-3 text-white"></i>
						</div>
					</div>
					<div class="d-flex align-items-center text-white">
						<p class="mb-0">Today Income</p>
					</div>
				</div>
			</div>
		</div>
		<!-- this Bottom card four data end -->
	</div>
	<!--end row-->



@endsection()
@push('js')
<script type="text/javascript">
	$(function() {

        $('.count').each(function () {
		    $(this).prop('Counter',0).animate({
		        Counter: $(this).text()
		    }, {
		        duration: 2000,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(Math.ceil(now));
		        }
		    });
		});

	});
</script>

@endpush()
