<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Ticket System</h4>
                <form id="ticketForm">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Enter your title">
                        <div class="text-danger mt-1" id="title_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                            placeholder="Enter Your Description">
                        <div class="text-danger mt-1" id="description_error"></div>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" name="priority" id="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                        <div class="text-danger mt-1" id="priority_error"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Listing Ticket Issue</h4>
                <table class="table">
                    <thead>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Priority</th>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $index => $ticket)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $ticket->title }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>
                                    @if ($ticket->priority == 'low')
                                        <span class="btn btn-secondary btn-sm px-4">Low</span>
                                    @elseif($ticket->priority == 'medium')
                                        <span class="btn btn-primary btn-sm px-4">Medium</span>
                                    @elseif($ticket->priority == 'high')
                                        <span class="btn btn-danger btn-sm px-4">High</span>
                                    @else
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#ticketForm').on('submit', function(e) {
                e.preventDefault();
                $('.text-danger').html('');

                $.ajax({
                    url: "{{ route('ticket.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Ticket created successfully!',
                        }).then(() => {
                            window.location.reload();
                        });
                        $('#ticketForm')[0].reset();

                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.title) {
                                $('#title_error').html(errors.title[0]);
                            }
                            if (errors.description) {
                                $('#description_error').html(errors.description[0]);
                            }
                            if (errors.priority) {
                                $('#priority_error').html(errors.priority[0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
