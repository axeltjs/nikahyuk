<div class="x_content">
    <!-- Smart Wizard -->
    <div id="wizard" class="form_wizard wizard_horizontal">
        <ul class="wizard_steps">
            <li>
                <a href="#step-1">
                    <span class="step_no">1</span>
                    <span class="step_descr">
                        Step 1<br />
                        <small>Detail Acara</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="#step-2">
                    <span class="step_no">2</span>
                    <span class="step_descr">
                        Step 2<br />
                        <small>Item Acara</small>
                    </span>
                </a>
            </li>
        </ul>
        {!! Form::open(['url' => '/asd/asd', 'method' => 'post']) !!}
        <div id="step-1">
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="budget">Budget 
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                            {!! Form::number('budget', old('budget'), ['class' => 'has-feedback-left form-control', 'required', 'id' => 'budget']) !!}
                            <span class="fa fa-rupiah form-control-feedback left" aria-hidden="true">Rp.</span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="invitation-qty">Jumlah undangan 
                    <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                            {!! Form::number('invitation_qty', old('invitation_qty'), ['class' => 'has-feedback-right form-control', 'required', 'id' => 'invitation_qty']) !!}
                            <span class="form-control-feedback right" aria-hidden="true" style="width:50px;">Orang</span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Waktu Acara <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <fieldset>
                            <div class="control-group ">
                              <div class="controls">
                                <div class="input-prepend input-group">
                                  <span class="add-on input-group-addon"><i class="fa fa-calendar" style="margin-top:5px"></i></span>
                                  {!! Form::text('event_date', old('event_date'), ['id' => 'event_date', 'class' => 'form-control adjust']) !!}
                                </div>
                              </div>
                            </div>
                          </fieldset>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Tempat acara 
                    <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        {!! Form::select('provinsi', [], old('provinsi'), ['class' => 'form-control select2 provinsi', 'placeholder' => 'Cari Provinsi ...']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                    <div class="col-md-6 col-sm-6 ">
                        {!! Form::select('city', [], old('city'), ['class' => 'form-control select2 city', 'placeholder' => 'Cari Kota ...']) !!}
                    </div>
                </div>
        </div>
        <div id="step-2">
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tema Acara</label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::select('theme', $tema, old('theme'), ['class' => 'form-control select2 theme', 'style' => 'width:100%', 'placeholder' => 'Pilih Tema Acara ...']) !!}
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