@layout('main')



@section('content')





    @if(!empty($news->results))
        @foreach ($news->results as $n)
            <div class="news_item">

                <h3>{{ htmlspecialchars($n->title) }}</h3>
                <div class="news_info">by the<strong> Staff</strong> at {{ date('Y-n-j H:i ', strtotime($n->created_at)) }}</div>
                <br />
                <?php $b = new BBcode; ?>
                <p class="news_text">{{ $b->toHTML(nl2br(htmlspecialchars($n->body))) }}</p>
            </div>
        @endforeach

        {{ $news->links() }}
        @endif
    @endsection



@endsection