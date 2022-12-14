@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@section('title')
UnPaid_Invoices
@endsection
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير الغير مدفوعة</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				@if(session()->has('success'))

    <div class="alert alert-success">

    <button type="button" class="close" data-dismiss="alert">x</button>

    {{session()->get('success')}}

    </div>

    @endif
				<div class="row">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
									<a href="{{url('/add_invoice_view')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
											class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
			
									{{-- <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export_invoices') }}"
										style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a> --}}
			
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">تاريخ الدفع</th>
												<th class="border-bottom-0">المستخدم</th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0 ?>
											@foreach($invoices as $invoice)
											<?php $i++ ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$invoice->invoice_number}}</td>
												<td>{{$invoice->invoice_date}}</td>
												<td>{{$invoice->due_date}}</td>
												<td>{{$invoice->product}}</td>
												<td><a href="{{url('/invoices_details' , $invoice->id)}}">{{$invoice->section->section_name}}</a></td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->vat_value}}</td>
												<td>{{$invoice->vat_rate}}</td>
												<td>{{$invoice->total}}</td>
												<td>
													@if ($invoice->status_value == 1)
														<span class="text-success">{{ $invoice->status }}</span>
													@elseif($invoice->status_value == 2)
														<span class="text-danger">{{ $invoice->status }}</span>
													@else
														<span class="text-warning">{{ $invoice->status }}</span>
													@endif
		
												</td>
												<td>{{$invoice->note}}</td>
												<td>{{$invoice->payment_date}}</td>
												<td>{{Auth::user()->name}}</td>
												<td>
													<a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-warning" href="{{route('SoftDelete' , $invoice->id)}}">SoftDelete</a>
												</td>
												<td>
													<a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{url('/delete_invoice' , $invoice->id)}}/{{$invoice->invoice_number}}">Delete</a>
												</td>
												<td>
													<a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-primary" href="{{url('/restore_invoice' , $invoice->id)}}">Restore</a>
												</td>
												<td>
													<a class="btn btn-dark" href="{{url('/change_payment_status_view' , $invoice->id)}}">Change Payment Stauts</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
		@endsection
		@section('js')
		<!-- Internal Data tables -->
		<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
		<!--Internal  Datatable js -->
		<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
		@endsection