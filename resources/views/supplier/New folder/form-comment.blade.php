<div class="card  mt-4">
  <div class="card-body">

    <h2>Comment</h2>

    <table class="table table-sm table-bordered text-center" >
      <thead>
        <tr>
          <th class="text-center">Date</th>
          <th class="text-center">User</th>
          <th class="text-center">Comment</th>
        </tr>
      </thead>
      <tbody>

        @foreach(["2019-01-23","2019-02-23"] as $row_contact)
        <tr>
          <td>
            {{ $row_contact }}
          </td>
          <td>
            ...
          </td>
          <td>
            ...
          </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="row mt-4">
    <div class="col-lg-8">
      <textarea class="form-control" placeholder="write somethings ..."></textarea>
    </div>
    <div class="col-lg-4">
      <button class="btn btn-primary">Add Comment</button>
    </div>
  </div>
  </div>
</div>
