@extends('layouts.main')

@section('title','all person')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            @if (Session::has('successMsg'))
                <div class="alert alert-success">
                    {{ Session::get('successMsg') }}
                </div>
            @endif

            @if (Session::get('alertMsg'))
                <div class="alert alert-danger">
                    {{ Session::get('alertMsg') }}
                </div>
            @endif
            <h1 class="text-center">All Person</h1>
             <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">Email</th>
                    <th scope="col">City</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($persons as $key=>$person)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $person->firstName }}</td>
                        <td>{{ $person->lastName }}</td>
                        <td>{{ $person->email }}</td>
                        <td>{{ $person->city }}</td>
                        <td>
                            <a href="{{ route('person.edit',$person->id) }}" class="btn btn-info waves-effect">
                                <i class="material-icons">edit</i>
                             </a>
                        </td>

                        <td>
                            <button class="btn btn-danger waves-effect" type="button" onclick="deletePerson({{ $person->id }})">
                                <i class="material-icons">delete</i>
                            </button>

                            <form id="delete-form-{{ $person->id }}" action="{{ route('person.destroy',$person->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')

                            </form>  
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>

            </table>
            {{ $persons->links() }}
            
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    function deletePerson(id){
    	const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {

     event.preventDefault();
     document.getElementById('delete-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your person file is safe :)',
      'error'
    )
  }
})
    }
    </script>