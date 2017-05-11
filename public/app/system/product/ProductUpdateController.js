import Helper from '../helper/helper';
import app from '../app';

app.ProductUpdateController = function(params) {

    this.hasChild = params.has_child | 0;

    function init() {
        // Biến xác nhận có tạo variant hay ko?
        var _fillAttr = this.hasChild ? true : false;

        function initTagsInput() {
            // Input tags input
            $('.attribute-value-input').tagsInput({
                defaultText : '',
                width: '100%',
                height: 100
            });
        }

        initTagsInput();

        // Show form add variant
        $('#add-variant').click(function(e) {
            e.preventDefault();
            $('#variant-container').removeClass('hide');

            //  Ẩn hiện nút đóng
            if(!$('#variant-container').hasClass('hide')) {
                $('#cancel-variant').removeClass('hide');
            } else {
                $('#cancel-variant').addClass('hide');
            }

            _fillAttr = true;
        });

        // Cancel variant
        $('#cancel-variant').click(function() {
            $('#variant-container').addClass('hide');
            $(this).addClass('hide');

            _fillAttr = false;
        });

        // Append control to create variant
        $('#btn-add-new-attribute').click(function(e) {
            e.preventDefault();

            // $(document.getElementById('template-new-attribute').innerHTML).insertAfter('.first-attribute');
            $('#placement-new-attribute').append($(document.getElementById('template-new-attribute').innerHTML));

            initTagsInput();

            if($('.attribute-row').length == 3) {
                $(this).addClass('hide');
            }
        });

        // Delete variant
        $(document).on('click', '.btn-delete-attribute', function(e) {
            e.preventDefault();
            $(this).parents('.attribute-row').remove();

            // Nếu xóa hết, cập nhật lại trạng thái _fillAttr
            if($('.attribute-row').length == 0) {
                _fillAttr = false;
            }
        });

        // Get file data when i click choose file from computer
        var _image,
            _images = [];

        $('[name="image"]').change(function() {
            _image = this.files[0];
        });

        $('[name="images[]"]').change(function() {
            for(var i = 0; i < this.files.length; i ++) {
                _images.push(this.files[i]);
            }
        });

        // Submit form
        $('#form-data').on('submit', function(e) {
            e.preventDefault();

            var $form = $(this);

            var formData = new FormData();
            var arrayFormDataSubmit = $form.serializeArray();

            for(var i in arrayFormDataSubmit) {
                var control = arrayFormDataSubmit[i];
                formData.append(control.name, control.value);
            }

            if(_image) formData.append('image', _image);
            if(_images) {
                for( var i in _images ) {
                    formData.append('images[]', _images[i]);
                }
            }

            if(_fillAttr == false) {
                formData.delete('option[]');
                formData.delete('value[]');
            }

            $.ajax({
                url: $form.attr('action'),
                type: "POST",
                dataType: 'json',
                data : formData,
                cache: false,
                processData: false,
                contentType: false,
                error : function(response) {
                    Helper.showValidateError(response);
                },

                success : function(response) {
                    if(response.code == 1) {
                        Helper.showMessageAndRedirect(response.message, 'success', response.redirect);
                    } else if(response.code == 422) {
                        Helper.showMessage(response.message, 'error');
                    }
                }
            });
        });

        // Upload image variant
        var _tempIndexVariantImage = -1;
        $('.variant-upload-image').click(function() {
            $('#input-file-hidden').trigger('click');
            _tempIndexVariantImage = $(this).data('key');
        });

        $('#input-file-hidden').on('change', function(e) {
            var $this = $(this);
            var _file = this.files[0];
            var formdata = new FormData();
            formdata.append('file', _file);
            formdata.append('_token', App.config.token);

            $.ajax({
                url : "/ajax/upload-image",
                type : "POST",
                dataType: 'json',
                data : formdata,
                contentType: false,
                processData: false,
                beforeSend : function() {
                    $('#variant-upload-image-' + _tempIndexVariantImage).attr('src', '/img/ajax-loader.gif');
                },
                success : function(response) {
                    $('#variant-upload-image-' + _tempIndexVariantImage).attr('src', response.url);
                    $('#variant-image-' + _tempIndexVariantImage).attr('value', response.filename);
                }
            })
        });

    }

    return {
        init: init
    }
}