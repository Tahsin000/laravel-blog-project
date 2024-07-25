// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});








// Owl Carousel End..................

// contact Send
$('#contactSubmitBtnId').click(function(){
    var contactName = $('#contactNameId').val();
    var contactMobile = $('#contactMobileId').val();
    var contactEmail = $('#contactEmailId').val();
    var contactMsg = $('#contactMsgId').val();
    sendContact(contactName, contactMobile, contactEmail, contactMsg)
});
function sendContact(contact_name, contact_mobile, contact_email, contact_msg) {
    if (contact_mobile == 0) {
        toastr.error("contact mobile no. is required");
    } else if (contact_email == 0) {
        toastr.error("contact email is required");
    } else if (contact_msg == 0) {
        toastr.error("contact message is required");
    } else {
        axios.post('/contactSend', {
            contact_name: contact_name,
            contact_mobile :contact_mobile,
            contact_email:contact_email,
            contact_msg :contact_msg
        })
        .then(function (response){
            (response.data) ? toastr.success('Your message received successfully') : toastr.error("Some thing went wrong");
        }).catch(function(){
    
        })
    }
    
}