@if(session('success'))
<div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
    <div class="d-flex align-items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle-fill me-2" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l4.243-4.243a.75.75 0 0 0-1.06-1.06L7.5 9.439 5.814 7.753a.75.75 0 0 0-1.06 1.06l2.216 2.216z" />
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



<div class="table-responsive bg-white border rounded shadow-sm">
    <table class="table table-hover table-bordered align-middle mb-0">
        <thead class="table-light text-uppercase small">
            <tr>
                <th>S.L</th>
                <th>Join Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $index => $employee)
            <tr>
                <td>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                <td>{{ \Carbon\Carbon::parse($employee->date_of_join)->format('d M Y') }}</td>
                <td class="d-flex align-items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($employee->name) }}&background=random" class="rounded-circle me-2" width="32" height="32" alt="avatar">
                    {{ $employee->name }}
                </td>
                <td>{{ $employee->emp_email }}</td>
                <td>{{ $employee->department ?? '—' }}</td>
                <td>{{ $employee->designation }}</td>
                <td>
                    <span class="badge
                                @switch($employee->employment_status)
                                    @case('Active') bg-success @break
                                    @case('Terminated') bg-danger @break
                                    @default bg-warning text-dark
                                @endswitch">
                        {{ $employee->employment_status }}
                    </span>
                </td>
                <td class="text-center">
                    @can('view employees')
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-primary rounded-circle me-1" title="View">
                        <iconify-icon icon="mdi:eye-outline" class="text-base"></iconify-icon>
                    </a>
                    @endcan
                    @can('edit employees')
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-success rounded-circle me-1" title="Edit">
                        <iconify-icon icon="mdi:pencil" class="text-base"></iconify-icon>
                    </a>
                    @endcan
                    @can('delete employees')
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger rounded-circle" title="Delete">
                            <iconify-icon icon="mdi:delete-outline" class="text-base"></iconify-icon>
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-3">No employees found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
