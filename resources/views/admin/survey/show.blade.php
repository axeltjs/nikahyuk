@extends('admin.layouts.app')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Survey Calon Pengantin</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <span>Data Kebutuhan Calon Pengantin</span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>Identitas Calon Pengantin</p>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="13%">Nama</th>
                            <td>{{ $survey['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Email</th>
                            <td>{{ $survey['user']['email'] }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Telepon</th>
                            <td>{{ $survey['user']['phone'] }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Alamat</th>
                            <td>{{ $survey['user']['address'] }}</td>
                        </tr>
                    </table>
                    <p>Detail Acara</p>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="13%">Budget</th>
                            <td style="color:green">{{ "Rp. ".number_format($survey['budget']) }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Waktu Acara</th>
                            <td>{{ $survey['event_date_range'] }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Kota Acara</th>
                            <td> <span class="city_text"></span></td>
                        </tr>
                        <tr>
                            <th width="13%">Tema Acara</th>
                            <td>{{ $survey['theme'] }}</td>
                        </tr>
                        <tr>
                            <th width="13%">Kebutuhan Item Acara</th>
                            <td>
                                <ol>
                                    @foreach($survey['item_acara'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    </table>
                    @hasrole('Vendor')
                        <a href="{{ url('vendor/chat') }}" class="btn btn-primary" > <i class="fa fa-envelope"></i> Hubungi calon pengantin ini</a>
                    @endhasrole
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection

@section('js')
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
        $(document).ready(function(){
            let city = '{{ $survey["city_id"] }}';
            let province = '{{ $survey["province_id"] }}';

            getCityById(province, city);
        })
    </script>
@endsection