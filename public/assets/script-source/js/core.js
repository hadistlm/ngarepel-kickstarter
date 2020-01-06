const base_url     = window.location.origin + "/";
const complete_url = (window.location + "/").replace(new RegExp("#", "g"), "").replace(window.location.search, '');
const ajax_url 	   = base_url + "api/";

let data = {};

/**
 * Number.prototype.format(n, x)
 * 
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

/**
 * String.prototype.format(search, replacement)
 * 
 * @param integer search: find desired word
 * @param integer replacement: replace word with new one
 */
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

/**
 * Check if this string is json or not
 * 
 * @param string str : check the desired string
 */
function isJson(str) {
    if (typeof str !== 'string') return false;
    try {
        const result = JSON.parse(str);
        const type = Object.prototype.toString.call(result);
        return type === '[object Object]' 
            || type === '[object Array]';
    } catch (err) {
        return false;
    }
}

// Alert for success method
function toastSuccess(text, title){
    var title = (title) ? title : "Success!";

    toastr.success(text, title);
}

// Alert for error method
function toastError(text, title){
    var title = (title) ? title : "Failed!";

    toastr.error(text, title);
}

// Alert for warning method
function toastWarning(text, title){
    var title = (title) ? title : "Notice!";

    toastr.warning(text, title);
}

// setting ajax CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// force selectod element input to only accept number
$(document).on('keyup', 'input[name="PRC"], input[name^=variable_qty], input[name=qty]', function(e){
    if (/\D/g.test(this.value))
    {
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
    }
});

$(document).on('click', '.deleteData', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    Swal.fire({
      title: 'Anda Yakin?',
      text: "Anda tidak akan bisa mengembalikan data yang akan dihapus!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
            url: complete_url + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(response){
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: "Data Berhasil dihapus.",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    });

                    setTimeout(function(){
                          window.location.reload(true);
                    },1500);
                }
                else{
                    Swal.fire({
                        title: 'Gagal!',
                        text: "Data gagal dihapus.",
                        type: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    });
                }
            },
            error: function(jqXHR, errorThrown, textStatus){
                console.log(textStatus);
            }
        });
      }
    });
});

$(document).on('click', '.deleteDataMedia', function(e){
    e.preventDefault();
    console.log("ini delete media")
    var id = $(this).data('id');

    Swal.fire({
      title: 'Anda Yakin?',
      text: "Anda tidak akan bisa mengembalikan data yang akan dihapus!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
            url: '/media/' + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(response){
                if (response.status == 'success') {
                    Swal.fire({
                        title: 'Terhapus!',
                        text: "Data Berhasil dihapus.",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    });

                    setTimeout(function(){
                          window.location.reload(true);
                    },1500);
                }
                else{
                    Swal.fire({
                        title: 'Gagal!',
                        text: "Data gagal dihapus.",
                        type: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    });
                }
            },
            error: function(jqXHR, errorThrown, textStatus){
                console.log(textStatus);
            }
        });
      }
    });
});