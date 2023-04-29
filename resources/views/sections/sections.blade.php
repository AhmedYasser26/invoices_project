@extends('layouts.master')

@section('title')
    الأقسام
@endsection

@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
        {{-- main content --}}
        <div>
            {{-- Container --}}
            <div>
				<!-- row -->
				<div class="row">



                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">إضافة قسم</a>
                    </div>

                    {{-- start of adding msg  --}}
                    @if (session()->has('Add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif
                    {{-- end of adding msg  --}}

                    <div class="col-xl-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">
                                                    رقم القسم
                                                </th>

                                                <th class="wd-15p border-bottom-0">
                                                    إسم القسم
                                                </th>

                                                <th class="wd-20p border-bottom-0">
                                                    الوصف
                                                </th>

                                                <th class="wd-15p border-bottom-0">
                                                    العمليات
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($section_data as $data)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$data -> section_name}}</td>
                                                    <td>{{$data -> description}}</td>
                                                    <td>

                                                        <button class="modal-effect btn btn-primary" data-effect="effect-slide-in-right" data-toggle="modal"
                                                        data-id="{{$data -> id}}"
                                                        data-section_name="{{$data -> section_name}}"
                                                        data-description="{{$data -> description}}"
                                                        href="#modaldemo9" title="تعديل">
                                                            <i class="las la-pen"></i>
                                                        </button>


                                                        <button class="modal-effect btn btn-danger" data-effect="effect-slide-in-right" data-toggle="modal"
                                                        data-id="{{$data -> id}}"
                                                        data-section_name="{{$data -> section_name}}"
                                                        data-description="{{$data -> description}}"
                                                        href="#modaldemo10" title="حذف">
                                                            <i class="las la-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- start adding section --}}
                    <div class="modal" id="modaldemo8">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">إضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>

                                    <form action="{{route('sections.store')}}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label>اضف قسم</label>
                                                <input type="text" name="section_name" value="">
                                            </div>

                                            <div class="form-group">
                                                <label>اضف وصف</label>
                                                <input type="text" name="description" value="">
                                            </div>

                                        </div>
                                        <div class="modal-footer">

                                            <button class="btn ripple btn-primary" type="submit">
                                                تسجيل
                                            </button>

                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">
                                                إغلاق
                                            </button>

                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                    {{-- end of adding section --}}

                    {{-- start of edit section --}}
                    <div
                        class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {{-- start of model header  --}}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{-- end of model header  --}}
                                {{-- start of model body  --}}
                                <form action="sections/update"
                                    method="POST" autocomplete="off">
                                    {{ method_field('patch') }}
                                    {{ csrf_field() }}
                                    {{-- @csrf --}}
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="">

                                            <label for="recipient-name" class="col-form-label">تعديل إسم القسم</label>
                                            <input class="form-control" name="section_name" id="section_name" type="text" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">تعديل الوصف</label>

                                            <textarea class="form-control" id="description" name="description"></textarea>


                                        </div>
                                    </div>
                                    {{-- end of model body  --}}
                                    {{-- start of model footer  --}}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            تاكيد
                                        </button>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            اغلاق
                                        </button>
                                    </div>
                                    {{-- end of model footer  --}}
                               </form>
                            </div>
                        </div>

                    </div>
                    {{-- end of edit section --}}

                    {{-- start of delete section  --}}
                    <div
                        class="modal fade" id="modaldemo10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                {{-- start of model header  --}}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        حذف القسم
                                    </h5>
                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{-- end of model header  --}}
                                {{-- start of model body  --}}
                                <form action="sections/destroy"
                                    method="POST" autocomplete="off">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    {{-- @csrf --}}
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <input type="hidden" name="id" id="id" value="">

                                            <label for="recipient-name" class="col-form-label">
                                                هل أنت متأكد من حذف القسم ؟
                                            </label>
                                            <input class="form-control" name="section_name" id="section_name" type="text" value="" readonly>
                                        </div>

                                    </div>
                                    {{-- end of model body  --}}
                                    {{-- start of model footer  --}}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            حذف
                                        </button>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                            إنهاء
                                        </button>
                                    </div>
                                    {{-- end of model footer  --}}
                               </form>
                            </div>
                        </div>

                    </div>


                    {{-- <div class="modal" id="modaldemo10">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                        type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="sections/destroy" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div> --}}
                    {{-- end of delete section  --}}
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script>
    $('#modaldemo9').on('show.bs.modal', function(event)
    {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })
</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event)
    {
        var button = $(event.relatedTarget)
        var pro_id = button.data('pro_id')
        var section_name = button.data('section_name')

        var modal = $(this)
        modal.find('.modal-body #pro_id').val(pro_id);
        modal.find('.modal-body #section_name').val(section_name);
    })
</script>

@endsection
