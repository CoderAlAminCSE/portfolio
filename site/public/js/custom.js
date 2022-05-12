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

$('#contactSendBtn').click(function(){
    var contactName= $('#contactNameId').val();
    var contactMobile= $('#contactMobileId').val();
    var contactEmail= $('#contactEmailId').val();
    var contactMsg= $('#contactMsgId').val();

    SendContact(contactName,contactMobile,contactEmail,contactMsg);
});

/*function SendContact(contact_Name,contact_Mobile,contact_Email,contact_Msg){
    axios.post('/contactSend', {
        contact_Name: contact_Name,
        contact_Mobile: contact_Mobile,
        contact_Email: contact_Email,
        contact_Msg: contact_Msg,
      })
      .then(function (response) {
        alert(response.data);
      })
      .catch(function (error) {
        
      });
}*/

function SendContact(contact_Name,contact_Mobile,contact_Email,contact_Msg) {

    if(contact_Name.length==0){
        $('#contactSendBtn').html('আপনার নাম লিখুন !');
        setTimeout(function () {
            $('#contactSendBtn').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_Mobile.length==0){
        $('#contactSendBtn').html('আপনার মোবাইল নং লিখুন !')
        setTimeout(function () {
            $('#contactSendBtn').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_Email.length==0){
        $('#contactSendBtn').html('আপনার ইমেইল  লিখুন !')
        setTimeout(function () {
            $('#contactSendBtn').html('পাঠিয়ে দিন');
        },2000)
    }
    else if(contact_Msg.length==0){

        $('#contactSendBtn').html('আপনার মেসেজ লিখুন !')
        setTimeout(function () {
            $('#contactSendBtn').html('পাঠিয়ে দিন');
        },2000)

    }
    else {
        $('#contactSendBtn').html('পাঠানো হচ্ছে...')
        axios.post('/contactSend',{
            contact_Name: contact_Name,
        contact_Mobile: contact_Mobile,
        contact_Email: contact_Email,
        contact_Msg: contact_Msg,
        })
            .then(function (response) {
                if(response.status==200){
                    if(response.data==1){
                        $('#contactSendBtn').html('অনুরোধ সফল হয়েছে')
                        setTimeout(function () {
                            $('#contactSendBtn').html('পাঠিয়ে দিন');
                        },3000)

                    }
                    else{
                        $('#contactSendBtn').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                        setTimeout(function () {
                            $('#contactSendBtn').html('পাঠিয়ে দিন');
                        },3000)
                    }
                }
                else {
                    $('#contactSendBtn').html('অনুরোধ ব্যার্থ হয়েছে ! আবার চেষ্টা করুন ')
                    setTimeout(function () {
                        $('#contactSendBtn').html('পাঠিয়ে দিন');
                    },3000)
                }

            }).catch(function (error) {
            $('#contactSendBtn').html('আবার চেষ্টা করুন')
            setTimeout(function () {
                $('#contactSendBtn').html('পাঠিয়ে দিন');
            },3000)
        })
    }
}