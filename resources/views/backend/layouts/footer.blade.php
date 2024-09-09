

                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer">
                            <p>2024 © Admin Board. - <a href="#">halilakarsu.com</a></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- jquery vendor -->
<script src="/backend/assets/js/lib/jquery.min.js"></script>
<script src="/backend/assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="/backend/assets/js/lib/menubar/sidebar.js"></script>
<script src="/backend/assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->

<script src="/backend/assets/js/lib/bootstrap.min.js"></script>
<script src="/backend/assets/js/scripts.js"></script>
<!-- bootstrap -->

<script src="/backend/assets/js/lib/calendar-2/moment.latest.min.js"></script>
<script src="/backend/assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
<script src="/backend/assets/js/lib/calendar-2/pignose.init.js"></script>
<script src="/backend/assets/js/lib/toastr/toastr.min.js"></script><!-- script min-->
<script src="/backend/assets/js/lib/toastr/toastr.init.js"></script><!-- script init-->

<script src="/backend/assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
<script src="/backend/assets/js/lib/weather/weather-init.js"></script>
<script src="/backend/assets/js/lib/circle-progress/circle-progress.min.js"></script>
<script src="/backend/assets/js/lib/circle-progress/circle-progress-init.js"></script>
<script src="/backend/assets/js/lib/chartist/chartist.min.js"></script>
<script src="/backend/assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
<scrispt src="/backend/assets/js/lib/sparklinechart/sparkline.init.js"></scrispt>
<script src="/backend/assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="/backend/assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
<!-- scripit init-->
<script src="/backend/assets/js/dashboard2.js"></script>
              @if(session()->has('success'));
                  <script>alertify.success('{{session('success')}}');
                      $('#toastr-success-top-right').click(function() {
                          toastr.success('This Is Success Message','Top Right',{
                              timeOut: 5000,
                              "closeButton": true,
                              "debug": false,
                              "newestOnTop": true,
                              "progressBar": true,
                              "positionClass": "toast-top-right",
                              "preventDuplicates": true,
                              "onclick": null,
                              "showDuration": "300",
                              "hideDuration": "1000",
                              "extendedTimeOut": "1000",
                              "showEasing": "swing",
                              "hideEasing": "linear",
                              "showMethod": "fadeIn",
                              "hideMethod": "fadeOut",
                              "tapToDismiss": false
                          })
                      });


                  </script>
               @endif

</body>

</html>
