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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>

                            <h3 class="text-warning">Total - {{ $categories->total() }}</h3>

                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add category
                                </button>
                            </a>

                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                            <i class="fa-solid fa-square-xmark"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-3  text-white text-center pt-2">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span> </h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('category#list') }}" method="get" >
                                <div class="d-flex">
                                 <input type="text" name="key" class="form-control " placeholder="Search..." value="{{ request('key') }}">
                                 <button class="btn btn-danger" type="submit" >
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                 </button>
                                </div>
                             </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                      @if ( count($categories) != 0)
                      <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category name</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($categories as $category )
                          <tr class="tr-shadow">
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                            <td>
                                <div class="table-data-feature">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                        <i class="zmdi zmdi-mail-send"></i>
                                    </button>
                                   <a href="{{ route('category#edit',$category->id) }}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="zmdi zmdi-edit"></i>
                                    </button>
                                   </a>
                                   <a href="{{ route('category#delete',$category->id) }}">
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
                      @else
                        <h1 class="text-secondary text-center mt-5">There is no Category Here</h1>
                      @endif
                        {{ $categories->appends(request()->query())->links() }}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
