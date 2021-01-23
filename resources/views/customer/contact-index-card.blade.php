<div class="card mt-4">    
    <div class="card-body">
        <h2 class="">Contact</h2>
        <a href="{{ url('/contact/create') }}?customer_id={{ $customer->customer_id }}" class="btn btn-success btn-sm" title="Add New Contact" target="_blank">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>

        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Department</th><th>Email</th><th>Phone</th><th>อ้างอิงเมื่อ</th><th>พิมพ์</th>
                        <th class="d-none">Contact Type</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contact as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                        <a href="{{ url('/contact/' . $item->id.'/edit') }}" title="View Contact">
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
                                <div class="{{ $errors->has('ref_iv') ? 'has-error' : ''}} d-none">
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
                            <a href="#"><i class="fa fa-print"></i></a>
                        </td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>

    </div>
</div>