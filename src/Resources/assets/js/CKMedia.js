var CKMedia = {
    basePath: `/file-manager`,
    config: {
        icons: {
            folder: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 8h.01"></path>
                                <path
                                    d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z"></path>
                                <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                            </svg>`,
            file: ''
        },
        actions: {
            detail: [
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 15l6 -6"></path>
                            <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                            <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path>
                        </svg>`,
                    name: 'Copy link',
                    action: 'copy_link',
                    order: 0,
                    class: 'js-action-copy-link',
                },
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>`,
                    name: 'Rename',
                    action: 'rename',
                    order: 1,
                    class: 'js-action-rename',
                },
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>`,
                    name: 'Move to trash',
                    action: 'trash',
                    order: 9,
                    class: 'js-action-move-to-trash',
                },
            ],
            file: [
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                            </svg>`,
                    name: 'Preview',
                    action: 'preview',
                    order: 0,
                    class: 'js-action-preview',
                },
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M8 5v10a1 1 0 0 0 1 1h10"></path>
                                <path d="M5 8h10a1 1 0 0 1 1 1v10"></path>
                            </svg>`,
                    name: 'Crop',
                    action: 'crop',
                    order: 1,
                    class: 'js-action-crop',
                },
                {
                    icon: `<svg xmlns="http://www.w3.org/2000/svg" class="nkd-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 8h.01"></path>
                                <path d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4"></path>
                                <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3"></path>
                                <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596"></path>
                                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>
                            </svg>`,
                    name: 'Alt text',
                    action: 'alt_text',
                    order: 3,
                    class: 'js-action-alt-text',
                },
            ]
        },
        limit: 30
    },

    __init() {
        this.$body = $('body');
        this.setupAjax()
        this.setupDropdownAction()
        this.container = $('.nkd-media-container')
        this.boxAction = $('.nkd-dropdown-actions')
        this.url = this.container.data('ajax')

        this.loadMedia()
        this.handleCommand()
        this.bindInsertCKEditorAction() //bind to insert action
        this.bindOpenToggleDropdown() //bind to open Toggle Dropdown
        this.bindRefreshLayout() //refresh layout
        this.bindResetAction()  // click background remove checked input
        this.bindActionClickFileAndFolder() //click to folder order file
        this.bindActionBackOrFolderClick() //click to back or folder
        this.bindActionCreateFolder() //show modal create folder
        this.bindActionConfirmCreateFolder() //action create folder
        this.bindActionCopyLink() //action copy link
        this.bindActionRenameModal() //action rename
        this.bindActionRenameConfirm() //action update folder name
        this.bindActionSort() //action sort
        this.bindActionMoveToTrashModal() //action move to trash
        this.bindActionMoveToTrashConfirm() //action confirm move to trash
        this.bindActionChangeAltModal() //action open changel alt modal
        this.bindActionChangeAltModalConfirm() //action confirm changel alt modal
        this.bindActionPreviewFiles() //action preview files
        this.bindActionSetupCrop() //action setup Crop
        this.bindActionSaveCrop() //action save Crop
        this.bindActionOpenModalUploadURL() //action open modal download image
        this.bindActionUploadByURL() //action upload image by url
        this.bindActionCopyLinkDetail() //action copy link detail
        this.bindActionTriggerFileUpload() //action trigger upload file
        this.bindActionUploadFile() //action upload file
        this.bindActionSearch()  //action search
        this.bindActionCloseModal() //action close modal
        this.bindActionDocumentActionBox() //action Document Close Box
    },

    setupAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="nkd-csrf-token"]').attr('value')
            }
        });
    },

    setupDropdownAction(list = ['detail']) {

        let config = []

        list.forEach(item => {
            config.push(CKMedia.config.actions[item])
        })
        let dropdown = Object.values(config)
            .reduce((acc, curr) => acc.concat(curr), [])
            .sort((a, b) => a.order - b.order);

        let _menusDropdown = CKMedia.$body.find('.nkd-dropdown-actions > .nkd-dropdown-menu')

        let html = ''

        dropdown.forEach(element => {
            html += `<button class="nkd-dropdown-item js-files-action ${element.class}"
                                        data-action="${element.action}">
                                        <span class="nkd-dropdown-item-icon">
                                            <span class="nkd-dropdown-item-icon">
                                                ${element.icon}
                                            </span>
                                        </span>
                                        ${element.name}
                                    </button>`
        })
        _menusDropdown.empty().append(html)

    },

    loading() {
        return `<div id="status_processing" class="processing card" role="status" ><div><div></div><div></div><div></div><div></div></div></div>`;
    },

    getSearchInput() {
        return $('.nkd-media-search').find('input').val();
    },

    getImageSize(size) {
        let units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB']
        let i = 0
        for (i; size > 1024; i++) {
            size /= 1024;
        }
        return size.toFixed(1) + ' ' + units[i]
    },

    getSortBy() {
        let detail = $('.js-media-change-filter.active');
        return detail.data('value')
    },

    getFolderID(prev = null) {
        let countBreadcrumbs = CKMedia.container.attr('data-breadcrumbs-count');
        let folder_id = 0
        if (countBreadcrumbs > 1) {
            let breadcrumb_item = CKMedia.container.find('ul.breadcrumb li')
            let folder = prev ? breadcrumb_item[countBreadcrumbs - 2] : breadcrumb_item[countBreadcrumbs - 1]
            folder_id = $(folder).find('a').data('folder');
        }
        return folder_id
    },

    getSelectedItems() {
        let selected = []

        $('[data-context=file] input[type=checkbox]:checked').each((index, el) => {
            let $box = $(el).closest('.js-media-list-title')
            let data = $box.data('item') || {}
            data.index_key = $box.index()
            selected.push(data)
        })

        return selected
    },

    setupCropAction(item) {
        let img = item.find('img')

        img.cropper("destroy");

        let aspectRatio = item.find('#aspectRatio')

        let options = {
            crop(event) {
                CKMedia.setupCropData(item, event.detail)
                CKMedia.setupCropDataWidth(item, event.detail.width)
                CKMedia.setupCropDataHeight(item, event.detail.height)
            }
        };
        aspectRatio.is(':checked') ? options.aspectRatio = 1 / 1 : '';

        img.cropper(options);


    },

    setupCropData(item, data) {
        item.find('input[name="crop_data"]').val(JSON.stringify(data))
    },

    setupCropDataWidth(item, width) {
        item.find('#dataWidth').val(width)
    },

    setupCropDataHeight(item, height) {
        item.find('#dataHeight').val(height)
    },

    handleResponseAction(response, modal) {
        modal.find('#status_processing').remove()
        if (response.success) {
            modal.removeClass('show')
            toastr.success(response.message);
            setTimeout(function () {
                CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, CKMedia.config.limit)
            }, 1000);
            return this;
        }
        toastr.error(response.message);
    },

    handleResponseError(response, modal) {
        modal.find('#status_processing').remove()

        let _response = response.responseJSON

        toastr.error(_response.message);
    },

    handleResetDropdown() {
        let button = CKMedia.boxAction.find('button.nkd-dropdown-toggle');
        let dropMenu = CKMedia.boxAction.find('.nkd-dropdown-menu');

        if (!button.hasClass('nkd-disabled')) {
            button.addClass('nkd-disabled');
            button.attr('disabled', 'disabled');
        }
        if (dropMenu.hasClass('show')) {
            dropMenu.removeClass('show');
        }
    },

    handleResetThumbColumn() {
        let thumb = `<div class="media-details" style="">
                        <div class="media-thumbnail">
                            ${CKMedia.config.icons.folder}
                        </div>
                        <div class="media-description"></div>
                    </div>`;
        $('.column-thumbnail').empty().append(thumb)
    },

    handleCreateBreadcrumbs(breadcrumbs) {
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
    },

    handleCreateItemElements(folder, file) {
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
                                    <img src="/uploads${item.permalink}?v=${new Date().getMilliseconds()}" alt="15">
                                </div>
                                <div class="item-media-description">
                                    <div class="title">${item.name}</div>
                                </div>
                            </div>
                        </li>`;
        })
        return html;
    },

    actionBoxToggle(element, add = false) {
        $('.nkd-dropdown-menu.show').removeClass('show')
        element.hasClass('show') ? element.removeClass('show') : (add ? element.addClass('show') : '');
        return this;
    },

    loadMedia(view_in = 'all', sort_by = this.getSortBy(), folder_id = this.getFolderID(), search = this.getSearchInput(), load_more = false, paged = 1, posts_per_page = CKMedia.config.limit) {
        $.ajax({
            url: CKMedia.url,
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
                CKMedia.container.append(CKMedia.loading())
            },
            success: function (response) {
                $(document).find('.nkd-media-container #status_processing').remove();
                CKMedia.handleResetThumbColumn();
                if (response.success) {
                    let breadcrumbs = CKMedia.handleCreateBreadcrumbs(response.data.breadcrumbs);

                    CKMedia.container.attr('data-breadcrumbs-count', response.data.breadcrumbs.length);
                    CKMedia.container.find(`ul.breadcrumb`)
                        .empty()
                        .append(breadcrumbs);
                    CKMedia.container.find('.media-grid > ul')
                        .empty()
                        .append(CKMedia.handleCreateItemElements(response.data.folders, response.data.files));
                }
            },
            error(error) {
                $(document).find('.nkd-media-container #status_processing').remove();
            }
        })
    },

    handleCreatePreviewFolder(element) {
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
    },

    handleCreatePreviewFile(element) {
        let template = $('#file').text()
        let $element = $(element)
        let itemData = $element.data('item')
        let image_path = window.origin + `/uploads${itemData.permalink}`
        let image = new Image()
        image.src = image_path
        image.onload = function () {
            let item = template
                .replaceAll('__icon__', `<img src="${image_path}" alt="${itemData.alt}">`)
                .replaceAll('__name__', itemData.name)
                .replaceAll('__full_url__', image_path)
                .replaceAll('__alt__', itemData.alt)
                .replaceAll('__width__', image.width)
                .replaceAll('__height__', image.height)
                .replaceAll('__size__', CKMedia.getImageSize(itemData.size))
                .replaceAll('__uploaded__', itemData.created_at)
                .replaceAll('__modified__', itemData.updated_at)

            $('.column-thumbnail').empty().append(item)
        }
    },

    getParameter(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);

        return (match && match.length > 1) ? match[1] : null;
    },

    handleCKEditorFile(_item) {
        let funcNum = this.getParameter('CKEditorFuncNum')
        if (funcNum) {
            if (typeof window.opener.CKEDITOR !== 'undefined') {

                let item = _item.detail[0]

                window.opener.CKEDITOR.tools.callFunction(funcNum, item.fileUrl, function () {

                    var dialog = this.getDialog();

                    if (dialog.getName() === 'image') {

                        var element = dialog.getContentElement('info', 'txtAlt');

                        if (element)
                            element.setValue(item.alt);
                    }

                });
                window.close();
            }
            return this;
        }
        window.close();
    },

    fileChosen(_files) {
        let allFiles = []
        Array.from(_files).forEach(element => {
            let parentItem = $(element).parent();
            let dataItem = JSON.parse(parentItem.attr('data-item'));
            let fileUrl = `/uploads${dataItem.permalink}`
            allFiles.push({
                fileUrl: fileUrl,
                alt: dataItem.alt,
                id: dataItem.id
            });
        })
        const event = new CustomEvent('files:choose', {detail: allFiles});
        document.dispatchEvent(event);
    },

    popup({width = 1200, height = 850, isMultiple = false, isChoose = true, onInit = null}) {
        let connectPath = `${this.basePath}?isMultiple=${isMultiple}&isChoose=${isChoose}`;
        let popupWindow = window.open(
            connectPath,
            "_blank",
            `menubar=1,resizable=1,width=${width},height=${height}`
        );

        if (typeof onInit === 'function') {
            popupWindow.onload = function () {
                if (typeof onInit === 'function') {
                    const eventEmitter = {
                        on(eventName, callback) {
                            popupWindow.document.addEventListener(eventName, (e) => {
                                callback(Array.from(e.detail));
                            });
                        }
                    };
                    onInit(eventEmitter);
                }
            };
        }
    },

    bindRefreshLayout() {
        $(document).on('click', 'button[data-type="refresh"]', function (e) {
            e.preventDefault();
            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, CKMedia.config.limit)
        })
    },

    bindResetAction() {
        $(document).on('click', '.column-item-grid', function (e) {
            e.preventDefault();
            $('.media-list-title input').prop('checked', false);
            CKMedia.handleResetDropdown();
            CKMedia.handleResetThumbColumn()
        })
    },

    bindActionClickFileAndFolder() {
        $(document).on('click', 'li[data-context="folder"],li[data-context="file"]', function (e) {
            e.stopPropagation()
            e.preventDefault();
            let $this = $(this);
            let input = $this.find('input');
            let isMultiple = CKMedia.getParameter('isMultiple')

            $this.data('context') === 'file' ? CKMedia.setupDropdownAction(['detail', 'file']) : CKMedia.setupDropdownAction(['detail']);

            if (!isMultiple || isMultiple === 'false') {
                $('.media-list-title input').prop('checked', false);

                input.prop('checked', true)

                let button = CKMedia.boxAction.find('button.nkd-dropdown-toggle');

                if (button.hasClass('nkd-disabled')) {
                    button.removeClass('nkd-disabled');
                    button.removeAttr('disabled');
                }
                $(this).data('context') === 'file' ?
                    CKMedia.handleCreatePreviewFile($(this)) :
                    CKMedia.handleCreatePreviewFolder($(this))

                return this;
            }
            input.is(':checked') ? input.prop('checked', false) : input.prop('checked', true);
            return this;
        })
    },

    bindActionBackOrFolderClick() {
        $(document).on('dblclick', 'li[data-context="folder"],.js-up-one-level', function (e) {
            e.preventDefault();
            let folder_id = $(this).data('id');
            folder_id = typeof folder_id !== 'undefined' ? folder_id : CKMedia.getFolderID(true)
            CKMedia.handleResetDropdown();
            CKMedia.handleResetThumbColumn()
            CKMedia.loadMedia('all', CKMedia.getSortBy(), folder_id, CKMedia.getSearchInput(), false, 1, CKMedia.config.limit)
        })
    },

    bindActionCreateFolder() {
        $(document).on('click', '.js-create-folder-action', function (e) {
            e.preventDefault();
            let modal = $('#modal-create-item')
            modal.addClass('show')
        })
    },

    bindActionConfirmCreateFolder() {
        $(document).on('click', '.js-create-folder', function (e) {
            e.preventDefault();

            let modal = $(this).closest('#modal-create-item')
            let name = $(this).parent().find('input[name="name"]').val()
            $.ajax({
                url: modal.data('action'),
                data: {
                    'parent_id': CKMedia.getFolderID(),
                    'name': name,
                },
                method: 'POST',
                beforeSend: function () {
                    modal.find('.nkd-modal-content').append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(response, modal)
                }
            })
        })

    },

    bindActionCopyLink() {
        $(document).on('click', '.js-files-action[data-action="copy_link"]', function (e) {
            e.preventDefault();

            let item = CKMedia.getSelectedItems()

            let permalink = window.origin + '/uploads/' + item[0].permalink;

            var $temp = $("<input>");

            $("body").append($temp);

            $temp.val(permalink).select();

            document.execCommand("copy");

            $temp.remove();

            toastr.success('These links have been copied to clipboard')
        })
    },

    bindActionRenameModal() {
        $(document).on('click', '.js-files-action[data-action="rename"]', function (e) {
            e.preventDefault();

            let dataItem = CKMedia.getSelectedItems()[0]

            let modal = $('#modal-rename-item')

            let type = !'folder_id' in dataItem

            modal.find('input').val(dataItem.name)


            modal.attr('data-id', dataItem.id)

            modal.attr('data-folder', type)

            modal.addClass('show')
        })
    },

    bindActionRenameConfirm() {
        $(document).on('click', '.js-update-folder', function (e) {
            e.preventDefault();

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
                    modal.find('.nkd-modal-content').append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(response, modal)
                }
            })
        })
    },

    bindActionSort() {
        $(document).on('click', '.js-media-change-filter', function (e) {

            e.preventDefault();

            $('.js-media-change-filter.active').removeClass('active')

            $(this).addClass('active')

            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, CKMedia.config.limit)
        })
    },

    bindActionMoveToTrashModal() {
        $(document).on('click', '.js-files-action[data-action="trash"]', function (e) {
            e.preventDefault();

            let dataItem = CKMedia.getSelectedItems()[0]

            let modal = $('#modal-remove-item')

            let type = !'folder_id' in dataItem

            modal.attr('data-id', dataItem.id)

            modal.attr('data-folder', type)

            modal.addClass('show')
        })
    },

    bindActionMoveToTrashConfirm() {
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
                    modal.find('.nkd-modal-content').append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(response, modal)
                }
            })
        })
    },

    bindActionChangeAltModal() {
        $(document).on('click', '.js-files-action[data-action="alt_text"]', function (e) {
            e.preventDefault();

            let dataItem = CKMedia.getSelectedItems()[0]

            let modal = $('#modal-change-alt-item')

            let type = !'folder_id' in dataItem

            modal.find('input[name="id"]').val(dataItem.id)

            modal.find('input[name="alt"]').val(dataItem.alt)

            modal.addClass('show')
        })
    },

    bindActionChangeAltModalConfirm() {
        $(document).on('submit', '#modal-change-alt-item form', function (e) {

            e.preventDefault();

            let __self = $(this)
            let modal = __self.closest('.nkd-modal')

            $.ajax({
                url: __self.attr('action'),
                data: __self.serialize(),
                type: 'POST',
                beforeSend: function () {
                    modal.append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(error, modal)
                }
            })
        })
    },

    bindActionPreviewFiles() {
        $(document).on('click', '.js-files-action[data-action="preview"]', function (e) {
            let dataItem = CKMedia.getSelectedItems()[0]
            let lightbox = new FsLightbox();
            lightbox.props.sources = [`${window.origin}/uploads${dataItem.permalink}`];
            lightbox.open();
        })
    },

    bindActionSetupCrop() {
        $(document).on('click', '.js-files-action[data-action="crop"]', function (e) {
            e.preventDefault();
            let dataItem = CKMedia.getSelectedItems()[0]
            let modal = CKMedia.$body.find('#modal-crop-image')
            modal.find('#crop-image').empty().append(`<img id="image" class="nkd-w-100" src="${window.origin}/uploads${dataItem.permalink}" />`)
            modal.find('input[name="image_id"]').val(dataItem.id)

            CKMedia.setupCropAction(modal)
            modal.addClass('show')
        })

        $(document).on('click', '.js-action-aspect', function (e) {
            e.preventDefault();
            let __self = $(this)
            let modal = __self.closest('.nkd-modal')
            let input = __self.find('input')

            input.is(':checked') ? input.prop('checked', false) : input.prop('checked', true)
            console.log(`setup: ${input.is(':checked')}`)

            CKMedia.setupCropAction(modal)
        })


    },

    bindActionSaveCrop() {
        $(document).on('submit', '#modal-crop-image > div > form', function (e) {

            e.preventDefault();
            let __self = $(this)
            let modal = __self.closest('.nkd-modal')

            $.ajax({
                url: __self.attr('action'),
                data: __self.serialize(),
                type: 'POST',
                beforeSend: function () {
                    modal.append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(error, modal)
                }
            })
        })

    },

    bindActionOpenModalUploadURL() {
        $(document).on('click', '.js-download-action', function (e) {
            e.preventDefault();
            let modal = $($(this).attr('data-bs-target'))

            if (modal && !modal.hasClass('show')) {
                modal.addClass('show')
                return this
            }
        })
    },

    bindActionUploadByURL() {
        $(document).on('submit', '#modal-upload-link form', function (e) {

            e.preventDefault()

            let $this = $(this)

            let modal = $this.closest('#modal-upload-link');

            let folderId = CKMedia.getFolderID()

            $this.append(`<input type="hidden" name="folderId" value="${folderId}">`);

            $.ajax({
                url: $this.attr('action'),
                data: $this.serialize(),
                method: $this.attr('method'),
                beforeSend: function () {
                    modal.append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, modal)
                },
                error: function (error) {
                    CKMedia.handleResponseError(response, modal)
                }
            })
        })
    },

    bindActionCopyLinkDetail() {
        $(document).on('click', '.js-btn-copy-to-clipboard', function (e) {
            e.preventDefault();

            let parent = $(this).parent()

            let target = parent.find(`${$(this).data('clipboard-target')}`).select()

            document.execCommand("copy");

            toastr.success('These links have been copied to clipboard')
        })
    },

    bindActionTriggerFileUpload() {
        $(document).on('click', '.js-button-upload', function (e) {
            e.preventDefault();
            $('.nkd-media-container input[type="file"]').click()
        })
    },

    bindActionUploadFile() {
        $(document).on('change', '.nkd-media-container input[type="file"]', function (e) {
            e.preventDefault();
            let container = $(document).find('.nkd-media-container');
            let $this = $(this)
            console.log($this[0].files)
            let form = new FormData()
            Array.from($this[0].files).forEach(item => {

                form.append('files[]', item)
            })

            form.append('folderId', CKMedia.getFolderID())

            $.ajax({
                url: container.attr('data-upload'),
                data: form,
                type: 'post',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    container.append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.handleResponseAction(response, container)
                },
                error: function (error) {
                    CKMedia.handleResponseError(response, modal)
                }
            })
        })
    },

    bindActionSearch() {
        $(document).on('click', '.js-search-action', function (e) {
            e.preventDefault();
            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, CKMedia.config.limit)
        })
    },

    bindActionCloseModal() {
        $(document).on('click', '.nkd-btn-close', function (e) {
            e.preventDefault();
            let modal = $(this).closest('.nkd-modal')

            if (modal.hasClass('show')) {
                modal.removeClass('show')
                return this
            }
        })
    },

    bindOpenToggleDropdown() {
        $(document).on('click', '.nkd-dropdown-toggle', function (e) {
            e.preventDefault()
            e.stopPropagation()
            let $this = $(this)
            let actionBox = $this.parent().find('.nkd-dropdown-menu')

            $this.hasClass('show') ? $this.removeClass('show') : $this.addClass('show');

            CKMedia.actionBoxToggle(actionBox, true)

        })
    },

    bindInsertCKEditorAction() {
        $(document).on('click', '.js-insert-media', function (e) {
            e.preventDefault();
            let inputChecked = $('[data-context="file"] input:checked');
            if (!inputChecked.length) {
                return false;
            }
            CKMedia.fileChosen(inputChecked)
        });
    },

    bindActionDocumentActionBox() {
        $(document).on('click', function (e) {
            CKMedia.actionBoxToggle($('.nkd-dropdown-menu'))
        })
    },

    handleCommand() {
        $(document).on('files:choose', function (files) {
            CKMedia.handleCKEditorFile(files);
        })
    }

}

CKMedia.__init()

