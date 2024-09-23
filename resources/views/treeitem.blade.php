<li>
    <div class="person">
        {{-- <img src="https://via.placeholder.com/50" alt="Person"> --}}
        <p><a href="{{route('edituser',$member['id'])}}">{{ ucwords($member['name']) }}</a>{{ $member['cfm']?? ' ' }}</p>
    </div>

    @if (!empty($member['children']))
        <ul>
            @foreach ($member['children'] as $child)
                @include('treeitem', ['member' => $child])
            @endforeach
        </ul>
    @endif
</li>
