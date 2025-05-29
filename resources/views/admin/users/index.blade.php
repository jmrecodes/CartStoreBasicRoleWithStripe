@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">User Management</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Add New User</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-3" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="ps-3">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Joined</th>
                            <th scope="col" class="text-center pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="ps-3">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge {{ $user->isAdmin() ? 'bg-info' : 'bg-secondary' }} rounded-pill">{{ ucfirst($user->role) }}</span></td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="text-center pe-3">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary btn-xs me-1" title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    @if (Auth::id() !== $user->id)
                                        <form action="{{ route('admin.users.promote', $user) }}" method="POST" class="d-inline me-1">
                                            @csrf
                                            @method('PATCH')
                                                
                                            @if(!$user->isAdmin())
                                                <button type="submit" class="btn btn-outline-success btn-xs" title="{{ 'Promote to Admin' }}">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 0 1 0V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5z"/></svg>
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-outline-warning btn-xs" title="{{ 'Demote to User' }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/></svg>
                                                </button>
                                            @endif
                                        </form>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-xs" title="Delete User">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.528ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Zm3.5.5a.5.5 0 0 0-.528-.47l-.5 8.5a.5.5 0 0 0 .998.06l.5-8.5a.5.5 0 0 0-.47-.528Z"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">(Cannot modify self)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer bg-light py-2 px-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 