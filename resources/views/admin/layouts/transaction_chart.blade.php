      <div class="x_panel">
        <div class="x_title">
          <h2>Grafik Transaksi <small>Bulanan</small></h2>
          <div class="filter">
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="x_content row">
          <div class="col-10">
            <div id="area-chart" style="width:100%; height:300px;"></div>
          </div>
          <div class="col-2">
            <h2>Metode Pembayaran</h2>
            @foreach($paymentMethod as $name => $val)
            <div class="widget_summary">
              <div class="w_left w_25">
                <span>{{ $name }}</span>
              </div>
              <div class="w_center w_55">
                <div class="progress">
                  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{ $val }}" aria-valuemin="0" aria-valuemax="10" style="width: {{ $val }}%;">
                    <span class="sr-only">Total: {{ $val }}</span>
                  </div>
                </div>
              </div>
              <div class="w_right w_20">
                <span>{{ $val }}</span>
              </div>
            </div>
            @endforeach
            
          </div>
        </div>
      </div>