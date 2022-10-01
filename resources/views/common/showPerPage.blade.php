<form class="d-inline-flex " method="POST" style="width:50%">
  @csrf
  <p class="fw-bold">Hiển thị:</p>
  <select name="showInPerPage" id="showInPerPage" class="form" style="margin-left:20px;height:30px">
    <option value="1">1</option>
    <option value="5"selected>5</option>
    <option value="10">10</option>
    <option value="100">100</option>
  </select>
</form>
