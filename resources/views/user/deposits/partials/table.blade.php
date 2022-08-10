<div class="table-responsive table-responsive-sm">
	<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ref</th>
      <th scope="col">Amount</th>
      <th scope="col">Status</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <?php $sn = 1; $deposits = auth()->user()->deposits; ?>
  @if(empty($deposits->count()))
  	<div class="alert alert-danger m-0">No deposits available</div>
  @else
	  <tbody>
	  	@foreach($deposits as $deposit)
		    <tr>
		      <th scope="row">
		      	{{ $sn++ }}
		      </th>
		      <td>
		      	{{ \Str::limit($deposit->refernce, 12) }}
		      </td>
		      <td>
		      	{{ number_format($deposit->amount) }}
		      </td>
		      <td>
		      	{{ ucfirst($deposit->status) }}
		      </td>
		      <td>
		      	{{ $deposit->created_at->diffForHumans() }}
		      </td>
		    </tr>
	    @endforeach
	</tbody>
   @endif
</table>
</div>