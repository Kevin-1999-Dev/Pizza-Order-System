@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>

                            </div>
                        </div>

                            <h3 class="text-warning">Total -{{ $pizzas->total() }} </h3>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add pizza
                                </button>
                            </a>

                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3  text-white text-center pt-2">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span> </h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('product#list') }}" method="get" >
                                <div class="d-flex">
                                 <input type="text" name="key" class="form-control " placeholder="Search..." value="{{ request('key') }}">
                                 <button class="btn btn-danger" type="submit" >
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                 </button>
                                </div>
                             </form>
                        </div>
                    </div>
                 @if (count($pizzas)!=0)
                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                      <thead>
                          <tr>
                              <th class="text-center">Image</th>
                              <th class="text-center">Name</th>
                              <th class="text-center">Price</th>
                              <th class="text-center">Category</th>
                              <th class="text-center">View Count</th>
                          </tr>
                      </thead>
                      <tbody>

                      @foreach ($pizzas as $item )
                      <tr class="tr-shadow">
                          <td class="col-2 text-center"><img src="{{ asset('storage/'.$item->image) }}" alt="" ></td>
                          <td class="col-3 text-center">{{ $item->name }}</td>
                          <td class="col-2 text-center">{{ $item->price }}</td>
                          <td class="col-2 text-center">{{ $item->category_name }}</td>
                          <td class="col-2 text-center"> <i class="fa-solid fa-eye"></i> {{ $item->view_count }}</td>
                          <td>
                              <div class="table-data-feature">
                                  <a href="{{ route('product#edit',$item->id) }}">
                                      <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                          <i class="fa-solid fa-eye"></i>
                                      </button>
                                  </a>
                                 <a href="{{ route('product#updatePage',$item->id) }}">
                                  <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                      <i class="zmdi zmdi-edit"></i>
                                  </button>
                                 </a>
                                 <a href="{{ route('product#delete',$item->id) }}">
                                  <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                      <i class="zmdi zmdi-delete"></i>
                                  </button>
                                 </a>

                              </div>
                          </td>
                      </tr>
                      <tr class="spacer"></tr>
                      @endforeach
                      </tbody>
                       </table>
                      <div>
                      {{ $pizzas->links() }}
                      </div>
                  </div>
                 @else
                     <h3 class="text-center text-secondary mt-5">There is no Product Here...</h3>
                 @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

