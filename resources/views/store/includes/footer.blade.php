@if(Route::current()->getName() !== 'login' && Route::current()->getName() !== 'register' && explode(".", Route::current()->getName())[0] !== 'password')

    <div class="lime-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="footer-text">2021 © Calabouço do Android</span>
            </div>
        </div>
    </div>
</div>
@endif


<!-- Javascripts -->
<script src="../lime/assets/assets/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="../lime/assets/assets/plugins/bootstrap/popper.min.js"></script>
<script src="../lime/assets/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../lime/assets/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../lime/assets/assets/plugins/chartjs/chart.min.js"></script>
<script src="../lime/assets/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="../lime/assets/assets/plugins/toastr/toastr.min.js"></script>
<script src="../lime/assets/assets/js/lime.min.js"></script>
<script src="../lime/assets/assets/js/pages/dashboard.js"></script>
<script src="../js/masks.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script src="../lime/assets/assets/plugins/elevatezoom/jquery.elevatezoom-3.0.8.min.js"></script>
<script src="../lime/assets/assets/js/pages/image_zoom.js"></script>
</body>
</html>

@yield('limefooter')

