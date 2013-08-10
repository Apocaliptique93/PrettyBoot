@layout('main')



@section('content')
    @if(empty($news->results))
        <div class="alert alert-danger">
            There's no news to display.
            <br />
            <a href="/admin/news/new">
                Create a new item
            </a>
        </div>
    @else
        <table class="table">
            <caption>
                {{ $news->links() }}
            </caption>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date of creation</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                    @foreach($news->results as $item)

                    <tr>
                        <td> {{ htmlspecialchars($item->title) }} </td>
                        <td> @if(empty(User::find($item->user_id)->email))
                                User doesn't exist anymore
                             @else
                            <a href="/admin/users/profile/{{$item->user_id}}">{{ htmlspecialchars(User::find($item->user_id)->email) }} </a></td>
                             @endif
                        <td> {{ date('Y-m-d H:i', strtotime($item->created_at)) }} </td>
                        <td>
                            {{ HTML::link('/admin/news/edit/'.$item->id, 'Edit') }}
                            -
                            {{ HTML::link('/admin/news/delete/'.$item->id, 'Delete') }}
                        </td>
                    </tr>

                    @endforeach

            </tbody>
        </table>
            <span style="width:100%;text-align:center;">{{ $news->links() }}</span>
    @endif
@endsection

