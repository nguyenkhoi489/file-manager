<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="bg-light">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/lib/toastr/toastr.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('vendor/file-manager/assets/css/base.css') }}">
<div class="container-xl">
    <div class="nkd-media-container"
         data-breadcrumbs-count="1"
         data-ajax="{{ route('media.loadMedia') }}">
        <div class="nkd-media-main border border-1 rounded rounded-1 bg-white">
            <div class="card-header w-100 flex-column media-header p-0">
                <div
                    class="p-2 w-100 media-top-header flex-wrap gap-3 d-flex justify-content-between align-items-start border-bottom bg-body">
                    <div class="d-flex gap-2 justify-content-between w-md-auto media-actions">
                        <button class="btn btn-icon   d-flex d-md-none" type="button" data-bs-toggle="offcanvas"
                                href="#media-aside">
                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 6l16 0"></path>
                                <path d="M4 12l16 0"></path>
                                <path d="M4 18l16 0"></path>
                            </svg>

                        </button>
                        <div class="btn-list d-flex gap-2">
                            <div class="dropdown ">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                        <path d="M7 9l5 -5l5 5"></path>
                                        <path d="M12 4l0 12"></path>
                                    </svg>
                                    Upload

                                </button>

                                <div class="dropdown-menu" style="">
                                    <button class="dropdown-item js-dropzone-upload dz-clickable">
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

                                    <button class="dropdown-item js-download-action dropdown-item">
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

                            <button class="btn btn-icon btn-primary js-create-folder-action" type="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Create folder"
                                    data-bs-original-title="Create folder">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M12 19h-7a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v3.5"></path>
                                    <path d="M16 19h6"></path>
                                    <path d="M19 16v6"></path>
                                </svg>

                            </button>

                            <button class="btn btn-icon btn-primary  js-change-action" type="button" data-type="refresh"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"
                                    data-bs-original-title="Refresh">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                </svg>

                            </button>
                        </div>
                    </div>
                    <div class="media-search">
                        <form class="input-search-wrapper" action="" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search"
                                       placeholder="Search in current folder">
                                <button class="btn btn-icon" type="submit">
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
                        </form>
                    </div>
                </div>
                <div class="w-100 d-flex flex-wrap justify-content-between gap-3 p-2">
                    <div class="d-flex align-items-center media-breadcrumb">
                        <ul class="breadcrumb  mb-0">
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
                        class="d-flex justify-content-between justify-content-md-end align-items-center media-tools">
                        <div class="btn-list d-flex justify-content-between" role="group">
                            <div class="dropdown ">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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

                                <div class="dropdown-menu">
                                    <button class="dropdown-item js-media-change-filter" data-type="sort_by"
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
                                    <button class="dropdown-item js-media-change-filter active" data-type="sort_by"
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
                                    <button class="dropdown-item js-media-change-filter" data-type="sort_by"
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
                                    <button class="dropdown-item js-media-change-filter" data-type="sort_by"
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
                                    <button class="dropdown-item js-media-change-filter" data-type="sort_by"
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
                                    <button class="dropdown-item js-media-change-filter" data-type="sort_by"
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

                            <div class="dropdown dropdown-actions">
                                <button class="btn disabled dropdown-toggle" type="button" disabled="disabled"
                                        data-bs-toggle="dropdown">

                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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

                                <div class="dropdown-menu">
                                    <button class="dropdown-item js-files-action" data-action="copy_link">
            <span class="icon-tabler-wrapper dropdown-item-icon"><span class="icon-tabler-wrapper dropdown-item-icon"><svg
                        xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 15l6 -6"></path>
                    <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                    <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path>
                </svg></span></span>
                                        Copy link

                                    </button>

                                    <button class="dropdown-item js-files-action" data-action="rename">
            <span class="icon-tabler-wrapper dropdown-item-icon"><span class="icon-tabler-wrapper dropdown-item-icon"><svg
                        xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                    <path d="M16 5l3 3"></path>
                </svg></span></span>
                                        Rename

                                    </button>
                                    <button class="dropdown-item js-files-action" data-action="trash">
            <span class="icon-tabler-wrapper dropdown-item-icon"><span class="icon-tabler-wrapper dropdown-item-icon"><svg
                        xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 7l16 0"></path>
                    <path d="M10 11l0 6"></path>
                    <path d="M14 11l0 6"></path>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                </svg></span></span>
                                        Move to trash
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group js-media-change-view-type ms-2" role="group">
                            <button class="btn btn-icon active" type="button" data-type="tiles">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path
                                        d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path
                                        d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                    <path
                                        d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path>
                                </svg>

                            </button>
                            <button class="btn btn-icon" type="button" data-type="list">
                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                    <path
                                        d="M4 14m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
                                </svg>

                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row nkd-media-wrapper w-100">
                <div class="col-md-10">
                    <div class="media-grid">
                        <ul class="m-0 list-unstyled">
                            <li class="media-list-title up-one-level js-up-one-level">
                                <div class="media-item" data-context="__type__" title="Up one level">
                                    <div class="item-media-thumbnail">
                                        <svg class="icon icon-lg" xmlns="http://www.w3.org/2000/svg" width="24"
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
                <div class="col-md-2 column-thumbnail p-0">
                    <div class="media-details w-100" style="">
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
        </div>
    </div>
    <div class="modal fade" id="modal-rename-item"
         data-update="{{ route('media.update') }}"
         data-action="{{ route('media.folder.create') }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Create Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 position-relative">
                        <div class="input-group">
                            <input class="form-control" type="text" name="name" id="name" placeholder="Folder name">
                            <button class="btn btn-primary js-create-folder" type="submit">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-remove-item"
         data-action="{{ route('media.destroy') }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Move items to trash</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to move these items to trash?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger js-move-trash">Confirm</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/x-custom-template" id="file">

</script>
<script type="text/x-custom-template" id="folder">
    <div class="media-details w-100" style="">
        <div class="media-thumbnail">
            __icon__
        </div>
        <div class="media-description">
            <div class="mb-3 media-name">
                <label class="form-label">Name</label>
                <span title="__name__">__name__</span>
            </div>
            <div class="mb-3 media-name">
                <label class="form-label">Uploaded at</label>
                <span title="__uploaded__">__uploaded__</span>
            </div>
            <div class="mb-3 media-name">
                <label class="form-label">Modified at</label>
                <span title="__modified__">__modified__</span>
            </div>
        </div>
    </div>
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('vendor/file-manager/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/lib/toastr/toastr-setting.js') }}"></script>
<script src="{{ asset('vendor/file-manager/assets/js/media.js') }}"></script>
</body>
</html>
