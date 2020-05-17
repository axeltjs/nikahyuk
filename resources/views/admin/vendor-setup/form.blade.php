<div class="x_content">
    <!-- Smart Wizard -->
    <div id="wizard" class="form_wizard wizard_horizontal">
        <ul class="wizard_steps">
            <li>
                <a href="#step-1">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                        Step 1<br />
                        <small>Detail Usaha</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="#step-2">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                        Step 2<br />
                        <small>Layanan Item Acara</small>
                    </span>
                </a>
            </li>
        </ul>
        {!! Form::open(['url' => route("vendor.setup.update"), 'method' => 'post', 'files' => 'true']) !!}
        {{ csrf_field() }}
        <div id="step-1">
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Nama Usaha 
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'id' => 'name']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Alamat Usaha 
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'required', 'id' => 'address']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Foto Tempat Usaha 
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        {!! Form::file('photo', ['class' => 'form-control']) !!}
                        @if(isset($has_company))
                            @if($has_company['photo'])
                                <a target="__blank" href="{{ url('storage/company/'.$has_company['photo']) }}" style="color:#3498db; margin-top:3px;">Lihat File</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Kartu Identitas (KTP) 
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        {!! Form::file('identity_card', ['class' => 'form-control']) !!}
                        @if(isset($has_company))
                            @if($has_company['identity_card'])
                                <a target="__blank" href="{{ url('storage/company/'.$has_company['identity_card']) }}" style="color:#3498db; margin-top:3px;">Lihat File</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Surat Izin Usaha 
                </label>
                <div class="col-md-6 col-sm-6 ">
                    <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                        {!! Form::file('business_permit', ['class' => 'form-control']) !!}
                        @if(isset($has_company))
                            @if($has_company['business_permit'])
                                <a target="__blank" href="{{ url('storage/company/'.$has_company['business_permit']) }}" style="color:#3498db; margin-top:3px;">Lihat File</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Range Harga
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6">
                    <div class="col-md-6 xdisplay_inputx form-group row has-feedback" style="margin-right: 5px">
                        {!! Form::number('budget_min', old('budget_min'), ['class' => 'has-feedback-left form-control angka', 'placeholder' => 'Dari harga', 'required', 'id' => 'budget_min']) !!}
                        <span class="fa fa-rupiah form-control-feedback left" aria-hidden="true">Rp.</span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                    </div>
                    <div class="col-md-6 xdisplay_inputx form-group row has-feedback">
                        {!! Form::number('budget_max', old('budget_max'), ['class' => 'has-feedback-left form-control angka', 'placeholder' => 'Sampai harga', 'required', 'id' => 'budget_max']) !!}
                        <span class="fa fa-rupiah form-control-feedback left" aria-hidden="true">Rp.</span>
                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Jangkauan Layanan 
                <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    @if($has_company)
                        {!! Form::select('province_id', [], old('province_id'), ['class' => 'form-control select2 provinsi', 'placeholder' => 'Klik Untuk Cari Provinsi Lain ...']) !!}
                    @else 
                        {!! Form::select('province_id', [], old('province_id'), ['class' => 'form-control select2 provinsi', 'placeholder' => 'Cari Provinsi ...']) !!}
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::select('city_id[]', [], old('city_id'), ['class' => 'form-control select2 city', 'multiple' => 'multiple']) !!}
                </div>
            </div>
        </div>
        <div id="step-2">
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tema Adat Tersedia</label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::select('theme[]', $tema, old('theme'), ['class' => 'form-control select2 theme', 'style' => 'width:100%', 'multiple' => 'multiple']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Item Acara</label>
                <div class="col-md-6 col-sm-6">
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('check_all', null, null, ['class' => 'flat select_all']) !!}
                            Pilih semua item acara
                        </label>
                    </div>
                </div>   
            </div>
            <div class="form-group row">
                 <label for="" class="col-form-label col-md-3 label-align">&nbsp;</label>
                <div class="col-md-6 col-sm-6">
                    @foreach($item_acara as $item)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('item_acara[]', $item, null, ['class' => 'flat pilihan_item_acara']) !!}
                            &nbsp;{{ $item }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>