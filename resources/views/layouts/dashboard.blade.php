

@include('dashboard.components.navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

  @include('dashboard.components.sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">

    <!-- start numbers -->
    @include('dashboard.pages.numbers')
    <!-- end nmbers -->

    <!-- Sales Overview -->
    @include('dashboard.pages.projectoverview')
    <!-- end Sales Overview -->




  </div>
  <!-- end content -->

</div>
<!-- end wrapper -->


@include('dashboard.components.footer')

