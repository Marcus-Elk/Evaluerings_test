


$(document).ready(function() {
    let selects = $(".custom-select");

    selects.each(function(index) {
        let old_select = $(this);

        let new_select = $('<ul class="select"><span>' + old_select.children(":selected").text() + '<img src="./icon/arrow.svg"></img></ul></span>');
        
        old_select.children().each(function() {
            let value = $(this).val();

            $('<li>' + $(this).text() + '</li>')
                .click(function() {
                    old_select.val(value).change();

                    new_select.children("span").text($(this).text());
                    
                })
                .appendTo(new_select);
        });


        new_select.insertAfter($(this));
        
        new_select.click(function() {
            new_select.find("span img").toggleClass("rotated");

            let margin_sum = new_select[0].scrollHeight;
            let str = new_select.css("padding-top");
            margin_sum -= str.substr(0, str.lastIndexOf("px"));

            str = new_select.css("padding-left");
            let left_margin = parseFloat(str.substr(0, str.lastIndexOf("px")));

            new_select.children("li").toggleClass("visible").each(function() {
                $(this).css("margin-top", margin_sum).css("margin-left", -left_margin);

                margin_sum += this.scrollHeight;
            });
            
            

        });


    });

});

