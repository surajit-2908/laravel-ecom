<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  <style type="text/css"> 

    label
    {
        display: inline-block;
        width: 200px;
        font-size: 15px;
        font-weight: bold;
    }

   </style>
  </head>


  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.nav')
        <!-- partial -->
        <!-- main-panel ends -->

        <div class="main-panel">
            <div class="content-wrapper">

<h1 style="text-align: center; font-size: 25px;" >Send Email to {{$order->email}}<h1>

<form action="{{route('send_user_email', $order->id)}}" method="POST">

@csrf

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email Greeting :</label>
    <input type="text" name="greeting" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email Firstline :</label>
    <input type="text" name="firstline" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email Body :</label>
    <input type="text" name="body" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email Button :</label>
    <input type="text" name="button" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email URL :</label>
    <input type="text" name="url" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
    <label>Email Lastline :</label>
    <input type="text" name="lastline" >
  </div>

  <div style="padding-left: 25%; padding-top: 30px;">
   
    <input type="submit" value="Send Email" class="btn btn-primary">
  </div>

</div>
</div> 

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    @include('admin.footer')
  </body>
</html>