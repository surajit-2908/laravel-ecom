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
       
      <div class = "main-panel">
      <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>

<div class="pagetitle">
        <h1>Category Management</h1>
        <form action="{{url('category/add')}}" method="POST">
@csrf
              <input type="text" name="category" placeholder="Write category name">

              <input type="submit" class="btn btn_primary" name="submit" value="Add category" >

            </form>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item">Category</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
      
     
    </div>

  <table class="table datatable" id="list-table-page">
                            <thead>
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $data2)
                                    <tr>
                                    <td>{{ $data2->name }}</td>
                                        <td>
                                            <a onclick="return confirm('Are you sure, you want to Delete this ?')"
                                                href="{{ route('category.delete', $data2->id) }}">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
</div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>