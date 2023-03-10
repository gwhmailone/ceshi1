UE.Editor.prototype._bkGetActionUrl = UE.Editor.prototype.getActionUrl, UE.Editor.prototype.getActionUrl = function(action) {
    return "onlineimage" == action ? window.UEDITOR_HOME_URL + "php/list.php?action=listimage&csrfToken=" + window.UEDITOR_CONFIG.csrfToken : "onlinefile" == action ? window.UEDITOR_HOME_URL + "php/list.php?action=listfile&csrfToken=" + window.UEDITOR_CONFIG.csrfToken : window.UEDITOR_HOME_URL + "php/upload.php"
}, window.UEDITOR_CONFIG.imageUploadService = function(context, editor) {
    return {
        setUploadData: function(file) {
            return file
        },
        setFormData: function(object, data, headers) {
            return data.csrfToken = window.UEDITOR_CONFIG.csrfToken, data.uploadType = "image", data
        },
        setUploaderOptions: function(uploader) {
            return uploader
        },
        getResponseSuccess: function(res) {
            return "SUCCESS" == res.state
        },
        imageSrcField: "url"
    }
}, window.UEDITOR_CONFIG.videoUploadService = function(context, editor) {
    return {
        setUploadData: function(file) {
            return file
        },
        setFormData: function(object, data, headers) {
            return data.csrfToken = window.UEDITOR_CONFIG.csrfToken, data.uploadType = "video", data
        },
        setUploaderOptions: function(uploader) {
            return uploader
        },
        getResponseSuccess: function(res) {
            return "SUCCESS" == res.state
        },
        videoSrcField: "url"
    }
}, window.UEDITOR_CONFIG.scrawlUploadService = function(context, editor) {
    return {
        uploadScraw: function(file, base64, success, fail) {
            var formData = new FormData;
            formData.append("base64", base64), formData.append("uploadType", "scrawl"), formData.append("csrfToken", window.UEDITOR_CONFIG.csrfToken), $.ajax({
                url: editor.getActionUrl(editor.getOpt("scrawlActionName")),
                type: "POST",
                data: formData,
                contentType: !1,
                processData: !1
            }).done(function(res) {
                res.responseSuccess = "SUCCESS" == res.state, res.scrawlSrcField = "url", success.call(context, res)
            }).fail(function(err) {
                fail.call(context, err)
            })
        }
    }
}, window.UEDITOR_CONFIG.fileUploadService = function(context, editor) {
    return {
        setUploadData: function(file) {
            return file
        },
        setFormData: function(object, data, headers) {
            return data.csrfToken = window.UEDITOR_CONFIG.csrfToken, data.uploadType = "file", data
        },
        setUploaderOptions: function(uploader) {
            return uploader
        },
        getResponseSuccess: function(res) {
            return "SUCCESS" == res.state
        },
        fileSrcField: "url"
    }
};