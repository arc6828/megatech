<div class="card mt-4">
    <div class="card-body">
        <h2  >Comment</h2>
        <a href="{{ url('/comment/create?supplier_id='.$supplier->supplier_id) }}" class="btn btn-success btn-sm" title="Add New Comment">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Comment</th>
                        <th>User Id</th>
                        <!--th>Key</th><th>Value</th><th>Remark</th-->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($comment as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->comment }}</td>
                        <td>{{ $item->user->name }}</td>
                        <!--td>{{ $item->key }}</td>
                        <td>{{ $item->value }}</td>
                        <td>{{ $item->remark }}</td-->
                        <td>
                            
                            <a class="btn btn-primary btn-sm" href="{{ url('/comment/' . $item->id . '/edit') }}" title="Edit Comment"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>

                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>