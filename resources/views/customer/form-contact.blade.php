<div class="card  mt-4">
  <div class="card-body">

    <h2>ผู้ติดต่อ</h2>

    <table class="table table-sm table-bordered text-center" id="table">
      <thead>
        <tr>
          <th class="text-center">Action</th>
          <th class="text-center">Name</th>
          <th class="text-center">Department</th>
          <th class="text-center">Email</th>
          <th class="text-center">Phone</th>
        </tr>
      </thead>
      <tbody>

        @foreach(["Hank","Norman","Susan B.","Wystan Hugh"] as $row_contact)
        <tr>
          <td>
              <i class="fa fa-trash"></i> <i class="fa fa-edit"></i>
          </td>
          <td>{{ $row_contact }}</td>
          <td>...</td>
          <td>...</td>
          <td>...</td>
        </tr>
        @endforeach
        <tr>
          <td>
            New Contact
          </td>
          <td><input class="form-control form-control-sm" placeholder="name" /></td>
          <td><input class="form-control form-control-sm" placeholder="department" /></td>
          <td><input class="form-control form-control-sm" placeholder="email" type="email" /></td>
          <td><input class="form-control form-control-sm" placeholder="phone" /></td>
        </tr>
    </tbody>
  </table>
  <div class="mt-4">
    <button class="btn btn-primary">Add Contact</button>
  </div>
  </div>
</div>
