<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bubble Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-blue: #1e3a8a;
            --light-blue: #60a5fa;
            --background-color: #f1f5f9;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --muted-text: #64748b;
            --bubble-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            --bubble-glow: 0 0 8px rgba(96, 165, 250, 0.4);
            --border-radius: 24px;
        }

        body {
            background: linear-gradient(180deg, var(--background-color), #e2e8f0);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 20%, rgba(96, 165, 250, 0.2), transparent 70%);
            z-index: -1;
            animation: bubbleFloat 15s infinite ease-in-out;
        }

        .dashboard-header {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--bubble-shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            animation: slideIn 0.6s ease-out;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(96, 165, 250, 0.3), transparent);
            opacity: 0.5;
            border-radius: 50%;
            transform: scale(2);
        }

        .dashboard-header h2 {
            font-weight: 600;
            margin: 0;
            color: var(--dark-blue);
        }

        .badge {
            background: linear-gradient(45deg, var(--light-blue), var(--dark-blue));
            padding: 0.5rem 1.2rem;
            border-radius: 2rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            box-shadow: var(--bubble-glow);
        }

        .card {
            background: var(--card-bg);
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--bubble-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 10%;
            right: 10%;
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, var(--light-blue), transparent);
            border-radius: 50%;
            opacity: 0.3;
            animation: bubbleRise 5s infinite ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15), var(--bubble-glow);
        }

        .card-header {
            background: linear-gradient(90deg, var(--dark-blue), var(--light-blue));
            color: #fff;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--light-blue), transparent);
        }

        .btn {
            border-radius: 2rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .btn:hover::before {
            width: 200px;
            height: 200px;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--bubble-glow);
        }

        .btn-primary {
            background: var(--dark-blue);
            border: none;
        }

        .btn-primary:hover {
            background: #1e40af;
        }

        .btn-success {
            background: var(--light-blue);
            border: none;
            color: #fff;
        }

        .btn-success:hover {
            background: #3b82f6;
        }

        .btn-danger {
            background: #ef4444;
            border: none;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-outline-primary,
        .btn-outline-danger {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 1rem;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--light-blue);
            box-shadow: var(--bubble-glow);
        }

        .input-group-text {
            border-radius: 1rem 0 0 1rem;
            background: var(--light-blue);
            color: #fff;
            border: none;
        }

        .balance-card {
            background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
            color: #fff;
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--bubble-shadow), var(--bubble-glow);
            position: relative;
            overflow: hidden;
            animation: bubblePulse 3s infinite ease-in-out;
        }

        .balance-card::before {
            content: '';
            position: absolute;
            top: 20%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
            border-radius: 50%;
            animation: bubbleRise 6s infinite ease-in-out;
        }

        .balance-card::after {
            content: '';
            position: absolute;
            bottom: 10%;
            right: 15%;
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3), transparent);
            border-radius: 50%;
            animation: bubbleRise 4s infinite ease-in-out;
        }

        .balance-card h2 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-icon {
            font-size: 2.25rem;
            color: var(--light-blue);
            text-shadow: var(--bubble-glow);
            transition: transform 0.3s ease;
        }

        .card:hover .dashboard-icon {
            transform: scale(1.2);
        }

        .user-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .user-list li {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
            border-radius: 1rem;
        }

        .user-list li:hover {
            background: rgba(96, 165, 250, 0.1);
        }

        .user-list li:last-child {
            border-bottom: none;
        }

        .user-role {
            padding: 0.3rem 1rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 500;
            background: var(--light-blue);
            color: #fff;
        }

        .role-admin {
            background: var(--dark-blue);
        }

        .role-siswa {
            background: var(--light-blue);
        }

        .role-bank {
            background: #f59e0b;
        }

        .table {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table th {
            background: var(--dark-blue);
            color: #fff;
            font-weight: 600;
        }

        .table td,
        .table th {
            padding: 1rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(96, 165, 250, 0.05);
        }

        .modal-content {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--bubble-shadow);
            border: none;
        }

        .modal-header {
            background: linear-gradient(90deg, var(--dark-blue), var(--light-blue));
            color: #fff;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            padding: 1.5rem;
            border: none;
        }

        .modal-footer {
            border: none;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bubbleRise {
            0% {
                transform: translateY(0);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-20px);
                opacity: 0.5;
            }

            100% {
                transform: translateY(0);
                opacity: 0.3;
            }
        }

        @keyframes bubbleFloat {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes bubblePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }

        .fade-in {
            animation: slideIn 0.6s ease-out;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="dashboard-header fade-in">
            <div>
                <h2>Welcome, {{ Auth::user()->name }}</h2>
                <span class="badge">{{ ucfirst(Auth::user()->role) }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
            </form>
        </div>

        <!-- Admin Dashboard -->
        @if(Auth::user()->role == 'admin')
            <div class="row fade-in">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="card text-center p-4">
                                        <div class="dashboard-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <h3 class="fw-bold">{{ $users->count() }}</h3>
                                        <p class="text-muted">Total Users</p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <i class="fas fa-water me-2"></i>Recent Transactions
                                        </div>
                                        <div class="card-body">
                                            @if($mutasi->isEmpty())
                                                <p class="text-center text-muted">No transactions found.</p>
                                            @else
                                                <ul class="list-group list-group-flush">
                                                    @foreach($mutasi->take(5) as $mutation)
                                                        <li
                                                            class="list-group-item d-flex justify-content-between align-items-start flex-column">
                                                            <div class="d-flex justify-content-between w-100">
                                                                <strong>{{ ucfirst($mutation->description) }}</strong>
                                                                <small
                                                                    class="text-muted">{{ $mutation->created_at->format('d M Y H:i') }}</small>
                                                            </div>
                                                            <div class="d-flex justify-content-between w-100">
                                                                <span>User: {{ $mutation->user->name ?? 'Unknown' }}</span>
                                                                <span>Rp{{ number_format($mutation->amount, 0, ',', '.') }}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="fas fa-user-plus me-2"></i>Add New User
                                </button>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-users me-2"></i>User Management
                                </div>
                                <div class="card-body">
                                    @if($users->isEmpty())
                                        <p class="text-center text-muted">No users found.</p>
                                    @else
                                        <ul class="user-list">
                                            @foreach($users as $user)
                                                <li>
                                                    <div>
                                                        <strong>{{ $user->name }}</strong>
                                                        <span class="text-muted d-block">{{ $user->email }}</span>
                                                        <span
                                                            class="user-role role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                            data-bs-target="#editUserModal{{ $user->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('delete-user', $user->id) }}" method="POST"
                                                            style="display:inline;"
                                                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </li>

                                                <!-- Edit User Modal -->
                                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('update-user', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit User</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="name" class="form-label">Name</label>
                                                                        <input type="text" class="form-control" name="name"
                                                                            value="{{ $user->name }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email</label>
                                                                        <input type="email" class="form-control" name="email"
                                                                            value="{{ $user->email }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="password" class="form-label">New Password
                                                                            (optional)</label>
                                                                        <input type="password" class="form-control" name="password">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="password_confirmation"
                                                                            class="form-label">Confirm New Password</label>
                                                                        <input type="password" class="form-control"
                                                                            name="password_confirmation">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        User</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('add-user') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="siswa">Siswa</option>
                                        <option value="admin">Admin</option>
                                        <option value="bank">Bank</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Student Dashboard -->
        @if(Auth::user()->role == 'siswa')
            <div class="row fade-in">
                <div class="col-md-12">
                    <div class="balance-card">
                        <h4 class="mb-2">Your Balance</h4>
                        <h2>Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i class="fas fa-cloud-upload-alt me-2"></i>Top-up Balance
                        </div>
                        <div class="card-body">
                            <form action="{{ route('topUp') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="credit" class="form-label">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="credit" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fas fa-cloud-upload-alt me-2"></i>Top-up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i class="fas fa-cloud-download-alt me-2"></i>Withdraw Balance
                        </div>
                        <div class="card-body">
                            <form action="{{ route('withdraw') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="credit" class="form-label">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" name="credit" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-danger"><i
                                            class="fas fa-cloud-download-alt me-2"></i>Withdraw</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i class="fas fa-exchange-alt me-2"></i>Transfer Balance
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transfer') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="recepient_id" class="form-label">Recipient</label>
                                    <select name="recepient_id" class="form-select" required>
                                        @foreach($users as $user)
                                            @if($user->role == 'siswa' && $user->id != Auth::user()->id)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-warning"><i
                                            class="fas fa-exchange-alt me-2"></i>Transfer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-history me-2"></i>Transaction History
                        </div>
                        <div class="card-body">
                            @if($mutasi->isEmpty())
                                <p class="text-center text-muted">No transactions .</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mutasi as $item)
                                                <tr>
                                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td class="text-danger">
                                                        {{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}
                                                    </td>
                                                    <td class="text-success">
                                                        {{ $item->credit > 0 ? 'Rp ' . number_format($item->credit, 0, ',', '.') : '-' }}
                                                    </td>
                                                    <td>
                                                        @if($item->status == 'done')
                                                            <span class="badge bg-success">Done</span>
                                                        @elseif($item->status == 'rejected')
                                                            <span class="badge bg-danger">Rejected</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">Process</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Bank Dashboard -->
       @if(Auth::user()->role == 'bank')
<div class="row fade-in">
    <div class="col-md-12 mb-4">
        <div class="row">
            <!-- Top-up -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-exchange-alt me-2"></i>Top-up
                    </div>
                    <div class="card-body">
                        <form action="{{ route('topup.siswa') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="recepient_id" class="form-label">Recipient</label>
                                <select name="recepient_id" class="form-select" required>
                                    @foreach($users as $user)
                                        @if($user->role == 'siswa' && $user->id != Auth::user()->id)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-exchange-alt me-2"></i>Top-up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Payment Requests -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-money-check-alt me-2"></i>Payment Requests
                    </div>
                    <div class="card-body">
                        @if($request_payment->isEmpty())
                            <p class="text-center text-muted">No payment requests at the moment.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($request_payment as $wallet)
                                            <tr>
                                                <td>{{ $wallet->description }}</td>
                                                <td>Rp {{ number_format($wallet->credit - $wallet->debit, 0, ',', '.') }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ route('approve', $wallet->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-check me-2"></i>Accept
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('reject', $wallet->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-times me-2"></i>Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- All Transactions -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list me-2"></i>All Transactions
            </div>
            <div class="card-body">
                @if($mutasi->isEmpty())
                    <p class="text-center text-muted">No transactions found.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mutasi as $item)
                                    <tr>
                                        <td>{{ $item->user->name ?? 'Unknown' }}</td>
                                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td class="text-danger">
                                            {{ $item->debit > 0 ? 'Rp ' . number_format($item->debit, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="text-success">
                                            {{ $item->credit > 0 ? 'Rp ' . number_format($item->credit, 0, ',', '.') : '-' }}
                                        </td>
                                        <td>
                                            @if($item->status == 'done')
                                                <span class="badge bg-success">Done</span>
                                            @elseif($item->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Process</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>