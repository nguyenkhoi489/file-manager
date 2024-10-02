<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/lib/toastr/toastr.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/lib/cropper/cropper.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/css/base.css') }}">

<div class="nkd-container">
    <div class="nkd-media-container"
         data-breadcrumbs-count="1"
         data-upload="{{ route('media.file.uploadFile') }}"
         data-ajax="{{ route('media.loadMedia') }}">
        <div class="nkd-media-main">
            <input type="hidden" name="nkd-csrf-token" value="{{ csrf_token() }}">
            <div class="nkd-card-header">
                <div
                    class="nkd-header-flex nkd-w-100">
                    <div class="nkd-media-actions">
                        <div class="nkd-btn-list">
                            <!--Upload-->
                            <div class="nkd-dropdown">
                                <button class="nkd-btn nkd-dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 9l5 -5l5 5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    Upload
                                </button>
                                <div class="nkd-dropdown-menu" style="">
                                    <button class="nkd-dropdown-item js-button-upload">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 9l5 -5l5 5"></path>
                                            <path d="M12 4l0 12"></path>
                                        </svg>
                                        Upload from local
                                    </button>

                                    <button class="nkd-dropdown-item js-download-action dropdown-item"
                                            data-bs-toggle="modal" data-bs-target="#modal-upload-link">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 15l6 -6"></path>
                                            <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                                            <path
                                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path>
                                        </svg>
                                        Upload from URL
                                    </button>
                                </div>
                            </div>
                            <!--Create Folder-->
                            <button class="nkd-btn js-create-folder-action" type="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Create folder"
                                    data-bs-original-title="Create folder">
                                <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                </svg>

                            </button>
                            <!--Reload-->
                            <button class="nkd-btn js-change-action" type="button" data-type="refresh"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"
                                    data-bs-original-title="Refresh">
                                <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>

                            </button>
                        </div>
                    </div>
                    <!--Input Form Search-->
                    <div class="nkd-media-search">
                        <div class="nkd-input-group">
                            <input type="search" class="nkd-form-control" name="search"
                                   placeholder="Search in current folder">
                            <button class="nkd-btn js-search-action" type="submit">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="nkd-w-100 nkd-header-breadcrumbs">
                    <div class="nkd-media-breadcrumb">
                        <ul class="breadcrumb">
                            <li>
                                <a href="#" data-folder="0" class="text-decoration-none js-change-folder">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 8h.01"></path>
                                        <path
                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path>
                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                                    </svg>
                                    All media
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="nkd-media-tools">
                        <div class="nkd-btn-list" role="group">
                            <div class="nkd-dropdown">
                                <button class="nkd-btn nkd-dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M16 8h4l-4 8h4"></path>
                                        <path d="M4 16v-6a2 2 0 1 1 4 0v6"></path>
                                        <path d="M4 13h4"></path>
                                        <path d="M11 12h2"></path>
                                    </svg>
                                    Sort
                                </button>

                                <div class="nkd-dropdown-menu">
                                    <button class="nkd-dropdown-item js-media-change-filter" data-type="sort_by"
                                            data-value="name-asc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 10v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                                            <path d="M19 21h-4l4 -7h-4"></path>
                                            <path d="M4 15l3 3l3 -3"></path>
                                            <path d="M7 6v12"></path>
                                        </svg>
                                        File name - ASC

                                    </button>
                                    <button class="nkd-dropdown-item js-media-change-filter active" data-type="sort_by"
                                            data-value="name-desc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 21v-5c0 -1.38 .62 -2 2 -2s2 .62 2 2v5m0 -3h-4"></path>
                                            <path d="M19 10h-4l4 -7h-4"></path>
                                            <path d="M4 15l3 3l3 -3"></path>
                                            <path d="M7 6v12"></path>
                                        </svg>
                                        File name - DESC

                                    </button>
                                    <button class="nkd-dropdown-item js-media-change-filter" data-type="sort_by"
                                            data-value="created_at-asc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 15l3 3l3 -3"></path>
                                            <path d="M7 6v12"></path>
                                            <path d="M17 3a2 2 0 0 1 2 2v3a2 2 0 1 1 -4 0v-3a2 2 0 0 1 2 -2z"></path>
                                            <path d="M17 16m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M19 16v3a2 2 0 0 1 -2 2h-1.5"></path>
                                        </svg>
                                        Uploaded date - ASC

                                    </button>
                                    <button class="nkd-dropdown-item js-media-change-filter" data-type="sort_by"
                                            data-value="created_at-desc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 15l3 3l3 -3"></path>
                                            <path d="M7 6v12"></path>
                                            <path d="M17 14a2 2 0 0 1 2 2v3a2 2 0 1 1 -4 0v-3a2 2 0 0 1 2 -2z"></path>
                                            <path d="M17 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M19 5v3a2 2 0 0 1 -2 2h-1.5"></path>
                                        </svg>
                                        Uploaded date - DESC

                                    </button>
                                    <button class="nkd-dropdown-item js-media-change-filter" data-type="sort_by"
                                            data-value="size-asc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 9l3 -3l3 3"></path>
                                            <path
                                                d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z"></path>
                                            <path
                                                d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z"></path>
                                            <path d="M17 6v12"></path>
                                        </svg>
                                        Size - ASC

                                    </button>
                                    <button class="nkd-dropdown-item js-media-change-filter" data-type="sort_by"
                                            data-value="size-desc">
                                        <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg"
                                             width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M5 5m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z"></path>
                                            <path
                                                d="M5 14m0 .5a.5 .5 0 0 1 .5 -.5h4a.5 .5 0 0 1 .5 .5v4a.5 .5 0 0 1 -.5 .5h-4a.5 .5 0 0 1 -.5 -.5z"></path>
                                            <path d="M14 15l3 3l3 -3"></path>
                                            <path d="M17 18v-12"></path>
                                        </svg>
                                        Size - DESC

                                    </button>
                                </div>
                            </div>

                            <div class="nkd-dropdown nkd-dropdown-actions">
                                <button class="nkd-btn nkd-disabled nkd-dropdown-toggle" type="button"
                                        disabled="disabled"
                                        data-bs-toggle="dropdown">
                                    <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5"></path>
                                        <path d="M11 11.5v-2a1.5 1.5 0 1 1 3 0v2.5"></path>
                                        <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5"></path>
                                        <path
                                            d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7a69.74 69.74 0 0 1 -.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47"></path>
                                    </svg>
                                    Actions
                                </button>

                                <div class="nkd-dropdown-menu">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nkd-media-wrapper nkd-w-100">
                <div class="column-item-grid">
                    <div class="media-grid">
                        <ul class="nkd-list-unstyled">
                            <li class="media-list-title up-one-level js-up-one-level">
                                <div class="media-item" data-context="__type__" title="Up one level">
                                    <div class="item-media-thumbnail">
                                        <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                             height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4"></path>
                                        </svg>
                                    </div>
                                    <div class="item-media-description">
                                        <div class="title">...</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="column-thumbnail p-0">
                    <div class="media-details" style="">
                        <div class="media-thumbnail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 8h.01"></path>
                                <path
                                    d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path>
                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                            </svg>
                        </div>
                        <div class="media-description"></div>
                    </div>
                </div>
            </div>
            @if(isset($isChoose) && $isChoose)
                @include("file-manager::action")
            @endif
        </div>
    </div>
