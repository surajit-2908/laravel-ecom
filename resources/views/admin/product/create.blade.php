<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
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
  
        <main id="main" class="main">

<div class="pagetitle"  style = " 
margin-top: 70px;">
  <h1>Product Management</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Admin</a></li>
      <li class="breadcrumb-item active">Product Management</li>
    </ol>
  </nav>

  <form action="{{ route('product.add') }}" method="post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
                            <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Product Title</label>
                                <span class="text-danger">*</span>
                            </div>
                            <input type="text" class="form-control" name="title" value="" required>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                        </div>

                        <div class="form-group">
                            <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Description</label>

                            </div>
                            <textarea id="description"  name="description"  placeholder="description"  class="form-control" > </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                        </div>

                        <div class="form-group" style = "margin-top : 7px">
                            <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Image</label>
                                <span class="text-danger"> Image Size must be less than 2 MB</span>
                            </div>
                            <input type="file" class="form-control" name="image" accept="image/*" >
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                        </div>

                        <div class="form-group" style = "margin-top : 7px">
                            <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Product Category</label>
                                <span class="text-danger">*</span>
                            </div>
                            <select name="category_id" id="" class="form-control">
                            @foreach ($data as $category)
<option value="{{$category->id}}" >{{$category->name}}</option>
@endforeach
</select>


                        </div>

                        <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Price</label>

                            </div>
                            <input type="number" class="form-control" name="price" value="" >
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                        </div>

                        <div class="form-group" style = "margin-top : 7px">
                            <div style = "    margin-left: 4px;
margin-bottom: 2px;">
                                <label>Status</label>
                                <span class="text-danger">*</span>
                            </div>
                            <input type="radio"  name="status" value="0">
                              <label for="html">In-Active</label>
                              <input type="radio"  name="status" value="1">
                              <label for="active">Active</label>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>

                        </div>
<div style = "    display: flex;
justify-content: center;
margin-top: 14px;">
                        <button type="submit" value = "submit" style = "border: 0px;
padding: 10px;
width: 120px;
border-radius: 5px;
background-color: navy;
color: white;" >
             Submit
            </button>
</div>
</div>
</form>

</div><!-- End Page Title -->



<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

    </div>

    </div><!-- End Right side columns -->

  </div>
</section>

</main>
  
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