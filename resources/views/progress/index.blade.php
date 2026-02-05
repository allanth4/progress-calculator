<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Tracker</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
        }
        input[type="number"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover {
            background: #2563eb;
        }
        .progress-bar {
            background: #e5e5e5;
            border-radius: 4px;
            height: 24px;
            overflow: hidden;
            margin: 1rem 0;
        }
        .progress-fill {
            background: #22c55e;
            height: 100%;
            transition: width 0.3s ease;
        }
        .progress-text {
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
        }
        .entries {
            margin-top: 1.5rem;
        }
        .entries h3 {
            margin-bottom: 0.75rem;
            color: #555;
        }
        .entry {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        .entry:last-child {
            border-bottom: none;
        }
        .entry-value {
            font-weight: 500;
        }
        .entry-date {
            color: #888;
            font-size: 0.875rem;
        }
        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Progress Tracker</h1>

        @if ($errors->any())
            <div class="card" style="background: #fef2f2; border: 1px solid #fecaca;">
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if ($project)
            <div class="card">
                <div class="progress-text">
                    @php
                        $total = $entries->sum('value');
                        $percentage = min(100, round(($total / $project->goal) * 100));
                    @endphp
                    {{ $total }} / {{ $project->goal }} ({{ $percentage }}%)
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                </div>

                <form action="{{ route('progress.store', $project) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="value">Add Progress</label>
                        <input type="number" id="value" name="value" min="0" required>
                    </div>
                    <button type="submit">Add</button>
                </form>

                @if ($entries->isNotEmpty())
                    <div class="entries">
                        <h3>Recent Entries</h3>
                        @foreach ($entries as $entry)
                            <div class="entry">
                                <span class="entry-value">+{{ $entry->value }}</span>
                                <span class="entry-date">{{ $entry->created_at->diffForHumans() }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <div class="card">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="goal">{{ $project ? 'Start New Project' : 'Create Project' }}</label>
                    <input type="number" id="goal" name="goal" min="1" value="100" required>
                </div>
                <button type="submit">New Project</button>
            </form>
        </div>
    </div>
</body>
</html>
