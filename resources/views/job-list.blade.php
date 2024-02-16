@extends('layouts.app')

@section('title', 'Job Search')

@section('content')
<div class="container-fluid"> <!-- Changed container to container-fluid for full width -->
    <div class="row mb-4"> <!-- Added margin bottom -->
        <div class="col">
            <!-- Search box -->
            <input type="text" class="form-control" placeholder="Search for jobs">
        </div>
    </div>
    <div class="row flex-grow-1"> <!-- Added flex-grow-1 to make the row extend to the bottom -->
        <div class="col-md-2"> <!-- Adjusted column width to 'md' breakpoint and added background color for visibility -->
            <!-- Filter options -->
            <div class="h-100 d-flex flex-column">
                <h5>Filter Options</h5>
                <!-- Dropdown menus -->
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    <!-- Add more options as needed -->
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    <!-- Add more options as needed -->
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    <!-- Add more options as needed -->
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    <!-- Add more options as needed -->
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    <!-- Add more options as needed -->
                </select>
                <!-- Add more dropdowns here -->
            </div>
        </div>
        <div class="col-md-4 bg-light"> <!-- Adjusted column width to 'md' breakpoint and added background color for visibility -->
            <!-- Job list -->
            <div class="h-100 overflow-auto"> <!-- Added overflow-auto for scrolling -->
                <h5>Job List</h5>
                <!-- List of job details -->
                <div class="card mb-2">
                    <div class="card-body">
                        Job 1 details
                    </div>
                </div>
                <!-- Add more job details cards here -->
            </div>
        </div>
        <div class="col-md-6 bg-light"> <!-- Adjusted column width to 'md' breakpoint and added background color for visibility -->
            <!-- Job details -->
            <div class="position-relative h-100 overflow-auto"> <!-- Added overflow-auto for scrolling -->
                <h5>Job Details</h5>
                <!-- Single job details card -->
                <div class="card">
                    <div class="card-body">
                        Job 1 details
                    </div>
                </div>
                <!-- Add more job details cards here -->
                <!-- Floating button -->
                <button class="btn btn-primary position-absolute top-0 end-0 mt-2 mr-2">Save Job</button> <!-- Adjusted margin -->
            </div>
        </div>
    </div>
</div>
@endsection
