<h4 class="text-muted fs-16">Sumulasi Perhitungan Biaya Retribusi Izin Mendirikan Bangunan Non Gedung</h4>
{!! Form::open(['url'=>'publik/simulasi/non-gedung','class'=>'card form-type-combine','id'=>'form-simulasi-non-gedung']) !!}
    <div class="card-body">
        <h6 class="text-light fw-300">Data Banguna Non Gedung</h6>
        <div class="form-groups-attached">
            <div class="row">
                <div class="form-group col-12">
                    <label class="require">TOTAL BIAYA RENCANA ANGGARAN BIAYA (RAB)</label>
                    {!! Form::text('luas',null,['class'=>'form-control','required'=>'required']) !!}
                </div>
            </div>
            <div class="row">
                <div id="ajax-non-gedung"></div>
            </div>
        </div>
    </div>
    <footer class="card-footer text-left">
        <button type="submit" class="btn btn-primary">Hitung Retribusi</button>
    </footer>
{!! Form::close() !!}