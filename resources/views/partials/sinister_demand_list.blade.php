<p class="lead mb-0">SINISTRES EN ATTENTE DE VALIDATION
</p>

<hr>
<table id="agencylist" class="table table-bordered ">
    <thead>
    <tr>
    <th> CONTRAT </th>
    <th>NOM ET PRENOMS</th>
    <th>TYPE SINISTRE</th>
    <th>DATE DECLARATION</th>
    <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($sinisters as $item)
        <tr>
            <td>{{ $item->subscription->code }}</td>
            <td>{{$item->subscription->customer->name ." ".$item->subscription->customer->first_name}}</td>
            <td>{{$item->type2.$item->type1}}</td>
            <td>{{ date_format($item->created_at,"d/m/y") }}</td>
            <td>
                {{--  <a href="{{route('agencies.delete',$item->slug) }}"  class="btn btn-danger btn-sm">
                    <i class=" fa fa-trash"></i>
                </a>  --}}
                <a href="{{route('sinister.manage.demanddetails',$item->id) }}"  class="btn btn-info btn-sm ">
                    <i class="fa fa-pencil-alt"></i>
                </a>
            </td>
        </tr>
        @endforeach


    </tbody>
</table>
