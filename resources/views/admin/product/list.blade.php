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
        <h1>Product Management</h1>
      
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
      
     
    </div>
    <a href="{{ route('product.create') }}" class="nav-link">Add New</a>

  <table class="table datatable" id="list-table-page">
                            <thead>
                                <tr>

                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $product)
                                    <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                    @if ($product->image != '')
                                                <img src="{{ asset('/uploads/product/' . $product->image) }}"
                                                    alt="" width="50px" height="50px">
                                            @endif
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    @if ($product->status == 1)
                                            <td><a href="#">Active</a></td>
                                        @else
                                            <td><a href="#">InActive</a></td>
                                        @endif
                                        <td><a href="{{ route('product.edit', $product->id) }}">Edit</a> |
                                            <a onclick="return confirm('Are you sure, you want to Delete this ?')"
                                                href="{{ route('product.delete', $product->id) }}">Delete</a>
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
    @include('admin.footer')
  </body>
</html>