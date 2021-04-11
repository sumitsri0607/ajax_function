@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="mt-4">
    <a href="#" class="text-center" id="new_record_btn"> Add New</a><br>
    <a href="#" class="text-center" id="bulk_delete"> Bulk Delete</a>
        <table class="table text-center" id="staff_table">
            <thead class="dark-color">
                <tr>
                    <th>Sr. No</th>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Contact no</th>
                    <th>Hobby</th>
                    <th>Category</th>
                    <th>Profile pic</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody class="table table-bordered">
                @if(count($staffdetails)>0)
                    @foreach( $staffdetails as $staff)
                        <tr id="staff_id{{$staff->id}}">
                            <td>{{$no++ }}</td>
                            <td><input type="checkbox" name="ids" class="selectall" value="{{$staff->id}}"></td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->contact_no }}</td>
                            <td>
                                    <!-- {{$staff->hobby}} -->
                                    @foreach ( $staff->hobby as $hob )
                                        {{ $hob->name.', ' }}
                                    @endforeach
                            </td>
                            <td>{{ $staff->category->name}}</td>
                            <td><img src="{{ asset('storage/profile_pic/' . $staff->profile_pic) }}" alt="Image" width="100px" hight="100px"></td>
                            <td>
                                <a href="#" class="edit_link" data-id="{{ $staff->id }}">Edit <a>
                                <a href="#" class="btn btn-danger" onclick="deleteData({{ $staff->id }})" id="">detele <a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"> No record found</td>
                    </tr>
                @endif
            </tbody>
        </table> 
    </div>
</div>    
    <!-- Model Add-->       
<div class="modal fade" id="add_new" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100"><b>Add New</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   @include('staff.add')
                </div>
            </div>
        </div>
 </div>
<!-- Model Edit -->

<div class="modal fade" id="edit_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100"><b>Edit </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
 </div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script>
 $(document).ready(function(){ 
                $('body').on('click', 'a.edit_link', function() {
                var staff_id = $(this).data('id');
                $.ajax({
                    url: "{{ env('APP_URL')}}"+'edit/' + staff_id,
                    type: 'get',
                    success: function(response) { 
                        // Add response in Modal body
                        $('#edit_modal .modal-body').html(response);
                        // Display Modal
                        $('#edit_modal').modal('show'); 
                    }
                });
            });
        $('#new_record_btn').click(function(){
                $('#add_new').modal('show');
            });

    $('#bulk_delete').click(function(e){
        if(confirm('Do you really want to delete this selected record?'))
        {
                e.preventDefault();
                var allids = [];
                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                    console.log(allids);
                });
                $.ajax({
                    url:"{{route('staff.checkeddelete')}}",
                    type:'get',
                    data:{
                        ids:allids,
                        _token:$("input[name=_token]").val()
                    },
                    success:function(response)
                    {
                        $.each(allids, function(key,val){
                            $('#staff_id'+val).remove();
                        })
                    }
                });
        }
            });   
 })
</script>
<script>
function deleteData(id){
        if(confirm('Do you really want to delete this record?'))
        {
            console.log(id);
            $.ajax({
                url:'/destroy/'+ id,
                type:'get',
                data:{
                    "id": id
                },
                success:function(response)
                {
                    $('#staff_id'+id).remove();
                }
            })
        }
    }
</script>
@endsection