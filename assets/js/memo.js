       

       tinymce.init({
        selector:'#isiMemo',
        menubar: false,
        statusbar: false,
        plugins:'wordcount',
        toolbar: '',
        skin: 'bootstrap',
        toolbar_drawer: 'floating',
        min_height: 200,           
        autoresize_bottom_margin: 16,
        setup: (editor) => {
            editor.on('init', () => {
                editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
            });
            editor.on('focus', () => {
                editor.getContainer().style.boxShadow="0 0 0 .2rem rgba(0, 123, 255, .25)",
                editor.getContainer().style.borderColor="#80bdff"
            });
            editor.on('blur', () => {
                editor.getContainer().style.boxShadow="",
                editor.getContainer().style.borderColor=""
            });
            var max = 200;
            editor.on('submit', function(event) {
              var numChars = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
              if (numChars > max) {
                alert("Maximum " + max + " karakter.");
                event.preventDefault();
                return false;
                }
            });
            editor.on('change', () => {
                var numChars = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
                 var vCount = document.getElementById('isiDesc');
                console.log(vCount.innerText);
                vCount.innerText = 'Masukkan maks '+max+' huruf. Jumlah huruf '+(numChars);
               
            });
        }
    });


$(document).ready(function () {
    $('#dtAdmin').DataTable();
});


      


