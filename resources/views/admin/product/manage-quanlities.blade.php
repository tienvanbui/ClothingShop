@for ($i = 1; $i <= $count_number_color_selected * $count_number_size_selected; ++$i)
    <div class="container-fluid mb-2">
        <div class="row">
            <div class="col-md-4 ">
                <select name="size_selection[]" class="form-select">
                    <option>.....Chọn.....</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}">Size {{ $size->size_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 ">
                <select name="color_selection[]" class="form-select">
                    <option>.....Chọn.....</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 ">
                <input type="number" name="product_quanlities[]" class="form-control"
                    placeholder="Enter product quanlities">
            </div>
        </div>
    </div>
@endfor
