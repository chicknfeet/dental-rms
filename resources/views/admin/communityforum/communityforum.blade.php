<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/communityforum.css') }}">
    <script src="https://kit.fontawesome.com/c609c0bad9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <h2>Community Forum</h2>
    </div>
        

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('admin.communityforum.create') }}" class="btn btn-primary">Add Topic</a>
        <br>
        <table class="table" style="height: 150px;">
            <tbody>
                @foreach ($communityforums as $communityforum)
                    <tr>
                        <div>
                            <td>{{ $communityforum->topic }}</td>
                        </div>
                        
                        <td>
                            <a href="{{ route('admin.showComment', $communityforum->id) }}" class="btn btn-info">View Comment</a>
                            <a href="{{ route('admin.updateCommunityforum', $communityforum->id) }}" class="btn btn-warning">Update</a>
                            <form method="post" action="{{ route('admin.deleteCommunityforum', $communityforum->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

@section('title')
    Community Forum
@endsection

</x-app-layout>