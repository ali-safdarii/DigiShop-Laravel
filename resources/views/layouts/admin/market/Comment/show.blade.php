@extends('layouts.admin.master')

@section('title','comment')
@section('content')


    <div class="main-content ">


        <div class="d-flex flex-wrap justify-content-center align-items-center
                p-5 rounded-5 w-75 mx-auto my-5 card ">

            <div class="container mt-3">
                <div class="border">
                    <div class="card-body">
                        <div class="p-3 table-primary text-dark d-flex justify-content-start align-items-center">
                            <img src="{{asset('admin/images/icons/avatar.jpg')}}" height="50" class="mb-2 rounded-circle" alt="User Avatar">
                            <h6 class="card-title m-2">{{$comment->user->FullName}}</h6>
                        </div>

                        <div class="mt-2 ms-2">
                            <h4 class="mt-3"><span class="text text-secondary text-sm text-gray-500">Product Name : </span>{{$comment->commentable->name}}</h4>
                            <p class="card-text mt-3">   {{$comment->body}} </p>
                        </div>


                    </div>

                </div>

                <div class=" reply-form mt-5 ">
                    <form>
                        <div class="form-floating mb-3">
                                <textarea style="height: 200px" id="reply" class="form-control"
                                          placeholder="Reply"></textarea>
                            <label for="reply">Admin Reply</label>
                        </div>
                        <div class="m-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="ms-auto">
                <button id="toggleApproval" type="button" class="btn {{$comment->approved == 1 ? 'btn-success' : 'btn-danger'}}">{{$comment->approved == 1 ? 'Approved' : 'Unapproved'}}</button>
            </div>
        </div>


    </div>



@endsection


@section('custom-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleApprovalBtn = document.getElementById('toggleApproval');
            toggleApprovalBtn.addEventListener('click', function() {
                const commentId = {{$comment->id}}; // Replace with the actual comment ID

                // Send an AJAX request to update the comment's approval status
                fetch(`${commentId}/toggle-approval`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Toggle the button's text and color
                            toggleApprovalBtn.classList.toggle('btn-success');
                            toggleApprovalBtn.classList.toggle('btn-danger');
                            toggleApprovalBtn.textContent = data.approved ? 'Approved' : 'Unapproved';
                        }
                    })
                    .catch(error => console.error(error));
            });
        });
    </script>


@endsection

