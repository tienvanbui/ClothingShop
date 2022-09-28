<form action="{{route($routeName,[$itemname => $item])}}" method="POST" class="d-inline-block">
    @method('delete')
    @csrf
    <div class="d-grid gap-2 mt-1">
        <button class="btn btn-block btn-danger text-white btn-sm "><i class="fas fa-trash-alt"></i></button>
    </div>
</form>