@foreach ($users as $user)

    <tr>

        {{-- name --}}
        <td><span>{{ $user->name }}</span></td>

        {{-- Email --}}
        <td><span> {{ $user->email }} </span> </td>

        {{-- Type --}}
        <td><span> {{ $user->account()->type }} </span> </td>

        {{-- Category --}}
        <td><span>{{ $user->account()->category->name }}</span> </td>

        {{-- Accounts --}}
        <td>
            @foreach ($user->accounts as $account)

                <ul class="list-unstyled mb-0">

                    <li class="mb-1">

                        <img src="{{ url($account->avatar) }}"
                            class="img-fluid rounded-circle mb-2" width="30" height="30" />

                        <a href="{{ route('admin.users.accounts.show', [$user->id, $account->id]) }}">{{ $account->name }}</a>

                    </li>

                </ul>

            @endforeach

        </td>



        {{-- Delete --}}
        <td class="d-flex  d-md-table-cell">

            @if (Auth::guard('admin')->user()->can('delete_user'))
                
                {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'post', 'class' => 'delete', 'id' => 'DeleteUser']) !!}
                @csrf
                @method('DELETE')


                    <button type="submit" class="text-danger"
                        style=" border:none; background: none; text-decoration: none; ">
                        {{ __('delete') }}</button>
                        <i class="align-middle me-2" data-feather="trash"></i>

                {!! Form::close() !!}
            @endif
           

        </td>
    </tr>
        
@endforeach
