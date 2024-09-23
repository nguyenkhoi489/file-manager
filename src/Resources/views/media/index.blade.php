@extends("file-manager::master")
@section("content")
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex">
                        <div class="dropdown me-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="uploadDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-upload me-1"></i> Upload
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="uploadDropdown">
                                <li><a class="dropdown-item" href="#">Files</a></li>
                                <li><a class="dropdown-item" href="#">Folder</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-outline-secondary me-2"><i class="bi bi-folder-plus"></i></button>
                        <button class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle custom-dropdown" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel"></i> Everything
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                            <li><a class="dropdown-item" href="#">All media</a></li>
                            <li><a class="dropdown-item" href="#">Documents</a></li>
                            <li><a class="dropdown-item" href="#">Images</a></li>
                        </ul>
                    </div>
                    <form class="d-flex ms-auto">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search in current folder" aria-label="Search">
                            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>All media</h5>
                <div>
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bi bi-sort-alpha-down"></i> Sort
                    </button>
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bi bi-list-task"></i> Actions
                    </button>
                    <button class="btn btn-outline-secondary me-2">
                        <i class="bi bi-grid"></i>
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-folder folder-icon"></i>
                            <p class="card-text mt-2">general</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-folder folder-icon selected"></i>
                            <p class="card-text mt-2">members</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-folder folder-icon"></i>
                            <p class="card-text mt-2">projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto sidebar">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-folder folder-icon selected me-2"></i>
                        members
                    </h5>
                    <p class="card-text">
                        <strong>Name:</strong> members<br>
                        <strong>Uploaded at:</strong> 2024-03-11 07:04:10<br>
                        <strong>Modified at:</strong> 2024-09-23 13:41:22
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
