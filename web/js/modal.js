$( document ).ready(function(){
    $("a[href*='/admin/books/view?id=']").click(function(e){
        e.preventDefault();
        var bookModal = $('#bookModal');
        var bookModalContent = $("#bookModal .modal-content");
        bookModalContent.html(bookModalContent.attr('data-default-content'));
        bookModal.modal();
        $.ajax({
            url: this.href,
            type: 'get',
            success: function (data) {
                bookModalContent.html(data);
            }
        });
    });
});