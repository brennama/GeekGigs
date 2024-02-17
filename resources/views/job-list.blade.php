@extends('layouts.app')

@section('title', 'Job Search')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 justify-content-center"> 
        <div class="col-md-4"> 
            <input type="text" class="form-control" placeholder="Search for jobs">
        </div>
    </div>
    <div class="row flex-grow-1"> 
        <div class="col-md-2"> 
            <div class="h-100 d-flex flex-column">
                <h5>Filter Options</h5>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                    
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                </select>
                <select class="form-select mb-2">
                    <option>Select Option 1</option>
                    <option>Select Option 2</option>
                </select>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="h-100 overflow-auto" style="max-height: 80vh;"> 
                <h5>Job List</h5>
                <div class="card mb-2">
                    <div class="card-body">
                    <h5 class="card-title">Job Title</h5>
                    <p class="card-text">Company Name</p>
                    <p class="card-text">Job Location</p>
                    <p class="card-text description">Job Description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-6">
    <div class="position-relative h-100">
        <div class="h-100 overflow-auto" style="max-height: 80vh;"> 
            <h5>Job Details</h5>
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h5 class="card-title">Job Title</h5>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary">Save Job</button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <p>Company Name</p>
                            <p>Job Location</p>
                            <a href="#">Apply Now</a>
                        </div>
                        <div class="col">
                            <p>Education Requirement</p>
                            <p>Salary Range</p>
                        </div>
                    </div>
                    <p>Job Details Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae tortor urna. Curabitur commodo erat eu dui congue, et tincidunt lacus vehicula. Vivamus commodo auctor nulla, a malesuada purus consectetur vel. Sed nec velit a mi sodales tristique. Integer id odio quis ipsum pharetra rutrum vel nec turpis. Proin interdum lacus a lectus viverra, vel malesuada elit convallis.</p>
                    <div class="mt-3">
                        <h6>Tags:</h6>
                        <span class="badge bg-primary">Tag1</span>
                        <span class="badge bg-primary">Tag2</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
@endsection
