@if(pengumumnan())
<div class="runtext-container">
    <div class="row bg-primary">
        <div class="col-lg-1 icon text-center hidden-sm-down bg-warning">
            <i class="ti-info"></i>
        </div>
        <div class="col-lg-11 col-md-12">
            <div class="main-runtext">
                <marquee direction="" onmouseover="this.stop();" onmouseout="this.start();">
                    <div class="holder">
                        <div class="text-container text-white"><strong>{!! pengumumnan(false) !!}</strong></div>
                    </div>
                </marquee>
            </div>
        </div>
    </div>
</div>
@endif