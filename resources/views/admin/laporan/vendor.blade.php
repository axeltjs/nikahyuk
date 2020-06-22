
@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Laporan Vendor</h3>
    </div>
     <div class="title_right">
        <form action="{{ URL::current() }}" method="GET">
            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                <div class="input-group">
                {{-- <input type="text" class="form-control" placeholder="Search for..."> --}}
                {!! Form::text('q', Request::get('q'), ['placeholder' => 'Pencarian ...','class' => 'form-control']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-success" style="color:#fff">Go!</button>
                </span>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
<hr>
<br>
<div class="row">
    @if($vendors->isEmpty())
        <div class="alert alert-warning">Tidak ada data.</div>
    @else
    <div class="x_panel">
        <div class="x_content">
            <div class="col-md-12 col-sm-12">
                
                    @for($i = 0; $i < 2; $i++)
                        <div class="col-md-4 col-sm-4 profile_details" style="display: none;">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                <h4 class="brief"><i>Digital Strategist</i></h4>
                                <div class="left col-sm-7">
                                    <h2>Nicole Pearson</h2>
                                    <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                    <ul class="list-unstyled">
                                    <li><i class="fa fa-building"></i> Address: </li>
                                    <li><i class="fa fa-phone"></i> Phone #: </li>
                                    </ul>
                                </div>
                                <div class="right col-sm-5 text-center">
                                    <img src="" alt="" style="width: 100px; height:auto;" class="img-circle img-fluid">
                                </div>
                                </div>
                                <div class=" bottom text-center">
                                <div class=" col-sm-6 emphasis">
                                    <p class="ratings">
                                    <a>4.0</a>
                                    <a href="#"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star"></span></a>
                                    <a href="#"><span class="fa fa-star-o"></span></a>
                                    </p>
                                </div>
                                <div class=" col-sm-6 emphasis">
                                    <button type="button" class="btn btn-success btn-sm"> <i class="fa fa-identity-card">
                                    </i> <i class="fa fa-comments-o"></i> </button>
                                    <button type="button" class="btn btn-primary btn-sm">
                                    <i class="fa fa-identity-card"> </i> View Profile
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @foreach($vendors as $vendor)
                        <div class="col-md-4 col-sm-4 profile_details">
                            <div class="well profile_view" style="width:400px; min-height:220px; height:auto;">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i>{!! $vendor->company->name ?? '<span style="color:red;">Belum mengatur usaha</span>' !!}</i></h4>
                                <div class="left col-sm-7">
                                    <h2>{{ $vendor->name }}</h2>
                                    <ul class="list-unstyled">
                                    <li><i class="fa fa-building"></i> Alamat: {{ $vendor->address }}</li>
                                    <li><i class="fa fa-phone"></i> Telepon: {{ $vendor->phone }}</li>
                                    <li><i class="fa fa-phone"></i> Email: {{ $vendor->email }}</li>
                                    </ul>
                                </div>
                                <div class="right col-sm-5 text-center">
                                    <img src="{{ $vendor->photo_format_url }}" alt="" style="width: 100px; height:100px;" class="img-circle img-fluid">
                                </div>
                                </div>
                                <div class=" bottom text-center">
                                <div class=" col-sm-6 emphasis">
                                    <button type="button" data-toggle="modal" data-target="#vendorModal{{ $vendor->id }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"> </i> Lihat Riwayat
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="vendorModal{{ $vendor->id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    @if($vendor->transactionVendor->count())
                                        @foreach($vendor->transactionVendor as $transaksi)
                                        <h4>Transaksi: {{ $transaksi->number }}</h4>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Customer</th>
                                                <th>Nilai Transaksi</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Status</th>
                                            </tr>
                                                <tr>
                                                    <td>{{ $transaksi->customer->name }}</td>
                                                    <td>{{ $transaksi->amount_format }}</td>
                                                    <td>{{ $transaksi->payment_method_format }}</td>
                                                    <td>{!! $transaksi->status_format_html !!}</td>
                                                </tr>
                                            </table>
                                            @if($transaksi->invoice->count())
                                                <table class="table table-striped">
                                                    <tr class="success">
                                                        <th>Nomor Invoice</th>
                                                        <th>Jumlah</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    @foreach($transaksi->invoice as $invoice)
                                                        <tr>
                                                            <td>{{ $invoice->number }}</td>
                                                            <td>{{ $invoice->amount_format }}</td>
                                                            <td>{{ $invoice->jatuh_tempo_format }}</td>
                                                            <td>{!! $invoice->status_format !!}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                            @endforeach
                                        @else 
                                            <div class="alert alert-warning">Tidak ada transaksi</div>
                                        @endif
                                </div>
                                <div class="modal-footer">
                                    <a target="__blank" href="{{ url('admin/laporan/vendor/cetak/'.$vendor->id) }}" class="btn btn-success">Cetak</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </div>
    {{ $vendors->appends(Request::only('q'))->links() }}
    @endif
</div>



@endsection