</div>
<input type="file" multiple="multiple" class="d-none" tabindex="-1"
       style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
<div class="nkd-modal nkd-modal-blur nkd-fade" id="modal-create-item"
     data-update="{{ route('media.update') }}"
     data-action="{{ route('media.folder.create') }}">
    <div class="nkd-modal-dialog nkd-modal-dialog-centered">
        <div class="nkd-modal-content">
            <div class="nkd-modal-header">
                <h5 class="nkd-modal-title">Create Folder</h5>
                <button type="button" class="nkd-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="nkd-modal-body">
                <div class="nkd-mb-3 nkd-position-relative">
                    <div class="nkd-input-group">
                        <input class="nkd-form-control" type="text" name="name" id="name" placeholder="Folder name">
                        <button class="nkd-btn nkd-btn-primary js-create-folder" type="submit">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nkd-modal nkd-modal-blur nkd-fade" id="modal-rename-item"
     data-update="{{ route('media.update') }}">
    <div class="nkd-modal-dialog nkd-modal-dialog-centered">
        <div class="nkd-modal-content">
            <div class="nkd-modal-header">
                <h5 class="nkd-modal-title">Rename</h5>
                <button type="button" class="nkd-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="nkd-modal-body">
                <div class="nkd-mb-3 nkd-position-relative">
                    <div class="nkd-input-group">
                        <input class="nkd-form-control" type="text" name="name" id="name" placeholder="Folder name">
                        <button class="nkd-btn nkd-btn-primary js-update-folder" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nkd-modal nkd-modal-blur nkd-fade" id="modal-remove-item"
     data-action="{{ route('media.destroy') }}">
    <div class="nkd-modal-dialog nkd-modal-dialog-centered">
        <div class="nkd-modal-content">
            <div class="nkd-modal-header">
                <h5 class="nkd-modal-title">Move items to trash</h5>
                <button type="button" class="nkd-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="nkd-modal-body">
                <p>Are you sure you want to move these items to trash?</p>
            </div>
            <div class="nkd-modal-footer">
                <button type="button" class="nkd-btn nkd-btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nkd-btn nkd-btn-danger js-move-trash">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class="nkd-modal nkd-modal-blur nkd-fade" id="modal-upload-link"
     data-action="{{ route('media.file.uploadMultiple') }}">
    <div class="nkd-modal-dialog nkd-modal-dialog-centered">
        <div class="nkd-modal-content">
            <div class="nkd-modal-header">
                <h5 class="nkd-modal-title">
                    <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M7 11l5 5l5 -5"></path>
                        <path d="M12 4l0 12"></path>
                    </svg>
                    Download
                </h5>
                <button type="button" class="nkd-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="nkd-modal-body">
                <form action="{{ route('media.file.uploadMultiple') }}" method="post">
                    @csrf
                    <div class="nkd-mb-3">
                        <textarea name="url" class="nkd-form-control" id="url-upload"
                                  placeholder="http://example.com/image1.jpg"></textarea>
                        <small class="form-hint">Enter one URL per line.</small>
                    </div>
                    <button type="submit" class="nkd-btn nkd-w-100 nkd-btn-outline-primary js-confirm-upload">Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="nkd-modal nkd-modal-blur nkd-fade" id="modal-crop-image"
     data-action="{{ route('media.file.uploadMultiple') }}">
    <div class="nkd-modal-dialog nkd-modal-xl nkd-modal-dialog-centered">
        <form action="{{ route('media.file.uploadMultiple') }}" class="nkd-w-100" method="post">
            @csrf
            <div class="nkd-modal-content">
                <div class="nkd-modal-header">
                    <h5 class="nkd-modal-title">
                        <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M7 11l5 5l5 -5"></path>
                            <path d="M12 4l0 12"></path>
                        </svg>
                        Crop
                    </h5>
                    <button type="button" class="nkd-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="nkd-modal-body">
                    <div>
                        <input type="hidden" name="image_id">
                        <input type="hidden" name="crop_data">
                        <div class="nkd-row">
                            <div class="nkd-col-lg-9">
                                <div id="crop-image">

                                </div>
                            </div>
                            <div class="nkd-col-lg-3">
                                <div class="nkd-mt-3">
                                    <div class="nkd-mb-3 nkd-position-relative">
                                        <label class="nkd-form-label" for="dataHeight">
                                            Height
                                        </label>
                                        <input class="nkd-form-control" type="text" name="dataHeight" id="dataHeight">
                                    </div>
                                </div>
                                <div class="nkd-mt-3">
                                    <div class="nkd-mb-3 nkd-position-relative">
                                        <label class="nkd-form-label" for="dataWidth">
                                            Width
                                        </label>
                                        <input class="nkd-form-control" type="text" name="dataWidth" id="dataWidth">
                                    </div>
                                </div>
                                <label class="nkd-form-check">
                                    <input type="checkbox"
                                           id="aspectRatio"
                                           name="aspectRatio"
                                           class="nkd-form-check-input">
                                    <span class="nkd-form-check-label">
                                        Aspect ratio?
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nkd-modal-footer">
                    <button type="button" class="nkd-btn nkd-btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nkd-btn nkd-btn-danger js-confirm-crop">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/x-custom-template" id="file">
    <div class="media-details" style="">
        <div class="media-thumbnail">
            __icon__
        </div>
        <div class="media-description">
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Name</label>
                <span title="__name__">__name__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Full URL</label>
                <div class="nkd-input-group">
                    <input type="text" id="file_details_url" class="nkd-form-control"
                           value="__full_url__">
                    <button class="nkd-input-group-text nkd-btn nkd-btn-default js-btn-copy-to-clipboard" type="button"
                            data-clipboard-target="#file_details_url">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon nkd-icon-clipboard" width="24"
                             height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                            <path
                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Alt text</label>
                <span title="__alt__">__alt__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Width</label>
                <span title="__width__">__width__px</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Height</label>
                <span title="__height__">__height__px</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Size</label>
                <span title="__size__">__size__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Uploaded at</label>
                <span title="__uploaded__">__uploaded__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Modified at</label>
                <span title="__modified__">__modified__</span>
            </div>
        </div>
    </div>
</script>
<script type="text/x-custom-template" id="folder">
    <div class="media-details" style="">
        <div class="media-thumbnail">
            __icon__
        </div>
        <div class="media-description">
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Name</label>
                <span title="__name__">__name__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Uploaded at</label>
                <span title="__uploaded__">__uploaded__</span>
            </div>
            <div class="nkd-mb-3 media-name">
                <label class="nkd-form-label">Modified at</label>
                <span title="__modified__">__modified__</span>
            </div>
        </div>
    </div>
</script>

<script src="{{ asset('vendor/file-manager/assets/lib/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/lib/fslightbox/fslightbox.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/lib/cropper/cropper.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/js/CKMedia.js') }}"></script>
