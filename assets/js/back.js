$(function() {
    
    $('.toast').toast('show')

    $('#content').trumbowyg()

    $('#confirm_password').change(function(){
        let npass = $('#new_password').val()
        let cpass = $(this).val()

        if (cpass == npass) {
            document.querySelector('#new_password').setCustomValidity('')

        }

        else{
            document.querySelector('#new_password').setCustomValidity('Password not matched')
        }
    })

    $('.delete').click(function(e){
        e.preventDefault()

        let url = $(this).attr('href')

        if(confirm('Are you sure you want to delete this item?')){
            location.href = url
        }
    })

    $('#image').change(function(e){
        let imgFile = e.target.files[0]

        $('#img-holder').html(`<img class="img-fluid mt-3" src="${URL.createObjectURL(imgFile)}" />`)
    })
})