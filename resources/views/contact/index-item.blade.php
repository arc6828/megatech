<div class="card">
    <div class="card-header">Contact</div>
    <div class="card-body">
        <a href="{{ url('/contact/create') }}?customer_id={{ $customer->customer_id }}" class="btn btn-success btn-sm" title="Add New Contact">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        <form method="GET" action="{{ url('/contact') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Department</th><th>Email</th><th>Phone</th><th>อ้างอิงเมื่อ</th>
                        <th class="d-none">Contact Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($customer->contacts as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                        <a href="{{ url('/contact/' . $item->id) }}" title="View Contact">
                            {{ $item->name }}
                        </a>
                        </td>
                        <td>{{ $item->department }}</td><td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <div class="">      
                                <div class="{{ $errors->has('ref_qt') ? 'has-error' : ''}}">
                                    <label for="ref_qt" class="control-label">
                                    <i class="fa fa-{{ $item->ref_qt === "true" ? 'check-square' : 'square'}}"></i>
                                    {{ 'ใบเสนอราคา (QT)' }}
                                    </label>
                                </div>
                                <div class="{{ $errors->has('ref_iv') ? 'has-error' : ''}}">
                                    <label for="ref_iv" class="control-label">
                                    <i class="fa fa-{{ $item->ref_iv === "true" ? 'check-square' : 'square'}}"></i>
                                    {{ 'ใบขาย (IV)' }}
                                    </label>
                                </div>    
                                <div class="{{ $errors->has('ref_bi') ? 'has-error' : ''}}">
                                    <label for="ref_bi" class="control-label">
                                    <i class="fa fa-{{ $item->ref_bi === "true" ? 'check-square' : 'square'}}"></i>
                                    {{ 'ใบวางบิล (BI)' }}
                                    </label>
                                </div> 
                                <div class="{{ $errors->has('ref_po') ? 'has-error' : ''}}">
                                    <label for="ref_po" class="control-label">
                                    <i class="fa fa-{{ $item->ref_po === "true" ? 'check-square' : 'square'}}"></i>
                                    {{ 'ใบสั่งซื้อ (PO)' }}
                                    </label>
                                </div>
                                
                                
                            </div>
                        </td>
                        <td class="d-none">{{ $item->contact_type }}</td>
                        <td class="d-none">
                            @switch($type)
                                @case("customer")
                                    {{ $item->customer_id }} 
                                    @break
                                    
                                @case("supplier")
                                    {{ $item->supplier_id }}
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <a class="d-none" href="{{ url('/contact/' . $item->id) }}" title="View Contact"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            <a href="{{ url('/contact/' . $item->id . '/edit') }}" title="Edit Contact"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('/contact' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>

    </div>
</div>
            