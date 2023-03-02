@extends('layouts.layout')
@section('content')
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                 Widget settings form goes here
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
<!-- BEGIN STYLE CUSTOMIZER -->
<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler">
        <i class="fa fa-gear"></i>
    </div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span>
            Theme Color </span>
            <ul>
                <li class="color-black current color-default tooltips" data-style="default" data-original-title="Default">
                </li>
                <li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
                </li>
                <li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
                </li>
                <li class="color-red tooltips" data-style="red" data-original-title="Red">
                </li>
                <li class="color-light tooltips" data-style="light" data-original-title="Light">
                </li>
            </ul>
        </div>
        <div class="theme-option">
            <span>
            Layout </span>
            <select class="layout-option form-control input-small">
                <option value="fluid" selected="selected">Fluid</option>
                <option value="boxed">Boxed</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
            Header </span>
            <select class="header-option form-control input-small">
                <option value="fixed" selected="selected">Fixed</option>
                <option value="default">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
            Sidebar </span>
            <select class="sidebar-option form-control input-small">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
            Sidebar Position </span>
            <select class="sidebar-pos-option form-control input-small">
                <option value="left" selected="selected">Left</option>
                <option value="right">Right</option>
            </select>
        </div>
        <div class="theme-option">
            <span>
            Footer </span>
            <select class="footer-option form-control input-small">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
    </div>
</div>
<!-- END BEGIN STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<h3 class="page-title">
Dashboard <small>statistics and more</small>
</h3>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
        @can('create')
        <a href="#" class="btn btn-sm btn-primary">CREATE</a>
        @endcan
        @can('view')
        <a href="#" class="btn btn-sm btn-primary">VIEW</a>
        @endcan
        @can('edit')
        <a href="#" class="btn btn-sm btn-primary">EDIT</a>
        @endcan
        @can('delete')
        <a href="#" class="btn btn-sm btn-primary">DELETE</a>
        @endcan
        @can('publish')
        <a href="#" class="btn btn-sm btn-primary">PUBLISH</a>
        @endcan
        @can('unpublish')
        <a href="#" class="btn btn-sm btn-primary">UNPUBLISH</a>
        @endcan
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<div class="row">
    {{-- <div class="col-md-6 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart"></i>Site Visits
                </div>
                <div class="actions">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn-sm active">
                        <input type="radio" name="options" class="toggle">New </label>
                        <label class="btn btn-default btn-sm">
                        <input type="radio" name="options" class="toggle">Returning </label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div id="site_statistics_loading">
                    <img src="assets/img/loading.gif" alt="loading"/>
                </div>
                <div id="site_statistics_content" class="display-none">
                    <div id="site_statistics" class="chart">
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div> --}}
    <div class="col-md-6 col-sm-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bell"></i>Notifications
                </div>
                <div class="tools">
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <!--BEGIN TABS-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_1_1" data-toggle="tab">System</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                        <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible="0">
                            <ul class="feeds">
                                @php
                                    $notifications = notifications();
                                @endphp
                                @forelse($notifications as $notification)
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success">
                                                    <i class="fa fa-bell"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    [{{ $notification->created_at }}] User {{ $notification->data['judul_pemberitahuan'] }} ({{ $notification->data['judul_pemberitahuan'] }}) has just registered. <span class="label label-sm label-default">
                                                        <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                                            Mark as read
                                                        </a> <i class="fa fa-share-alt"></i>
                                                    </span>
                                                    @if($loop->last)
                                                        <a href="#" id="mark-all">
                                                            Mark all as read
                                                        </a>
                                                    @endif
                                                    @empty
                                                        There are no new notifications
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            Just now
                                        </div>
                                    </div>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
    </div>
</div>
<div class="clearfix">
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
<script>
jQuery(document).ready(function() {
	//plugin datatable

});
</script>

<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('markNotification') }}", {
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
</script>
@stop
