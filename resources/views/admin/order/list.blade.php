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
        <h1>Order Management</h1>
      
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item">Order</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
      
     
    </div>
 
<div style="display: flex;
  flex-wrap: no-wrap;
  overflow-x: auto;
  margin: 20px;">
    <table class="table datatable" id="list-table-page" >
                            <thead>
                                <tr class="th_deg">
                                <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Delivered</th>
                                    <th scope="col">Print PDF</th>
                                    <th scope="col">Send Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $order)
                                    <tr>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->product_title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->payment_status }}</td>
                                    <td>{{ $order->delivery_status }}</td>
                                   <td> @if ($order->image != '')
                                                <img src="{{ asset('/uploads/product/' . $order->image) }}"
                                                    alt="" width="150px" height="100px">
                                            @endif </td>
                                            <td>
                                                @if($order->delivery_status=='Processing')
                                                <a href="{{route('delivered', $order->id)}}" onclick="return confirm('Are you sure this order is delivered !!!')"
                                                 class="btn btn-primary">Delivered</a>
                                            @else
                                            <p style="color: green; ">Delivered</p>  
                                                @endif
                                            </td>
                                            <td> 
                                                <a href="{{route('print_pdf', $order->id)}}" class="btn btn-secondary"> Print PDF</a>
                                            </td>
                                            <td> 
                                                <a href="{{route('send_email', $order->id)}}" class="btn btn-info"> Send Email</a>
                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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