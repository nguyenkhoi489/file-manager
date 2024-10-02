
var CKMedia = {
    basePath: `/file-manager`,
    __init() {
        this.setAjax()
        this.container = $('.nkd-media-container')
        this.boxAction = $('.nkd-dropdown-actions').find('button.nkd-dropdown-toggle')
        this.url = this.container.data('ajax')

        this.loadMedia()
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
        this.bindActionOpenModalUploadURL() //action open modal download image
        this.bindActionUploadByURL() //action upload image by url
        this.bindActionCopyLinkDetail() //action copy link detail
        this.bindActionTriggerFileUpload() //action trigger upload file
        this.bindActionUploadFile() //action upload file
        this.bindActionSearch()  //action search
        this.bindActionCloseModal() //action close modal
        this.bindActionDocumentActionBox() //action Document Close Box
    },
    setAjax(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="nkd-csrf-token"]').attr('value')
            }
        });
    },
    loading() {
        return `<div id="status_processing" class="processing card" role="status" ><div><div></div><div></div><div></div><div></div></div></div>`;
    },
    getSearchInput() {
        return $('.nkd-media-search').find('input').val();
    },
    responseAction(response, modal) {
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
    restAction() {
        if (!CKMedia.boxAction.hasClass('nkd-disabled')) {
            CKMedia.boxAction.addClass('nkd-disabled');
            CKMedia.boxAction.attr('disabled', 'disabled');
        }
    },
    resetThumbColumn() {
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
    },
    createBreadcrumbs(breadcrumbs) {
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
    createItemElements(folder, file) {
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
    },
    actionBoxToggle(element, add = false) {
        $('.nkd-dropdown-menu.show').removeClass('show')
        element.hasClass('show') ? element.removeClass('show') : (add ? element.addClass('show') : '');
        return this;
    },
    loadMedia(view_in = 'all', sort_by = this.getSortBy(), folder_id = this.getFolderID(), search = this.getSearchInput(), load_more = false, paged = 1, posts_per_page = 30) {
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
                CKMedia.resetThumbColumn();
                if (response.success) {
                    let breadcrumbs = CKMedia.createBreadcrumbs(response.data.breadcrumbs);

                    CKMedia.container.attr('data-breadcrumbs-count', response.data.breadcrumbs.length);
                    CKMedia.container.find(`ul.breadcrumb`).empty().append(breadcrumbs);
                    CKMedia.container.find('.media-grid > ul').empty().append(CKMedia.createItemElements(response.data.folders, response.data.files));
                }
            },
            error(error) {
                $(document).find('.nkd-media-container #status_processing').remove();
            }
        })
    },
    createPreviewFolder(element) {
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
    createPreviewFile(element) {
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
            .replaceAll('__size__', CKMedia.getImageSize(itemData.size))
            .replaceAll('__uploaded__', itemData.created_at)
            .replaceAll('__modified__', itemData.updated_at)

        $('.column-thumbnail').empty().append(item)
    },
    getParameter(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);

        return (match && match.length > 1) ? match[1] : null;
    },
    handleCKEditorFile(item) {
        if (typeof window.opener.CKEDITOR !== 'undefined') {

            let funcNum = this.getParameter('CKEditorFuncNum')

            let dataItem = JSON.parse($(item).attr('data-item'))

            let fileUrl = `${window.origin}/uploads/${dataItem.permalink}`

            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl, function () {

                var dialog = this.getDialog();

                if (dialog.getName() === 'image') {

                    var element = dialog.getContentElement('info', 'txtAlt');

                    if (element)
                        element.setValue(dataItem.alt);
                }

            });
            window.close();
        }
    },
    popup({width = 400, height = 250, isMultiple = false}) {
        let connectPath = `${this.basePath}?isMultiple=${isMultiple}`;
        window.open(
            connectPath,
            "mywindow",
            `menubar=1,resizable=1,width=${width},height=${height}`);
    },
    bindRefreshLayout() {
        $(document).on('click', 'button[data-type="refresh"]', function (e) {
            e.preventDefault();
            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, 30)
        })
    },
    bindResetAction() {
        $(document).on('click', '.column-item-grid', function (e) {
            e.preventDefault();
            $('.media-list-title input').prop('checked', false);
            CKMedia.restAction();
            CKMedia.resetThumbColumn()
        })
    },
    bindActionClickFileAndFolder() {
        $(document).on('click', 'li[data-context="folder"],li[data-context="file"]', function (e) {
            e.stopPropagation()
            e.preventDefault();
            let $this = $(this);
            let input = $this.find('input');
            let isMultiple = CKMedia.getParameter('isMultiple')

            if (!isMultiple) {
                $('.media-list-title input').prop('checked', false);

                input.prop('checked', true)
                if (CKMedia.boxAction.hasClass('nkd-disabled')) {
                    CKMedia.boxAction.removeClass('nkd-disabled');
                    CKMedia.boxAction.removeAttr('disabled');
                }
                $(this).data('context') === 'file' ? CKMedia.createPreviewFile($(this)) : CKMedia.createPreviewFolder($(this))

                return this;
            }
            input.prop('checked', true)
            return this;
        })
    },
    bindActionBackOrFolderClick(){
        $(document).on('dblclick', 'li[data-context="folder"],.js-up-one-level', function (e) {
            e.preventDefault();
            let folder_id = $(this).data('id');
            folder_id = typeof folder_id !== 'undefined' ? folder_id : CKMedia.getFolderID(true)
            CKMedia.bindResetAction()
            CKMedia.loadMedia('all',CKMedia.getSortBy(), folder_id, CKMedia.getSearchInput(), false, 1, 30)
        })
    },
    bindActionCreateFolder(){
        $(document).on('click', '.js-create-folder-action', function (e) {
            e.preventDefault();
            let modal = $('#modal-create-item')
            modal.addClass('show')
        })
    },
    bindActionConfirmCreateFolder(){
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
                    CKMedia.responseAction(response, modal)
                }
            })
        })

    },
    bindActionCopyLink(){
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
    },
    bindActionRenameModal(){
        $(document).on('click', '.js-files-action[data-action="rename"]', function (e) {
            e.preventDefault();

            let inputChecked = $('.media-list-title input:checked');

            let parentItem = inputChecked.parent()

            let dataItem = parentItem.data('item')

            let modal = $('#modal-rename-item')

            let type = !'folder_id' in dataItem

            modal.find('input').val(dataItem.name)


            modal.attr('data-id', dataItem.id)

            modal.attr('data-folder', type)

            modal.addClass('show')
        })
    },
    bindActionRenameConfirm(){
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
                    modal.find('.nkd-modal-content').append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.responseAction(response, modal)
                }
            })
        })
    },
    bindActionSort(){
        $(document).on('click', '.js-media-change-filter', function (e) {

            e.preventDefault();

            $('.js-media-change-filter.active').removeClass('active')

            $(this).addClass('active')

            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, 30)
        })
    },
    bindActionMoveToTrashModal(){
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
    },
    bindActionMoveToTrashConfirm(){
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
                    CKMedia.responseAction(response, modal)
                }
            })
        })
    },
    bindActionOpenModalUploadURL(){
        $(document).on('click', '.js-download-action', function (e) {
            e.preventDefault();
            let modal = $($(this).attr('data-bs-target'))

            if (modal && !modal.hasClass('show')) {
                modal.addClass('show')
                return this
            }
        })
    },
    bindActionUploadByURL(){
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
                    modal.append(CKMedia.loading())
                },
                success: function (response) {
                    CKMedia.responseAction(response, modal)
                }
            })
        })
    },
    bindActionCopyLinkDetail(){
        $(document).on('click', '.js-btn-copy-to-clipboard', function (e) {
            e.preventDefault();

            let parent = $(this).parent()

            let target = parent.find(`${$(this).data('clipboard-target')}`).select()

            document.execCommand("copy");

            toastr.success('These links have been copied to clipboard')
        })
    },
    bindActionTriggerFileUpload(){
        $(document).on('click', '.js-button-upload', function (e) {
            e.preventDefault();
            $('input[type="file"]').click()
        })
    },
    bindActionUploadFile(){
        $(document).on('change', 'input[type="file"]', function (e) {
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
                    CKMedia.responseAction(response, container)
                }
            })
        })
    },
    bindActionSearch(){
        $(document).on('click', '.js-search-action', function (e) {
            e.preventDefault();
            CKMedia.loadMedia('all', CKMedia.getSortBy(), CKMedia.getFolderID(), CKMedia.getSearchInput(), false, 1, 30)
        })
    },
    bindActionCloseModal(){
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
        $(document).on('click', '.js-insert-media', (e) => {
            e.preventDefault();
            let inputChecked = $('[data-context="file"] input:checked');
            if (!inputChecked.length) {
                return false;
            }
            CKMedia.handleCKEditorFile(inputChecked.parent());
        });
    },
    bindActionDocumentActionBox(){
        $(document).on('click', function (e) {
            CKMedia.actionBoxToggle($('.nkd-dropdown-menu'))
        })
    }

}

CKMedia.__init()

