<p class="lead mb-0">SINISTRES TRAITEES
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


                @switch($item->state )
                @case(0)
                <a href={{route('sinister.manage.demanddetails',$item->id) }}  class="btn btn-info btn-sm ">
                    <i class="fa fa-pencil-alt"></i>
                </a>
                @break
                @case(1)

                <a {{ ($item->state != 1) ? 'disabled' :'' }} href={{ route('sinister.bon',$item->id) }}  class="btn btn-primary btn-sm ">
                    <i class="fa fa-eye"> VOIR </i>
                </a>
                <span style="color: green"><i class="far fa-check-square"></i></span>
                @if ($item->transmit != 1)
                    <a href="{{route('sinister.manage.forward',$item->id) }}"  class="btn btn-secondary btn-sm">
                    <i class=" fa fa-share"></i>
                </a>
                @endif
                @break
                @default
                <span style="color: red">REFUSE<i class="far fa-times-circle"></i></span>
                @if ($item->transmit != 1)
                <a href="{{route('sinister.manage.forward',$item->id) }}"  class="btn btn-secondary btn-sm">
                <i class=" fa fa-share"></i>
            </a>
            @endif
                @endswitch
            </td>
        </tr>
        @endforeach


    </tbody>
</table>
