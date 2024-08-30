<div class="card rounded-0 py-3 mb-3">
    <div class="card-body">
        <h5>{{__('Quiz Results')}}</h5>
        <hr class="breakdown">
        <table class="table">
            @foreach ($quizzes as $item)
                <tr><th>{{$item->quiz_name}}</th><td>{{$item->marks}}</td><td>{{$item->status}}</td></tr>
            @endforeach
        </table>
    </div>
</div>
