jQuery(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="nkd-csrf-token"]').attr('content')
        }
    });

    const $loading = `<div id="status_processing" class="processing card" role="status" ><div><div></div><div></div><div></div><div></div></div></div>`;

    let boxActions = $('.nkd-dropdown-actions').find('button.nkd-dropdown-toggle')

    let url = $('.nkd-media-container').data('ajax')

    const getSearchInput = () => {
        return $('.nkd-media-search').find('input').val();
    }
    const responseAction = (response, modal) => {
        modal.find('#status_processing').remove()

        if (response.success) {

            modal.removeClass('show')

            toastr.success(response.message);

            setTimeout(function () {
                loadMedia('all', getSortBy(), getFolderID(), getSearchInput(), false, 1, 30)
            }, 1000);
            return this;
        }
        toastr.error(response.message);
    }
    const getImageSize = (size) => {
        let units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB']

        let i = 0

        for (i; size > 1024; i++) {
            size /= 1024;
        }

        return size.toFixed(1) + ' ' + units[i]
    }
    const getSortBy = () => {
        let detail = $('.js-media-change-filter.active');
        return detail.data('value')
    }
    const getFolderID = (prev = null) => {
        let closets = $('.nkd-media-container');
        let countBreadcrumbs = closets.attr('data-breadcrumbs-count');
        let folder_id = 0
        if (countBreadcrumbs > 1) {
            let breadcrumb_item = closets.find('ul.breadcrumb li')
            let folder = prev ? breadcrumb_item[countBreadcrumbs - 2] : breadcrumb_item[countBreadcrumbs - 1]
            folder_id = $(folder).find('a').data('folder');
        }
        return folder_id
    }
    const restAction = () => {
        if (!boxActions.hasClass('nkd-disabled')) {
            boxActions.addClass('nkd-disabled');
            boxActions.attr('disabled', 'disabled');
        }
    }
    const resetThumbColumn = () => {
        let thumb = `<div class="media-details" style="">
                        <div class="media-thumbnail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24"
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
                    </div>`;
        $('.column-thumbnail').empty().append(thumb)
    }
    const createBreadcrumbs = (breadcrumbs) => {
        let bread = Array.from(breadcrumbs)
        let html = '';
        bread.forEach(item => {
            html += `<li>
                        <a href="#" data-folder="${item.id}" class="nkd-text-decoration-none js-change-folder">
                                ${item.icon}
                               ${item.name}
                        </a>
                    </li>`;
        })
        return html;
    }
    const createItemElements = (folder, file) => {
        let listItemFolders = Array.from(folder)
        let listItemFiles = Array.from(file)
        let html = `<li class="media-list-title up-one-level js-up-one-level" >
                                <div class="media-item" data-context="__type__" title="Up one level">
                                    <div class="item-media-thumbnail">
                                        <svg class="nkd-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4"></path>
                                        </svg>
                                    </div>
                                    <div class="item-media-description">
                                        <div class="title">...</div>
                                    </div>
                                </div>
                            </li>`;
        listItemFolders.forEach(item => {
            html += `<li class="media-list-title js-media-list-title js-context-menu" data-item='${JSON.stringify(item)}' data-context="folder" data-id="${item.id}">
                            <input type="checkbox" class="hidden">
                            <div class="media-item" title="members">
                                <span class="item-media-item-selected">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                    </svg>
                                </span>
                                <div class="item-media-thumbnail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2"></path>
                                    </svg>
                                </div>
                                <div class="item-media-description">
                                    <div class="title">${item.name}</div>
                                </div>
                            </div>
                        </li>`;
        })
        listItemFiles.forEach(item => {
            html += `<li class="media-list-title js-media-list-title js-context-menu" data-item='${JSON.stringify(item)}'  data-context="file" data-id="${item.id}">
                            <input type="checkbox" class="hidden">
                            <div class="media-item" title="members">
                                <span class="item-media-item-selected">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                    </svg>
                                </span>
                                <div class="item-media-thumbnail">
                                    <img src="/uploads/${item.permalink}" alt="15">
                                </div>
                                <div class="item-media-description">
                                    <div class="title">${item.name}</div>
                                </div>
                            </div>
                        </li>`;
        })

        return html;
    }
    const actionBoxToggle = (element,add = false) => {
        $('.nkd-dropdown-menu.show').removeClass('show')
        element.hasClass('show') ? element.removeClass('show') : (add ? element.addClass('show') : '');
        return this;
    }
    const loadMedia = (
        view_in = 'all',
        sort_by = getSortBy(),
        folder_id = getFolderID(),
        search = getSearchInput(),
        load_more = false,
        paged = 1,
        posts_per_page = 30
    ) => {
        $.ajax({
            url: url,
            data: {
                view_in,
                sort_by,
                folder_id,
                search,
                load_more,
                paged,
                posts_per_page
            },
            beforeSend: function () {
                $(document).find('.nkd-media-container').append($loading)
            },
            success: function (response) {
                $(document).find('.nkd-media-container #status_processing').remove();
                resetThumbColumn();
                if (response.success) {
                    let container = $('.nkd-media-container');
                    let breadcrumbs = createBreadcrumbs(response.data.breadcrumbs);

                    container.attr('data-breadcrumbs-count', response.data.breadcrumbs.length);
                    container.find(`ul.breadcrumb`).empty().append(breadcrumbs);
                    container.find('.media-grid > ul').empty().append(createItemElements(response.data.folders, response.data.files));
                }
            },
            error(error) {
                $(document).find('.nkd-media-container #status_processing').remove();
            }
        })
    }
    loadMedia()

    const createPreviewFolder = (element) => {
        let template = $('#folder').text()
        let $element = $(element)
        let itemData = $element.data('item')
        let icon = $element.find('.item-media-thumbnail').html()
        let item = template
            .replaceAll('__icon__', icon)
            .replaceAll('__name__', itemData.name)
            .replaceAll('__uploaded__', itemData.created_at)
            .replaceAll('__modified__', itemData.updated_at)

        $('.column-thumbnail').empty().append(item)

    }
    const createPreviewFile = async (element) => {
        let template = $('#file').text()
        let $element = $(element)
        let itemData = $element.data('item')
        let image_path = window.origin + `/uploads/${itemData.permalink}`
        const image = new Image()
        image.src = image_path

        let item = template
            .replaceAll('__icon__', `<img src="${image_path}" alt="${itemData.alt}">`)
            .replaceAll('__name__', itemData.name)
            .replaceAll('__full_url__', image_path)
            .replaceAll('__alt__', itemData.alt)
            .replaceAll('__width__', image.width)
            .replaceAll('__height__', image.height)
            .replaceAll('__size__', getImageSize(itemData.size))
            .replaceAll('__uploaded__', itemData.created_at)
            .replaceAll('__modified__', itemData.updated_at)

        $('.column-thumbnail').empty().append(item)
    }

    //refresh
    $(document).on('click', 'button[data-type="refresh"]', function (e) {
        e.preventDefault();
        loadMedia('all', getSortBy(), getFolderID(), getSearchInput(), false, 1, 30)
    })

    //click background remove checked input
    $(document).on('click', '.column-item-grid', function (e) {
        e.preventDefault();
        $('.media-list-title input').prop('checked', false);
        restAction();
        resetThumbColumn()
    })

    //click to folder order file
    $(document).on('click', 'li[data-context="folder"],li[data-context="file"]', function (e) {
        e.stopPropagation()
        e.preventDefault();
        let $this = $(this);
        let input = $this.find('input');
        $('.media-list-title input').prop('checked', false);

        input.prop('checked', true)
        if (boxActions.hasClass('nkd-disabled')) {
            boxActions.removeClass('nkd-disabled');
            boxActions.removeAttr('disabled');
        }
        $(this).data('context') === 'file' ? createPreviewFile($(this)) : createPreviewFolder($(this))
    })

    //click to back or folder
    $(document).on('dblclick', 'li[data-context="folder"],.js-up-one-level', function (e) {
        e.preventDefault();
        let folder_id = $(this).data('id');
        folder_id = typeof folder_id !== 'undefined' ? folder_id : getFolderID(true)
        restAction()
        loadMedia('all', getSortBy(), folder_id, getSearchInput(), false, 1, 30)
    })

    //show modal create folder
    $(document).on('click', '.js-create-folder-action', function (e) {
        e.preventDefault();
        let modal = $('#modal-create-item')
        modal.addClass('show')
    })

    //action create folder
    $(document).on('click', '.js-create-folder', function (e) {
        e.preventDefault();

        let modal = $(this).closest('#modal-create-item')
        let name = $(this).parent().find('input[name="name"]').val()
        $.ajax({
            url: modal.data('action'),
            data: {
                'parent_id': getFolderID(),
                'name': name,
            },
            method: 'POST',
            beforeSend: function () {
                modal.find('.nkd-modal-content').append($loading)
            },
            success: function (response) {
                responseAction(response, modal)
            }
        })
    })

    //action copy link
    $(document).on('click', '.js-files-action[data-action="copy_link"]', function (e) {
        e.preventDefault();

        let inputChecked = $('.media-list-title input:checked');

        let parentItem = inputChecked.parent()

        let dataItem = parentItem.data('item')

        let permalink = window.origin + '/uploads/' + dataItem.permalink;

        var $temp = $("<input>");

        $("body").append($temp);

        $temp.val(permalink).select();

        document.execCommand("copy");

        $temp.remove();

        toastr.success('These links have been copied to clipboard')
    })

    //action rename
    $(document).on('click', '.js-files-action[data-action="rename"]', function (e) {
        e.preventDefault();

        let inputChecked = $('.media-list-title input:checked');

        let parentItem = inputChecked.parent()

        let dataItem = parentItem.data('item')

        let modal = $('#modal-rename-item')

        let type = !'folder_id' in dataItem

        modal.find('input').val(dataItem.name)

        console.log(type)
        modal.attr('data-id', dataItem.id)

        modal.attr('data-folder', type)

        modal.addClass('show')
    })

    //action update folder name
    $(document).on('click', '.js-update-folder', function (e) {
        e.preventDefault();

        let inputChecked = $('.media-list-title input:checked');

        let parentItem = inputChecked.parent()

        let dataItem = parentItem.data('item')

        let modal = $(this).closest('#modal-rename-item')
        let name = modal.find('input').val()
        let id = modal.attr('data-id')
        let type = modal.attr('data-folder')
        $.ajax({
            url: modal.data('update'),
            data: {
                'id': id,
                'name': name,
                'is_folder': type
            },
            method: 'POST',
            beforeSend: function () {
                modal.find('.nkd-modal-content').append($loading)
            },
            success: function (response) {
                responseAction(response, modal)
            }
        })
    })

    //action sort
    $(document).on('click', '.js-media-change-filter', function (e) {

        e.preventDefault();

        $('.js-media-change-filter.active').removeClass('active')

        $(this).addClass('active')

        loadMedia('all', getSortBy(), getFolderID(), getSearchInput(), false, 1, 30)
    })

    //action move to trash
    $(document).on('click', '.js-files-action[data-action="trash"]', function (e) {
        e.preventDefault();

        let inputChecked = $('.media-list-title input:checked');

        let parentItem = inputChecked.parent()

        let dataItem = parentItem.data('item')

        let modal = $('#modal-remove-item')

        let type = !'folder_id' in dataItem
        modal.attr('data-id', dataItem.id)

        modal.attr('data-folder', type)

        modal.addClass('show')
    })

    //action confirm move to trash
    $(document).on('click', '.js-move-trash', function (e) {

        e.preventDefault();

        let modal = $(this).closest('#modal-remove-item')

        let id = modal.attr('data-id')

        let type = modal.attr('data-folder')

        $.ajax({
            url: modal.data('action'),
            data: {
                'id': id,
                'is_folder': type,
                '_method': 'delete'
            },
            method: 'POST',
            beforeSend: function () {
                modal.find('.nkd-modal-content').append($loading)
            },
            success: function (response) {
                responseAction(response, modal)
            }
        })
    })

    //action upload image by url
    $(document).on('submit', '#modal-upload-link form', function (e) {

        e.preventDefault()

        let $this = $(this)

        let modal = $this.closest('#modal-upload-link');

        let folderId = getFolderID()

        $this.append(`<input type="hidden" name="folderId" value="${folderId}">`);

        $.ajax({
            url: $this.attr('action'),
            data: $this.serialize(),
            method: $this.attr('method'),
            beforeSend: function () {
                modal.append($loading)
            },
            success: function (response) {
                responseAction(response, modal)
            }
        })
    })

    //action copy link
    $(document).on('click', '.js-btn-copy-to-clipboard', function (e) {
        e.preventDefault();

        let parent = $(this).parent()

        let target = parent.find(`${$(this).data('clipboard-target')}`).select()

        document.execCommand("copy");

        toastr.success('These links have been copied to clipboard')
    })

    //action copy link
    $(document).on('click', '.js-button-upload', function (e) {
        e.preventDefault();
        $('input[type="file"]').click()
    })

    //action upload file
    $(document).on('change', 'input[type="file"]', function (e) {
        e.preventDefault();
        let container = $(document).find('.nkd-media-container');
        let $this = $(this)
        console.log($this[0].files)
        let form = new FormData()
        Array.from($this[0].files).forEach(item => {

            form.append('files[]', item)
        })

        form.append('folderId', getFolderID())

        $.ajax({
            url: container.attr('data-upload'),
            data: form,
            type: 'post',
            contentType: false,
            processData: false,
            beforeSend: function () {
                container.append($loading)
            },
            success: function (response) {
                responseAction(response, container)
            }
        })
    })

    //action copy link
    $(document).on('click', '.js-search-action', function (e) {
        e.preventDefault();
        loadMedia('all', getSortBy(), getFolderID(), getSearchInput(), false, 1, 30)
    })

    //action close modal
    $(document).on('click', '.nkd-btn-close', function (e) {
        e.preventDefault();
        let modal = $(this).closest('.nkd-modal')

        if (modal.hasClass('show')) {
            modal.removeClass('show')
            return this
        }

    })
    $(document).on('click', function (e) {
        actionBoxToggle($('.nkd-dropdown-menu'))
    })
    //action open toggle
    $(document).on('click', '.nkd-dropdown-toggle', function (e) {
        e.preventDefault()
        e.stopPropagation()
        let $this = $(this)
        let actionBox = $this.parent().find('.nkd-dropdown-menu')

        $this.hasClass('show') ? $this.removeClass('show') : $this.addClass('show');

        actionBoxToggle(actionBox,true)

    })

})
