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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>

                        <h3 class="text-warning">Total -{{ $admin->total() }} </h3>

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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3  text-white text-center pt-2">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span> </h4>
                        </div>
                        <div class="col-4 offset-5">
                            <form action="{{ route('admin#list') }}" method="get">
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control " placeholder="Search..."
                                        value="{{ request('key') }}">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>

                         @foreach ($admin as $a)
                         <tbody>
                             <tr class="tr-shadow">
                                 <td class="col-2 text-center">
                                     @if ($a->image == null)
                                         @if ($a->gender == 'male')
                                             <img src="{{ asset('image/user.png') }}" alt="">
                                         @else
                                             <img src="{{ asset('image/female.png') }}" alt="">
                                         @endif
                                     @else
                                     <img src="{{ asset('storage/' . $a->image) }}" alt="">
                                     @endif
                                 </td>
                                 <td class="col-2 text-center">{{ $a->name }}</td>
                                 <td class="col-2 text-center">{{ $a->email }}</td>
                                 <td class="col-2 text-center">{{ $a->phone }}</td>
                                 <td class="col-2 text-center">{{ $a->gender }}</td>
                                 <td class="col-2 text-center">{{ $a->address }}</td>
                                 <td class="col-2 text-center">
                                     <div class="table-data-feature">

                                       @if (Auth::user()->id == $a->id)

                                       @else
                                       <a href="{{ route('admin#changeRole',$a->id) }}">
                                         <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Change Admin List">
                                             <i class="fa-solid fa-person-circle-question"></i>
                                         </button>
                                        </a>
                                        <a href="{{ route('admin#delete',$a->id) }}">
                                         <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                             <i class="zmdi zmdi-delete"></i>
                                         </button>
                                        </a>
                                       @endif

                                     </div>
                                 </td>
                             </tr>
                             <tr class="spacer"></tr>


                         </tbody>
                     @endforeach



                        </table>

                        {{ $admin->appends(request()->query())->links() }}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
