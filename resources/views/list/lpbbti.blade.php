<ul>
    @foreach($data as $item)
        <li>{{ $loop->iteration }}. {{ $item->nama_perusahaan }}</li>
    @endforeach
</ul>
