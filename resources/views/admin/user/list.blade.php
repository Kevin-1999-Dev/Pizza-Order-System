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
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>

                            <h3 class="text-warning">Total -{{ $users->total() }} </h3>
                    </div>





                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" >
                      <thead>
                          <tr>
                              <th class="text-center">Image</th>
                              <th class="text-center">Name</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Phone</th>
                              <th class="text-center">Address</th>
                              <th class="text-center">Role</th>
                          </tr>
                      </thead>
                      <tbody id="dataList">
                        @foreach ($users as $user)
                        <tr class="tr-shadow" >
                            <td class="col-2 ">
                                @if ($user->image == null)
                                @if ($user->gender == 'male')
                                    <img src="{{ asset('image/user.png') }}" alt="">
                                @else
                                    <img src="{{ asset('image/female.png') }}" alt="">
                                @endif
                            @else
                            <img src="{{ asset('storage/' . $user->image) }}" alt="">
                            @endif
                            </td>
                            <input type="hidden" id="userId" value="{{ $user->id }}">
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->phone }}</td>
                            <td class="text-center">{{ $user->address }}</td>
                            <td class="text-center">
                                <select name="role" class="form-control statusChange">
                                    <option value="user" >User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </td>
                          </tr>
                        @endforeach

                      <tr class="spacer"></tr>

                      </tbody>
                       </table>
                      <div>
                      {{ $users->links() }}
                      </div>
                  </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){
                $current = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();
                $data = {
                    'userId' : $userId,
                    'role' : $current,
                }
                $.ajax({
                    type : 'get',
                    url : '/user/change/role',
                    data : $data,
                    dataType : 'json',
                })
                location.reload();
            })
        })
    </script>
@endsection

