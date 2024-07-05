<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/communityforum.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h4><i class="fa-regular fa-comments"></i> Community Forum</h4>
    </div>
    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <h4>Post a New Topic</h4>
            <form action="{{ route('patient.communityforum.store') }}" method="POST" id="postTopicForm">
                @csrf
                <div class="input-group mb-3">
                    <textarea type="text" class="form-control" id="topic" name="topic" placeholder="Type here..." required></textarea>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Post Topic</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="forum-container">
            @foreach ($communityforums as $communityforum)
                <div class="tweet-card">
                    <div class="tweet-header">
                        <div>
                            <span class="username">{{ $communityforum->name }}</span>
                            <span class="timestamp">{{ $communityforum->created_at->setTimezone('Asia/Manila')->format('F d, Y h:i A') }}</span>
                        </div>
                    </div>
                    <div class="tweet-content">
                        <p>{{ $communityforum->topic }}</p>
                    </div>
                    <div class="tweet-actions">
                        <a href="{{ route('patient.showComment', $communityforum->id) }}" class="btn-action"><i class="fa-regular fa-message"></i> Comment</a>
                        <a href="{{ route('patient.updateCommunityforum', $communityforum->id) }}" class="btn-action"><i class="fa-solid fa-pen"></i> Edit</a>
                        <form method="post" action="{{ route('patient.deleteCommunityforum', $communityforum->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action" onclick="return confirm('Are you sure you want to delete this post?')"><i class="fa-regular fa-trash-can"></i> Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // JavaScript for form submission animation
        document.getElementById('postTopicForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting
            console.log('Posting topic...');
            setTimeout(function() {
                document.getElementById('postTopicForm').submit(); // Submit the form after animation or delay
            }, 1000); // Adjust delay as needed
        });
    </script>
    
    <!-- pagination here -->
    @if ($communityforums->lastPage() > 1)
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($communityforums->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $communityforums->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @for ($i = 1; $i <= $communityforums->lastPage(); $i++)
                @if ($i == $communityforums->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $communityforums->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            <!-- Next Page Link -->
            @if ($communityforums->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $communityforums->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    @endif
</body>
</html>
@endsection

@section('title')
    Community Forum
@endsection

</x-app-layout>