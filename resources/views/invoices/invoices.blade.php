@extends('layouts.master')
@section('title')
    الفواتير
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row">

        {{-- start of adding button  --}}
        <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 btn-icon-list">
            <a href="invoices/create" class="modal-effect btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>&nbsp;
                اضافة فاتورة
            </a>
        </div>
        {{-- end of adding button  --}}

        {{-- start of onvoices table  --}}
        <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                    <th class="wd-20p border-bottom-0">تاريخ الإنشاء</th>
                                    <th class="wd-15p border-bottom-0">تاريخ الإستحقاقء</th>

                                    <th class="wd-25p border-bottom-0">القسم</th>
                                    <th class="wd-10p border-bottom-0">المنتج</th>
                                    <th class="wd-25p border-bottom-0">الخصم</th>
                                    <th class="wd-25p border-bottom-0">نسبة الضريبة</th>
                                    <th class="wd-25p border-bottom-0">قيمة الضريبة</th>
                                    <th class="wd-25p border-bottom-0">الإجمالى</th>
                                    <th class="wd-25p border-bottom-0">حالة الفاتورة</th>
                                    <th class="wd-25p border-bottom-0">ملاحظات</th>
                                    <th class="wd-25p border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($invoices as $invoices)
                                    @php
                                        $i++;
                                    @endphp

                                    <tr>
                                        <td>{{$invoices -> id}}</td>
                                        <td>{{$invoices -> invoice_number}}</td>
                                        <td>{{$invoices -> invoice_Date}}</td>
                                        <td>{{$invoices -> Due_date}}</td>

                                        {{-- <td>{{$invoices -> section -> section_name}}</td> --}}
                                        <td>
                                            <a
                                            href="{{ url('invoicesDetails') }}/{{ $invoices->id }}">
                                            {{ $invoices->section->section_name }}
                                            </a>
                                        </td>

                                        <td>
                                            {{-- {{$invoices -> products -> product_id}} --}}
                                        </td>
                                        <td>{{$invoices -> Discount}}</td>
                                        <td>{{$invoices -> Value_VAT}}</td>
                                        <td>{{$invoices -> Rate_VAT}}</td>
                                        <td>{{$invoices -> Total}}</td>
                                        {{-- <td>{{$invoices -> Status}}</td> --}}
                                        <td>
                                            @if ($invoices->Value_Status == 1)
                                                <span class="text-success">
                                                    {{ $invoices->Status }}
                                                </span>
                                            @elseif($invoices->Value_Status == 2)
                                                <span class="text-danger">{{ $invoices->Status }}</span>
                                            @else
                                                <span class="text-warning">{{ $invoices->Status }}</span>
                                            @endif

                                        </td>
                                        <td>{{$invoices -> Value_Status}}</td>
                                        <td>{{$invoices -> note}}</td>
                                        <td>{{$invoices -> Payment_Date}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    {{-- @can('تعديل الفاتورة') --}}
                                                        <a class="dropdown-item"
                                                            href=" {{ url('edit_invoice') }}/{{ $invoices->id }}">تعديل
                                                            الفاتورة</a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('حذف الفاتورة') --}}
                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $invoices->id }}"
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الفاتورة</a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('تغير حالة الدفع') --}}
                                                        <a class="dropdown-item"
                                                            href="{{ URL::route('showStatus', [$invoices->id]) }}">
                                                             <i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;
                                                                تغير حالة الفاتورة
                                                            </a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('طباعةالفاتورة') --}}
                                                    {{-- <a class="dropdown-item" href="Print_invoice/{{         $invoices->id }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            الفاتورة
                                                    </a> --}}

                                                    <a class="dropdown-item"
                                                        href="invoicePrint/{{
                                                            $invoices -> id
                                                        }}">
                                                        <i class="text-success fas fa-print"></i>&nbsp;&nbsp;
                                                        طباعة الفاتورة
                                                    </a>
                                                    {{-- @endcan --}}

                                                    @can('ارشفة الفاتورة')
                                                        <a class="dropdown-item" href="#" data-invoice_id="{{ $invoices->id }}"
                                                            data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                            الارشيف</a>
                                                    @endcan


                                                </div>
                                            </div>

                                        </td>
                                        {{-- <td>{{Auth::user()-> name}}</td> --}}

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- end of invoices table  --}}

        <!-- /row  closed-->
    </div>
    <!-- Container closed -->

    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
