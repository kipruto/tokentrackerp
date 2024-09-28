@include('./base/start.html')


@include('./base/navbar.html')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('./base/sidebar.html')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('./ui/alert/head.html')
    @include('./ui/alert/alert_1.html')
    @include('./ui/alert/alert_2.html')
    @include('./ui/alert/alert_3.html')

  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 

  

@include('./base/end.html')
